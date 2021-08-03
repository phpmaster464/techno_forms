<?php
    
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Status;
use Spatie\Permission\Models\Permission;
use DB;
use Auth;
class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:status-list|status-create|status-edit|status-delete', ['only' => ['index','store']]);
         $this->middleware('permission:status-create', ['only' => ['create','store']]);
         $this->middleware('permission:status-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:status-delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $status = Status::all();

        // foreach($statuss as $key => $status)
        // {
        //     $username = '';
        //     if($statuss->created_by != '')
        //     {
        //        $data =  DB::table('users')
        //         ->select('users.id','users.name as Username','roles.name')
        //         ->join('model_has_roles','model_has_roles.model_id','=','users.id')
        //         ->join('roles','roles.id','=','model_has_roles.role_id')
        //         ->where('users.id',$statuss->created_by)
        //         ->get();
        //          $statuss[$key]->created_by = $data[0]->name.'('.$data[0]->Username.')';
        //     }
        // }

        return view('status.index',compact('status'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view('status.create',compact('permission')); 
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:status,name',
            // 'permission' => 'required',
        ]);
        
        $status = Status::create(['name' => $request->input('name'),'status' => $request->input('status'),'created_by'=>Auth::id()]);
    
        return redirect()->route('status.index')
                        ->with('success','Status created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $status = Status::find($id);
       
        return view('status.show',compact('status'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $status = Status::find($id);
        $permission = Permission::get();
        
        return view('status.edit',compact('status','permission'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
            // 'permission' => 'required',
        ]);
    
        $status = Status::find($id);
        $status->name = $request->input('name');
        $status->status = $request->input('status');
        $status->updated_by = Auth::id();
        $status->save(); 

    
        return redirect()->route('status.index')
                        ->with('success','Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // DB::table("roles")->where('id',$id)->delete();
        // return redirect()->route('roles.index')
        //                 ->with('success','Role deleted successfully');
    }

     public function change_status(Request $request)
    {
       $status = Status::where('id',$request['id'])->select('status')->first();
       $status = ($status->status == 1) ? 0 : 1;
       Status::where('id',$request['id'])->update(['status'=>$status,'updated_by'=>Auth::id()]); 
    }
}