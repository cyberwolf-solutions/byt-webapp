<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = ['title', 'description', 'start', 'end' ,'created_by',
    'updated_by',
    'deleted_by',];
}
