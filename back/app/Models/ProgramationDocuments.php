<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramationDocuments extends Model
{
    use HasFactory;

    protected $fillable = [
        'programation_id', 
        'documents_id',
    ];
}
