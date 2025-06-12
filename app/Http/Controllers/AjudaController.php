<?php

namespace App\Http\Controllers;

use App\Models\Ajuda;
use App\Models\TutorialAjuda;
use Illuminate\Http\Request;

class AjudaController extends Controller
{
    //
    public function index(Request $request)
    {
      $tutoriais = TutorialAjuda::latest()->paginate(12);
    return view('ajuda.index', compact('tutoriais'));
    }
       public function show(TutorialAjuda $tutorial)
    {
        return view('ajuda.show', compact('tutorial'));
    }
}
