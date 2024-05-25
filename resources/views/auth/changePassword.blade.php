
@extends('layouts.auth')

@section('content')

    <div class="d-flex justify-content-center w-100">
        <div class="border border-black rounded py-5 px-4 mt-5" style="width: 500px; background-color:rgb(255, 255, 255)">
            <h2 class="mb-4 text-center">Restablecer contraseña</h2>
            @include('layouts.messages')
            <form action="/changePassword" method="POST">
                @csrf
                <input type="hidden" id="token" name="token" value="{{$token}}">

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <label for="password">Contraseña</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="password_confirmation" required>
                    <label for="password_confirmation">Repita la contraseña</label>
                </div>

                <div class="w-100">

                    <button type="submit" class="btn btn-dark w-100 mb-3">Cambiar contraseña</button>

                </div>
            </form>

        </div>
    </div>
@endsection
