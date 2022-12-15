@extends('funcionarios.layout')
@section('content')

<div class="card" style="margin:20px;">
    <div class="card-header">
        <h3>
            <strong>{{ $funcionarios->nomeCompleto }}</strong>
        </h3>
    </div> 
    <div class="card-body">
        <div class="card-body">
            <p class="card-text">CPF : {{ $funcionarios->cpf }}</p>
            <p class="card-text">Data de nascimento : {{ date( 'd/m/Y' , strtotime($funcionarios->dataNascimento)) }}</p>
            <p class="card-text">Portador de comorbidade : 
                <strong>
                    {{ 
                        ($funcionarios->portadorComorbidade == 1) ? 'SIM' : 'NÃO'
                    }}
                 </strong>
            </p>
            <p class="card-text">Vacina Aplicada : 
                <strong>
                    {{ 
                        ($funcionarios->vacinaAplicada == 1) ? 'SIM' : 'NÃO'
                    }}
                 </strong>
            </p>
            <p class="card-text">Vacina : {{ empty($vacinas->nome)? '-----' : $vacinas->nome }}</p>
            <p class="card-text">Data da <strong>primeira</strong> dose : 
                {{ 
                    ($funcionarios->dataPrimeiraDose == '') ? '--/--/----' : date( 'd/m/Y' , strtotime($funcionarios->dataPrimeiraDose))
                 }}
            </p>
            <p class="card-text">Data da <strong>segunda</strong> dose : 
                {{ 
                    ($funcionarios->dataSegundaDose == '') ? '--/--/----' : date( 'd/m/Y' , strtotime($funcionarios->dataTerceiraDose))
                 }}
            </p>
            <p class="card-text">Data da <strong>terceira</strong> dose : 
                {{ 
                    ($funcionarios->dataTerceiraDose == '') ? '--/--/----' : date( 'd/m/Y' , strtotime($funcionarios->dataTerceiraDose))
                 }}
            </p><br/>
        </div>
        <button onclick="window.location.href= '{{ url('/') }}'" class="btn btn-info" style="float: right;">Voltar</button>
    </div>
</div>
@stop