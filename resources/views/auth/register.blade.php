
@extends('layouts.auth')

@section('content')

<div class="d-flex justify-content-center w-100">
    <div class="border border-black rounded py-5 px-4 mt-5" style="width: 800px; background-color:rgb(255, 255, 255)">
        <h2 class="mb-4 text-center">Registrarse</h2>
        @include('layouts.messages')
        <form action="/register" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 ">
                    <div class="input-group mb-3">
                        <select class="form-select" id="id_document_types" name="id_document_types" style="max-width: 120px">
                            <option value="1">DNI</option>
                            <option value="2">Veneco</option>
                        </select>
                        <div class="form-floating">
                            <input type="text" class="form-control" id="document" name="document" placeholder="document"  />
                            <label for="document">Documento de identidad</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 ">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="name" value="{{old('name')}}">
                        <label for="name">Nombre completo</label>
                    </div>
                </div>

                <div class="col-md-6 ">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="phone" name="phone" placeholder="phone" value="{{old('phone')}}">
                        <label for="phone">N° celular</label>
                    </div>
                </div>

                <div class="col-md-6 ">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{old('email')}}">
                        <label for="email">Correo electrónico</label>
                    </div>
                </div>

                <div class="col-md-6 ">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        <label for="password">Contraseña</label>
                    </div>
                </div>

                <div class="col-md-6 ">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="password_confirmation">
                        <label for="password_confirmation">Repita la contraseña</label>
                    </div>
                </div>

                <div class="col-md-6 ">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="ruc" name="ruc" placeholder="ruc"  value="{{old('ruc')}}">
                        <label for="ruc">RUC</label>
                    </div>
                </div>

                <div class="col-md-6 ">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="business_name" name="business_name" placeholder="business_name"  value="{{old('business_name')}}">
                        <label for="business_name">Razon social</label>
                    </div>
                </div>

                <div class="col-md-6 ">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="country" name="country" placeholder="country" value="{{old('country')}}">
                        <label for="country">Pais</label>
                    </div>
                </div>

                <div class="col-md-6 ">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="department" name="department" placeholder="department" value="{{old('department')}}">
                        <label for="department">Departamento</label>
                    </div>
                </div>

                <div class="col-md-6 ">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="province" name="province" placeholder="province" value="{{old('province')}}">
                        <label for="province">Provincia</label>
                    </div>
                </div>

                <div class="col-md-6 ">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="district" name="district" placeholder="district" value="{{old('district')}}">
                        <label for="district">Distrito</label>
                    </div>
                </div>

                <div class="col-md-12 ">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="address" name="address" placeholder="address" value="{{old('address')}}">
                        <label for="address">Direccion</label>
                    </div>
                </div>

                <div class="w-100">

                    <button type="submit" class="btn btn-dark w-100 mb-3">Registrarse</button>

                    <a href="/login" class="btn btn-outline-dark w-100">Iniciar sesión</a>

                </div>

            </div>

        </form>

    </div>
</div>
@endsection

@section('javascript')
<script>
$(document).ready(function(){

    var tokenValue = $('input[name="_token"]').val();
    var nameInput = $('#name');
    var phoneInput = $('#phone');
    var emailInput = $('#email');
    var passwordInput = $('#password');
    var passwordConfirmationInput = $('#password_confirmation');
    var business_name = $('#business_name');
    var countryInput = $('#country');
    var departmentInput = $('#department');
    var provinceInput = $('#province');
    var districtInput = $('#district');
    var addressInput = $('#address');
    var idDocumentTypesInput = $('#id_document_types');
    var documentInput = $('#document');
    var rucInput = $('#ruc');

    documentInput.on('blur', function() {
        validateDocument('dni');
    });

    documentInput.on('change', function() {
        nameInput.val('');
        nameInput.prop('readonly', false);
    });

    idDocumentTypesInput.on('change', function() {
        documentInput.val('');
        nameInput.val('');
        nameInput.prop('readonly', false);
    });

    rucInput.on('blur', function() {
        validateDocument('ruc');
    });

    rucInput.on('change', function() {
        business_name.val('');
        business_name.prop('readonly', false);
        countryInput.val('');
        business_name.prop('readonly', false);
        departmentInput.val('');
        departmentInput.prop('readonly', false);
        provinceInput.val('');
        provinceInput.prop('readonly', false);
        districtInput.val('');
        districtInput.prop('readonly', false);
        addressInput.val('');
        addressInput.prop('readonly', false);
    });

    function validateDocument(documentType) {
        if (documentType === 'dni'){
            $.ajax({
                method: "POST",
                url: "/validateDocument",
                data: {id_document_types: idDocumentTypesInput.val(), document_type: documentType, document: documentInput.val(), _token: tokenValue }
            })
            .done(function( response ) {
                response = JSON.parse(response);
                if(response.success == true){
                    nameInput.val(response.data.nombre_completo);
                    nameInput.prop('readonly', true);
                }else{
                    nameInput.val('');
                    nameInput.prop('readonly', false);
                }

            });
        } else if(documentType === 'ruc') {
            $.ajax({
                method: "POST",
                url: "/validateDocument",
                data: {document_type: documentType, document: rucInput.val(), _token: tokenValue }
            })
            .done(function( response ) {
                response = JSON.parse(response);
                if(response.success == true){
                    business_name.val(response.data.nombre_o_razon_social);
                    business_name.prop('readonly', true);
                    countryInput.val('Perú');
                    countryInput.prop('readonly', true);
                    departmentInput.val(response.data.departamento);
                    departmentInput.prop('readonly', true);
                    provinceInput.val(response.data.provincia);
                    provinceInput.prop('readonly', true);
                    districtInput.val(response.data.distrito);
                    districtInput.prop('readonly', true);
                    addressInput.val(response.data.direccion);
                    addressInput.prop('readonly', true);
                }else{
                    business_name.val('');
                    business_name.prop('readonly', false);
                    countryInput.val('');
                    business_name.prop('readonly', false);
                    departmentInput.val('');
                    departmentInput.prop('readonly', false);
                    provinceInput.val('');
                    provinceInput.prop('readonly', false);
                    districtInput.val('');
                    districtInput.prop('readonly', false);
                    addressInput.val('');
                    addressInput.prop('readonly', false);
                }

            });
        }
    }

})
</script>
@endsection
