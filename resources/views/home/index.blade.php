
@extends('layouts.menu')

@section('content')

    <div class="text-center">
        <span class="h2" aria-current="page">Dashboard - {{$month}}</span>
    </div>

    <div class="mt-3">
        @include('layouts.messages')
    </div>

    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between p-md-1">
                    <div class="d-flex flex-row">
                        <div class="align-self-center">
                        <i class="fas fa-pencil-alt text-info fa-3x me-4"></i>
                        </div>
                        <div>
                        <h4>Total de productos</h4>
                        <p class="mb-0">Productos activos</p>
                        </div>
                    </div>
                    <div class="align-self-center">
                        <h2 class="h1 mb-0">{{$total_products_active}}</h2>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between p-md-1">
                    <div class="d-flex flex-row">
                        <div class="align-self-center">
                        <i class="far fa-comment-alt text-warning fa-3x me-4"></i>
                        </div>
                        <div>
                        <h4>Total de categorias</h4>
                        <p class="mb-0">Todas las categorias</p>
                        </div>
                    </div>
                    <div class="align-self-center">
                        <h2 class="h1 mb-0">{{$total_categories}}</h2>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between p-md-1">
                    <div class="d-flex flex-row">
                        <div class="align-self-center">
                        <i class="far fa-comment-alt text-warning fa-3x me-4"></i>
                        </div>
                        <div>
                        <h4>Cotizaciones este mes</h4>
                        <p class="mb-0">{{$month}}</p>
                        </div>
                    </div>
                    <div class="align-self-center">
                        <h2 class="h1 mb-0">{{$total_quotes_month}}</h2>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div>
                <canvas id="chartBarProductsQuotes"></canvas>
            </div>
        </div>
        <div class="col-md-4">
            <div>
                <canvas id="chartDoughnutQuotesStatuses"></canvas>
            </div>
        </div>
        <div class="col-md-12">
            <div>
                <canvas id="chartLineQuotesDay" height="75"></canvas>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
<script>
    const ctxBar = document.getElementById('chartBarProductsQuotes');
    const ctxDoughnut = document.getElementById('chartDoughnutQuotesStatuses');
    const ctxLine = document.getElementById('chartLineQuotesDay');

    var products_top_products = <?php echo json_encode($products_top_products); ?>;
    var quantities_top_products = <?php echo json_encode($quantities_top_products); ?>;

    new Chart(ctxBar, {
      type: 'bar',
      data: {
        labels: products_top_products,
        datasets: [{
          label: 'Cantidad de cotizaciones por producto',
          data: quantities_top_products,
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    var quote_status = <?php echo json_encode($quote_status); ?>;
    var total_quotes_statuses = <?php echo json_encode($total_quotes_statuses); ?>;

    new Chart(ctxDoughnut, {
        type: 'doughnut',
        data: {
        labels: quote_status,
        datasets: [{
            label: 'Estado de las cotizaciones',
            data: total_quotes_statuses,
            backgroundColor: [
            'rgb(86, 255, 119)',
            'rgb(255, 205, 86)',
            'rgb(255, 99, 132)'
            ],
            hoverOffset: 4
        }]
        }
    })

    var quotes_day = <?php echo json_encode($quotes_day); ?>;
    var total_quotes_day = <?php echo json_encode($total_quotes_day); ?>;

    new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: quotes_day,
            datasets: [{
                label: 'Cotizaciones en los ultimos 15 dias',
                data: total_quotes_day,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        }
    })
  </script>
@endsection
