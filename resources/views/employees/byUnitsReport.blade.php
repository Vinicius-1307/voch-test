@extends('layouts.app')

@section('content')
    <h2>Relatórios de Unidades</h2>

    <div class="btn-group" role="group" aria-label="Relatórios">
        <a href="{{ route('export_by_units.excel') }}" class="btn btn-success mx-2 rounded">Exportar para Excel</a>
    </div>

    <div id="reportContent"></div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.get('{{ route('get.by_units') }}', function(data) {
                $('#reportContent').html(data);
            });
        });
    </script>
@endpush
