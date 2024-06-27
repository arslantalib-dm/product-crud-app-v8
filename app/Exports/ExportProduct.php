<?php

namespace App\Exports;

use App\Interface\ProductRepositoryInterface;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportProduct implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::select('name','slug','price')->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Slug',
            'Price',
        ];
    }
}
