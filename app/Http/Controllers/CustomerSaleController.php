<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CustomerSale;
use App\Models\CustomerSaleItem;
use Illuminate\Http\Request;

class CustomerSaleController extends Controller
{
    public function index()
    {
        $sales = CustomerSale::orderBy('sale_date', 'desc')->paginate(10);
        return view('customer_sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();
        return view('customer_sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'sale_date' => 'required|date',
            'notes' => 'nullable|string',

            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $sale = CustomerSale::create([
            'sale_date' => $data['sale_date'],
            'notes' => $data['notes'] ?? null,
            'total' => 0,
        ]);

        $total = 0;

        foreach ($data['items'] as $itemData) {

            $product = Product::find($itemData['product_id']);

            if ($product->stock < $itemData['quantity']) {
                return back()->with('error', "Stock insuficiente para {$product->name}");
            }

            $price = $product->price;

            CustomerSaleItem::create([
                'customer_sale_id' => $sale->id,
                'product_id' => $product->id,
                'quantity' => $itemData['quantity'],
                'unit_price' => $price,
            ]);

            $product->decrement('stock', $itemData['quantity']);

            $total += $price * $itemData['quantity'];
        }

        $sale->update(['total' => $total]);

        return redirect()->route('customer-sales.index')->with('success', 'Venta registrada correctamente.');
    }

    public function show(CustomerSale $customerSale)
    {
        return view('customer_sales.show', [
            'sale' => $customerSale
        ]);
    }
}
