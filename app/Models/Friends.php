<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Friends extends Model
{
    use HasFactory;
    protected $table="friends";
    protected  $primarykey="id";
    protected $fillable = ['id', 'user_id', 'frnd_id','created_at', 'updated_at'];
    public function friends()
    {
        return $this->belongsTo(Customer::class,'frnd_id');
    }
}
