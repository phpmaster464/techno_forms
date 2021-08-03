<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use App\Models\Pmodel;
use Spatie\Permission\Models\Permission;
use DB;
use Auth;



class ModelController extends Controller
{
    
    function __construct()
    {
         $this->middleware('permission:model-list|model-create|model-edit|model-delete', ['only' => ['index','store']]);
         $this->middleware('permission:model-create', ['only' => ['create','store']]);
         $this->middleware('permission:model-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:model-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        
        $model = Pmodel::all();
   
        foreach ($model as $key => $value) {
			
			$manufacturer = Manufacturer::where('id',$value->manufacturer_id)->select('manufacturer_name')->get();
              
               $model[$key]['manufacturer_name'] = $manufacturer[0]->manufacturer_name;
            

            }
            $model = $model;
            return view('model.index',compact('model'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

	
	public function create()
    {                 
          //$model =  DB::table('model')->get()->toArray();
          //$supplier =  DB::table('supplier')->get()->toArray();
         // $manufacturer =  DB::table('manufacturer')->where('status',1)->get()->toArray();
		  $manufacturer =  DB::table('manufacturer')->where('status',1)->get()->toArray();
          return view('model.create',compact('manufacturer'));
    }
	public function store(Request $request)
    {   
	
        request()->validate([
            'manufacturer_id' => 'required',
            'model_name' => 'required|unique:model,model_name',                     
        ]);
 
       $model = Pmodel::create(
	   ['manufacturer_id' => $request->input('manufacturer_id'),
	   'model_name' => $request->input('model_name'),
	   'status' => $request->input('status'),
	   'created_by'=>Auth::id()]);
    
    
        return redirect()->route('model.index')
                        ->with('success','Model Created Successfully.');
    } 
	
	 public function edit(Pmodel $model)
    {
       //$model =  DB::table('model')->where('status',1)->get()->toArray();
        //$manufacturer =  DB::table('manufacturer')->where('id',$model->manufacturer_id)->where('status',1)->get()->toArray();
		  $manufacturer =  DB::table('manufacturer')->where('status',1)->get()->toArray();

        return view('model.edit',compact('model','manufacturer')); 
    }
	public function update(Request $request, $id)
    { 
        $this->validate($request, [
            'manufacturer_id' => 'required',
            'model_name' => 'required|unique:model,model_name,'.$id.',id',
			//'manufacturer_name' => 'required|unique:manufacturer,manufacturer_name,'.$id.',id',

        ]);
        
        $model = Pmodel::find($id);
        $model->model_name = $request->input('model_name');
        $model->manufacturer_id   = $request->input('manufacturer_id');
        $model->status = $request->input('status');       
        $model->save(); 
         return redirect()->route('model.index')
                        ->with('success','Model Updated Successfully');
    }
	
	
	public function change_status(Request $request)
    {
       $status = Pmodel::where('id',$request['id'])->select('status')->first();
       $status = ($status->status == 1) ? 0 : 1;
       Pmodel::where('id',$request['id'])->update(['status'=>$status,'updated_by'=>Auth::id()]); 
    }

}
