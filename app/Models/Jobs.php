<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *  
     * @var array
     */
    protected $table = "jobs";
    protected $fillable = [
        'job_type',
        'reference_number',
        'job_stage',
        'title',
        'installation_date',
        'priority',
        'description',
        'owner_type',
        'company_abn',
        'organisation_name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'mobile',
        'address_latitude',
        'address_longitude',
        'owner_postal_address_type',
        'owner_unit_type',
        'owner_unit_number',
        'owner_street_number',
        'owner_street_name',
        'owner_street_type',
        'owner_town',
        'owner_state',
        'owner_post_code',
        'same_as_owner_address',
        'installation_postal_address_type',
        'installation_unit_type',
        'installation_unit_number',
        'installation_street_number',
        'installation_street_name',
        'installation_street_type',
        'installation_town',
        'installation_state',
        'installation_post_code',
        'nmi',
        'grid_appication_reference_number',
        'additional_installation_information',
        'job_status',        
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'installation_image',
        'installer_signature',
        'designer_signature',
        'electrician_signature',
        'owner_signature',
		'Rated_Power_Output',
		'Deeming_Period',
        'owner_meter_number',
        'meter_no',
        'distributor',
        'story_type',
        'property_type',
        'replacing_panels',
        'Additionalpanels',
        'system_installed',
		'installer_type','Designer_type','Installer_state','Electrician',
        'address_latitude',
        'address_longitude'
		
    ];
	
	
}