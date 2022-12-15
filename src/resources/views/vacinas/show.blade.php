@extends('vacinas.layout')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header">
        <h3>
            <strong>{{ $vacinas->nome }}</strong>
        </h3>
    </div> 
    <div class="card-body">
        <div class="card-body">
            <p class="card-text">Lote : {{ $vacinas->lote }}</p>
            <p class="card-text">Validade : {{ date( 'd/m/Y' , strtotime($vacinas->dataValidade)) }}</p><br/>
        </div>
        <button onclick="window.location.href= '{{ url('/vacina') }}'" class="btn btn-info" style="float: right;">Voltar</button>
    </div>
</div>
@stop