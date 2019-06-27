<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;
use App\Http\Requests\ProdutoCreateRequest;
use App\Http\Requests\ProdutoUpdateRequest;
use Validator;
use Image;

use App\Viagem;
use App\Estado;

use Auth;


class ProdutoController extends Controller
{
    /**
     * Listar todos os Produtos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $produto = Produto::all();
        return $produto;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Criar um Produto
     *
     * @bodyParam tamanho string required Tamanho do produto
     * @bodyParam nome string required Nome do produto
     * @bodyParam viagems_id integer required Viagem a associar o produto
     * @bodyParam user_id integer required User a associar o produto
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdutoCreateRequest $request)
    {
        //

        $data = $request->only(['altura', 'comprimento', 'largura', 'nome', 'viagems_id']);
        $data['user_id'] = Auth::user()->id;
        if($request->hasFile('foto')){
            $foto = $request->file('foto');
            $filename = time() . "." . $foto->getClientOriginalExtension();
            Image::make($foto)->resize(300, 300)->save(public_path('uploads/produtos/' . $filename));

            $data['foto'] = $filename;
        }
        $produto = Produto::create($data);

        $viagem = Viagem::find($data['viagems_id']);
        $viagem['estado_id'] = 3;
        $viagem->save();

        return Response([
          'status' => 0,
          'data' => $produto,
          'msg' => 'ok'
        ], 200);
    }

    /**
     * Mostrar um Produto
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        //
        $produto->viagems;
        return $produto;
    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Editar um Produto
     *
     * @bodyParam tamanho string Tamanho do produto
     * @bodyParam nome string Nome do produto
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(ProdutoUpdateRequest $request, Produto $produto)
    {
        $data = $request->only(['viagem_id']);

        $produto->viagem_id = $data['viagem_id'];
        $produto->save();

        return Response([
          'status' => 0,
          'data' => $produto,
          'msg' => 'ok'
        ], 200);
    }

    /**
     * Remover um Produto
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        //
        Produto::destroy($produto['id']);
        return Response([
          'status' => 0,
          'data' => $produto,
          'msg' => 'ok'
        ], 200);
    }
}
