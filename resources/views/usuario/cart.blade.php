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
                            <span class="total-label">Total:</span>
                            <h3 class="font-weight-bold total-amount">{{ $total }} €</h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-right">
                            <a href="/productos" class="btn btn-outline-primary""><i class="fa fa-angle-left"></i> Continue Comprando</a>
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
            <!-- Set up a container element for the button -->
            <div id="paypal-button-container"></div>
          {{-- <h3 class="card-title text-center">Dejanos tu opinion</h3>
          <div class="mb-5">
            <form action="/producto/resena" method="POST">
              @csrf
              <!-- user_id -->
              <input type="hidden" name="user_id" value={{Auth::user()->id}}>
              <!-- evento -->
              <input type="hidden" name="producto_id" value={{$productos->id}}>
              <input type="hidden" name="fecha" value="<?php echo date('Y-m-d H:i:s');?>">
              <div class="mb-3">
                <label class="form-label"><strong>Añadir Reseña:</strong></label>
                <textarea class="form-control" name="descripcion" placeholder="Comenta aqui..." id="floatingTextarea" style="height: 100px"></textarea>
              </div>
              <center>
                <button class="btn btn-outline-success text-center">Añadir Reseña</button>
              </center>
            </form>
          </div>
          <div>
            @foreach ($comentarios as $comentario)
                @if($productos->id==$comentario->producto_id)
                <div>
                    @foreach ($users as $user)
                    @if($user->id==$comentario->user_id)
                        <h5>{{$user->nombre}} {{$user->apellido}}</h5>
                    @endif
                    @endforeach
                    <p class="text-light-emphasis opacity-25">{{$comentario->fecha}}</p>
                    <p>{{$comentario->descripcion}}</p>
                    <div>
                        @if (Auth::user()->id==$comentario->user_id)
                        <a href="/resena/{{ $comentario->id }}/borrar" class="d-flex justify-content-end"><i class="bi bi-x-lg text-danger"></i></a>
                        @endif
                    </div>
                </div>
                <hr style="width: 100%; border:1px solid black;">
                @endif
            @endforeach
          </div> --}}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
<script type="text/javascript">

    $(".edit-cart-info").change(function (e) {
        e.preventDefault();
        var ele = $(this);
        $.ajax({
            url: '{{ route('update.sopping.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents("tr").attr("rowId"),
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });

    $(".delete-product").click(function (e) {
        e.preventDefault();

        var ele = $(this);

        //if(confirm("Do you really want to delete?")) {
            $.ajax({
                url: '{{ route('delete.cart.product') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("rowId")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        //}
    });

    $(".restar-product").click(function(e) {
    e.preventDefault();

    var ele = $(this);

    //if (confirm("Do you really want to delete?")) {
        var productId = ele.parents("tr").attr("rowId");
        var cartUrl = '{{ route("update.cart.product") }}';
        
        $.ajax({
            url: cartUrl,
            method: "DELETE",
            data: {
                _token: '{{ csrf_token() }}',
                id: productId
            },
            success: function(response) {
                // Actualiza la cantidad en el carrito en la interfaz
                var quantityElement = ele.parents("tr").find(".quantity");
                var quantity = parseInt(quantityElement.text());
                quantity--;
                quantityElement.text(quantity);

                // Si la cantidad es 0, elimina la fila de la tabla
                if (quantity === 0) {
                    ele.parents("tr").remove();
                }
            },
            success: function(response) {
                window.location.reload();
            }
        });
        
    }
//}
);

$(".sumar-product").click(function(e) {
    e.preventDefault();

    var ele = $(this);

    //if (confirm("¿Realmente deseas agregar?")) {
        var productId = ele.parents("tr").attr("rowId");
        var cartUrl = '{{ route("sumar.cart.product") }}';
        
        $.ajax({
            url: cartUrl,
            method: "PUT",
            data: {
                _token: '{{ csrf_token() }}',
                id: productId
            },
            success: function(response) {
                // Actualiza la cantidad en el carrito en la interfaz
                var quantityElement = ele.parents("tr").find(".quantity");
                var quantity = parseInt(quantityElement.text());
                quantity++;
                quantityElement.text(quantity);
            },
            error: function(response) {
                // Maneja el error de la solicitud AJAX si es necesario
            },
            complete: function(response) {
                window.location.reload();
            }
        });
    }
//}
);
</script>

<!-- Replace "test" with your own sandbox Business account app client ID -->
<script src="https://www.paypal.com/sdk/js?client-id={{config('services.paypal.client_id')}}&currency=USD"></script>
<script type="text/javascript">
    //------PAYPAL-----------------------------------
paypal.Buttons({
    style: {
                color:  'blue',
                shape:  'pill',
                label:  'pay',
                height: 40
            },
        // Order is created on the server and the order id is returned
        createOrder() {
          return fetch("/my-server/create-paypal-order", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            // use the "body" param to optionally pass additional order information
            // like product skus and quantities ,
            body: JSON.stringify({
              cart: [
                {
                  sku: "YOUR_PRODUCT_STOCK_KEEPING_UNIT",
                  quantity: "YOUR_PRODUCT_QUANTITY",
                },
              ],
            }),
          })
          .then((response) => response.json())
          .then((order) => order.id);
        },
        // Finalize the transaction on the server after payer approval
        onApprove(data) {
          return fetch("/my-server/capture-paypal-order", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              orderID: data.orderID
            })
          })
          .then((response) => response.json())
          .then((orderData) => {
            // Successful capture! For dev/demo purposes:
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
            const transaction = orderData.purchase_units[0].payments.captures[0];
            alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
            // When ready to go live, remove the alert and show a success message within this page. For example:
            // const element = document.getElementById('paypal-button-container');
            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
            // Or go to another URL:  window.location.href = 'thank_you.html';
          });
        }
      }).render('#paypal-button-container');
</script>
@endsection