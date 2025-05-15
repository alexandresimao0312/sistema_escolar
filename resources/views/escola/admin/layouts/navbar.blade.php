<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky" id="sidebar">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link active" href="{{route('dashboard')}}">
          <span data-feather="home"></span>
          Dashboard <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  href="{{route('secretaria.alunos.index')}}" role="tab" aria-controls="alunos" id="btnAbaAlunos" onclick="carregaListaDeAlunos(), dragDropJaCadastrado()">
          <span data-feather="users" ></span>
          Alunos
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('secretaria.mensalidades.index')}}" role="tab" aria-controls="alunos" id="btnAbaPreMatriculas"  onclick="abaPreMatriculas()">
          <span data-feather="archive" ></span>
          Mensalidades
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('secretaria.pagamentos.index')}}" role="tab" aria-controls="alunos" id="btnAbaPreMatriculas"  onclick="abaPreMatriculas()">
          <span data-feather="archive" ></span>
          Pagamentos
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('turmas.list')}}" role="tab" aria-controls="turmas" id="btnAbaTurmas" onclick="turmas()">
          <span data-feather="database"></span>
          Turmas
        </a>
        <li class="nav-item">
          <a class="nav-link" href="{{route('cursos.list')}}" role="tab" aria-controls="turmas" id="btnAbaTurmas" onclick="turmas()">
            <span data-feather="database"></span>
            Cursos
          </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('classes.list')}}" role="tab" aria-controls="turmas" id="btnAbaTurmas" onclick="turmas()">
          <span data-feather="database"></span>
          Classes
        </a>
      <li class="nav-item">
        <a class="nav-link" href="{{route('secretaria.matriculas.index')}}" role="tab" aria-controls="turmas" id="btnAbaTurmas" onclick="turmas()">
          <span data-feather="database"></span>
          Matriculas
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  href="{{route('secretaria.alunos.create')}}" role="tab" aria-controls="CadastrarAlunos" onclick="carregaProfsETurmas(), dragDropCadastroAluno(), cadastrarResponsavel()" id="btnCadastrarAlunos">
          <span data-feather="user-plus"></span>
          Cadastrar alunos
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  href="" role="tab" id="btnAbaAlunosDesativados" aria-controls="alunosDesativados" onclick="carregaAlunosDesativados()">
          <span data-feather="user-x"></span>
          Alunos desativados
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('secretaria.secretaria.logs.index') }}" class="nav-link">
          <span data-feather="tool"></span>
          <i class="fas fa-history me-2"></i> Histórico de Atividades
      </a>
      </li>
    </ul>

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>Chats</span>
      <a class="d-flex align-items-center text-muted" href="#" onclick="criarChat()">
        <span data-feather="plus-circle" data-toggle="tooltip" data-placement="top" title="Criar um chat"></span>
      </a>
    </h6>
    <div>
      <ul class="nav flex-column mb-2" id="listaChats">
        <li class="nav-item">
          <a class="nav-link" href="#" onclick="carregaChat('geral')" data-toggle="tooltip" data-placement="top" title="Apenas funcionários cadastrados corretamente no sistema têm acesso à este chat">
            <span data-feather="message-square"></span>
            Geral
          </a>
        </li>
      </ul>
    </div>
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>Abrir um chamado</span>
      <a class="d-flex align-items-center text-muted" href="#" data-toggle="modal" data-target="#chamados">
        <span data-feather="plus-circle"></span>
      </a>
    </h6>
    
    
  </div>
</nav>

