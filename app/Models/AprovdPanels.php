<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AprovdPanels extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'licenseecertificate_holder_account_account_name',
        'model_numbers',
        'cec_approved_date',
        'expiry_date',
        'fire_tested',
        'application_importerresponsible_supplier',
        'application_importerresponsible_supplier_abn',
        'application_importerresponsible_supplier_2',
        'application_importerresponsible_supplier_2_abn',
        'application_importerresponsible_supplier_3',
        'application_importerresponsible_supplier_3_abn',
        'application_importerresponsible_supplier_4',
        'application_importerresponsible_supplier_4_abn',
        'application_importerresponsible_supplier_5',
        'application_importerresponsible_supplier_5_abn',
        'application_importerresponsible_supplier_6',
        'application_importerresponsible_supplier_6_abn',
    ];

}
