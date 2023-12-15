<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\MyModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAbsenKeluarRequest;
use App\Http\Requests\UpdateAbsenKeluarRequest;
use App\Models\AbsenKeluar;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AbsenKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('keywords');
        $absenkeluar = AbsenKeluar::where('hari_out', 'like', '%' . $search . '%')
            ->orWhere('tanggal_out', 'like', '%' . $search . '%')
            ->orWhere('waktu_out', 'like', '%' . $search . '%')
            ->orWhere('lokasi_out', 'like', '%' . $search . '%')
            ->with(['mahasiswa' => function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            }])
            ->get();

        return new JsonResponse(
            [
                'message' => 'Data Absensi',
                'data' => $absenkeluar
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAbsenKeluarRequest $request)
    {
        $validate = $request->validated();
        $validate['mahasiswa_id'] = $request->get('mahasiswa_id');
        $createdAbsen = AbsenKeluar::query()->create($validate);

        if ($request->hasFile('foto_out')) {
            $foto = $request->file('foto_out');
            $filename = time() . '.' . $foto->getClientOriginalName();
            $foto->move(public_path('foto_absen'), $filename);
        }

        $createdAbsen->update(['foto_out' => 'foto_absen/' . $filename]);

        return response()->json([
            'message' => 'Berhasil menambahkan Data',
            'data' => $createdAbsen
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(AbsenKeluar $absenKeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AbsenKeluar $absenKeluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAbsenKeluarRequest $request, AbsenKeluar $absenKeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $absenMasuk = AbsenKeluar::query()->find($id);
        if (empty($absenMasuk)) {
            throw new MyModelNotFoundException('mahasiswa');
        }

        $absenMasuk->delete();
        return response()->json([
            'message' => 'Data Absen Masuk berhasil dihapus',
            'data' => $absenMasuk
        ], Response::HTTP_OK);
    }
}
