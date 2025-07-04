<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;


class UsersExport implements FromArray,  WithHeadings ,ShouldAutoSize ,WithStrictNullComparison
{
    use Exportable;

    public function  __construct($request)
    {
        $this->request = $request;
       
    }

    public function array(): array
    {

         $user=User::get();
      
        foreach($user as $one){
            // if($one->gender == 1) {
            //     $gender =__('cp.male');
            // }
            // elseif ($one->gender == 2){
            //     $gender =__('cp.female');
            // }
            // else {
            //     $gender ='';
            // }
            $items[] = [
                $one->id,
                $one->name,
                // $one->last_name,
                $one->email,
                $one->mobile,
                $one->status,
                $one->created_at,
            ];
        }

        return $items;
    }

    public function headings() :array
    {
        return ["id","name" ,"email","mobile","status","created_at"];

    }
}



	