<?php

namespace App\Http\Controllers;

use App\Models\DatosCuriosos;
use Illuminate\Http\Request;

class DatosCuriososController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DatosCuriosos::get();
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
            'descripcion' => 'required',
        ]);
        $nuevaDato = new DatosCuriosos;
        $nuevaDato->nombre = $datos['nombre'];
        $nuevaDato->descripcion = $datos['descripcion'];
        $nuevaDato->save();
        return response()->json(['status' => 'success',]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DatosCuriosos  $datosCuriosos
     * @return \Illuminate\Http\Response
     */
    public function show(DatosCuriosos $datosCuriosos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DatosCuriosos  $datosCuriosos
     * @return \Illuminate\Http\Response
     */
    public function edit(DatosCuriosos $datosCuriosos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DatosCuriosos  $datosCuriosos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DatosCuriosos $datosCuriosos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DatosCuriosos  $datosCuriosos
     * @return \Illuminate\Http\Response
     */
    public function destroy(DatosCuriosos $datosCuriosos)
    {
        //
    }
}
