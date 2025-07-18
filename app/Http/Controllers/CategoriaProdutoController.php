<?php

namespace App\Http\Controllers;

use App\Models\categoriaProduto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaProdutoController extends Controller
{
    public function index()
    {
        return response()->json(categoriaProduto::all(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'CatProduto' => 'required|string|max:55'
        ]);

        DB::beginTransaction();
        try {
            $categoria = categoriaProduto::create($data);

            DB::commit();

            return response()->json([
                'message' => 'Categoria criada com sucesso!',
                'CatProduto' => $categoria
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Erro ao criar categoria',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($CodCatProduto)
    {
        $categoria = categoriaProduto::findOrFail($CodCatProduto);

        return response()->json($categoria, 200);
    }

    public function update(Request $request, $CodCatProduto)
    {
        $categoria = categoriaProduto::findOrFail($CodCatProduto);

        $data = $request->validate([
            'CatProduto' => 'required|string|max:55'
        ]);

        $categoria->update($data);
        return response()->json($categoria, 200);
    }

    public function destroy($CodCatProduto)
    {
        $categoria = categoriaProduto::findOrFail($CodCatProduto);
        $categoria->delete();

        return response()->json(['message' => 'Categoria deletada'], 200);
    }
}
