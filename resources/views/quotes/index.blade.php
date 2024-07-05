
@extends('layouts.menu')

@section('content')

    <div class="text-center">
        <span class="h2" aria-current="page">Cotizaciones</span>
    </div>

    <div class="mt-3">
        @include('layouts.messages')
    </div>

    <div class="accordion">
        <div class="accordion-item">
          <h3 class="accordion-header">
            <button class="px-3 py-2 btn accordion-button bg-light text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#quotes-actions" aria-expanded="true" aria-controls="quotes-actions">
              Acciones
            </button>
          </h3>
          <div id="quotes-actions" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="d-flex justify-content-between ">
                    <div>
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#quote-create">
                            Crear cotizacion
                          </button>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>

    <div class="accordion mt-3">
        <div class="accordion-item">
          <h3 class="accordion-header">
            <button class="px-3 py-2 btn accordion-button bg-light text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#quotes-search" aria-expanded="true" aria-controls="quotes-search">
              Buscador
            </button>
          </h3>
          <div id="quotes-search" class="accordion-collapse collapse {{(isset($search) && $search !== '' ? 'show' : '')}}" data-bs-parent="#accordionExample">
            <form action="/quotes" method="GET">
                <div class="accordion-body">

                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="search" name="search" placeholder="search" value="{{$search}}">
                                <label for="search">Nombre del creador / Nombre del modificador </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between ">
                        <div>
                            <button type="submit" class="btn btn-dark">Buscar</button>
                            <a href="/quotes" class="btn btn-outline-dark ms-1">Reiniciar</a>
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
                    <button class="px-3 py-2 btn accordion-button bg-light text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#quotes-result" aria-expanded="true" aria-controls="quotes-result">
                    Resultado
                    </button>
                </h3>

                <div id="quotes-result" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="table-responsive rounded-top" style="max-height: 550px">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Usuario</th>
                                    <th scope="col">SubTotal</th>
                                    <th scope="col">IGV</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Precio modificado</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Usuario de creacion</th>
                                    <th scope="col">Usuario de modificación</th>
                                    <th scope="col">Fecha de creacion</th>
                                    <th scope="col">Fecha de modificación</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-nowrap">
                                @foreach($data as $k)
                                    <tr>
                                        <th scope="row">{{$k->id_quotes}}</th>
                                        <td>{{$k->name}}</td>
                                        <td>{{$k->brute_price}}</td>
                                        <td>{{$k->igv}}</td>
                                        <td>{{$k->total_price}}</td>
                                        <td>{{$k->custom_price}}</td>
                                        <td>{{$k->quote_status}}</td>
                                        <td>{{$k->name_created}}</td>
                                        <td>{{$k->name_modified}}</td>
                                        <td>{{$k->timestamp_created}}</td>
                                        <td>{{$k->timestamp_modified}}</td>
                                        <td class="text-center"><button type="submit" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#quote-edit" data-bs-id_quotes="{{$k->id_quotes}}" data-bs-id_categories="{{$k->id_categories}}" data-bs-quote="{{$k->quote}}" data-bs-photo_url="{{$k->photo_url}}" data-bs-price="{{$k->price}}" data-bs-description="{{$k->description}}" data-bs-active="{{$k->active}}">Ver</button></td>
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

    <div class="modal fade" id="quote-create" tabindex="-1" aria-labelledby="quote-create-label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="quote-create-label">Crear cotizacion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/quotes" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-6 ">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="quote" name="quote" placeholder="quote">
                                    <label for="quote">Nombre de quoteo</label>
                                </div>
                            </div>

                            <div class="col-md-6 ">
                                <div class="form-floating mb-3">
                                    <input type="file" class="form-control" id="photo" name="photo" placeholder="photo">
                                    <label for="photo">Foto</label>
                                </div>
                            </div>

                            <div class="col-md-6 ">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="price" name="price" placeholder="price" step="0.01">
                                    <label for="price">Precio</label>
                                </div>
                            </div>

                            <div class="col-md-12 ">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="description" name="description" style="height: 100px"></textarea>
                                    <label for="price">Descripcion del quoteo</label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-dark">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="quote-edit" tabindex="-1" aria-labelledby="quote-edit-label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="quote-edit-label">Ver quoteo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/quotes" method="POST" id="form-quote-edit-delete" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="id_quotes" name="id_quotes">

                        <div class="row">
                            <div class="col-md-6 ">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="quote" name="quote" placeholder="quote">
                                    <label for="quote">Nombre de quoteo</label>
                                </div>
                            </div>

                            <div class="col-md-6 ">
                                <div class="form-floating mb-3">
                                    <input type="file" class="form-control" id="photo" name="photo" placeholder="photo">
                                    <label for="photo">Foto</label>
                                </div>
                            </div>

                            <div class="col-md-6 ">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="price" name="price" placeholder="price" step="0.01">
                                    <label for="price">Precio</label>
                                </div>
                            </div>

                            <div class="col-md-12 ">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="description" name="description" style="height: 100px"></textarea>
                                    <label for="price">Descripcion del quoteo</label>
                                </div>
                            </div>

                            <div class="col-md-12 ">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="active" name="active">
                                        <option value="0">No</option>
                                        <option value="1">Si</option>
                                    </select>
                                    <label for="quote">Activo</label>

                                </div>
                            </div>

                            <div class="col-md-12 text-center">
                                <img src="" alt="ImageEdit" id="photo_show" style="width: 400px; max-height: 400px;">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100 d-flex justify-content-between">
                            <div>
                                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal" id="btn-quote-delete">Eliminar</button>
                            </div>
                            <div>
                                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-dark">Editar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
<script>
$(document).ready(function(){
    const quoteEdit = $('#quote-edit');
    const btnquoteDelete = $('#btn-quote-delete');

    if (quoteEdit.length) {
        quoteEdit.on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const quote = button.data('bs-quote');
            const id_quotes = button.data('bs-id_quotes');
            const description = button.data('bs-description');
            const photo_url = button.data('bs-photo_url');
            const price = button.data('bs-price');
            const id_categories = button.data('bs-id_categories');
            const active = button.data('bs-active');

            const modalInputquote = quoteEdit.find('.modal-body #quote');
            const modalInputIdquotes = quoteEdit.find('.modal-body #id_quotes');
            const modalInputDescription = quoteEdit.find('.modal-body #description');
            const modalInputPhoto = quoteEdit.find('.modal-body #photo_show');
            const modalInputPrice = quoteEdit.find('.modal-body #price');
            const modalInputIdCategories = quoteEdit.find('.modal-body #id_categories');
            const modalInputActive = quoteEdit.find('.modal-body #active');

            modalInputquote.val(quote);
            modalInputIdquotes.val(id_quotes);
            modalInputDescription.val(description);
            modalInputPhoto.attr('src', photo_url);
            modalInputPrice.val(price);
            modalInputIdCategories.val(id_categories);
            modalInputActive.val(active);

            btnquoteDelete.on('click', function() {
                if(confirm('Estas seguro de borrar')){
                    $('input[name="_method"]').val('DELETE');
                    $('#form-quote-edit-delete').submit();
                }else{
                    $('input[name="_method"]').val('PUT');
                }
            });

        });
    }



})
</script>
@endsection
