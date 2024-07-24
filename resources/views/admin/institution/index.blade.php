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
                <a href="{{route('admin.institution.create')}}" class="btn btn-primary"><i class="fas fa-plus text-white"></i> Tambah</a>        
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-center w-100 table-hover" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Logo</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Urutan</th>
                                <th>Status</th>
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
                ajax: "{{ route('admin.institution.data') }}/",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', class:"align-middle"},
                    {data: 'logo', name: 'logo', class:"align-middle"},
                    {data: 'name', name: 'name', class:"align-middle"},
                    {data: 'description', name: 'description', class:"align-middle"},
                    {data: 'order', name: 'order', class:"align-middle"},
                    {data: 'status', name: 'status', class:"align-middle"},
                    {data: 'action', name: 'action', class:"align-middle"},
                ]
            }); 
        }
        datatable()
    </script>
@endsection