@csrf

<div class="mb-3">
    <label for="matricula_id">Aluno (Matrícula)</label>
    <select name="matricula_id" id="matricula_id" class="form-control"></select>
    @error('matricula_id')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
    <label for="mes">Mês</label>
    <input type="text" name="mes" class="form-control" value="{{ old('mes', $mensalidade->mes ?? '') }}">
</div>

<div class="mb-3">
    <label for="ano">Ano</label>
    <input type="number" name="ano" class="form-control" value="{{ old('ano', $mensalidade->ano ?? now()->year) }}">
</div>

<div class="mb-3">
    <label for="valor">Valor</label>
    <input type="number" step="0.01" name="valor" class="form-control" value="{{ old('valor', $mensalidade->valor ?? '') }}" >
</div>

<div class="mb-3">
    <label for="data_vencimento">Data de Vencimento</label>
    <input type="date" name="data_vencimento" class="form-control" value="{{ old('data_vencimento', $mensalidade->data_vencimento ?? '') }}" >
</div>
