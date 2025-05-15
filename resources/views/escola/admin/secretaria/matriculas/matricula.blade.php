@extends('escola.admin.layouts.layout')
@section('conteudo')

@if(session ('success'))
<div class="alert alert-success">{{ session('success') }} </div>
@endif
@if (session()->has('errors'))
<div class="alert alert-danger" role="alert">
  {{session('errors')}} 
</div>
@endif
<div class="container">
  <label class="h3">Matrículas</label>
   <br>
     <form method="GET" action="{{ route('secretaria.matriculas.index') }}" class="row g-2 mb-3">
      <div class="col-md-2">
            <input type="number" name="id" class="form-control" placeholder="Número da matrícula" value="{{ request('id') }}">
        </div>
    <div class="col-md-3">
        <select name="curso_id" class="form-control">
            <option value="">-- Curso --</option>
            @foreach($cursos as $curso)
                <option value="{{ $curso->id }}" {{ request('curso_id') == $curso->id ? 'selected' : '' }}>
                    {{ $curso->nome }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2">
        <select name="classe_id" class="form-control">
            <option value="">-- Classe --</option>
            @foreach($classes as $classe)
                <option value="{{ $classe->id }}" {{ request('classe_id') == $classe->id ? 'selected' : '' }}>
                    {{ $classe->nome }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <select name="turma_id" class="form-control">
            <option value="">-- Turma --</option>
            @foreach($turmas as $turma)
                <option value="{{ $turma->id }}" {{ request('turma_id') == $turma->id ? 'selected' : '' }}>
                    {{ $turma->nome }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="{{ route('secretaria.matriculas.index') }}" class="btn btn-secondary ms-2" style="margin-left: 4px">Limpar</a>
        </div>
</form>

     </div>
    <div class="container-xl">
      <div class="table-responsive">
        <div class="table-wrapper">
          <div class="table-title">
            <div class="row">
              <div class="col-sm-6">
                <h2>Alunos <b>Matrículados</b></h2>
              </div>
              <div class="col-sm-6">
    
                <a href="{{route('secretaria.matriculas.create')}}"  class="btn btn-primary" >&nbsp; <span class="feather-24" data-feather="plus"></span><span>Adicionar</span></a>
                <a class="btn btn-success" href="{{ route('matriculas.exportar.pdf') }}">&nbsp; <span class="feather-24" data-feather="refresh-cw"></span><span>Exportar PDF</span></a>
              </div>
            </div>
          </div>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>
                  
                </th>
                <th>Aluno</th>
                <th>Código</th>
                <th>Curso</th>
                <th>Classe</th>
                <th>Turma</th>
                <th>Turno</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody id="listaCursos">
              @foreach ($matriculas as $matricula)
              <tr>
                <td>
                  <span class="custom-checkbox">
                    <input type="checkbox" id="checkbox1" name="options[]" value="1">
                    <label for="checkbox1"></label>
                  </span>
                </td>
                <td>{{ $matricula->aluno->nome}}</td>
                <td>{{ $matricula->id }}</td>
                <td>{{ $matricula->curso->nome }}</td>
                <td>{{ $matricula->classe->nome}}</td>
                <td>{{ $matricula->turma->nome}}</td>
                <td>{{ $matricula->turno}}</td>
                 <!-- button Actions -->
                 <td>
                  <div class="dropdown-primary dropdown open">
                      <button class="btn btn-primary dropdown-toggle waves-effect waves-light " type="button" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Actions</button>
                      <div class="dropdown-menu" aria-labelledby="dropdown-2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                          <a class="dropdown-item waves-light waves-effect" href="{{ route('secretaria.matriculas.edit', $matricula->id) }}">Edit</a>
                          <a class="dropdown-item waves-light waves-effect" href="{{ route('secretaria.matriculas.show', $matricula->id) }}">Ver</a>
                          <form action="{{route('secretaria.matriculas.destroy', $matricula->id)}}" method="post">
                              @csrf
                              @method('delete')
                          <button class="dropdown-item waves-light waves-effect" onclick="if(confirm('DESEJAS REALMENTE EXCLUIR ESTE REGISTRO??')) {this.form.submit()}" type="button">Delet</button>
                          </form>
                         
                  </div>   
                  </td>
                   <!-- button Fim -->  
              </tr>
              @endforeach
            </tbody>
          </table>
         {{ $matriculas->appends(request()->query())->links() }}

        </div>
      </div>
    </div>
  </form>
@endsection