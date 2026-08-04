<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;


class SellerController extends Controller
{
    /**
     * Registro de un nuevo vendedor
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'document_id' => 'required|string|max:255|unique:sellers,document_id',
            'phone' => 'nullable|integer|unique:sellers,phone',
            'notes' => 'nullable|string',
        ]);

        $seller = Seller::create($validated);

        return response()->json([
            'message' => 'Vendedor registrado exitosamente',
            'seller' => $seller,
        ], 201);
    }


   // obtener todos los vendedores

    public function index()
    {
        $sellers = Seller::all();
        return response()->json($sellers, 200);
    }
 // obtener un vendedor por su document_id
    
    public function show($document_id)
    {
        $seller = Seller::where('document_id', $document_id)->first();

        if (!$seller) {
            return response()->json(['message' => 'Vendedor no encontrado'], 404);
        }

        return response()->json($seller, 200);
    }

// actualizar un vendedor por su document_id

    public function update(Request $request, $document_id)
    {
        
        $seller = Seller::where('document_id', $document_id)->first();

        if (!$seller) {
            return response()->json(['message' => 'Vendedor no encontrado'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'phone' => 'nullable|integer|unique:sellers,phone',
            'notes' => 'nullable|string',
        ]);

        $seller->update($validated);

        return response()->json([
            'message' => 'Vendedor actualizado exitosamente',
            'seller' => $seller,
        ], 200);
    }

  // eliminar un vendedor por su document_id
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
