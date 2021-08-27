<?php
    
namespace App\Http\Controllers;
    
use App\Models\Jobs;
use App\Models\Panels;
use App\Models\Inverter;
use App\Models\PanelSerials;
use App\Models\InvetrerSerials;
use Illuminate\Http\Request;
use Auth;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
    
class JobController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:job-list|job-create|job-edit|job-delete', ['only' => ['index','show']]);
         $this->middleware('permission:job-create', ['only' => ['create','store']]);
         $this->middleware('permission:job-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:job-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Jobs::all();

        foreach($jobs as $key => $job)
        {
            
            if($job->created_by != '')
            {
               $data =  DB::table('users')
                ->select('users.id','users.name as Username','roles.name')
                ->join('model_has_roles','model_has_roles.model_id','=','users.id')
                ->join('roles','roles.id','=','model_has_roles.role_id')
                ->where('users.id',$job->created_by)
                ->get();

                 $jobs[$key]->created_by = $data[0]->name.'('.$data[0]->Username.')';
            }
            else
            {
            	$jobs[$key]->created_by = '';
            }

            if($job->updated_by != '')
            {
               $data =  DB::table('users')
                ->select('users.id','users.name as Username','roles.name')
                ->join('model_has_roles','model_has_roles.model_id','=','users.id')
                ->join('roles','roles.id','=','model_has_roles.role_id')
                ->Where('users.id',$job->updated_by)
                ->get();

                 $jobs[$key]->updated_by = $data[0]->name.'('.$data[0]->Username.')';
            }
            else
            {
            	$jobs[$key]->updated_by = '';
            }
 
        }
 
        return view('job.index',compact('jobs'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
            
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $unit_type =  DB::table('unit_types')->get()->toArray();
          $street_types =  DB::table('street_types')->get()->toArray();
		 // $installers =  DB::table('installers')->get()->toArray();
		 //$installers =  DB::select("SELECT id,first_name ,`installer_job_type` FROM `installers`");
		 
		  $installers = DB::table('installers')->where('installer_job_type', 'like', '%Installer%')->get()->toArray();
		   $Electricians= DB::table('installers')->where('installer_job_type', 'like', '%Electrician%')->get()->toArray();
		   $Designers = DB::table('installers')->where('installer_job_type', 'like', '%Designer%')->get()->toArray();
		  
		  
		
          return view('job.create',compact('unit_type','street_types','installers','Electricians','Designers'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        request()->validate([
            'job_type' => 'required',
            'reference_number' => 'required',
            'owner_type' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'owner_postal_address_type' => 'required',
            'owner_unit_type' => 'required',
            'company_abn' => 'required',
            'organisation_name' => 'required',
            'owner_street_number' => 'required',
            'owner_street_name' => 'required', 
            'owner_street_type' => 'required', 
            'owner_town' => 'required', 
            'owner_state' => 'required', 
            'owner_post_code' => 'required',
            'installation_postal_address_type' => 'required',
            'installation_unit_type' => '',
            'installation_street_number' => 'required', 
            'installation_street_name' => 'required', 
            'installation_street_type' => 'required', 
            'installation_town' => 'required',
            'installation_state' =>  'required',
            'installation_post_code' => 'required'
        ]);
		
 
        $userId = Auth::id();

        $input = $request->all();
		/*echo "<pre>";
		print_r($input);
		echo "</pre>";
		exit;*/
        $input['created_by'] = $userId;        
        $job_data = Jobs::create($input);		
	    $job_id=$job_data->id;	
		//$input = $request->all();
	
		if(isset($input['install_date'])){
for($i=0; $i<count($input['install_date']); $i++)
{
    $Panels= new Panels;
    $Panels->install_date= $input['install_date'][$i];
    //$Panels->total_no_solar_panel= $input['total_no_solar_panel'][$i];
	$Panels->Panels_Brand= $input['Panels_Brand'][$i];
	$Panels->Panels_Model= $input['Panels_Model'][$i];
	$Panels->enter_no_of_solar_panal= $input['enter_no_of_solar_panal'][$i];
	$Panels->added_by= $userId;
	$Panels->status= '1';
	$Panels->job_id=$job_id;	
    $Panels->save();
}

		}
			if(isset($input['inverter_Quick_Search'])){	
for($i=0; $i<count($input['inverter_Quick_Search']); $i++)
{
    $Inverter= new Inverter;
    $Inverter->inverter_Quick_Search_date= $input['inverter_Quick_Search'][$i];
    $Inverter->inverter_Brand= $input['inverter_Brand'][$i];
	$Inverter->inverter_Series= $input['inverter_Series'][$i];
	$Inverter->inverter_Model= $input['inverter_Model'][$i];
	$Inverter->Enter_number_of_inverter= $input['Enter_number_of_inverter'][$i];
	$Inverter->added_by= $userId;
	$Inverter->status= '1';
	$Inverter->job_id=$job_id;	
    $Inverter->save();
}
			}

								
    
        return redirect()->route('job.index')
                        ->with('success','Job Created Successfully.');
    } 
    
    /** 
     * Display the specified resource.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Jobs $job)
    {
        return view('job.show');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Jobs $job)
    {

        /*$unit_type =  DB::table('unit_types')->get()->toArray();
        $street_types =  DB::table('street_types')->get()->toArray();
        $installers = DB::table('installers')->where('installer_job_type', 'like', '%Installer%')->get()->toArray();
        $Electricians= DB::table('installers')->where('installer_job_type', 'like', '%Electrician%')->get()->toArray();
        $Designers = DB::table('installers')->where('installer_job_type', 'like', '%Designer%')->get()->toArray();
		$panels = DB::table('tbl_panels')->where('job_id',$job['id'])->get()->toArray();	
		$balance = DB::table('tbl_panels')->where('job_id' ,$job['id'])->sum('enter_no_of_solar_panal');	
        $inverters = DB::table('tbl_inverters')->where('job_id',$job['id'])->get()->toArray();		 
        $Enter_number_of_inverter = DB::table('tbl_inverters')->where('job_id' ,$job['id'])->sum('Enter_number_of_inverter');
		$panel_serial_numbers = DB::table('panel_serial_numbers')->where('job_id' ,$job['id'])->get()->toArray();
		
		$panels = DB::table('tbl_panels')->where('job_id',$job['id'])->get()->toArray();	
		$balance = DB::table('tbl_panels')->where('job_id' ,$job['id'])->sum('enter_no_of_solar_panal');
		
		foreach ($panels as $key => $value) {
      $panel_id = $value->id;
      $job_id = $value->job_id;
      $panel_serial_numbers = DB::table('panel_serial_numbers')->where('panel_id',$panel_id)->where('job_id',$job_id)->first();
      $panels[$key]->panel_serial_no = $panel_serial_numbers->Panel_Serial_Numbers;

     }*/
	 
  

		$unit_type =  DB::table('unit_types')->get()->toArray();
        $street_types =  DB::table('street_types')->get()->toArray();
        $installers = DB::table('installers')->where('installer_job_type', 'like', '%Installer%')->get()->toArray();
        $Electricians= DB::table('installers')->where('installer_job_type', 'like', '%Electrician%')->get()->toArray();
        $Designers = DB::table('installers')->where('installer_job_type', 'like', '%Designer%')->get()->toArray();
		$panels = DB::table('tbl_panels')->where('job_id',$job['id'])->get()->toArray();	
		$balance = DB::table('tbl_panels')->where('job_id' ,$job['id'])->sum('enter_no_of_solar_panal');
		

		$panel_fields = array();
		$i= 0;
		$j = 0;
		$count = 0;
		foreach ($panels as $key => $value) {
			
			$panel_id = $value->id;
		  	$job_id = $value->job_id;
		  		$panel_fields[$key][$i] = '';
		  		
		  		$panel_serial_numbers = DB::table('panel_serial_numbers')->where('panel_id',$panel_id)->where('job_id',$job_id)->get();
		  		for($p=0;$p<$value->enter_no_of_solar_panal;$p++)
		  		{
		  			$panel_fields[$key][$p] = isset($panel_serial_numbers[$p]->Panel_Serial_Numbers)?$panel_serial_numbers[$p]->Panel_Serial_Numbers : '';

		  		}	
		  		$panels[$key]->panel_serial_no = $panel_fields[$key];
		  		$i= 0;
		  		$j = 0;
		  	}

		  
			
        $inverters = DB::table('tbl_inverters')->where('job_id',$job['id'])->get()->toArray();		 
        $Enter_number_of_inverter = DB::table('tbl_inverters')->where('job_id' ,$job['id'])->sum('Enter_number_of_inverter');


        $inverter_fields = array();
		$i= 0;
		$j = 0;

			foreach ($inverters as $key => $value) {
			
			$inverter_id = $value->id;
		  	$job_id = $value->job_id;
		  		$inverter_fields[$key][$i] = '';
		  		
		  		$invetrers_serial_numbers = DB::table('invetrers_serial_numbers')->where('inverter_id',$inverter_id)->where('job_id',$job_id)->get();
		  		for($p=0;$p<$value->Enter_number_of_inverter;$p++)
		  		{	
		  			
		  			$inverter_fields[$key][$p] = isset($invetrers_serial_numbers[$p]->Invetrers_Serial_Numbers)?$invetrers_serial_numbers[$p]->Invetrers_Serial_Numbers : '';
		  		}	
		  		$inverters[$key]->inverter_serial_no = $inverter_fields[$key];
		  		$i= 0;
		  		$j = 0;
		  	}

		   
     return view('job.edit',compact('unit_type','street_types','job','installers','Electricians','Designers','panels','inverters'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jobs $job)
    {    	



            if(isset($request['same_as_owner_address']))
            {
                $request['same_as_owner_address'] = "1";
            }
            else
            {
                $request['same_as_owner_address'] = "0";
            }

           
           request()->validate([
            'job_type' => 'required',
            'reference_number' => 'required',
            'owner_type' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'owner_postal_address_type' => 'required',
            'owner_unit_type' => 'required',
            'company_abn' => 'required',
            'organisation_name' => 'required',
            'owner_street_number' => 'required',
            'owner_street_name' => 'required', 
            'owner_street_type' => 'required', 
            'owner_town' => 'required', 
            'owner_state' => 'required', 
            'owner_post_code' => 'required',
            'installation_postal_address_type' => 'required',
            'installation_unit_type' => '',
            'installation_street_number' => 'required', 
            'installation_street_name' => 'required', 
            'installation_street_type' => 'required', 
            'installation_town' => 'required',
            'installation_state' =>  'required',
            'installation_post_code' => 'required'
        ]);
        

        $input = $request->all();

        $userId = Auth::id();

        $input['updated_by'] = $userId;
        $job->update($input); 
		$job_id=$job->id;
		/*echo "<pre>";
		print_r($input);exit;
		echo "</pre>";*/


		if(isset($input['install_date']))
        {       
                $Panels=Panels::where('job_id',$job['id'])->delete();
                for($i=0; $i<count($input['install_date']); $i++)
                {
                    $Panels= new Panels;
                    $Panels->install_date= $input['install_date'][$i];
                   // $Panels->total_no_solar_panel= $input['total_no_solar_panel'][$i];
                    $Panels->Panels_Brand= $input['Panels_Brand'][$i];
                    $Panels->Panels_Model= $input['Panels_Model'][$i];
                    $Panels->enter_no_of_solar_panal= $input['enter_no_of_solar_panal'][$i];
                    $Panels->added_by= $userId;
                    $Panels->status= '1';
                    $Panels->job_id=$job_id;  

                   
                   
                    

                   $Panels->save();
					
					$Panels_id=$Panels->id;
                            if(isset($input['Panel_Serial_Numbers'][$i]))
                            {       
                                   //$Panels=PanelSerials::where('job_id',$job['id'])->where('panel_id',$Panels_id)->delete();
                                    for($j=0; $j<count($input['Panel_Serial_Numbers'][$i]); $j++)
                                    {
                                        $PanelSerials= new PanelSerials;
                                        $PanelSerials->panel_id= $Panels_id;
                                        $PanelSerials->job_id=$job_id;
                                        $PanelSerials->Panel_Serial_Numbers= $input['Panel_Serial_Numbers'][$i][$j];
                                        $PanelSerials->created_by= $userId;
                                        $PanelSerials->status= '1';
                                       $PanelSerials->save(); 
                                    }
                                    
                            }else{
                                //$Panels=PanelSerials::where('job_id',$job['id'])->where('panel_id',$Panels_id)->delete();
                            }

                    $Panels_id='';
                }
				
        }else{
           // $Panels=Panels::where('job_id',$job['id'])->delete();
        }
 
    
	if(isset($input['inverter_Quick_Search']))
    {   

            $Inverter_res=Inverter::where('job_id',$job['id'])->delete();
            for($i=0; $i<count($input['inverter_Quick_Search']); $i++)
            {
                $Inverter= new Inverter;
                $Inverter->inverter_Quick_Search_date= $input['inverter_Quick_Search'][$i];
                $Inverter->inverter_Brand= $input['inverter_Brand'][$i];
                $Inverter->inverter_Series= $input['inverter_Series'][$i];
                $Inverter->inverter_Model= $input['inverter_Model'][$i];
                $Inverter->Enter_number_of_inverter= $input['Enter_number_of_inverter'][$i];
                $Inverter->added_by= $userId;
                $Inverter->status= '1';
                $Inverter->job_id=$job_id;  
                $Inverter->save();          
           

           

					$Inverter_id=$Inverter->id;

					

					if(isset($input['Invetrers_Serial_Numbers'][$i]))
					{       
							$InverterSerials=InvetrerSerials::where('job_id',$job['id'])->where('inverter_id',$Inverter_id)->delete();
							for($j=0; $j<count($input['Invetrers_Serial_Numbers'][$i]); $j++)
							{
								

								$InverterSerials= new InvetrerSerials;
								$InverterSerials->inverter_id= $Inverter_id;
								$InverterSerials->job_id=$job_id;
								$InverterSerials->Invetrers_Serial_Numbers= $input['Invetrers_Serial_Numbers'][$i][$j];
								$InverterSerials->created_by= $userId;
								$InverterSerials->status= '1';
								$InverterSerials->save();
							}
						}		
					else{
						//$InverterSerials=InvetrerSerials::where('job_id',$job['id'])->where('inverter_id',$Inverter_id)->delete();
					}
$Inverter_id='';
		}	
    }else{
            //$Inverter_res=Inverter::where('job_id',$job['id'])->delete();
        }

        

        return redirect()->route('job.index')
                        ->with('success','Job Updated Successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jobs $company)
    {
        /*// $company->delete();

        echo "<pre>";
        print_r($company);
        echo "</pre>";
        exit();

        $input['company_status'] = 1;
    
        return redirect()->route('company.index')
                        ->with('success','company deleted successfully');*/
    }

    public function change_status(Request $request)
    {
       $job = Jobs::where('id',$request['id'])->select('job_status')->first();
       $status = ($job->job_status == 1) ? '0' : '1';
       Jobs::where('id',$request['id'])->update(['job_status'=>$status]); 
    }

    public function send_company_email($user_array)
    {   
       
        $roles = array('company');

        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $pass = substr(str_shuffle($chars),0,8);


        $user_array['password'] = Hash::make($pass);
        $user_array['roles'] = $roles;

        $input = $user_array;

        $user = User::create($input);
        $user->assignRole($input['roles']);
        /*Email Code */
        $data = array('name'=>$input['name'],'pass'=>$pass);
        \Mail::send('emails.newpass', $data, function($message) {
         $message->to('chirakios@gmail.com', 'Company Created')->subject
         ('Techno Forms');
         $message->from('techno@forms.com','techno forms');
     }); 

    }
	
	
	public function delete_extra_panels(Request $request){
		 $id =$request['id'];
		 $Panels=Panels::where('id',$id)->delete();
		 
		
	}
	
	public function delete_extra_inverter(Request $request){
		 $id =$request['id'];
		$Inverter_res=Inverter::where('id',$id)->delete();
		
		
		
	}
}