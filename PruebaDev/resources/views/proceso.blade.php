@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mx-0">
            <div class="col-12 text-center mx-auto">
                <h3>Continuar Proceso</h3>
            </div>
        </div>
        <step-process-component rfc={{ $rfc }}></step-process-component>
    </div>
@endsection