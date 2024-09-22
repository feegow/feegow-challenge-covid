@extends('template.admin')

@section('plugins.TempusDominusBs4', true)

@section('subtitle', 'Cadastro')
@section('content_header_title', 'Cadastro')
@section('content_header_subtitle', 'Vacina')

@section('content_body')

    <form action="{{ route('medicine.store') }}" method="POST">
        @csrf
        <div class="row">
            <x-adminlte-input name="name" value="{{ old('name') }}" label="Nome" placeholder="Nome da vacina"
                              fgroup-class="col-md-12"/>
        </div>
        <div class="row">
            <x-adminlte-input name="lot" value="{{ old('lot') }}" label="Lote" placeholder="Lote da vacina"
                              fgroup-class="col-md-12"/>
        </div>


        <div class="row">
            @php
                $config = [
                    'format' => 'DD/MM/YYYY'
                    ];
            @endphp
            <x-adminlte-input-date fgroup-class="col-md-12" name="expiration_date" value="{{ old('expiration_date') }}" :config="$config" placeholder="Escolha uma data..."
                                   label="Data de vencimento da vacina">
            </x-adminlte-input-date>
        </div>

        <div class="row">
            <x-adminlte-button fgroup-class="col-md-12" class="btn-flat" type="submit" label="Salvar" theme="success" icon="fas fa-lg fa-save"/>
        </div>
    </form>

    @if(session('error'))
        <br>
        <x-adminlte-alert theme="warning" title="Warning" dismissable>
            {{ session('error') }}
        </x-adminlte-alert>
    @endif

    @if($errors->any())
        <br>
        <x-adminlte-alert theme="danger" title="Erro" dismissable>
            @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </x-adminlte-alert>
    @endif
@stop