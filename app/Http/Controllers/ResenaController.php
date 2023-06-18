<?php

namespace App\Http\Controllers;

use App\Mail\Contacto;
use App\Models\Resena;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ResenaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('usuario.contacto');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * metodo que envia un email del formulario de contacto para cualquier
     *  opinion de usuario como soliciatar un cuenta de creado o algun problema con  el sitio
     */
    public function store(Request $request)
    {

        $nombre=$request->input('nombre');
        $email=$request->input('email');
        $descripcion=$request->input('descripcion');

        Mail::mailer("smtp")->to('alexander.br159@gmail.com')->send(new Contacto($nombre,$email,$descripcion));

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Resena $resena)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resena $resena)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resena $resena)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resena $resena)
    {
        //
    }
}
