<?php

namespace Database\Seeders;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trans = [
            [  
                'accountId' => '1',
                'transactionDate' => '2022-06-01',
                'description' => '1',
                'debitCreditStatus' => '2',
                'amount' => '200000',
            ],
            [  
                'accountId' => '1',
                'transactionDate' => '2022-06-05',
                'description' => '2',
                'debitCreditStatus' => '1',
                'amount' => '10000',
            ],
            [  
                'accountId' => '1',
                'transactionDate' => '2022-06-06',
                'description' => '3',
                'debitCreditStatus' => '1',
                'amount' => '70000',
            ],
            [  
                'accountId' => '1',
                'transactionDate' => '2022-06-07',
                'description' => '4',
                'debitCreditStatus' => '1',
                'amount' => '100000',
            ],
            
             
           
        ];
    
    
        foreach ($trans as $i => $tran) {
            $u = transaction::create([ 
                'accountId' => $tran['accountId'],
                'transactionDate' => $tran['transactionDate'],
                'description' => $tran['description'],
                'debitCreditStatus' => $tran['debitCreditStatus'],
                'amount' => $tran['amount'],
            ]);
        }
    }
}
