<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{

    protected $produto;

    public function __construct()
    {   
        $this->produto = new Produto;
    }
 
    public function listAll()
    {
        $produtos = $this->produto->get();

        return response()->json([
            'message' => 'Listado com sucesso',
            'produtos' => $produtos
        ],200);
    }

    public function listProduto($id, Request $comand)
    {
        $produto = $this->produto->where('id',$id)->first();

        return response()->json([
            'message' => 'Listado com sucesso',
            'produto' => $produto
        ],200);
    }

    public function create(Request $comand){
        // var_dump($comand);
        // exit;

        try {
            $produto = $this->produto->create($comand->all());
        return $this->listAll();
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao inserir produto',
                'error' => $th
            ],401);
        }
    }
    
    public function update($id, Request $comand){
        // dd($request->all());
        // dd($comand->all());
    try {
        $produto = $this->produto->where('id',$id)->first();
        $produto->update($comand->all());
        return $this->listAll();
    } catch (\Throwable $th) {
        return response()->json([
            'message' => 'Erro ao atualizar produto',
            'error' => $th
        ], 401);
    }
}

    public function delete(Request $request, $id){
        try {
            $produto = Produto::findOrFail($id);
            $produto->delete();

            return response()->json([
                'message' => 'Produto excluído com sucesso',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao excluir o produto',
                'error' => $th->getMessage()
            ], 401);
        }
    }

    public function search(Request $comand){

        
        try {
            $query = $comand->q;
            $queryIsNumeric = is_numeric($query);

            if($queryIsNumeric){
                $produtos = $this->produto->where('preco', 'like', "%{$query}%")->get();
            }else{
                $produtos = $this->produto->where('nome', 'like', "%{$query}%")->get();
            }
           
        return response()->json([
            'message' => 'Sucesso!',
            'produtos' => $produtos
        ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Erro ao procurar produto',
                'error' => $th
            ],401);
        }
    }


}
