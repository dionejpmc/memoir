<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MemoirFeedMsg;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use File;

class MemoirFeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
   
        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

    }
    public function getAccount()
    {
        return view('account', ['user' => Auth::user()]);
    }
    public function savememoir(Request $request)
    {
        setlocale (LC_ALL, 'pt_BR');
        date_default_timezone_set('America/Sao_Paulo');
        if (Auth::check()){
            // The user is logged in...
            $image= null;
            try {
                $this->validate($request, [
                'titlememoir'=>'required', 
                'textmemoir' =>'required',
                ]);
                if (Input::file('mediafile')) {
                    $image = Input::file('mediafile');
                    $size = filesize($image);
                    if ($size >= 5000000){
                        return back()->with('erro','Erro: Este arquivo é muito grande!');
                    }
                    $extensao = $image->getClientOriginalExtension();
                    if(($extensao != 'jpg' && $extensao != 'png') && ($extensao != 'jpeg' && $extensao != 'JPEG') && ( $extensao != 'JPG' && $extensao != 'PNG') && ( $extensao != 'gif' && $extensao != 'GIF'))
                    {
                      return back()->with('erro','Erro: Este arquivo não é suportado!');
                    }
                    //Faz o mesmo que o if(($extensao != 'jpg' && $extensao != 'png') && ( $extensao != 'JPG' && $extensao != 'PNG') && ( $extensao != 'gif' && $extensao != 'GIF'))
                    $this->validate($request, [
                        'mediafile' => 'required|image|mimes:png,jpg,jpeg,gif|max:8192'
                    ]);
                }
                $memoirfeedmsg = new MemoirFeedMsg;
                $memoirfeedmsg->titlememoir = htmlspecialchars($request->titlememoir);
                $memoirfeedmsg->textmemoir  = htmlspecialchars($request->textmemoir);
                $memoirfeedmsg->userid      = Auth::user()->id;
                $memoirfeedmsg->urlimg ='';
                $memoirfeedmsg->save();
                if(Input::file('mediafile'))
                {
                    File::move($image,public_path().'/images/idmemoir_'.MD5($memoirfeedmsg->id).'.'.$extensao);
                    $memoirfeedmsg->urlimg = '/images/idmemoir_'.MD5($memoirfeedmsg->id).'.'.$extensao;
                    $memoirfeedmsg->save();
                }
                return back()->with('success','Sucesso: Sua memória foi salva!');
            } catch (Exception $e) {
                return redirect('home')->with('erro', $e);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
