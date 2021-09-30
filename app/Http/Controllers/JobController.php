<?php
    
namespace App\Http\Controllers;
    
use App\Models\Jobs;
use App\Models\Panels;
use App\Models\Inverter;
use App\Models\PanelSerials;
use App\Models\InvetrerSerials;
use App\Models\Installer;
use App\Models\UnverifiedInstaller;
use App\Models\AprovdPanels;
use Illuminate\Http\Request;
use Auth;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use ZipArchive;
use \PDF;
    
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
          $states =  DB::table('au_states')->get()->toArray();

		 // $installers =  DB::table('installers')->get()->toArray();
		 //$installers =  DB::select("SELECT id,first_name ,`installer_job_type` FROM `installers`");
		 
		  $installers = DB::table('installers')->where('installer_job_type', 'like', '%Installer%')->get()->toArray();
		   $Electricians= DB::table('installers')->where('installer_job_type', 'like', '%Electrician%')->get()->toArray();
		   $Designers = DB::table('installers')->where('installer_job_type', 'like', '%Designer%')->get()->toArray();
		  
		  
		
          return view('job.create',compact('unit_type','street_types','installers','Electricians','Designers','states'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //echo "<pre>";print_r($request->all());die;
        request()->validate([
            'job_type' => 'required',
            'reference_number' => 'required',
            'owner_type' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'distributor' => 'required',
            //'property_type' => 'required',
            //'story_type' => 'required',
            
        ]);
		
 
        $userId = Auth::id();

        $input = $request->all();
		// echo "<pre>";
		// print_r($input);
		// echo "</pre>";
		// exit;
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
        $states =  DB::table('au_states')->get()->toArray();
        $installers = DB::table('installers')->where('installer_job_type', 'like', '%Installer%')->get()->toArray();
        $Electricians= DB::table('installers')->where('installer_job_type', 'like', '%Electrician%')->get()->toArray();
        $Designers = DB::table('installers')->where('installer_job_type', 'like', '%Designer%')->get()->toArray();
		$panels = DB::table('tbl_panels')->where('job_id',$job['id'])->get()->toArray();	
		$balance = DB::table('tbl_panels')->where('job_id' ,$job['id'])->sum('enter_no_of_solar_panal');

		$panel_fields = array();
		$i= 0;
		$j = 0;
		$count = 0;
        $p_i_c = 0;
		foreach ($panels as $key => $value) {
			
			$panel_id = $value->id;
		  	$job_id = $value->job_id;
		  		$panel_fields[$key][$i] = '';

                $panel_fields_serials[$key][$i] = array('panel_sid'=>'','serial'=> '','scanned'=>'','panel_iamge'=>'');

		  		$panel_serial_numbers = DB::table('panel_serial_numbers')->where('panel_id',$panel_id)->where('job_id',$job_id)->get();
                
                    for($p=0;$p<$value->enter_no_of_solar_panal;$p++)
                    {
                        
                        $panel_fields[$key][$p] = isset($panel_serial_numbers[$p]->Panel_Serial_Numbers)?$panel_serial_numbers[$p]->Panel_Serial_Numbers : '';
                        
                        $panel_image = '';
                        
                        if(isset($panel_serial_numbers[$p]) && $panel_serial_numbers[$p] !=''){
                        
                            $panel_image_count = DB::table('tbl_panels_images')->where('panel_id',$panel_serial_numbers[$p]->panel_id)->where('serial_number',$panel_serial_numbers[$p]->Panel_Serial_Numbers)->count();
                            //echo $panel_image_count;die;
                            $p_i_c = (isset($panel_image_count)&&$panel_image_count>0?$panel_image_count:0) + $p_i_c;
                            if($panel_image_count > 0)
                            {   
                                $panel_image_data = DB::table('tbl_panels_images')->where('panel_id',$panel_serial_numbers[$p]->panel_id)->where('serial_number',$panel_serial_numbers[$p]->Panel_Serial_Numbers)->select('image')->first();
                                $panel_image = $panel_image_data->image;
                            }
                       

                            if(count($panel_serial_numbers) > 0){
                            
                                $panel_fields_serials[$key][$p] = array(
                                    'panel_sid' => isset($panel_serial_numbers[$p]->id)?$panel_serial_numbers[$p]->id : '',
                                    'serial'=>isset($panel_serial_numbers[$p]->Panel_Serial_Numbers)?$panel_serial_numbers[$p]->Panel_Serial_Numbers : '',
                                    'scanned'=>isset($panel_serial_numbers[$p]->panel_serial_number_scanned)?$panel_serial_numbers[$p]->panel_serial_number_scanned:'',
                                    'panel_iamge'=>$panel_image);
                            }
    
                        }
                        else{
                            $panel_fields_serials[$key][$p] = array('panel_sid'=>'','serial'=> '','scanned'=>'','panel_iamge'=>'');
                        }
                    
                    }
                //echo "<pre>";print_r($panel_fields_serials[$key]);die;  
		  		$panels[$key]->panel_serial_no = $panel_fields[$key];
                $panels[$key]->panel_serial_no_scanned = $panel_fields_serials[$key];
		  		$i= 0;
		  		$j = 0;

                  
		}
        $panel_image_count  = isset($p_i_c)&&$p_i_c>0?$p_i_c:0;
		
        $inverters = DB::table('tbl_inverters')->where('job_id',$job['id'])->get()->toArray();		 
     		 
        $Enter_number_of_inverter = DB::table('tbl_inverters')->where('job_id' ,$job['id'])->sum('Enter_number_of_inverter');


        $inverter_fields = array();
		$i= 0;
		$j = 0;
        $p_i_c_i = 0;
			foreach ($inverters as $key => $value) {
			
			$inverter_id = $value->id;
		  	$job_id = $value->job_id;
		  		$inverter_fields[$key][$i] = '';
                $inverter_fields_serials[$key][$i] = array('inverter_sid'=>'','serial'=>'','scanned'=>'','inverter_image'=>'');
		  		
		  		$invetrers_serial_numbers = DB::table('invetrers_serial_numbers')->where('inverter_id',$inverter_id)->where('job_id',$job_id)->get();
                for($p=0;$p<$value->Enter_number_of_inverter;$p++)
		  		{
                    $inverter_image_count=0;
                   
		  			$inverter_fields[$key][$p] = isset($invetrers_serial_numbers[$p]->Invetrers_Serial_Numbers)?$invetrers_serial_numbers[$p]->Invetrers_Serial_Numbers : '';
                    
                    $inverter_image = '';
                    
                    if(isset($invetrers_serial_numbers[$p]) && $invetrers_serial_numbers[$p] !=''){
                        
                        $inverter_image_count = DB::table('tbl_inverter_images')->where('inverter_id',$invetrers_serial_numbers[$p]->inverter_id)->where('serial_number',$invetrers_serial_numbers[$p]->Invetrers_Serial_Numbers)->count();
                        $p_i_c_i = $p_i_c_i + (isset($inverter_image_count)&&$inverter_image_count>0);
                        if($inverter_image_count > 0)
                        {
                            $inverter_image_data = DB::table('tbl_inverter_images')->where('inverter_id',$invetrers_serial_numbers[$p]->inverter_id)->where('serial_number',$invetrers_serial_numbers[$p]->Invetrers_Serial_Numbers)->select('image')->first();
                            $inverter_image = $inverter_image_data->image;
                        }
                       
                        if(count($invetrers_serial_numbers) > 0){
                            $inverter_fields_serials[$key][$p] = array(
                                'inverter_sid'=>isset($invetrers_serial_numbers[$p]->id)?$invetrers_serial_numbers[$p]->id : '',
                                'serial'=>isset($invetrers_serial_numbers[$p]->Invetrers_Serial_Numbers)?$invetrers_serial_numbers[$p]->Invetrers_Serial_Numbers : '',
                                'scanned'=>isset($invetrers_serial_numbers[$p]->inverter_serial_number_scanned)?$invetrers_serial_numbers[$p]->inverter_serial_number_scanned:'',
                                'inverter_image'=>$inverter_image);
                        }
                       
                    }else{
                        
                        $inverter_fields_serials[$key][$p] = array('inverter_sid'=>'','serial'=>'','scanned'=>'','inverter_image'=>'');
                    }

		  		}
		  		$inverters[$key]->inverter_serial_no = $inverter_fields[$key];
                $inverters[$key]->inverter_serial_no_scanned = $inverter_fields_serials[$key];
		  		$i= 0;
		  		$j = 0;
                
		  	} 
            $inverter_image_count = isset($p_i_c_i)&&$p_i_c_i>0?$p_i_c_i:0;
        //echo "<pre>";print_r($panels);die;
     return view('job.edit',compact('unit_type','street_types','job','installers','Electricians','Designers','panels','inverters','states','panel_image_count','inverter_image_count'));
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
            'owner_postal_address_type' => 'required',
            'distributor' => 'required',
            //'property_type' => 'required',
            //'story_type' => 'required',
        ]);
        

        $input = $request->all();
    
        $userId = Auth::id();

        $input['updated_by'] = $userId;

        $job->update($input); 
        $job_id=$job->id;

        // echo "<pre>";
        // print_r($job_id);exit;
        // echo "</pre>";
       
        if($request->hasFile('installer_signature')) {

            $installer_signature = $this->uploadImage($request->installer_signature,'uploads/job/installer/');
            $input['installer_signature'] = $installer_signature;
            Jobs::where('id',$job_id)->update(['installer_signature'=>$installer_signature]);
        } 
        if($request->hasFile('designer_signature')) {

            $designer_signature = $this->uploadImage($request->designer_signature,'uploads/job/designer/');
            $input['designer_signature'] = $designer_signature;
            Jobs::where('id',$job_id)->update(['designer_signature'=>$designer_signature]); 
        } 

        if($request->hasFile('electrician_signature')) {

            $electrician_signature = $this->uploadImage($request->electrician_signature,'uploads/job/electrician/');
            $input['electrician_signature'] = $electrician_signature;
            Jobs::where('id',$job_id)->update(['electrician_signature'=>$electrician_signature]); 
        } 
        if($request->hasFile('owner_signature')) {

            $owner_signature = $this->uploadImage($request->owner_signature,'uploads/job/designer/');
            $input['owner_signature'] = $owner_signature;
            Jobs::where('id',$job_id)->update(['owner_signature'=>$owner_signature]); 
        } 

        /*echo "<pre>";
        print_r($input);
        echo "</pre>";
        exit();*/
		if(isset($input['install_date']))
        {       
            //$Panels=Panels::where('job_id',$job['id'])->delete();
            $Panels = DB::table('tbl_panels')->select()->where('job_id',$job['id'])->get()->toArray();
            $p_array = array();
            
            for($i=0; $i<count($input['install_date']); $i++)
            {   
                if(isset($input['panel_id'][$i])&&$input['panel_id'][$i]>0&&$input['panel_id'][$i]!='') 
                {  
                    array_push($p_array,$input['panel_id'][$i]);

                    $update =  DB::table('tbl_panels')->where('id',$Panels[$i]->id)->update([
                        'install_date'=>$input['install_date'][$i],
                        'Panels_Brand'=>$input['Panels_Brand'][$i],
                        'Panels_Model'=>$input['Panels_Model'][$i],
                        'enter_no_of_solar_panal'=>$input['enter_no_of_solar_panal'][$i]
                    ]);

                    $Panels_id=$input['panel_id'][$i];
                   
                    if(isset($input['Panel_Serial_Numbers'][$i]))
                    {       

                            $panel_image_data = DB::table('tbl_panels_images')->where('panel_id',$Panels_id)->select('serial_number','image')->get()->toArray();
                            $panel_avaible_serials = array();
                            foreach($panel_image_data as $key=>$value){
                               array_push($panel_avaible_serials,$value->serial_number);
                            }
                        
                            $panel_diff_serials=array_diff($panel_avaible_serials,$input['Panel_Serial_Numbers'][$i]);
                            foreach($panel_diff_serials as $k=>$panel_diff_serial){
                                DB::table('tbl_panels_images')->where('panel_id',$Panels_id)->where('serial_number',$panel_diff_serial)->delete();
                            }

                            $Panels_=PanelSerials::where('job_id',$job['id'])->where('panel_id',$Panels_id)->delete();

                            //$Panel_s = DB::table('panel_serial_numbers')->select()->where('panel_id',$Panels_id)->where('job_id',$job['id'])->get()->toArray();
                            $p_s_array = array();
                            for($j=0; $j<count($input['Panel_Serial_Numbers'][$i]); $j++)
                            {   
                                // if(isset($input['Panel_sid'][$i][$j])&&$input['Panel_sid'][$i][$j]>0&&$input['Panel_sid'][$i][$j]!='') 
                                // {   
                                //     $update =  DB::table('panel_serial_numbers')->where('id',$input['Panel_sid'][$i][$j])->update([
                                //         'Panel_Serial_Numbers'=> isset($input['Panel_Serial_Numbers'][$i][$j])&&$input['Panel_Serial_Numbers'][$i][$j]>0&&$input['Panel_Serial_Numbers'][$i][$j]!=''?$input['Panel_Serial_Numbers'][$i][$j]:'',
                                //         'status'=>$input['Panel_Serial_Numbers_Delete'][$i][$j],
                                //     ]);
                                //     array_push($p_s_array,$input['Panel_sid'][$i][$j]);
                
                                // }
                                // else
                                // {
                                    $PanelSerials= new PanelSerials;
                                    $PanelSerials->panel_id= $Panels_id;
                                    $PanelSerials->job_id=$job_id;
                                    $PanelSerials->Panel_Serial_Numbers= $input['Panel_Serial_Numbers'][$i][$j];
                                    $PanelSerials->created_by= $userId;
                                    $PanelSerials->status= $input['Panel_Serial_Numbers_Delete'][$i][$j];
                                    $PanelSerials->save(); 
                                    array_push($p_s_array,$PanelSerials->id);


                                //}
                            }
                            
                    }else{
                        //$Panels=PanelSerials::where('job_id',$job['id'])->where('panel_id',$Panels_id)->delete();
                    }

                }
                else
                {   
                    //$Panels=Panels::where('id',$Panels[$i]->id)->delete();
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
                    array_push($p_array,$Panels->id);
                    
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
                                $PanelSerials->status= $input['Panel_Serial_Numbers_Delete'][$i][$j];
                                $PanelSerials->save(); 
                            }
                            
                    }else{
                        //$Panels=PanelSerials::where('job_id',$job['id'])->where('panel_id',$Panels_id)->delete();
                    }
                    
                }
            }
            $Panels=Panels::whereNotIn('id',$p_array)->where('job_id',$job['id'])->delete();
            $PanelSerials=PanelSerials::whereNotIn('panel_id',$p_array)->where('job_id',$job['id'])->delete();
            
				
        }else{
           // $Panels=Panels::where('job_id',$job['id'])->delete();
        }
 
    
	if(isset($input['inverter_Quick_Search']))
    {   

            //$Inverter_res=Inverter::where('job_id',$job['id'])->delete();
            $Inverter = DB::table('tbl_inverters')->select()->where('job_id',$job['id'])->get()->toArray();
            $i_array = array();
            for($i=0; $i<count($input['inverter_Quick_Search']); $i++)
            {
                if(isset($input['inverter_id'][$i])&&$input['inverter_id'][$i]>0&&$input['inverter_id'][$i]!='') 
                {   
                    array_push($i_array,$input['inverter_id'][$i]);
                    $update =  DB::table('tbl_inverters')->where('id',$input['inverter_id'][$i])->update([
                        'inverter_Quick_Search_date'=>$input['inverter_Quick_Search'][$i],
                        'inverter_Brand'=>$input['inverter_Brand'][$i],
                        'inverter_Series'=>$input['inverter_Series'][$i],
                        'inverter_Model'=>$input['inverter_Model'][$i],
                        'Enter_number_of_inverter'=>$input['Enter_number_of_inverter'][$i]
                    ]);

                    $Inverter_id=$input['inverter_id'][$i];
                    if(isset($input['Invetrers_Serial_Numbers'][$i]))
                    {       
                            $inverter_image_data = DB::table('tbl_inverter_images')->where('inverter_id',$Inverter_id)->select('serial_number','image')->get()->toArray();
                            $inverter_avaible_serials = array();
                            foreach($inverter_image_data as $key=>$value){
                               array_push($inverter_avaible_serials,$value->serial_number);
                            }
                            
                            $inverter_diff_serials=array_diff($inverter_avaible_serials,$input['Invetrers_Serial_Numbers'][$i]);
                            foreach($inverter_diff_serials as $k=>$inverter_diff_serial){
                                DB::table('tbl_inverter_images')->where('inverter_id',$Inverter_id)->where('serial_number',$inverter_diff_serials)->delete();
                            }

                            $InverterSerials=InvetrerSerials::where('job_id',$job['id'])->where('inverter_id',$Inverter_id)->delete();
                            //$Inverter_s = DB::table('invetrers_serial_numbers')->select()->where('inverter_id',$Inverter_id)->where('job_id',$job['id'])->get()->toArray();
        
                            $i_s_array = array();
                            for($j=0; $j<count($input['Invetrers_Serial_Numbers'][$i]); $j++)
                            {
                                // if(isset($input['Invetrers_sid'][$i][$j])&&$input['Invetrers_sid'][$i][$j]>0&&$input['Invetrers_sid'][$i][$j]!='') 
                                // {  
                                //     array_push($i_s_array,$input['Invetrers_sid'][$i][$j]);

                                //     $update =  DB::table('invetrers_serial_numbers')->where('id',$input['Invetrers_sid'][$i][$j])->update([
                                //         'Invetrers_Serial_Numbers'=> isset($input['Invetrers_Serial_Numbers'][$i][$j])&&$input['Invetrers_Serial_Numbers'][$i][$j]!=''?$input['Invetrers_Serial_Numbers'][$i][$j]:'',
                                //         'status'=>$input['Invetrers_Serial_Numbers_Delete'][$i][$j],
                                //     ]);
                                // }
                                // else
                                // {

                                    $InverterSerials= new InvetrerSerials;
                                    $InverterSerials->inverter_id= $Inverter_id;
                                    $InverterSerials->job_id=$job_id;
                                    $InverterSerials->Invetrers_Serial_Numbers= $input['Invetrers_Serial_Numbers'][$i][$j];
                                    $InverterSerials->created_by= $userId;
                                    $InverterSerials->status= $input['Invetrers_Serial_Numbers_Delete'][$i][$j];
                                    $InverterSerials->save();
                                    array_push($i_s_array,$InverterSerials->id);
                               //}

                            }
                            //echo "<pre>";print_r($i_s_array);die;

                    }		
                    else
                    {
                        //$InverterSerials=InvetrerSerials::where('job_id',$job['id'])->where('inverter_id',$Inverter_id)->delete();
                    }
                }
                else
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
                    array_push($i_array,$Inverter->id);
                    $Inverter_id=$Inverter->id;

                    if(isset($input['Invetrers_Serial_Numbers'][$i]))
                    {       
                            //$InverterSerials=InvetrerSerials::where('job_id',$job['id'])->where('inverter_id',$Inverter_id)->delete();
                            for($j=0; $j<count($input['Invetrers_Serial_Numbers'][$i]); $j++)
                            {
                                $InverterSerials= new InvetrerSerials;
                                $InverterSerials->inverter_id= $Inverter_id;
                                $InverterSerials->job_id=$job_id;
                                $InverterSerials->Invetrers_Serial_Numbers= $input['Invetrers_Serial_Numbers'][$i][$j];
                                $InverterSerials->created_by= $userId;
                                $InverterSerials->status= $input['Invetrers_Serial_Numbers_Delete'][$i][$j];
                                $InverterSerials->save();
                            }
                    }		
                    else
                    {
                        //$InverterSerials=InvetrerSerials::where('job_id',$job['id'])->where('inverter_id',$Inverter_id)->delete();
                    }
                }
                $Inverter_id='';
		    }
            $Inverter=Inverter::whereNotIn('id',$i_array)->where('job_id',$job['id'])->delete();	
            $InverterSerials=InvetrerSerials::whereNotIn('inverter_id',$i_array)->where('job_id',$job['id'])->delete();
    }
    else
    {
            //$Inverter_res=Inverter::where('job_id',$job['id'])->delete();
    }

        

        return redirect()->route('job.index')->with('success','Job Updated Successfully');
    }

    public function uploadImage($image,$path){

        $destination_path = $path; 
        $filename1 = sha1(time() . time()) . preg_replace('/\s+/', '',$image->getClientOriginalName()); //to trim whitespace in file na
        $filename = str_replace(array( '(', ')' ), '',$filename1);            
        $image->move($destination_path,$filename);
        $path = $destination_path . $filename;
        return $path;

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
	
   // Fetch job by user id
     public function view(Jobs $job, $id)
     {
      
            $totalpanel = DB::table('jobs')
            ->leftjoin('tbl_panels', 'jobs.id', '=', 'tbl_panels.job_id')
            ->where('jobs.id',$id) 
            ->sum('tbl_panels.enter_no_of_solar_panal');

           $data = DB::table('jobs')
            ->leftjoin('tbl_panels', 'jobs.id', '=', 'tbl_panels.job_id')
            ->leftjoin('tbl_inverters', 'jobs.id', '=', 'tbl_inverters.job_id')
            ->leftjoin('installers', 'jobs.installer_type', '=', 'installers.id')
            
            ->select('jobs.*','tbl_panels.Panels_Brand','tbl_panels.Panels_Model','tbl_inverters.inverter_Brand','tbl_inverters.inverter_Series','tbl_inverters.inverter_Model','installers.mobile','installers.suburb','installers.postcode','installers.unit_type','installers.unit_number','installers.street_number','installers.street_name','installers.street_type')
            ->where('jobs.id',$id)           
            ->first();

        return view('job.dynamic_pdf',compact('id','data','totalpanel')); 
        
  
    }

   
    // Download Multiple image as Zip
    public function zipFileDownload(Request $request)
    {
        $file_path=$request->imagearray;

        $filename = "AllDocuments_".strtotime(date('Y-m-d H:i:s')).".zip";
        $zip = new ZipArchive;
        if ($zip->open(public_path().'/uploads/'.$filename, ZipArchive::CREATE) === TRUE) {

                 // Add File in ZipArchive
            foreach($file_path as $file)
            {
                $file1 = substr($file, strrpos($file, '/') + 1); 
                if (! $zip->addFile($file, basename($file1))) {
                        //echo 'Could not add file to ZIP: ' . $file;
                }
            }
                // Close ZipArchive     
            $zip->close();
        }

         $headers = array(
                "Content-type" => "application/stream",
                "Content-Disposition" => "attachment; filename=document.zip",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );
            echo json_encode(array("zip"=>URL('/uploads').'/'.$filename));

    }


    //edit
    public function zipFileDownload_new(Request $request)
    {
        $file_path=$request->chArray;

        $filename = "AllDocuments_".strtotime(date('Y-m-d H:i:s')).".zip";
        $zip = new ZipArchive;
        if ($zip->open(public_path().'/uploads/'.$filename, ZipArchive::CREATE) === TRUE) {

                 // Add File in ZipArchive
            foreach($file_path as $file)
            {
                $file1 = substr($file, strrpos($file, '/') + 1); 
                if (! $zip->addFile($file, basename($file1))) {
                        //echo 'Could not add file to ZIP: ' . $file;
                }
            }
                // Close ZipArchive     
            $zip->close();
        }

         $headers = array(
                "Content-type" => "application/stream",
                "Content-Disposition" => "attachment; filename=document.zip",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );
            echo json_encode(URL('/uploads').'/'.$filename);
            //echo json_encode(array("zip"=>URL('/uploads').'/'.$filename));

    }


    public function generatePDF(Jobs $job, $id)
    {

        $totalpanel = DB::table('jobs')
            ->leftjoin('tbl_panels', 'jobs.id', '=', 'tbl_panels.job_id')
            ->where('jobs.id',$id) 
            ->sum('tbl_panels.enter_no_of_solar_panal');
        
        $data = DB::table('jobs')
            ->leftjoin('tbl_panels', 'jobs.id', '=', 'tbl_panels.job_id')
            ->leftjoin('tbl_inverters', 'jobs.id', '=', 'tbl_inverters.job_id')
            ->leftjoin('installers', 'jobs.installer_type', '=', 'installers.id')
            ->select('jobs.*','tbl_panels.Panels_Brand','tbl_panels.Panels_Model','tbl_inverters.inverter_Brand','tbl_inverters.inverter_Series','tbl_inverters.inverter_Model','installers.suburb','installers.postcode','installers.unit_type','installers.unit_number','installers.street_number','installers.street_name','installers.street_type')
            ->where('jobs.id',$id)
            ->first();

          /*  PDF::loadView('job.dynamic_pdf', compact('data','totalpanel'), [], [
              'title' => 'Another Title',
              'margin_top' => 0
            ])->save($pdfFilePath);*/

          /*  $pdf = PDF::chunkLoadView('job.dynamic_pdf', 'pdf.document', $data);*/
        /*  $pdf = PDF::loadView('job.dynamic_pdf',['data'=>$data]);
            return $pdf->stream('document.pdf');
            */          
            $content ='<!DOCTYPE html><html lang="en"><head>
        <style>
        @import url("https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap");
</head>

<body
    style="height: 100%;width: 100%;overflow-y: auto;color: #000;background-color: #fff; font-size: 16px;font-family:"Lato", sans-serif;">
    <main class="container-fluid" style="padding: 10px;display: block;">
        <div class="row">
            <section class="col-md-9">
                <header
                    style="display: flex;align-items: center;justify-content: center;align-items: flex-start; display: flex;flex-direction: column;">
                    <div class="d-flex">
                        <img src="demo-logo.png" alt="Logo" class="logo-img" style="width: 30%;">
                        <h1 style="margin: 0 30px;font-weight: 900;display: flex;align-items: center;font-size: 2.5rem;">STC Assigment
                            Form - PV Solar</h1>
                    </div>
                    <p style="color #d1d2d4; font-weight: 500;" class="header-description text-uppercase">Emerging
                        energy solution gropu pty.Ltd.517 Flinders Lane,
                        MELBOURNE VIC 3000</p>
                </header>
                <section class="row">
                    <div class="col-md-6">
                        <form style="border: 1px solid #00adef;" id="installerFOrm">
                            <div class="form-group d-flex flex-md-row
                                            installerDatewrape" style="padding: 0 20px;align-items: baseline;">
                                <label style="display: flex;align-items: flex-end;"
                                    style="display: flex;align-items: flex-end;width: 23%;text-decoration: underline; "
                                    for="installtionDate">Installtion
                                    Date: </label>
                                <input
                                    style="border-top: none;border-left: none;border-right: none;border-radius: 0;border-bottom: none;"
                                    type="text" value="9-Sep-2021" class="form-control" id="installtionDate">
                            </div>
                            <h2
                                style="background-color: #00adef;color: #000;text-align: center;padding: 6px 0;font-weight: 800;font-size: 22px;margin: 0;">
                                Owner Details</h2>
                            <div class="form-group d-flex flex-md-row
                                            Owner-wrap" style="padding: 0 20px;align-items: baseline;">
                                <label style="display: flex;align-items: flex-end;" for="OwnerfirstName">First Name:
                                </label>
                                <input style="border-top: none;border-left: none;border-right: none;border-radius: 0;border-bottom: none;" type="text" value="Vikki Mc" class="form-control" id="OwnerfirstName">
                            </div>
                            <div class="form-group d-flex flex-md-row
                                            Owner-wrap" style="padding: 0 20px;align-items: baseline;">
                                <label style="display: flex;align-items: flex-end;width: 160px;"
                                    for="OwnerLastName">Last Name:
                                </label>
                                <input style="border-top: none;border-left: none;border-right: none;border-radius: 0;border-bottom: none;" type="text" value="Shana" class="form-control" id="OwnerLastName">
                            </div>
                            <div class="form-group d-flex flex-md-row
                                            Owner-wrap" style="padding: 0 20px;align-items: baseline;">
                                <label style="display:flex;align-items: flex-end;width: 160px;"
                                    for="OwnerPstalAddress">Postal
                                    Address: </label>
                                <input style="border-top: none;border-left: none;border-right: none;border-radius: 0;border-bottom: none;" type="text" value="9-Sep-2021" class="form-control" id="OwnerPstalAddress">
                            </div>
                            <div class="form-group d-flex flex-md-row
                                            Owner-wrap" style="padding: 0 20px;align-items: baseline;">
                                <label style="display: flex;align-items: flex-end;width: 160px;"
                                    for="OwnerSuburb">Suburb: </label>
                                <input style="border-top: none;border-left: none;border-right: none;border-radius: 0;border-bottom: none;" type="text" value="9-Sep-2021" class="form-control" id="OwnerSuburb">
                            </div>
                            <div class="form-group d-flex flex-md-row
                                            Owner-wrap double-wrap mb-0"
                                style="padding: 0 20px;align-items: baseline;">
                                <div class="col-md-6 p-0 form-group d-flex
                                                flex-md-row">
                                    <label style="display: flex;align-items: flex-end;width: 160px;"
                                        for="Ownerqld">State: </label>
                                    <input style="border-top: none;border-left: none;border-right: none;border-radius: 0;border-bottom: none;" type="text" value="QLD" class="form-control" id="Ownerqld">
                                </div>
                                <div class="col-md-6 p-0 form-group d-flex
                                                flex-md-row">
                                    <label style="display: flex;align-items: flex-end;width: 160px;"
                                        for="OwnerPostcode">Postcode:
                                    </label>
                                    <input style="border-top: none;border-left: none;border-right: none;border-radius: 0;border-bottom: none;" type="text" value="9-Sep-2021" class="form-control" id="OwnerPostcode">
                                </div>
                            </div>
                            <div class="form-group d-flex flex-md-row
                                            Owner-wrap double-wrap mb-0"
                                style="padding: 0 20px;align-items: baseline;">
                                <div class="col-md-6 p-0 form-group d-flex
                                                flex-md-row">
                                    <label style="display: flex;align-items: flex-end;width: 160px;"
                                        for="Ownerhome">Home: </label>
                                    <input style="border-top: none;border-left: none;border-right: none;border-radius: 0;border-bottom: none;" type="text" value="QLD" class="form-control" id="Ownerhome">
                                </div>
                                <div class="col-md-6 p-0 form-group d-flex
                                                flex-md-row">
                                    <label style="display: flex;align-items: flex-end;width: 160px;"
                                        for="Ownermobile">Mobile:
                                    </label>
                                    <input style="border-top: none;border-left: none;border-right: none;border-radius: 0;border-bottom: none;" type="text" value="9-Sep-2021" class="form-control" id="Ownermobile">
                                </div>
                            </div>
                            <div class="form-group d-flex flex-md-row
                                            Owner-wrap" style="padding: 0 20px;align-items: baseline;">
                                <label style="display: flex;align-items: flex-end;width: 160px;" for="Owneremail">Email:
                                </label>
                                <input style="border-top: none;border-left: none;border-right: none;border-radius: 0;border-bottom: none;" type="text" value="9-Sep-2021" class="form-control" id="Owneremail">
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <form style="border: 1px solid #00adef;" id="instalationDetailForm">
                            <div class="form-group d-flex flex-md-row
                                            STCwrap"
                                style="align-items: baseline;margin-bottom: 0px;padding: 19px 20px;">
                                <label style="display: flex;align-items: flex-end;" style="margin-right: 20px;">STC
                                    Deeming Period:</label>
                                <div style="display: flex;">
                                    <div class="form-check form-check-inline">
                                        <input
                                            style="border-top: none;border-left: none;border-right: none;border-radius: 0;"
                                            class="form-check-input" type="checkbox" id="OneYr" value="option1">
                                        <label style="display: flex;align-items: flex-end;" class="form-check-label"
                                            for="OneYr">1 Yr</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                            style="border-top: none;border-left: none;border-right: none;border-radius: 0;"
                                            class="form-check-input" type="checkbox" id="FiveYr" value="option2">
                                        <label style="display: flex;align-items: flex-end;" class="form-check-label"
                                            for="FiveYr">5 Yr</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                            style="border-top: none;border-left: none;border-right: none;border-radius: 0;"
                                            class="form-check-input" type="checkbox" id="12Yr" value="option2">
                                        <label style="display: flex;align-items: flex-end;" class="form-check-label"
                                            for="12Yr">12 Yr</label>
                                    </div>
                                </div>
                            </div>
                            <h2
                                style="background-color: #00adef;color: #000;text-align: center;padding: 6px 0;font-weight: 800;font-size: 22px;margin: 0;">
                                Installation Details</h2>
                            <div class="form-check instalationDetailwrap
                                            checkbox" style="padding: 0 0px;align-items: baseline; margin: 20px 20px;">
                                <input
                                    style="border-top: none;border-left: none;border-right: none;border-radius: 0;width: 100%;"
                                    class="form-check-input" type="checkbox" value="" id="sameasowner">
                                <label style="display: flex;align-items: flex-end;width: 180px;"
                                    class="form-check-label" for="sameasowner">
                                    Same as Owner Details
                                </label>
                            </div>
                            <div class="form-group d-flex flex-md-row
                                            instalationDetailwrap" style="padding: 0 20px;align-items: baseline;">
                                <label style="display: flex;align-items: flex-end;width: 160px;"
                                    for="installtionfirstname">First
                                    Name: </label>
                                <input
                                    style="border-top: none;border-left: none;border-right: none;border-radius: 0;width: 100%;"
                                    type="text" value="9-Sep-2021" class="form-control" id="installtionfirstname">
                            </div>
                            <div class="form-group d-flex flex-md-row
                                            instalationDetailwrap" style="padding: 0 20px;align-items: baseline;">
                                <label style="display: flex;align-items: flex-end;width: 160px;"
                                    for="installtionlastname">Last Name:</label>
                                <input
                                    style="border-top: none;border-left: none;border-right: none;border-radius: 0;width: 100%;"
                                    type="text" value="9-Sep-2021" class="form-control" id="installtionlastname">
                            </div>
                            <div class="form-group d-flex flex-md-row
                                            instalationDetailwrap" style="padding: 0 20px;align-items: baseline;">
                                <label style="display: flex;align-items: flex-end;width: 160px;"
                                    for="installtionAddre">Install
                                    Address:</label>
                                <input
                                    style="border-top: none;border-left: none;border-right: none;border-radius: 0;width: 100%;"
                                    type="text" value="9-Sep-2021" class="form-control" id="installtionAddre">
                            </div>
                            <div class="form-group d-flex flex-md-row
                                            instalationDetailwrap" style="padding: 0 20px;align-items: baseline;">
                                <label style="display: flex;align-items: flex-end;width: 160px;"
                                    for="installSuburb">Suburb: </label>
                                <input
                                    style="border-top: none;border-left: none;border-right: none;border-radius: 0;width: 100%;"
                                    type="text" value="9-Sep-2021" class="form-control" id="installSuburb">
                            </div>
                            <div class="form-group d-flex flex-md-row
                                            instalationDetailwrap double-wrap mb-0"
                                style="padding: 0 20px;align-items: baseline;">
                                <div class="col-md-6 p-0 form-group d-flex
                                                flex-md-row">
                                    <label style="display: flex;align-items: flex-end;width: 160px;"
                                        for="installqld">State: </label>
                                    <input
                                        style="border-top: none;border-left: none;border-right: none;border-radius: 0;width: 100%;"
                                        type="text" value="QLD" class="form-control" id="installqld">
                                </div>
                                <div class="col-md-6 p-0 form-group d-flex
                                                flex-md-row">
                                    <label style="display: flex;align-items: flex-end;width: 160px;"
                                        for="installPostcode">Postcode:
                                    </label>
                                    <input
                                        style="border-top: none;border-left: none;border-right: none;border-radius: 0;width: 100%;"
                                        type="text" value="9-Sep-2021" class="form-control" id="installPostcode">
                                </div>
                            </div>
                            <div class="form-group d-flex flex-md-row
                                            instalationDetailwrap double-wrap mb-0"
                                style="padding: 0 20px;align-items: baseline;">
                                <div class="col-md-6 p-0 form-group d-flex
                                                flex-md-row">
                                    <label style="display: flex;align-items: flex-end;width: 160px;"
                                        for="installhome">Home: </label>
                                    <input
                                        style="border-top: none;border-left: none;border-right: none;border-radius: 0;width: 100%;"
                                        type="text" value="QLD" class="form-control" id="installhome">
                                </div>
                                <div class="col-md-6 p-0 form-group d-flex
                                                flex-md-row">
                                    <label style="display: flex;align-items: flex-end;width: 160px;"
                                        for="installmobile">Mobile:
                                    </label>
                                    <input
                                        style="border-top: none;border-left: none;border-right: none;border-radius: 0;width: 100%;"
                                        type="text" value="9-Sep-2021" class="form-control" id="installmobile">
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
                <section id="authentication" class="mt-4" style="padding-right: 15px;padding-left: 15px;">
                    <div class="row">
                        <div class="col-md-3 replacement-wrap style=" border: 1px solid #000;padding: 15.6px;text-align:
                            center;">
                            <p style="font-size: 13px;" class="mb-o">Are you <u>replacing</u> panels
                                to a system as a result of damage or faults?</p>
                            <div style="display: flex; justify-content: center;">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="yes">
                                    <label style="display: flex;align-items: flex-end;" class="form-check-label"
                                        for="yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="no">
                                    <label style="display: flex;align-items: flex-end;" class="form-check-label"
                                        for="no">No</label>
                                </div>
                            </div>
                            <p style="font-size: 13px;" class="mb-o"># of replacement panels?</p>
                            <input type="text" class="form-control"
                                style="height: 25px;border: ipx solid #d1d2d4; width: 88%;">
                        </div>
                        <div class="col-md-3 replacement-wrap style=" border: 1px solid #000;padding: 15.6px;text-align:
                            center;">
                            <p style="font-size: 13px;" class="mb-o">Are you <u>Additional</u> panels
                                to an exsisting system?</p>
                            <div style="display: flex; justify-content: center;">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="yes">
                                    <label style="display: flex;align-items: flex-end;" class="form-check-label"
                                        for="yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="no">
                                    <label style="display: flex;align-items: flex-end;" class="form-check-label"
                                        for="no">No</label>
                                </div>
                            </div>
                            <p style="font-size: 13px;" class="mb-o"># of exixting panels?</p>
                            <input type="text" class="form-control"
                                style="height: 25px;border: ipx solid #d1d2d4; width: 88%;">
                        </div>
                        <div class="col-md-3 replacement-wrap style=" border: 1px solid #000;padding: 15.6px;text-align:
                            center;">
                            <p style="font-size: 13px;" class="mb-o">Is there currently more than one
                                system installed at this address?</p>
                            <div style="display: flex; justify-content: center;">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="yes">
                                    <label style="display: flex;align-items: flex-end;" class="form-check-label"
                                        for="yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="no">
                                    <label style="display: flex;align-items: flex-end;" class="form-check-label"
                                        for="no">No</label>
                                </div>
                            </div>
                            <p style="font-size: 13px;" class="mb-o">please specify location of other
                                system?</p>
                            <input type="text" class="form-control"
                                style="height: 25px;border: ipx solid #d1d2d4; width: 88%;">
                        </div>
                        <div class="col-md-3 replacement-wrap style=" border: 1px solid #000;padding: 15.6px;text-align:
                            center;">
                            <p style="font-size: 13px;" class="mb-o">Are there any additional
                                comments relating to this installtion?</p>
                            <textarea class="form-control" style="height: 80px;border: ipx solid #d1d2d4; width: 88%;"
                                id="installinfomore" rows="3"></textarea>
                        </div>
                    </div>
                </section>
            </section>
            <section class="col-md-3">
                <form style="border: 1px solid #00adef;" id="retailerrFOrm">
                    <h2 style="background-color: #00adef;color: #000;text-align: center;padding: 6px 0;font-weight: 800;font-size: 22px;margin: 0;"
                        class="text-uppercase">Retailer Details</h2>
                    <div class="form-group d-flex flex-md-row retail-wrap"
                        style="padding: 0 20px;align-items: baseline;">
                        <label style="display: flex;align-items: flex-end;" class="text-uppercase"
                            for="retailertName">Name:
                        </label>
                        <input style="border: none;" type="text" value="Vikki Mc" class="form-control"
                            id="retailertName">
                    </div>
                    <div class="form-group d-flex flex-md-row retail-wrap"
                        style="padding: 0 20px;align-items: baseline;">
                        <label style="display: flex;align-items: flex-end;" class="text-uppercase"
                            for="retailerABN">ABN:
                        </label>
                        <input style="border: none;" type="text" value="Shana" class="form-control" id="retailerABN">
                    </div>
                </form>
                <form style="border: 1px solid #00adef;" id="solarPanelFOrm">
                    <h2 style="background-color: #00adef;color: #000;text-align: center;padding: 6px 0;font-weight: 800;font-size: 22px;margin: 0;"
                        class="text-uppercase">Solar Panel System</h2>
                    <div class="form-group retail-wrap" style="padding: 0 20px;align-items: baseline;height: 63px;">
                        <label style="display: flex;align-items: flex-end;text-align: right;justify-content: flex-end;"
                            for="solarbrand">Panel Brand</label>
                        <input
                            style="border: none;height: 20px;border: none;border-bottom: 1px solid #d1d2d4;border-radius: 0;padding: 0;"
                            type="text" class="form-control" id="solarbrand">
                    </div>
                    <div class="form-group retail-wrap" style="padding: 0 20px;align-items: baseline;height: 63px;">
                        <label style="display: flex;align-items: flex-end;text-align: right;justify-content: flex-end;"
                            for="solarModel">Panel Model</label>
                        <input
                            style="border: none;height: 20px;border: none;border-bottom: 1px solid #d1d2d4;border-radius: 0;padding: 0;"
                            type="text" class="form-control" id="solarModel">
                    </div>
                    <div class="form-group retail-wrap" style="padding: 0 20px;align-items: baseline;height: 63px;">
                        <label style="display: flex;align-items: flex-end;text-align: right;justify-content: flex-end;"
                            for="solarinvertorbrand">Inverter Brand</label>
                        <input
                            style="border: none;height: 20px;border: none;border-bottom: 1px solid #d1d2d4;border-radius: 0;padding: 0;"
                            type="text" class="form-control" id="solarinvertorbrand">
                    </div>
                    <div class="form-group retail-wrap" style="padding: 0 20px;align-items: baseline;height: 63px;">
                        <label style="display: flex;align-items: flex-end;text-align: right;justify-content: flex-end;"
                            for="invetorModel">Inverter Model</label>
                        <input
                            style="border: none;height: 20px;border: none;border-bottom: 1px solid #d1d2d4;border-radius: 0;padding: 0;"
                            type="text" class="form-control" id="invetorModel">
                    </div>
                    <div class="form-group retail-wrap" style="padding: 0 20px;align-items: baseline;height: 63px;">
                        <label style="display: flex;align-items: flex-end;text-align: right;justify-content: flex-end;"
                            for="Inverterseries">Inverter Series</label>
                        <input
                            style="border: none;height: 20px;border: none;border-bottom: 1px solid #d1d2d4;border-radius: 0;padding: 0;"
                            type="text" class="form-control" id="Inverterseries">
                    </div>
                </form>

                <form
                    style="border: 1px solid #00adef;background-color: #d1d2d4;border: 1px solid;padding: 32px 24px;text-align: center;display: flex;flex-direction: column;align-items: center;"
                    id="numbersOfPanel">
                    <div class="form-group numOfPanel-wrap">
                        <label style="display: flex;align-items: flex-end;" for="numPanel">Number Of Panel</label>
                        <input type="text" class="form-control" id="numPanel">
                    </div>
                    <div class="form-group numOfPanel-wrap">
                        <label style="display: flex;align-items: flex-end;" for="powerOutput">Rated power Output
                            (kW)</label>
                        <input type="text" class="form-control" id="powerOutput">
                    </div>
                </form>
            </section>
        </div>

        <!-- Property-Type -->
        <div class="property-type" style="border: 1px solid #000;padding: 20px;background-color: #d1d2d4;">
            <div class="form-row">
                <div class="col-md-2 mb-3">
                    <label style="display: flex;align-items: flex-end;" class="text-danger">Property Type:</label>
                </div>
                <div class="col-md-10 mb-3 d-flex">
                    <div class="d-flex">
                        <div class="form-check form-check-inline" style="display:flex;align-items: center;">
                            <input class="form-check-input" type="checkbox" id="residential">
                            <label style="display: flex;align-items:baseline;margin-right:35px;margin-left:5px;"
                                class="form-check-label" for="residential" style="width: 100px;">Residential</label>
                        </div>
                        <div class="form-check form-check-inline" style="display:flex;align-items: center;">
                            <input class="form-check-input" type="checkbox" id="school">
                            <label style="display: flex;align-items:baseline;margin-right:35px;margin-left:5px;"
                                class="form-check-label" for="school" style=" width: 60px;">School</label>
                        </div>
                        <div class="form-check form-check-inline" style="display:flex;align-items: center;">
                            <input class="form-check-input" type="checkbox" id="commercial">
                            <label style="display: flex;align-items:baseline;margin-right:35px;margin-left:5px;"
                                class="form-check-label" for="commercial">Commercial</label>
                        </div>
                        <div class="form-check form-check-inline" style="display:flex;align-items: center;">
                            <input class="form-check-input" type="checkbox" id="other">
                            <label style="display: flex;align-items:baseline;margin-right:35px;margin-left:5px;"
                                class="form-check-label" for="other">Other</label>
                        </div>
                    </div>
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-2 mb-3">
                    <label style="display: flex;align-items: flex-end;" class="text-danger">Single/Multi Story:</label>
                </div>
                <div class="col-md-10 mb-3 d-flex">
                    <div class="d-flex">
                        <div class="form-check form-check-inline" style="display:flex;align-items: center;">
                            <input class="form-check-input" type="checkbox" id="single">
                            <label style="display: flex;align-items: baseline;margin-right:35px;margin-left:5px;"
                                class="form-check-label" for="single" style="width: 100px;">Single</label>
                        </div>
                        <div class="form-check form-check-inline" style="display:flex;align-items: center;">
                            <input class="form-check-input" type="checkbox" id="multi">
                            <label style="display: flex;align-items: baseline;margin-right:35px;margin-left:5px;"
                                class="form-check-label" for="multi" style=" width: 100px;">Multi</label>
                        </div>
                        <div class="form-check form-check-inline" style="display:flex;align-items: center;">
                            <input class="form-check-input" type="checkbox" id="numOfstc">
                            <label style="display: flex;align-items: baseline;margin-right:35px;margin-left:5px;"
                                class="form-check-label" for="numOfstc">Nunber of small-scale tech
                                certs (STCs) </label>
                        </div>
                    </div>
                    <div style="width: 68%;">
                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text" style="display: flex;align-items:center;">Number of STCs
                                </div>
                            </div>
                            <input type="text" class="form-control" id="numstcs" placeholder="Username">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Accreditation Information  -->
        <div id="accreditationInformation">
            <h2 style="background-color: #00adef;color: #000;text-align: center;padding: 0px 20px;font-weight: 800;font-size: 22px;margin: 0;"
                class="text-white text-left">Accreditation Information</h2>
            <div class="instalerAccrediInfo">
                <form style="border: 1px solid #00adef;" class="installlerDetailsinfo border-0">
                    <h5>INSTALLER DETALS</h5>
                    <div class="form-row" style="padding: 12px 0px 0;margin: 0 0px 15px;font-size: 12px;">
                        <div class="col mb-3">
                            <input type="text" class="form-control" id="fullname" style="width: 85%;">
                            <label style="display: flex;align-items: flex-end;" class="text-uppercase"
                                for="fullname">Full
                                name</label>
                        </div>
                        <div class="col mb-3">
                            <input type="text" class="form-control" id="phone" style="width: 85%;">
                            <label style="display: flex;align-items: flex-end;" class="text-uppercase"
                                for="phone">PHONE</label>
                        </div>
                        <div class="col mb-3">
                            <input type="text" class="form-control" id="address" style="width: 85%;">
                            <label style="display: flex;align-items: flex-end;" class="text-uppercase"
                                for="address">address</label>
                        </div>
                        <div class="col mb-3">
                            <input type="text" class="form-control" id="suburb" style="width: 85%;">
                            <label style="display: flex;align-items: flex-end;" class="text-uppercase"
                                for="suburb">suburb</label>
                        </div>
                        <div class="col mb-3">
                            <input type="text" class="form-control" id="postcode" style="width: 85%;">
                            <label style="display: flex;align-items: flex-end;" class="text-uppercase"
                                for="postcode">postcode</label>
                        </div>
                        <div class="col mb-3">
                            <input type="text" class="form-control" id="accreditationnum" style="width: 85%;">
                            <label style="display: flex;align-items: flex-end;" class="text-uppercase"
                                for="accreditationnum">accreditation number</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="instalerAccrediInfo">
                <form style="border: 1px solid #00adef;" class="form installlerDetailsinfo border-0">
                    <div class="d-flex justify-content-between" style="width: 98%;">
                        <h5 class="text-uppercase">Electrician DETALS</h5>
                        <span>. State as above if details are the same</span>
                    </div>
                    <div class="form-row">
                        <div class="col mb-3">
                            <input type="text" class="form-control" id="fullname" style="width: 85%;">
                            <label style="display: flex;align-items: flex-end;" class="text-uppercase"
                                for="fullname">Full
                                name</label>
                        </div>
                        <div class="col mb-3">
                            <input type="text" class="form-control" id="phone" style="width: 85%;">
                            <label style="display: flex;align-items: flex-end;" class="text-uppercase"
                                for="phone">PHONE</label>
                        </div>
                        <div class="col mb-3">
                            <input type="text" class="form-control" id="address" style="width: 85%;">
                            <label style="display: flex;align-items: flex-end;" class="text-uppercase"
                                for="address">address</label>
                        </div>
                        <div class="col mb-3">
                            <input type="text" class="form-control" id="suburb" style="width: 85%;">
                            <label style="display: flex;align-items: flex-end;" class="text-uppercase"
                                for="suburb">suburb</label>
                        </div>
                        <div class="col mb-3">
                            <input type="text" class="form-control" id="postcode" style="width: 85%;">
                            <label style="display: flex;align-items: flex-end;" class="text-uppercase"
                                for="postcode">postcode</label>
                        </div>
                        <div class="col mb-3">
                            <input type="text" class="form-control" id="accreditationnum" style="width: 85%;">
                            <label style="display: flex;align-items: flex-end;" class="text-uppercase"
                                for="accreditationnum">accreditation number</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="instalerAccrediInfo">
                <form style="border: 1px solid #00adef;" class="form installlerDetailsinfo border-0">
                    <div class="d-flex justify-content-between" style="width: 98%;">
                        <h5 class="text-uppercase">designer DETALS</h5>
                        <span>. State as above if details are the same</span>
                    </div>
                    <div class="form-row">
                        <div class="col mb-3">
                            <input type="text" class="form-control" id="fullname" style="width: 85%;">
                            <label style="display: flex;align-items: flex-end;" class="text-uppercase"
                                for="fullname">Full
                                name</label>
                        </div>
                        <div class="col mb-3">
                            <input type="text" class="form-control" id="phone" style="width: 85%;">
                            <label style="display: flex;align-items: flex-end;" class="text-uppercase"
                                for="phone">PHONE</label>
                        </div>
                        <div class="col mb-3">
                            <input type="text" class="form-control" id="address" style="width: 85%;">
                            <label style="display: flex;align-items: flex-end;" class="text-uppercase"
                                for="address">address</label>
                        </div>
                        <div class="col mb-3">
                            <input type="text" class="form-control" id="suburb" style="width: 85%;">
                            <label style="display: flex;align-items: flex-end;" class="text-uppercase"
                                for="suburb">suburb</label>
                        </div>
                        <div class="col mb-3">
                            <input type="text" class="form-control" id="postcode" style="width: 85%;">
                            <label style="display: flex;align-items: flex-end;" class="text-uppercase"
                                for="postcode">postcode</label>
                        </div>
                        <div class="col mb-3">
                            <input type="text" class="form-control" id="accreditationnum" style="width: 85%;">
                            <label style="display: flex;align-items: flex-end;" class="text-uppercase"
                                for="accreditationnum">accreditation number</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr style="background-color: #00adef; height: 4px;">

        <div id="mendatory-wrap">
            <span>Mandatory written statement by the CEC installer and
                Designer:</span>
            <p class="d-flex flex-wrap pt-3">
                I
                <input type="text" class="form-control w-25" style="border-bottom: 1px solid;">
                (name of installer) was the accredited CEC Instaler that
                completed the SGU installation at
                <input type="text" class="form-control w-25" style="border-bottom: 1px solid;">
                and verify that u have installed the system, it meets the
                CEC accreditation guidlines, CEC accreditation Code of
                practice and I a bound by their Code of Conduct, have used
                panels and inverters approved by the CEC, followed all of
                the Cean Energy Regulators Guidelines, have $5m in public
                liability insurance and the system meets the following
                Australian standard, Where applicatble:-
            </p>
            <div class="row">
                <div class="col-md-4" style="padding: 30px 30px 0 30px;border: 1px solid #d1d2d4;">
                    <h5 style="font-weight: 600;">
                        PV & Inverter Standard
                    </h5>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing
                        elit. Lorem ipsum dolor sit amet consectetur
                        adipisicing elit. Error, quod? Totam ad ipsa ipsum
                        ab voluptas error magni veniam animi similique
                        dignissimos veritatis obcaecati, porro autem
                        doloribus architecto unde consectetur, facere earum.
                    </p>
                </div>
                <div class="col-md-4" style="padding: 30px 30px 0 30px;border: 1px solid #d1d2d4;">
                    <h5 style="font-weight: 600;">
                        Grid connected system
                    </h5>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing
                        elit. Nulla, expedita! Cum, consectetur? Quibusdam
                        deleniti neque tempore dolores, amet ipsam illo nam
                        quia alias hic, quos natus eveniet sint consequatur
                        fugiat. Deserunt ab architecto esse minima delectus
                        obcaecati, quas quo dicta.
                    </p>
                </div>
                <div class="col-md-4" style="padding: 30px 30px 0 30px;border: 1px solid #d1d2d4;">
                    <h5 style="font-weight: 600;">
                        Standalone System
                    </h5>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing
                        elit. Perferendis aliquid, recusandae perspiciatis
                        ut voluptate sequi nisi, aperiam cumque tenetur
                        nesciunt modi! Earum accusantium libero mollitia ea?
                        Architecto quasi deserunt sequi.
                    </p>
                </div>
            </div>
            <div style="display: flex;flex-wrap: wrap;">
                <p>I verify that all Local, state or Territory goverment
                    requirements have been met for.
                    (i) The Siting of the unit (ii) The attachment of the
                    unit to the building or structure.
                    (iii) The grid connection of the system for the SGU
                    installation.
                </p>
                <p style="display: flex;flex-wrap: wrap;">
                    I verify that the SGU is
                    <div class="form-check form-check-inline">
                        <input style="border-top: none;border-left: none;border-right: none;border-radius: 0;"
                            class="form-check-input" type="checkbox" id="grid" style="border-bottom: 1px solid;">
                        <label style="display: flex;align-items: flex-end;" class="form-check-label" for="grid">Grid
                            connection</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input style="border-top: none;border-left: none;border-right: none;border-radius: 0;"
                            class="form-check-input" type="checkbox" id="connected" style="border-bottom: 1px solid;">
                        <label style="display: flex;align-items: flex-end;" class="form-check-label"
                            for="connected">Connected to the grid with
                            battery storage</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input style="border-top: none;border-left: none;border-right: none;border-radius: 0;"
                            class="form-check-input" type="checkbox" id="grid" style="border-bottom: 1px solid;">
                        <label style="display: flex;align-items: flex-end;" class="form-check-label" for="grid"
                            style="margin-top: 17px;">an off grid installation
                            and an
                            electrical worker holding an unristricted
                            licence for electrical work issued by the State
                            or Territory authority for the place where the
                            unit was installed undertook ll wiring of the
                            unit that involve alternating current of 50 or
                            volts or direct current of 120. I confirm that
                            the details in the above statement is correct.</label>
                    </div>
                </p>
            </div>
            <div class="signature-section">
                <div class="row">
                    <div class="col-md-6">
                        <div class="div d-flex signature-wrap border-0">
                            <div  style="display: flex;width: 276px;flex-direction: column;">
                                <div class="canvas">
                                    <img src="demo-logo.png" alt="" style="width: 269px;width: 269px;border-bottom: 1px solid #ced4da;">
                                </div>

                                <label style="display: flex;align-items: flex-end;">Signature of the SGUs CEC
                                    Installer</label>
                            </div>
                            <div class="cec" style="width: 65%;margin-top: 41px;">
                                <input style="border-top: none;border-left: none;border-right: none;border-radius: 0;"
                                    type="text" class="form-control" id="cec" style="border-bottom: 1px solid">
                                <label style="display: flex;align-items: flex-end;" for="cec">CEC Number</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="div d-flex signature-wrap border-0">
                            <div style="display: flex;width: 276px;flex-direction: column;">
                                <div class="canvas">
                                    <img src="demo-logo.png" alt="" style="width: 269px;width: 269px;border-bottom: 1px solid #ced4da;">
                                </div>

                                <label style="display: flex;align-items: flex-end;">Signature of the SGUs CEC
                                    Installer</label>
                            </div>
                            <div class="cec" style="width: 65%;margin-top: 41px;">
                                <input style="border-top: none;border-left: none;border-right: none;border-radius: 0;"
                                    type="text" class="form-control" id="cec1" style="border-bottom: 1px solid">
                                <label style="display: flex;align-items: flex-end;" for="cec1">CEC Number</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="div d-flex signature-wrap border-0">
                            <div class="print" style="width: 95%;margin-top: 41px;margin-right: 10px;">
                                <input style="border-top: none;border-left: none;border-right: none;border-radius: 0;"
                                    type="text" class="form-control" id="print" style="border-bottom: 1px solid">
                                <label style="display: flex;align-items: flex-end;" for="print">Print Name</label>
                            </div>
                            <div class="cec" style="width: 42%;margin-top: 41px;">
                                <input style="border-top: none;border-left: none;border-right: none;border-radius: 0;"
                                    type="date" class="form-control" id="date" style="border-bottom: 1px solid">
                                <label style="display: flex;align-items: flex-end;" for="date">Date</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="div d-flex signature-wrap border-0">
                            <div class="print" style="width: 70%;margin-top: 41px;margin-right: 10px;">
                                <input style="border-top: none;border-left: none;border-right: none;border-radius: 0;"
                                    type="text" class="form-control" id="print1" style="border-bottom: 1px solid">
                                <label style="display: flex;align-items: flex-end;" for="print1">Print Name</label>
                            </div>
                            <div class="cec" style="width: 25%;margin-top: 41px;">
                                <input style="border-top: none;border-left: none;border-right: none;border-radius: 0;"
                                    type="date" class="form-control" id="date1" style="border-bottom: 1px solid">
                                <label style="display: flex;align-items: flex-end;" for="date1">Date</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-6" style="border: 1px solid #d1d2d4;">
                    <div class="list" style="padding: 20px 13px 0px;">
                        <h5 style="font-weight: 600;" class="text-uppercase">mendatory declaration</h5>
                        <ul>
                            <li
                                style="display: flex;flex-wrap: wrap;list-style-type: circle;position: relative;line-height: 35px;">
                                I am the legal owner of the above small generation
                                unit (SGU) and assign the right to create STCs to
                                <input
                                    style="border-top: none;border-left: none;border-right: none;border-radius: 0;width: 30%;height: 27px;margin: 0 8px;"
                                    type="text" class="form-control">
                                for the period stated above, commencing at the date
                                of installation.
                            </li>
                            <li
                                style="display: flex;flex-wrap: wrap;list-style-type: circle;position: relative;line-height: 35px;">
                                I have not previously assign or created any STCs for
                                this system within this period To claim
                                <input
                                    style="border-top: none;border-left: none;border-right: none;border-radius: 0; width: 30%;height: 27px;margin: 0 8px;"
                                    type="text" class="form-control"> years
                                deeming for SGU. STCs must be registered within 12
                                months of installlation.
                            </li>
                            <li
                                style="display: flex;flex-wrap: wrap;list-style-type: circle;position: relative;line-height: 35px;">
                                I Understand I am under no obligation to assign STCs
                                to
                                <input
                                    style="border-top: none;border-left: none;border-right: none;border-radius: 0; width: 30%;height: 27px;margin: 0 8px;"
                                    type="text" class="form-control">
                            </li>
                            <li
                                style="display: flex;flex-wrap: wrap;list-style-type: circle;position: relative;line-height: 35px;">
                                I agree to reay the STC to
                                <input
                                    style="border-top: none;border-left: none;border-right: none;border-radius: 0; width: 30%;height: 27px;margin: 0 8px;"
                                    type="text" class="form-control"> should my assigment be invalid
                            </li>
                            <li
                                style="display: flex;flex-wrap: wrap;list-style-type: circle;position: relative;line-height: 35px;">
                                I understand that an agent of the Clean Energy Regulator or
                                <input
                                    style="border-top: none;border-left: none;border-right: none;border-radius: 0;width: 30%;height: 27px;margin: 0 8px;"
                                    type="text" class="form-control"> may wish to inspect the SGU withnin the five
                                years of certificate redemption
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-6" id="credential" style="margin-top: 41px;">
                    <p class="d-flex" style="flex-wrap: wrap;">
                        I understand that this system is eligible for <input style="border-top: none;border-left: none;border-right: none;border-radius: 0; width: 20%;
                        " type="text" class="form-control" style="border-bottom: 1px solid;">STCs and in exchange for
                        assigning my
                        right to create
                        these STCs, I will recive a point of salle discount from the installer/suppliers.
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="div d-flex signature-wrap border-0">
                                <div>
                                    <canvas style="position: relative;margin: 1px;margin-left: 0px;height:89px;width:100%;" id="sig-canvas"
                                       ></canvas>
                                    <label style="display: flex;align-items: flex-end;">Owner Signature</label>
                                </div>
                                <div class="cec" style="width: 42%;margin-top: 41px;">
                                    <input
                                        style="border-top: none;border-left: none;border-right: none;border-radius: 0;border-bottom: 1px solid;height: 37px; width: 260px;"
                                        type="text" class="form-control" id="ownerdate">
                                    <label style="display: flex;align-items: flex-end;" for="ownerdate">Date</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="div d-flex signature-wrap border-0">
                                <div>
                                    <canvas style="position: relative;margin: 1px;margin-left: 0px;height:89px;width:100%;" id="sig-canvas"
                                       ></canvas>
                                    <label style="display: flex;align-items: flex-end; width: 212px;">Agent / Installer
                                        Signature</label>
                                </div>
                                <div class="cec" style="width: 45%;margin-top: 41px;">
                                    <input
                                        style="border-top: none;border-left: none;border-right: none;border-radius: 0;border-bottom: 1px solid;height: 37px;"
                                        type="text" class="form-control" id="agentdate">
                                    <label style="display: flex;align-items: flex-end;" for="agentdate">Date</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="d-flex flex-wrap">
                        PRIVACY DECLARATION : <input style="border-top: none;border-left: none;border-right: none;border-radius: 0; width: 20%;
                        " type="text" class="form-control" style="border-bottom: 1px solid;">will only use this
                        personal
                        information as Intrnnded and
                        will not sell or divullge this to any parties other than the Clen Energy Regulators.
                    </p>
                </div>
            </div>
        </div>

    </main>
</body>

</html>';

            



            $pdf= PDF::loadHTML($content);
        

           

            // /*$pdf = PDF::load($content)->setPaper('a4', 'landscape');*/
            return $pdf->stream('test_pdf.pdf');

            $pdf = PDF::loadView('job.dynamic_pdf',compact('data','totalpanel'))->setPaper('a4')
            ->setOrientation('landscape');
          /*  $pdf->set_paper('letter', 'landscape');*/
            return $pdf->download('pdfview.pdf');


        /*echo "<pre>";
        print_r($data);
        echo "<pre>";
        exit();

       /* $job = DB::table('jobs')->where('id',$id)->first();

        $pdf = PDF::loadView('job/dynamic_pdf', compact('data','totalpanel'));
      
        return $pdf->download('jobdetails.pdf');*/
    }

	public function delete_extra_panels(Request $request){
		 $id =$request['id'];
		 $Panels=Panels::where('id',$id)->delete();
		 
		
	}
	
	public function delete_extra_inverter(Request $request){
		 $id =$request['id'];
		$Inverter_res=Inverter::where('id',$id)->delete();
	} 

    public function quick_search(Request $request){
        $keyword = $request['keyword'];

        $Array= DB::table('aprovd_panels')
        ->select('licenseecertificate_holder_account_account_name', 'model_numbers')
        ->where('licenseecertificate_holder_account_account_name', 'like', '%'. $keyword.'%')
        ->orWhere('model_numbers','like','%'. $keyword.'%') 
        ->limit(100)                                   
        ->get()->toArray();

        //echo "<pre>";print_r($Array);die;
        $quick_search = array();
        $arr= array();  
        foreach($Array as $key=>$value){
            $LHAAN = $value->licenseecertificate_holder_account_account_name;
            $model_number = substr($value->model_numbers,2,3);
            
           
            $search = $LHAAN .' - '. $model_number.' - watt';
            //echo $search;
            $arr1= array('LHAAN'=>$LHAAN,'model_number'=>$value->model_numbers,'search'=>$search);
            
            array_push($arr,$arr1);
        }
        //echo "<pre>";print_r($arr);die;
        return $arr;
	} 
    public function quick_search_inverter(Request $request){
        $keyword = $request['keyword'];

        $Array= DB::table('aprovd_inverters')
        ->select('equipment_category', 'manufacturer_certificate_holder','series','model_number','rated_apparent_ac_power')
        ->where('equipment_category', 'like', '%'. $keyword.'%')
        ->orWhere('manufacturer_certificate_holder','like','%'. $keyword.'%') 
        ->orWhere('series','like','%'. $keyword.'%') 
        ->orWhere('model_number','like','%'. $keyword.'%') 
        ->limit(20)                                   
        ->get()->toArray();

        //echo "<pre>";print_r($Array);die;
         $quick_search = array();
         $arr= array();  
            foreach($Array as $key=>$value){
               $category = $value->equipment_category;
               $brand= $value->manufacturer_certificate_holder;
               $series= $value->series;
               $model_number = $value->model_number;
               $watt = $value->rated_apparent_ac_power;
                
            
                $search = $brand .' - '. $model_number;
                //echo $search;
                $arr1= array('category'=>$category,'brand'=>$brand,'series'=>$series,'model'=>$model_number,'watt'=>$watt,'search'=>$search);
                
                array_push($arr,$arr1);
            }
        //echo "<pre>";print_r($arr);die;
        return $arr;
	} 
}