<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::orderBy('sale_date', 'desc')->paginate(10);

        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();

        return view('sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'sale_date' => 'required|date',
            'notes' => 'nullable|string',

            'items.*.product_id' => 'required|exists:productos,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Crear venta
        $sale = Sale::create([
            'sale_date' => $data['sale_date'],
            'notes' => $data['notes'] ?? null,
        ]);

        $total = 0;

        foreach ($data['items'] as $itemData) {

            $product = Product::find($itemData['product_id']);

            // Precio unitario actual
            $unitPrice = $product->price;

            // Crear ítem
            $item = $sale->items()->create([
                'product_id' => $product->id,
                'quantity' => $itemData['quantity'],
                'unit_price' => $unitPrice
            ]);

            // Calcular total
            $total += $unitPrice * $itemData['quantity'];

            // Descontar stock
            $product->stock -= $itemData['quantity'];
            if ($product->stock < 0) $product->stock = 0;
            $product->save();
        }

        $sale->total = $total;
        $sale->save();

        return redirect()
            ->route('sales.index')
            ->with('success', 'Venta registrada correctamente.');
    }

    public function show(Sale $sale)
    {
        $sale->load(['items.product']);

        return view('sales.show', compact('sale'));
    }
}
