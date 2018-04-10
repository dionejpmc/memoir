<?php

        
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\MemoirFeedMsg;
use App\Elos;
use Illuminate\Support\Facades\Auth;
use App\User; // aqui você está importando o Model User
use App\PrivateMessage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function perfil(Request $alias)
    {
    	$user = User::where('alias', $alias->alias)->first();
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
	    if (($user->alias != '') and ($user->alias != null)) {
		    if ( ($user->alias === Auth::user()->alias)){
			    $memoirfeed = MemoirFeedMsg::orderBy('updated_at', 'DESC')->get();
			    return view('layouts.perfil')->with(array('memoirfeedmsg'=> $memoirfeed, 'created_elos'=> $created_elos));
			}
			else{
				$userconfig = DB::table('userconfig')->select('iduser','aboutme','url_avatar', 'url_bg')
				->where('iduser','=', $user->id)
				->get();
			    return view('layouts.personalperfil')->with(array('userconfig'=> $userconfig, 'user'=> $user));
			}
		}
		else{
		   return view('auth.login');
		}
	} 
	public function searchperfil(Request $request)
	{
		if (Auth::check()) {
			if (strlen($request->value) >=3 ){
				$data = DB::table('users')->select('users.*','userconfig.*')
							->where('users.alias','LIKE', '%'. $request->value . '%')
							->orWhere('users.name', 'LIKE', '%'. $request->value . '%')
							->leftJoin('userconfig', function($left)
						    {
						        $left->on('users.id', '=', 'userconfig.iduser');
						    })
						->orderBy('users.alias', 'asc')
						->limit(10)
			 			->get();  
     		    return  $data;
			}else{
				$data = array('alias'=>"Nada a ser apresentado");
				return $data;
			}
		}else{
			return view('/');
		}
	}
	public function create_elo(Request $request)
	{
		if (Auth::check()) {
			try {
				$idelo = DB::table('users')->select('id')
										   ->where('alias','=', $request->value)
								 		   ->first();
				if (DB::table('elos')->where('iduser', '=', Auth::user()->id)->where('idelo', '=', $idelo->id)->exists()) {
					DB::table('elos')->where('iduser', '=',  Auth::user()->id)->where('idelo', '=', $idelo->id)->delete();
					return "Você encerrou seu elo ";
				}
				else{
					if ($idelo->id != 0 && $idelo->id != Auth::user()->id) {
						$elo = new Elos();
						$elo->iduser = Auth::user()->id;
						$elo->idelo = $idelo->id;
						$elo->type_elo = 1;
					    $elo->save();
					    return "Você criou um novo elo ";
					}
				}
			} catch (Exception $e) {
				return $e;
			}				
		}
	}
	public function send_message(Request $request)
	{
		if (Auth::check()) {
			$idreceiver = DB::table('users')->select('id')
							  ->where('alias','=', $request->input2)
							  ->first();
			$msg =  new PrivateMessage();
			$msg->message = $request->input1;
			$msg->idsender =  Auth::user()->id;
			$msg->status_msg =  0;
			$msg->idreceiver = $idreceiver->id;
			$msg->save();
			return $msg;
		}else{
			 return view('auth.login');
		}
	}
	public function get_message(Request $request)
	{
			$data = PrivateMessage::where('idreceiver', '=', Auth::user()->id)
									->where('status_msg', '=', 0)
									->get();
			return $data;
	}
	public function edit_message(Request $request)
	{
		setlocale (LC_ALL, 'pt_BR');
        date_default_timezone_set('America/Sao_Paulo');
		try {
			DB::table('private_message')->where('idsender', '=', $request->idsender)
									    ->where('id', '=', $request->idmsg)
									    ->update(['status_msg' => 1, 'updated_at' => Carbon::now()]);
			return "Status da mensagem alterado";
			
		} catch (Exception $e) {
			return "Erro ao alterar status da menssagem";
		}
	}
}