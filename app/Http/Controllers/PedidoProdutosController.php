<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PedidoProdutos;

class PedidoProdutosController extends Controller
{

    protected $pedido_produtos;

    public function __construct()
    {
        $this->pedido_produtos = new PedidoProdutos;
    }

    public function listAll($id, Request $comand)
    {
        $pedido_produtos = $this->pedido_produtos->where('pedido_id', $id)->get();

        if ($pedido_produtos->isEmpty()) {
            return response()->json([
                'message' => 'Nenhum produto encontrado neste pedido',
            ], 404);
        }

        return response()->json([
            'message' => 'Listado com sucesso',
            'pedido_produtos' => $pedido_produtos
        ], 200);
    }

    public function create($produto, $pedido_id)
    {
        // dd($produto);
        // Calcular o subtotal
        $subtotal = $produto['preco'] * $produto['quantidade'];
        // dd($subtotal);
        // Criar um novo registro de PedidoProduto
        $pedidoProdutos = new PedidoProdutos();
        $pedidoProdutos->pedido_id = $pedido_id;
        $pedidoProdutos->produto_id = $produto['id'];
        $pedidoProdutos->quantidade = $produto['quantidade'];
        $pedidoProdutos->preco_unitario = $produto['preco'];
        $pedidoProdutos->subtotal = $subtotal;
        // dd($pedidoProdutos);

        // Salvar o novo registro
        $pedidoProdutos->save();

        // Retornar uma resposta adequada
        return response()->json([
            'message' => 'PedidoProduto criado com sucesso',
            'data' => $pedidoProdutos
        ], 201);
    }

    public function update($produto, $pedido_id)
    {
        $pedidoProduto = $this->pedido_produtos->where('pedido_id', $pedido_id)
        ->where('produto_id', $produto['id'])
        ->first();
        $subtotal = $produto['preço'] * $produto['quantidade'];


        if ($pedidoProduto) {
            $pedidoProduto->quantidade = $produto['quantidade'];
            $pedidoProduto->preco_unitario = $produto['preço'];
            $pedidoProduto->subtotal = $subtotal;
            $pedidoProduto->save();
        }


        // Retornar uma resposta adequada
        return response()->json([
            'message' => 'PedidoProduto criado com sucesso',
            'data' => $pedidoProduto
        ], 201);
    }

    public function delete($pedido_id)
    {
        try {
            $this->pedido_produtos->where('pedido_id', $pedido_id)->delete();

            return response()->json([
                'message' => 'Registros de pedido_produtos excluídos com sucesso.'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao excluir os registros de pedido_produtos.',
                'error' => $th
            ], 401);
        }
    }
}
