<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        return response()->json(Produto::all());
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Produto $produto)
    {
        //
    }

    public function edit(Produto $produto)
    {
        //
    }

    public function update(Request $request, Produto $produto)
    {
        //
    }

    public function destroy(Produto $produto)
    {
        //
    }
}
