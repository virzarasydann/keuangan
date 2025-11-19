<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChartOfAccounts extends Model
{
    

    protected $table = 'chart_of_accounts';
    
    protected $fillable = [
        'code',
        'name',
        'type',
        'description', 
        'created_at',
        'updated_at',
        
    ];

    
}
