@extends('template.admin')

@section('plugins.TempusDominusBs4', true)
@section('plugins.Select2', true)

@section('subtitle', 'Cadastro')
@section('content_header_title', 'Cadastro')
@section('content_header_subtitle', 'Funcionário')

@section('content_body')

    <form action="{{ route('employee.update', base64_encode($employee->cpf)) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <x-adminlte-input disabled name="cpf" value="{{ old('cpf', $employee->cpf) }}" label="CPF" placeholder="CPF do funcionário"
                              fgroup-class="col-md-12"/>
        </div>
        <div class="row">
            <x-adminlte-input name="name" value="{{ old('name', $employee->name) }}" label="Nome" placeholder="Nome do funcionário"
                              fgroup-class="col-md-12"/>
        </div>

        <div class="row">
            <label for="comorbidities" class="col-md-12">
                Portador de comorbidade? <br>
                <input type="radio" name="comorbidities" {{ old('comorbidities', $employee->comorbidities) ? 'checked' : '' }} value="true"> Sim
                <input type="radio" name="comorbidities" {{ !old('comorbidities', $employee->comorbidities) ? 'checked' : '' }} value="false"> Não
            </label>
        </div>

        <div class="row">
            @php
                $config = [
                    'format' => 'DD/MM/YYYY',
                    'maxDate' => "js:moment().endOf('day')"
                    ];
            @endphp
            <x-adminlte-input-date fgroup-class="col-md-12" name="dob" value="{{ old('dob', $employee->dob->format('d/m/Y')) }}" :config="$config" placeholder="Escolha uma data..."
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
                $isDisabledFirst = isset($doses['first']);
            @endphp
            <x-adminlte-input-date fgroup-class="col-md-4" :disabled="$isDisabledFirst"
               value="{{ old('first_dose_date', isset($doses['first']) ? $doses['first']->date_applyed->format('d/m/Y') : null) }}"
               name="first_dose_date" :config="$configDateDose" placeholder="Escolha uma data..."
               label="Data da primeira vacina">
            </x-adminlte-input-date>

            <x-adminlte-select2 name="first_dose_medicine_id"  label="Vacina" fgroup-class="col-md-4" :disabled="$isDisabledFirst">
                <option value="">Escolha uma vacina</option>
                @foreach($medicines as $medicine)
                    <option {{ old('first_dose_medicine_id', isset($doses['first']) ? $doses['first']->medicine_id : null) == $medicine->id ? 'selected' : '' }}
                            value="{{ $medicine->id }}">
                        {{ $medicine->name }} - lot.{{ $medicine->lot }} - val.{{ $medicine->expiration_date->format('d/m/Y') }}
                    </option>
                @endforeach
            </x-adminlte-select2>
        </div>

        {{--        segunda vacina--}}
        @php($isDisabledSecond = isset($doses['second']))
        <div class="row">
            <x-adminlte-input-date fgroup-class="col-md-4" :disabled="$isDisabledSecond"
               value="{{ old('second_dose_date', isset($doses['second']) ? $doses['second']->date_applyed->format('d/m/Y') : null) }}"
               name="second_dose_date" :config="$configDateDose" placeholder="Escolha uma data..."
               label="Data da segunda vacina">
            </x-adminlte-input-date>

            <x-adminlte-select2 name="second_dose_medicine_id" label="Vacina" fgroup-class="col-md-4" :disabled="$isDisabledSecond">
                <option value="">Escolha uma vacina</option>
                @foreach($medicines as $medicine)
                    <option {{ old('second_dose_medicine_id', isset($doses['second']) ? $doses['second']->medicine_id : null) == $medicine->id ? 'selected' : '' }}
                            value="{{ $medicine->id }}">
                        {{ $medicine->name }} - lot.{{ $medicine->lot }} - val.{{ $medicine->expiration_date->format('d/m/Y') }}</option>
                @endforeach
            </x-adminlte-select2>
        </div>

        {{--        terceira vacina--}}
        @php($isDisabledThird = isset($doses['third']))
        <div class="row">
            <x-adminlte-input-date fgroup-class="col-md-4" :disabled="$isDisabledThird"
               value="{{ old('third_dose_date', isset($doses['third']) ? $doses['third']->date_applyed->format('d/m/Y') : null) }}"
               name="third_dose_date" :config="$configDateDose" placeholder="Escolha uma data..."
               label="Data da terceira vacina">
            </x-adminlte-input-date>

            <x-adminlte-select2 name="third_dose_medicine_id" label="Vacina" fgroup-class="col-md-4" :disabled="$isDisabledThird">
                <option value="">Escolha uma vacina</option>
                @foreach($medicines as $medicine)
                    <option {{ old('third_dose_medicine_id', isset($doses['third']) ? $doses['third']->medicine_id : null) == $medicine->id ? 'selected' : '' }}
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
