@extends('funcionarios.layout')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header"><strong>Adicionar funcionário(a)</strong></div>
    <div class="card-body">
        <form action="{{ url('/') }}" method="post">
            {!! csrf_field() !!}
            <label>Nome completo</label></br>
            <input type="text" name="nomeCompleto" id="nomeCompleto" class="form-control" value="{{old('nomeCompleto')}}">
            </br><label>CPF</label></br>
            <input class="form-control" type="text" name="cpf" id="cpf" value="{{old('cpf')}}" onkeypress="$(this).mask('000.000.000-00');" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Digite um CPF no formato: xxx.xxx.xxx-xx">
            </br><label>Data de nascimento</label></br>
            <input type="date" name="dataNascimento" id="dataNascimento" class="form-control" value="{{old('dataNascimento')}}"></br>
            <div class="form-check">
                <input class="form-check-input" name="portadorComorbidade" type="checkbox" id="portadorComorbidade" @if(old('portadorComorbidade') == 'on') checked @endif>
                <label class="form-check-label" for="portadorComorbidade">
                    Portador de comorbidade
                </label>
            </div>
            <hr>
            <label>Selecione uma vacina</label>
            <select class="form-select" name="vacinaAplicada_id" id="vacinaAplicada_id" aria-label="Selecino uma vacina">
                <option selected value="">Escolher vacina</option>
                @foreach($vacinas as $vacina)
                    <option @if(old('vacinaAplicada_id') == $vacina->id) selected @endif value="{{ $vacina->id }}">{{ $vacina->nome }}</option>
                @endforeach
            </select>
            </br><label>Data da primeiraDose</label></br>
            <input type="date" name="dataPrimeiraDose" id="dataPrimeiraDose" class="form-control" value="{{old('dataPrimeiraDose')}}">
            </br><label>Data da segunda Dose</label></br>
            <input type="date" name="dataSegundaDose" id="dataSegundaDose" class="form-control" value="{{old('dataSegundaDose')}}">
            </br><label>Data da terceira Dose</label></br>
            <input type="date" name="dataTerceiraDose" id="dataTerceiraDose" class="form-control" value="{{old('dataTerceiraDose')}}"></br>
            <div class="form-check">
                <input class="form-check-input" name="vacinaAplicada" type="checkbox" id="vacinaAplicada" @if(old('vacinaAplicada') == 'on') checked @endif>
                <label class="form-check-label" for="vacinaAplicada">
                    Vacina aplicada
                </label>
            </div></br>
            <input type="submit" value="salvar" class="btn btn-success">
            <input type="button" onclick="window.location.href= '{{ url('/') }}'" class="btn btn-danger" style="float: right;" value="Cancelar">
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