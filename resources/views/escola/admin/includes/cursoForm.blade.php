<div class="mb-3">
    <label for="nome" class="form-label">Nome do Curso</label>
    <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" name="nome" value="{{ old('nome', $curso->nome ?? '') }}">
    @error('nome')
    <div class="invalid-feedback">{{ $message }}</div>
 @enderror
</div>

<div class="mb-3">
    <label for="tipo" class="form-label">Tipo de Ensino</label>
    <select class="form-control @error('tipo') is-invalid @enderror" id="tipo" name="tipo">
        <option value="{}">-- Selecione --</option>
        <option value="primário" {{ old('tipo', $curso->tipo ?? '') == 'primário' ? 'selected' : '' }}>Primário</option>
        <option value="secundário" {{ old('tipo', $curso->tipo ?? '') == 'secundário' ? 'selected' : '' }}>Secundário</option>
        <option value="médio" {{ old('tipo', $curso->tipo ?? '') == 'médio' ? 'selected' : '' }}>Médio</option>
    </select>
    @error('tipo')
    <div class="invalid-feedback">{{ $message }}</div>
 @enderror
</div>

<div class="mb-3">
    <label for="valor_mensalidade" class="form-label">Valor da Mensalidade</label>
    <input type="number" class="form-control  @error('valor_mensalidade') is-invalid @enderror" id="valor_mensalidade" name="valor_mensalidade" step="0.01" min="0" value="{{ old('valor_mensalidade', $curso->valor_mensalidade ?? '') }}">
    @error('valor_mensalidade')
    <div class="invalid-feedback">{{ $message }}</div>
 @enderror
</div>
