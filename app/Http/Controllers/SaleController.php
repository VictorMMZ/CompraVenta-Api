<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;


class SaleController extends Controller{
// devuelve todas las ventas con sus detalles
    public function index()
    {
        $sales = Sale::with('saleDetails.product')->get();
        return response()->json($sales);
    }


    // crear una nueva venta con sus detalles
    public function store(Request $request)
    {

    
        $validated = $request->validate([
            'customer_id' => 'nullable|integer|exists:customers,id',
            'user_id' => 'required|integer|exists:users,id',
            'payment_method' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'sale_date' => 'required|date',
            'saleDetails' => 'required|array|min:1',
            'saleDetails.*.product_id' => 'required|integer|exists:products,id',
            'saleDetails.*.quantity' => 'required|integer|min:1',
            'saleDetails.*.unit_price' => 'required|numeric|min:0',
        ]);

        
        $sale = Sale::create([
            'customer_id' => $validated['customer_id'] ?? null,
            'user_id' => $validated['user_id'],
            'total' => 0,
            'payment_method' => $validated['payment_method'],
            'notes' => $validated['notes'] ?? null,
            'sale_date' => $validated['sale_date'],
        ]);

    

        $total = 0;

        foreach ($validated['saleDetails'] as $detail) {
            $subtotal = round($detail['quantity'] * $detail['unit_price'], 2);

            SaleDetail::create([
                'sale_id' => $sale->id,
                'product_id' => $detail['product_id'],
                'quantity' => $detail['quantity'],
                'unit_price' => $detail['unit_price'],
                'subtotal' => $subtotal,
            ]);

            $total += $subtotal;
        }

        $sale->update(['total' => $total]);

        return response()->json($sale, 201);

    }

    // muestra una venta {id} con sus detalles
    public function show($id)
    {
        $sale = Sale::with('saleDetails.product')->find($id);

        if (!$sale) {
            return response()->json(['message' => 'Sale not found'], 404);
        }

        return response()->json($sale);
    }

    // actualizar una venta {id} con sus detalles
    public function update(Request $request, Sale $sale)
    {

    $validated = $request->validate([
         
            'payment_method' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'sale_date' => 'required|date',
            'saleDetails' => 'required|array|min:1',
            'saleDetails.*.product_id' => 'required|integer|exists:products,id',
            'saleDetails.*.quantity' => 'required|integer|min:1',
            'saleDetails.*.unit_price' => 'required|numeric|min:0',
            'saleDetails.*.id' => 'required|integer|exists:sale_details,id',
        ]);


        
      $sale->update([
        
        'payment_method' => $validated['payment_method'],
        'notes' => $validated['notes'] ?? null,
        'sale_date' => $validated['sale_date'],
        
      ]);

     

 foreach ($validated['saleDetails'] as $detail) {

    $sale->saleDetails()
        ->where('id', $detail['id'])
        ->update([
            'unit_price' => $detail['unit_price'],
            'quantity' => $detail['quantity'],
            'subtotal' => round($detail['quantity'] * $detail['unit_price'], 2),
        ]);
}

// Calcular el total de la venta sumando los subtotales de los detalles
$total = $sale->saleDetails()->sum('subtotal');

// Actualizar el total de la venta
$sale->update([
    'total' => $total,
]);

return response()->json($sale->load('saleDetails'));
    
    }

}