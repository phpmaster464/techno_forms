<?php
    
namespace App\Http\Controllers;
    
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
    
class CompanyController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:company-list|company-create|company-edit|company-delete', ['only' => ['index','show']]);
         $this->middleware('permission:company-create', ['only' => ['create','store']]);
         $this->middleware('permission:company-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:company-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $companies = company::latest()->paginate(5);
        $companies = company::all();

        foreach($companies as $key => $company)
        {
            
            if($company->created_by != '')
            {
               $data =  DB::table('users')
                ->select('users.id','users.name as Username','roles.name')
                ->join('model_has_roles','model_has_roles.model_id','=','users.id')
                ->join('roles','roles.id','=','model_has_roles.role_id')
                ->where('users.id',$company->created_by)
                ->get();

                 $companies[$key]->created_by = $data[0]->name.'('.$data[0]->Username.')';
            }
            else
            {
            	$companies[$key]->created_by = '';
            }

            if($company->updated_by != '')
            {
               $data =  DB::table('users')
                ->select('users.id','users.name as Username','roles.name')
                ->join('model_has_roles','model_has_roles.model_id','=','users.id')
                ->join('roles','roles.id','=','model_has_roles.role_id')
                ->Where('users.id',$company->updated_by)
                ->get();

                 $companies[$key]->updated_by = $data[0]->name.'('.$data[0]->Username.')';
            }
            else
            {
            	$companies[$key]->updated_by = '';
            }
 
        }
 
        return view('company.index',compact('companies'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
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
            'company_name' => 'required',
            'company_primary_email' => 'required|unique:company_data,company_primary_email',
            'company_secondary_email' => 'nullable|unique:company_data,company_secondary_email',
            'company_contact_number' => 'required|unique:company_data,company_contact_number', 
        ]);
 
 
        $company_logo = '';
        if ($request->hasFile('company_logo')) {
            $image=$request->file('company_logo');
            $destination_path = 'uploads/company_logo/'; 
            $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

            $image->move($destination_path, $filename);
            $company_logo = $destination_path . $filename;
        }

        $userId = Auth::id();

        $input = $request->all();
        $input['created_by'] = $userId;
        if($company_logo != '')
        {
            $input['company_logo'] = $company_logo;
        }

        $count = company::count();
        $id = 1;
        if($count >= 1)
        {
        	$id = company::max('company_code');
        	$id = str_replace('TECHNO', '', $id);
        }
         

       
        
        $exportId = sprintf('%05d',$id);
        if($id >= 1)
        {
        	$exportId++;
        }
        

        $exportId = sprintf('%05d',$exportId);
        
       $code = 'TECHNO'.$exportId;

       $input['company_code'] = $code;
       
    
        company::create($input);

        $user_input =  array('name'=>$request->company_name,'email'=>$request->company_primary_email); 

        $this->send_company_email($user_input);


    
        return redirect()->route('company.index')
                        ->with('success','company created successfully.');
    } 
    
    /**
     * Display the specified resource.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(company $company)
    {
        return view('company.show',compact('company'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(company $company)
    {
        return view('company.edit',compact('company'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, company $company)
    {

         request()->validate([
            'company_name' => 'required',
            'company_primary_email' => 'required',
        ]);

         $company_logo = '';
        if ($request->hasFile('company_logo')) {
            $image=$request->file('company_logo');
            $destination_path = 'uploads/company_logo/'; 
            $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

            $image->move($destination_path, $filename);
            $company_logo = $destination_path . $filename;
        }

        $input = $request->all();

        if($company_logo != '')
        {
            $input['company_logo'] = $company_logo;
        }
        else
        {
            unset($input['company_logo']);
        }

        $userId = Auth::id();

        $input['updated_by'] = $userId;
    
        // $company->update($request->all());
        $company->update($input); 
    
        return redirect()->route('company.index')
                        ->with('success','company updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(company $company)
    {
        // $company->delete();

        echo "<pre>";
        print_r($company);
        echo "</pre>";
        exit();

        $input['company_status'] = 1;
    
        return redirect()->route('company.index')
                        ->with('success','company deleted successfully');
    }

    public function change_status(Request $request)
    {
       $company = company::where('id',$request['id'])->select('company_status')->first();
       $status = ($company->company_status == 1) ? 0 : 1;
       company::where('id',$request['id'])->update(['company_status'=>$status]); 
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