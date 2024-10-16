<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Validator;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $movies = Movie::all();

       if ($movies->isEmpty()){
        return response()->json(
        [
        'message' => 'no se encontraron peliculas',
        'response' => '404'], 404);
       }
       return response()->json([
        'data' => $movies,
        'response' => 200
       ], 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'duracion' => 'required|string|max:3',
            'fecha_estreno' => 'required|string',
            'sinopsis' => 'required|string',
            'director' => 'required|string|max:255',
            'genero' => 'required|string|max:50',
            'imagen_url' => 'required|string'
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors());
        }

        $movie = Movie::create([
            'titulo' => $request->titulo,
            'duracion' => $request->duracion,
            'fecha_estreno' => $request->fecha_estreno,
            'sinopsis' => $request->sinopsis,
            'director' => $request->director,
            'genero' => $request->genero,
            'imagen_url' => $request->imagen_url
        ]
        );

        return response()->json([
            'message' => 'Solicitud Completada',
            'movie' => $movie,
            'response' => 201
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
}
