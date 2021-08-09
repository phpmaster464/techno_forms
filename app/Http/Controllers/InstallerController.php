<?php
    
namespace App\Http\Controllers;
    
use App\Models\Installer;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
    
class InstallerController extends Controller
{  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:installer-list|installer-create|installer-edit|installer-delete', ['only' => ['index','show']]);
         $this->middleware('permission:installer-create', ['only' => ['create','store']]);
         $this->middleware('permission:installer-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:installer-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $companies = Installer::latest()->paginate(5);
        $installers = Installer::all();

        foreach($installers as $key => $installer)
        {
            
            if($installer->created_by != '')
            {
               $data =  DB::table('users')
                ->select('users.id','users.name as Username','roles.name')
                ->join('model_has_roles','model_has_roles.model_id','=','users.id')
                ->join('roles','roles.id','=','model_has_roles.role_id')
                ->where('users.id',$installer->created_by)
                ->get();

                 $installers[$key]->created_by = $data[0]->name.'('.$data[0]->Username.')';
            }
            else
            {
            	$installers[$key]->created_by = '';
            }

            if($installer->updated_by != '')
            {
               $data =  DB::table('users')
                ->select('users.id','users.name as Username','roles.name')
                ->join('model_has_roles','model_has_roles.model_id','=','users.id')
                ->join('roles','roles.id','=','model_has_roles.role_id')
                ->Where('users.id',$installer->updated_by)
                ->get();

                 $installers[$key]->updated_by = $data[0]->name.'('.$data[0]->Username.')';
            }
            else
            {
            	$installers[$key]->updated_by = '';
            }
 
        }
 
        return view('installer.index',compact('installers'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$unit_types = DB::table('unit_types')->get()->toArray();
    	$street_types = DB::table('street_types')->get()->toArray();
    	$states = DB::table('au_states')->get()->toArray();
        return view('installer.create',compact('unit_types','street_types','states'));
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:installers,email',
            'mobile' => 'required|unique:installers,mobile', 
            'phone' => 'required|unique:installers,phone',
            'checkbox' =>'accepted' 
        ]);
 
 
        $installer_logo = '';
        if ($request->hasFile('installer_logo')) {
            $image=$request->file('installer_logo');
            $destination_path = 'uploads/installer/logo/'; 
            $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

            $image->move($destination_path, $filename);
            $installer_logo = $destination_path . $filename;
        } 

         $installer_photo = '';
        if ($request->hasFile('installer_photo')) {
            $image=$request->file('installer_photo');
            $destination_path = 'uploads/installer/photo/'; 
            $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

            $image->move($destination_path, $filename);
            $installer_photo = $destination_path . $filename;
        }

        $installer_license = '';
        if ($request->hasFile('installer_license_photo')) {
            $image=$request->file('installer_license_photo');
            $destination_path = 'uploads/installer/license/'; 
            $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

            $image->move($destination_path, $filename);
            $installer_license = $destination_path . $filename;
        }

        $userId = Auth::id();

        $input = $request->all();

        if(isset($input['jtype']) && $input['jtype'] != '')
        {
        	$jtype = json_encode($input['jtype']);
        	$input['job_type'] = $jtype;
        }

        if(isset($input['type']) && $input['type'] != '')
        {
        	$type = json_encode($input['type']);
        	$input['installer_job_type'] = $type;
        }


        $input['created_by'] = $userId;
        if($installer_logo != '')
        {
            $input['installer_logo'] = $installer_logo;
        }
        if($installer_photo != '')
        {
            $input['installer_photo'] = $installer_photo;
        }
        if($installer_license != '')
        {
            $input['installer_license_photo'] = $installer_license;
        }

        
        Installer::create($input);

        $user_input =  array('name'=>$request->first_name.''.$request->last_name,'email'=>$request->email); 


        $this->send_installer_email($user_input);


    
        return redirect()->route('installer.index')
                        ->with('success','Installer created successfully.');
    } 
    
    /**
     * Display the specified resource.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(installer $installer)
    {
        return view('installer.show',compact('installer'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(installer $installer)
    {	
    	$unit_types = DB::table('unit_types')->get()->toArray();
    	$street_types = DB::table('street_types')->get()->toArray();
    	$states = DB::table('au_states')->get()->toArray();
        return view('installer.edit',compact('installer','unit_types','street_types','states'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, installer $installer)
    {

               request()->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                // 'email' => 'required|unique:installers,email',
                // 'mobile' => 'required|unique:installers,mobile', 
                // 'phone' => 'required|unique:installers,phone', 
            ]);

         $installer_logo = '';
        if ($request->hasFile('installer_logo')) {
            $image=$request->file('installer_logo');
            $destination_path = 'uploads/installer/logo'; 
            $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

            $image->move($destination_path, $filename);
            $installer_logo = $destination_path . $filename;
        }

         $installer_photo = '';
        if ($request->hasFile('installer_photo')) {
            $image=$request->file('installer_photo');
            $destination_path = 'uploads/installer/photo'; 
            $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

            $image->move($destination_path, $filename);
            $installer_photo = $destination_path . $filename;
        }

        $installer_license = '';
        if ($request->hasFile('installer_license')) {
            $image=$request->file('installer_license');
            $destination_path = 'uploads/installer/licence'; 
            $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

            $image->move($destination_path, $filename);
            $installer_license = $destination_path . $filename;
        }
        $input = $request->all();

        if(isset($input['jtype']) && $input['jtype'] != '')
        {
        	$jtype = json_encode($input['jtype']);
        	$input['job_type'] = $jtype;
        }

        if(isset($input['type']) && $input['type'] != '')
        {
        	$type = json_encode($input['type']);
        	$input['installer_job_type'] = $type; 
        }

        if($installer_logo != '')
        {
            $input['installer_logo'] = $installer_logo;
        }
        if($installer_photo != '')
        {
            $input['installer_photo'] = $installer_photo;
        }
        if($installer_license != '')
        {
            $input['installer_license_photo'] = $installer_license;
        }


        $userId = Auth::id();

        $input['updated_by'] = $userId;
    
        // $company->update($request->all());
        $installer->update($input); 
    
        return redirect()->route('installer.index')
                        ->with('success','Installer updated successfully');
    } 
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(installer $installer)
    {
        // $company->delete();

        echo "<pre>";
        print_r($company);
        echo "</pre>";
        exit();

        $input['company_status'] = 1;
    
        return redirect()->route('installer.index')
                        ->with('success','company deleted successfully');
    }

    public function change_status(Request $request)
    {
       $installer = Installer::where('id',$request['id'])->select('installer_status')->first();
       $status = ($installer->installer_status == 1) ? 0 : 1;
       Installer::where('id',$request['id'])->update(['installer_status'=>$status]); 
    }

    public function send_installer_email($user_array)
    {   
       
        $roles = array('Installer');

        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $pass = substr(str_shuffle($chars),0,8);


        $user_array['password'] = Hash::make($pass);
        $user_array['roles'] = $roles;

        $input = $user_array;

        $user = User::create($input);
        $user->assignRole($input['roles']);

        $email = $user_array['email'];
        /*Email Code */
        $data = array('name'=>$input['name'],'pass'=>$pass);
        \Mail::send('emails.newpass', $data, function ($message) use ($email)  {
           $message->to($email, 'Installer Created')->subject
           ('Techno Forms');
           $message->from('techno@forms.com','techno forms');
       });

    }
}