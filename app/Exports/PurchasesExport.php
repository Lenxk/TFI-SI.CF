<?php

namespace App\Exports;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PurchasesExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Purchase::with('items.product')->orderBy('purchase_date', 'desc');

        // Filtros
        if ($this->request->filled('from')) {
            $query->whereDate('purchase_date', '>=', $this->request->from);
        }

        if ($this->request->filled('to')) {
            $query->whereDate('purchase_date', '<=', $this->request->to);
        }

        if ($this->request->filled('product_id')) {
            $query->whereHas('items', function ($q) {
                $q->where('product_id', $this->request->product_id);
            });
        }

        return $query->get()->map(function ($purchase) {
            return [
                'ID' => $purchase->id,
                'Fecha' => $purchase->purchase_date,
                'Proveedor' => $purchase->supplier,
                'Total estimado' => $purchase->items->sum(fn($i) => $i->unit_price * $i->quantity),
                'Items' => $purchase->items->sum('quantity'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Fecha',
            'Proveedor',
            'Total estimado',
            'Items'
        ];
    }
}
