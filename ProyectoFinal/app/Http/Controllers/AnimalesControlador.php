<?php

namespace App\Http\Controllers;

use App\Models\animalesPeligro;
use Illuminate\Http\Request;

class AnimalesControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AnimalesPeligro::get();
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
            'informacion' => 'required',
            'habitad' => 'required',
            'imagen' => 'required',
        ]);
        $imagen = $datos['imagen'];
        $especie = array_slice($datos, 0, 3);
        $nuevaEspecie = animalesPeligro::create($especie);
        $imagen = explode(',', $imagen);
        $imagenName = $nuevaEspecie->id.'.png';
        $url = 'storage/images/animales/'.$imagenName;
        file_put_contents($url, base64_decode($imagen[1]));
        $nuevaEspecie->imagen = $url;
        $nuevaEspecie->save();
        return response()->json(['status' => 'success',]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\animalesPeligro  $animalesPeligro
     * @return \Illuminate\Http\Response
     */
    public function show(animalesPeligro $animalesPeligro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\animalesPeligro  $animalesPeligro
     * @return \Illuminate\Http\Response
     */
    public function edit(animalesPeligro $animalesPeligro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\animalesPeligro  $animalesPeligro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, animalesPeligro $animalesPeligro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\animalesPeligro  $animalesPeligro
     * @return \Illuminate\Http\Response
     */
    public function destroy(animalesPeligro $animalesPeligro)
    {
        //
    }
}
