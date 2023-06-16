<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura del Pedido</title>
    <style>
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-table th,
        .invoice-table td {
            padding: 10px;
            text-align: left;
        }

        .invoice-table thead th {
            background-color: #f5f5f5;
            border-bottom: 1px solid #ddd;
        }

        .invoice-table tbody td {
            border-bottom: 1px solid #ddd;
        }

        .invoice-table tfoot td {
            font-weight: bold;
        }

        .invoice-table tfoot h2 {
            margin: 0;
        }

        .invoice-table h3 {
            margin-top: 30px;
        }

        .motivation-text {
            margin-top: 30px;
            font-style: italic;
        }

        .logo-text {
            margin-top: 30px;
            font-weight: bold;
            font-size: 24px;
        }
    </style>
</head>
<body>
    <h3>Factura del Pedido</h3>
    <table class="invoice-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0 @endphp
            @foreach($carrito as $id => $cart)
            @php
            $subtotal = $cart['precio'] * $cart['quantity'];
            $total += $subtotal;
            @endphp
            <tr rowId="{{ $id }}">
                <td data-th="Product">
                    <div>
                        <div>
                            <p>{{ $cart['nombre'] }}</p>
                        </div>
                    </div>
                </td>
                <td data-th="Price">{{ $cart['precio'] }} €</td>
                <td data-th="Price">{{ $cart['quantity'] }}</td>
                <td data-th="Subtotal">{{ $subtotal }} €</td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">
                    <span>Total a Pagar:</span>
                    <h2>{{ $total }} €</h2>
                </td>
            </tr>
        </tfoot>
    </table>

    <p class="motivation-text">¡Gracias por tu compra! Esperamos verte de nuevo pronto en nuestra tienda online.</p>
    <p class="logo-text">SERVIPRODUCT</p>
</body>
</html>