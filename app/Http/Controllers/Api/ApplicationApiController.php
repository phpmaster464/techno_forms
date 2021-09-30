<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Installer;
use App\Models\Jobs;
use App\Models\InvetrerSerials;
use App\Models\PanelSerials;
use App\Models\Inverter;
use App\Models\Panels;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Auth;
use Carbon\Carbon;
use DB;

class ApplicationApiController extends Controller
{ 
    /**
     * Installer Jobs List
     */

    public function installer_job_list(Request $request)
    {
        
        if (!isset(Auth::guard('api')->user()->id)) {
            return response()->json(['status'=>400,'message' => 'You must be logged in to get Data'], 400); 
        }
        $installer_email = Auth::guard('api')->user()->email;
        
        $intsaller_id = Installer::where('email',$installer_email)->select('id')->first()->toArray();  
       
        $jobs = Jobs::where('installer_type',$intsaller_id['id'])->OrWhere('Designer_type',$intsaller_id['id'])->OrWhere('Electrician',$intsaller_id['id'])->get()->toArray();

        
        $today = Carbon::now();
       
        $signatures = array('installer_signature','designer_signature','electrician_signature','owner_signature');
        
        foreach ($jobs as $job_key => $job_value) {

            $signature_count = 0;
            foreach ($signatures as $signature){
                if ($jobs[$job_key][$signature]!='')
                {
                    $signature_count++;
                }
            }
            $jobs[$job_key]['total_signatures'] = count($signatures);
            $jobs[$job_key]['total_pending_signatures'] = count($signatures) - $signature_count;

            $job_id = $job_value['id'];
            $ownerpostal = $job_value['owner_postal_address_type'];
            $same_as_owner_address = $job_value['same_as_owner_address'];
            $instalpostal = $job_value['installation_postal_address_type'];
            $deeming_Period = $job_value['Deeming_Period'];
            $installer_state = $job_value['Installer_state'];

            $owner_unit_type = $job_value['owner_unit_type'];
            $unit_type_value = DB::table('unit_types')->where('id',$owner_unit_type)->select('unit_type_value')->first();
            $jobs[$job_key]['owner_unit_type'] = @$unit_type_value->unit_type_value;

            $installation_unit_type = $job_value['installation_unit_type'];
            $unit_type_value = DB::table('unit_types')->where('id',$installation_unit_type)->select('unit_type_value')->first();
            $jobs[$job_key]['installation_unit_type'] = @$unit_type_value->unit_type_value;

            $owner_street_type = $job_value['owner_street_type'];
            $street_type_value = DB::table('street_types')->where('id',$owner_street_type)->select('street_type_value')->first(); 
            $jobs[$job_key]['owner_street_type'] = @$street_type_value->street_type_value;

            $installation_street_type = $job_value['installation_street_type'];
            $street_type_value = DB::table('street_types')->where('id',$installation_street_type)->select('street_type_value')->first(); 
            $jobs[$job_key]['installation_street_type'] = @$street_type_value->street_type_value;

            $installer_type = $job_value['installer_type'];
            $installer_first_name = DB::table('installers')->where('id',$installer_type)->select('first_name')->first();
            $jobs[$job_key]['installer_type'] = @$installer_first_name->first_name;

            $designer_type = $job_value['Designer_type'];
            $designer_first_name = DB::table('installers')->where('id',$designer_type)->select('first_name')->first();
            $jobs[$job_key]['Designer_type'] = @$designer_first_name->first_name;

            $electrician = $job_value['Electrician'];
            $electrician_first_name = DB::table('installers')->where('id',$electrician)->select('first_name')->first();
            $jobs[$job_key]['Electrician'] = @$electrician_first_name->first_name;
          
            $installation_date = Carbon::parse($job_value['installation_date']);
            $jobs[$job_key]['installer_name'] = $this->getInstaller($job_value['installer_type']);
            $jobs[$job_key]['designer_name'] = $this->getInstaller($job_value['Designer_type']);
            $jobs[$job_key]['electrician_name'] = $this->getInstaller($job_value['Electrician']);
            
            //other image section start
            $other_image_arr = array('Back_panel_label','inverter_label','installerselfie','Capture_Photo','Metabox','Swithboard','CES');
            foreach($other_image_arr as $other_image){
                $jobs[$job_key][$other_image] = null;
            }
            $other_images = DB::table('job_image_type')->select('image_type','image')->where('job_id',$job_id)->whereIn('image_type',$other_image_arr)->get();
            foreach($other_images as $key=>$other_image){
                $jobs[$job_key][$other_image->image_type]=$other_image->image;
            }
            //other image end
            if($installation_date < $today){
                $jobs[$job_key]['job_date_type'] = 'History';  
            }else{
                $jobs[$job_key]['job_date_type'] = 'Current'; 
            }

            if($ownerpostal==1){
                $jobs[$job_key]['owner_postal_address_type'] = 'Physical address';  
            }else{
                 $jobs[$job_key]['owner_postal_address_type'] = 'P.O BOX'; 
            }

            if($instalpostal==1){
                $jobs[$job_key]['installation_postal_address_type'] = 'Physical address';  
            }else{
                 $jobs[$job_key]['installation_postal_address_type'] = 'P.O BOX'; 
            }

            if($same_as_owner_address==1){
                $jobs[$job_key]['same_as_owner_address'] = 'Yes';  
            }else{
                 $jobs[$job_key]['same_as_owner_address'] = 'No'; 
            }

            if($deeming_Period==1){
                $jobs[$job_key]['Deeming_Period'] = '10 Years';  
            }
            elseif($deeming_Period==2){
                $jobs[$job_key]['Deeming_Period'] = '20 Years';  
            }
            else{
                 $jobs[$job_key]['Deeming_Period'] = '30 Years'; 
            }

            if($installer_state==1){
                $jobs[$job_key]['Installer_state'] = 'select 1';  
            }
            elseif($installer_state==2){
                $jobs[$job_key]['Installer_state'] = 'select 2';  
            }
            else{
                 $jobs[$job_key]['Installer_state'] = 'select 3'; 
            }
       
            $panels = DB::table('tbl_panels')->where('job_id',$job_id)->get()->toArray();   
            $balance = DB::table('tbl_panels')->where('job_id' ,$job_id)->sum('enter_no_of_solar_panal');
            
            
            
            $panel_fields = array();
            $i= 0;
            $j = 0;
            $count = 0;
            

            $panel_total_images = 0;
            $panel_pending_images = 0;

            foreach ($panels as $panels_key => $panels_value) {  
                $panel_id = $panels_value->id;
                $job_id = $panels_value->job_id;
                $panels_Brand = $panels_value->Panels_Brand;
                $panels_Model = $panels_value->Panels_Model;
              
                if($panels_Brand==1){
                    $panels[$panels_key]->Panels_Brand = 'select 1';  
                }
                elseif($panels_Brand==2){
                    $panels[$panels_key]->Panels_Brand = 'select 2';  
                }
                else{
                     $panels[$panels_key]->Panels_Brand = 'select 3'; 
                }

                if($panels_Model==1){
                    $panels[$panels_key]->Panels_Model = 'select 1';  
                }
                elseif($panels_Model==2){
                    $panels[$panels_key]->Panels_Model = 'select 2';  
                }
                else{
                     $panels[$panels_key]->Panels_Model = 'select 3'; 
                }

                $panel_fields[$panels_key][$i] = '';

                $panel_fields_serials[$panels_key][$i] = array('panel_serial_numbers'=> '','panel_image'=>'');
               
                $panel_serial_numbers = DB::table('panel_serial_numbers')->where('panel_id',$panel_id)->where('job_id',$job_id)->get();
                $count_image_panel =0;
                for($p=0;$p<$panels_value->enter_no_of_solar_panal;$p++)
                {
                    $panel_fields[$panels_key][$p] = isset($panel_serial_numbers[$p]->Panel_Serial_Numbers)?$panel_serial_numbers[$p]->Panel_Serial_Numbers : '';
                    $panel_image = '';
                    if(isset($panel_serial_numbers[$p]) && $panel_serial_numbers[$p] !=''){

                        $panel_image_count = DB::table('tbl_panels_images')->where('panel_id',$panel_serial_numbers[$p]->panel_id)->where('serial_number',$panel_serial_numbers[$p]->Panel_Serial_Numbers)->count();
                        if($panel_image_count > 0)
                        {  
                                $panel_total_images= $panel_image_count;
                                $panel_image_data = DB::table('tbl_panels_images')->where('panel_id',$panel_serial_numbers[$p]->panel_id)->where('serial_number',$panel_serial_numbers[$p]->Panel_Serial_Numbers)->select('image')->first();
                                $panel_image = $panel_image_data->image;
                               
                        }
                        
                        if(count($panel_serial_numbers) > 0){
                            
                            $panel_fields_serials[$panels_key][$p] = array(
                            'panel_serial_numbers'=>isset($panel_serial_numbers[$p]->Panel_Serial_Numbers)?$panel_serial_numbers[$p]->Panel_Serial_Numbers : '',
                            'panel_image'=>$panel_image);

                            if(isset($panel_fields_serials[$panels_key][$p]['panel_image']) && $panel_fields_serials[$panels_key][$p]['panel_image'] !='')
                            {    
                                $count_image_panel++;
                            }
                        }

                    }
                } 
                //echo $panel_image_count_test;
                $panels[$panels_key]->panel_serial_no = $panel_fields[$panels_key];    
                $panels[$panels_key]->panel_image = $panel_fields_serials[$panels_key];  
                $panels[$panels_key]->panel_total_images =  count($panel_serial_numbers);  
                $panels[$panels_key]->panel_pending_images =  count($panel_serial_numbers)- $count_image_panel;
                         
                $i= 0;
                $j = 0; 
            }  



            $inverters = DB::table('tbl_inverters')->where('job_id',$job_id)->get()->toArray();     
            $Enter_number_of_inverter = DB::table('tbl_inverters')->where('job_id' ,$job_id)->sum('Enter_number_of_inverter'); 
            $inverter_fields = array();
            $i= 0;
            $j = 0;


            $inverter_total_images = 0;
            $inverter_pending_images = 0;
            foreach ($inverters as $inverters_key => $inverters_value) {
                
                $inverter_id = $inverters_value->id;
                $job_id = $inverters_value->job_id;
                $inverter_Brand = $inverters_value->inverter_Brand;
                $inverter_Series = $inverters_value->inverter_Series;
                $inverter_Model = $inverters_value->inverter_Model;

                if($inverter_Brand==1){
                    $inverters[$inverters_key]->inverter_Brand = 'select 1';  
                }
                elseif($inverter_Brand==2){
                    $inverters[$inverters_key]->inverter_Brand = 'select 2';  
                }
                else{
                     $inverters[$inverters_key]->inverter_Brand = 'select 3'; 
                }

                if($inverter_Series==1){
                    $inverters[$inverters_key]->inverter_Series = 'select 1';  
                }
                elseif($inverter_Series==2){
                    $inverters[$inverters_key]->inverter_Series = 'select 2';  
                }
                else{
                     $inverters[$inverters_key]->inverter_Series = 'select 3'; 
                }

                if($inverter_Model==1){
                    $inverters[$inverters_key]->inverter_Model = 'select 1';  
                }
                elseif($inverter_Model==2){
                    $inverters[$inverters_key]->inverter_Model = 'select 2';  
                }
                else{
                     $inverters[$inverters_key]->inverter_Model = 'select 3'; 
                }
                


                $inverter_fields[$inverters_key][$i] = '';

                $inverter_fields_serials[$inverters_key][$i] = array('inverter_serial_numbers'=> '','inverter_image'=>'');
                
                $invetrers_serial_numbers = DB::table('invetrers_serial_numbers')->where('inverter_id',$inverter_id)->where('job_id',$job_id)->get();
                $count_image_inverter=0;
                for($p=0;$p<$inverters_value->Enter_number_of_inverter;$p++)
                {   
                    $inverter_image = '';
                    
                    $inverter_fields[$inverters_key][$p] = isset($invetrers_serial_numbers[$p]->Invetrers_Serial_Numbers)?$invetrers_serial_numbers[$p]->Invetrers_Serial_Numbers : '';
                
                    if(isset($invetrers_serial_numbers[$p]) && $invetrers_serial_numbers[$p] !=''){
                        $invetrer_image_count = DB::table('tbl_inverter_images')->where('inverter_id',$invetrers_serial_numbers[$p]->inverter_id)->where('serial_number',$invetrers_serial_numbers[$p]->Invetrers_Serial_Numbers)->count();

                        if($invetrer_image_count > 0){
                            $inverter_total_images= $invetrer_image_count;
                            $inverter_image_data = DB::table('tbl_inverter_images')->where('inverter_id',$invetrers_serial_numbers[$p]->inverter_id)->where('serial_number',$invetrers_serial_numbers[$p]->Invetrers_Serial_Numbers)->select('image')->first();
                            $inverter_image = $inverter_image_data->image;

                        }

                        if(count($invetrers_serial_numbers) > 0){
                            $inverter_fields_serials[$inverters_key][$p] = array(
                                'inverter_serial_numbers'=>isset($invetrers_serial_numbers[$p]->Invetrers_Serial_Numbers)?$invetrers_serial_numbers[$p]->Invetrers_Serial_Numbers : '',
                                'inverter_image'=>$inverter_image);
                            if(isset($inverter_fields_serials[$inverters_key][$p]['inverter_image']) && $inverter_fields_serials[$inverters_key][$p]['inverter_image'] !='')
                            {    
                                $count_image_inverter++;
                            }
                        }
                        
                    }
                }   
               
                $inverters[$inverters_key]->inverter_serial_no = $inverter_fields[$inverters_key];
                $inverters[$inverters_key]->inverter_image = $inverter_fields_serials[$inverters_key]; 
                $inverters[$inverters_key]->inverter_total_images =  count($invetrers_serial_numbers);
                $inverters[$inverters_key]->inverter_pending_images =  count($invetrers_serial_numbers)- $count_image_inverter; 

                $i= 0;
                $j = 0;
            }
            
            $jobs[$job_key]['panels'] = $panels; 
            $jobs[$job_key]['inverters'] = $inverters; 
        }  


       
        if(isset($request->job_date_type) && $request->job_date_type != '')
        {   

            foreach ($jobs as $job_key => $job_value) {


                if($request->job_date_type == 'Current')
                {
                   if($job_value['job_date_type'] != 'Current')
                   {
                    unset($jobs[$job_key]);
                   }
                }
                if($request->job_date_type == 'History')
                {
                   if($job_value['job_date_type'] != 'History')
                   {
                    unset($jobs[$job_key]);
                   }
                }

            }
        }
        
        $jobs = array_merge($jobs);
        if(isset($jobs)&&count($jobs)>0){
           return response()->json(['status'=>200,'message' => 'Jobs Found','data' => $jobs], 200); 
        }
        else{
            return response()->json(['status'=>200,'message' => 'No Jobs Found',], 200); 
        }

        


        
    }

    public function getInstaller($id)
    {
     $intsaller = Installer::where('id',$id)->select('first_name')->first()->toArray();  
     return $intsaller['first_name'];
    }


    public function job_start_end(Request $request)
    {

        $job = Jobs::where('id',$request->id)->first()->toArray();

        if($job['job_end_date'] != '')
        {
          return response()->json(['status'=>400,'message' => 'Job Already Ended'], 400);  
        }

        if($job['job_start_date'] == '')
        {
            $update = array('job_start_date'=>Carbon::now(),'job_status'=>'In Progress');
            Jobs::where('id',$request->id)->update($update);
            return response()->json(['status'=>200,'message' => 'Job Started'], 200);
        }
        else
        {
            $update = array('job_end_date'=>Carbon::now(),'job_status'=>'Completed By Installer');
            Jobs::where('id',$request->id)->update($update);
            return response()->json(['status'=>200,'message' => 'Job Ended'], 200);
        } 
    }

    public function scan_panel_serial_number(Request $request)
    { 
        $panel_serial_count = PanelSerials::where('job_id',$request->job_id)->where('panel_id',$request->panel_id)->where('Panel_Serial_Numbers',$request->panel_serial_no)->count();

        if($panel_serial_count > 0) 
        {
             $panel_serial = PanelSerials::where('job_id',$request->job_id)->where('panel_id',$request->panel_id)->where('Panel_Serial_Numbers',$request->panel_serial_no)->first()->toArray();

             if($panel_serial['panel_serial_number_scanned'] != 1)
             {
                $serial = array('panel_serial_number_scanned'=>1);

                PanelSerials::where('id',$panel_serial['id'])->update($serial);

                return response()->json(['status'=>200,'message' => 'Serial Number Updated'], 200);
             }
             else
             {
                return response()->json(['status'=>200,'message' => 'Serial Number Already Scanned'], 200);
             } 

             return response()->json(['status'=>200,'message' => 'Updated'], 200);
        }
        else
        {
            return response()->json(['status'=>400,'message' => 'Serial Number Not Found'], 400);
        }
    }

  public function scan_inverter_serial_number(Request $request)
    { 

   

        $inverter_serial_count = InvetrerSerials::where('job_id',$request->job_id)->where('inverter_id',$request->inverter_id)->where('Invetrers_Serial_Numbers',$request->inverter_serial_no)->count();

        if($inverter_serial_count > 0) 
        {
           $inverter_serial = InvetrerSerials::where('job_id',$request->job_id)->where('inverter_id',$request->inverter_id)->where('Invetrers_Serial_Numbers',$request->inverter_serial_no)->first()->toArray();

           if($inverter_serial['inverter_serial_number_scanned'] != 1)
           {
            $serial = array('inverter_serial_number_scanned'=>1);

            InvetrerSerials::where('id',$inverter_serial['id'])->update($serial);

            return response()->json(['status'=>200,'message' => 'Serial Number Updated'], 200);
        }
        else
        {
            return response()->json(['status'=>200,'message' => 'Serial Number Already Scanned'], 200);
        } 

        return response()->json(['status'=>200,'message' => 'Updated'], 200);
    }
    else
    {
        return response()->json(['status'=>400,'message' => 'Serial Number Not Found'], 400);
    }
}

public function upload_panel_image(Request $request)
{


    $files = $request->file('panel_image');
    $panel_image = '';
    foreach ($files as $key => $value) {
       
        if ($request->hasFile('panel_image')) {
            $image=$value;
            $destination_path = 'uploads/panel_image/'; 
            $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

            $filename = str_replace(array( '(', ')' ), '', $filename);
            $image->move($destination_path, $filename);
            $panel_image = $destination_path . $filename;

            $panel_array = array('panel_id'=>$request->panel_id,'image'=>$panel_image,'serial_number'=>$request->serial_number[$key]);

            DB::table('tbl_panels_images')->insert($panel_array); 
        }
    }

     return response()->json(['status'=>200,'message' => 'Panel Image Updated'], 200);
    
    

      // $panel_image = '';
      //   if ($request->hasFile('panel_image')) {
      //       $image=$request->file('panel_image');
      //       $destination_path = 'uploads/panel_image/'; 
      //       $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

      //       $filename = str_replace(array( '(', ')' ), '', $filename);
      //       $image->move($destination_path, $filename);
      //       $panel_image = $destination_path . $filename;
      //   }

      //   $panel = array('panel_image'=>$panel_image);

      //   Panels::where('id',$request->panel_id)->update($panel);

        


}

public function upload_inverter_image(Request $request)
{
    $inverter_image = '';
        if ($request->hasFile('inverter_image')) {
            $image=$request->file('inverter_image');
            $destination_path = 'uploads/inverter_image/'; 
            $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

            $filename = str_replace(array( '(', ')' ), '', $filename);
            $image->move($destination_path, $filename);
            $inverter_image = $destination_path . $filename;
        }
      /*  $inverter = array('inverter_image'=>$inverter_image);*/

         Inverter::where('id',$request['id'])->update(['inverter_image'=>$inverter_image]); 

        return response()->json(['status'=>200,'message' => 'Iverter Image Updated'], 200);


}

public function delete_job_image(Request $request)
{

    if($request->type == 'Inverter')
    {
        /*$totalinverter= InvetrerSerials::where('job_id',$request->id)->sum('Invetrers_Serial_Numbers');*/
        $inverterdata = DB::table('jobs')
                ->join('tbl_inverters', 'jobs.id', '=', 'tbl_inverters.job_id')
               /* ->join('invetrers_serial_numbers', 'jobs.id', '=', 'invetrers_serial_numbers.job_id')*/
                /*->select('invetrers_serial_numbers.inverter_id','invetrers_serial_numbers.id')*/
                 ->select('tbl_inverters.id')
                ->where('jobs.id',$request->id)         
                ->get()->toArray();

     
        foreach ($inverterdata as $key => $value) 
        {
         
            $invereter = DB::table('tbl_inverter_images')->where('inverter_id',$value->id)->update(['image' => 'Null']);
           /* echo "<pre>";
            print_r($invereter);
            echo "<pre>";*/
           
        }
       
        /*return response()->json(['status'=>200,'message' => $countsignatureimage.'Is Pending'], 200);*/
    }

     if($request->type == 'Panel')
    {
        /*$totalinverter= InvetrerSerials::where('job_id',$request->id)->sum('Invetrers_Serial_Numbers');*/
        $paneldata = DB::table('jobs')
                ->join('tbl_panels', 'jobs.id', '=', 'tbl_panels.job_id')
                ->select('tbl_panels.id')
                ->where('jobs.id',$request->id)         
                ->get()->toArray();

        foreach ($paneldata as $key => $value) 
        {
         
            $panel = DB::table('tbl_panels_images')->where('panel_id',$value->id)->update(['image' => 'Null']);
            echo "<pre>";
            print_r($panel);
            echo "<pre>";
           
        }
       
        /*return response()->json(['status'=>200,'message' => $countsignatureimage.'Is Pending'], 200);*/
    }

    if($request->type == 'Instalation')
    {
       DB::table('tbl_installation_images')->where('id', $request['id'])->update(['image' => 'Null']);
       return response()->json(['status'=>200,'message' => 'Remove installation Image Successfully'], 200);
    } 
    if($request->type == 'Signature')
    {
       
        $jobdata= DB::table('jobs')->select('installer_signature','designer_signature','electrician_signature','owner_signature')->where('id', $request['id'])->first();
        
        $str = str_replace("[","",$request->sub_type[0]);
        $str = str_replace("]","",$str);
        $sub_type = explode(',',$str);
       
        $count=4;
        $count_image=0;

        if(in_array('installer_signature', $sub_type)){
            $ins = NULL;
            $count_image++;
        } 
        else{
            $ins = $jobdata->installer_signature;
        }
        if(in_array('designer_signature', $sub_type))
        {
            $ds= Null;
            $count_image++;
        }
        else{
            $ds = $jobdata->designer_signature;
        }
        if(in_array('electrician_signature', $sub_type))
        {
            $es= Null;
            $count_image++;
        }
        else{
            $es = $jobdata->electrician_signature;
        }
        if(in_array('owner_signature', $sub_type))
        {
            $os= Null;
            $count_image++;
        }
        else{
            $os = $jobdata->owner_signature;
        }

         $countsignatureimage=$count-$count_image;
       
            Jobs::where('id',$request['id'])->update(['installer_signature'=>$ins,'designer_signature'=>$ds,'electrician_signature'=>$es,'owner_signature'=>$os]); 

        return response()->json(['status'=>200,'message' => $countsignatureimage.'Is Pending'], 200);

    }
    else
    {
        if($request->type == 'Back_panel_label')
        {
            DB::table('job_image_type')->where('id', $request['id'])->update(['image' => 'Null']);
            return response()->json(['status'=>200,'message' => 'Remove Back Panel Image Successfully'], 200);
        }
        if($request->type == 'Capture_Photo')
        {
            DB::table('job_image_type')->where('id', $request['id'])->update(['image' => 'Null']);
            return response()->json(['status'=>200,'message' => 'Remove Capture Photo Successfully'], 200);
        }
        if($request->type == 'inverter_label')
        {
            DB::table('job_image_type')->where('id', $request['id'])->update(['image' => 'Null']);
            return response()->json(['status'=>200,'message' => 'Remove Inverter label Image Successfully'], 200);
        }
        if($request->type == 'installerselfie')
        {
            DB::table('job_image_type')->where('id', $request['id'])->update(['image' => 'Null']);
            return response()->json(['status'=>200,'message' => 'Remove Installer Selfie Successfully'], 200);
        }
        if($request->type == 'Metabox')
        {
            DB::table('job_image_type')->where('id', $request['id'])->update(['image' => 'Null']);
            return response()->json(['status'=>200,'message' => 'Remove Metabox Photo Successfully'], 200);
        }
        if($request->type == 'Swithboard')
        {
            DB::table('job_image_type')->where('id', $request['id'])->update(['image' => 'Null']);
            return response()->json(['status'=>200,'message' => 'Remove Swithboard Photo Successfully'], 200);
        }
        if($request->type == 'CES')
        {
            DB::table('job_image_type')->where('id', $request['id'])->update(['image' => 'Null']);
            return response()->json(['status'=>200,'message' => 'Remove CES Successfully'], 200);
        }
        if($request->type == 'Front_Property')
        {
            DB::table('job_image_type')->where('id', $request['id'])->update(['image' => 'Null']);
            return response()->json(['status'=>200,'message' => 'Remove Front Property Successfully'], 200);
        }
    }
   
}


public function job_list_count_new(Request $request)
{

    if($request->type == 'Panel')
    {

        $total= PanelSerials::where('job_id',$request->id)->count('Panel_Serial_Numbers');
        $count_image=0;

        $str = str_replace("[","",$request->serial_number[0]);
        $str = str_replace("]","",$str);

        $serial_array = explode(',',$str);

         $paneldata = DB::table('jobs')
                /*->join('tbl_panels', 'jobs.id', '=', 'tbl_panels.job_id')*/
                ->join('panel_serial_numbers', 'jobs.id', '=', 'panel_serial_numbers.job_id')
                ->select('panel_serial_numbers.id','panel_serial_numbers.panel_id')
                ->where('jobs.id',$request->id)         
                ->get()->toArray();

        if(count($serial_array) != count($request->panel_image))
        {
            return response()->json(['status'=>400,'message' => 'image and serial numbers count is not same'], 400);
        }
 
        foreach ($paneldata as $key => $value) 
        {
            
            $files = $request->file('panel_image');
            $panel_image = '';
            foreach ($files as $key1 => $value1) 
            {
               
                    $image=$value1;
                   
                    $destination_path = 'uploads/panel_image/'; 
                    $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName());

                    $filename = str_replace(array( '(', ')' ), '', $filename);
                    $image->move($destination_path, $filename);
                    $panel_image = $destination_path . $filename;

                    if($request->hasFile('panel_image') !='' && $request->hasFile('panel_image') !=NUll)
                    {
                         $count_image++;
                    } 

                    $panel_array = array('panel_id'=>$value->panel_id,'image'=>$panel_image,'serial_number'=>$serial_array[$key1]);
                     
                    $countpanelimage=$total-$count_image;
                        DB::table('tbl_panels_images')->insert($panel_array); 
            }
            return response()->json(['status'=>200,'message' => $countpanelimage .' Is Pending'], 200);

           
        }

    }

    if($request->type == 'Inverter')
    {

        $total= InvetrerSerials::where('job_id',$request->id)->count('Invetrers_Serial_Numbers');
       
        $count_image=0; 

        $str = str_replace("[","",$request->serial_number[0]);
        $str = str_replace("]","",$str);

        $serial_array = explode(',',$str);

        $inverterdata = DB::table('jobs')
                ->join('invetrers_serial_numbers', 'jobs.id', '=', 'invetrers_serial_numbers.job_id')
                ->select('invetrers_serial_numbers.id','invetrers_serial_numbers.inverter_id')
                ->where('jobs.id',$request->id)         
                ->get()->toArray();

        if(count($serial_array) != count($request->inverter_image))
        {
            return response()->json(['status'=>400,'message' => 'image and serial numbers count is not same'], 400);
        } 

        foreach ($inverterdata as $key => $value) 
        {
           
            $files = $request->file('inverter_image');
            $panel_image = '';
            foreach ($files as $key1 => $value1) 
            {
               
                    $image=$value1;
                   
                    $destination_path = 'uploads/inverter_image/'; 
                    $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName());

                    $filename = str_replace(array( '(', ')' ), '', $filename);
                    $image->move($destination_path, $filename);
                    $inverter_image = $destination_path . $filename;

                    if($request->hasFile('inverter_image') !='' && $request->hasFile('inverter_image') !=NUll)
                    {
                         $count_image++;
                    } 

                    $inverter_array = array('inverter_id'=>$value->inverter_id,'image'=>$inverter_image,'serial_number'=>$serial_array[$key1]);
                     
                    $countinterverimage=$total-$count_image;
                        DB::table('tbl_inverter_images')->insert($inverter_array); 
            }
            return response()->json(['status'=>200,'message' => $countinterverimage.'Is Pending'], 200);
           
        }

    }

    if($request->type == 'Signature')
    {

        $count=4;
        $count_image=0;

            $installer_signature = '';
            if ($request->hasFile('installer_signature')) {
                /*$count_image=count(array('installer_signature'));*/
                $image=$request->file('installer_signature');
                $destination_path = 'uploads/job/installer/'; 
                $filename1 = sha1(time() . time()) . preg_replace('/\s+/', '',$image->getClientOriginalName()); //to trim whitespace in file na
                $filename = str_replace(array( '(', ')' ), '',$filename1);            
                $image->move($destination_path,$filename);
                $installer_signature = $destination_path . $filename;

                if($request->hasFile('installer_signature') !='' && $request->hasFile('installer_signature') !=NUll)
                {
                     $count_image++;
                } 
            } 

            $designer_signature = '';
            if ($request->hasFile('designer_signature')) {
                $image=$request->file('designer_signature');
                $destination_path = 'uploads/job/designer/'; 
                $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

                $filename = str_replace(array( '(', ')' ), '', $filename);
                $image->move($destination_path, $filename);
                $designer_signature = $destination_path . $filename;

                if($request->hasFile('designer_signature') !='' && $request->hasFile('designer_signature') !=NUll)
                {
                     $count_image++;
                }
               
                
            } 

            $electrician_signature = '';
            if ($request->hasFile('electrician_signature')) {
                $image=$request->file('electrician_signature');
                $destination_path = 'uploads/job/electrician/'; 
                $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

                $filename = str_replace(array( '(', ')' ), '', $filename);
                $image->move($destination_path, $filename);
                $electrician_signature = $destination_path . $filename;

                if($request->hasFile('electrician_signature') !='' && $request->hasFile('electrician_signature') !=NUll)
                {
                     $count_image++;
                }

            }

            $owner_signature = '';
            if ($request->hasFile('owner_signature')) {
                $image=$request->file('owner_signature');
                $destination_path = 'uploads/job/owner/'; 
                $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

                $filename = str_replace(array( '(', ')' ), '', $filename);
                $image->move($destination_path, $filename);
                $owner_signature = $destination_path . $filename;

                if($request->hasFile('owner_signature') !='' && $request->hasFile('owner_signature') !=NUll)
                {
                     $count_image++;
                }

            }

            $countsignatureimage=$count-$count_image;
           /* print_r($count-$count_image." Is Pending");
            die();*/
            Jobs::where('id',$request['id'])->update(['installer_signature'=>$installer_signature,'designer_signature'=>$designer_signature,'electrician_signature'=>$electrician_signature,'owner_signature'=>$owner_signature]); 

        return response()->json(['status'=>200,'message' => $countsignatureimage.'Is Pending'], 200);
    }

    if($request->type == 'Instalation')
    {

        $files = $request->file('installation_image');
      
            $installation_image = '';
            foreach ($files as $key => $value) 
            {

                    $image=$value;
                    
                    $destination_path = 'uploads/installation_image/'; 
                    $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName());

                    $filename = str_replace(array( '(', ')' ), '', $filename);
                    $image->move($destination_path, $filename);
                    $installation_image = $destination_path . $filename;

                  
                        $panel_array = array('job_id'=>$request['id'],'image'=>$installation_image);
                        
                        DB::table('tbl_installation_images')->insert($panel_array); 
            }

        return response()->json(['status'=>200,'message' => 'Installation Image Updated'], 200);

    }   

    else
    {
        if($request->type == 'Back_panel_label')
        {
            $backpanellabel_image = '';
            if ($request->hasFile('backpanellabel_image')) {
                $image=$request->file('backpanellabel_image');
                $destination_path = 'uploads/backpanellabel_image/'; 
                $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

                $filename = str_replace(array( '(', ')' ), '', $filename);
                $image->move($destination_path, $filename);
                $backpanellabel_image = $destination_path . $filename;
            }


            DB::table('job_image_type')->insert(['job_id'=>$request['id'],'image_type'=>$request['type'],'image'=>$backpanellabel_image]); 

            return response()->json(['status'=>200,'message' => 'Back Panel Image Updated'], 200);
        }
        if($request->type == 'inverter_label')
        {
            $inverter_label_image = '';
            if ($request->hasFile('inverter_label_image')) {
                $image=$request->file('inverter_label_image');
                $destination_path = 'uploads/inverter_label_image/'; 
                $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

                $filename = str_replace(array( '(', ')' ), '', $filename);
                $image->move($destination_path, $filename);
                $inverter_label_image = $destination_path . $filename;
            }


            DB::table('job_image_type')->insert(['job_id'=>$request['id'],'image_type'=>$request['type'],'image'=>$inverter_label_image]); 

            return response()->json(['status'=>200,'message' => 'Inverter Label Image Updated'], 200);
        }
        if($request->type == 'installerselfie')
        {
            $installerselfie_image = '';
            if ($request->hasFile('installerselfie_image')) {
                $image=$request->file('installerselfie_image');
                $destination_path = 'uploads/installerselfie_image/'; 
                $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

                $filename = str_replace(array( '(', ')' ), '', $filename);
                $image->move($destination_path, $filename);
                $installerselfie_image = $destination_path . $filename;
            }


            DB::table('job_image_type')->insert(['job_id'=>$request['id'],'image_type'=>$request['type'],'image'=>$installerselfie_image]); 

            return response()->json(['status'=>200,'message' => 'Installer Selfie Image Updated'], 200);
        }
        if($request->type == 'Capture_Photo')
        {
             $capturephoto_image = '';
            if ($request->hasFile('capturephoto_image')) {
                $image=$request->file('capturephoto_image');
                $destination_path = 'uploads/capturephotoimage/'; 
                $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

                $filename = str_replace(array( '(', ')' ), '', $filename);
                $image->move($destination_path, $filename);
                $capturephoto_image = $destination_path . $filename;
            }


            DB::table('job_image_type')->insert(['job_id'=>$request['id'],'image_type'=>$request['type'],'image'=>$capturephoto_image]); 

            return response()->json(['status'=>200,'message' => 'capturephoto_image Image Updated'], 200);
        }
        if($request->type == 'Metabox')
        {
            $metabox_image = '';
            if ($request->hasFile('metabox_image')) {
                $image=$request->file('metabox_image');
                $destination_path = 'uploads/metabox_image/'; 
                $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

                $filename = str_replace(array( '(', ')' ), '', $filename);
                $image->move($destination_path, $filename);
                $metabox_image = $destination_path . $filename;
            }


            DB::table('job_image_type')->insert(['job_id'=>$request['id'],'image_type'=>$request['type'],'image'=>$metabox_image]); 

            return response()->json(['status'=>200,'message' => 'Metabox Image Updated'], 200);
        }
        if($request->type == 'Swithboard')
        {
            $swithboard_image = '';
            if ($request->hasFile('swithboard_image')) {
                $image=$request->file('swithboard_image');
                $destination_path = 'uploads/swithboard_image/'; 
                $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

                $filename = str_replace(array( '(', ')' ), '', $filename);
                $image->move($destination_path, $filename);
                $swithboard_image = $destination_path . $filename;
            }


            DB::table('job_image_type')->insert(['job_id'=>$request['id'],'image_type'=>$request['type'],'image'=>$swithboard_image]); 

            return response()->json(['status'=>200,'message' => 'Swithboard Image Updated'], 200);
        }
        if($request->type == 'CES')
        {
          
            $CES_image = '';
            if ($request->hasFile('CES_image')) {
                $image=$request->file('CES_image');
                $destination_path = 'uploads/CES_image/'; 
                $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

                $filename = str_replace(array( '(', ')' ), '', $filename);
                $image->move($destination_path, $filename);
                $CES_image = $destination_path . $filename;
            }


            DB::table('job_image_type')->insert(['job_id'=>$request['id'],'image_type'=>$request['type'],'image'=>$CES_image]); 

            return response()->json(['status'=>200,'message' => 'CES Image Updated'], 200);
        }
        if($request->type == 'Front_Property')
        {

            $frontproperty_image = '';
            if ($request->hasFile('frontproperty_image')) {
                $image=$request->file('frontproperty_image');
                $destination_path = 'uploads/frontproperty_image/'; 
                $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

                $filename = str_replace(array( '(', ')' ), '', $filename);
                $image->move($destination_path, $filename);
                $frontproperty_image = $destination_path . $filename;
            }


            DB::table('job_image_type')->insert(['job_id'=>$request['id'],'image_type'=>$request['type'],'image'=>$frontproperty_image]); 

            return response()->json(['status'=>200,'message' => 'Front Prototype Image Updated'], 200);
        }

    }
}

public function job_list_count(Request $request)
{   
    if(isset($request->type) && $request->type != '' && isset($request->id) && $request->id >0){
        if($request->type == 'Panel')
        {   
            if(isset($request->serial_number[0]) && $request->serial_number[0] !='' &&  !empty($request->file('panel_image'))){
                
                $total= PanelSerials::where('job_id',$request->id)->count('Panel_Serial_Numbers');

                $str = str_replace("[","",$request->serial_number[0]);
                $str = str_replace("]","",$str);
                $serial_array = explode(',',$str);

                $serial_numbers = DB::table('panel_serial_numbers')->select('Panel_Serial_Numbers')->where('job_id',$request->id)->get()->toArray();
                $s_numbers= array();
                $s_count = 0;
                foreach($serial_numbers as $key){
                    array_push($s_numbers,$key->Panel_Serial_Numbers);
                }
                foreach( $serial_array as $key => $value )
                {
                   in_array( $value, $s_numbers ) ? $s_count++ : false;
                }  
                //sss
                if(count($serial_array) != count($request->panel_image))
                { 
                    return response()->json(['status'=>400,'message' => 'image and serial numbers count is not same'], 400);
                } 
                else
                {
                    if(count($serial_array) == $s_count){

                        $paneldata = DB::table('jobs')
                        /*->join('tbl_panels', 'jobs.id', '=', 'tbl_panels.job_id')*/
                        ->join('panel_serial_numbers', 'jobs.id', '=', 'panel_serial_numbers.job_id')
                        ->select('panel_serial_numbers.id','panel_serial_numbers.panel_id')
                        ->where('jobs.id',$request->id) 
                        ->whereIn('panel_serial_numbers.Panel_Serial_Numbers',$serial_array)
                        ->get()->toArray(); 
                        $c = count($serial_array);
                        $c_inserted = 0;
                        foreach ($paneldata as $key => $value) 
                        {
                            
                            $files = $request->file('panel_image');
                            $panel_image = '';
                            foreach ($files as $key1 => $value1) 
                            {
                            
                                    $image=$value1;
                                
                                    $destination_path = 'uploads/panel_image/'; 
                                    $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName());

                                    $filename = str_replace(array( '(', ')' ), '', $filename);
                                    $image->move($destination_path, $filename);
                                    $panel_image = $destination_path . $filename;

                                    $panel_array = array('panel_id'=>$value->panel_id,'image'=>$panel_image,'serial_number'=>$serial_array[$key1]);
                                    
                                    
                                    DB::table('tbl_panels_images')->where('panel_id','=',$value->panel_id)->where('serial_number','=',$serial_array[$key1])->delete();
                                    $panel = DB::table('tbl_panels_images')->insert($panel_array); 

                                if($panel ==1){

                                    $c_inserted++;
                                }

                            }

                            $count_image = DB::table('tbl_panels_images')
                                ->join('tbl_panels', 'tbl_panels_images.panel_id', '=', 'tbl_panels.id')
                                ->where('tbl_panels.job_id',$request->id)
                                ->count();

                            $countpanelimage=$total-$count_image;

                            if($c == $c_inserted){
                                return response()->json(['status'=>200,'total_uploaded_images'=>$count_image,'pending_images' => $countpanelimage], 200);
                            }else{
                                return response()->json(['status'=>400,'message' => 'Data not inserted '], 400);
                            }   
                            
                        }
                    }
                    else{
                        return response()->json(['status'=>400,'message' => 'serial number miss match'], 400);
                    }
                }    
            }
            else{
                return response()->json(['status'=>400,'message' => 'image or serial numbers is not set!'], 400);
            }
            

        }
        //end panel
        elseif($request->type == 'Inverter')
        {
            if(isset($request->serial_number[0]) && $request->serial_number[0] !='' &&  !empty($request->file('inverter_image'))){
                $total= InvetrerSerials::where('job_id',$request->id)->count('Invetrers_Serial_Numbers');

                $str = str_replace("[","",$request->serial_number[0]);
                $str = str_replace("]","",$str);

                $serial_array = explode(',',$str);
                $serial_numbers = DB::table('invetrers_serial_numbers')->select('Invetrers_Serial_Numbers')->where('job_id',$request->id)->get()->toArray();

                $s_numbers= array();
                $s_count = 0;
                foreach($serial_numbers as $key){
                    array_push($s_numbers,$key->Invetrers_Serial_Numbers);
                }
                //echo "<pre>";print_r($s_numbers);die;
                foreach( $serial_array as $key => $value )
                {
                   in_array( $value, $s_numbers ) ? $s_count++ : false;
                } 

                if(count($serial_array) != count($request->inverter_image))
                {
                    return response()->json(['status'=>400,'message' => 'image and serial numbers count is not same'], 400);
                } 
                else{ 

                    if(count($serial_array) == $s_count){
                        $inverterdata = DB::table('jobs')
                            ->join('invetrers_serial_numbers', 'jobs.id', '=', 'invetrers_serial_numbers.job_id')
                            ->select('invetrers_serial_numbers.id','invetrers_serial_numbers.inverter_id')
                            ->where('jobs.id',$request->id)         
                            ->get()->toArray();

                        foreach ($inverterdata as $key => $value) 
                        {
                            $files = $request->file('inverter_image');
                            $panel_image = '';
                            foreach ($files as $key1 => $value1) 
                            {
                            
                                    $image=$value1;
                                
                                    $destination_path = 'uploads/inverter_image/'; 
                                    $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName());

                                    $filename = str_replace(array( '(', ')' ), '', $filename);
                                    $image->move($destination_path, $filename);
                                    $inverter_image = $destination_path . $filename;


                                    $inverter_array = array('inverter_id'=>$value->inverter_id,'image'=>$inverter_image,'serial_number'=>$serial_array[$key1]);
                                    
                                    DB::table('tbl_inverter_images')->where('inverter_id','=',$value->inverter_id)->where('serial_number','=',$serial_array[$key1])->delete();
                                    DB::table('tbl_inverter_images')->insert($inverter_array); 
                            }

                            $count_image = DB::table('tbl_inverter_images') 
                                ->join('tbl_inverters', 'tbl_inverter_images.inverter_id', '=', 'tbl_inverters.id')
                                ->where('tbl_inverters.job_id',$request->id)
                                ->count();

                            $countinterverimage=$total-$count_image;
                            
                            return response()->json(['status'=>200,'total_uploaded_images'=>$count_image,'pending_images' => $countinterverimage], 200);
                        
                        }
                    }
                    else{
                        return response()->json(['status'=>400,'message' => 'serial number miss match'], 400);
                    }
                }
            }
            else{
                return response()->json(['status'=>400,'message' => 'image or serial numbers is not set!'], 400);
            }

        }

        elseif($request->type == 'Signature')
        {  
            $a=0;$b=0;$c=0;$d=0;
            if($request->hasFile('installer_signature')) {

                $image=$request->file('installer_signature');
                if(!is_array($image)){
                    $installer_signature = '';
                    $destination_path = 'uploads/job/installer/'; 
                    $filename1 = sha1(time() . time()) . preg_replace('/\s+/', '',$image->GetClientOriginalName()); //to trim whitespace in file na
                    $filename = str_replace(array( '(', ')' ), '',$filename1);            
                    $image->move($destination_path,$filename);
                    $installer_signature = $destination_path . $filename;
                    $a=Jobs::where('id',$request['id'])->update(['installer_signature'=>$installer_signature]);
                }else{
                    return response()->json(['status'=>400,'message' => 'Multiple image selected for Installer Signature at the time'], 400);
                }
            } 
            if ($request->hasFile('designer_signature')) {
                
                $image=$request->file('designer_signature');
                if(!is_array($image)){
                    $designer_signature = '';
                    $destination_path = 'uploads/job/designer/'; 
                    $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

                    $filename = str_replace(array( '(', ')' ), '', $filename);
                    $image->move($destination_path, $filename);
                    $designer_signature = $destination_path . $filename;
                    $b=Jobs::where('id',$request['id'])->update(['designer_signature'=>$designer_signature]);  
                }else{
                    return response()->json(['status'=>400,'message' => 'Multiple image selected for Designer Signature at the time'], 400);
                }  
            } 
            if ($request->hasFile('electrician_signature')) {
               
                $image=$request->file('electrician_signature');
                if(!is_array($image)){
                    $electrician_signature = '';
                    $destination_path = 'uploads/job/electrician/'; 
                    $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

                    $filename = str_replace(array( '(', ')' ), '', $filename);
                    $image->move($destination_path, $filename);
                    $electrician_signature = $destination_path . $filename;
                    $c=Jobs::where('id',$request['id'])->update(['electrician_signature'=>$electrician_signature]); 
                }else{
                    return response()->json(['status'=>400,'message' => 'Multiple image selected for Electrician Signature at the time'], 400);
                }      

            }
            if ($request->hasFile('owner_signature')) {
                
                $image=$request->file('owner_signature');
                if(!is_array($image)){
                    $owner_signature = '';
                    $destination_path = 'uploads/job/owner/'; 
                    $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

                    $filename = str_replace(array( '(', ')' ), '', $filename);
                    $image->move($destination_path, $filename);
                    $owner_signature = $destination_path . $filename;
                    $d=Jobs::where('id',$request['id'])->update(['owner_signature'=>$owner_signature]); 
                }else{
                    return response()->json(['status'=>400,'message' => 'Multiple image selected for Owner Signature at the time'], 400);
                }       
            }
            
            $signatures = DB::table('jobs')->select('installer_signature','designer_signature','electrician_signature','owner_signature')->where('id',$request['id'])->get();
            $signature_arr = array('installer_signature','designer_signature','electrician_signature','owner_signature');
            $count=4;
            $count_image=0;
            foreach($signatures as $key=>$signature)
            {  
                foreach($signature_arr as $key=>$sing){
                    if(isset($signature->$sing) && $signature->$sing !=''){
                        $count_image++;
                    }
                }
            }
            if($a || $b || $c ||$d){
                $countsignatureimage=$count-$count_image;
                return response()->json(['status'=>200,'total_uploaded_images'=>$count_image,'pending_images' => $countsignatureimage], 200);
            }else{
                return response()->json(['status'=>400,'message' => 'No Image selected'], 400);  
            }
        }
        elseif($request->type == 'Installation')
        {
        
            $files = $request->file('installation_image');
            if(isset($files) && count($files)>0){
                    $count = count($files);die;
                    $uploaded_count=0;
                    $installation_image = '';
                    foreach ($files as $key => $value) 
                    {
                            $image=$value;
                            
                            $destination_path = 'uploads/installation_image/'; 
                            $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName());

                            $filename = str_replace(array( '(', ')' ), '', $filename);
                            $image->move($destination_path, $filename);
                            $installation_image = $destination_path . $filename;

                        
                            $panel_array = array('job_id'=>$request['id'],'image'=>$installation_image);
                            $upload=DB::table('tbl_installation_images')->insert($panel_array); 
                            if($upload){
                                $uploaded_count++;
                            }
                    }
                    if($count == $uploaded_count){
                        $total_installation_images = DB::table('tbl_installation_images')->where('job_id','=',$request['id'])->count();
                        return response()->json(['status'=>200,'message' => 'Installation Image Updated','total_uploaded_images'=> $total_installation_images], 200);
                    }else{
                        return response()->json(['status'=>400,'message' => 'not upload'], 400);
                    }
            }else{
                return response()->json(['status'=>400,'message' => 'Image not set!'], 400);
            }
        }   

        elseif($request->type == 'Back_panel_label')
        {
            $image=$request->file('backpanellabel_image');
            if(isset($image) && !is_array($image) && $request->hasFile('backpanellabel_image')){
                    $backpanellabel_image = '';
                    $destination_path = 'uploads/backpanellabel_image/'; 
                    $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na
                    $filename = str_replace(array( '(', ')' ), '', $filename);
                    $image->move($destination_path, $filename);
                    $backpanellabel_image = $destination_path . $filename;
               
                DB::table('job_image_type')->insert(['job_id'=>$request['id'],'image_type'=>$request['type'],'image'=>$backpanellabel_image]); 
                $total = DB::table('job_image_type')->where('job_id','=',$request['id'])->where('image_type','=',$request['type'])->count();
                return response()->json(['status'=>200,'message' => 'Back Panel Image Updated','total_uploaded_images'=> $total], 200);
            }else{
                return response()->json(['status'=>400,'message' => 'Select One image at the time or multiple selected'], 400);
            }
        }
        elseif($request->type == 'inverter_label')
        {
            $image=$request->file('inverter_label_image');
            if(isset($image) && !is_array($image) && $request->hasFile('inverter_label_image')){
                    $inverter_label_image = '';
                    $destination_path = 'uploads/inverter_label_image/'; 
                    $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na
                    $filename = str_replace(array( '(', ')' ), '', $filename);
                    $image->move($destination_path, $filename);
                    $inverter_label_image = $destination_path . $filename;
        
            DB::table('job_image_type')->insert(['job_id'=>$request['id'],'image_type'=>$request['type'],'image'=>$inverter_label_image]); 
            $total = DB::table('job_image_type')->where('job_id','=',$request['id'])->where('image_type','=',$request['type'])->count();
            return response()->json(['status'=>200,'message' => 'Inverter Label Image Updated','total_uploaded_images'=> $total], 200);
            }else{
                return response()->json(['status'=>400,'message' => 'Select One image at the time or multiple selected'], 400);
            }
        }
        elseif($request->type == 'installerselfie')
        {
            $image=$request->file('installerselfie_image');
            if(isset($image) && !is_array($image) && $request->hasFile('installerselfie_image')) {
                $installerselfie_image = '';
                $destination_path = 'uploads/installerselfie_image/'; 
                $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na
                $filename = str_replace(array( '(', ')' ), '', $filename);
                $image->move($destination_path, $filename);
                $installerselfie_image = $destination_path . $filename;
                DB::table('job_image_type')->insert(['job_id'=>$request['id'],'image_type'=>$request['type'],'image'=>$installerselfie_image]); 
                $total = DB::table('job_image_type')->where('job_id','=',$request['id'])->where('image_type','=',$request['type'])->count();
                return response()->json(['status'=>200,'message' => 'Installer Selfie Image Updated','total_uploaded_images'=> $total], 200);
            }else{
                return response()->json(['status'=>400,'message' => 'Select One image at the time or multiple selected'], 400);
            }
        }
        elseif($request->type == 'Capture_Photo')
        {
            $image=$request->file('capturephoto_image');
            if(isset($image) && !is_array($image) && $request->hasFile('capturephoto_image')) {
                $capturephoto_image = '';
                $destination_path = 'uploads/capturephotoimage/'; 
                $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na
                $filename = str_replace(array( '(', ')' ), '', $filename);
                $image->move($destination_path, $filename);
                $capturephoto_image = $destination_path . $filename;
                DB::table('job_image_type')->insert(['job_id'=>$request['id'],'image_type'=>$request['type'],'image'=>$capturephoto_image]); 
                $total = DB::table('job_image_type')->where('job_id','=',$request['id'])->where('image_type','=',$request['type'])->count();
                return response()->json(['status'=>200,'message' => 'capturephoto_image Image Updated','total_uploaded_images'=> $total], 200);
            }else{
                return response()->json(['status'=>400,'message' => 'Select One image at the time or multiple selected'], 400);
            }
        }
        elseif($request->type == 'Metabox')
        {
            $image=$request->file('metabox_image');
            if(isset($image) && !is_array($image) && $request->hasFile('metabox_image')) {
                $metabox_image = '';
                $destination_path = 'uploads/metabox_image/'; 
                $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na
                $filename = str_replace(array( '(', ')' ), '', $filename);
                $image->move($destination_path, $filename);
                $metabox_image = $destination_path . $filename;
                DB::table('job_image_type')->insert(['job_id'=>$request['id'],'image_type'=>$request['type'],'image'=>$metabox_image]); 
                $total = DB::table('job_image_type')->where('job_id','=',$request['id'])->where('image_type','=',$request['type'])->count();
                return response()->json(['status'=>200,'message' => 'Metabox Image Updated','total_uploaded_images'=> $total], 200);
            }else{
                return response()->json(['status'=>400,'message' => 'Select One image at the time or multiple selected'], 400);
            }
        }
        elseif($request->type == 'Swithboard')
        {
            $image=$request->file('swithboard_image');
            if(isset($image) && !is_array($image) &&  $request->hasFile('swithboard_image')) {
                $swithboard_image = '';
                $destination_path = 'uploads/swithboard_image/'; 
                $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na
                $filename = str_replace(array( '(', ')' ), '', $filename);
                $image->move($destination_path, $filename);
                $swithboard_image = $destination_path . $filename;
                DB::table('job_image_type')->insert(['job_id'=>$request['id'],'image_type'=>$request['type'],'image'=>$swithboard_image]); 
                $total = DB::table('job_image_type')->where('job_id','=',$request['id'])->where('image_type','=',$request['type'])->count();
                return response()->json(['status'=>200,'message' => 'Swithboard Image Updated','total_uploaded_images'=> $total], 200);
            }else{
                return response()->json(['status'=>400,'message' => 'Select One image at the time or multiple selected'], 400);
            }
        }
        elseif($request->type == 'CES')
        {
            $image=$request->file('CES_image');
            if(isset($image) && !is_array($image) &&  $request->hasFile('CES_image')) {
                $CES_image = '';

                $destination_path = 'uploads/CES_image/'; 
                $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na
                $filename = str_replace(array( '(', ')' ), '', $filename);
                $image->move($destination_path, $filename);
                $CES_image = $destination_path . $filename;
                DB::table('job_image_type')->insert(['job_id'=>$request['id'],'image_type'=>$request['type'],'image'=>$CES_image]); 
                $total = DB::table('job_image_type')->where('job_id','=',$request['id'])->where('image_type','=',$request['type'])->count();
                return response()->json(['status'=>200,'message' => 'CES Image Updated','total_uploaded_images'=> $total], 200);
            }else{
                return response()->json(['status'=>400,'message' => 'Select One image at the time or multiple selected'], 400);
            }
        }
        elseif($request->type == 'Front_Property')
        {
            $image=$request->file('frontproperty_image');
            if(isset($image) && !is_array($image) &&  $request->hasFile('frontproperty_image')) {
                $frontproperty_image = '';
                $destination_path = 'uploads/frontproperty_image/'; 
                $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na
                $filename = str_replace(array( '(', ')' ), '', $filename);
                $image->move($destination_path, $filename);
                $frontproperty_image = $destination_path . $filename;
                DB::table('job_image_type')->insert(['job_id'=>$request['id'],'image_type'=>$request['type'],'image'=>$frontproperty_image]); 
                $total = DB::table('job_image_type')->where('job_id','=',$request['id'])->where('image_type','=',$request['type'])->count();
                return response()->json(['status'=>200,'message' => 'Front Prototype Image Updated','total_uploaded_images'=> $total], 200);
            }else{
                return response()->json(['status'=>400,'message' => 'Select One image at the time or multiple selected'], 400);
            }
        }
    }else{
        return response()->json(['status'=>400,'message' => 'Type must be avaliable or invalid id',], 400);  
    }
}
  

public function upload_job_image(Request $request)
{

        $installer_signature = '';
        if ($request->hasFile('installer_signature')) {
            $image=$request->file('installer_signature');
            $destination_path = 'uploads/job/installer/'; 
            $filename1 = sha1(time() . time()) . preg_replace('/\s+/', '',$image->getClientOriginalName()); //to trim whitespace in file na

            $filename = str_replace(array( '(', ')' ), '',$filename1);
            
            $image->move($destination_path,$filename);
            $installer_signature = $destination_path . $filename;
            
        } 


        $designer_signature = '';
        if ($request->hasFile('designer_signature')) {
            $image=$request->file('designer_signature');
            $destination_path = 'uploads/job/designer/'; 
            $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

            $filename = str_replace(array( '(', ')' ), '', $filename);
            $image->move($destination_path, $filename);
            $designer_signature = $destination_path . $filename;
            
        }

        $electrician_signature = '';
        if ($request->hasFile('electrician_signature')) {
            $image=$request->file('electrician_signature');
            $destination_path = 'uploads/job/electrician/'; 
            $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

            $filename = str_replace(array( '(', ')' ), '', $filename);
            $image->move($destination_path, $filename);
            $electrician_signature = $destination_path . $filename;

        }

        $owner_signature = '';
        if ($request->hasFile('owner_signature')) {
            $image=$request->file('owner_signature');
            $destination_path = 'uploads/job/owner/'; 
            $filename = sha1(time() . time()) . preg_replace('/\s+/', '', $image->getClientOriginalName()); //to trim whitespace in file na

            $filename = str_replace(array( '(', ')' ), '', $filename);
            $image->move($destination_path, $filename);
            $owner_signature = $destination_path . $filename;

        }

        if($installer_signature != '')
        {
            $input['installer_signature'] = $installer_signature;
        }
        if($designer_signature != '')
        {
            $input['designer_signature'] = $designer_signature;
        }
        if($electrician_signature != '')
        {
            $input['electrician_signature'] = $electrician_signature;
        }
        if($owner_signature != '')
        {
            $input['owner_signature'] = $owner_signature;
        }

        Jobs::where('id',$request['id'])->update(['installer_signature'=>$installer_signature,'designer_signature'=>$designer_signature,'electrician_signature'=>$electrician_signature,'owner_signature'=>$owner_signature]); 

         return response()->json(['status'=>200,'message' => 'Job Image Updated'], 200);
}


}