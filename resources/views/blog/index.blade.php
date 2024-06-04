
@extends('layouts.menu')

@section('content')

    <div class="text-center">
        <span class="h2" aria-current="page">Blog</span>
    </div>

    <div class="mt-3">
        @include('layouts.messages')
    </div>

    <div class="accordion">
        <div class="accordion-item">
          <h3 class="accordion-header">
            <button class="px-3 py-2 btn accordion-button bg-light text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#blog-actions" aria-expanded="true" aria-controls="blog-actions">
              Acciones
            </button>
          </h3>
          <div id="blog-actions" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="d-flex justify-content-between ">
                    <div>
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#blog-create">
                            Crear blog
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
            <button class="px-3 py-2 btn accordion-button bg-light text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#blog-search" aria-expanded="true" aria-controls="blog-search">
              Buscador
            </button>
          </h3>
          <div id="blog-search" class="accordion-collapse collapse {{(isset($search) && $search !== '' ? 'show' : '')}}" data-bs-parent="#accordionExample">
            <form action="/blog" method="GET">
                <div class="accordion-body">

                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="search" name="search" placeholder="search" value="{{$search}}">
                                <label for="search">Blog / Descripcion </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between ">
                        <div>
                            <button type="submit" class="btn btn-dark">Buscar</button>
                            <a href="/blog" class="btn btn-outline-dark ms-1">Reiniciar</a>
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
                    <button class="px-3 py-2 btn accordion-button bg-light text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#blog-result" aria-expanded="true" aria-controls="blog-result">
                    Resultado
                    </button>
                </h3>

                <div id="blog-result" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="table-responsive rounded-top">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Blog</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Descripcion</th>
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
                                        <th scope="row">{{$k->id_blog}}</th>
                                        <td>{{$k->blog}}</td>
                                        <td><img src="{{$k->photo_url}}" alt="Imagen{{$k->id_blog}}" style="width: 100px; max-height: 100px;"></td>
                                        <td>{{$k->description}}</td>
                                        <td>{{$k->name_created}}</td>
                                        <td>{{$k->name_modified}}</td>
                                        <td>{{$k->timestamp_created}}</td>
                                        <td>{{$k->timestamp_modified}}</td>
                                        <td class="text-center"><button type="submit" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#blog-edit" data-bs-id_blog="{{$k->id_blog}}"  data-bs-blog="{{$k->blog}}" data-bs-photo_url="{{$k->photo_url}}" data-bs-description="{{$k->description}}">Ver</button></td>
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

    <div class="modal fade" id="blog-create" tabindex="-1" aria-labelledby="blog-create-label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="blog-create-label">Crear vista de Blog</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/blog" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-6 ">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="blog" name="blog" placeholder="blog">
                                    <label for="blog">Nombre de blog</label>
                                </div>
                            </div>

                            <div class="col-md-6 ">
                                <div class="form-floating mb-3">
                                    <input type="file" class="form-control" id="photo" name="photo" placeholder="photo">
                                    <label for="photo">Foto</label>
                                </div>
                            </div>

                            <div class="col-md-12 ">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="description" name="description" style="height: 100px"></textarea>
                                    <label for="price">Descripcion del blog</label>
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

    <div class="modal fade" id="blog-edit" tabindex="-1" aria-labelledby="blog-edit-label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="blog-edit-label">Ver Blog</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/blog" method="POST" id="form-blog-edit-delete" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="id_blog" name="id_blog">

                        <div class="row">

                            <div class="col-md-6 ">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="blog" name="blog" placeholder="blog">
                                    <label for="blog">Nombre del blog</label>
                                </div>
                            </div>

                            <div class="col-md-6 ">
                                <div class="form-floating mb-3">
                                    <input type="file" class="form-control" id="photo" name="photo" placeholder="photo">
                                    <label for="photo">Foto</label>
                                </div>
                            </div>


                            <div class="col-md-12 ">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="description" name="description" style="height: 100px"></textarea>
                                    <label for="price">Descripcion del blog</label>
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
                                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal" id="btn-blog-delete">Eliminar</button>
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
    const blogEdit = $('#blog-edit');
    const btnBlogDelete = $('#btn-blog-delete');

    if (blogEdit.length) {
        blogEdit.on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const blog = button.data('bs-blog');
            const id_blog = button.data('bs-id_blog');
            const description = button.data('bs-description');
            const photo_url = button.data('bs-photo_url');
            const price = button.data('bs-price');
            const id_categories = button.data('bs-id_categories');
            const active = button.data('bs-active');

            const modalInputBlog = blogEdit.find('.modal-body #blog');
            const modalInputIdBlog = blogEdit.find('.modal-body #id_blog');
            const modalInputDescription = blogEdit.find('.modal-body #description');
            const modalInputPhoto = blogEdit.find('.modal-body #photo_show');
            const modalInputPrice = blogEdit.find('.modal-body #price');
            const modalInputIdCategories = blogEdit.find('.modal-body #id_categories');
            const modalInputActive = blogEdit.find('.modal-body #active');

            modalInputBlog.val(blog);
            modalInputIdBlog.val(id_blog);
            modalInputDescription.val(description);
            modalInputPhoto.attr('src', photo_url);
            modalInputPrice.val(price);
            modalInputIdCategories.val(id_categories);
            modalInputActive.val(active);

            btnBlogDelete.on('click', function() {
                if(confirm('Estas seguro de borrar')){
                    $('input[name="_method"]').val('DELETE');
                    $('#form-blog-edit-delete').submit();
                }else{
                    $('input[name="_method"]').val('PUT');
                }
            });

        });
    }



})
</script>
@endsection
