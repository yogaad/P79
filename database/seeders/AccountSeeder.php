<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account;
class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accounts = [
            [  
                'name' => 'Customer1'
            ],
            [  
                'name' => 'Customer2'
            ],
           
        ];


        foreach ($accounts as $i => $account) {
            $u = Account::create([ 
                'name' => $account['name'],
            ]);
        }
    }
}
