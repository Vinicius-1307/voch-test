@extends('layouts.app')

@section('content')
    <h2>Total de Colaboradores por Unidade</h2>

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
                    <td>{{ $unit->cnpj}}</td>
                    <td>{{ $unit->employees_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
