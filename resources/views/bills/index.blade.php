@extends('layout.principal')

@section('title', 'Lista de facturación')

@section('content')

<!-- Begin Page Content -->

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Lista de facturación</h1>
        
        <a href="{{ route('bill.create') }}"class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Ingresar factura
        </a>
        
    </div>

    @if ($message = Session::get('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {!! $message !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    @if ($message = Session::get('warning'))
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {!! $message !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Lista Facturas</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered text-center" id="bills-table" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Cedula</th>
                  <th>Teléfono</th>
                  <th>Email</th>
                  <th>Dirección</th>
                  <th>Ciudad</th>
                  <th>Tienda</th>
                  <th>Articulo</th>
                  <th>Cantidad</th>
                  <th>Precio</th>
                  <th>IVA(16%)</th>
                  <th>Valor total</th>
                  <th>Acción</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
    </div>

<!-- /.container-fluid -->      
@stop

@push('styles')
    <!-- Style Datatables -->
    <link href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
      /*.chemical{
        text-align: justify;
        text-justify: inter-word;
      } */
      .name, .id{
        font-weight: bold;
      }
    </style>
@endpush

@push('scripts')
    <!-- Datatables -->
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>
    
 
    <script>
        $(function() {
        $('#bills-table').DataTable({
                "language": {
                        "url": "/assets/js/spanish.json"
                },
                processing: false,
                responsive: true,
                serverSide: true,
                ajax: '',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
                    { data: 'name', name: 'name'},
                    { data: 'lastname', name: 'lastname'},
                    { data: 'document', name: 'document'},
                    { data: 'phone', name: 'phone'},
                    { data: 'email', name: 'email'},
                    { data: 'address', name: 'address'},
                    { data: 'city', name: 'city'},
                    { data: 'store', name: 'store'},
                    { data: 'article', name: 'article'},
                    { data: 'quantity', name: 'quantity'},
                    { data: 'price', name: 'price'},
                    { data: 'tax', name: 'tax'},
                    { data: 'total', name: 'total'},
                    { data: 'action', name: 'action'},
                    /* { data: 'action', name: 'action', orderable: false, searchable: false}, */
                ]
            });
        });

        // Refrescar datatable
        function Refresh()
        {
            let table = $('#bills-table').DataTable();
            table.ajax.reload();
        }

        // Restaurar factura
        function Restore(btn)
        {
            let route = 'bill/'+btn.value+'/restore';
            
            let conf  = confirm('¿Desea recuperar la factura seleccionada?');
            if(conf){
                $.ajax({
                    url: route,
                    type: 'GET',
                    dataType: 'json',
            
                })
                .then(response => {
                    Refresh();
                })
                .catch(error => {
                    // handle error
                    console.log(error);
                });
            }
        }

        // Eliminar factura
        function Delete(btn)
        {
          let route = 'bill/'+btn.value+'/delete';
          let note = confirm('¿Esta seguro que desea eliminar la factura seleccionada?');
          if(note){
            $.ajax({ 
              url: route, 
              type: 'DELETE', 
              dataType: 'json', 
              headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} 
            })
            .then(response => {
                Refresh();
            })
            .catch(error => {
                // handle error
                console.log(error);
            });
            
          }
        }
    </script>
@endpush