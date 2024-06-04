
@extends('layouts.menu')

@section('content')

    <div class="text-center">
        <span class="h2" aria-current="page">Contactos</span>
    </div>

    <div class="mt-3">
        @include('layouts.messages')
    </div>

    <div class="accordion mt-3">
        <div class="accordion-item">
          <h3 class="accordion-header">
            <button class="px-3 py-2 btn accordion-button bg-light text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#contacts-search" aria-expanded="true" aria-controls="contacts-search">
              Buscador
            </button>
          </h3>
          <div id="contacts-search" class="accordion-collapse collapse {{(isset($search) && $search !== '' ? 'show' : '')}}" data-bs-parent="#accordionExample">
            <form action="/contacts" method="GET">
                <div class="accordion-body">

                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="search" name="search" placeholder="search" value="{{$search}}">
                                <label for="search">Nombre / Email / Celular</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between ">
                        <div>
                            <button type="submit" class="btn btn-dark">Buscar</button>
                            <a href="/contacts" class="btn btn-outline-dark ms-1">Reiniciar</a>
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
                    <button class="px-3 py-2 btn accordion-button bg-light text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#contacts-result" aria-expanded="true" aria-controls="contacts-result">
                    Resultado
                    </button>
                </h3>

                <div id="contacts-result" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="table-responsive rounded-top">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Mensaje</th>
                                    <th scope="col">Fecha de creación</th>
                                    <th scope="col">Fecha de modificación</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody  class="text-nowrap">
                                @foreach($data as $k)
                                    <tr>
                                        <th scope="row">{{$k->id_contacts}}</th>
                                        <td>{{$k->name}}</td>
                                        <td>{{$k->phone}}</td>
                                        <td>{{$k->email}}</td>
                                        <td>{{$k->messages}}</td>
                                        <td>{{$k->timestamp_created}}</td>
                                        <td>{{$k->timestamp_modified}}</td>
                                        <td class="text-center"><button type="submit" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#contact-edit" data-bs-name="{{$k->name}}" data-bs-phone="{{$k->phone}}"  data-bs-email="{{$k->email}}" data-bs-messages="{{$k->messages}}">Ver</button></td>
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

    <div class="modal fade" id="contact-edit" tabindex="-1" aria-labelledby="contact-edit-label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="contact-edit-label">Ver contacto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {{-- <form action="/contacts/id_contacts_roles" method="POST">
                    @method('PUT') --}}
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="id_contacts" name="id_contacts">

                        <div class="row">

                            <div class="col-md-4 ">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="name" readonly>
                                    <label for="name">Nombre</label>
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

                            <div class="col-md-12 ">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="messages" name="messages" style="height: 100px" readonly></textarea>

                                    <label for="email">Mensaje del usuario</label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cerrar</button>
                        {{-- <button type="submit" class="btn btn-dark">Editar</button> --}}
                    </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>

@endsection

@section('javascript')
<script>
    $(document).ready(function(){
        const contactEdit = $('#contact-edit');

        if (contactEdit.length) {
            contactEdit.on('show.bs.modal', function(event) {
                const button = $(event.relatedTarget);
                const name = button.data('bs-name');
                const email = button.data('bs-email');
                const messages = button.data('bs-messages');
                const phone = button.data('bs-phone');

                const modalInputName = contactEdit.find('.modal-body #name');
                const modalInputEmail = contactEdit.find('.modal-body #email');
                const modalInputPhone = contactEdit.find('.modal-body #phone');
                const modalInputMessages = contactEdit.find('.modal-body #messages');


                modalInputName.val(name);
                modalInputEmail.val(email);
                modalInputPhone.val(phone);
                modalInputMessages.val(messages);

            });
        }



    })
    </script>
@endsection
