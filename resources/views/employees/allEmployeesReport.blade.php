@extends('layouts.app')

@section('content')
    <h2>Relatórios de Colaboradores</h2>

    <div class="btn-group" role="group" aria-label="Relatórios">
        <a href="{{ route('export_all_employees.excel') }}" class="btn btn-success mx-2 rounded mb-2">Exportar para Excel</a>
    </div>

    <div id="reportContent">
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Email</th>
                    <th>Unidade</th>
                    <th>Cargo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee['Nome'] }}</td>
                        <td>{{ $employee['CPF'] }}</td>
                        <td>{{ $employee['Email'] }}</td>
                        <td>{{ $employee['Unidade'] }}</td>
                        <td>{{ $employee['Cargo'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div id="pagination">
            {{ $employees->links() }}
        </div>
    </div>
@endsection
