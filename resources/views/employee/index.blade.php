@extends('template.admin')

@section('DatatablesPlugins', true)
@section('Datatables', true)
@section('DatatablesPlugins', true)

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
        'order' => [[0, 'asc']],
        'columns' => [null, null, null, null, ['orderable' => false]],
    ];
    @endphp

    <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" striped hoverable with-buttons beautify>
        @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->cpfMasked }}</td>
                <td>{{ $employee->dob->format('d/m/Y') }}</td>
                <td>{{ $employee->doses->count() }}</td>
                <td>
                    <button class="btn btn-xs btn-primary" title="Editar" onclick="window.location='{{ route('employee.edit', base64_encode($employee->cpf)) }}'">
                        <i class="fas fa-lg fa-edit"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>

    {!! $employees->links('pagination::bootstrap-5') !!}

    @if(session('success'))
        <x-adminlte-alert theme="success" title="Sucesso" dismissable>
            {{ session('success') }}
        </x-adminlte-alert>
    @endif
@endsection

