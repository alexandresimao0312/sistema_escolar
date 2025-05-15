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

    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/loader.css">
    <link href="/css/list-items.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/adm.css">
    <link rel="stylesheet" href="/css/chat.css">
    <link rel="stylesheet" href="/css/filedrop.css">
    <link rel="stylesheet" href="/css/tabela.css">

      <!-- Carregando arquivos da biblioteca AST-Notif. Créditos: https://github.com/anandastoon/AST-Notif -->
    <link rel="stylesheet" href="../resources/AST-Notif/css/ast-notif.min.css">
    <!-- Carregando arquivos da biblioteca driver.js. Créditos: https://github.com/kamranahmedse/driver.js -->
    <link rel="stylesheet" href="/resources/driver/driver.min.css">
    <link rel="shortcut icon" href="/images/domain.png" type="image/x-icon">

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1043735660338382"
     crossorigin="anonymous"></script>
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
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../">Sistema Escolar</a>
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
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          &nbsp;<ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="../">&nbsp;&nbsp;Início </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../login.html">&nbsp;&nbsp;Login</a>
            </li>
            <li class="nav-item" id="navAdm" >
              <a class="nav-link" href="../professores/">&nbsp;&nbsp;Professores</a>
            </li>
            <li class="nav-item" id="navSecretaria">
              <a class="nav-link" href="../secretaria/">&nbsp;&nbsp;Secretaria</a>
            </li>
          </ul>
        </div>
      </nav>

    <div class="container-fluid">
      <div id="chat">                          
        <div class="container">
          <div class="row pt-3">
            <div class="chat-main">
              <div class="col-md-12 chat-header rounded-top text-white">
                <div class="row">
                  <div class="col-md-6 username pl-2">
                    <i aria-hidden="true" data-feather="message-square"></i>
                    <h6 class="m-0" id="nomeChat">Geral</h6>
                  </div>
                  <div class="col-md-6 options text-right pr-2">
                    <i data-feather="video" aria-hidden="true"></i>
                    <i data-feather="phone" aria-hidden="true"></i>
                    <i class="fa fa-cog mr-2" data-feather="settings" aria-hidden="true" onclick="configChat()"></i>
                    <i class="fa fa-times hide-chat-box" data-feather="chevrons-down" id="fechaChat" aria-hidden="true"></i>
                    <i class="fa fa-times hide-chat-box" data-feather="chevrons-up" id="abreChat" aria-hidden="true" style="visibility: hidden;"></i>
                  </div>
                </div>
              </div>
              <div class="chat-content">
                <div class="col-md-12 chats border">
                  <ul class="p-0" id="mensagensChat">
                    <!-- Exemplos de mesagens: 
                      <li class="pl-2 pr-2 bg-primary rounded text-white text-center send-msg mb-1">
                          hiii
                      </li>
                      <li class="p-1 rounded mb-1">
                          <div class="receive-msg">
                              <img src="http://nicesnippets.com/demo/image1.jpg">
                              <div class="receive-msg-desc  text-center mt-1 ml-1 pl-2 pr-2">
                                  <p class="pl-2 pr-2 rounded">hello</p>
                              </div>
                          </div>
                      </li>
                    -->  
                  </ul>
                </div>
                <div class="col-md-12 message-box border pl-2 pr-2 border-top-0">
                  <form id="enviaMsgChat">
                    <div class="row">
                      <div class="col-md-10">
                        <input type="text" name="txtMsg" autocomplete="off" id="txtMsg" class="pl-0 pr-0 w-100" placeholder="Digite aqui..." />
                        
                      </div>
                      <div class="col-auto">
                        <button type="submit" class="float-right" id="btnEnviaMsg" style="padding: 0; border: none; background: none;"><i class="fa fa-telegram" data-feather="send" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </form>  
                  <div class="tools">
                    <button type="button" onclick="enviarImagem()" id="btnEnviaImagem" style="padding: 0; border: none; background: none;"><i class="fa fa-picture-o" data-feather="image" aria-hidden="true"></i></button>
                    <button type="button" onclick="enviarAnexo()" id="btnEnviaAnexo" style="padding: 0; border: none; background: none;"><i class="fa fa-paperclip" data-feather="paperclip" aria-hidden="true"></i></button>
                    
                    <button type="button" onclick="mensagemRapida('like')" id="btnEnviaLike" class="float-right" style="padding: 0; border: none; background: none;"><i class="fa fa-thumbs-o-up m-0" data-feather="thumbs-up" aria-hidden="true"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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
              <!-- <li class="nav-item">
                <a class="nav-link" data-toggle="list" href="#abaAlunos" role="tab" aria-controls="alunos" id="btnAbaAlunos" onclick="carregaListaDeAlunos()">
                  <span data-feather="users" ></span>
                  Alunos
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="list" href="#abaTurmas" role="tab" aria-controls="turmas" id="btnAbaTurmas" onclick="carregaTurmas()">
                  <span data-feather="database"></span>
                  Turmas
                </a>
              </li> -->
              <li class="nav-item">
                <a class="nav-link">
                  <span data-feather="paperclip"></span>
                  Contratos
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('admin.secretarias.index')}}">
                  <span data-feather="user-x"></span>
                  Secretario(a)
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
                <a class="nav-link" href="{{route('admin.ajustes.index')}}">
                  <span data-feather="paperclip"></span>
                  Gestão de Mensalidades
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link">
                  <span data-feather="dollar-sign"></span>
                  Financeiro
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
            
            
          </div>
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
              <a class="btn" href="../login.html"><img src="../images/profile_placeholder.png" class="rounded float-right" width="40px" id="profilePic"></a>
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

    

  </body>
</html>
