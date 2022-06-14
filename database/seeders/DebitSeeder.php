<?php

namespace Database\Seeders;
use App\Models\Debit;

use Illuminate\Database\Seeder;

class DebitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $dess = [
        [  
            'ket' => 'Debit',
            'debit' => 'D'
        ],
        [  
            'ket' => 'Credit',
            'debit' => 'C'
        ]
         
       
    ];


    foreach ($dess as $i => $des) {
        $u = Debit::create([ 
            'ket' => $des['ket'],
            'debit' => $des['debit'],
        ]);
    }
}

}
