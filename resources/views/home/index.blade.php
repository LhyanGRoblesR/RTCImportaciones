
@extends('layouts.menu')

@section('content')

    <h1>Home</h1>
    @auth
        <p>Bienvenido {{auth()->user()->email ?? auth()->user()->name}} estas logueado</p>
        <a href="/logout">Cerrar sesion</a>
    @endauth

    @guest
        <p>No estas logueado <a href="/login">Ir al login</a></p>
    @endguest


@endsection


