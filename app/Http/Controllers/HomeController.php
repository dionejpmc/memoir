<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\MemoirFeedMsg;
use App\Elos;
use Carbon\Carbon;
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
        setlocale (LC_ALL, 'pt_BR');
        date_default_timezone_set('America/Sao_Paulo');
        if (Auth::check()){
             // $uploadsByDay   = DB::table('uploads')
             //                ->select(DB::raw('
             //                    YEAR(created_at) year,
             //                    MONTH(created_at) month,
             //                    MONTHNAME(created_at) month_name
             //                '))
             //                ->groupBy('year')
             //                ->groupBy('month')
             //                ->orderBy('year', 'desc')
             //                ->orderBy('month', 'desc')
             //                ->get();
            $memoirfeed =  DB::table('memoirfeedmsg')
                           ->where('userid',  Auth::user()->id)
                           ->whereYear('created_at', '=', Carbon::now()->year)
                           ->whereMonth('created_at', '=', Carbon::now()->month)
                           ->whereDay('created_at', '=', Carbon::now()->day)
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
