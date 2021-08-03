<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\Pmodel;
use Spatie\Permission\Models\Permission;
use DB;
use Auth;

class SupplierController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:supplier-list|supplier-create|supplier-edit|supplier-delete', ['only' => ['index','store']]);
         $this->middleware('permission:supplier-create', ['only' => ['create','store']]);
         $this->middleware('permission:supplier-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:supplier-delete', ['only' => ['destroy']]);
    }
     public function index(Request $request)
    {
        
        $supplier = supplier::all();
   
        foreach ($supplier as $key => $value) {

               $suppliers = supplier::where('id',$value->id)->select('supplier_name')->get();
               $pmodel = pmodel::where('id',$value->model_id)->select('model_name')->get();
               $supplier[$key]['supplier_name'] = $suppliers[0]->supplier_name;
               $supplier[$key]['model_name'] = $pmodel[0]->model_name;            

            }
            $supplier = $supplier;
            return view('supplier.index',compact('supplier'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {                 
        
          $model =  DB::table('model')->where('status',1)->get()->toArray();
          return view('supplier.create',compact('model'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'model_id' => 'required',
            'supplier_name' => 'required|unique:supplier,supplier_name',
        ]);
        
        $supplier = supplier::create(
            ['supplier_name' => $request->input('supplier_name'),
            'model_id' => $request->input('model_id'),
            'status' => $request->input('status'),
            'created_by'=>Auth::id()
        ]);
    
        return redirect()->route('supplier.index')
                        ->with('success','Supplier created successfully');
    }

    public function edit(supplier $supplier)
    {
       $model =  DB::table('model')->where('status',1)->get()->toArray();
        //$model =  DB::table('model')->where('manufacturer_id',$model->manufacturer_id)->where('status',1)->get()->toArray();

        return view('supplier.edit',compact('supplier','model')); 
    }


    public function update(Request $request, $id)
    { 
        $this->validate($request, [
            'model_id' => 'required',
		   'supplier_name' => 'required|unique:supplier,supplier_name,'.$id.',id',
        ]);
        
        $supplier = supplier::find($id);
        $supplier->supplier_name = $request->input('supplier_name');
        $supplier->model_id   = $request->input('model_id');
        $supplier->status = $request->input('status');       
        $supplier->save(); 
         return redirect()->route('supplier.index')
                        ->with('success','Supplier Updated Successfully');
    }
	public function change_status(Request $request)
    {
       $status = supplier::where('id',$request['id'])->select('status')->first();
       $status = ($status->status == 1) ? 0 : 1;
       supplier::where('id',$request['id'])->update(['status'=>$status,'updated_by'=>Auth::id()]); 
    }

}
