<?php

namespace App\Http\Controllers\Secretaria;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Secretaria;

class PerfilController extends Controller
{
    //
    
    public function edit()
    {
        $secretaria = Auth::guard('secretaria')->user();
        return view('escola.admin.secretaria.perfil', compact('secretaria'));
    }
    public function update(Request $request)
    {
        $secretaria = Auth::guard('secretaria')->user();
    
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email',
            'foto' => 'nullable|image|max:2048',
        ]);
    
        $dados = [
            'nome' => $request->nome,
            'email' => $request->email,
        ];
    
        // ✅ VERIFICA se foi enviada nova foto e se é válida
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
    
            // Deleta foto antiga (se existir)
            if ($secretaria->foto && Storage::disk('public')->exists($secretaria->foto)) {
                Storage::disk('public')->delete($secretaria->foto);
            }
    
            // Salva nova foto
            $dados['foto'] = $request->file('foto')->store('secretarias', 'public');
        }
    
        $secretaria->update($dados);
    
        return redirect()->route('secretaria.secretaria.perfil.edit')->with('success', 'Perfil atualizado com sucesso!');
    }
    
        
public function editarSenha()
{
    return view('escola.admin.secretaria.senha');
}

public function atualizarSenha(Request $request)
{
  
    $request->validate([
        'senha_atual' => 'required',
        'nova_senha' => 'required|min:6|confirmed',
    ]);

    $secretaria = Auth::guard('secretaria')->user();

    if (!Hash::check($request->senha_atual, $secretaria->password)) {
        return back()->withErrors(['senha_atual' => 'Senha atual incorreta.']);
    }

    $secretaria->password = Hash::make($request->nova_senha);
    $secretaria->save();

    return back()->with('success', 'Senha atualizada com sucesso!');
}


}
