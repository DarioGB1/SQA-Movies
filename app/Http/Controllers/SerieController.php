<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Serie;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $series = Serie::all();

        if ($series->isEmpty()){

            return response()->json([
                "Message"=> "No se han encontrado series",
                "response" => 404
            ], 404);
        }

        return response()->json(["data" => $series,
        "response" => 201], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(

        ), [
            'nombre_serie' => 'string|max:100|required',
            'sinopsis' => 'string|max:255|required',
            'temporadas' => 'string|max:3|required',
            'imagen_portada' => 'string|required',
            'genero' => 'string|required|max:100',
            'creador' => 'required|string|max:255'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $serie = Serie::create([
            'nombre_serie' => $request->nombre_serie,
            'sinopsis' => $request->sinopsis,
            'temporadas' => $request->temporadas,
            'imagen_portada' => $request->imagen_portada,
            'genero' => $request->genero,
            'creador' => $request->creador
        ]);

        return response()->json([
            "message" => 'Solicitud Completada',
            "movie" => $serie,
            "response" => 201
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
        $serie = Serie::find($id);

        if(!$serie){
            return response()->json([
                "message" => "No se han encontrado datos",
                "response" => 404
            ], 404);

        }

        return response()->json([
            "data" => $serie,
            "response" => 201
        ],201);
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

        $serie = Serie::find($id);

        if (!$serie){

            return response()->json([
                "message" => "No se ha encontrado la serie",
                "response" => 404
            ], 404);
        }

        $validator = Validator::make($request->all(

        ), [
            'nombre_serie' => 'string|max:100|required',
            'sinopsis' => 'string|max:255|required',
            'temporadas' => 'string|max:3|required',
            'imagen_portada' => 'string|required',
            'genero' => 'string|required|max:100',
            'creador' => 'required|string|max:255'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $serie->nombre_serie = $request->nombre_serie;
        $serie->sinopsis = $request->sinopsis;
        $serie->temporadas = $request->temporadas;
        $serie->imagen_portada = $request->imagen_portada;
        $serie->genero = $request->genero;
        $serie->creador = $request->creador;

        $serie->save();


        return response()->json(
            ['Message' => "Datos actualizados",
            "serie" => $serie,
            "response" => 201],201
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $serie = Serie::find($id);

        if (!$serie){

            return response()->json(
                [
                    "message" => "No se ha encontrado la serie",
                    "response" => 404
                ],
            404);
        }

        $serie->delete();

        return response()->json(
            ["message" => "se ha eliminado la pelicula",
            "response" => 201]
        ,201);
    }
}
