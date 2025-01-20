<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expencestype extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'expencestypes';
    protected $fillable = [
        'type',
        'created_by',
        'updated_by',
        'deleted_by',
        
    ];
}
