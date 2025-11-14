<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Foto;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FotoController extends Controller
{
    public function index(Request $request)
    {
        $query = Foto::with(['kategori'])->orderBy('created_at', 'desc');
        
        $selectedKategori = $request->query('kategori');
        if ($selectedKategori) {
            $query->where('kategori_id', $selectedKategori);
        }
        $fotos = $query->get();
        
        // Ambil semua kategori yang aktif
        $kategoris = Kategori::where('status', 'Aktif')->orderBy('nama', 'asc')->get();
        
        // Get pending comments count
        $pendingCommentsCount = \App\Models\Comment::where('status', 'pending')->count();
        
        return view('admin.galeries.index', compact('fotos', 'kategoris', 'pendingCommentsCount', 'selectedKategori'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif',
        ], [
            'judul.required' => 'Judul foto wajib diisi',
            'judul.max' => 'Judul foto maksimal 255 karakter',
            'kategori_id.required' => 'Kategori wajib dipilih',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid',
            'foto.required' => 'Foto wajib diupload',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
        ]);


        if ($validator->fails()) {
            // Check if request expects JSON (AJAX request)
            if ($request->expectsJson() || $request->ajax() || $request->header('Accept') === 'application/json' || $request->header('X-Requested-With') === 'XMLHttpRequest') {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }
            
            // For regular form submission, redirect back with validation errors
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $path = null;
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('fotos', $fileName, 'public');
                $path = str_replace('public/', '', $path);
            }

            $foto = Foto::create([
                'judul' => $request->judul,
                'path' => $path,
                'kategori_id' => $request->kategori_id,
                'status' => 'Aktif',
                'petugas_id' => auth()->id() ?? 1,
            ]);

            // Load kategori relationship
            $foto->load('kategori');

            // Check if request expects JSON (AJAX request)
            if ($request->expectsJson() || $request->ajax() || $request->header('Accept') === 'application/json' || $request->header('X-Requested-With') === 'XMLHttpRequest') {
                return response()->json([
                    'success' => true,
                    'message' => 'Foto berhasil diupload',
                    'data' => $foto
                ]);
            }

            // For regular form submission, redirect back with success message
            return redirect()->route('admin.fotos.index')->with('success', 'Foto berhasil diupload');
        } catch (\Exception $e) {
            if (isset($path) && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
            
            // Check if request expects JSON (AJAX request)
            if ($request->expectsJson() || $request->ajax() || $request->header('Accept') === 'application/json' || $request->header('X-Requested-With') === 'XMLHttpRequest') {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }
            
            // For regular form submission, redirect back with error message
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        try {
            $foto = Foto::with('kategori')->find($id);
            
            if (!$foto) {
                return response()->json([
                    'success' => false,
                    'message' => 'Foto tidak ditemukan'
                ], 404);
            }
            
            // Get full path using accessor
            $fotoData = $foto->toArray();
            $fotoData['full_path'] = $foto->full_path;
            
            return response()->json([
                'success' => true, 
                'data' => $fotoData
            ]);
        } catch (\Exception $e) {
            \Log::error('Error loading foto details: ' . $e->getMessage(), [
                'foto_id' => $id ?? null,
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat detail foto: ' . $e->getMessage()
            ], 500);
        }
    }

    public function create()
    {
        $kategoris = Kategori::where('status', 'Aktif')->orderBy('nama', 'asc')->get();
        return view('admin.galeries.create', compact('kategoris'));
    }

    public function edit(Foto $foto)
    {
        $kategoris = Kategori::where('status', 'Aktif')->orderBy('nama', 'asc')->get();
        return view('admin.galeries.edit', compact('foto', 'kategoris'));
    }

    public function update(Request $request, Foto $foto)
    {
        // Handle both form field names (for compatibility with different forms)
        $requestData = $request->all();
        
        // Handle edit_ prefixed fields (from some forms)
        if (isset($requestData['edit_judul'])) {
            $requestData['judul'] = $requestData['edit_judul'];
        }
        if (isset($requestData['edit_kategori_id'])) {
            $requestData['kategori_id'] = $requestData['edit_kategori_id'];
        }
        if (isset($requestData['edit_foto'])) {
            $requestData['foto'] = $requestData['edit_foto'];
        }
        
        // Field names are already correct for modal form (judul, kategori_id, foto)
        
        $validator = Validator::make($requestData, [
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ], [
            'judul.required' => 'Judul foto wajib diisi',
            'judul.max' => 'Judul foto maksimal 255 karakter',
            'kategori_id.required' => 'Kategori wajib dipilih',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
        ]);

        if ($validator->fails()) {
            // Always return JSON for AJAX requests
            if ($request->expectsJson() || $request->ajax() || $request->header('Accept') === 'application/json' || $request->header('X-Requested-With') === 'XMLHttpRequest') {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $updateData = [
                'judul' => $requestData['judul'],
                'kategori_id' => $requestData['kategori_id'],
            ];

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $newPath = $file->storeAs('fotos', $fileName, 'public');
                $newPath = str_replace('public/', '', $newPath);

                if ($foto->path && Storage::disk('public')->exists($foto->path)) {
                    Storage::disk('public')->delete($foto->path);
                }
                $updateData['path'] = $newPath;
            }

            $foto->update($updateData);

            // Always return JSON for AJAX requests
            if ($request->expectsJson() || $request->ajax() || $request->header('Accept') === 'application/json' || $request->header('X-Requested-With') === 'XMLHttpRequest') {
                return response()->json([
                    'success' => true,
                    'message' => 'Foto berhasil diupdate',
                    'data' => $foto
                ]);
            }

            return redirect()->route('admin.fotos.index')->with('success', 'Foto berhasil diupdate');
        } catch (\Exception $e) {
            // Always return JSON for AJAX requests
            if ($request->expectsJson() || $request->ajax() || $request->header('Accept') === 'application/json' || $request->header('X-Requested-With') === 'XMLHttpRequest') {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Request $request, Foto $foto)
    {
        try {
            if ($foto->path && Storage::disk('public')->exists($foto->path)) {
                Storage::disk('public')->delete($foto->path);
            }
            $foto->delete();

            // Check if request expects JSON (AJAX request)
            if ($request->expectsJson() || $request->ajax() || $request->header('Accept') === 'application/json' || $request->header('X-Requested-With') === 'XMLHttpRequest') {
                return response()->json(['success' => true, 'message' => 'Foto berhasil dihapus']);
            }

            // For regular form submission, redirect back with success message
            return redirect()->route('admin.fotos.index')->with('success', 'Foto berhasil dihapus');
        } catch (\Exception $e) {
            // Check if request expects JSON (AJAX request)
            if ($request->expectsJson() || $request->ajax() || $request->header('Accept') === 'application/json' || $request->header('X-Requested-With') === 'XMLHttpRequest') {
                return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
            }

            // For regular form submission, redirect back with error message
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, Foto $foto)
    {
        $validator = Validator::make($request->all(), ['status' => 'required|in:Aktif,Nonaktif']);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Status tidak valid'], 422);
        }

        try {
            $foto->update(['status' => $request->status]);
            return response()->json(['success' => true, 'message' => 'Status foto berhasil diupdate', 'data' => $foto]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ids' => 'required|array',
            'ids.*' => 'exists:foto,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'ID foto tidak valid'], 422);
        }

        try {
            $fotos = Foto::whereIn('id', $request->ids)->get();
            foreach ($fotos as $foto) {
                if ($foto->path && Storage::disk('public')->exists($foto->path)) {
                    Storage::disk('public')->delete($foto->path);
                }
            }
            Foto::whereIn('id', $request->ids)->delete();

            return response()->json(['success' => true, 'message' => count($request->ids) . ' foto berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}
