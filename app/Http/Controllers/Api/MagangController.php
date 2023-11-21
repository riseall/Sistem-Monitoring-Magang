<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\MyModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMagangRequest;
use App\Http\Requests\UpdateMagangRequest;
use App\Models\Magang;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class MagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $magang = Magang::al();
        return new JsonResponse(
            [
                'message' => 'Data Magang',
                'data' => $magang
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMagangRequest $request)
    {
        $validateData = $request->validated();
        $createdMagang = Magang::query()->create($validateData);
    
        return response()->json([
            'message' => 'Berhasil Menambahkan magang',
            'data' => $createdMagang
        ], Response::HTTP_CREATED);
    }
    
    public function show(string $id)
    {

        $magang = Magang::query()->find($id);
        if (empty($magang)) {
            throw new MyModelNotFoundException('magang');
        }

        return response()->json([
            'message' => 'Data Magang',
            'data' => $magang
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMagangRequest $request, string $id)
    {
        $magang = Magang::querry()->find($id);
        if (empty($perusahaan)) {
            throw new MyModelNotFoundException('perusahaan');
        }

        $magang->update($request->safe()->all());
        return response()->json([
            'message' => 'Data Magang berhasil diupdate',
            'data' => $magang
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $perusahaan = Perusahaan::query()->find($id);
        if (empty($magang)) {
            throw new MyModelNotFoundException('magang');
        }

        $magang->delete();
        return response()->json([
            'message' => 'Data Magang berhasil dihapus',
            'data' => $magang
        ], Response::HTTP_OK);
    }
}
