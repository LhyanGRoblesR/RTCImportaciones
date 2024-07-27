<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de accesorios para vehículos | RTCAR</title>

    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!--custom css file link-->


    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/sweetalert/dist/sweetalert.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/css/web.css')}}">


</head>

<body style="height: 100vh">
    <!--header inicio-->

    <header class="header">
        <a href="index.php" class="logo">
            <img src="{{asset('assets/images/logo-3.png')}}" alt="">
        </a>

        <nav class="navbar2">
            <a href="/">Inicio</a>
            <a href="/catalogo">Catalogo</a>
            @auth
                <div class="dropdown">
                    <a href="/my-account">Mi cuenta</a>
                    <div class="dropdown-content">
                        @if (auth()->user()->id_users_roles === 2 || auth()->user()->id_users_roles === 3)
                            <a href="/home">Sistema interno</a>
                        @endif
                        <a href="/carts">Carrito</a>
                        <a href="/logout">Cerrar sesión</a>

                    </div>
                </div>
            @endauth

            @guest
                <a href="/login">Iniciar sesión</a>
            @endguest
        </nav>

        <div class="icons">
            <div class="fas fa-bars" id="menu-btn2"></div>
    </header>


    <!--Productos section inicio-->
    <div class="container">
        <section class="productos" id="productos" style="padding-top: 130px">
            <h1 class="heading"><span>Mis cotizaciones</span></h1>
            <div class="mt-3" style="font-size: 16px">
                @include('layouts.messages')
            </div>
            @if (count($data) > 0)

                <div class="row g-0 bd-highlight">

                    @foreach ($data as $quote)
                        <div class="p-2 col-md-4">
                            <div class="card mb-4 bg-dark text-white">
                                <div class="row g-0">
                                    <div class="col-md-12">
                                        <div class="card-body ps-3">
                                            <h5 class="card-title h3 mt-3">Cotizacion: RTC-000{{$quote->id_quotes}}</h5>

                                            <p class="card-text h4 text-white mt-3">Total: S/. {{$quote->total_price}} </p>

                                            <p class="card-text h4 text-white mt-3">Estado: {{$quote->quote_status}} </p>

                                            <p class="card-text h4 text-white mt-3">Oferta: S/. {{$quote->custom_price}} </p>

                                            <div  style="font-size: 16px; margin-top: 10px; margin-bottom: 10px">

                                                <a href="/quotes/downloadpdf?id_quotes={{$quote->id_quotes}}" style="display: block;text-decoration: none; background: rgb(0, 5, 163); color: white; padding: 8px; font-size: 16px; width: 100%; text-align: center;" >Ver PDF</a>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            @else
                <div class="alert alert-warning" style="font-size: 16px" role="alert">
                    No tienes cotizaciones realizadas para mostrar
                </div>
            @endif
        </section>
    </div>
    <!--Pie de Página inicio-->

    <section class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <a href="#cabeceraCarrito" class="logo">
                        <img src="{{asset('assets/images/logo-3.png')}}" alt="">
                    </a>
                    <p>Empresa importadora de accesorios para vehículos</p>
                </div>
                <!--<div class="footer-col">
                    <p></p>
                </div>-->
                <div class="footer-col">
                    <h4>Menú</h4>
                    <ul>
                        <li><a href="#cabeceraCarrito">Inicio</a></li>
                        <li><a href="#categoria">Categorías</a></li>
                        <li><a href="#productos">Productos</a></li>
                        <li><a href="#promociones">Promociones</a></li>
                        <li><a href="#contacto">Contacto</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Contacto</h4>
                    <ul>
                        <p><ion-icon name="logo-whatsapp"></ion-icon> Whatsapp : </p>
                        <li><a href="https://api.whatsapp.com/send?phone=51993840896&text=Hola%20,somos%20RTC%20Importaciones%20E.I.R.L..%20%20En%20qué%20productos%20estás%20interesado?%20Te%20brindaré%20la%20información%20lo%20más%20pronto%20posible.%20Saludos." target="_blank">(+51) 993840896</a></li>
                        <p><ion-icon name="call-outline"></ion-icon> Celular : </p>
                        <li><a href="tel:+51993840896">(+51) 993840896</a></li>
                        <p><ion-icon name="mail-outline"></ion-icon> Correo : </p>
                        <li><a href="mailto:rtcarimport@gmail.com?Subject=Interesado%20en%20sus%20productos">rtcarimport@gmail.com</a></li>

                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Síguenos en</h4>
                    <div class="social-links">
                        <a href="#" class="fab fa-facebook"></a>
                        <!--<a href="#" class="fab fa-twitter"></a>-->
                        <a href="#" class="fab fa-instagram"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="copyrightText">
        <p><span>© Copyright 2023 RTCAR Import. All Rights Reserved.</span></p>
    </div>

    <!--Pie de Página fin-->
    <!--custom js file link-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="{{url('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('assets/js/jquery-3.7.1.min.js')}}"></script>
</body>

<script>

let navbar2 = document.querySelector('.navbar2');

document.querySelector('#menu-btn2').onclick = () =>{
    navbar2.classList.toggle('active');
}


window.onscroll = () =>{
    navbar2.classList.remove('active');
}



function getCsrfToken() {
  const hiddenInput = document.querySelector('input[name="_token"]');
  return hiddenInput ? hiddenInput.value : null;
}



</script>

</html>
