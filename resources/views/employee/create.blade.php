@extends('template.admin')

@section('plugins.TempusDominusBs4', true)
@section('plugins.Select2', true)

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
            <label for="comorbidities" class="col-md-12">
                Portador de comorbidade? <br>
                <input type="radio" name="comorbidities" {{ old('comorbidities') ? 'checked' : '' }} value="true"> Sim
                <input type="radio" name="comorbidities" {{ !old('comorbidities') ? 'checked' : '' }} value="false"> Não
            </label>
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
            <x-adminlte-input-date fgroup-class="col-md-4" value="{{ old('first_dose_date') }}" name="first_dose_date" :config="$configDateDose" placeholder="Escolha uma data..."
                                   label="Data da primeira vacina">
            </x-adminlte-input-date>

            <x-adminlte-select2 name="first_dose_medicine_id"  label="Vacina" fgroup-class="col-md-4">
                <option value="">Escolha uma vacina</option>
                @foreach($medicines as $medicine)
                    <option {{ old('first_dose_medicine_id') == $medicine->id ? 'selected' : '' }}
                            value="{{ $medicine->id }}">
                        {{ $medicine->name }} - lot.{{ $medicine->lot }} - val.{{ $medicine->expiration_date->format('d/m/Y') }}
                    </option>
                @endforeach
            </x-adminlte-select2>
        </div>

        {{--        segunda vacina--}}
        <div class="row">
            <x-adminlte-input-date fgroup-class="col-md-4" value="{{ old('second_dose_date') }}" name="second_dose_date" :config="$configDateDose" placeholder="Escolha uma data..."
                                   label="Data da segunda vacina">
            </x-adminlte-input-date>

            <x-adminlte-select2 name="second_dose_medicine_id" label="Vacina" fgroup-class="col-md-4">
                <option value="">Escolha uma vacina</option>
                @foreach($medicines as $medicine)
                    <option {{ old('second_dose_medicine_id') == $medicine->id ? 'selected' : '' }}
                            value="{{ $medicine->id }}">
                        {{ $medicine->name }} - lot.{{ $medicine->lot }} - val.{{ $medicine->expiration_date->format('d/m/Y') }}</option>
                @endforeach
            </x-adminlte-select2>
        </div>

        {{--        terceira vacina--}}
        <div class="row">
            <x-adminlte-input-date fgroup-class="col-md-4" value="{{ old('third_dose_date') }}" name="third_dose_date" :config="$configDateDose" placeholder="Escolha uma data..."
                                   label="Data da terceira vacina">
            </x-adminlte-input-date>

            <x-adminlte-select2 name="third_dose_medicine_id" label="Vacina" fgroup-class="col-md-4">
                <option value="">Escolha uma vacina</option>
                @foreach($medicines as $medicine)
                    <option {{ old('third_dose_medicine_id') == $medicine->id ? 'selected' : '' }}
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

    @if(session('error'))
        <br>
        <x-adminlte-alert theme="warning" title="Warning">
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
