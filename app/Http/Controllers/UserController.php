<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list()
    {
        $users = User::orderByDesc('id')->paginate('2');

        return view('users.list', ['users' => $users ]);
    }

    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserRequest $request)
    {
        try {

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);

            return redirect()->route('user.create')->with('success', 'Usuário cadastrado com sucesso');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Falha em cadastrar usuário');
        }
    }

    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    public function update(UserRequest $request, User $user)
    {
        try{
            $user->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
            return redirect()->route('user.show', ['user' => $user->id])->with('success', 'Usuário editado com sucesso');
        }catch(Exception $e){
            return back()->withInput()->with('error', 'Falha em editar usuário');
        }
    }

    public function editPassword(User $user)
    {
        return view('users.editPassword', ['user' => $user]);
    }

    public function updatePassword(Request $request, User $user)
    {
        
        $request->validate([
            'password' => 'required|min:6',
        ], [
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',
        ]);

        try {

            $user->update([
                'password' => $request->password,
            ]);

            return redirect()->route('user.show', ['user' => $user->id])->with('success', 'Senha do usuário editada com sucesso!');
        } catch (Exception $e) {

            return back()->withInput()->with('error', 'Senha do usuário não editada!');
        } 
    }
}
