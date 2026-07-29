<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;


class SaleController extends Controller{

    public function index()
    {
        $sales = Sale::with('saleDetails')->get();
        return response()->json($sales);
    }

    public function store(Request $request)
    {

       $sale = Sale::create($request->all());
       
       foreach ($request->saleDetails as $detail) {
            $detail['sale_id'] = $sale->id;
            SaleDetail::create($detail);
        }

        return response()->json($sale, 201);

    }

    public function show($id)
    {
        $sale = Sale::with('saleDetails')->find($id);

        if (!$sale) {
            return response()->json(['message' => 'Sale not found'], 404);
        }

        return response()->json($sale);
    }

    public function update(Request $request, Sale $sale)
    {
      $sale->update([
        
        'payment_method' => $request->payment_method,
        
      ]);

      foreach($request->details as $detail){

            $sale->saleDetails()
                ->where('id', $detail['id'])
                ->update([
                    'price' => $detail['price'],
                    'quantity' => $detail['quantity'],
                ]);
        }

      return response()->json($sale);

    
    }

}