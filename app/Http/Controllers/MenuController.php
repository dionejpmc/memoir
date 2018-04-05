<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use File;
use App\UserConfig;

class MenuController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()){
            return view('menu.index');
        }else{
             return redirect('login')->with('erro', 'Erro: Acesso negado!');
        }
   
    }
    public function menu()
    {
        if (Auth::check()){
            return view('menu.menu');
        }else{
            return redirect('login')->with('erro', 'Erro: Acesso negado!');
        }
    }
    public function saveconfig(Request $request){
        setlocale (LC_ALL, 'pt_BR');
        date_default_timezone_set('America/Sao_Paulo');
        if (Auth::check()){
            $text = $request->text;
            //==================  VERIFICA AVATAR =======================================
            //====VERRIFICA SE EXISTE ALGUM ARQUIVO VINDO DO FORMULÁRIO
            if (Input::file('mediafileavatar')) {
                $avatarurl = Input::file('mediafileavatar');
                $size = filesize($avatarurl);
                if ($size >= 5000000){
                    return back()->with('erro','Erro: Este arquivo de avatar é muito grande!');
                }
                $extensao = $avatarurl->getClientOriginalExtension();
                if(($extensao != 'jpg' && $extensao != 'png') && ($extensao != 'jpeg' && $extensao != 'JPEG') && ( $extensao != 'JPG' && $extensao != 'PNG') && ( $extensao != 'gif' && $extensao != 'GIF'))
                {
                    return back()->with('erro','Erro: Este arquivo de avatar não é suportado!');
                }
            }else{
                $avatarurl='';
            }
            $bgurl=null;
            //==================  VERIFICA CAPA =======================================
            //====VERRIFICA SE EXISTE ALGUM ARQUIVO VINDO DO FORMULÁRIO
            if (Input::file('mediafilecapa')) {
                $bgurl = Input::file('mediafilecapa');
                $size = filesize($bgurl);
                if ($size >= 5000000){
                    return back()->with('erro','Erro: Este arquivo de capa é muito grande!');
                }
                $extensao = $bgurl->getClientOriginalExtension();
                if(($extensao != 'jpg' && $extensao != 'png') && ($extensao != 'jpeg' && $extensao != 'JPEG') && ( $extensao != 'JPG' && $extensao != 'PNG') && ( $extensao != 'gif' && $extensao != 'GIF'))
                {
                    return back()->with('erro','Erro: Este arquivo de capa não é suportado!');
                }
            }
            else{
                $bgurl='';
            }
            try {
                //========= VERIFICA SE EXISTE CONFIGURAÇÃO PARA O USUÁRIO === SALVA OU EDITA ====================================================
                if (Input::file('mediafilecapa') || Input::file('mediafileavatar') || strlen($request->text)>5) {
                    $UserConfig = new UserConfig;
                    //VERIFICA QUE O USUÁRIO AUTENTICADO POSSUI PERFIL DE CONFIGURAÇÃO COM SEU -> ID
                    if ($UserConfig::where("iduser",Auth::user()->id)->first()) {
                        $idconfig = $UserConfig::where("iduser",Auth::user()->id)->first();
                        //====VERRIFICA SE EXISTE ALGUM ARQUIVO VINDO DO FORMULÁRIO
                        if(Input::file('mediafileavatar'))
                        {
                            File::move($avatarurl,public_path().'/images/avatar_'.MD5($idconfig).'.'.$extensao);
                            $UserConfig->where('iduser', Auth::user()->id)
                            ->update(['url_avatar' => '/images/avatar_'.MD5($idconfig).'.'.$extensao]); 
                        }
                        //====VERRIFICA SE EXISTE ALGUM ARQUIVO VINDO DO FORMULÁRIO
                        if(Input::file('mediafilecapa'))
                        {
                            File::move($bgurl,public_path().'/images/capa_'.MD5($idconfig).'.'.$extensao);
                            $UserConfig->where('iduser', Auth::user()->id)
                            ->update(['url_bg' => '/images/capa_'.MD5($idconfig).'.'.$extensao]); // this will also update the record                       
                        }             
                        if (strlen($request->text)>5) {
                            $UserConfig->aboutme = $request->text;
                            $UserConfig->where('iduser', Auth::user()->id)
                            ->update(['aboutme' => $request->text]);
                
                        }           
                    }else{
                        $UserConfig->iduser = Auth::user()->id;
                        $UserConfig->save();
                        if(Input::file('mediafileavatar'))
                        {
                            File::move($avatarurl,public_path().'/images/avatar_'.MD5($UserConfig->idconfig).'.'.$extensao);
                            $UserConfig->url_avatar = '/images/avatar_'.MD5($UserConfig->idconfig).'.'.$extensao;
                            $UserConfig->save();
                        }
                        if(Input::file('mediafilecapa'))
                        {
                            File::move($bgurl,public_path().'/images/capa_'.MD5($UserConfig->idconfig).'.'.$extensao);
                            $UserConfig->url_bg = '/images/capa_'.MD5($UserConfig->idconfig).'.'.$extensao;
                            $UserConfig->save();
                        }
                        if (strlen($request->text)) {
                            $UserConfig->aboutme = $request->text;
                            $UserConfig->save();
                
                        }
                    }
                }
                //==============SE APERTOU O BOTÃO SALVAR E NÃO SELECIONOU NENHUM ARQUIVO
                else{
                    return redirect('home')->with('erro', 'Erro: Você tentou salvar sem nenhum arquivo!');
                }
                //==============SE TUDO DEU CERTO==========
                return back()->with('success','Sucesso: Imagens salvas!');
            }catch(Exception $e) {
                return back()->with('erro',$e);
            }
        }else{
            //=======SE NÃO ESTIVER AUTENTICADO
            return redirect('index')->with('erro', 'Acesso negado!');
        }
    }
}
