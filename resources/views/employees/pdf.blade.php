<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>Email</th>
            <th>Unidade</th>
            <th>Cargo</th>
            <th>Nota de Desempenho</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employees as $employee)
        <tr>
            <td>{{ $employee['Nome'] }}</td>
            <td>{{ $employee['CPF'] }}</td>
            <td>{{ $employee['Email'] }}</td>
            <td>{{ $employee['Unidade'] }}</td>
            <td>{{ $employee['Cargo'] }}</td>
            <td>{{ $employee['Nota de Desempenho'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
