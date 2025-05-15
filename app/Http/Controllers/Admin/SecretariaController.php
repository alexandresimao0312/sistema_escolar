<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Secretaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SecretariaController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->input('busca');
        $secretarias = Secretaria::when($busca, function ($query, $busca) {
            return $query->where('nome', 'like', "%$busca%")->orWhere('email', 'like', "%$busca%");
        })->paginate(5);

        return view('escola.admin.admin.secretariaUsers.index', compact('secretarias', 'busca'));
    }

    public function ativarOuDesativar($id)
    {
        $secretaria = Secretaria::findOrFail($id);
        $secretaria->ativo = !$secretaria->ativo;
        $secretaria->save();

        return back()->with('success', 'Status alterado com sucesso.');
    }

    public function create()
{
    return view('escola.admin.admin.secretariaUsers.create');
}

public function store(Request $request)
{
    $request->validate([
        'nome' => 'required|string|max:255',
        'email' => 'required|email|unique:secretarias,email',
        'password' => 'required|min:6|confirmed',
    ], 
    [
        'nome.required' => 'Digite o Nome',
        'email.required' => 'Digita o Email',
        'password.required' => 'Digita a Password',
        'nome.max' => 'Teve conter no maximo 255 caracteres',
        'email.unique' => 'Já existe um registro com esse email',
        'password.confirmed' => 'A password não confere com a confirmação',
        'password.min' => 'Teve conter no minimo 6 caracteres',

    ]);
    

    Secretaria::create([
        'nome' => $request->nome,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'ativo' => true,
    ]);

    return redirect()->route('admin.secretarias.index')->with('success', 'Usuário criado com sucesso.');
}

public function edit($id)
{
    $secretaria = Secretaria::findOrFail($id);
    return view('escola.admin.admin.secretariaUsers.edit', compact('secretaria'));
}

public function update(Request $request, $id)
{
    $secretaria = Secretaria::findOrFail($id);

    $request->validate([
        'nome' => 'required|string|max:255',
        'email' => 'required|email|unique:secretarias,email,' . $id,
        'password' => 'nullable|min:6|confirmed',
    ]);

    $dados = [
        'nome' => $request->nome,
        'email' => $request->email,
    ];

    if ($request->filled('password')) {
        $dados['password'] = Hash::make($request->password);
    }

    $secretaria->update($dados);

    return redirect()->route('admin.secretarias.index')->with('success', 'Usuário atualizado com sucesso.');
}

public function destroy($id)
{
    $secretaria = Secretaria::findOrFail($id);
    $secretaria->delete();

    return back()->with('success', 'Usuário removido com sucesso.');
}
}
