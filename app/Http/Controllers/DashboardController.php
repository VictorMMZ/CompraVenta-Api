<?php
namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        $totalPurchases = Purchase::sum('total');
        $totalSales = Sale::sum('total');
        $totalProducts = Product::count();
        $totalPurchaseDetails = PurchaseDetail::count();
        $totalSaleDetails = SaleDetail::count();
        $totalProfitToday = Sale::whereDate('sale_date', now()->toDateString())->sum('total') - Purchase::whereDate('purchase_date', now()->toDateString())->sum('total');
        $totalPurchasesToday = Purchase::whereDate('purchase_date', now()->toDateString())->sum('total');
        $totalSalesToday = Sale::whereDate('sale_date', now()->toDateString())->sum('total');
        $productsWithLowStock = Product::where('stock', '<=', 2)->get();
        $lastoperations = DB::table('purchases')
            ->select('id', 'total', 'purchase_date','payment_method', DB::raw("'purchase' as type"))
            ->unionAll(
                DB::table('sales')
                    ->select('id', 'total', 'sale_date', 'payment_method', DB::raw("'sale' as type"))
            )
            ->orderByDesc('purchase_date')
            ->orderByDesc('sale_date')
            ->limit(5)
            ->get();

        return response()->json([
            'totalPurchases' => $totalPurchases,
            'totalSales' => $totalSales,
            'totalProducts' => $totalProducts,
            'totalPurchaseDetails' => $totalPurchaseDetails,
            'totalSaleDetails' => $totalSaleDetails,
            'totalPurchasesToday' => $totalPurchasesToday,
            'totalSalesToday' => $totalSalesToday,
            'totalProfitToday' => $totalProfitToday,
            'productsWithLowStock' => $productsWithLowStock,
            'lastoperations' => $lastoperations,
        ]);
    }
}

?>