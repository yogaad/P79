<?php

namespace Database\Seeders;
use App\Models\Desc;

use Illuminate\Database\Seeder;

class descTrxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $descs = [
            [  
                'desc' => 'Setor Tunai'
            ],
            [  
                'desc' => 'Beli Pulsa'
            ],
            [  
                'desc' => 'Bayar Listrik'
            ],
            [  
                'desc' => 'Tarik Tunai'
            ],
           
        ];


        foreach ($descs as $i => $desc) {
            $u = Desc::create([ 
                'desc' => $desc['desc'],
            ]);
        }
    }
}
