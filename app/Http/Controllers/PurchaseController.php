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
        $purchase = Purchase::create($request->all());

        foreach ($request->purchaseDetails as $detail) {
            $detail['purchase_id'] = $purchase->id;
            PurchaseDetail::create($detail);
        }

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
    $purchase->update([
        'payment_method' => $request->payment_method,
    ]);

    foreach($request->details as $detail){

        $purchase->purchaseDetails()
            ->where('id', $detail['id'])
            ->update([
                'price' => $detail['price'],
                'quantity' => $detail['quantity'],
            ]);
    }

    return response()->json($purchase->load('purchaseDetails'));
}
  

}
