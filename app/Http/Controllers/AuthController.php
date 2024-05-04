<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        // aqui verificamos se o usuario ja esta logado, se sim ele sera redirecionado para home caso tente acessar /login
        if (Auth::check()) {
            return redirect(route('home'));
        }
        return view('login');
    }

    public function login_action(Request $request)
    {
        $validator = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:6'
            ],
            [

                'password.required' => 'O campo senha é obrigatório.',
                'password.min' => 'A senha deve ter no mínimo 6 caracteres.',
                'email.required' => 'O campo email é obrigatório.',
                'email.email' => 'Por favor, insira um endereço de email válido.'
            ]
        );

        // aqui dando true, significa que o usuario esta autenticado
        if (Auth::attempt($validator)) {
            return redirect(route('home'));
        };
        dd();
    }

    public function register(Request $request)
    {
        // aqui verificamos se o usuario ja esta logado, se sim ele sera redirecionado para home caso tente acessar /login
        // aqui usamos o Auth::user() ele serve pra buscar todos os dados do usuario logado la no banco, diferente do Auth::check, o check só verifica se o usuario esta logado ou não, entao em casos que só queremos verificar se ele esta logado, eh melhor o check, e caso a gente queira buscar os dados do usuario pra mostrar na tela eh melhor o user

        $user = Auth::user();
        if ($user) {
            return redirect(route('home'));
        }
        return view('register');
    }

    public function register_action(Request $request)
    {
        /* regras para registro:
        1- o usuario tem que ter um nome,
        2- o email tem que ser unico na tabela users
        3- todos os campos são required
        4- password tem que ter no minimo 6 caracteres
        USAREMOS O REQUEST VALIDATE ABAIXO PARA OS ITENS ACIMA

               // pra que o confirmed funcione, eh preciso que no input de confirmacao de senha, seja criado com _confirmation no fim do name, exemplo: passord_confirmation
        */

        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed'
            ],
            [
                'name.required' => 'O campo nome é obrigatório.',
                'email.required' => 'O campo email é obrigatório.',
                'email.email' => 'Por favor, insira um endereço de email válido.',
                'email.unique' => 'Este email já está em uso.',
                'password.required' => 'O campo senha é obrigatório.',
                'password.min' => 'A senha deve ter no mínimo 6 caracteres.',
                'password.confirmed' => 'A confirmação da senha não corresponde.'
            ]
        );

        $data = $request->only(['name', 'email', 'password']);

        $data['password'] = Hash::make($data['password']);

        User::create($data);
        return redirect(route('login'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
