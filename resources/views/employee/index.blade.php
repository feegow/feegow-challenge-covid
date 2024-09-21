@extends('template.admin')

@section('Datatables', true)

@section('subtitle', 'Funcionários')
@section('content_header_title', 'Funcionários')
@section('content_header_subtitle', 'Lista')

@section('content_body')
    @php
    $heads = [
        'Nome',
        'CPF',
        'Data de nascimento',
        'Doses aplicadas',
        ['label' => 'Ações', 'no-export' => true, 'width' => 5],
    ];

    $config = [
        'order' => [[2, 'asc']],
        'columns' => [null, null, null, null, ['orderable' => false]],
    ];
    @endphp

    <x-adminlte-datatable id="table1" :heads="$heads" :config="$config">
        @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->cpfMasked }}</td>
                <td>{{ $employee->dob->format('d/m/Y') }}</td>
                <td>{{ $employee->doses->count() }}</td>
                <td></td>
            </tr>
        @endforeach
    </x-adminlte-datatable>

    @if(session('success'))
        <x-adminlte-alert theme="success" title="Sucesso" dismissable>
            {{ session('success') }}
        </x-adminlte-alert>
    @endif
@endsection

