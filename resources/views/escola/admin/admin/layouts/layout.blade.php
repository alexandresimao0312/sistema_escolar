<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Gustavo Resende">

    <title>Administração</title>

    <!-- Bootstrap core CSS -->
    <link href="/resources/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/loader.css">
    <link href="/css/list-items.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/adm.css">
    <link rel="stylesheet" href="/css/chat.css">
    <link rel="stylesheet" href="/css/filedrop.css">
    <link rel="stylesheet" href="/css/tabela.css">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
        <!-- CSS do Select2 -->
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

      <!-- Carregando arquivos da biblioteca AST-Notif. Créditos: https://github.com/anandastoon/AST-Notif -->
    <link rel="stylesheet" href="../resources/AST-Notif/css/ast-notif.min.css">
    <!-- Carregando arquivos da biblioteca driver.js. Créditos: https://github.com/kamranahmedse/driver.js -->
    <link rel="stylesheet" href="/resources/driver/driver.min.css">
    <link rel="shortcut icon" href="/images/domain.png" type="image/x-icon">

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1043735660338382"
     crossorigin="anonymous"></script>

     <style>

      .toast-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background: #0d6efd;
    color: white;
    padding: 15px;
    border-radius: 5px;
    z-index: 9999;
}

    .chat-bubble {
        max-width: 70%;
        position: relative;
        word-wrap: break-word;
    }
      .vit {
            max-height: 70px;
            margin-bottom: 10px;
        }


     </style>
  </head>

  <body>
    <div class="confirm">
      <div></div>
      <div>
        <div id="confirmMessage"></div>
        <div>
          <input id="confirmYes" type="button" value="Sim" />
          <input id="confirmNo" type="button" value="Não" />
        </div>
      </div>
    </div>
    
    <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" id="modal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="titulo">Modal title</h5>
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button> -->
          </div>
          <div class="modal-body" id="corpo">
            <p>Modal body text goes here.</p>
          </div>
          <div class="modal-footer" id="botoes">
            <button type="button" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="matriculaModal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="tituloMatricula">Ficha de matrícula - PDF</h5>
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button> -->
          </div>
          <div class="modal-body" id="corpoMatricula">
            
          </div>
          <div class="modal-footer" id="botoesMatricula">
            <button type="button" class="btn btn-primary" onclick="window.frames['fichaPdf'].focus(), window.frames['fichaPdf'].print()">Imprimir</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="boletimModal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="tituloBoletim">Boletim Escolar - PDF</h5>
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button> -->
          </div>
          <div class="modal-body" id="corpoBoletim">
            
          </div>
          <div class="modal-footer" id="botoesBoletim">
            <button type="button" class="btn btn-primary" onclick="window.frames['boletimPdf'].focus(), window.frames['boletimPdf'].print()">Imprimir</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>

    

          <!-- Inicialização do Firebase -->
        <!-- update the version number as needed -->
        <script defer src="/__/firebase/8.2.3/firebase-app.js"></script>
        <!-- include only the Firebase features as you need -->
        <script defer src="/__/firebase/8.2.3/firebase-auth.js"></script>
        <script defer src="/__/firebase/8.2.3/firebase-database.js"></script>
        <!-- <script defer src="/__/firebase/8.2.3/firebase-firestore.js"></script> -->
        <script defer src="/__/firebase/8.2.3/firebase-functions.js"></script>
        <!-- <script defer src="/__/firebase/8.2.3/firebase-messaging.js"></script> -->
        <script defer src="/__/firebase/8.2.3/firebase-storage.js"></script>
        <script defer src="/__/firebase/8.2.3/firebase-analytics.js"></script>
        <!-- <script defer src="/__/firebase/8.1.1/firebase-remote-config.js"></script> -->
        <script defer src="/__/firebase/8.2.3/firebase-performance.js"></script>
        <!-- 
          initialize the SDK after all desired features are loaded, set useEmulator to false
          to avoid connecting the SDK to running emulators.
        -->
        <script defer src="/__/firebase/init.js?useEmulator=true"></script>
        
        <nav class="navbar navbar-light navbar-expand-lg sticky-top bg-light flex-md-nowrap p-0">
         <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="">
        <img src="{{asset('/images/eugenia_gonsalves.webp') }}" class="vit" alt="Logo da Escola" style="width:100%; height: 30px">
        </a>
        <ul class="navbar-nav">
          <li class="nav-item dropdown active navbar-toggler" class="" type="button" data-toggle="collapse">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              &nbsp;&nbsp;Administração
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="list" href="#abaDashboard" role="tab" aria-controls="home">
                    <span data-feather="home"></span>
                    Dashboard <span class="sr-only">(current)</span>
                  </a>
                </li>
                <!-- <li class="nav-item">
                  <a class="nav-link" data-toggle="list" href="#abaAlunos" role="tab" aria-controls="alunos" id="btnAbaAlunosResponsivo" onclick="carregaListaDeAlunos()">
                    <span data-feather="users" ></span>
                    Alunos
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="list" href="#abaTurmas" role="tab" aria-controls="turmas" onclick="carregaTurmas()" id="btnAbaTurmasMobile">
                    <span data-feather="database"></span>
                    Turmas
                  </a>
                </li> -->
                <li class="nav-item">
                  <a class="nav-link" data-toggle="list" href="#abaContratos" role="tab" aria-controls="contratos" onclick="carregaContratos()" id="btnAbaContratosMobile">
                    <span data-feather="paperclip"></span>
                    Contratos
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="list" href="#abaFinanceiro" role="tab" aria-controls="financeiro" id="btnAbaFinaceiroMobile" onclick="carregaFinanceiro()">
                    <span data-feather="dollar-sign"></span>
                    Financeiro
                  </a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="container-fluid">
                  <span class="navbar-text me-auto fw-bold">
            Bem-vindo(a), {{ Auth::guard('admin')->user()->nome ?? 'admin' }}
        </span>
     <!-- Menu de perfil da secretaria -->
  
<div class="dropdown ms-auto" id="dropdownPerfil">
  <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
      <img src="{{ isset($secretaria->foto ) ? asset('storage/' . Auth::guard('secretaria')->user()->foto) : asset('/images/profile_placeholder.png') }}"
           alt="Foto de perfil"
           class="rounded-circle"
           width="40" height="40">
      <span class="ms-2">{{ Auth::guard('admin')->user()->nome ?? 'Admin' }}</span>
  </a>
  <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser" >
      <li><a class="dropdown-item" href="" >Meu Perfil</a></li>
    <li><hr class="dropdown-divider"></li>
      <a class="dropdown-item" href="">
        Alterar Senha
    </a>
    <li><hr class="dropdown-divider"></li>
      <li>
          <form action="{{ route('admin.logout') }}" method="POST">
              @csrf
              <button class="dropdown-item" type="submit">Sair</button>
          </form>
      </li>
  </ul>
</div>
        </div>
      </nav>

    <div class="container-fluid">
   
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky" id="sidebar">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="{{route('admin.admin.dashboard')}}">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="{{route('admin.turmas.index')}}" role="tab" aria-controls="turmas" id="btnAbaTurmas" onclick="turmas()">
                  <span data-feather="database"></span>
                  Turmas
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('admin.cursos.index')}}" role="tab" aria-controls="turmas" id="btnAbaTurmas" onclick="turmas()">
                  <span data-feather="database"></span>
                  Cursos
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('admin.classes.index')}}" role="tab" aria-controls="turmas" id="btnAbaTurmas" onclick="turmas()">
                  <span data-feather="database"></span>
                  Classes
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('admin.secretarias.index')}}">
                  <span data-feather="user-x"></span>
                  Secretario(a)
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('admin.funcionarios.index')}}">
                  <span data-feather="user-x"></span>
                  Funcionarios
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('admin.admin.financeiro.dashboard')}}">
                  <span data-feather="dollar-sign"></span>
                  Financeiro
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('admin.salarios.index')}}">
                  <span data-feather="dollar-sign"></span>
                  Salarios()
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link">
                  <span data-feather="paperclip"></span>
                  Contratos
                </a>
              </li>
                <li class="nav-item">
                <a class="nav-link" href="{{route('admin.ajustes.index')}}">
                  <span data-feather="paperclip"></span>
                  Gestão de Mensalidades
                </a>
              </li>
                <li class="nav-item">
                <a class="nav-link" href="{{route('admin.ajuda.index')}}">
                  <span data-feather="paperclip"></span>
                  Tutorial do Usuario
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.logs.index') }}" class="nav-link">
          <span data-feather="tool"></span>
          <i class="fas fa-history me-2"></i> Histórico de Login
      </a>
      </li>
           <li class="nav-item">
        <a href="{{ route('ajuda.index') }}" class="nav-link">
          <i class="bi bi-patch-question"></i> Central de Ajudas
      </a>
      </li>
     </ul>
     <div>
              <ul class="nav flex-column mb-2" id="listaChats">
                <li class="nav-item">
                  <a class="nav-link" href="{{route('admin.chat.conversations.index')}}">
                    <span data-feather="message-square"></span>
                    Bater Papo
                  </a>
                </li>
              </ul>
            </div>
    </ul>
     <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>Criar Conversas</span>
      <a class="d-flex align-items-center text-muted" href="{{route('admin.chat.conversations.create')}}" onclick="criarChat()">
        <span data-feather="plus-circle" data-toggle="tooltip" data-placement="top" title="Criar um chat"></span>
      </a>
    </h6>

    </nav>
       

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Administração</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <!--<div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
              </button>-->
              <label for="profilePic" class="text-muted float-right" id="username"></label>
                <form action="{{ route('admin.logout') }}" method="POST">
              @csrf
             
               <button class="btn" type="submit"><img src="../images/profile_placeholder.png" class="rounded float-right" width="40px" id="profilePic"></button>
          </form>
            </div>
          </div>

         @include('escola.admin.admin.dashboard.total')
          <hr>
          <div class="tab-content" id="nav-tabContent">

            <!-- conteudo -->
            @yield('conteudo')

          </div> 
        </main>
      </div>
    </div>


    <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
    <script src="/resources/jQuery/jquery-3.2.1.slim.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>-->
    <script src="/resources/popper/popper.min.js"></script>
    <script src="/resources/bootstrap/js/bootstrap.min.js"></script>

    <!-- Packages for jsPDF -->
    <script src="/resources/jsPDF/dist/jspdf.min.js"></script>
    
    <!-- Icons -->
    <script src="/resources/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>
    <script defer src="/js/adm.js"></script>
    <script defer src="/js/app.js"></script>
    <script defer src="/js/chat.js"></script>
    <!-- Carregando outros arquivos da biblioteca AST-Notif. Créditos: https://github.com/anandastoon/AST-Notif -->
    <script defer src="/resources/AST-Notif/js/ast-notif.min.js"></script>

    <!-- Carregando arquivos da biblioteca driver.js. Créditos: https://github.com/kamranahmedse/driver.js -->
    <script defer src="/resources/driver/driver.min.js"></script>
    <script defer src="/js/tour.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.js" integrity="sha512-pF+DNRwavWMukUv/LyzDyDMn8U2uvqYQdJN0Zvilr6DDo/56xPDZdDoyPDYZRSL4aOKO/FGKXTpzDyQJ8je8Qw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

    <!-- Incluindo o jQuery primeiro -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Incluindo o Select2 -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
  <!-- Inicializando o Select2 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


  @include('escola.admin.admin.layouts.script')

@yield('scripts')
  </body>
</html>
