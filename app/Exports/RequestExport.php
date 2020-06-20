<?php

namespace App\Exports;

use App\Quotation;
use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class RequestExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Quotation::join('products', 'product_id', '=', 'products.id')
                ->where('quotations.status', '=', 'Approved')
                ->select('products.title', 'products.tenure', 'products.price', 'quotations.created_at')
                ->get();
    }
}
