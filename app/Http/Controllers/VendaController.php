<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{
    public function index()
    {
        return response()->json(Venda::all(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'CodEntrega',
            'Cliente' => 'required|string|max:100',
            'DataEntrega' => 'required|date',
            'DataVenda' => 'required|date',
            'ValorTotal' => 'required|numeric'
        ]);

        DB::beginTransaction();
        try {
            $venda = Venda::create($data);

            DB::commit();

            return response()->json([
                'message' => 'Venda cadastrada com sucesso!',
                'venda' => $venda
            ], 200);
        } 
        catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Erro ao cadastrar venda',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($CodVenda)
    {
        $venda = Venda::findOrFail($CodVenda);
    }

    public function update(Request $request, $CodVenda)
    {
        $venda = Venda::findOrFail($CodVenda);

        $data_up = $request->validate(
            [
                'Cliente' => 'required|string|max:255',
                'DataEntrega' => 'required|date',
                'DataVenda' => 'required|date',
                'ValorTotal' => 'required|numeric',
            ]);

        DB::beginTransaction();

        try 
        {
            $venda::create($data_up);

            if(!$venda) 
            {
                return response()->json("Unprocessable content", 422);
            }

            DB::commit();

            return response()->json(
                [
                    'message' => 'produto atualizado com sucesso',
                    'venda' => $venda
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

    public function destroy($CodVenda)
    {
        $venda = Venda::findOrFail($CodVenda);

        // if(!$venda) 
        // {

        // }

        $venda->delete();
        return response()->json(
            [
                'success', 'venda deletada com sucesso',
                'venda', $venda
            ], 202);
    }
}
