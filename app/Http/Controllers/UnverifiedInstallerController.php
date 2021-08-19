<?php
    
namespace App\Http\Controllers;
    
use App\Models\UnverifiedInstaller;
use App\Models\Installer;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
    
class UnverifiedInstallerController extends Controller
{  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:unverifiedinstaller-list|unverifiedinstaller-create|unverifiedinstaller-edit|unverifiedinstaller-delete', ['only' => ['index','show']]);
         $this->middleware('permission:unverifiedinstaller-create', ['only' => ['create','store']]);
         $this->middleware('permission:unverifiedinstaller-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:unverifiedinstaller-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $companies = UnverifiedInstaller::latest()->paginate(5);
        $unverified_installers = UnverifiedInstaller::all();
        
 
        return view('unverified_installer.index',compact('unverified_installers'))
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

        
        UnverifiedInstaller::create($input);

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
    public function show($unverifiedinstaller)
    {
    	$unverifiedinstaller = UnverifiedInstaller::where('id',$unverifiedinstaller)->first();
        return view('unverified_installer.show',compact('unverifiedinstaller'));
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
        $unverifiedinstaller->update($input); 
    
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
       $unverifiedinstaller = UnverifiedInstaller::where('id',$request['id'])->select('first_name','last_name','email','password','verified')->first();
       $status = ($unverifiedinstaller->verified == 1) ? 0 : 1;
       UnverifiedInstaller::where('id',$request['id'])->update(['verified'=>$status]); 
       $user_input =  array('name'=>$unverifiedinstaller->first_name.''.$unverifiedinstaller->last_name,'email'=>$unverifiedinstaller->email,'password'=>$unverifiedinstaller->password); 


        $this->send_installer_email($user_input);

    }

    public function send_installer_email($user_array)
    {   

    	$unverifiedinstaller = UnverifiedInstaller::where('email',$user_array['email'])->first();

    	$installer_array = array('first_name'=>$unverifiedinstaller->first_name,'last_name'=>$unverifiedinstaller->last_name,'email'=>$unverifiedinstaller->email,'mobile'=>$unverifiedinstaller->mobile,'phone'=>$unverifiedinstaller->phone,'job_type'=>$unverifiedinstaller->job_type,'installer_job_type'=>$unverifiedinstaller->installer_job_type,'unit_type'=>$unverifiedinstaller->unit_type,'unit_number'=>$unverifiedinstaller->unit_number,'street_number'=>$unverifiedinstaller->street_number,'street_name'=>$unverifiedinstaller->street_name,'street_type'=>$unverifiedinstaller->street_type,'suburb'=>$unverifiedinstaller->suburb,'state'=>$unverifiedinstaller->state,'postcode'=>$unverifiedinstaller->postcode,'created_by'=>$unverifiedinstaller->null,'updated_by'=>$unverifiedinstaller->null,'created_at'=>$unverifiedinstaller->null,'updated_at'=>$unverifiedinstaller->null);

		Installer::create($installer_array);
        $roles = array('Installer');
        $pass = $user_array['password'];


        $user_array['password'] = Hash::make($pass);
        $user_array['roles'] = $roles;

        $input = $user_array;

        $user = User::create($input);
        $user->assignRole($input['roles']);

        /* Create Installer Code here , just get the fields array and call create function will be done*/

        $email = $user_array['email'];
        /*Email Code */
        $data = array('name'=>$input['name'],'pass'=>$pass);
        \Mail::send('emails.newpass', $data, function ($message) use ($email)  {
           $message->to($email, 'Installer Created')->subject
           ('Techno Forms');
           $message->from('techno@forms.com','techno forms');
       }); 
        

    }


    public function register_unverified_technicians()
    {
    	Auth::logout();
    	return view('unverified_installer.register');
    } 


    public function register_unverified_technicians_store(Request $request)
    {


    	

        request()->validate([
               'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:unverified_installers,email',
            'phone' => 'required|unique:unverified_installers,phone',
            'mobile' => 'required',
            'username' => 'required',
            'password' => 'required',
            'companyabn' => 'required',
            'companyname' => 'required',
            'formdate' => 'required',
            'todate' => 'required',
            'companywebsite' => 'required',
            'postaladdress' => 'required',
            'unit_type' => '',
            'unit_number' => '',
            'street_number' => 'required',
            'street_name' => 'required',
            'street_type' => 'required',
            'suburb' => 'required',
            'state' => 'required',
            'postcode' => 'required',
            'cecaccnumber' => 'required',
            'licensenumber' => 'required',
            'cecdesignernumber' => 'required',
            'serole' => 'required'
            // 'signature' => 'required',
            // 'proofidentity' => 'required' 
            ]);





        



        $signature = '';
        // if ($request->hasFile('signature')) {
        //     $image=$request->file('signature');
        //     $destination_path = 'uploads/unverified_installer/signature/'; 
        //     $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

        //     $image->move($destination_path, $filename);
        //     $signature = $destination_path . $filename;
        // }

      if(isset($request->iamgeval) && $request->iamgeval != '')
        {
            $folderPath = public_path('uploads/unverified_installer/signature/');
            $image_parts = explode(";base64,", $request->iamgeval);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $path_name = explode("/public/",$folderPath);
            $uniqid = uniqid();
            $file = $folderPath . $uniqid . '.'.$image_type;
            file_put_contents($file, $image_base64); 
            $signature = $path_name[1].$uniqid.".".$image_type;
        } 

       

        $proofidentity = '';
        if ($request->hasFile('proofidentity')) {
            $image=$request->file('proofidentity');
            $destination_path = 'uploads/unverified_installer/proof_id/'; 
            $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

            $image->move($destination_path, $filename);
            $proofidentity = $destination_path . $filename;
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
        if($signature != '')
        {
            $input['signature'] = $signature;
        }
        if($proofidentity != '')
        {
            $input['proofidentity'] = $proofidentity;
        }
        
        
            try
            {
                /*$installer = new unverified_installers;
                $installer->first_name = $data['first_name'];
                $installer->last_name = $data['last_name'];
                $installers->email = $data['email'];
                $installers->phone = $data['phone'];
                $installer->mobile = $data['mobile'];
                $installer->username = $data['username'];
                $installers->password = $data['password'];
                $installers->companyabn = $data['companyabn'];
                $installer->companyname = $data['companyname'];
                $installer->formdate = $data['formdate'];
                $installers->todate = $data['todate'];
                $installers->companywebsite = $data['companywebsite'];
                $installer->postaladdress = $data['postaladdress'];
                $installer->unit_type = $data['unit_type'];
                $installers->unit_number = $data['unit_number'];
                $installers->street_number = $data['street_number'];
                $installer->street_name = $data['street_name'];
                $installer->street_type = $data['street_type'];
                $installers->suburb = $data['suburb'];
                $installers->state = $data['state'];
                $installer->postcode = $data['postcode'];
                $installer->cecaccnumber = $data['cecaccnumber'];
                $installers->licensenumber = $data['licensenumber'];
                $installers->cecdesignernumber = $data['cecdesignernumber'];
                $installers->serole = $data['serole'];
                $installers->signature = $data['signature'];
                $installers->proofidentity = $data['proofidentity'];
                $unverified_installers->save();*/
                UnverifiedInstaller::create($input);
                return redirect('register_technician')->with('success',"Insert successfully");
            }
            catch(Exception $e)
            {
                return redirect('register_technician')->with('failed',"operation failed");
            }
        
    } 


}