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
        $movie = Movie::find($id);

        if (!$movie){
            return response()->json([
                'Data' => "No se han encontrado datos",
                'Response' => 404
            ],404);
        }


        return response()->json([
            "data" => $movie,
            "Response" => 201
        ], 201);

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
        $movie = Movie::find($id);


        if (!$movie){

            return response()->json([
                "message" => "No se ha encontrado la pelicula",
                "response" => 404
            ], 404);
        }

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

        $movie->titulo = $request->titulo;
        $movie->duracion = $request->duracion;
        $movie->fecha_estreno = $request->fecha_estreno;
        $movie->sinopsis = $request->sinopsis;
        $movie->director = $request->director;
        $movie->genero = $request->genero;
        $movie->imagen_url = $request->imagen_url;


        $movie->save();

        return response()->json([
            "movie" => $movie,
            "message" => "Datos actualizados",
            "response" => 201
        ], 201);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);

        if(!$id){

            return response()->json([
                'Message' => "No se ha encontrado la pelicula",
                'Reponse' => 404
            ], 404);
        }

        $movie->delete();

        return response()->json([
            "Message" => "Pelicula eliminada",
            "Response" => '201'
        ],201);

    }
}
