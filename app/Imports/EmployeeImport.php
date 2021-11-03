<?php

namespace App\Imports;

use App\Models\products;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class EmployeeImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new products([
            'name' =>$row['name'],
            'slug' =>$row['slug'],
            'shor_desc' =>$row['shor_desc'],
            'desc' =>$row['desc'],
            'regular_price' =>$row['regular_price'],
            'sale_price' =>$row['sale_price'],
            'SKU' =>$row['SKU'],
            'stock_status' =>$row['stock_status'],
            'featured' =>$row['featured'],
            'quantity' =>$row['quantity'],
            'sold' =>$row['sold'],
            'image' =>$row['image'],
            'images' =>$row['images'],
            'category_id' =>$row['category_id'],
            'subcategory_id' => $row['subcategory_id']
        ]);
    }
}
