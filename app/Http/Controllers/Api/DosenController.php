<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDosenRequest;
use App\Http\Requests\UpdateDosenRequest;
use Illuminate\Http\Request;
use App\Model\Dosen;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::all();

        return new JsonResponse(
            [
                'message' => 'Data Absensi',
                'data' => $dosen
            ],
            Response::HTTP_OK
        );
    }

    public function store(StoreDosenRequest $request)
    {
        $createdDosen = Dosen::query()->create($request->safe()->all());

        return response()-> json([
            'message' => 'Berhasil Menambahkan Pegawai',
            'data' => $createdDosen
        ], Response::HTTP_CREATED);
    }

    public function show(Dosen $dosen)
    {
        
        $dosen = Dosen::query()->find($id);
        if (empty($dosen)) {
            throw new MyModelNotFoundException('dosen');
        }

        return response ()->json([
            'message' => 'Data Dosen',
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDosenRequest $request, Dosen $dosen)
    {
        $dosen = Dosen::querry()->find($id);
        if (empty($dosen)) {
            throw new MyModelNotFoundException('dosen');
        }

        $dosen->update($request->safe()->all());
        return response()->json([
            'message' => 'Data Dosen berhasil diupdate',
            'data' => $dosen
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen)
    {
        $dosen = Dosen::query()->find($id);
        if (empty($dosen)) {
            throw new MyModelNotFoundException('dosen');
        }

        $dosen->delete();
        return response()->json([
            'message' => 'Data Dosen berhasil dihapus',
            'data' => $dosen
        ], Response::HTTP_OK);
    }

}
