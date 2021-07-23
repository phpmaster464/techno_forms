<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Installer extends Model
{
    use HasFactory;
  	
    /**
     * The attributes that are mass assignable.
     *  
     * @var array
     */
    protected $table = "installers";
    protected $fillable = [
        'first_name','last_name','email','mobile','phone','address_type','unit_type','unit_number','street_number','street_name','street_type','postal_delivery_type','postal_delivery_number','suburb','state','postcode','installer_logo','installer_photo','installer_license_photo','job_type','installer_job_type','installer_status','created_by','updated_by'

    ];
}