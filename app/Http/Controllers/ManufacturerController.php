<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use Spatie\Permission\Models\Permission;
use DB;
use Auth;

class ManufacturerController extends Controller
{
    
      function __construct()
    {
         $this->middleware('permission:manufacturer-list|manufacturer-create|manufacturer-edit|manufacturer-delete', ['only' => ['index','store']]);
         $this->middleware('permission:manufacturer-create', ['only' => ['create','store']]);
         $this->middleware('permission:manufacturer-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:manufacturer-delete', ['only' => ['destroy']]);
    }
     public function index(Request $request)
    {
        
        $manufacturer = manufacturer::all();
        return view('manufacturer.index',compact('manufacturer'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $permission = Permission::get();
        return view('manufacturer.create',compact('permission')); 
    }
	
    public function store(Request $request)
    {
        $this->validate($request, [
            'manufacturer_name' => 'required|unique:manufacturer,manufacturer_name',
            // 'permission' => 'required',
        ]);
		//echo Auth::id();exit;
        
        $manufacturer = manufacturer::create([
		'manufacturer_name' => $request->input('manufacturer_name'),
		'status' => $request->input('status'),
		'created_by'=>Auth::id()]);
    
        return redirect()->route('manufacturer.index')
                        ->with('success','Manufacturer created successfully');
    }
	
    public function edit($id)
    {   
        $manufacturer = manufacturer::find($id);
        $permission = Permission::get();
        
        return view('manufacturer.edit',compact('manufacturer','permission'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
         
            'manufacturer_name' => 'required|unique:manufacturer,manufacturer_name,'.$id.',id',

            // 'permission' => 'required',
        ]);
    
        $manufacturer = manufacturer::find($id);
        $manufacturer->manufacturer_name = $request->input('manufacturer_name');
        $manufacturer->status = $request->input('status');
        $manufacturer->updated_by = Auth::id();
        $manufacturer->save(); 

    
        return redirect()->route('manufacturer.index')
                        ->with('success','Manufacturer updated successfully');
    }
	public function change_status(Request $request)
    {
       $status = manufacturer::where('id',$request['id'])->select('status')->first();
       $status = ($status->status == 1) ? 0 : 1;
       manufacturer::where('id',$request['id'])->update(['status'=>$status,'updated_by'=>Auth::id()]); 
    }

}
