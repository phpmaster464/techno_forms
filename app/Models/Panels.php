<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panels extends Model
{
    use HasFactory;
	protected $table = "tbl_panels";
    protected $fillable = [
        'install_date',
        'total_no_solar_panel',
        'Panels_Brand',
        'Panels_Model',
        'enter_no_of_solar_panal',
		'status',
		'job_id'
    ];
}
