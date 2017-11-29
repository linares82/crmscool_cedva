@extends('plantillas.admin_login')


@section('content')

    <div class="error-page">
        <h2 class="headline text-red">23000</h2>
        <div class="error-content">
            <h3><i class="fa fa-warning text-red">
                </i> El nombre de cliente ya existe por favor vuelva a intentar</h3>
            <p>
                Estamos trabajando en ello
                Mientras tanto <a href='{{ url('/home') }}'>Regresar al tablero principal</a> 
            </p>
           
        </div>
    </div><!-- /.error-page -->
@endsection
