@extends('plantillas.admin_template')

@section('content')

    <div class="error-page">
        <h2 class="headline text-yellow"> 403</h2>
        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! Página no encontrada.</h3>
            <p>
                Página no Encontrada
                Mientras tanto <a href='{{ url('/home') }}'>Regresar al tablero principal </a> 
            </p>
            
        </div><!-- /.error-content -->
    </div><!-- /.error-page -->
@endsection