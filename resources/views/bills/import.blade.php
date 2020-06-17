@extends('layout.principal')

@section('title', 'Importar Factura(s)')

@section('content')

<!-- Begin Page Content -->

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Facturación</h1>
        
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

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

    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Lista Facturas</h6>
        </div>
        <div class="card-body">
            
            <form method="POST" action="{{route('import')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="input-group">
                    <label class="input-group-btn">
                        <span class="btn btn-primary">
                            Browse&hellip; <input type="file" name="excel[]" id="excel" multiple>
                        </span>
                    </label>
                </div>
            
                <div class="input-group">
                    <input type="submit" class="btn btn-success" value="Sincronizar" >
                </div>
            </form>
        </div>
    </div>

<!-- /.container-fluid -->      
@stop