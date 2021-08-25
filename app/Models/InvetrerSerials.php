<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvetrerSerials extends Model
{
    use HasFactory;

     protected $table = "invetrers_serial_numbers";
        protected $fillable = [
        'panel_id',
        'job_id',
        'invetrers_serial_numbers',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
        
    ];
}
