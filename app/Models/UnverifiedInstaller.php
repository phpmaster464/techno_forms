<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class UnverifiedInstaller extends Model
{
    use HasFactory;
  	
    /**
     * The attributes that are mass assignable.
     *  
     * @var array
     */
    protected $table = "unverified_installers";
    protected $fillable = [ 
        'first_name','last_name','email','phone','mobile','username','password','job_type','installer_job_type','companyabn','companyname','formdate','todate','companywebsite','postaladdress','address_latitude','address_longitude','unit_type','unit_number','street_number','street_name','street_type','suburb','state','postcode','cecaccnumber','licensenumber','cecdesignernumber','serole','signature','proofidentity','created_by','updated_by'
    ];
}