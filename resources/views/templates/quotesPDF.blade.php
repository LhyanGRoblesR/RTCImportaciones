
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    table {
        width: 100%;
        border-collapse: collapse; /* Colapsar bordes */
    }
    th, td {
        border: 1px solid black; /* Bordes de las celdas */
        padding: 8px; /* Espaciado dentro de las celdas */
        text-align: left; /* Alinear el texto a la izquierda */
    }
    th {
        background-color: #c5c5c5; /* Fondo gris claro para los encabezados */
    }
    caption {
        font-weight: bold; /* Negrita para el título de la tabla */
        margin: 10px 0; /* Margen arriba y abajo */
    }
</style>
<body>
    <div style="display: flex">
        <div style="font-size: 30px; font-weigth: bold; text-align: center">
            Cotizacion RTC-000{{$quotes->id_quotes}}
        </div>
        <div style="margin-top: 30px">
            <table>
                <thead>
                    <tr>
                        <th colspan="3">Empresa emisora</th>
                    </tr>
                    <tr>
                        <th>N° Cotizacion</th>
                        <th>Razon Social</th>
                        <th>RUC</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>0000{{$quotes->id_quotes}}</td>
                        <td>RTC IMPORTACIONES E.I.R.L.</td>
                        <td>20601429846</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="margin-top: 30px">
            <table>
                <thead>
                    <tr>
                        <th colspan="2">Empresa receptora</th>
                    </tr>
                    <tr>
                        <th>Razon Social</th>
                        <th>RUC</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$user->business_name}}</td>
                        <td>{{$user->ruc}}</td>
                    </tr>
                </tbody>
            </table>
            <table>
                <thead>
                    <tr>
                        <th>Nombre y apellido</th>
                        <th>Documento de identidad</th>
                        <th>Correo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->document}}</td>
                        <td>{{$user->email}}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="margin-top: 30px">
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quotes_products as $product)
                        <tr>
                            <td>{{$product->product}}</td>
                            <td>{{$product->quantity}}</td>
                            <td style="text-align: right">S/. {{$product->total_price}}</td>
                        </tr>
                    @endforeach
                        <tr>
                            <td colspan="2" style="text-align: right">Sub total:</td>
                            <td style="text-align: right">S/. {{$quotes->brute_price}}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: right">IGV 18%:</td>
                            <td style="text-align: right">S/. {{$quotes->igv}}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: right">Total:</td>
                            <td style="text-align: right">S/. {{$quotes->total_price}}</td>
                        </tr>
                        @if (!empty($quotes->custom_price))
                        <tr>
                            <td colspan="2" style="text-align: right">Descuento</td>
                            <td style="text-align: right">S/. {{$quotes->total_price - $quotes->custom_price}}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: right">Precio final</td>
                            <td style="text-align: right">S/. {{$quotes->custom_price}}</td>
                        </tr>
                        @endif

                </tbody>
            </table>
        </div>

    </div>
</body>
</html>
