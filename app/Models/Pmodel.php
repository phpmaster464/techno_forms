<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pmodel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *  
     * @var array
     */
    protected $table = "model";
    protected $fillable = ['id','model_name','manufacturer_id','status','created_at','updated_at','created_by','updated_by'];
}