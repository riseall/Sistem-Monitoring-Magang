<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\MyModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePerusahaanRequest;
use App\Http\Requests\UpdatePerusahaanRequest;
use App\Models\Perusahaan;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $perusahaan = Perusahaan::all();
        return new JsonResponse(
            [
                'message' => 'Data Perusahaan',
                'data' => $perusahaan
            ],
            Response::HTTP_OK
        );
    }

    public function store(StorePerusahaanRequest $request)
    {
        $validateData = $request->validated();
        $createdPerusahaan = Perusahaan::query()->create($validateData);
    
        return response()->json([
            'message' => 'Berhasil Menambahkan Perusahaan',
            'data' => $createdPerusahaan
        ], Response::HTTP_CREATED);
    }
    
    public function show(string $id)
    {

        $perusahaan = Perusahaan::query()->find($id);
        if (empty($perusahaan)) {
            throw new MyModelNotFoundException('perusahaan');
        }

        return response()->json([
            'message' => 'Data Perusahaan',
            'data' => $perusahaan
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePerusahaanRequest $request, string $id)
    {
        $perusahaan = Perusahaan::query()->find($id);
        if (empty($perusahaan)) {
            throw new MyModelNotFoundException('perusahaan');
        }

        $perusahaan->update($request->safe()->all());
        return response()->json([
            'message' => 'Data Perusahaan berhasil diupdate',
            'data' => $perusahaan
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $perusahaan = Perusahaan::query()->find($id);
        if (empty($perusahaan)) {
            throw new MyModelNotFoundException('perusahaan');
        }

        $perusahaan->delete();
        return response()->json([
            'message' => 'Data Perusahaan berhasil dihapus',
            'data' => $perusahaan
        ], Response::HTTP_OK);
    }
}