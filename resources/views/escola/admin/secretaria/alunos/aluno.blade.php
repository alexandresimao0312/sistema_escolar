@extends('escola.admin.layouts.layout')
@section('conteudo')
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="container" >
   <label class="h3">Alunos</label>
   <br>
   <div>
     <div class="container">
      <form method="GET" action="{{ route('secretaria.alunos.index') }}" class="mb-4 row g-3">
        <div class="col-md-3">
            <input type="text" name="nome" class="form-control" placeholder="Nome do aluno" value="{{ request('nome') }}">
        </div>
    
        <div class="col-md-3">
            <select name="curso_id" class="form-control">
                <option value="">-- Todos os cursos --</option>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id }}" {{ request('curso_id') == $curso->id ? 'selected' : '' }}>
                        {{ $curso->nome }}
                    </option>
                @endforeach
            </select>
        </div>
    
        <div class="col-md-3">
            <select name="classe_id" class="form-control">
                <option value="">-- Todas as classes --</option>
                 @foreach($classes as $classe)
                    <option value="{{ $classe->id }}" {{ request('classe_id') == $classe->id ? 'selected' : '' }}>
                        {{ $classe->nome }}
                    </option>
                @endforeach
            </select>
        </div>
    
        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="{{ route('secretaria.alunos.index') }}" class="btn btn-secondary ms-2" style="margin-left: 4px">Limpar</a>
        </div>
    </form>
     </div>
     <div class="container-xl" id="tabelaAlunos">
       <div class="table-responsive">
         <div class="table-wrapper">
           <div class="table-title">
             <div class="row">
               <div class="col-sm-6">
                 <h2>Alunos do <b>Colegio</b></h2>
               </div>
               <div class="col-sm-6">
                 <a class="btn btn-success" href="{{ route('secretaria.alunos.exportar.pdf') }}">&nbsp; <span class="feather-24" data-feather="refresh-cw"></span><span>Exportar PDF</span></a>                              
               </div>
             </div>
           </div>
           <table class="table table-striped table-hover">
             <thead>
               <tr>
                 <th>
                   <span class="custom-checkbox">
                     <input type="checkbox" id="selectAll">
                     <label for="selectAll"></label>
                   </span>
                 </th>
                 <th><a href="" id="ordenaNome">Nome</a></th>
                 <th><a href="" id="ordenaMatricula">Email</a></th>
                 <th><a href="" id="ordenaUltimaTurma">Data de Nascimento</a></th>
                 <th><a href="" id="ordenaUltimaTurma">Gênero</a></th>
                 <th>Ações</th>
               </tr>
             </thead>
             <tbody id="listaAlunos">
               @foreach ($alunos as $aluno)
               <tr>
                <td>
                  <span class="custom-checkbox">
                    <input type="checkbox" id="checkbox1" name="options[]" value="1">
                    <label for="checkbox1"></label>
                  </span>
                </td>
                <td>{{ $aluno->nome }}</td>
                <td>{{ $aluno->email }}</td>
                <td>{{ $aluno->data_nascimento }}</td>
                <td>{{ $aluno->genero }}</td>
                 <!-- button Actions -->
                 <td>
                  <div class="dropdown-primary dropdown open">
                      <button class="btn btn-primary dropdown-toggle waves-effect waves-light " type="button" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Actions</button>
                      <div class="dropdown-menu" aria-labelledby="dropdown-2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                          <a class="dropdown-item waves-light waves-effect" href="{{ route('secretaria.alunos.edit', $aluno->id) }}">Edit</a>
                          <a class="dropdown-item waves-light waves-effect" href="{{ route('secretaria.alunos.show', $aluno->id) }}">Ver</a>
                          <a href="{{ route('secretaria.secretaria.alunos.historico', $aluno->id) }}" class="dropdown-item waves-light waves-effect">
                           Histórico
                          </a>                        
                          <form action="{{route('secretaria.alunos.destroy', $aluno->id)}}" method="post">
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
           {{$alunos->links()}}
         </div>
       </div>
     </div>

  
   </div>
 </div>

@endsection