<?php

namespace App\Http\Controllers;

use App\Mail\CadastroRealizado;
use App\Mail\ContatoAdministrador;
use App\Models\Efetivo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class GuestController extends Controller
{
    //
    public function welcome()
    {
        return view('front.welcome');
    }

    public function pre_cadastrar()
    {
        if(Auth::check()){
            return redirect()->route('filament.admin.home');
        }
        return view('front.pre-cadastrar');
    }

    public function falar_administrador()
    {
        if(Auth::check()){
            return redirect()->route('filament.admin.home');
        }
        return view('front.falar-administrador');
    }

    public function email_administrador(Request $request): RedirectResponse
    {
        //dd($request->all());
        if(Auth::check()){
            return redirect()->route('filament.admin.home');
        }

        $request->validate([
            'rg' => 'required|numeric|min:11111|max:99999',
            'guerra' => 'required|string|min:3|max:255',
            'email' => 'required|email',
            'mensagem' => 'required|string|min:3|max:255',
        ]);
        $data = $request->all();
        //dd($data);

        Mail::to('davisbbb@hotmail.com')->send(new ContatoAdministrador(['data' => $data]));

        return redirect()->route('mensagem-enviada');
    }

    public function mensagem_enviada()
    {
        if(Auth::check()){
            return redirect()->route('filament.admin.home');
        }
        return view('front.mensagem-enviada');
    }

    public function cadastro_realizado()
    {
        if(Auth::check()){
            return redirect()->route('filament.admin.home');
        }
        return view('front.cadastro-realizado');
    }

    public function valida_cadastrar(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'rg' => 'required|numeric|min:11111|max:99999',
            'email' => 'required|email|unique:users,email',
        ]);
        //checar match dos emails
        if ($request->email != $request->confirma_email) {
            $request->flashExcept('email', 'confirma_email');
            return redirect()->back()->withErrors(['email' => 'Os emails não conferem.']);
        }
        //checar match do rg e data de nascimento
        $efetivo = Efetivo::where('rg', $request->rg)->where('data_nascimento', $request->data_nascimento)->first();
        //checar se o efetivo existe
        if (!$efetivo) {
            $request->flashOnly('rg', 'email', 'confirma_email');
            return redirect()->back()->withErrors(['rg' => 'RG ou nascimento inconsistente. Contate o administrador']);
        }
        //checar se o efetivo já tem usuário
        $user_existente = $efetivo->user()->first();
        if ($user_existente) {
            $request->flashOnly('rg');
            return redirect()->back()->withErrors(['rg' => 'Usuário já cadastrado neste RG. Contate o administrador']);
        }
        //executadas as validações, criar usuário
        $user = new \App\Models\User();
        $user->name = $efetivo->nome_guerra;
        $user->email = $request->email;
        $prepass = Str::random(4);
        $user->password = bcrypt($prepass);
        $user->save();
        //salvar o id do usuário na tabela 'efetivos'
        $efetivo->user_id = $user->id;
        $efetivo->save();

        //gravar na tabela 'model_has_roles' 'role_id' = 2 para este 'user_id'
        $user->assignRole('filament_user');


        $data = $request->all();
        $data['precedencia'] = $efetivo->precedencia->sigla;
        $data['nome_guerra'] = $efetivo->nome_guerra;
        $data['prepass'] = $prepass;
        //dd($data, $data['email']);

        Mail::to('davisbbb@hotmail.com')->send(new CadastroRealizado(['data' => $data]));

        return redirect()->route('cadastro-realizado');
    }
}
