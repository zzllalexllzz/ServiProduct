<?php

namespace App\Http\Controllers;

use App\Models\Cateproducto;
use App\Models\Producto;
use App\Models\Resena;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Adapter\PDFLib;

class ProductoController extends Controller
{
    //metodo que muestra todos los prodcutos
    public function index()
    {
        if(Auth::user()->rol=="admin" || Auth::user()->rol=="creador"){
            return view('admin.productos', ['productos' => Producto::all(), 'categorias' => Cateproducto::all()]);
        }else{
            return view('usuario.productos', ['productos' => Producto::paginate(9), 'categorias' => Cateproducto::all()]);
        }
    }

    //metodo que muestra a no autenticados
    public function index1(){
        return view('usuario.productos', ['productos' => Producto::paginate(9), 'categorias' => Cateproducto::all()]);
    }

    //metodo que envia a un formulario para la creacion de una nuevo producto
    public function create()
    {
        return view('admin.formNuevoProducto', ['categorias' => Cateproducto::all()]);
    }

    /**
     * metodo que añade un producto
     */
    public function store(Request $request)
    {
        $request->flash();

        $producto = new Producto();
        $producto->nombre = $request->input('nombre');
        $producto->descripcion = $request->input('descripcion');
        $producto->fecha = $request->input('fecha');
        $producto->precio = $request->input('precio');
        $path = $request->file('imagen')->store('public');
        // /public/nombreimagengenerado.jpg
        //Cambiamos public por storage en la BBDD para que se pueda ver la imagen en la web
        $producto->imagen =  str_replace('public', 'storage', $path);

        $producto->cateproducto_id = $request->input('cateproducto_id');

        $producto->user_id = $request->input('user_id');

        $producto->save();
        return redirect()->intended('/productosadmin');
    }

    /**
     * metodo que muestra el detalle de un producto determinado
     */
    public function show(Producto $producto)
    {
        $comentarios=Resena::orderBy('fecha', 'desc')->get();

        if(Auth::user()->rol=="admin" || Auth::user()->rol=="creador"){
            return view('admin.productoDetalle', ['productos' => $producto, 'users'=> User::all(), 'categorias' => Cateproducto::all(), 'comentarios' => $comentarios]);
        }else{
            return view('usuario.productoDetalle', ['productos' => $producto, 'users'=> User::all(), 'categorias' => Cateproducto::all(), 'comentarios' => $comentarios, ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * metodo que modifica  un producto determinado
     */
    public function update(Request $request, Producto $producto)
    {
        $editProducto = Producto::find($producto->id);
        $editProducto->nombre = $request->input('nombre');
        $editProducto->descripcion = $request->input('descripcion');
        $editProducto->fecha = $request->input('fecha');
        $editProducto->precio = $request->input('precio');
        $editProducto->cateproducto_id = $request->input('categoria_id');

        $editProducto ->save();

        return redirect()->intended('/productos');
    }

    /**
     * metodo que elimina un producto 
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return back();
    }

    //metodo que crea un comentario en un servicio
    public function resena(Request $request){
        $request->flash();

        $comentario = new Resena();
        $comentario->descripcion = $request->input('descripcion');
        $comentario->fecha = $request->input('fecha');
        $comentario->producto_id = $request->input('producto_id');
        $comentario->user_id = $request->input('user_id');

        $comentario->save();
        return back();
    }

    //metodo que elimina un comentario determinado del usuario
    public function deleteComent(Resena $resena)
    {
        $resena->delete();
        return back();
    }

    //metodos de busqueda
    public function buscarFecha(Request $request)
    {

        $productos = Producto::where('fecha', '=', $request->input('fecha'))->get();

        if(Auth::user()->rol=="admin" || Auth::user()->rol=="creador"){
            return view('admin.buscadosp', ['productos' => $productos, 'categorias' => Cateproducto::all()]);
        }else{
            return view('usuario.buscadosp', ['productos' => $productos, 'categorias' => Cateproducto::all()]);
        }
    }

    public function buscarNombre(Request $request)
    {

        $productos = Producto::where('nombre', 'like', '%'.$request->input('nombre').'%')->get();

        if(Auth::user()->rol=="admin" || Auth::user()->rol=="creador"){
            return view('admin.buscadosp', ['productos' => $productos, 'categorias' => Cateproducto::all()]);
        }else{
            return view('usuario.buscadosp', ['productos' => $productos, 'categorias' => Cateproducto::all()]);
        }
    }

    public function buscarCategoria(Request $request)
    {

        $productos = Producto::join('cateproductos', 'productos.cateProducto_id', '=', 'cateproductos.id')->where('cateProducto_id', '=', $request->input('categoria'))->get();

        if(Auth::user()->rol=="admin" || Auth::user()->rol=="creadoreve"){
            return view('admin.buscadosp', ['productos' => $productos, 'categorias' => Cateproducto::all()]);
        }else{
            return view('usuario.buscadosp', ['productos' => $productos, 'categorias' => Cateproducto::all()]);
        }
    }

    //metodo que genera un pdf
    public function generarpdf(){
        $carrito = session('cart');
        $pdf = Pdf::loadView('usuario.pdf',compact('carrito') );
        return $pdf->download('facturaPedido.pdf');
    }

    //metodos del carrito borrar todo al finalizar la compra
    public function borrarcarrito(){

         // Borra el carrito de la sesión en Laravel
         Session::forget('cart');
         return response()->json(['success' => true]);
    }

    //metodo  que muesta la vista del carrito
    public function productCart()
    {
        return view('usuario.pagopaypal');
    }

    //metodo que añade un producto al carrito
    public function addProducttoCart($id)
    {
        $product = Producto::findOrFail($id);
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "sku" => $product->id,
                "nombre" => $product->nombre,
                "quantity" => 1,
                "precio" => $product->precio,
                "descripcion" => $product->descripcion
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'El producto ha sido agregado al carrito!');
    }

    //metodo que actualiza el carrito
    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Product added to cart.');
        }
    }

    //metodo que eleimina el producto del carrito
    public function deleteProduct(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Producto eliminado con éxito.');
        }
    }

    //metodo que  decrementa la cantidad del producto en el carrito
    public function updateProduct(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            
            if (isset($cart[$request->id])) {
                // Disminuye la cantidad del producto en 1
                $cart[$request->id]['quantity']--;

                // Si la cantidad llega a 0, elimina el producto del carrito
                if ($cart[$request->id]['quantity'] <= 0) {
                    unset($cart[$request->id]);
                }

                session()->put('cart', $cart);
            }
            
            session()->flash('success', 'Cantidad de producto actualizada.');
        }
    }

    //metodo que añade incrementa la cantida de cada producto en el carrito
    public function sumaProduct(Request $request)
    {
    if ($request->id) {
        $cart = session()->get('cart');
        
        if (isset($cart[$request->id])) {
            // Incrementa la cantidad del producto en 1
            $cart[$request->id]['quantity']++;

            session()->put('cart', $cart);
        }
        
        session()->flash('success', 'Cantidad de producto actualizada.');
    }
}
}
