<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGradebookRequest;
use Illuminate\Http\Request;
use App\Gradebook;
use App\User;
use Illuminate\Support\Facades\Auth;

class GradebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->query('name', '');
        $gradebooks = Gradebook::with('user')->searchByName($name)->orderBy('id', 'DESC')->paginate(2);
        return response()->json($gradebooks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGradebookRequest $request)
    {
        $data = $request->validated();
        // $user = User::findOrFail($request->user_id);
        $user = User::findOrFail($request->get('user_id'));
        $gradebook = $user->gradebook()->create($data);
        return response()->json($gradebook, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Gradebook $gradebook)
    {
        $gradebook->load(['user']);
        return response()->json($gradebook);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function myGradebook()
    {
        $user = auth()->user();
        $gradebook = $user->gradebook;
        $gradebook = $gradebook->load(['user']);;
        // $gradebook->load(['user']);
        return response()->json($gradebook);
    }
}
