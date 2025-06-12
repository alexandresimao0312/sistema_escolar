<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public function index(Request $request)
    {
        $query = Funcionario::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nome', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('cargo', 'like', "%{$search}%")
                  ->orWhereDate('contratado_em', $search);
            });
        }

        $funcionarios = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('escola.admin.admin.funcionario.index', compact('funcionarios'));
    }

    public function create()
    {
        return view('escola.admin.admin.funcionario.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:funcionarios',
            'telefone' => 'nullable|string|max:20',
            'cargo' => 'required|string|max:100',
            'contratado_em' => 'required|date',
            'salario_base' => 'required|numeric|min:0',
        ]);

       
        Funcionario::create($request->all());

        return redirect()->route('admin.funcionarios.index')->with('success', 'Funcionário criado com sucesso.');
    }

    public function edit(Funcionario $funcionario)
    {
        return view('escola.admin.admin.funcionario.update', compact('funcionario'));
    }

    public function update(Request $request, Funcionario $funcionario)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:funcionarios,email,' . $funcionario->id,
            'telefone' => 'nullable|string|max:20',
            'cargo' => 'required|string|max:100',
            'contratado_em' => 'required|date',
            'salario_base' => 'required|numeric|min:0',
        ]);

        $funcionario->update($request->all());

        return redirect()->route('admin.funcionarios.index')->with('success', 'Funcionário atualizado com sucesso.');
    }

    public function destroy(Funcionario $funcionario)
    {
        $funcionario->delete();

        return redirect()->route('admin.funcionarios.index')->with('success', 'Funcionário removido com sucesso.');
    }
}
