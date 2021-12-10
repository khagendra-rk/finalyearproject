<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Product([
            'product_name' => $row[0],
            'product_code' => $row[1],
            'product_place' => $row[2],
            'buy_date' => $row[3],
            'expire_date' => $row[4],
            'buying_price' => $row[5],
            'selling_price' => $row[6],
        ]);
    }
}
