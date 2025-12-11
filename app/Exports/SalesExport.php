<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class SalesExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Sale::with('items.product')->orderBy('sale_date', 'desc');

        if ($this->request->filled('from')) {
            $query->whereDate('sale_date', '>=', $this->request->from);
        }

        if ($this->request->filled('to')) {
            $query->whereDate('sale_date', '<=', $this->request->to);
        }

        if ($this->request->filled('product_id')) {
            $query->whereHas('items', function ($q) {
                $q->where('product_id', $this->request->product_id);
            });
        }

        return $query->get()->map(function ($sale) {
            return [
                'ID' => $sale->id,
                'Fecha' => $sale->sale_date,
                'Total' => $sale->total,
                'Items Vendidos' => $sale->items->sum('quantity'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Fecha',
            'Total',
            'Items Vendidos'
        ];
    }
}

