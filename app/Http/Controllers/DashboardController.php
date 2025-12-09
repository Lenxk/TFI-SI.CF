<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductBatch;

class DashboardController extends Controller
{
    public function index()
    {
        // Productos con stock crítico
        $lowStockProducts = Product::lowStock()
            ->orderBy('stock')
            ->take(5)
            ->get();

        $lowStockCount = Product::lowStock()->count();

        // Lotes por vencer (próximos 30 días)
        $expiringSoonBatches = ProductBatch::expiringSoon(30)
            ->with('product')
            ->orderBy('expires_at')
            ->take(5)
            ->get();

        $expiringSoonCount = ProductBatch::expiringSoon(30)->count();

        // Lotes ya vencidos
        $expiredCount = ProductBatch::expired()->count();

        return view('dashboard', compact(
            'lowStockProducts',
            'lowStockCount',
            'expiringSoonBatches',
            'expiringSoonCount',
            'expiredCount'
        ));
    }
}
