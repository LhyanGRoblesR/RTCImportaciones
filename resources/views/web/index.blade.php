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
    <link rel="stylesheet" href="{{asset('assets/css/web.css')}}">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/sweetalert/dist/sweetalert.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <!--header inicio-->

    <header class="header">
        <a href="#" class="logo">
            <img src="{{asset('assets/images/logo-3.png')}}" alt="">
        </a>

        <nav class="navbar">
            <a href="#inicio">Inicio</a>
            <a href="#nosotros">Nosotros</a>
            <a href="#identidad">Identidad</a>
            <a href="#servicios">Servicios</a>
            <a href="#productos">Productos</a>
            <a href="#contacto">Contacto</a>
            <a href="#blogs">Blogs</a>
            @auth
                <div class="dropdown">
                    <a href="/my-account">Mi cuenta</a>
                    <div class="dropdown-content">
                        @if (auth()->user()->id_users_roles === 2 || auth()->user()->id_users_roles === 3)
                            <a href="/home">Sistema interno</a>
                        @endif
                        <a href="/proximamente">Mis cotizaciones</a>
                        <a href="/logout">Cerrar sesión</a>

                    </div>
                </div>
            @endauth

            @guest
                <a href="/login">Iniciar sesión</a>
            @endguest
        </nav>

        <div class="icons">
            <div class="fas fa-bars" id="menu-btn"></div>
        </div>
    </header>

    <!--header fin-->

    <!--Inicio section inicio-->

    <section class="inicio" id="inicio">
        <div class="content">
            <h3>Los mejores accesorios para tu vehículo</h3>
            <p>Por compras mayores a S/. 300.00, el delivery es gratis. ¿Qué esperas?</p>
            <a href="/catalogo" class="btn">Ver Catálogo de Productos</a>
        </div>
    </section>

    <!--Inicio section fin-->

    <!--Nosotros section inicio-->

    <section class="nosotros" id="nosotros">
        <h1 class="heading"><span>Nosotros</span></h1>

        <div class="row">

            <div class="image">
                <img src="{{asset('assets/images/fotoNosotros.jpg')}}" alt="">
            </div>

            <div class="content">
                <h3>Quiénes somos?</h3>
                <p>¡Bienvenido/a a RTC IMPORTACIONES E.I.R.L.!

                <p>Somos una empresa mayorista con casi 6 años de experiencia en el mercado, especializada en la venta de accesorios
                    para vehículos en Lima y provincias. Nuestra amplia gama de productos incluye focos LED, alarmas, pestillos,
                    filtros de aire acondicionado y mucho más.</p>

                <p>En RTC IMPORTACIONES nos enorgullecemos de ofrecer productos de alta calidad a precios competitivos, brindando
                    soluciones a medida para Autoboutiques y Autoservicios. Contamos con un equipo experimentado y capacitado que está
                    listo para brindarte un servicio al cliente excepcional.</p>

                <p>Confía en nosotros como tu proveedor mayorista confiable para accesorios de vehículos. ¡Únete a nuestra familia
                    de clientes satisfechos y llevemos juntos tu negocio al siguiente nivel!</p>
                <!--<a href="#" class="btn">Leer más</a>-->
            </div>

        </div>
    </section>

    <!--Nosotros section fin-->

    <!--Identidad section inicio-->

    <section class="identidad" id="identidad">
        <h1 class="heading"><span>Identidad</span></h1>

        <div class="box-container">
            <div class="box">
                <img src="{{asset('assets/images/ident1.png')}}" alt="">
                <h2>Visión</h2>
                <h3>Nuestro propósito es convertirnos en la mejor empresa mayorista peruana que satisfaga de la manera más eficiente las necesidades de productos de accesorios para vehículos de sus clientes a nivel nacional.</h3>
            </div>

            <div class="box">
                <img src="{{asset('assets/images/ident2.png')}}" alt="">
                <h2>Misión</h2>
                <h3>Nuestra misión es la de comercializar accesorios para vehículos en relación calidad-precio a fin de satisfacer a nuestros clientes en su compra.</h3>
            </div>
        </div>
    </section>

    <!--Identidad section fin-->

    <!--Servicios section inicio-->

    <section class="servicios" id="servicios">
        <h1 class="heading"><span>Servicios</span></h1>

        <div class="row">

            <div class="content">
                <p>Nuestra oferta de servicios incluye:</p>

                <h3>- Venta mayorista de accesorios para vehículos:</h3>
                <p>Ofrecemos una selección diversa
                    de productos de alta calidad para mejorar la experiencia de conducción de tus clientes.</p>

                <h3>- Asesoramiento personalizado:</h3>
                <p>Contamos con un equipo de expertos en la industria automotriz
                    que está listo para brindarte asesoramiento personalizado.</p>

                <h3>- Servicio al cliente excepcional:</h3>
                <p>En RTC IMPORTACIONES, el cliente es nuestra prioridad.
                    Nuestro equipo capacitado está disponible para responder a tus consultas, resolver problemas
                    y brindarte un soporte confiable en cada momento.</p>

                <h3>- Abastecimiento confiable:</h3>
                <p>Gracias a nuestra sólida red de distribución, podemos garantizar
                    un abastecimiento oportuno y confiable. Mantén tu negocio siempre bien abastecido con los
                    productos más solicitados del mercado.</p>

                <!--<a href="#" class="btn">Leer más</a>-->
            </div>

            <div class="image">
                <img src="{{asset('assets/images/fotoServicio.jpg')}}" alt="">
            </div>

        </div>
        </div>
        <!--<div class="box-container">
            <p align="right"><a href="servicios.html" class="btn">Ver detalles</a></p>
        </div>-->
    </section>

    <!--Servicios section fin-->

    <!--Productos section inicio-->

    <section class="productos" id="productos">
        <h1 class="heading"><span>Productos</span></h1>

        <div class="box-container">
            @foreach ($products as $product)
            <div class="box">
                <img src="{{$product->photo_url}}" alt="Imagen{{$product->id_products}}">
                <h3>{{$product->product}}</h3>
                <div class="price">S/. {{$product->price}}</div>
            </div>
            @endforeach
        </div>

        <p align="right"><a href="/catalogo" class="btn">Ver productos</a></p>
    </section>

    <!--Productos section fin-->

    <!--Contacto section inicio-->

    <section class="contacto" id="contacto">
        <h1 class="heading"><span>Contacto</span></h1>

        <div class="row">
            <div class="whatsapp">
                <h3>Escríbenos por WhatsApp:</h3>
                <a href="https://api.whatsapp.com/send?phone=51993840896&text=Hola%20,somos%20RTC%20Importaciones%20E.I.R.L..%20%20En%20qué%20productos%20estás%20interesado?%20Te%20brindaré%20la%20información%20lo%20más%20pronto%20posible.%20Saludos." target="_blank">
                    <svg width="80" height="80" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg">
                        <!-- Created with SVG-edit - https://github.com/SVG-Edit/svgedit-->
                        <g class="layer">
                            <title>RTC IMPORTACIONES E.I.R.L.</title>
                            <circle cx="40" cy="40" fill="#fff" id="svg_1" r="38" stroke="#000000" stroke-width="0" />
                            <path d="m57.81072,21.975c-4.48928,-4.5 -10.46786,-6.975 -16.82142,-6.975c-13.11429,0 -23.78571,10.67143 -23.78571,23.78571c0,4.18928 1.09286,8.28215 3.17143,11.89286l-3.375,12.32142l12.61072,-3.31072c3.47143,1.89642 7.38215,2.89286 11.36786,2.89286l0.01072,0c13.10358,0 24.01072,-10.67143 24.01072,-23.78571c0,-6.35357 -2.7,-12.32142 -7.18928,-16.82142l-0.00001,-0.00001l-0.00001,0l-0.00002,0.00001zm-16.82142,36.6c-3.55714,0 -7.03928,-0.95357 -10.07143,-2.75357l-0.71785,-0.42857l-7.47858,1.96072l1.99286,-7.29642l-0.47143,-0.75c-1.98215,-3.15 -3.02142,-6.78215 -3.02142,-10.52142c0,-10.89642 8.87143,-19.76786 19.77858,-19.76786c5.28215,0 10.24286,2.05714 13.97143,5.79642c3.72857,3.73928 6.02142,8.7 6.01072,13.98215c0,10.90714 -9.09642,19.77858 -19.99286,19.77858l0,-0.00002l-0.00001,0l-0.00001,-0.00001zm10.84286,-14.80714c-0.58928,-0.3 -3.51429,-1.73572 -4.06072,-1.92857c-0.54643,-0.20358 -0.94286,-0.3 -1.33928,0.3c-0.39642,0.6 -1.53214,1.92857 -1.88571,2.33572c-0.34286,0.39642 -0.69642,0.45 -1.28571,0.15c-3.49286,-1.74643 -5.78571,-3.11785 -8.08928,-7.07143c-0.61072,-1.05 0.61072,-0.975 1.74643,-3.24643c0.19286,-0.39642 0.09642,-0.73928 -0.05357,-1.03928c-0.15,-0.3 -1.33928,-3.225 -1.83214,-4.41429c-0.48215,-1.15714 -0.975,-0.99642 -1.33928,-1.01785c-0.34286,-0.02142 -0.73928,-0.02142 -1.13572,-0.02142c-0.39642,0 -1.03928,0.15 -1.58571,0.73928c-0.54643,0.6 -2.07858,2.03572 -2.07858,4.96072c0,2.925 2.13214,5.75357 2.42142,6.15c0.3,0.39642 4.18928,6.39642 10.15714,8.97858c3.77143,1.62857 5.25,1.76786 7.13572,1.48928c1.14643,-0.17143 3.51429,-1.43572 4.00714,-2.82857c0.49286,-1.39286 0.49286,-2.58215 0.34286,-2.82857c-0.13928,-0.26786 -0.53572,-0.41785 -1.125,-0.70714l-0.00001,-0.00001l0.00002,-0.00001l-0.00002,-0.00001z" fill="currentColor" id="svg_2" />
                        </g>
                    </svg>
                </a>
                <h2>ó</h2>
                <h3>Mándanos un correo:</h3>
                <a href="mailto:rtcimport@gmail.com?Subject=Interesado%20en%20sus%20productos">
                    <svg width="80" height="80" id="Layer_1" style="enable-background:new 0 0 128 128;" version="1.1" viewBox="0 0 128 128" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <title>rtcimport@gmail.com</title>
                        <style type="text/css">
                            .st0 {
                                fill: #267CB5;
                            }

                            .st1 {
                                fill: #FFFFFF;
                            }
                        </style>
                        <g>
                            <circle class="st0" cx="64" cy="64" r="64" />
                        </g>
                        <g>
                            <g>
                                <path class="st1" d="M64,28" />
                            </g>
                        </g>
                        <g>
                            <g>
                                <path class="st1" d="M64,72.4l38.2-32.7c-0.6-0.4-1.4-0.7-2.2-0.7H28c-0.8,0-1.6,0.3-2.2,0.7L64,72.4z" />
                            </g>
                            <g>
                                <path class="st1" d="M66.6,75.4c-1.5,1.3-3.7,1.3-5.2,0L24,43.5V85c0,2.2,1.8,4,4,4h72c2.2,0,4-1.8,4-4V43.4L66.6,75.4z" />
                            </g>
                        </g>
                    </svg>
                </a>
                <h4>Área de Ventas</h4>
            </div>

            <div id="formulario" style="padding-top: 10rem">

                @auth
                    <form action="/contacts" method="POST">
                        @csrf
                        <h4>Dejanos un mensaje y nos pondremos en contacto contigo:</h4>
                        @if(Session::get('success', false))
                            <?php $data = Session::get('success'); ?>
                            @if (is_array($data))
                                @foreach ($data as $msg)
                                    <div class="messages-web">
                                        <i class="fa fa-check"></i>
                                        <h4 style="color: white">{{ $msg }}</h4>
                                    </div>
                                @endforeach
                            @else
                                <div class="messages-web" role="alert" style="">
                                    <i class="fa fa-check"></i>
                                    <h4 style="color: white">{{ $data }}</h4>
                                </div>
                            @endif
                        @endif
                        <div class="inputBox">
                            <span class="fas fa-user"></span>
                            <textarea name="messages" id="messages" rows="9" required></textarea>
                        </div>
                        <p align="right"><input type="submit" value="Contactar ahora" class="btn"></p>
                    </form>
                @endauth

                @guest
                    <h4>Para contactarnos porfavor inicia sesión:</h4>
                    <a href="/login" class="btn">Iniciar sesion</a>
                    <h4 style="margin-top: 3rem">o registrate:</h4>
                    <a href="/register" class="btn">Registrarse</a>
                @endguest

            </div>

        </div>
    </section>

    <!--Contacto section fin-->

    <!--Blogs section inicio-->

    <section class="blogs" id="blogs">
        <h1 class="heading"><span>Blogs</span></h1>

        <div class="box-container">

            @foreach ($blogs as $blog)
                <div class="box">
                    <div class="image">
                        <img src="{{$blog->photo_url}}" alt="">
                    </div>

                    <div class="content">
                        <a href="#" class="title">{{$blog->blog}}</a>
                        <span>Por RTCAR</span>
                        <p>{{$blog->description}}</p>
                        <!--<p align="right"><a href="carritoN.html" class="btn">Ver</a></p>-->
                    </div>
                </div>
            @endforeach


        </div>
    </section>

    <!--Blogs section fin-->

    <!--Pie de Página inicio-->

    <section class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <a href="#inicio" class="logo">
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
                        <li><a href="#inicio">Inicio</a></li>
                        <li><a href="#nosotros">Nosotros</a></li>
                        <li><a href="#identidad">Identidad</a></li>
                        <li><a href="#servicios">Servicios</a></li>
                        <li><a href="#productos">Productos</a></li>
                        <li><a href="#contacto">Contacto</a></li>
                        <li><a href="#blogs">Blogs</a></li>
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
</body>
<script>
//INDEX
let navbar = document.querySelector('.navbar');
//let searchForm = document.querySelector('.search-form');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
    //searchForm.classList.remove('active');
}

/*document.querySelector('#search-btn').onclick = () =>{
    searchForm.classList.toggle('active');
    navbar.classList.remove('active');
}*/

window.onscroll = () =>{
    navbar.classList.remove('active');
    //searchForm.classList.remove('active');
}
</script>

</html>
