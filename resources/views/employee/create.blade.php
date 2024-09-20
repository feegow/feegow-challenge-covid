@extends('template.admin')

@section('plugins.TempusDominusBs4', true)
@section('plugins.Select2', true)
@section('plugins.BootstrapSwitch', true)

@section('subtitle', 'Cadastro')
@section('content_header_title', 'Cadastro')
@section('content_header_subtitle', 'Funcionário')

@section('content_body')

    <form action="{{ route('employee.store') }}" method="POST">
        @csrf
        <div class="row">
            <x-adminlte-input name="cpf" value="{{ old('cpf') }}" label="CPF" placeholder="CPF do funcionário"
                              fgroup-class="col-md-12"/>
        </div>
        <div class="row">
            <x-adminlte-input name="name" value="{{ old('name') }}" label="Nome" placeholder="Nome do funcionário"
                              fgroup-class="col-md-12"/>
        </div>

        <div class="row">
            <x-adminlte-input-switch fgroup-class="col-md-12"
                                     name="comorbidities"
                                     label="Portador de comorbidade?"
                                     data-on-text="Sim"
                                     data-off-text="Não"
                                     data-on-color="teal"
            />
        </div>

        <div class="row">
            @php
                $config = [
                    'format' => 'DD/MM/YYYY',
                    'maxDate' => "js:moment().endOf('day')"
                    ];
            @endphp
            <x-adminlte-input-date fgroup-class="col-md-12" name="dob" value="{{ old('dob') }}" :config="$config" placeholder="Escolha uma data..."
                                   label="Data de nascimento">
                <x-slot name="appendSlot">
                    <x-adminlte-button theme="outline-primary" icon="fas fa-lg fa-birthday-cake"
                                       title="Data de nascimento"/>
                </x-slot>
            </x-adminlte-input-date>
        </div>

        {{--Primeira vacina--}}
        <div class="row">
            @php
                $configDateDose = [
                    'format' => 'DD/MM/YYYY',
                    'maxDate' => "js:moment().endOf('day')",
                    ];
            @endphp
            <x-adminlte-input-date fgroup-class="col-md-4" value="{{ old('firstDose_date') }}" name="firstDose_date" :config="$configDateDose" placeholder="Escolha uma data..."
                                   label="Data da primeira vacina">
            </x-adminlte-input-date>

            <x-adminlte-select2 name="firstDose_medicine_id"  label="Vacina" fgroup-class="col-md-4">
                <option value="">Escolha uma vacina</option>
                @foreach($medicines as $medicine)
                    <option {{ old('firstDose_medicine_id') == $medicine->id ? 'selected' : '' }}
                            value="{{ $medicine->id }}">
                        {{ $medicine->name }} - lot.{{ $medicine->lot }} - val.{{ $medicine->expiration_date->format('d/m/Y') }}
                    </option>
                @endforeach
            </x-adminlte-select2>
        </div>

        {{--        segunda vacina--}}
        <div class="row">
            <x-adminlte-input-date fgroup-class="col-md-4" name="secondDose_date" :config="$configDateDose" placeholder="Escolha uma data..."
                                   label="Data da segunda vacina">
            </x-adminlte-input-date>

            <x-adminlte-select2 name="secondDose_medicine_id" label="Vacina" fgroup-class="col-md-4">
                <option value="">Escolha uma vacina</option>
                @foreach($medicines as $medicine)
                    <option {{ old('secondDose_medicine_id') == $medicine->id ? 'selected' : '' }}
                            value="{{ $medicine->id }}">
                        {{ $medicine->name }} - lot.{{ $medicine->lot }} - val.{{ $medicine->expiration_date->format('d/m/Y') }}</option>
                @endforeach
            </x-adminlte-select2>
        </div>

        {{--        terceira vacina--}}
        <div class="row">
            <x-adminlte-input-date fgroup-class="col-md-4" value="{{ old('thirdDose_date') }}" name="thirdDose_date" :config="$configDateDose" placeholder="Escolha uma data..."
                                   label="Data da terceira vacina">
            </x-adminlte-input-date>

            <x-adminlte-select2 name="thirdDose_medicine_id" label="Vacina" fgroup-class="col-md-4">
                <option value="">Escolha uma vacina</option>
                @foreach($medicines as $medicine)
                    <option {{ old('thirdDose_medicine_id') == $medicine->id ? 'selected' : '' }}
                            value="{{ $medicine->id }}">
                        {{ $medicine->name }} - lot.{{ $medicine->lot }} - val.{{ $medicine->expiration_date->format('d/m/Y') }}
                    </option>
                @endforeach
            </x-adminlte-select2>
        </div>

        <div class="row">
            <x-adminlte-button fgroup-class="col-md-12" class="btn-flat" type="submit" label="Salvar" theme="success" icon="fas fa-lg fa-save"/>
        </div>
    </form>
@stop
