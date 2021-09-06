<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Jobs;
use App\Models\Installer;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

    $company_count = Company::count();
    $jobs_count = Jobs::count();
    $installer_count = Installer::count();
       
        return view('home',compact('company_count','jobs_count','installer_count'));
    }

    public function clear_cache()
    {
        \Artisan::call('cache:clear');
        \Artisan::call('route:clear');
        \Artisan::call('config:clear');
        \Artisan::call('config:cache');
        echo "<pre>"; 
        print_r("cache cleared");
        echo "</pre>";
        exit(); 
    }

    public function getlogout()
    {
        Auth::logout();
        return redirect()->to('/login');
    }
}
