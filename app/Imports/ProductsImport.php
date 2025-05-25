<?php

namespace App\Imports;

use App\Models\Language;
use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ProductsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $locales = Language::all()->pluck('lang');

        foreach ($rows->skip(1) as $row) {
            $product = new Product();
            $product->sku = $row[0];
//            $product->category_id = $row[1];
            $product->category_id = 1;
            $product->price = $row[2];
            $product->quantity = $row[3];
            $product->discount_price = $row[4] ?? null;
            $product->gender = $row[5] ?? null;
            $product->age_id = 1;

            if (!empty($row[6]) && is_numeric($row[6])) {
                $product->offer_end_date = Date::excelToDateTimeObject($row[6])->format('Y-m-d');
            } else {
                $product->offer_end_date = '2025-12-31';           }

            // Loop through locales and ensure the index exists in the row
            foreach ($locales as $index => $locale) {
                $nameIndex = 7 + ($index * 2);
                $descriptionIndex = 8 + ($index * 2);

                // Check if the name and description indexes are valid before assigning
                if (isset($row[$nameIndex]) && !empty($row[$nameIndex])) {
                    $product->translateOrNew($locale)->name = $row[$nameIndex];
                }
                if (isset($row[$descriptionIndex]) && !empty($row[$descriptionIndex])) {
                    $product->translateOrNew($locale)->description = $row[$descriptionIndex];
                }
            }

            $product->save();
        }
    }
}
