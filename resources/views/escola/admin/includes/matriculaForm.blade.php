

<div class="form-group">
    <label for="aluno_id">Selecionar Aluno</label>
    <select name="aluno_id" id="aluno_id"  class="form-control  @error('aluno_id') is-invalid @enderror"></select>
  @error('aluno_id')
  <div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>

<div class="form-group">
  <label for="curso_id">Curso</label>
  <select id="curso_id" name="curso_id" class="form-control @error('curso_id') is-invalid @enderror">
    <option value="">Selecione o Curso</option>
    @foreach($cursos as $curso)
        <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
    @endforeach
</select>
@error('curso_id')
  <div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>

<div class="form-group">
  <label for="classe_id">Classe</label>
  <select id="classe_id" name="classe_id" class="form-control @error('classe_id') is-invalid @enderror">
    <option value="">Selecione a Classe</option>
</select>
@error('classe_id')
  <div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>

<div class="form-group">
  <label for="turma_id">Turma</label>
  <select id="turma_id" name="turma_id" class="form-control @error('turma_id') is-invalid @enderror">
    <option value="">Selecione a Turma</option>
</select>
@error('turma_id')
  <div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>

<div class="form-group">
  <label for="ano">Ano</label>
  <input type="datetime-local" name="data_matricula" class="form-control @error('data_matricula') is-invalid @enderror" value="">
  @error('data_matricula')
  <div class="invalid-feedback">{{ $message }}</div>
@enderror
</div>
<div class="form-group">
  <label for="classe_id">Turno</label>
  <select id="turno" name="turno" class="form-control @error('turno') is-invalid @enderror">
    <option value="">Selecione o Turno</option>
    <option value="Manhã">Manhã</option>
    <option value="Tarde">Tarde</option>
    <option value="Noite">Noite</option>
</select>
@error('turno')
  <div class="invalid-feedback">{{ $message }}</div>
@enderror

</div>

