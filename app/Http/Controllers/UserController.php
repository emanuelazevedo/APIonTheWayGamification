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

        $user['xp'] = $user->getPoints();
        $level = 1;

        // apenas 5 niveis
        if($user['xp']>=5000 && $user['xp']<9999){
            $level = 2;
        } else if($user['xp']>=10000 && $user['xp']<24999){
            $level = 3;
        } else if($user['xp']>=25000 && $user['xp']<999999){
            $level = 4;
        } else if($user['xp']>=1000000){
            $level = 5;
        }



        $user['level'] = $level;

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
        $user['xp'] = $user->getPoints();

        $level = $this->experience($user['xp']);

        $user['level'] = $level;

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

    // TODO Enviar ao prof para verificar o codigo

    public function leaderboardPoints(){
        $allUsers = DB::table('users')
            ->orderBy('reputation', 'desc')
            ->get();

        $authUser = Auth::user();

        $aux = 0;

        foreach($allUsers as $user){
            $aux++;
            if($user->id === $authUser->id){
                //get index
                $authUser['position'] = $aux;
            }
        }

        $users = DB::table('users')
            ->orderBy('reputation', 'desc')
            ->take(10)
            ->get();

        // $users = $users->take(10);
        // tentar ver se continuo isto no frontend
        return Response(array('leaderboardPoints' => $users, 'user'=> $authUser));
    }

    public function leaderboardReviews(){
        $allUsers = User::all();
        $authUser = Auth::user();

        $aux = 0;


        foreach($allUsers as $user){
            $reviews = Review::where('user_id', $user['id'])->avg('nota');

            $user['review'] = $reviews;

            $viagems = DB::table('viagems')
                ->where('user_id', $user->id)
                ->where('estado_id', 4)
                ->count();

            if($reviews == 5) {
                $user['reviewPoints'] = 3 * $viagems;
            } elseif ($reviews == 4) {
                $user['reviewPoints'] = 2 * $viagems;
            } elseif ($reviews == 3) {
                $user['reviewPoints'] = $viagems;
            } elseif ($reviews == 2) {
                $user['reviewPoints'] = -1 * $viagems;
            } elseif ($reviews == 1) {
                $user['reviewPoints'] = -2 * $viagems;
            }

            if($user->id == 2){
                $user['reviewPoints']= 100;
            }

        }

        $leaderboard = $allUsers->sortByDesc('reviewPoints')->values()->take(10);
        // $leaderboard->values()->all();
        foreach($leaderboard as $user){
            $aux++;
            if($user->id === $authUser->id){
                //get index
                $authUser['position'] = $aux;
            }
        }

        return Response(array('leaderboardReviews' => $leaderboard, 'user'=> $authUser));
    }

    public function getAuthUser(){
        return Auth::user();
    }

    public function experience(int $xp) {
        $a=0;
        for($x=1; $x<$xp; $x++) {
        //   $a += floor($x+300*pow(2, ($x/7)));
          $a += floor(($x/5000)+sqrt(($x/10)));

        }
        return floor($a/4)+1;
      }

}
