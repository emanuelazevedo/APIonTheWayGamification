<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserCreateRequest;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Auth;

use Image;
use App\Review;

use App\Viagem;
use App\Produto;

use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    //
    public function _constructor(){
      $this->middleware('auth:api');
    }

    /**
     * Listar todos os Users
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $users = User::all();
        // return $users;

        $user = Auth::user();
        return $user;
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
     * Criar um User
     *
     * @bodyParam Name string required Nome do utilizador
     * @bodyParam Password string required Password do utilizador
     * @bodyParam Email string required Email do utilizador
     * @bodyParam Avatar file Imagem de perfil do utilizador
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        //

        $data = $request->only(['name', 'email', 'password']);

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . "." . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('uploads/avatar/' . $filename));

            $data['avatar'] = $filename;
        }

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);
        return Response([
          'status' => 0,
          'data' => $user,
          'msg' => 'ok'
        ], 200);
        // return User::create($data);

    }

    /**
     * Mostrar um User
     *
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        $user->produtos;
        $user->viagems;
        $reviews = Review::where('user_id', $user['id'])->avg('nota');

        foreach($user['produtos'] as $produto){
            $produto->viagems;
        }

        foreach($user['viagems'] as $key => $viagem){
            $produtos = Produto::where('viagems_id', $viagem['id'])->get();
            $user['viagems'][$key]['produto'] = $produtos;
            $viagem->estado;
        }
        // dd($produtos);
        $user['media'] = $reviews;
        //obter pontos do user, ver if para ter os 1000 em 1k
        $user['reputation'] = $user->getPoints(true);

        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Editar um User
     *
     * @bodyParam Name string Nome do utilizador
     * @bodyParam Password string Password do utilizador
     * @bodyParam Email string Email do utilizador
     * @bodyParam Avatar file Imagem de perfil do utilizador
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {

        $data = $request->only(['name', 'email', 'password']);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . "." . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('uploads/avatar' . $filename));

            $user->avatar = $filename;
        }

        $user->save();

        return Response([
          'status' => 0,
          'data' => $user,
          'msg' => 'ok'
        ], 200);

    }

    /**
     * Remover um User
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        User::destroy($user['id']);
        return Response([
          'status' => 0,
          'data' => $user,
          'msg' => 'ok'
        ], 200);

    }

    public function leaderboardPoints(){
        $users = DB::table('users')
                ->orderBy('reputation', 'desc')
                ->get();


        return Response(array('leaderboardPoints' => $users, 'user'=> Auth::user()));
    }

    public function getAuthUser(){
        return Auth::user();
    }


}
