<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Http\Controllers\PedidoProdutosController;
use Illuminate\Http\Request;

class PedidoController extends Controller
{

    protected $pedido;

    public function __construct()
    {
        $this->pedido = new Pedido;
    }
    
    public function listAll(){
        $pedidos = $this->pedido->get();

        return response()->json([
            'message' => 'Listado com sucesso',
            'pedidos' => $pedidos
        ],200);
    }

    public function create(Request $comand){
        // dd(json_decode($comand->produtos,true));
        $produtos = $comand->produtos;
        // dd($produtos);
        try {
            $pedido = $this->pedido->create($comand->all());
            $pedidoProdutosController = new PedidoProdutosController();

            foreach ($produtos as $key => $value) {
                $pedidoProdutosController->create($value,$pedido->id);
            }

             return $this->listAll();
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao inserir pedido',
                'error' => $th
            ],401);
        }
    }
    
    public function update($id, Request $comand){

        $produtos = $comand->produtos;
        // dd($produtos);
        try {
        $pedido = $this->pedido->findOrFail($id);
        $pedido->update($comand->all());
        $pedidoProdutosController = new PedidoProdutosController();

        foreach ($produtos as $key => $value) {
            $pedidoProdutosController->update($value,$pedido->id);
        }

            return $this->listAll();
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao atualizar pedido',
                'error' => $th
            ], 401);
        }
    }

    public function delete(Request $request, $id){
        try {
            $pedido = Pedido::findOrFail($id);
            $pedidoProdutosController = new PedidoProdutosController();
            $pedidoProdutosController->delete($id);
            $pedido->delete();

            return response()->json([
                'message' => 'Pedido excluído com sucesso',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao excluir o pedido',
                'error' => $th->getMessage()
            ], 401);
        }
    }

    public function search(Request $comand){

        
        try {
            $query = $comand->q;
            $queryIsNumeric = is_numeric($query);

            if($queryIsNumeric){
                $pedidos = $this->pedido->where('id', 'like', "%{$query}%")->get();
            }else{
                $pedidos = $this->pedido->get();
            }
           
        return response()->json([
            'message' => 'Sucesso!',
            'pedidos' => $pedidos
        ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao procurar pedido',
                'error' => $th
            ],401);
        }
    }



}
