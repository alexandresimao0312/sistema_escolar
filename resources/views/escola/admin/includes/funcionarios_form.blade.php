<div class="mb-3">
    <label>Nome</label>
    <input type="text" name="nome" class="form-control" value="{{ old('nome', $funcionario->nome ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $funcionario->email ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Telefone</label>
    <input type="text" name="telefone" class="form-control" value="{{ old('telefone', $funcionario->telefone ?? '') }}">
</div>

<div class="mb-3">
    <label>Cargo</label>
    <input type="text" name="cargo" class="form-control" value="{{ old('cargo', $funcionario->cargo ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Data de Contratação</label>
    <input type="date" name="contratado_em" class="form-control" value="{{ old('contratado_em', $funcionario->contratado_em ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Salário Base (R$)</label>
    <input type="number" step="0.01" name="salario_base" class="form-control" value="{{ old('salario_base', $funcionario->salario_base ?? '') }}" required>
</div>

<button class="btn btn-success">{{ $submit }}</button>
<a href="{{ route('admin.funcionarios.index') }}" class="btn btn-secondary">Voltar</a>
