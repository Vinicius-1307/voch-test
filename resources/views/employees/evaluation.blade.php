@extends('layouts.app')

@section('content')
    <h2>Performance de colaboradores</h2>
    <!-- Formulário de cadastro para Colaboradores -->
    <form method="POST" action="{{ route('employee.update') }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="employee">Colaborador:</label>
            <select class="form-control" id="employee" name="employee" required>
                <option value="">Selecione o colaborador</option>
            </select>
            <input type="hidden" id="employeeId" name="employee_id">
        </div>
        <div class="form-group">
            <label for="performance_note">Avaliação de Desempenho (0-10):</label>
            <input type="number" class="form-control" id="performance_note" name="performance_note" min="0"
                max="10" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#employee').change(function() {
                $('#employeeId').val($(this).val());
                console.log('ID do funcionário:', $(this).val());
            });
        });
        $.get('{{ route('get.employee') }}', function(data) {
            var options = '';
            $.each(data, function(index, employee) {
                options += '<option value="' + employee.id + '">' + employee.name +
                    '</option>';
            });
            $('#employee').html(options);
        });
    </script>
@endpush
