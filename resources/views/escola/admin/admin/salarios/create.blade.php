@extends('escola.admin.admin.layouts.layout')
@section('conteudo')

    <form action="{{ route('admin.salarios.store') }}" method="POST">
    @csrf

    
    <div class="form-group">
        <label>Funcionário</label>
    <select name="funcionario_id" id="funcionario-select" class="form-control @error('funcionario_id') is-invalid @enderror">
        @if (!empty($filtros['funcionario_id']))
            <option value="{{ $filtros['funcionario_id'] }}" selected>{{ $filtros['funcionario_id'] }}</option>
        @endif
    </select>
        @error('nome')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
</div>
     <label>Cargo</label>
    <input type="text" id="cargo" name="cargo" class="form-control" readonly>

    <label>Salário Base</label>
    <input type="text" id="salario_base" name="salario_base" class="form-control" readonly>

    <label>Bônus</label>
    <input type="number" step="0.01" name="bonus" id="bonus" class="form-control" value="0">

    <label>Descontos</label>
    <input type="number" step="0.01" name="descontos" id="descontos" class="form-control">

    <label>Total a Receber</label>
    <input type="text" name="total_recebido" id="total_receber" class="form-control" readonly>

    <label>Data de Pagamento</label>
    <input type="date" name="data_pagamento" class="form-control @error('data_pagamento') is-invalid @enderror">
        @error('data_pagamento')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    <label>Referente ao mês</label>
    <input type="date" name="referente_mes" class="form-control @error('referente_mes') is-invalid @enderror">
      @error('referente_mes')
  <div class="invalid-feedback">{{ $message }}</div>
   @enderror

    <button class="btn btn-success" type="submit" style="margin-top: 7px; padding: 7px">Salvar Registro</button>
</form>


@endsection