<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductBatch;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductBatchController extends Controller
{
    public function index(Product $product)
    {
        $batches = $product->batches()->orderBy('expires_at')->get();

        return view('batches.index', compact('product', 'batches'));
    }

    public function create(Product $product)
    {
        // Para elegir proveedor al crear lote
        $providers = Supplier::orderBy('name')->get();

        return view('batches.create', compact('product', 'providers'));
    }

    public function store(Request $request, Product $product)
    {
        $data = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'lot_code'    => 'nullable|string|max:255',
            'quantity'    => 'required|integer|min:1',
            'expires_at'  => 'nullable|date',
        ]);

        $data['product_id'] = $product->id;

        $batch = ProductBatch::create($data);

        // Aumentar stock del producto
        $product->increment('stock', $batch->quantity);

        return redirect()
            ->route('products.batches.index', $product)
            ->with('success', 'Lote agregado correctamente.');
    }

    public function edit(ProductBatch $batch)
    {
        $product = $batch->product;
        $providers = Supplier::orderBy('name')->get();

        return view('batches.edit', compact('product', 'batch', 'providers'));
    }

    public function update(Request $request, ProductBatch $batch)
    {
        $data = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'lot_code'    => 'nullable|string|max:255',
            'quantity'    => 'required|integer|min:1',
            'expires_at'  => 'nullable|date',
        ]);

        $oldQuantity = $batch->quantity;

        $batch->update($data);

        // Ajustar stock según diferencia
        $difference = $batch->quantity - $oldQuantity;
        $batch->product->increment('stock', $difference);

        return redirect()
            ->route('products.batches.index', $batch->product)
            ->with('success', 'Lote actualizado correctamente.');
    }

    public function destroy(ProductBatch $batch)
    {
        $product = $batch->product;

        // Restar al stock
        $product->decrement('stock', $batch->quantity);

        $batch->delete();

        return redirect()
            ->route('products.batches.index', $product)
            ->with('success', 'Lote eliminado correctamente.');
    }
}
