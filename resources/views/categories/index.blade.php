
@extends('layouts.menu')

@section('content')

    <div class="text-center">
        <span class="h2" aria-current="page">Categorias</span>
    </div>

    <div class="mt-3">
        @include('layouts.messages')
    </div>

    <div class="accordion">
        <div class="accordion-item">
          <h3 class="accordion-header">
            <button class="px-3 py-2 btn accordion-button bg-light text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#categories-actions" aria-expanded="true" aria-controls="categories-actions">
              Acciones
            </button>
          </h3>
          <div id="categories-actions" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="d-flex justify-content-between ">
                    <div>
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#category-create">
                            Crear categoria
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
            <button class="px-3 py-2 btn accordion-button bg-light text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#categories-search" aria-expanded="true" aria-controls="categories-search">
              Buscador
            </button>
          </h3>
          <div id="categories-search" class="accordion-collapse collapse {{(isset($category) && $category !== '' ? 'show' : '')}}" data-bs-parent="#accordionExample">
            <form action="/categories" method="GET">
                <div class="accordion-body">

                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="category" name="category" placeholder="category" value="{{$category}}">
                                <label for="category">Nombre de categoria</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between ">
                        <div>
                            <button type="submit" class="btn btn-dark">Buscar</button>
                            <a href="/categories" class="btn btn-outline-dark ms-1">Reiniciar</a>
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
                    <button class="px-3 py-2 btn accordion-button bg-light text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#categories-result" aria-expanded="true" aria-controls="categories-result">
                    Resultado
                    </button>
                </h3>

                <div id="categories-result" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="table-responsive rounded-top" style="max-height: 550px">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Categoria</th>
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
                                        <th scope="row">{{$k->id_categories}}</th>
                                        <td>{{$k->category}}</td>
                                        <td>{{$k->name_created}}</td>
                                        <td>{{$k->name_modified}}</td>
                                        <td>{{$k->timestamp_created}}</td>
                                        <td>{{$k->timestamp_modified}}</td>
                                        <td class="text-center"><button type="submit" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#category-edit" data-bs-category="{{$k->category}}" data-bs-id_categories="{{$k->id_categories}}">Ver</button></td>
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

    <div class="modal fade" id="category-create" tabindex="-1" aria-labelledby="category-create-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="category-create-label">Crear categoria</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/categories" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="category" name="category" placeholder="category">
                                    <label for="category">Nombre de categoria</label>
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

    <div class="modal fade" id="category-edit" tabindex="-1" aria-labelledby="category-edit-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="category-edit-label">Ver categoria</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/categories" method="POST" id="form-category-edit-delete">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="id_categories" name="id_categories">

                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="category" name="category" placeholder="category">
                                    <label for="category">Nombre de categoria</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100 d-flex justify-content-between">
                            <div>
                                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal" id="btn-category-delete">Eliminar</button>
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
    const categoryEdit = $('#category-edit');
    const btnCategoryDelete = $('#btn-category-delete');

    if (categoryEdit.length) {
        categoryEdit.on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const category = button.data('bs-category');
            const id_categories = button.data('bs-id_categories');

            const modalInputCategory = categoryEdit.find('.modal-body #category');
            const modalInputIdCategories = categoryEdit.find('.modal-body #id_categories');

            modalInputCategory.val(category);
            modalInputIdCategories.val(id_categories);

            btnCategoryDelete.on('click', function() {
                if(confirm('Estas seguro de borrar')){
                    $('input[name="_method"]').val('DELETE');
                    $('#form-category-edit-delete').submit();
                }else{
                    $('input[name="_method"]').val('PUT');
                    }
            });

        });
    }



})
</script>
@endsection
