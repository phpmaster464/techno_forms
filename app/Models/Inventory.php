<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *  
     * @var array
     */
    protected $table = "inventory";
    protected $fillable = ['id','manufacturer_id','model_id','supplier_id','pallet_number','unverified_panel_serials','wattage','created_at','updated_at'
    ];
}