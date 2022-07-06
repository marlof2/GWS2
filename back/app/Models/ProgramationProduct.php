<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramationProduct extends Model
{
    use HasFactory;

    protected $table = 'programation_products';

    protected $fillable = [
        'programation_id',
        'product_id',
        'quantidade'
    ];

}
