<?php

namespace App\Exports;

use App\Models\CustomerSale;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        // Cambiamos Sale → CustomerSale
        $query = CustomerSale::with('items.product')->orderBy('sale_date', 'desc');

        // Filtros opcionales
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

        // Mapeamos para exportar sólo los datos necesarios
        return $query->get()->map(function ($sale) {
            return [
                'ID'             => $sale->id,
                'Fecha'          => $sale->sale_date,
                'Total Vendido'  => number_format($sale->total, 2, ',', '.'),
                'Items Vendidos' => $sale->items->sum('quantity'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Fecha',
            'Total Vendido',
            'Items Vendidos',
        ];
    }
}
