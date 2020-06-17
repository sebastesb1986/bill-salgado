@extends('layout.principal')

@section('content')

<!-- 404 Error Text -->
<div class="text-center">
        <div class="error mx-auto" data-text="404">404</div>
        <p class="lead text-gray-800 mb-5">Pagina no encontrada</p>
        <p class="text-gray-500 mb-0">Este contenido no esta disponible o no esta habilitado</p>
        <a href="{{ route('bill.index') }}" >&larr; Regresar al inicio</a>
      </div>
<!-- Page Content -->

@endsection