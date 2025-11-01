<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        return view('produtos', compact('produtos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'preco' => 'required|numeric',
        ]);

        Produto::create([
            'nome' => $request->nome,
            'preco' => $request->preco,
        ]);

        return redirect('/produtos')->with('success', 'Produto cadastrado com sucesso!');
    }
}
