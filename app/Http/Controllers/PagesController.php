<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Auth;
use Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator, Input, Redirect;
use Session;
use DB;
use Hybrid_Auth;
use Hybrid_Endpoint;   

class PagesController extends Controller
{

    public function redirect()
    {        
        // return view('pages.home');
        return redirect('users');
    }

	public function index()
    {
         if(Session::has('privilege')=='Admin') return view('pages.HomeAdmin');

        // $users = DB::table('users')->get();
        // $id = Session::get('id');
        // $privilege = Session::get('privilege');
        
        return view('pages.home');//, compact('users','id','privilege'));
    }

    public function login()
    {
    	return view('pages.login');
    }

    public function submit(Request $request)
    {
        $username = $request->get('Username');
        $password = $request->get('password');
        // $password = md5($password);

        $row = DB::select('SELECT * FROM users WHERE name = ? AND password = ?', [$username, $password]);

        //dd($row);
        if(count($row) > 0) {
            if($row[0]->id)
            {
                if(!$row[0]->flag) return redirect()->back()->withErrors('ID anda sudah tidak aktif');

                $id = $row[0]->id;

                Session::put('privilege', $row[0]->privilege);
                Session::put('id', $row[0]->id);

                if($row[0]->privilege == 'Admin')
                {
                    Session::put('username', $row[0]->name);
                    return view('pages.HomeAdmin');
                }
                else if($row[0]->privilege == 'user')
                {
                    Session::put('username', $row[0]->name);
                    return view('users');
                }
                else
                {
                    return redirect()->back()->withErrors('Invalid Privileges!');
                }
            }
        }
        else{
            return redirect()->back()->withErrors('Invalid Username or Password!');
        }



        //return view('check.login', compact('username'), compact('password'));
    }

    public function logout()
    {
    	Session::flush();
    	return redirect('users');
    }
}
?>