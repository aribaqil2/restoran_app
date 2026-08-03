<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\Factories\HasFactory;

class Table extends Model
{
   use HasFactory;

    protected $fillable = ['number', 'qr_code_path'];
}
