<?php
    
namespace App\Http\Controllers;
    
use App\Models\Inventory;
use App\Models\Manufacturer;
use App\Models\Pmodel;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Auth;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
    
class InventoryController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         /*$this->middleware('permission:job-list|job-create|job-edit|job-delete', ['only' => ['index','show']]);
         $this->middleware('permission:job-create', ['only' => ['create','store']]);
         $this->middleware('permission:job-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:job-delete', ['only' => ['destroy']]);*/
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventory = Inventory::all();

            foreach ($inventory as $key => $value) {

               $manufacturer = Manufacturer::where('id',$value->manufacturer_id)->select('manufacturer_name')->get();
               $model = Pmodel::where('id',$value->model_id)->select('model_name')->get();
               $supplier = Supplier::where('id',$value->supplier_id)->select('supplier_name')->get();
               $inventory[$key]['Manufacturer'] = $manufacturer[0]->manufacturer_name;
               $inventory[$key]['Model'] = $model[0]->model_name;
               $inventory[$key]['Supplier'] = $supplier[0]->supplier_name;

            }

            $inventories = $inventory;

        return view('inventory.index',compact('inventories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
            
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {                 
          //$model =  DB::table('model')->get()->toArray();
          //$supplier =  DB::table('supplier')->get()->toArray();
          $manufacturer =  DB::table('manufacturer')->where('status',1)->get()->toArray();
          return view('inventory.create',compact('manufacturer'));
    }


    public function model($id) 
    {
        $model = Pmodel::where("manufacturer_id",$id)
                    ->where("status",1)
                    ->select("model_name","id")->get();
         $html = "<select class='form-control' id='select_model' name='model_id' onchange='fetch_supplier($(this).val());'><option>Select Model</option>";  
         foreach ($model as $key => $value) { 
            $html .= "<option value=".$value->id.">".$value->model_name."</option>";
        }
        $html .= '</select>';  
        echo  json_encode($html);  
    }

    public function supplier($id) 
    {
        $model = Supplier::where("model_id",$id)
        ->where("status",1)
        ->select("supplier_name","id")->get();
        $html = "<select class='form-control' id='select_supplier' name='supplier_id'><option>Select Supplier</option>";   
        foreach ($model as $key => $value) {
            $html .= "<option value=".$value->id.">".$value->supplier_name."</option>";
        }
        $html .= '</select>';  
        echo  json_encode($html);  
    }



    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   



       /* request()->validate([
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
        ]);*/
 
        $userId = Auth::id();

        $input = $request->all(); 
        $input['created_by'] = $userId;
        
        $inventory = Inventory::create($input);
    
        return redirect()->route('inventory.index')
                        ->with('success','Inventory Created Successfully.');
    } 
    
    /** 
     * Display the specified resource.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $job)
    {
        return view('inventory.show');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        
        $manufacturer =  DB::table('manufacturer')->where('status',1)->get()->toArray();
        $models =  DB::table('model')->where('manufacturer_id',$inventory->manufacturer_id)->where('status',1)->get()->toArray();
        $suppliers =  DB::table('supplier')->where('model_id',$inventory->model_id)->where('status',1)->get()->toArray();

        return view('inventory.edit',compact('manufacturer','models','suppliers','inventory')); 
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {       

        $input = $request->all();

        $userId = Auth::id();

        $input['updated_by'] = $userId;
    
        $inventory->update($input); 
    
        return redirect()->route('inventory.index')
                        ->with('success','Job Updated Successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $company)
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
       $job = Inventory::where('id',$request['id'])->select('job_status')->first();
       $status = ($job->job_status == 1) ? '0' : '1';
       Inventory::where('id',$request['id'])->update(['job_status'=>$status]); 
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