<?php

namespace App\Exports;

use App\PurchaseLog;
use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class SalesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PurchaseLog::join('products', 'product_id', '=', 'products.id')
                        ->select('products.title', 'products.tenure', 'products.price', 'purchase_logs.created_at')
                        ->get();
    }
}
