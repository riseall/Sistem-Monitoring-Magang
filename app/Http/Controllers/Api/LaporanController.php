<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = Laporan::all();

        return new JsonResponse(
            [
                'message' => 'Data Absensi',
                'data' => $laporan
            ],
            Response::HTTP_OK
        );
    }

    public function store(StoreLaporanRequest $request)
    {
        $createdLaporan = Laporan::query()->create($request->safe()->all());

        return response()-> json([
            'message' => 'Berhasil Menambahkan Pegawai',
            'data' => $createdLaporan
        ], Response::HTTP_CREATED);
    }

    public function show(Laporan $laporan)
    {
        $laporan = Laporan::query()->find($id);
        if (empty($laporan)) {
            throw new MyModelNotFoundException('laporan');
        }

        return response ()->json([
            'message' => 'Data Laporan',
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laporan $laporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLaporanRequest $request, Laporan $laporan)
    {
        $laporan = Laporan::querry()->find($id);
        if (empty($laporan)) {
            throw new MyModelNotFoundException('laporan');
        }

        $laporan->update($request->safe()->all());
        return response()->json([
            'message' => 'Data Laporan berhasil diupdate',
            'data' => $laporan
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laporan $laporan)
    {
        $laporan = Laporan::query()->find($id);
        if (empty($laporan)) {
            throw new MyModelNotFoundException('laporan');
        }

        $laporan->delete();
        return response()->json([
            'message' => 'Data Laporan berhasil dihapus',
            'data' => $laporan
        ], Response::HTTP_OK);
    }
}
