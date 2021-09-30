<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class  Pmodel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *  
     * @var array
     */
    protected $table = "model";
    protected $fillable = ['id','model_name','manufacturer_id','panel_serial_number_scanned','status','created_at','updated_at' 
    ]; 
}