@extends('layouts.app')

@section('content')
    <h2>Relatórios de Colaboradores</h2>

    <div class="btn-group" role="group" aria-label="Relatórios">
        <a href="{{ route('export_all_employees.excel') }}" class="btn btn-success mx-2 rounded mb-2">Exportar para Excel</a>
    </div>

    <div id="reportContent"></div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.get('{{ route('get.all_employees') }}', function(data) {
                $('#reportContent').html(data);
            });
        });
    </script>
@endpush
