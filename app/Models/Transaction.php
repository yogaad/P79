<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'accountId',
        'transactionDate',
        'description',
        'debitCreditStatus',
        'amount',
        
    ];
    public function account()
    {
        return $this->belongsTo(Account::class,'accountId');
    }

    public function descx()
    {
        return $this->belongsTo(Desc::class,'description');
    }
    public function debitx()
    {
        return $this->belongsTo(Debit::class,'debitCreditStatus');
    }
}
