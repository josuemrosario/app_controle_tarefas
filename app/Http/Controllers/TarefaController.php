<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\NovaTarefaMail;
use App\Models\Tarefa;
use Illuminate\Http\Request;

//aula 212
use Illuminate\Support\Facades\Auth;

class TarefaController extends Controller
{
    //Aula 211
    public function __construct()
    {
        //Middleware de atutenticação. Impede que seja utilizado o Controller 
        // e as rotas associadas se não tiver sido feito login
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //aula 212 Determinar se o ususário está logado
        
        /* Primeira opção de verificacao
        if(auth()->check()){

            $id = auth()->user()->id;
            $name = auth()->user()->name;
            $email = auth()->user()->email;

            return "User logado - ID: $id - Nome:$name - Email:$email ";
        }else{
            return 'voce não está logado no sistema';
        }

        */

        /* Segunda opção de verificacao */
        /* Nesta abordagem é necessario usar o USE */
        /*
        if(Auth::check()){

            $id = Auth::user()->id;
            $name = Auth::user()->name;
            $email = Auth::user()->email;

            return "User logado - ID: $id - Nome:$name - Email:$email ";
        }else{
            return 'voce não está logado no sistema';
        }
        */

        
        /* Terceira abordagem. Manter o middleware e puxar os dados do user */
        //$id = auth()->user()->id;
        //$name = auth()->user()->name;
        //$email = auth()->user()->email;
        //return "User logado - ID: $id - Nome:$name - Email:$email ";

        

        //return 'TarefaController:Index';


        //aula 226
        $user_id = auth()->user()->id;
        $tarefas = Tarefa::where('user_id',$user_id)->paginate(10);
        return view('tarefa.index',['tarefas' => $tarefas]);
    

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tarefa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        
        //aula 225
        $dados = $request->all('tarefa','data_limite_conclusao');
        $dados['user_id'] = auth()->user()->id;

        $tarefa = Tarefa::create($dados);

        
        //aula 223
        //$tarefa = Tarefa::create($request->all());

        $destinatario = auth()->user()->email;
        Mail::to($destinatario)->send(new NovaTarefaMail($tarefa)); //aula 224
        return redirect()->route('tarefa.show',['tarefa'=>$tarefa->id]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function show(Tarefa $tarefa)
    {
        //dd($tarefa->getAttributes());
        return view('tarefa.show', ['tarefa' => $tarefa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarefa $tarefa)
    {
        //aula 229
        return view('tarefa.edit', ['tarefa' => $tarefa ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        //aula 229
        $tarefa->update($request->all());
        return redirect()->route('tarefa.show',['tarefa' => $tarefa->id ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarefa $tarefa)
    {
        //
    }
}
