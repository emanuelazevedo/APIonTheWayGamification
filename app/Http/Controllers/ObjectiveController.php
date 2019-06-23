<?php

namespace App\Http\Controllers;

use App\Objective;
use Illuminate\Http\Request;

class ObjectiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $mission = Mission::find(rand(1, 10));
        $user = Auth::user();

        $data= [false, $user->id, $mission->id];

        $objective = Objective::create($data);

        return Response([
            'status' => 0,
            'data' => $objective,
            'msg' => 'ok'
          ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Objective  $objective
     * @return \Illuminate\Http\Response
     */
    public function show(Objective $objective)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Objective  $objective
     * @return \Illuminate\Http\Response
     */
    public function edit(Objective $objective)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Objective  $objective
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Objective $objective)
    {
        //


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Objective  $objective
     * @return \Illuminate\Http\Response
     */
    public function destroy(Objective $objective)
    {
        //
    }
}
