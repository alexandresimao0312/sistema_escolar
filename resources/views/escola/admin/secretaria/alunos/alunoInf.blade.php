@extends('escola.admin.layouts.layout')
@section('conteudo')
    
<div class="container" id="infoDoAluno" style="">
    <div class="main-body">
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="/images/profile_placeholder.png" alt="Imagem do aluno" class="" width="150" id="mostraFotoAluno">
                    
                    <div class="mt-3">
                      <label id="alunoDesativado" style="color: green;">{{ $matriculas->estado ?? 'INDISPONIVEL' }}</label>
                      <h4 id="mostraNomeAluno">{{ $aluno->nome }}</h4>
                      <p class="text-secondary mb-1" id="mostraIdadeAluno">IDADE : {{ $aluno->data_nascimento }}</p>
                      <label class="text-secondary mb-1" id="mostraTurmaAluno">TURMA : {{ $matriculas->turma?->nome ?? '---' }}</label>
                      <p class="text-muted font-size-sm" id="mostraHoraEDiasAluno"></p>
                      <a class="btn btn-primary" href="{{ route('alunos.pdf', $aluno->id) }}">Baixar PDF</a>
                      <button class="btn btn-outline-primary" onclick="mostraDadosResponsaveis()">Responsáveis</button><br><br>
                      <button class="btn btn-block btn-outline-primary" onclick="addResponsavelAutorizado(document.getElementById('mostraMatriculaAluno').innerText)"><span data-feather="plus"></span> Add responsável autorizado</button>
                      <br>
                      <section id="secGeraFicha"></section>
                      
                      
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><span data-feather="file-text"></span> NIF ou CEDULA</h6>
                    <span class="text-secondary" id="mostraCpfAluno">{{ $aluno->nif }}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><span data-feather="clipboard"></span> Gênero</h6>
                    <span class="text-secondary" id="mostraRgAluno">{{ $aluno->genero ?? '---' }}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><span data-feather="calendar"></span> Data de Nasc.</h6>
                    <span class="text-secondary" id="mostraDataNascimentoAluno">{{ $aluno->data_nascimento ?? '---' }}</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <a href="#turmasQueParticipa" id="turmasQueParticipa" onclick="historicoAluno(`${document.getElementById('mostraMatriculaAluno').innerText}`, `${document.getElementById('mostraTurmaAluno').innerText}`)" style="text-decoration: none;"><h6 class="mb-0"><span data-feather="file-text"></span> Histórico do aluno</h6></a>
                    <span class="text-secondary"></span>
                  </li>
                  <!--<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><span data-feather="file-text"></span>...</h6>
                    <span class="text-secondary">...</span>-->
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Matrícula</h6>
                    </div>
                    <div class="col-sm-9 text-secondary" id="mostraMatriculaAluno">
                      {{ $matriculas->id ?? 'INDISPONIVEL' }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">E-mail</h6>
                    </div>
                    <div class="col-sm-9 text-secondary" id="mostraEmailAluno">
                      {{ $aluno->email ?? 'INDISPONIVEL' }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Telefone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary" id="mostraTelefoneAluno">
                      {{ $aluno->telefone ?? 'INDISPONIVEL' }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Curso</h6>
                    </div>
                    <div class="col-sm-9 text-secondary" id="mostraCelularAluno">
                      {{ $matriculas->curso?->nome ?? 'INDISPONIVEL' }}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Endereço</h6>
                    </div>
                    <div class="col-sm-9 text-secondary" id="mostraEnderecoAluno">
                      {{ $aluno->endereco ?? 'INDISPONIVEL' }}
                    </div>
                  </div>
                </div>
              </div>
              <div class="row gutters-sm">
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Desempenho</i>do aluno</h6>
                      <div id="desempenhoAluno"></div>
                      
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Notas</i>do aluno </h6> 
                      <div id="somatorioNotas"></div>
                      <div id="notasDoAluno">
                        <small id="nomeNota">...</small><small id="notaReferencia">/100</small>
                        <div class="progress mb-3" style="height: 5px">
                          <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <p class="text-muted float-md-right" id="timestampDoAluno"></p>
        <br>
        <hr>
        <label class="h5">Faltas lançadas</label>
        <div class="row">
          <div class="col">
            <div id="divFrequencias">
              <div class="row justify-content-start">
                <div class="col-3" style="background-color: rgba(86,61,124,.15);border: 1px solid rgba(86,61,124,.2);">Column</div>
                <div class="col-3" style="background-color: rgba(86,61,124,.15);border: 1px solid rgba(86,61,124,.2);">Column</div>
                
              </div>
            </div>
          </div>
          <div class="col" style="display: none;">
            <div id="divTotalFrequencias" >Total de presenças: <label id="totalFrequencias"></label> de <label id="qtdeAulasFrequencia"></label><br> Percentual de frequência atual em <label id="porcentagemFrequencia"></label></div>
          </div>
        </div>
        <hr>
          <!-- Mostra Arquivos -->
          <label class="h6">Envio de documentos pessoais</label>
          <p>Aqui podem ser enviados os documentos como Identidade, CPF, Comprovante de Residência e outros que achar pertinente.
          <div id="drop-area-ja-cadastrado" class="drop-area">
            <section class="my-form">
              <p><b>Arraste e solte</b> os arquivos para enviar </p> ou
              <input type="file" id="fileElemJaCadastrado" class="fileElem" multiple>
              
              <label class="button" for="fileElemJaCadastrado">Escolher arquivos...</label>
            </section>
            <div class="progress" style="position: relative;">
              <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="progress">0%</div>
            </div>
          </div>
          <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-lg-6 col-xl-6">
                                    <h4 class="header-title m-b-30">Arquivos do Aluno</h4>
                                </div>
                                <div class="col">
                                  <button onclick="carregaArquivosAluno(document.getElementById('mostraMatriculaAluno').innerText)" class="btn btn-sm btn-info float-md-right"><span data-feather="refresh-cw"></span> Atualizar arquivos</button>
                                </div>
                            </div>
        
                            <div class="row" id="listaArquivosAluno">
                                <div class="col-lg-3 col-xl-2">
                                  <div class="file-man-box">
                                    <a class="file-close"><i data-feather="x"></i></a>
                                    <div class="file-img-box">
                                      <img src="../images/cpf-icon.png" alt="icon">
                                    </div>
                                    <a class="file-download"><i data-feather="download"></i></a>
                                    <div class="file-man-title">
                                        <h6 class="mb-0 text-overflow">invoice_project.pdf</h5>
                                        <p class="mb-0"><small>568.8 kb</small></p>
                                    </div>
                                  </div>
                                </div>
                                
                                <div class="col-lg-3 col-xl-2">
                                  <div class="file-man-box"><a href="" class="file-close"><i class="fa fa-times-circle"></i></a>
                                    <div class="file-img-box"><img src="https://coderthemes.com/highdmin/layouts/assets/images/file_icons/png.svg" alt="icon">
                                    
                                    </div><a href="#" class="file-download"><i class="fa fa-download"></i></a>
                                      <div class="file-man-title">
                                        <h5 class="mb-0 text-overflow">invoice_project.pdf</h5>
                                        <p class="mb-0"><small>568.8 kb</small></p>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- container -->
        </div>
  </div>

@endsection