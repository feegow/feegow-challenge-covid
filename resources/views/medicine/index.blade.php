@extends('template.admin')

@section('Datatables', true)

@section('subtitle', 'Vácinas')
@section('content_header_title', 'Vácinas')
@section('content_header_subtitle', 'Lista')

@section('content_body')
    @php
        $heads = [
            '#',
            'Nome',
            'Lote',
            'Data de vencimento',
        ];

        $config = [
            'order' => [[1, 'asc']],
        ];
    @endphp

    <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" striped hoverable with-buttons beautify>
        @foreach($medicines as $medicine)
            <tr>
                <td>{{ $medicine->id }}</td>
                <td>{{ $medicine->name }}</td>
                <td>{{ $medicine->lot }}</td>
                <td>{{ $medicine->expiration_date->format('d/m/Y') }}</td>
                <td></td>
            </tr>
        @endforeach
    </x-adminlte-datatable>
@endsection

