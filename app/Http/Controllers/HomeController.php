<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\MemoirFeedMsg;
use App\Elos;

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
     * @return \Illuminate\Http\Response
     */
    public function Index()
    {
        if (Auth::check()){
            $memoirfeed =  DB::table('memoirfeedmsg')
                           ->where('userid',  Auth::user()->id)
                           ->orderBy('updated_at', 'DESC')->get();

            $created_elos = DB::table('elos')->select('elos.*','userconfig.*','users.id', 'users.alias', 'users.name')
                                         ->where('elos.iduser', '=', Auth::user()->id)
                                         ->leftJoin('userconfig', function($left)
                                          {
                                            $left->on('elos.idelo', '=', 'userconfig.iduser');
                                          })
                                         ->leftJoin('users', function($left)
                                          {
                                            $left->on('elos.idelo', '=', 'users.id');
                                          })
                                         ->get();
            return view('home')->with(array('memoirfeedmsg'=> $memoirfeed, 'created_elos'=> $created_elos));
        }
        else{
            Auth::logout();
            $request->session()->flush();
            return view('auth.login');
        }
    }
}
