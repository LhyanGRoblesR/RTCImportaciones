
@extends('layouts.menu')

@section('content')

    <div class="text-center">
        <span class="h2" aria-current="page">Productos</span>
    </div>

    <div class="mt-3">
        @include('layouts.messages')
    </div>

    <div class="accordion">
        <div class="accordion-item">
          <h3 class="accordion-header">
            <button class="px-3 py-2 btn accordion-button bg-light text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#products-actions" aria-expanded="true" aria-controls="products-actions">
              Acciones
            </button>
          </h3>
          <div id="products-actions" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="d-flex justify-content-between ">
                    <div>
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#product-create">
                            Crear producto
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
            <button class="px-3 py-2 btn accordion-button bg-light text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#products-search" aria-expanded="true" aria-controls="products-search">
              Buscador
            </button>
          </h3>
          <div id="products-search" class="accordion-collapse collapse {{(isset($search) && $search !== '' ? 'show' : '')}}" data-bs-parent="#accordionExample">
            <form action="/products" method="GET">
                <div class="accordion-body">

                    <div class="row">
                        <div class="col-md-12 ">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="search" name="search" placeholder="search" value="{{$search}}">
                                <label for="search">Producto / Descripcion / Categoria </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between ">
                        <div>
                            <button type="submit" class="btn btn-dark">Buscar</button>
                            <a href="/products" class="btn btn-outline-dark ms-1">Reiniciar</a>
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
                    <button class="px-3 py-2 btn accordion-button bg-light text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#products-result" aria-expanded="true" aria-controls="products-result">
                    Resultado
                    </button>
                </h3>

                <div id="products-result" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="table-responsive rounded-top" style="max-height: 550px">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col">Activo</th>
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
                                        <th scope="row">{{$k->id_products}}</th>
                                        <td>{{$k->category}}</td>
                                        <td>{{$k->product}}</td>
                                        <td><img src="{{$k->photo_url}}" alt="Imagen{{$k->id_products}}" style="width: 100px; max-height: 100px;"></td>
                                        <td>{{$k->price}}</td>
                                        <td>{{$k->description}}</td>
                                        <td>{{$k->active}}</td>
                                        <td>{{$k->name_created}}</td>
                                        <td>{{$k->name_modified}}</td>
                                        <td>{{$k->timestamp_created}}</td>
                                        <td>{{$k->timestamp_modified}}</td>
                                        <td class="text-center"><button type="submit" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#product-edit" data-bs-id_products="{{$k->id_products}}" data-bs-id_categories="{{$k->id_categories}}" data-bs-product="{{$k->product}}" data-bs-photo_url="{{$k->photo_url}}" data-bs-price="{{$k->price}}" data-bs-description="{{$k->description}}" data-bs-active="{{$k->active}}">Ver</button></td>
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

    <div class="modal fade" id="product-create" tabindex="-1" aria-labelledby="product-create-label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="product-create-label">Crear producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/products" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-6 ">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="id_categories" name="id_categories">
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id_categories}}">{{$category->category}}</option>
                                        @endforeach
                                    </select>
                                    <label for="product">Categoria</label>

                                </div>
                            </div>

                            <div class="col-md-6 ">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="product" name="product" placeholder="product">
                                    <label for="product">Nombre de producto</label>
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
                                    <label for="price">Descripcion del producto</label>
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

    <div class="modal fade" id="product-edit" tabindex="-1" aria-labelledby="product-edit-label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="product-edit-label">Ver producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/products" method="POST" id="form-product-edit-delete" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="id_products" name="id_products">

                        <div class="row">
                            <div class="col-md-6 ">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="id_categories" name="id_categories">
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id_categories}}">{{$category->category}}</option>
                                        @endforeach
                                    </select>
                                    <label for="product">Categoria</label>

                                </div>
                            </div>

                            <div class="col-md-6 ">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="product" name="product" placeholder="product">
                                    <label for="product">Nombre de producto</label>
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
                                    <label for="price">Descripcion del producto</label>
                                </div>
                            </div>

                            <div class="col-md-12 ">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="active" name="active">
                                        <option value="0">No</option>
                                        <option value="1">Si</option>
                                    </select>
                                    <label for="product">Activo</label>

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
                                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal" id="btn-product-delete">Eliminar</button>
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
    const productEdit = $('#product-edit');
    const btnProductDelete = $('#btn-product-delete');

    if (productEdit.length) {
        productEdit.on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const product = button.data('bs-product');
            const id_products = button.data('bs-id_products');
            const description = button.data('bs-description');
            const photo_url = button.data('bs-photo_url');
            const price = button.data('bs-price');
            const id_categories = button.data('bs-id_categories');
            const active = button.data('bs-active');

            const modalInputProduct = productEdit.find('.modal-body #product');
            const modalInputIdProducts = productEdit.find('.modal-body #id_products');
            const modalInputDescription = productEdit.find('.modal-body #description');
            const modalInputPhoto = productEdit.find('.modal-body #photo_show');
            const modalInputPrice = productEdit.find('.modal-body #price');
            const modalInputIdCategories = productEdit.find('.modal-body #id_categories');
            const modalInputActive = productEdit.find('.modal-body #active');

            modalInputProduct.val(product);
            modalInputIdProducts.val(id_products);
            modalInputDescription.val(description);
            modalInputPhoto.attr('src', photo_url);
            modalInputPrice.val(price);
            modalInputIdCategories.val(id_categories);
            modalInputActive.val(active);

            btnProductDelete.on('click', function() {
                if(confirm('Estas seguro de borrar')){
                    $('input[name="_method"]').val('DELETE');
                    $('#form-product-edit-delete').submit();
                }else{
                    $('input[name="_method"]').val('PUT');
                }
            });

        });
    }



})
</script>
@endsection
