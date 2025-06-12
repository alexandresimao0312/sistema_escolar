<?php

namespace App\Http\Controllers;

use App\Models\TutorialAjuda;
use Illuminate\Http\Request;

class TutorialAjudaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         $tutoriais = TutorialAjuda::latest()->paginate(10);
        return view('ajuda.tutorial.index', compact('tutoriais'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('ajuda.tutorial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        dd($request->all());
         $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
        ]);

        TutorialAjuda::create($request->all());
        return redirect()->route('admin.ajuda.index')->with('success', 'Tutorial cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(TutorialAjuda $tutorialAjuda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TutorialAjuda $tutorialAjuda)
    {
        //
                return view('admin.ajuda.edit', compact('tutorial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TutorialAjuda $tutorialAjuda)
    {
        //
         $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
        ]);

        $tutorialAjuda->update($request->all());
        return redirect()->route('admin.ajuda.index')->with('success', 'Tutorial atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TutorialAjuda $tutorialAjuda)
    {
        //
        $tutorialAjuda->delete();
        return back()->with('success', 'Tutorial removido!');
    }
}
