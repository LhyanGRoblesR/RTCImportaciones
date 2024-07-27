<!DOCTYPE html>
<html lang="en" style="height: 100vh;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RTCImportaciones</title>
    <link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body style="height: 100vh; background-color:rgb(255, 255, 255)">
    <main style="height: 100vh;">
        <div class="d-flex flex-row h-100">
            <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark h-100" style="width: 280px">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-4">RTCImportaciones</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="/home" class="nav-link {{ Request::is('home') ? 'active' : 'text-white' }}">
                            <i class="bi bi-house me-2"></i>
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="/categories" class="nav-link {{ Request::is('categories') ? 'active' : 'text-white' }}">
                            <i class="bi bi-tag me-2"></i>
                            Categorias
                        </a>
                    </li>
                    <li>
                        <a href="/products" class="nav-link {{ Request::is('products') ? 'active' : 'text-white' }}">
                            <i class="bi bi-box me-2"></i>
                            Productos
                        </a>
                    </li>
                    <li>
                        <a href="/users" class="nav-link {{ Request::is('users') ? 'active' : 'text-white' }}">
                            <i class="bi bi-people me-2"></i>
                            Usuarios
                        </a>
                    </li>
                    <li>
                        <a href="/contacts" class="nav-link {{ Request::is('contacts') ? 'active' : 'text-white' }}">
                            <i class="bi bi-person-lines-fill me-2"></i>
                            Contactos
                        </a>
                    </li>
                    <li>
                        <a href="/blog" class="nav-link {{ Request::is('blog') ? 'active' : 'text-white' }}">
                            <i class="bi bi-book me-2"></i>
                            Blog
                        </a>
                    </li>
                    <li>
                        <a href="/quotes" class="nav-link {{ Request::is('quotes') ? 'active' : 'text-white' }}">
                            <i class="bi bi-coin me-2"></i>
                            Cotizaciones
                        </a>
                    </li>
                </ul>
            </div>
            <div class="w-100">
                <div class="w-100">
                    <nav class="navbar navbar-expand-lg bg-body-tertiary">
                        <div class="container-fluid">
                            <div class="collapse navbar-collapse d-flex justify-content-end">
                                <ul class="navbar-nav mb-2 mb-lg-0 me-1">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{auth()->user()->email ?? auth()->user()->name}}
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="/">Ir a la web</a></li>
                                            {{-- <li><a class="dropdown-item" href="#">Mi cuenta</a></li> --}}
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="/logout">Cerrar sesión</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="container mt-2">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
    <script src="{{url('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('assets/js/jquery-3.7.1.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @yield('javascript')
</body>
</html>
