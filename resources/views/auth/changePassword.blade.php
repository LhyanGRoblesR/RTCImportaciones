
@extends('layouts.auth')

@section('content')

    <div class="d-flex justify-content-center w-100">
        <div class="border border-black rounded py-5 px-4 mt-5" style="width: 500px; background-color:rgb(255, 255, 255)">
            <h2 class="mb-4 text-center">Cambiar contraseña</h2>
            @include('layouts.messages')
            <form action="/login" method="POST">
                @csrf
                <input type="hidden" id="token" name="token">

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                    <label for="email">Correo electrónico</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    <label for="password">Contraseña</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="password_confirmation">
                    <label for="password_confirmation">Repita la contraseña</label>
                </div>

                <div class="w-100">

                    <button type="submit" class="btn btn-dark w-100 mb-3">Cambiar contraseña</button>

                </div>
            </form>

        </div>
    </div>
@endsection
