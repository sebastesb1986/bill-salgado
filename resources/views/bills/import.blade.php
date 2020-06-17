<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <div class="col-md-12 text-center">
            <h1>Importar facturas</h1>
            <div class="links  justify-content-between">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(Session::has('message'))
                {{ Session::get("message") }}
                @endif
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
                        <input type="submit" class="btn btn-success" value="Enviar" >
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>