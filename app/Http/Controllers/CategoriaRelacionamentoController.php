<?php

namespace App\Http\Controllers;

use App\Models\categoriaRelacionamento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaRelacionamentoController extends Controller
{
    public function index()
    {
        return response()->json(categoriaRelacionamento::all(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'CatRelacionamento' => 'required|string|max:55'
        ]);

        DB::beginTransaction();
        try {
            $catRelacionamento = categoriaRelacionamento::create($data);

            DB::commit();

            return response()->json([
                'message' => 'Categoria de Relacionamento criada com sucesso!',
                'catRelacionamento' => $catRelacionamento
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Erro ao criar categoria de relacionamento',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($CodCatRelacionamento)
    {
        $categoria = categoriaRelacionamento::findOrFail($CodCatRelacionamento);

        return response()->json($categoria, 200);
    }

    public function update(Request $request, $CodCatRelacionamento)
    {
        $categoria = categoriaRelacionamento::findOrFail($CodCatRelacionamento);

        $data = $request->validate([
            'CatRelacionamento' => 'required|string|max:55'
        ]);

        $categoria->update($data);
        return response()->json($categoria, 200);
    }

    public function destroy($CodCatRelacionamento)
    {
        $categoria = categoriaRelacionamento::findOrFail($CodCatRelacionamento);
        $categoria->delete();

        return response()->json(['message' => 'Categoria de Relacionamento deletada'], 200);
    }
}
