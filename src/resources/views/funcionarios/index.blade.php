@extends('funcionarios.layout')
@section('content')
    <div class="container">
        <div class="row" style="margin:20px;">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            <strong>Lista de Funcionarios</strong>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div>
                                <a href="{{url('/create')}}" class="btn btn-success btn-sm" title="Adicinar Funcionário" style="float: right;">
                                    Adicinar funcionário
                                </a>
                            </div>
                            <div style="padding: 0px 145px 0px 0px;">
                                <a href="{{url('/vacina')}}" class="btn btn-warning btn-sm" title="Lista de vacinas" style="float: right;">
                                    Lista de vacinas
                                </a>
                            </div>
                            <br/><hr/>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Comorbidade</th>
                                        <th>Nome completo</th>
                                        <th>CPF</th>
                                        <th>Data de nascimento</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($funcionarios as $fincionario)
                                    <tr>
                                        <td>{{ $fincionario->id }}</td>
                                        <td>{{ ($fincionario->portadorComorbidade == 1) ? 'Sim' : 'Não' }}</td>
                                        <td>{{ $fincionario->nomeCompleto }}</td>
                                        <td>{{ date( 'd/m/Y' , strtotime($fincionario->dataNascimento)) }}</td>
                                        <td>
                                            <a href="{{ url('/funcionario/' . $fincionario->id) }}" title="Visualizar"><button class="btn btn-info btn-sm">Visualizar</button></a>
                                            <a href="{{ url('/funcionario/' . $fincionario->id . '/edit') }}" title="Editar"><button class="btn btn-primary btn-sm">Editar</button></a>
                                            <form method="POST" action="{{ url('/funcionario/' . $fincionario->id) }}" accept-charset="UTF8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <a href="" title="Deletar" onclick="return confirm('Quer realmente deletar?')"><button class="btn btn-danger btn-sm">Deletar</button></a>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection