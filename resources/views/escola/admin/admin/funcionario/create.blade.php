@extends('escola.admin.admin.layouts.layout')

@section('conteudo')
<div class="container">
    <h2>Cadastrar Funcionário</h2>

    @if(session('errors'))
<div class="alert alert-danger">{{ session('errors') }}</div>
@endif

    <form action="{{ route('admin.funcionarios.store') }}" method="POST">
        @csrf

        @include('escola.admin.includes.funcionarios_form', ['submit' => 'Salvar'])

    </form>
</div>

<script>
    const salarioPorCargo = {
        'Professor': 4000,
        'Coordenador': 5500,
        'Diretor': 7000
    };

    document.getElementById('cargo').addEventListener('change', function () {
        const cargo = this.value;
        if (salarioPorCargo[cargo]) {
            document.getElementById('salario_base').value = salarioPorCargo[cargo];
        }
    });
</script>

@endsection
