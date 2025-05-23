<?php

namespace App\Exports;

use App\Models\Color;
use App\Models\SubscribeEmail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
class SubscribeExport implements FromArray,  WithHeadings ,ShouldAutoSize ,WithStrictNullComparison //,FromQuery

{
     use Exportable;
     public function array(): array
    {
         $colors =SubscribeEmail::get();
         
                foreach($colors as $one){
                    $items[] = [
                        $one->email,
                        $one->type,

                    ];  
        }

        
        
        
        return $items;
    }
    
        public function headings() :array
    {
        return ["email",'type'];
    }
}
