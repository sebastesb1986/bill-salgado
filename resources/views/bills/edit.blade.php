@extends('layout.principal')

@section('title', 'Modificar Factura(s)')

@section('content')

<!-- Begin Page Content -->

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Facturación</h1>
        
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Modificar Factura</h6>
        </div>
        <div class="card-body">
            
        <form method="POST" action="{{ route('bill.update', $bills) }}" autocomplete="off">
            @csrf @method('PUT')

            <div class="form-group mb-2">
                <label for="name">Nombre(s)</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nombre(s)" value="{{ old('name', $bills->name) }}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-2">
                <label for="lastname">Apellido(s)</label>
                <input type="text" name="lastname" id="lastname" class="form-control @error('lastname') is-invalid @enderror" placeholder="Apellido(s)" value="{{ old('lastname', $bills->lastname) }}">
                @error('lastname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-2">
                <label for="document">Cedula</label>
                <input type="text" name="document" id="document" class="form-control @error('document') is-invalid @enderror" placeholder="Cedula" value="{{ old('document', $bills->document) }}">
                @error('document')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-2">
                <label for="phone">Teléfono</label>
                <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Teléfono" value="{{ old('phone', $bills->phone) }}">
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-2">
                <label for="email">Correo electrónico</label>
                <input type="email" rows="6" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Correo electrónico" value="{{ old('email', $bills->email) }}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-2">
                <label for="address">Dirección</label>
                <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Dirección" value="{{ old('address', $bills->address) }}">
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-2">
                <label for="city">Ciudad</label>
                <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" placeholder="Ciudad" value="{{ old('city', $bills->city) }}">
                @error('city')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-2">
                <label for="store">Tienda</label>
                <input type="text" name="store" id="store" class="form-control @error('store') is-invalid @enderror" placeholder="Tienda" value="{{ old('store', $bills->store) }}">
                @error('store')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-2">
                <label for="article">Articulo</label>
                <input type="text" name="article" id="article" class="form-control @error('article') is-invalid @enderror" placeholder="Articulo" value="{{ old('article', $bills->article) }}">
                @error('article')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-2">
                <label for="quantity">Cantidad</label>
                <input type="text" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" placeholder="Cantidad" value="{{ old('quantity', $bills->quantity) }}">
                @error('quantity')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-2">
                <label for="price">Precio</label>
                <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="Precio" value="{{ old('price', $bills->price) }}">
                @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-2">
                <label for="tax">Impuesto</label>
                <input type="text" name="tax" id="tax" class="form-control @error('tax') is-invalid @enderror" placeholder="IVA" value="{{ old('tax', $bills->tax) }}">
                @error('tax')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button id="register" class="btn btn-block btn-success">Ingresar</button>
                
        </form>


        </div>
    </div>

<!-- /.container-fluid -->      
@stop