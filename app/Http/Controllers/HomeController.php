<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;

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
        return view('sql');
    }

    public function toggle_crud(Request $request)
    {
        if(isset($request->logout)){
            $request->session()->put('crud', false);
            return Redirect::back();
        }
        else{
            $request->validate([
                'password' => 'required'
            ]);
            
            if($request->password == Config::get('app.crud_password')){
                $request->session()->put('crud', true);
                return Redirect::back()->with('success', 'Повышенные привелегии');
            }else{
                //dd('sdsdsds');
                return Redirect::back()->withErrors(['Неправильный пароль']);
            }
        }
    }

    public function date()
    {
        return view('date');
    }
}
