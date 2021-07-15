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
        'company_code','company_name', 'company_logo','company_primary_email','company_secondary_email','company_contact_number','company_website','company_description','company_status','created_by','updated_by'
    ];
}