<?php

namespace App\Http\Controllers;

use App\Models\Programas;
use Illuminate\Http\Request;

class ProgramasControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Programas::get();
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
        $datos = $request->validate([
            'nombre' => 'required',
            'organizacion' => 'required',
            'descripcion' => 'required',
            'objetivo' => 'required',
            'imagen' => 'required',
        ]);
        $imagen = $datos['imagen'];
        $especie = array_slice($datos, 0, 4);
        $nuevoPrograma = Programas::create($especie);
        $imagen = explode(',', $imagen);
        $imagenName = $nuevoPrograma->id.'.png';
        $url = 'storage/images/programas/'.$imagenName;
        file_put_contents($url, base64_decode($imagen[1]));
        $nuevoPrograma->imagen = $url;
        $nuevoPrograma->save();
        return response()->json(['status' => 'success',]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Programas  $programas
     * @return \Illuminate\Http\Response
     */
    public function show(Programas $programas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Programas  $programas
     * @return \Illuminate\Http\Response
     */
    public function edit(Programas $programas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Programas  $programas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Programas $programas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Programas  $programas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programas $programas)
    {
        //
    }
}
