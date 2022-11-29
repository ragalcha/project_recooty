<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Friends;

class Customer extends Model
{
    use HasFactory;
    protected $table="customers";
    protected  $primarykey="id";
    protected $fillable = ['id', 'name', 'email', 'password','created_at', 'updated_at'];
    // public $timestamps = false;
}
