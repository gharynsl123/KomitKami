@section('content')
<div class="row mt-4">
    <div class="col-lg-12 mt-4 mb-4">
        <div class="card z-index-2 ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                    <div class="chart">
                        <canvas id="chart-bars" class="chart-canvas" height="180"></canvas>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h6 class="mb-0 ">Pembelian Product</h6>
                <div class="d-flex justify-content-between">
                    <div class="w-50">
                        <div class="row">
                            <div class="col-md-6 ">
                                <select id="timeRange" class="form-select border-0">
                                    @foreach($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <a href="{{url('preview-data/charts')}}" class="btn btn-primary">
                        Preview
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <div class="card p-3">
            <div class="mb-2 row ps-3">
                <div class="col-6 d-flex align-items-center">
                    <div>
                        <h6 class="mb-1">Riwayat Pembelian</h6>
                        <p class="text-sm">{{ Auth::user()->name}}</p>
                    </div>
                </div>
                <div class="col-6 text-end">
                    <div class="input-group">
                        <input type="date" id="yearFilter" class="form-control icon-none m-0 p-0">
                        <button id="filterButton" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="orderTable" class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pemesanan
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total
                                Harga
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">action
                            </th>
                        </tr>
                    </thead>
                    <!-- Table Body -->
                    <tbody>
                        @foreach($groupedOrders->whereNotIn('status', ['reject']) as $items)
                        <tr>
                            <!-- Order Information -->
                            <td class="d-none">
                                <h6 class="mb-0 text-xs">{{$items->invoice->created_at->format('Y-m-d')}}</h6>
                            </td>
                            <td>
                                <div class="d-flex px-2">
                                    <div>
                                        <span class="material-icons">payment</span>
                                    </div>
                                    <div class="my-auto">
                                        <h6 class="mb-0 text-xs">{{$items->invoice->nomor_invoice}}</h6>
                                    </div>
                                </div>
                            </td>
                            <!-- Total Harga -->
                            <td>
                                <p class="text-xs text-dark font-weight-bold mb-0">{{$items->invoice->total_harga}}</p>
                            </td>
                            <!-- Status -->
                            <td>
                                <span class="badge badge-dot me-4">
                                    <span class="text-dark text-xs">{{$items->invoice->status}}</span>
                                </span>
                            </td>
                            <!-- Action -->
                            <td class="align-middle">
                                <div>
                                    <a href="{{ url('/order-details/' . $items->invoice->slug) }}"
                                        class="text-decoration-none">
                                        <span class="me-2 text-xs text-dark mb-0">view</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('chart-bars').getContext('2d');

    const labels = {!! json_encode($months) !!};
    let datasets = {!! json_encode($monthlyPurchases) !!};

    const allProducts = Array.from(new Set(Object.keys(datasets).flatMap(month => Object.keys(datasets[month]))));

    let chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: allProducts.map(productName => ({
                label: productName,
                data: labels.map(month => datasets[month][productName] ? datasets[month][productName] : 0),
                backgroundColor: getRandomColor(),
                borderRadius: 5,
                barPercentage: 0.8,
                categoryPercentage: 0.9,
            })),
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            onClick: function(event, elements) {
                const pointer = this.getElementsAtEventForMode(event, 'nearest', { intersect: true }, false);
                if (pointer.length > 0) {
                    const firstPoint = pointer[0];
                    const datasetIndex = firstPoint.datasetIndex;
                    const index = firstPoint.index;
                    const dataset = this.data.datasets[datasetIndex];
                    if (dataset) {
                        const month = this.data.labels[index];
                        const product = dataset.label;
                        window.location.href = '/detail-charts?month=' + encodeURIComponent(month) + '&product=' + encodeURIComponent(product);
                    }
                }
            },
            plugins: {
                tooltip: {
                    mode: 'nearest',
                    callbacks: {
                        label: function(context) {
                            var label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += context.parsed.y;
                            return label;
                        }
                    }
                },
                legend: {
                    display: false,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 500,
                        color: 'white',
                    },
                    grid: {
                        drawOnChartArea: true,
                        drawTicks: false,
                        drawBorder: false,
                        borderDash: [5, 5],
                        color: 'rgba(255, 255, 255, .5)'
                    }
                },
                x: {
                    ticks: {
                        color: 'white',
                        font: {
                            weight: 'bold',
                        }
                    },
                    grid: {
                        drawOnChartArea: true,
                        drawTicks: false,
                        drawBorder: false,
                        borderDash: [5, 5],
                        color: 'rgba(255, 255, 255, .5)'
                    }
                }
            }
        }
    });

    document.getElementById('timeRange').addEventListener('change', function() {
        const selectedYear = this.value;
        fetch(`/fetch-purchases-by-year?year=${selectedYear}`)
            .then(response => response.json())
            .then(data => {
                datasets = data;
                updateChart();
            })
            .catch(error => console.error('Error:', error));
    });

    function updateChart() {
        const newAllProducts = Array.from(new Set(Object.keys(datasets).flatMap(month => Object.keys(datasets[month]))));

        chart.data.datasets = newAllProducts.map(productName => ({
            label: productName,
            data: labels.map(month => datasets[month][productName] ? datasets[month][productName] : 0),
            backgroundColor: getRandomColor(),
            borderRadius: 5,
            barPercentage: 0.8,
            categoryPercentage: 0.9,
        }));

        chart.update();
    }

    // Fungsi untuk menghasilkan warna acak
    function getRandomColor() {
        const minBrightness = 150;
        let color = 'rgb(';
        for (let i = 0; i < 3; i++) {
            color += Math.floor(Math.random() * (255 - minBrightness) + minBrightness);
            color += ',';
        }
        color = color.slice(0, -1) + ')';
        return color;
    }
});
</script>
@endsection