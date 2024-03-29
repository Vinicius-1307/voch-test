@extends('layouts.app')

@section('content')
    <h2>Cadastro de Colaboradores</h2>
    <form method="POST" action="{{ route('employee.create') }}">
        @csrf
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="form-group">
            <label for="name">Nome do Colaborador:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="cpf">CPF:</label>
            <input type="text" class="form-control" id="cpf" name="cpf" required>
        </div>
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="position">Cargo:</label>
            <select class="form-control" id="position" name="position" required>
                <option value="">Selecione o Cargo</option>
            </select>
            <input type="hidden" id="positionId" name="position_id">
        </div>
        <div class="form-group">
            <label for="unit">Unidade:</label>
            <select class="form-control" id="unit" name="unit" required>
                <option value="">Selecione a Unidade</option>
            </select>
            <input type="hidden" id="unitId" name="units_id">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#cpf').mask('000.000.000-00', {
                reverse: true
            });

            $('#unit').change(function() {
                $('#unitId').val($(this).val());
            });

            $('#position').change(function() {
                $('#positionId').val($(this).val());
            });
        });

        $(document).ready(function() {
            $.get('{{ route('get.positions') }}', function(data) {
                var options = '<option value="">Selecione o Cargo</option>';
                $.each(data, function(index, position) {
                    options += '<option value="' + position.id + '">' + position.position +
                        '</option>';
                });
                $('#position').html(options);
            });

            $.get('{{ route('get.units') }}', function(data) {
                var options = '<option value="">Selecione a Unidade</option>';
                $.each(data, function(index, unit) {
                    options += '<option value="' + unit.id + '">' + unit.fantasy_name +
                        '</option>';
                });
                $('#unit').html(options);
            });

            $(document).ready(function() {
            $(".alert").delay(5000).slideUp(200, function() {
                $(this).alert('close');
            });
        });
        });
    </script>
@endpush
