@extends('vacinas.layout')
@section('content')
    <div class="container">
        <div class="row" style="margin:20px;">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            <strong>Lista de vacinas</strong>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div>
                                <a href="{{url('/vacina/create')}}" class="btn btn-success btn-sm" title="Adicinar Vacina" style="float: right;">
                                    Adicinar vacina
                                </a>
                            </div>
                            <div style="padding: 0px 115px 0px 0px;">
                                <a href="{{url('/')}}" class="btn btn-warning btn-sm" title="Lista de Funcionarios" style="float: right;">
                                    Lista de Funcionários
                                </a>
                            </div>
                            <br/><hr/>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome</th>
                                        <th>Lote</th>
                                        <th>Validade</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($vacinas as $vacina)
                                    <tr>
                                        <td>{{ $vacina->id }}</td>
                                        <td>{{ $vacina->nome }}</td>
                                        <td>{{ $vacina->lote }}</td>
                                        <td>{{ date( 'd/m/Y' , strtotime($vacina->dataValidade)) }}</td>
                                        <td>
                                            <a href="{{ url('/vacina/' . $vacina->id) }}" title="Visualizar"><button class="btn btn-info btn-sm">Visualizar</button></a>
                                            <a href="{{ url('/vacina/' . $vacina->id . '/edit') }}" title="Editar"><button class="btn btn-primary btn-sm">Editar</button></a>
                                            <form method="POST" action="{{ url('/vacina' . '/' . $vacina->id) }}" accept-charset="UTF8" style="display:inline">
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