<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Gustavo Resende">

    <title>Secretaria</title>

    <!-- Bootstrap core CSS -->
    <link href="/resources/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/loader.css">
    <link href="/css/list-items.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/secretaria.css">
    <link rel="stylesheet" href="/css/chat.css">
    <link rel="stylesheet" href="/css/filedrop.css">
    <link rel="stylesheet" href="/css/tabela.css">
    <link rel="stylesheet" href="/css/grid-list.css">
    <link rel="stylesheet" href="/css/file-manager.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    
    <link href='/resources/fullcalendar/lib/main.css' rel='stylesheet' />
    <!-- rrule lib -->
    <script src='https://cdn.jsdelivr.net/npm/rrule@2.6.4/dist/es5/rrule.min.js'></script>
    <script src='/resources/fullcalendar/lib/main.js'></script>
    <script src="/resources/fullcalendar/lib/locales/pt-br.js"></script>
    <!-- the rrule-to-fullcalendar connector. must go AFTER the rrule lib -->
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/rrule@5.5.0/main.global.min.js'></script>
    
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1043735660338382"
     crossorigin="anonymous"></script>
    <script>

      

    </script>

    <!-- Adicione isso no <head> ou antes de fechar o </body> -->
      <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />


      <!-- Bootstrap JS e dependências -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-..." crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

      <!-- Carregando arquivos da biblioteca AST-Notif. Créditos: https://github.com/anandastoon/AST-Notif -->
    <link rel="stylesheet" href="/resources/AST-Notif/css/ast-notif.min.css">
    <!-- Carregando arquivos da biblioteca driver.js. Créditos: https://github.com/kamranahmedse/driver.js -->
    <link rel="stylesheet" href="/resources/driver/driver.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/css/selectize.bootstrap4.min.css" integrity="sha512-MMojOrCQrqLg4Iarid2YMYyZ7pzjPeXKRvhW9nZqLo6kPBBTuvNET9DBVWptAo/Q20Fy11EIHM5ig4WlIrJfQw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="/images/domain.png" type="image/x-icon">
  </head>

  <style>
    .dropdown-menu {
    min-width: 200px;
}

.dropdown-item:hover {
    background-color: #f1f1f1;
    color: #000;
}

img.rounded-circle {
    object-fit: cover;
    border: 2px solid #ddd;
}
#menuPerfil {
    display: none;
    opacity: 0;
    transform: translateY(10px);
    transition: opacity 0.3s ease, transform 0.3s ease;
    position: absolute;
    right: 0;
    z-index: 1000;
}

#menuPerfil.show {
    display: block;
    opacity: 1;
    transform: translateY(0);
}
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
  .vit {
            max-height: 70px;
            margin-bottom: 10px;
        }


  </style>
  <body>
         <!-- Inicialização e incluindo os modal -->
         @include('escola.admin.layouts.modal')
          <!-- fim do modal -->

          <!-- Inicialização do Firebase -->
        <!-- update the version number as needed -->
        <script defer src="/__/firebase/8.7.1/firebase-app.js"></script>
        
        
        <script defer src="/__/firebase/8.7.1/firebase.js"></script>
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
              &nbsp;&nbsp;Secretaria
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="list" href="#abaDashboard" role="tab" aria-controls="home">
                    <span data-feather="home"></span>
                    Dashboard <span class="sr-only">(current)</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="list" href="{{route('secretaria.alunos.index')}}" role="tab" aria-controls="alunos" id="btnAbaAlunosResponsivo" onclick="carregaListaDeAlunos(), dragDropJaCadastrado()">
                    <span data-feather="users" ></span>
                    Alunos
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="list" href="#abaPreMatriculas" role="tab" aria-controls="preMatriculas" id="btnAbaPreMatriculasResponsivo" onclick="abaPreMatriculas()">
                    <span data-feather="archive" ></span>
                    Pré-matrículas
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="list" href="#abaTurmas" role="tab" aria-controls="turmas" onclick="turmas()">
                    <span data-feather="database"></span>
                    Turmas
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="list" href="#abaCadastrarTurmas" role="tab" aria-controls="CadastrarTurmas" onclick="preparaCadastroTurma()">
                    <span data-feather="plus-square"></span>
                    Cadastrar turmas
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="list" href="#abaCadastrarAlunos" role="tab" aria-controls="CadastrarAlunos" onclick="carregaProfsETurmas(), dragDropCadastroAluno(), cadastrarResponsavel()">
                    <span data-feather="user-plus"></span>
                    Cadastrar alunos
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="list" href="#abaAlunosDesativados" role="tab" aria-controls="alunosDesativados" onclick="carregaAlunosDesativados()">
                    <span data-feather="user-x"></span>
                    Alunos desativados
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="list" href="#abaEnviarEmails" role="tab" id="btnAbaEnviarEmails" aria-controls="Enviar emails" onclick="abaEmail()">
                    <span data-feather="send"></span>
                    E-mails
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="list" href="#abaInfoEscola" onclick="dadosInfoEscola()" role="tab" id="btnAbaInfoEscola" aria-controls="informacoesescola">
                    <span data-feather="tool"></span>
                    Configurações da Escola
                  </a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="container-fluid list-group-item d-flex justify-content-between align-items-center">
          <span class="navbar-text me-auto fw-bold">
            Bem-vindo(a), {{ Auth::guard('secretaria')->user()->nome ?? 'Secretária' }}
        </span>
       
<div class="d-flex justify-content-between align-items-center">
    <!-- notificações -->
   @if (empty($notificacoes))
        @php
        $notificacoes = auth('secretaria')->user()
            ->notifications()
            ->latest()
            ->take(4) // Mostra só as 4 mais recentes
            ->get();
       @endphp

  <li class="nav-item dropdown list-group">
  <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
      🔔({{ $notificacoes->count() }})
  </a>
  <ul class="dropdown-menu dropdown-menu-end" style="text-decoration: none">
      @forelse ($notificacoes as $notificacao)
          <li>
              <a class="dropdown-item small text-wrap" href="#">
                  {{ $notificacao->data['mensagem'] ?? 'Notificação' }}
                  <br>
                  <small class="text-muted">{{ $notificacao->created_at->diffForHumans() }}</small>
              </a>
          </li>
      @empty
          <li><span class="dropdown-item text-muted">Sem notificações</span></li>
      @endforelse

      @if ($notificacoes->count() >= 3)
          <li><hr class="dropdown-divider"></li>
          <li>
              <a class="dropdown-item text-center" href="{{ route('secretaria.secretaria.notificacoes.index') }}">
                  Ver todas notificações
              </a>
          </li>
      @endif
  </ul>
</li>
@endif
       <!-- Menu de perfil da secretaria -->
<div class="dropdown ms-auto" id="dropdownPerfil">
  <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
      <img src="{{ isset($secretaria->foto ) ? asset('storage/' . Auth::guard('secretaria')->user()->foto) : asset('/images/profile_placeholder.png') }}"
           alt="Foto de perfil"
           class="rounded-circle"
           width="40" height="40">
      <span class="ms-2">{{ Auth::guard('secretaria')->user()->nome ?? 'Secretária' }}</span>
  </a>
  <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser" >
      <li><a class="dropdown-item" href="{{ route('secretaria.secretaria.perfil.edit') }}" >Meu Perfil</a></li>
    <li><hr class="dropdown-divider"></li>
      <a class="dropdown-item" href="{{ route('secretaria.secretaria.perfil.senha.edit') }}">
        Alterar Senha
    </a>
    <li><hr class="dropdown-divider"></li>
      <li>
          <form action="{{ route('secretaria.logout') }}" method="POST">
              @csrf
              <button class="dropdown-item" type="submit">Sair</button>
          </form>
      </li>
  </ul>
</div>
</div>
</div>
      </nav>
      
    <div class="container-fluid">

      <div class="row">
        <!--inclusão do nav bar-->
      @include('escola.admin.layouts.navbar')
         <!-- Fim da inclusão do nav bar-->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4" id="telaPrincipalSecretaria">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <label class="h2" id="tituloSecretaria">Secretaria</label>
            <div class="btn-toolbar mb-2 mb-md-0">
              <!--<div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
              </button>-->

              <button type="button" class="btn btn-light btn-sm" onclick="document.getElementById('btnAbaAlunos').click()">
                Total de Alunos <span class="badge badge-success" id="alunosMatriculadosNum">{{$totalAlunos}}</span>
              </button>
              <button type="button" class="btn btn-light btn-sm" onclick="document.getElementById('btnAbaAlunosDesativados').click()">
                Alunos Matriculados <span class="badge badge-success" id="alunosDesativadosNum">{{$totalMatriculas}}</span>
              </button>
              <button type="button" class="btn btn-light btn-sm" onclick="document.getElementById('btnAbaTurmas').click()">
                Turmas Cadastradas <span class="badge badge-success" id="turmasCadastradasNum"> {{$turmaTotal}} </span>
              </button>
              <img src="{{ asset('storage/' . Auth::guard('secretaria')->user()->foto) }}" width="40" height="40" class="rounded-circle me-2">
              <label for="profilePic" class="text-muted float-right" id="username" style="margin-left: 10px;"></label>
            </div>
          </div>

          <div class="container" onload="carregaDadosParaDashboard()">
            <!--<button type="button" class="btn btn-light btn-sm">
              Alunos cadastrados <span class="badge badge-primary" id="alunosCadastradosNum">0</span>
            </button>-->
            
            
          </div>
          <!-- Gráfico -->
          <!-- <canvas class="my-4" id="myChart" width="900" height="380"></canvas> -->
          <div class="tab-content" id="nav-tabContent">
            <div class="container tab-pane fade show active" id="abaDashboard" role="tabpanel" aria-labelledby="Dashboard" style="width: 100%;">
             
              <div id="calendar"></div>

              
            </div>

            @yield('conteudo')
           
            <!-- FIM área das abas dinâmicas -->

          </div>

          
          
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
    <script src="/resources/jQuery/jquery-3.2.1.slim.min.js"></script>
    <script src="/resources/jQuery/jquery.mask.min.js"></script>
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

<script defer src="https://uicdn.toast.com/tui.code-snippet/v1.5.2/tui-code-snippet.min.js"></script>

<script defer src="https://uicdn.toast.com/tui.time-picker/latest/tui-time-picker.min.js"></script>

<script defer src="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.min.js"></script>

<script defer src="https://uicdn.toast.com/tui-calendar/latest/tui-calendar.js"></script>
    
    <script defer src="/js/secretaria.js"></script>
    <script defer src="/js/app.js"></script>
    <script defer src="/js/chat.js"></script>
    <!-- Carregando outros arquivos da biblioteca AST-Notif. Créditos: https://github.com/anandastoon/AST-Notif -->
    <script defer src="/resources/AST-Notif/js/ast-notif.min.js"></script>
    

    <!-- Carregando arquivos da biblioteca driver.js. Créditos: https://github.com/kamranahmedse/driver.js -->
    <script defer src="/resources/driver/driver.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.js" integrity="sha512-pF+DNRwavWMukUv/LyzDyDMn8U2uvqYQdJN0Zvilr6DDo/56xPDZdDoyPDYZRSL4aOKO/FGKXTpzDyQJ8je8Qw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script>
      var ctx = document.getElementById("myChart");
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
          datasets: [{
            data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            borderWidth: 4,
            pointBackgroundColor: '#007bff'
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: false
              }
            }]
          },
          legend: {
            display: false,
          }
        }
      });
    </script> 

    <!-- Incluindo o jQuery primeiro -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Incluindo o Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<!-- Inicializando o Select2 -->


@include('escola.admin.layouts.script')

<!-- scripts globais -->
@yield('scripts') {{-- Aqui os scripts específicos de cada página --}}

<script>
  document.addEventListener("DOMContentLoaded", function () {
      const btn = document.getElementById("btnDropdownPerfil");
      const menu = document.getElementById("menuPerfil");

      btn.addEventListener("click", function (e) {
          e.preventDefault();
          menu.classList.toggle("show");
      });

      // Fechar se clicar fora
      document.addEventListener("click", function (e) {
          if (!btn.contains(e.target) && !menu.contains(e.target)) {
              menu.classList.remove("show");
          }
      });
  });
</script>


  </body>
</html>
