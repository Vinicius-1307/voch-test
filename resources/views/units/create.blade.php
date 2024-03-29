@extends('layouts.app')

@section('content')
    <h2>Cadastro de Unidades</h2>
    <form method="POST" action="{{ route('units.create') }}">
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
            <label for="fantasy_name">Nome fantasia:</label>
            <input type="text" class="form-control" id="fantasy_name" name="fantasy_name" required>
        </div>
        <div class="form-group">
            <label for="company_name">Razão Social:</label>
            <input type="text" class="form-control" id="company_name" name="company_name" required>
        </div>
        <div class="form-group">
            <label for="cnpj">CNPJ:</label>
            <input type="text" class="form-control" id="cnpj" name="cnpj" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#cnpj').mask('00.000.000/0000-00', {
                reverse: true
            });
        });

        $(document).ready(function() {
            $(".alert").delay(5000).slideUp(200, function() {
                $(this).alert('close');
            });
        });
    </script>
@endpush
