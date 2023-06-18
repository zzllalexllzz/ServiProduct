@extends('usuario.layout')

@section('titulo', 'Productos')

@section('main')
<div class="row mb-5 flex justify-content-center">
    <div class="col-lg-5 mb-3 mb-sm-0">
      <div class="card shadow-lg ">
        <div class="card-body ">
            <h3 class="card-title text-center text-warning-emphasis">PEDIDO: {{Auth::user()->nombre}}</h3>
            <table id="cart" class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0 @endphp
                    @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                        @php
                        // $cart = session('cart'); // Obtener el carrito de la sesión

                        // $paypalCart = []; // Array para almacenar los productos en el formato requerido por PayPal

                        // foreach ($cart as $item) {
                        //     $product = [
                        //         'sku' => $item['sku'], // SKU del producto
                        //         'quantity' => $item['quantity'], // Cantidad del producto
                        //         'price' => $item['precio'], // Precio del producto
                        //     ];

                        //     $paypalCart[] = $product; // Agregar el producto al array de PayPal
                        // }

                        $subtotal = $details['precio']*$details['quantity'];
                        $total += $subtotal;

                        @endphp
                            <tr rowId="{{ $id }}">
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p class="nomargin">{{ $details['nombre'] }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Price">{{ $details['precio'] }} €</td>
                                <td data-th="Price">{{ $details['quantity'] }}</td>

                                <td data-th="Subtotal" class="text-center">{{$subtotal}} €</td>
                                <td class="actions">
                                    <a class="btn btn-outline-dark btn-sm sumar-product"><i class="bi bi-plus-lg"></i></a>
                                    <a class="btn btn-outline-dark btn-sm restar-product"><i class="bi bi-dash-lg"></i></a>
                                    <a class="btn btn-outline-danger btn-sm delete-product"><i class="bi bi-x-lg"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-right">
                            <span class="total-label">Total a Pagar:</span>
                            <h2 class="font-weight-bold total-amount">{{ $total }} €</h2>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-right">
                            <a href="/productos" class="btn btn-outline-primary"><i class="fa fa-angle-left"></i> Continue Comprando</a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
      </div>
    </div>
    <div class="col-lg-5">
      <div class="card shadow-lg ">
        <div class="card-body">
            <div id="paypal-button-container"></div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
<script src="https://www.paypal.com/sdk/js?client-id={{config('services.paypal.client_id')}}&currency=EUR">
</script>
<script>
    //Botones del paypal developer checkout
    paypal.Buttons({
        style:{
            color: 'blue',
            shape: 'pill',
            label: 'pay'
        }, createOrder: function(data, actions){
            return actions.order.create({
                purchase_units: [{
                    amount:{
                        value: {{$total}}
                    }
                }]
            })
        },

        onApprove:  function (data, actions){
            actions.order.capture().then(function(detalles){
                console.log(detalles);
                //llamo al funcion para generar la factura en formato pdf
                generarPDF();
                // Llamar a la función para borrar el carrito de la sesión en Laravel
            borrarCarrito();
            window.location.reload();
            });
        },

        onCancel:function(data){
            alert("pago cancelado");
            console.log(data);
        }
    }).render('#paypal-button-container');

    //metodo que llama un peticion a las rutas para generar el pdf de la factura
    function generarPDF() {

    var url = '/generar-pdf'; // nombre del la ruta en rutes

    var requestOptions = {
        method: 'GET',
        redirect: 'follow'
    };

    // Enviar la solicitud GET
    fetch(url, requestOptions)
        .then(response => response.blob())
        .then(blob => {
            // Crear un enlace para descargar el archivo
            var downloadLink = document.createElement('a');
            downloadLink.href = URL.createObjectURL(blob);
            downloadLink.download = 'facturaPedido.pdf';

            // Simular un clic en el enlace para iniciar la descarga
            downloadLink.click();
        })
        .catch(error => {
            console.error(error);
        });
}
    //metodo que borra todo el carrito con la lamada a la ruta borrar carrito esto borrara el carrito de la session cuando termine la compra
    function borrarCarrito() {

    var url = '/borrar-carrito'; // nombre  de la ruta en routes
    
    // Configurar los datos del formulario
    var formData = new FormData();
    formData.append('_token', '{{ csrf_token() }}'); // Token CSRF de Laravel
    
    // Configurar la solicitud POST
    var requestOptions = {
        method: 'POST',
        body: formData,
        redirect: 'follow'
    };

    // Enviar la solicitud POST
    fetch(url, requestOptions)
        .then(response => response.json())
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error(error);
        });
}

//metodo que borra el producto del carrito con la llamada a la ruta delete cart product
$(".delete-product").click(function (e) {
    e.preventDefault();

    var ele = this;

    var productId = ele.closest("tr").getAttribute("rowId"); // método closest() y getAttribute() para obtener el valor del atributo 'rowId'

    var url = '{{ route('delete.cart.product') }}';
    var token = '{{ csrf_token() }}';

    fetch(url, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({ id: productId })
    })
    .then(function (response) {
        if (response.ok) {
            window.location.reload();
        } else {
            throw new Error('Error al eliminar el producto del carrito.');
        }
    })
    .catch(function (error) {
        console.error(error);
    });
});

//metodo que decrementa la catidad del producto en el carrito con la llamada a update cart product
$(".restar-product").click(function(e) {
    e.preventDefault();

    var ele = this; 

    var productId = ele.closest("tr").getAttribute("rowId"); //método closest() y getAttribute() para obtener el valor del atributo 'rowId'

    var cartUrl = '{{ route('update.cart.product') }}';
    var token = '{{ csrf_token() }}';

    fetch(cartUrl, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({ id: productId })
    })
    .then(function (response) {
        if (response.ok) {
            var quantityElement = ele.closest("tr").querySelector(".quantity"); // método closest() y querySelector() para obtener el elemento con la clase 'quantity'
            var quantity = parseInt(quantityElement.textContent);
            quantity--;
            quantityElement.textContent = quantity;

            if (quantity === 0) {
                ele.closest("tr").remove(); //método closest() para encontrar el elemento 'tr' más cercano y lo elimina
            }

        } else {
            throw new Error('Error al restar el producto del carrito.');
        }
    })
    .catch(function (error) {
        console.error(error);
    });
    window.location.reload();
});

//metodo que incrementa la cantidad del prodcuto en el carrito con la llamda a sumar cart product
$(".sumar-product").click(function(e) {
    e.preventDefault();

    var ele = this; 

    var productId = ele.closest("tr").getAttribute("rowId"); //método closest() y getAttribute() para obtener el valor del atributo 'rowId'

    var cartUrl = '{{ route('sumar.cart.product') }}';
    var token = '{{ csrf_token() }}';

    fetch(cartUrl, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({ id: productId })
    })
    .then(function(response) {
        if (response.ok) {
            var quantityElement = ele.closest("tr").querySelector(".quantity"); //método closest() y querySelector() para obtener el elemento con la clase 'quantity'
            var quantity = parseInt(quantityElement.textContent);
            quantity++;
            quantityElement.textContent = quantity;

        } else {
            throw new Error('Error al sumar el producto al carrito.');
        }
    })
    .catch(function(error) {
        console.error(error);
    });
    window.location.reload();
});
</script>

@endsection