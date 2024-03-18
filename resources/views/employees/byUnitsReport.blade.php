@extends('layouts.app')

@section('content')
    <h2>Relatórios de Unidades</h2>

    <div class="btn-group" role="group" aria-label="Relatórios">
        <a href="{{ route('export_by_units.excel') }}" class="btn btn-success mx-2 rounded mb-2">Exportar para Excel</a>
    </div>

    <div id="reportContent">
        <table class="table">
            <thead>
                <tr>
                    <th>Nome Fantasia</th>
                    <th>Razão Social</th>
                    <th>CNPJ</th>
                    <th>Quantidade de Colaboradores</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($units as $unit)
                    <tr>
                        <td>{{ $unit->fantasy_name }}</td>
                        <td>{{ $unit->company_name }}</td>
                        <td>{{ $unit->cnpj }}</td>
                        <td>{{ $unit->employees_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div id="pagination">
            {{ $units->links() }}
        </div>
    </div>
@endsection
