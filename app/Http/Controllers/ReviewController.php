<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewCreateRequest;

use App\Viagem;

class ReviewController extends Controller
{
    /**
     * Listar todas as reviews
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $review = Review::all();
        return $review;
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
     * Criar uma nova review
     * 
     * @bodyParam nota integer required Nota da viagem ou utilizador
     * @bodyParam comentario string Comentario sobre a viagem ou utilizador
     * @bodyParam user_id integer required Utilizador a ser avaliado
     * @bodyParam viagems_id integer required Viagem em que se avaliou o utilizador
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewCreateRequest $request)
    {
        //
        $data = $request->only(['nota', 'comentario', 'user_id', 'viagems_id']);
        // $viagemId = $request->input('viagems_id');
        // $viagem = Viagem::find($viagemId);
        // if($viagem['estado'] == 'avaliado'){
        //     return Response([
        //         'status' => 1,
        //         'msg' => 'A viagem já está avaliada'
        //       ], 500);
        // }
        $review = Review::create($data);
        return Response([
            'status' => 0,
            'review' => $review,
            'msg' => 'ok'
          ], 200);
    }

    /**
     * Mostrar uma review
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
        $review->user;
        return $review;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Atualizar uma review
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remover uma review
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
