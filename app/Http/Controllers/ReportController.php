<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalesExport;
use App\Models\Purchase;
use App\Exports\PurchasesExport;


class ReportController extends Controller
{
    public function sales(Request $request)
    {
        $query = Sale::with('items.product')->orderBy('sale_date', 'desc');

        if ($request->filled('from')) {
            $query->whereDate('sale_date', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('sale_date', '<=', $request->to);
        }

        if ($request->filled('product_id')) {
            $query->whereHas('items', function ($q) use ($request) {
                $q->where('product_id', $request->product_id);
            });
        }

        $sales = $query->get();
        $products = Product::orderBy('name')->get();

        return view('reports.sales', compact('sales', 'products'));
    }

    public function exportSales(Request $request)
    {
        return Excel::download(new SalesExport($request), 'reporte_ventas.xlsx');
    }

    public function purchases(Request $request)
{
    $query = Purchase::with('items.product')->orderBy('purchase_date', 'desc');

    if ($request->filled('from')) {
        $query->whereDate('purchase_date', '>=', $request->from);
    }

    if ($request->filled('to')) {
        $query->whereDate('purchase_date', '<=', $request->to);
    }

    if ($request->filled('product_id')) {
        $query->whereHas('items', function ($q) use ($request) {
            $q->where('product_id', $request->product_id);
        });
    }

    $purchases = $query->get();
    $products = \App\Models\Product::orderBy('name')->get();

    return view('reports.purchases', compact('purchases', 'products'));
}

public function exportPurchases(Request $request)
{
    return Excel::download(new PurchasesExport($request), 'reporte_compras.xlsx');
}
}

