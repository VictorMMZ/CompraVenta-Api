<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;


class SellerController extends Controller
{
    /**
     * Registro de un nuevo vendedor
     */

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'document_id' => 'required|string|size:9',
        ]);

        $seller = Seller::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'document_id' => $validated['document_id'],
        ]);


        return response()->json([
            'message' => 'Vendedor registrado exitosamente',
            'seller' => $seller,
        ], 201);
    }


    /**
     * Obtener todos los vendedores
     */

    public function index()
    {
        $sellers = Seller::all();
        return response()->json($sellers, 200);
    }

    /**
     * Obtener un vendedor por documento de identidad
     */

    public function show($document_id)
    {
        $seller = Seller::where('document_id', $document_id)->first();

        if (!$seller) {
            return response()->json(['message' => 'Vendedor no encontrado'], 404);
        }

        return response()->json($seller, 200);
    }


    /**
     * Actualizar los datos de un vendedor segun su documento de identidad
     */

    public function update(Request $request, $document_id)
    {
        
        $seller = Seller::where('document_id', $document_id)->first();

        if (!$seller) {
            return response()->json(['message' => 'Vendedor no encontrado'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email',
        ]);

        $seller->update($validated);

        return response()->json([
            'message' => 'Vendedor actualizado exitosamente',
            'seller' => $seller,
        ], 200);
    }

    /**
     * Eliminar un vendedor por documento de identidad
     */

    public function destroy($document_id){

    $seller = Seller::where('document_id', $document_id)->first();

    if (!$seller) {
            return response()->json(['message' => 'Vendedor no encontrado'], 404);
        }
    $seller->delete();

    return response()->json([
            'message' => 'Vendedor eliminado exitosamente',
        ], 200)
;
    }

}
