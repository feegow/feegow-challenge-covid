@extends('vacinas.layout')
@section('content')
<div class="card" style="margin:20px;">
    <div class="card-header"><strong>Adicionar nova vacina</strong></div>
    <div class="card-body">
        <form action="{{ url('vacina') }}" method="post">
            {!! csrf_field() !!}
            <label>nome</label></br>
            <input type="text" name="nome" id="nome" class="form-control" value="{{old('nome')}}"></br>
            <label>lote</label></br>
            <input type="number" name="lote" id="lote" class="form-control" value="{{old('lote')}}"></br>
            <label>validade</label></br>
            <input type="date" name="dataValidade" id="dataValidade" class="form-control" value="{{old('dataValidade')}}"></br>
            <input type="submit" value="salvar" class="btn btn-success">
            <input type="button" onclick="window.location.href= '{{ url('/vacina') }}'" class="btn btn-danger" style="float: right;" value="Cancelar">
        </form>
        @if ($errors->any())
            <div class="max-width mt-3">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
</div>
@stop