@extends('layouts.app')

@section('content')
    <h2>Performance de colaboradores</h2>
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

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#employee').change(function() {
                $('#employeeId').val($(this).val());
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

        $(document).ready(function(){
            $(".alert").delay(5000).slideUp(200, function() {
                $(this).alert('close');
            });
        });
    </script>
@endpush
