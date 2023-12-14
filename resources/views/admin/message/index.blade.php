@extends('admin.layouts')
@section('title', $title)
@section('content')
<section class="section">
    <div class="section-header">
      <h1>{{$title}}</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header d-flex justify-content-betweend-flex justify-content-between">
                <h4>{{$title}}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Pesan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>                
                    </table>
                </div>
            </div>
        </div>
    </div>
  </section>
@stop
@section('script')
    <script>
        function datatable() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.message.data') }}/",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', class:"align-middle"},
                    {data: 'name', name: 'name', class:"align-middle"},
                    {data: 'email', name: 'email', class:"align-middle"},
                    {data: 'message', name: 'message', class:"align-middle"},
                    {data: 'action', name: 'action', class:"align-middle"},
                ]
            }); 
        }
        datatable()
    </script>
@endsection