
@extends('layouts.menu')

@section('content')

    <div class="text-center">
        <span class="h2" aria-current="page">Usuarios</span>
    </div>

    <div class="mt-3">
        @include('layouts.messages')
    </div>

    <div class="accordion mt-3">
        <div class="accordion-item">
          <h3 class="accordion-header">
            <button class="px-3 py-2 btn accordion-button bg-light text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#users-search" aria-expanded="true" aria-controls="users-search">
              Buscador
            </button>
          </h3>
          <div id="users-search" class="accordion-collapse collapse {{(isset($search) && $search !== '' ? 'show' : '')}}" data-bs-parent="#accordionExample">
            <form action="/users" method="GET">
                <div class="accordion-body">

                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="search" name="search" placeholder="search" value="{{$search}}">
                                <label for="search">Nombre / Documento / Email / RUC / Celular</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between ">
                        <div>
                            <button type="submit" class="btn btn-dark">Buscar</button>
                            <a href="/users" class="btn btn-outline-dark ms-1">Reiniciar</a>
                        </div>
                    </div>
                </div>
            </form>
          </div>
        </div>
    </div>

    @if (isset($data) && count($data) > 0)
        <div class="accordion mt-3">
            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="px-3 py-2 btn accordion-button bg-light text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#users-result" aria-expanded="true" aria-controls="users-result">
                    Resultado
                    </button>
                </h3>

                <div id="users-result" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="table-responsive rounded-top" style="max-height: 550px">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Tipo de documento</th>
                                    <th scope="col">Documento</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Email verificado</th>
                                    <th scope="col">Rol</th>
                                    <th scope="col">Ruc</th>
                                    <th scope="col">Pais</th>
                                    <th scope="col">Departamento</th>
                                    <th scope="col">Provincia</th>
                                    <th scope="col">Distrito</th>
                                    <th scope="col">Direccion</th>
                                    <th scope="col">Fecha de creación</th>
                                    <th scope="col">Fecha de modificación</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody  class="text-nowrap">
                                @foreach($data as $k)
                                    <tr>
                                        <th scope="row">{{$k->id_users}}</th>
                                        <td>{{$k->name}}</td>
                                        <td>{{$k->document_type}}</td>
                                        <td>{{$k->document}}</td>
                                        <td>{{$k->phone}}</td>
                                        <td>{{$k->email}}</td>
                                        <td>{{($k->email_verified == 1 ? 'Si' : 'No')}}</td>
                                        <td>{{$k->user_rol}}</td>
                                        <td>{{$k->ruc}}</td>
                                        <td>{{$k->country}}</td>
                                        <td>{{$k->department}}</td>
                                        <td>{{$k->province}}</td>
                                        <td>{{$k->district}}</td>
                                        <td>{{$k->address}}</td>
                                        <td>{{$k->timestamp_created}}</td>
                                        <td>{{$k->timestamp_modified}}</td>
                                        <td class="text-center"><button type="submit" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#user-edit" data-bs-id_users="{{$k->id_users}}" data-bs-name="{{$k->name}}"  data-bs-document_type="{{$k->document_type}}" data-bs-document="{{$k->document}}" data-bs-email="{{$k->email}}"  data-bs-user_rol="{{$k->user_rol}}" data-bs-phone="{{$k->phone}}">Ver</button></td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>


            </div>
        </div>

    @else
        <div class="alert alert-secondary mt-3" role="alert">
            No se encontraron datos para mostrar
        </div>
    @endif

    <div class="modal fade" id="user-edit" tabindex="-1" aria-labelledby="user-edit-label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="user-edit-label">Ver usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/users/id_users_roles" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="id_users" name="id_users">

                        <div class="row">
                            <div class="col-md-4 ">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="name" readonly>
                                    <label for="name">Nombre</label>
                                </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="document_type" name="document_type" placeholder="document_type" readonly>
                                    <label for="document_type">Tipo de documento</label>
                                </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="document" name="document" placeholder="document" readonly>
                                    <label for="document">Documento</label>
                                </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="phone" readonly>
                                    <label for="phone">Celular</label>
                                </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="email" readonly>
                                    <label for="email">Correo electrónico</label>
                                </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="user_rol" name="user_rol" placeholder="user_rol" readonly>
                                    <label for="user_rol">Rol actual</label>
                                </div>
                            </div>

                            <div class="col-md-12 ">

                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="id_users_roles">Selecciona nuevo rol:</label>
                                    <select class="form-select " aria-label="Default select example" id="id_users_roles" name="id_users_roles" placeholder="user_rol">
                                        <option value="1">Usuario (Sin permisos)</option>
                                        <option value="2">Trabajador (Permisos limitados)</option>
                                        <option value="3">Administrador (Permisos para todo)</option>
                                    </select>
                                  </div>


                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-dark">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
<script>
$(document).ready(function(){
    const userEdit = $('#user-edit');

    if (userEdit.length) {
        userEdit.on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const name = button.data('bs-name');
            const id_users = button.data('bs-id_users');
            const document_type = button.data('bs-document_type');
            const document = button.data('bs-document');
            const email = button.data('bs-email');
            const user_rol = button.data('bs-user_rol');
            const phone = button.data('bs-phone');

            const modalInputName = userEdit.find('.modal-body #name');
            const modalInputIdUsers = userEdit.find('.modal-body #id_users');
            const modalInputDocumentType = userEdit.find('.modal-body #document_type');
            const modalInputDocument = userEdit.find('.modal-body #document');
            const modalInputEmail = userEdit.find('.modal-body #email');
            const modalInputUserRol = userEdit.find('.modal-body #user_rol');
            const modalInputPhone = userEdit.find('.modal-body #phone');

            modalInputName.val(name);
            modalInputIdUsers.val(id_users);
            modalInputDocumentType.val(document_type);
            modalInputDocument.val(document);
            modalInputEmail.val(email);
            modalInputUserRol.val(user_rol);
            modalInputPhone.val(phone);

        });
    }



})
</script>
@endsection
