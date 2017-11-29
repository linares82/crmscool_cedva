@extends('plantillas.admin_login')


@section('content')

    <div class="error-page">
        <h2 class="headline text-red">503</h2>
        <div class="error-content">
            <h3><i class="fa fa-warning text-red">
                </i> Oops! Se presento un problema</h3>
            <p>
                Estamos trabajando en ello
                Mientras tanto <a href='{{ url('/home') }}'>Regresar al tablero principal</a> 
            </p>
           
        </div>
    </div><!-- /.error-page -->
@endsection
