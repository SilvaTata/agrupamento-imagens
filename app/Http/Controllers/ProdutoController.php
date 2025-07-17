<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    public function index()
    {
        return response()->json(Produto::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'CodCatProduto' => 'required|integer',
            'Nome' => 'required|string|max:255',
            'Descricao' => 'required|string|max:255',
            'ValorUnitario' => 'required|numeric',
            'QtdEstoque' => 'required|integer'
        ]);

        if(!$data) 
        {
            return response()->json("Entidade não encontrada", 422);
        }
        
        DB::beginTransaction();
        try 
        {
            $produto = Produto::create($data);

            if(!$produto) 
            {
                return response()->json("Unprocessable content", 422);
            }

            DB::commit();

            return response()->json(
                [
                    'message' => 'produto criado com sucesso',
                    'produto' => $produto
                ], 201);
        } 
        catch(\Exception $ex) 
        {
            DB::rollback();
            // Log::error("Erro ao criar veiculo". $ex->getMessage());
            return response()->json([
                'error' => 'erro ao criar produto',
                'message' => $ex->getMessage()], 422);
        }
    }

    public function show($CodCategoriaProduto)
    {
        $produto = Produto::findOrFail($CodCategoriaProduto);

        // if(!$produto)     
        // {
        //     return response()->json('Bad Request', 400);
        // }

        return response()->json(
            [
                'message' => 'produto encontrado',
                'produto' => $produto
            ], 200);
    }

    // public function edit(Produto $produto)
    // {
        
    // }

    public function update(Request $request, $CodCategoriaProduto)
    {
        $produto = Produto::findOrFail($CodCategoriaProduto);

        $data_up = $request->validate(
            [
                'Nome' => 'required|string|max:255',
                'Descricao' => 'required|string|max:255',
                'ValorUnitario' => 'required|numeric',
                'QtdeEstoque' => 'required|integer',
                
            ]);

        DB::beginTransaction();

        try 
        {
            $produto::create($data_up);

            if(!$produto) 
            {
                return response()->json("Unprocessable content", 422);
            }

            DB::commit();

            return response()->json(
                [
                    'message' => 'produto atualizado com sucesso',
                    'produto' => $produto
                ], 201);
        }
        catch(\Exception $e) 
        {
            DB::rollback();
            return response()->json(
                [
                    'error' => 'erro ao dar update em produto',
                    'message' => $e->getMessage()
                ], 428);
        }
    }

    public function destroy($CodProduto)
    {
        $produto = Produto::findOrFail($CodProduto);

        $produto->delete();

        return response()->json("Produto deletado com sucesso, redirecionando à tela inicial", 200);
    }
}
