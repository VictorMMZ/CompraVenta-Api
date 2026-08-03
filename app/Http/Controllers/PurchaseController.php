<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseDetail;
use Illuminate\Http\Request;


class PurchaseController extends Controller{

public function index()
    {
        $purchases = Purchase::with('purchaseDetails')->get();
        return response()->json($purchases);
    }


    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'seller_id' => 'required|integer|exists:sellers,id',
            'payment_method' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'purchaseDetails' => 'required|array|min:1',
            'purchaseDetails.*.product_id' => 'required|integer|exists:products,id',
            'purchaseDetails.*.quantity' => 'required|integer|min:1',
            'purchaseDetails.*.unit_price' => 'required|numeric|min:0',
        ]);

        $purchase = Purchase::create([
            'user_id' => $validated['user_id'],
            'seller_id' => $validated['seller_id'],
            'total' => 0,
            'payment_method' => $validated['payment_method'],
            'notes' => $validated['notes'] ?? null,
        ]);

        $total = 0;

        foreach ($validated['purchaseDetails'] as $detail) {
            $subtotal = round($detail['quantity'] * $detail['unit_price'], 2);

            PurchaseDetail::create([
                'purchase_id' => $purchase->id,
                'product_id' => $detail['product_id'],
                'quantity' => $detail['quantity'],
                'unit_price' => $detail['unit_price'],
                'subtotal' => $subtotal,
            ]);

            $total += $subtotal;
        }

        $purchase->update(['total' => $total]);

        return response()->json($purchase, 201);
    }

    public function show($id)
    {
        $purchase = Purchase::with('purchaseDetails')->find($id);

        if (!$purchase) {
            return response()->json(['message' => 'Purchase not found'], 404);
        }

        return response()->json($purchase);
    }

    public function update(Request $request, Purchase $purchase)
{
    // 1. Actualizar los detalles
foreach ($request->purchaseDetails as $detail) {
    $purchase->purchaseDetails()
        ->where('id', $detail['id'])
        ->update([
            'price' => $detail['price'],
            'quantity' => $detail['quantity'],
        ]);
}

// 2. Calcular el nuevo total
$total = $purchase->purchaseDetails()
    ->selectRaw('SUM(price * quantity) as total')
    ->value('total');

// 3. Actualizar la compra
$purchase->update([
    'payment_method' => $request->payment_method,
    'total' => $total,
]);

// 4. Devolver la compra con sus detalles
return response()->json($purchase->load('purchaseDetails'));
}
  

}
