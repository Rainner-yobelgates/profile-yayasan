@extends('admin.layouts')
@section('title', 'Dashboard')
@section('content')
<section class="section">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-archive"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Orders</h4>
            </div>
            <div class="card-body">
              59
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-dollar-sign"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Balance</h4>
            </div>
            <div class="card-body">
              $187,13
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-shopping-bag"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Sales</h4>
            </div>
            <div class="card-body">
              4,732
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header">
            <h4>Pengunjung dalam beberapa bulan ini</h4>
          </div>
          <div class="card-body">
            <canvas id="myChart" height="158"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-hero">
          <div class="card-header">
            <div class="card-icon">
              <i class="far fa-question-circle"></i>
            </div>
            <h4>{{count($getMessage)}}</h4>
            <div class="card-description">Pesan baru yang masuk</div>
          </div>
          <div class="card-body p-0">
            <div class="tickets-list">
              @foreach ($getMessage as $message)
                <a href="{{route('admin.message.show', $message->id)}}" class="ticket-item">
                  <div class="ticket-title">
                    <h4>{!! $message->message !!}</h4>
                  </div>
                  <div class="ticket-info">
                    <div>{{ $message->name }}</div>
                    <div class="bullet"></div>
                    <div class="text-primary">{{ $message->email }}</div>
                  </div>
                </a>
              @endforeach
              <a href="{{route('admin.message')}}" class="ticket-item ticket-more">
                View All <i class="fas fa-chevron-right"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @stop
  @section('script')
        <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line', // Tipe chart yang ingin Anda gunakan
            data: {
                // Data untuk chart (contoh saja)
                labels: ['January', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'July', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [{
                    label: '# Pengunjung',
                    data: ['{{$visitor[1] ?? 0}}',
                     '{{$visitor[2] ?? 0}}',
                     '{{$visitor[3] ?? 0}}',
                     '{{$visitor[4] ?? 0}}',
                     '{{$visitor[5] ?? 0}}',
                     '{{$visitor[6] ?? 0}}',
                     '{{$visitor[7] ?? 0}}',
                     '{{$visitor[8] ?? 0}}',
                     '{{$visitor[9] ?? 0}}',
                     '{{$visitor[10] ?? 0}}',
                     '{{$visitor[11] ?? 0}}',
                     '{{$visitor[12] ?? 0}}',],
                    backgroundColor: [
                        '#6777ef',
                        '#6777ef',
                        '#6777ef',
                        '#6777ef',
                        '#6777ef',
                        '#6777ef'
                    ],
                    borderColor: [
                        '#6777ef',
                        '#6777ef',
                        '#6777ef',
                        '#6777ef',
                        '#6777ef',
                        '#6777ef)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                // Opsi tambahan untuk chart
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
  @endsection