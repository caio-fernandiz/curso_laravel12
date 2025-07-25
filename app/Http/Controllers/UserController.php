<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Mail\UserPdfMail;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Dompdf\Adapter\PDFLib;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function list(Request $request)
    {
        //$users = User::orderByDesc('id')->paginate('5');
        $users = User::when(
            $request->filled('name'),
            fn($query) =>
            $query->whereLike('name','%' . $request->name . '%')
        )
        ->when(
            $request->filled('email'),
            fn($query) => 
            $query->whereLike('email', '%' . $request->email . '%')
        )

        ->when(
            $request->filled('start_date_registration'),
            fn($query) =>
            $query->where('created_at', '>=', Carbon::parse($request->start_date_registration))
        )

        ->when(
            $request->filled('end_date_registration'),
            fn($query) =>
            $query->where('created_at', '<=', Carbon::parse($request->end_date_registration))
        )

        ->orderByDesc('id')
        ->paginate(5)
        ->withQueryString();

        return view('users.list', [
            'users' => $users,
            'name' => $request->name,
            'email' => $request->email,
            'start_date_registration' => $request->start_date_registration,
            'end_date_registration' => $request->end_date_registration, 
        ]);
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
            'password.required' => 'Informe uma senha.',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',
        ]);

        try {

            $user->update([
                'password' => bcrypt($request->password),
            ]);

            return redirect()->route('user.show', ['user' => $user->id])->with('success', 'Senha do usuário editada com sucesso!');
        } catch (Exception $e) {

            return back()->withInput()->with('error', 'Senha do usuário não editada!');
        } 
    }

    public function erase(User $user)
    {
        try{
            $user->delete();

            return redirect()->route('user.list')->with('success', 'Usuário deletado com sucesso!');
        }  catch (Exception $e) {

            return back()->route()->with('error', 'Não foi possível deletado usuário');
        }
    }

    public function generatePDF(User $user)
    {
        try{$pdf = Pdf::loadView('users.generate-pdf', ['user' => $user])->setPaper('a4', 'portrait');
            
        $pdfPath = storage_path("app/public/usuario_{$user->name}.pdf");
        
        $pdf->save($pdfPath);

        Mail::to($user->email)->send(new UserPdfMail($pdfPath, $user));

        if(file_exists($pdfPath)){
            unlink($pdfPath);
        }
        return redirect()->route('user.show', ['user' => $user->id])->with('success', 'E-mail enviado com sucesso!');
        }catch(Exception $e){
            return redirect()->route('user.show', ['user' => $user->id])->with('error', 'E-mail não enviado');
        }
    }
}
