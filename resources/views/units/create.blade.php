@extends('layouts.app')

@section('content')
<h2>Cadastro de Unidades</h2>
<form method="POST" action="{{ route('units.create') }}">
    @csrf
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
    $(document).ready(function () {
        $('#cnpj').mask('00.000.000/0000-00', {reverse: true});
    });
</script>
@endpush

