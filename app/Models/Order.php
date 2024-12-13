<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model {
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'customer_id',
        'hours',
        'fee',
        'note',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function customer() {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }
    public function user() {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
