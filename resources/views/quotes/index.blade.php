
@extends('layouts.menu')

@section('content')

    <div class="text-center">
        <span class="h2" aria-current="page">Cotizaciones</span>
    </div>

    <div class="mt-3">
        @include('layouts.messages')
    </div>

    {{-- <div class="accordion">
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
    </div> --}}

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




                                        <td class="text-center">
                                            <a href="/quotes/downloadpdf?id_quotes={{$k->id_quotes}}" class="btn btn btn-outline-dark btn-sm">PDF</a>
                                            <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#quote-edit" data-bs-id_quotes="{{$k->id_quotes}}" data-bs-name="{{$k->name}}" data-bs-brute_price="{{$k->brute_price}}" data-bs-igv="{{$k->igv}}" data-bs-total_price="{{$k->total_price}}" data-bs-custom_price="{{$k->custom_price}}" data-bs-quote_status="{{$k->quote_status}}" data-bs-id_quotes_statuses="{{$k->id_quotes_statuses}}">Ver</button></td>
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

    <div class="modal fade" id="quote-edit" tabindex="-1" aria-labelledby="quote-edit-label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="quote-edit-label">Ver cotizacion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/quotes" method="POST" id="form-quote-edit-delete" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="id_quotes" name="id_quotes">

                        <div class="row">
                            <div class="col-md-4 ">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="name" readonly>
                                    <label for="name">Nombre del usuario</label>
                                </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="brute_price" name="brute_price" placeholder="brute_price" readonly>
                                    <label for="brute_price">Precio bruto</label>
                                </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="igv" name="igv" placeholder="igv"readonly>
                                    <label for="igv">IGV</label>
                                </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="total_price" name="total_price" placeholder="total_price" readonly>
                                    <label for="total_price">Precio total</label>
                                </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="custom_price" name="custom_price" placeholder="custom_price">
                                    <label for="custom_price">Precio ofertado</label>
                                </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="quote_status" name="quote_status" placeholder="quote_status" readonly>
                                    <label for="quote_status">Estado de cotizacion</label>
                                </div>
                            </div>

                            <div class="col-md-12 ">
                                <div class="table-responsive rounded-top" style="max-height: 550px">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Producto</th>
                                                <th scope="col">Cantidad</th>
                                                <th scope="col">Precio total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-nowrap" id="quote_products">
                                        </tbody>

                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100 d-flex justify-content-between">
                            <div>
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

    if (quoteEdit.length) {
        quoteEdit.on('show.bs.modal', function(event) {
            const button = $(event.relatedTarget);
            const id_quotes = button.data('bs-id_quotes');
            const name = button.data('bs-name');
            const brute_price = button.data('bs-brute_price');
            const igv = button.data('bs-igv');
            const total_price = button.data('bs-total_price');
            const custom_price = button.data('bs-custom_price');
            const quote_status = button.data('bs-quote_status');
            const id_quotes_statuses = button.data('bs-id_quotes_statuses');

            const modalInputIdquotes = quoteEdit.find('.modal-body #id_quotes');
            const modalInputName = quoteEdit.find('.modal-body #name');
            const modalInputBrutePrice = quoteEdit.find('.modal-body #brute_price');
            const modalInputIgv = quoteEdit.find('.modal-body #igv');
            const modalInputTotalPrice = quoteEdit.find('.modal-body #total_price');
            const modalInputCustomPrice = quoteEdit.find('.modal-body #custom_price');
            const modalInputQuoteStatus = quoteEdit.find('.modal-body #quote_status');

            modalInputIdquotes.val(id_quotes);
            modalInputName.val(name);
            modalInputBrutePrice.val(brute_price);
            modalInputIgv.val(igv);
            modalInputTotalPrice.val(total_price);
            modalInputCustomPrice.val(custom_price);
            modalInputQuoteStatus.val(quote_status);
            if(id_quotes_statuses == 3){
                modalInputCustomPrice.attr('readonly', true)
            }else{
                modalInputCustomPrice.attr('readonly', false)
            }
            viewQuotesProducts(id_quotes);
        });
    }

    function viewQuotesProducts(id_quotes) {
        const csrfToken = getCsrfToken();
        $.ajax({
            url: "/quotesProducts",
            type: "POST",
            data: {
                id_quotes: id_quotes,
                _token: csrfToken
            }, // Enviar los parámetros necesarios
            success: function(result) {
                result = JSON.parse(result)
                const data = result.data;
                console.log(data);
                data_html = '';
                data.map(item => {
                    data_html += `<tr><th scope="row">${item.id_quotes_products}</th><td>${item.product}</td><td>${item.quantity}</td><td>${item.total_price}</td></tr>`;
                })
                $('#quote_products').html(data_html);
            },
            error: function(xhr, status, error) {
            // Manejo de errores
            console.error("Error al añadir el producto al carrito:", error);
            }
        });
    }

    function getCsrfToken() {
    const hiddenInput = document.querySelector('input[name="_token"]');
    return hiddenInput ? hiddenInput.value : null;
    }

})
</script>
@endsection
