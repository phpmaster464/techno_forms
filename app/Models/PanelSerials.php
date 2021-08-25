<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanelSerials extends Model
{
    use HasFactory;
    protected $table = "Panel_Serial_Numbers";
    protected $fillable = [
        'panel_id',
        'job_id',
        'Panel_Serial_Numbers',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
        
    ];
}
