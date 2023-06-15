<?php

namespace App\Http\Controllers;

use App\Models\Cateservicio;
use App\Models\Comentario;
use App\Models\Servicio;
use App\Models\User;
use App\Mail\Notificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ServicioController extends Controller
{
    //metodo que muestra todos los servicios
    public function index()
    {
        if(Auth::user()->rol=="admin"){
            return view('admin.servicios', ['servicios' => Servicio::all(), 'categorias' => Cateservicio::all()]);
        }else if(Auth::user()->rol=="creador"){
            return view('admin.servicios', ['servicios' => Servicio::all(), 'categorias' => Cateservicio::all()]);
        }else{
            return view('usuario.servicios', ['servicios' => Servicio::paginate(9), 'categorias' => Cateservicio::all()]);
        }
    }

    //metodo que muestra a no autenticados
    public function index1(){
        return view('usuario.servicios', ['servicios' => Servicio::paginate(9), 'categorias' => Cateservicio::all()]);
    }

    //metodo que envia a un formaulario para la creacion de un nuevo servicio
    public function create()
    {
        return view('admin.formNuevoServicio', ['categorias' => Cateservicio::all()]);
    }

    //metodo que recoje datos del form de cracion y lo guarda
    public function store(Request $request)
    {
        $request->flash();

        $servicio = new Servicio();
        $servicio->nombre = $request->input('nombre');
        $servicio->descripcion = $request->input('descripcion');
        $servicio->ciudad = $request->input('ciudad');
        $servicio->fecha = $request->input('fecha');
        $servicio->facturacion = $request->input('facturacion');
        $servicio->cateservicio_id = $request->input('cateservicio_id');

        $path = $request->file('imagen')->store('public');
        // /public/nombreimagengenerado.jpg
        //Cambiamos public por storage en la BBDD para que se pueda ver la imagen en la web
        $servicio->imagen =  str_replace('public', 'storage', $path);

        $servicio->user_id = $request->input('user_id');

        $servicio->save();
        return redirect()->intended('/dashboard');
    }

    //metodo que añade a lista de megusta al servicio
    public function  megusta(Request $request){
        $servicio = new Servicio();
        $user = new User();
        $servicio->id = $request->input('servicio_id');
        $user->id = $request->input('user_id');

        if ($servicio->usuarios()->where('user_id', $user->id)->get()->count() == 0) {
            $servicio->usuarios()->attach($user->id, []);
        }

        return back();
    }

    //metodo que borra de la lista de megustas
    public function borrarUser(Servicio $servicio, User $user)
    {
        if ($servicio->usuarios()->where('user_id', $user->id)->get()->count() == 1) {
            $servicio->usuarios()->detach($user->id);
        }

        return back();
    }

    //metodo que muestra el detalle de un servicio determinado
    public function show(Servicio $servicio)
    {
        $comentarios=Comentario::orderBy('fecha', 'desc')->get();

        if(Auth::user()->rol=="admin" || Auth::user()->rol=="creador"){
            return view('admin.servicioDetalle', ['servicios' => $servicio, 'users'=> User::all(), 'categorias' => Cateservicio::all(), 'comentarios' => $comentarios, 'usuarios' => $servicio->usuarios()->get() ]);
        }else{
            return view('usuario.servicioDetalle', ['servicios' => $servicio, 'users'=> User::all(), 'categorias' => Cateservicio::all(), 'comentarios' => $comentarios, 'usuarios' => $servicio->usuarios()->get() ]);
        }
    }

    //metodo que muestra el detalle de un servicio determinado sin autenticar
    public function detalle(Servicio $servicio)
    {
        $comentarios=Comentario::orderBy('fecha', 'desc')->get();

        if(Auth::user()->rol=="admin" || Auth::user()->rol=="creador"){
            return view('admin.servicioDetalle', ['servicios' => $servicio, 'users'=> User::all(), 'categorias' => Cateservicio::all(), 'comentarios' => $comentarios, 'usuarios' => $servicio->usuarios()->get() ]);
        }else{
            return view('usuario.servicioDetalle', ['servicios' => $servicio, 'users'=> User::all(), 'categorias' => Cateservicio::all(), 'comentarios' => $comentarios, 'usuarios' => $servicio->usuarios()->get() ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servicio $servicio)
    {
        //
    }

    //metodo que modifica uno o varios datos  de un servicio 
    public function update(Request $request, Servicio $servicio)
    {
        $editServicio = Servicio::find($servicio->id);
        $editServicio->nombre = $request->input('nombre');
        $editServicio->descripcion = $request->input('descripcion');
        $editServicio->ciudad = $request->input('ciudad');
        $editServicio->fecha = $request->input('fecha');
        $editServicio->facturacion = $request->input('facturacion');
        $editServicio->cateservicio_id = $request->input('categoria_id');

        $editServicio ->save();

        return redirect()->intended('/dashboard');

    }

    //metodo que elimina un servicio
    public function destroy(Servicio $servicio)
    {
        $servicio->delete();
        return redirect('/dashboard');
    }

    //metodo que crea un comentario en un servicio
    public function comentario(Request $request){
        $request->flash();

        $comentario = new Comentario();
        $comentario->descripcion = $request->input('descripcion');
        $comentario->fecha = $request->input('fecha');
        $comentario->servicio_id = $request->input('servicio_id');
        $comentario->user_id = $request->input('user_id');

        $comentario->save();
        return back();
    }

    //metodo que elimina un comentario determinado del usuario
    public function borrarComent(Comentario $comentario)
    {
        $comentario->delete();
        return back();
    }

    //metodos de busqueda
    public function buscarFecha(Request $request)
    {

        $servicios = Servicio::where('fecha', '=', $request->input('fecha'))->get();

        if(Auth::user()->rol=="admin" || Auth::user()->rol=="creador"){
            return view('admin.buscados', ['servicios' => $servicios, 'categorias' => Cateservicio::all()]);
        }else{
            return view('usuario.buscados', ['servicios' => $servicios, 'categorias' => Cateservicio::all()]);
        }
    }

    public function buscarCiudad(Request $request)
    {

        $servicios = Servicio::where('ciudad', '=', $request->input('ciudad'))->get();

        if(Auth::user()->rol=="admin" || Auth::user()->rol=="creador"){
            return view('admin.buscados', ['servicios' => $servicios, 'categorias' => Cateservicio::all()]);
        }else{
            return view('usuario.buscados', ['servicios' => $servicios, 'categorias' => Cateservicio::all()]);
        }
    }

    public function buscarCategoria(Request $request)
    {

        $servicios = Servicio::join('cateservicios', 'servicios.cateservicio_id', '=', 'cateservicios.id')->where('cateservicio_id', '=', $request->input('categoria'))->get();

        if(Auth::user()->rol=="admin" || Auth::user()->rol=="creadoreve"){
            return view('admin.buscados', ['servicios' => $servicios, 'categorias' => Cateservicio::all()]);
        }else{
            return view('usuario.buscados', ['servicios' => $servicios, 'categorias' => Cateservicio::all()]);
        }
    }

    public function envioEmail(Servicio $servicio, User $user){

        $dueño = User::select('users.*')
            ->join('servicios', 'users.id', '=', 'servicios.user_id')
            ->where('servicios.id', $servicio->id)
            ->first();

        Mail::mailer("smtp")->to($user->email)->send(new Notificacion($servicio,$dueño,$user));

        return back();
    }
 }

