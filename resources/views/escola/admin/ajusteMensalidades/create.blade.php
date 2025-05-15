@extends('escola.admin.admin.layouts.layout')
@section('conteudo')
    
<div class="container">
    @if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<!-- Alert de erro-->
@if ($errors->any())
<div class="alert alert-danger">
 Não Foi Possivel Realizar Essa Operação :
 <ul class="mt-2 mb-0">
   @foreach ($errors->all() as $error)
   <li>{{ $error }} </li>  
   @endforeach
 </ul>
</div>  
@endif
  <!-- Fim do Alert -->
<form action="{{ route('admin.ajustes.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="curso_id" class="form-label">Curso</label>
        <select name="curso_id" id="curso_id" class="form-control" required>
            <option value="">Selecione o Curso</option>
            @foreach ($cursos as $curso)
                <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="classe_id" class="form-label">Classe</label>
        <select name="classe_id" id="classe_id" class="form-control" required>
            <option value="">Selecione um curso primeiro</option>
        </select>
    </div>
    

    <div class="mb-3">
        <label for="valor_mensalidade" class="form-label">Valor Mensalidade</label>
        <input type="number" name="ajuste" id="valor_mensalidade" class="form-control" required step="0.01" min="0">
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
</form>
</div>

<script>
    document.getElementById('curso_id').addEventListener('change', function () {
        const cursoId = this.value;
        const classeSelect = document.getElementById('classe_id');

        classeSelect.innerHTML = '<option>Carregando...</option>';

        fetch(`/admin/classes-por-curso/${cursoId}`)
            .then(response => response.json())
            .then(data => {
                classeSelect.innerHTML = '<option value="">Selecione a Classe</option>';
                data.forEach(classe => {
                    const option = document.createElement('option');
                    option.value = classe.id;
                    option.textContent = classe.nome;
                    classeSelect.appendChild(option);
                });
            });
    });
</script>

@endsection