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

<body>
    <!--header inicio-->

    <header class="header">
        <a href="index.php" class="logo">
            <img src="{{asset('assets/images/logo-3.png')}}" alt="">
        </a>

        <nav class="navbar2">
            <a href="/">Inicio</a>
            <a href="#categoria">Categorías</a>
            <a href="#productos">Productos</a>
            <a href="#promociones">Promociones</a>
            @auth
                <div class="dropdown">
                    <a href="/my-account">Mi cuenta</a>
                    <div class="dropdown-content">
                        @if (auth()->user()->id_users_roles === 2 || auth()->user()->id_users_roles === 3)
                            <a href="/home">Sistema interno</a>
                        @endif
                        <a href="/carts">Carrito</a>
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
            <div class="fas fa-bars" id="menu-btn2"></div>
    </header>

    <!--Cabecera Carrito section inicio-->

    <section class="cabeceraCarrito" id="cabeceraCarrito">
        <div class="contentCarrito">
            <h3>Catálogo de Productos</h3>
        </div>
    </section>

    <!--Inicio section fin-->

    <!--Categoría section inicio-->

    <section class="categoria" id="categoria">
        <h1 class="heading"><span>Categorías</span></h1>

        <div class="box-container">
            @foreach ($categories as $category)

                <div class="box">
                    <a href="#productos?id_categories={{$category->id_categories}}" class="btn-alarma">{{$category->category}}</a>
                </div>
            @endforeach
        </div>
    </section>

    <!--Categoría section fin-->

    <!--Productos section inicio-->

    <section class="productos" id="productos">
        <h1 class="heading"><span>Productos</span></h1>

        <div class="box-container">
            @foreach ($products as $product)
                <div class="box" data-id_categories="{{$product->id_categories}}">
                    <img src="{{$product->photo_url}}" alt="">
                    <h3>{{$product->product}}</h3>
                    <div class="price">S/. {{$product->price}}</div>
                    <!-- Modificar el enlace para usar un id único basado en el id del producto -->
                    <a href="#detalle{{$product->id_products}}" class="btn">Detalles</a>
                </div>
                <!-- Modificar el contenedor de detalles con un id único -->
                <div class="container-all" id="detalle{{$product->id_products}}">
                    <div class="popup">
                        <div class="vista">
                            <img src="{{$product->photo_url}}">
                        </div>
                        <div class="container-text">
                            <h2>{{$product->product}}</h2>
                            <br>
                            <h4>{{$product->description}}</h4>
                            <br>
                            <h3>Precio: S/. {{$product->price}}</h3>
                            <br>
                            <br>
                            <p>* La garantía se aplicará después de que nuestro técnico especialista revise el producto e identifique lo sucedido.</p>
                            <p>** El vendedor le brindará videos/guías de configuración de los productos al momento de entregárselos.</p>
                            <p>*** La atención de cualquier consulta sobre el producto será por medio de llamada o whatsapp: +51 993 840 896.</p>
                            @csrf
                            <button type="button" class="btn btn-outline-primary liveToastBtn" onclick="addProductCart({{$product->id_products}})">Agregar al carrito</button>
                        </div>

                        <!-- Modificar el enlace de cierre del popup para usar el id único del contenedor -->
                        <a href="#productos" class="btn-close-popup">X</a>
                    </div>
                </div>
            @endforeach
        </div>

        <p align="right"><button class="btn" id="restaurar-btn">Mostrar todos los productos</button></p>

        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true"  id="liveToast"  style="background: rgb(5, 131, 0); color: white">
                <div class="d-flex">
                <div class="toast-body" style="font-size: 18px;">
                    Producto agregado al carrito con exito.
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>

    </section>


    <!--Promociones section inicio-->

    <section class="promociones" id="promociones">
        <h1 class="heading"><span>Promociones Actuales</span></h1>

        <div class="box-container">
            <div class="box">
                <div class="image">
                    <img src="{{asset('assets/images/promoF7.jpeg')}}" alt="">
                </div>

                {{-- <div class="content">
                    <p align="center"><a href="#productos?promocion=8,9" class="btn">Ver Promo</a></p>
                </div> --}}
            </div>

            <div class="box">
                <div class="image">
                    <img src="{{asset('assets/images/promoX5.jpeg')}}" alt="">
                </div>

                {{-- <div class="content">
                    <p align="center"><a href="#productos?promocion=12,13" class="btn">Ver Promo</a></p>
                </div> --}}
            </div>
        </div>
    </section>

    <!--Promociones section fin-->

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


// Función para filtrar los productos según la categoría seleccionada
function filtrarProductos(categoria) {
    // Obtener todos los elementos con la clase "box" que contienen los productos
    const productos = document.querySelectorAll('.productos .box');

    // Recorrer todos los productos y ocultarlos si no pertenecen a la categoría seleccionada
    productos.forEach(producto => {
        const categoriaProducto = producto.dataset.id_categories; // Obtener el id_categoria del producto
        if (categoriaProducto === categoria || categoria === 'todos') {
            producto.style.display = 'block'; // Mostrar el producto
        } else {
            producto.style.display = 'none'; // Ocultar el producto
        }
    });

    // Realizar el desplazamiento suave hacia la sección de productos
    const seccionProductos = document.getElementById('productos');
    seccionProductos.scrollIntoView({ behavior: 'smooth' });
}

  // Función para capturar el evento de clic en los botones de categoría y filtrar los productos
  document.querySelectorAll('.categoria a').forEach(enlace => {
      enlace.addEventListener('click', function (event) {
          event.preventDefault(); // Evitar que el enlace navegue a otra página
          const categoriaSeleccionada = this.getAttribute('href').split('=')[1]; // Obtener el id_categoria de la URL
          console.log(categoriaSeleccionada);
          filtrarProductos(categoriaSeleccionada);
      });
  });

  // Función para filtrar los productos según la promoción seleccionada
function filtrarProductosPorPromocion(promocion) {
    const productos = document.querySelectorAll('.productos .box');

    productos.forEach(producto => {
        const productosPromocion = promocion.split('=')[1].split(','); // Obtener los IDs de productos de la URL
        const idProducto = producto.querySelector('a').getAttribute('href').split('#detalle')[1]; // Obtener el ID del producto

        if (productosPromocion.includes(idProducto) || promocion === 'todos') {
            producto.style.display = 'block'; // Mostrar el producto
        } else {
            producto.style.display = 'none'; // Ocultar el producto
        }
    });

    const seccionProductos = document.getElementById('productos');
    seccionProductos.scrollIntoView({ behavior: 'smooth' });
}


 // Función para capturar el evento de clic en los botones de promoción y filtrar los productos
document.querySelectorAll('.promociones a').forEach(enlace => {
    enlace.addEventListener('click', function (event) {
        event.preventDefault();
        const promocionSeleccionada = this.getAttribute('href'); // Obtener la URL con los IDs de productos
        filtrarProductosPorPromocion(promocionSeleccionada);
    });
});

  // Función para mostrar todos los productos cuando se hace clic en el botón "Mostrar todos los productos"
  document.getElementById('restaurar-btn').addEventListener('click', function () {
      filtrarProductos('todos'); // Mostrar todos los productos
      filtrarProductosPorPromocion('todos'); // Mostrar todas las promociones
  });

  const toastLiveExample = document.getElementById('liveToast')
  const toastTrigger = document.getElementsByClassName('liveToastBtn')

function addProductCart(id_products) {
    const csrfToken = getCsrfToken();
    console.log(csrfToken);
    $.ajax({
        url: "/carts",
        type: "POST", // Cambiar el tipo de solicitud si es necesario (GET, POST, etc.)
        data: {
            id_products: id_products,
            _token: csrfToken
        }, // Enviar los parámetros necesarios
        success: function(result) {
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
            toastBootstrap.show();
        },
        error: function(xhr, status, error) {
        // Manejo de errores
        console.error("Error al añadir el producto al carrito:", error);
        }
    });
}

function getCsrfToken() {
  const hiddenInput = document.querySelector('input[name="_token"]');
  return hiddenInput ? hiddenInput.value : null;
}



</script>

</html>
