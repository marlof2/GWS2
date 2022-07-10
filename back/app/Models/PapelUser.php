<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PapelUser extends Model
{
    use HasFactory;

    protected $table = 'papel_users';

    protected $fillable = ['papel_id', 'user_id'];
}
