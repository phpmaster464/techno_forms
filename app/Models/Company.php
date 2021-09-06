<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Company extends Model
{
    use HasFactory;
  	
    /**
     * The attributes that are mass assignable.
     *  
     * @var array
     */
    protected $table = "company_data";
    protected $fillable = [
        'company_code','company_name','company_logo','proofidentity','company_primary_email','company_secondary_email','company_contact_number','phone','username','password','job_type','installer_job_type','companyabn','companyname','fromdate','todate','company_website','company_description','postaladdress','address_latitude','address_longitude','unit_type','unit_number','street_number','street_name','street_type','suburb','state','postcode','cecaccnumber','licensenumber','cecdesignernumber','serole','company_status','created_by','updated_by'
    ];
}