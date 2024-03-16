@extends('layouts.app')

@section('content')
    <h2>Relatórios de Colaboradores por Desempenho</h2>

    <div class="btn-group" role="group" aria-label="Relatórios">
        <a href="{{ route('export_employees_note.excel') }}" class="btn btn-success mx-2 rounded">Exportar para Excel</a>
    </div>

    <div id="reportContent"></div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.get('{{ route('get.top_performers') }}', function(data) {
                $('#reportContent').html(data);
            });
        });
    </script>
@endpush
