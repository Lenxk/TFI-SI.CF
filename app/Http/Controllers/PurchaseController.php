<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductBatch;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use App\Models\Supplier;


class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::orderBy('purchase_date', 'desc')->paginate(10);

        return view('purchases.index', compact('purchases'));
    }

    public function create()
{
    $products = Product::orderBy('name')->get();
    $providers = Supplier::orderBy('name')->get();

    return view('purchases.create', compact('products', 'providers'));
}

    public function store(Request $request)
    {
        $data = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_date'  => 'required|date',
            'notes'          => 'nullable|string',

            'items'                  => 'required|array|min:1',
            'items.*.product_id'     => 'required|exists:products,id',
            'items.*.quantity'       => 'required|integer|min:1',
            'items.*.unit_price'     => 'nullable|numeric|min:0',
            'items.*.lot_code'       => 'nullable|string|max:255',
            'items.*.expires_at'     => 'nullable|date',
        ]);

        // Calcular total si tiene precios
        $total = 0;
        foreach ($data['items'] as $itemData) {
            if (!empty($itemData['unit_price'])) {
                $total += $itemData['unit_price'] * $itemData['quantity'];
            }
        }

        // Crear la compra
        $purchase = Purchase::create([
            'supplier_id'      => $data['supplier_id'],
            'purchase_date' => $data['purchase_date'],
            'notes'         => $data['notes'] ?? null,
            'total'         => $total > 0 ? $total : null,
        ]);

        // Procesar ítems
        foreach ($data['items'] as $itemData) {

            // Registrar ítem
            $purchase->items()->create([
                'product_id' => $itemData['product_id'],
                'quantity'   => $itemData['quantity'],
                'unit_price' => $itemData['unit_price'] ?? null,
                'lot_code'   => $itemData['lot_code'] ?? null,
                'expires_at' => $itemData['expires_at'] ?? null,
            ]);

            // Crear lote
            $batch = ProductBatch::create([
                'product_id' => $itemData['product_id'],
                'supplier_id'   => $data['supplier_id'],
                'lot_code'   => $itemData['lot_code'] ?? null,
                'quantity'   => $itemData['quantity'],
                'expires_at' => $itemData['expires_at'] ?? null,
            ]);

            // Actualizar stock del producto
            $product = Product::find($itemData['product_id']);
            if ($product) {
                $product->increment('stock', $batch->quantity);
            }
        }

        return redirect()
            ->route('purchases.index')
            ->with('success', 'Compra registrada correctamente.');
    }

    public function show(Purchase $purchase)
    {
        $purchase->load(['items.product']);

        return view('purchases.show', compact('purchase'));
    }

    public function destroy(Purchase $purchase)
{
    // Cargar ítems con sus productos
    $purchase->load(['items.product']);

    // Revertir stock y borrar lotes asociados
    foreach ($purchase->items as $item) {

        // Revertir stock
        $product = $item->product;
        if ($product) {
            $product->stock -= $item->quantity;
            if ($product->stock < 0) $product->stock = 0;
            $product->save();
        }

        // Borrar lotes correspondientes
        ProductBatch::where('product_id', $item->product_id)
            ->where('quantity', $item->quantity)
            ->where('lot_code', $item->lot_code)
            ->whereDate('expires_at', $item->expires_at)
            ->delete();
    }

    // Borrar ítems
    $purchase->items()->delete();

    // Finalmente borrar compra
    $purchase->delete();

    return redirect()
        ->route('purchases.index')
        ->with('success', 'Compra eliminada correctamente.');
}

}
