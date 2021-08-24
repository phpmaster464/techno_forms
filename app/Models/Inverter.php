<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inverter extends Model
{
    use HasFactory;
	protected $table = "tbl_inverters";
    protected $fillable = [
        'inverter_Quick_Search_date',
        'inverter_Brand',
        'inverter_Series',
        'inverter_Model',
        'Enter_number_of_inverter',
		'status',
		'created_at',
		'job_id'
    ];
}
