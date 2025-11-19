<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'bank_accounts';
    
    protected $fillable = [
        'account_name',
        'account_number',
        'bank_name',
        'coa_id', 
        'opening_balance',
        'created_at',
        'updated_at',
        
    ];

    public function coa()
    {
        return $this->belongsTo(ChartOfAccounts::class, 'coa_id', 'id');
    }
}
