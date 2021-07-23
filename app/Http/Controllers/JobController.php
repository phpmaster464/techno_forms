<?php
    
namespace App\Http\Controllers;
    
use App\Models\Jobs;
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
          return view('job.create',compact('unit_type','street_types'));
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
            'installation_unit_type' => 'required',
            'installation_street_number' => 'required', 
            'installation_street_name' => 'required', 
            'installation_street_type' => 'required', 
            'installation_town' => 'required',
            'installation_state' =>  'required',
            'installation_post_code' => 'required'
        ]);
 
        $userId = Auth::id();

        $input = $request->all();
        $input['created_by'] = $userId;
        
        $job_data = Jobs::create($input);

     /*   $jobs_input =  array('name'=>$request->company_name,'email'=>$request->company_primary_email); 

        $this->send_company_email($user_input);*/
    
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
        $unit_type =  DB::table('unit_types')->get()->toArray();
        $street_types =  DB::table('street_types')->get()->toArray();
        return view('job.edit',compact('unit_type','street_types','job'));
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
            'installation_unit_type' => 'required',
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
    
        // $company->update($request->all());
        $job->update($input); 
    
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
}