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

  <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" id="modalAdicionaLivro">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="titulo">Adicionar Livro</h5>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
        </div>
        <div class="modal-body" id="corpo">
          <form id="addLivroTabela">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Identificação do livro</label>
                <input type="text" class="form-control" id="idLivroAdd" name="idLivroAdd" placeholder="ID do Livro (Ex.: Book 1)">
                <small id="idLivroHElp" class="form-text text-muted">Esta identificação aparecerá nos boletins e nos demais documentos emitidos pelo sistema. Ex.: Book 1</small>
              </div>
              <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Código</label>
                <input type="text" required class="form-control" id="codigoLivroAdd" name="codigoLivroAdd" aria-describedby="nomeEscola" placeholder="Código do Livro">
                <small id="nomeEscolaHElp" class="form-text text-muted">Este código será utilizado para formar os códigos automáticos de turma. Você pode definir o código que quiser. Recomendamos usar números (1, 2, 3...)</small>  
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputPassword4">Nome completo do livro</label>
                  <input type="text" class="form-control" id="nomeLivroAdd" name="nomeLivroAdd" placeholder="Nome do livro (Ex.: Aprendendo Inglês - Edição para Crianças)">
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">Código do Sistema</label>
                  <input type="text" readonly class="form-control" id="codigoSistemaAdd" name="codigoSistemaAdd" placeholder="Código do Sistema">
              </div>
            </div>
            
            <button type="submit" class="btn btn-primary btn-block">Adicionar</button>
          </form>
        </div>
        <div class="modal-footer" id="botoes">
          
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
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

  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="contratosAluno">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloContratos">Contratos cadastrados</h5>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
        </div>
        <div class="modal-body" id="corpoContratos">
          <div class="container-xl" id="tabelaContratosAluno">
            <div class="table-responsive">
              <div class="table-wrapper">
                <div class="table-title">
                  <div class="row">
                    <div class="col-sm-6">
                      <h2>Contratos <b>Cadastrados</b></h2>
                    </div>
                    <div class="col-sm-6">
                      <a class="btn btn-success" id="atualizaContratosAlunos">&nbsp; <span class="feather-24" data-feather="refresh-cw"></span><span>Atualizar lista</span></a>
                                
                    </div>
                  </div>
                </div>
                <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>
                        <span class="custom-checkbox">
                          <!-- <input type="checkbox" id="selectAll">
                          <label for="selectAll"></label> -->
                        </span>
                      </th>
                      <th><a href="#" id="ordenaContrato">Nome do Plano</a></th>
                      <th><a href="#" id="ordenaCurso">Curso</a></th>
                      <th><a href="#" id="ordenaSituação">Situação</a></th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody id="listaContratos">
                    <tr>
                      <td>
                        <span class="custom-checkbox">
                          <!-- <input type="checkbox" id="checkbox1" name="options[]" value="1">
                          <label for="checkbox1"></label> -->
                        </span>
                      </td>
                      <td>Gustavo Resende</td>
                      <td>teste@resende.app</td>
                      <td>KIDS</td>
                      <td>
                        <a href="#editEmployeeModal" class="action" data-toggle="modal"><i data-feather="edit" data-toggle="tooltip" title="Reativar aluno">&#xE254;</i></a>
                        <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Deletar">&#xE872;</i></a>
                      </td>
                    </tr>
                  </tbody>
                </table>
                
              </div>
            </div>
          </div>
          <div class="container" id="visualizaBoletos">
            
          </div>
        </div>
        <div class="modal-footer" id="botoesContratos">
          <!--<button type="button" class="btn btn-primary" onclick="window.frames['fichaPdf'].focus(), window.frames['fichaPdf'].print()">Imprimir</button>-->
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" id="modalAdicionaChecklist">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloAddChecklist">Adicionar Tópico de Checklist Sequencial</h5>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
        </div>
        <div class="modal-body" id="corpoAddChecklist">
          <form id="addChecklistTabela">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Tópico do Checklist</label>
                <input type="text" required class="form-control" id="topicoChecklistAdd" name="topicoChecklistAdd" placeholder="Tópico para este grupo de checklists">
                <small id="idCursoHElp" class="form-text text-muted">Este será o nome do grupo de checkboxes.</small>
              </div>
              <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Nome das checkboxes</label>
                <input type="text" required class="form-control" id="nomeChecklistAdd" name="nomeChecklistAdd" aria-describedby="nomeChecklist" placeholder="Nome do checklist">
                <small id="nomeChecklistHElp" class="form-text text-muted">Este será o nome que aparecerá em frente de cada checkbox.</small>  
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputPassword4">Quantidade</label>
                  <input type="number" required class="form-control" id="qtdeChecklistAdd" name="qtdeChecklistAdd" placeholder="Quantidade de checklists">
                  <small id="qtdeChecklistHElp" class="form-text text-muted">Quantidade de vezes que esse checklist se repete.</small>
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">Cod. do Sistema</label>
                  <input type="text" readonly class="form-control" id="codChecklist" name="codChecklist" placeholder="Quantidade de checklists">
                  <small id="qtdeChecklistHElp" class="form-text text-muted">Código interno de controle do sistema.</small>
              </div>
            </div>
            
            <button type="submit" class="btn btn-primary btn-block">Salvar</button>
          </form>
        </div>
        <div class="modal-footer" id="botoesAddChecklist">
          
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" id="modalAdicionaChecklistAcompanhamento">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloAddChecklistAcompanhamento">Adicionar Tópico de Checklist de Acompanhamento</h5>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
        </div>
        <div class="modal-body" id="corpoAddChecklistAcompanhamento">
          <form id="addChecklistAcompanhamentoTabela">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Tópico do Checklist</label>
                <input type="text" required class="form-control" id="topicoChecklistAcompanhamentoAdd" name="topicoChecklistAcompanhamentoAdd" placeholder="Tópico para este grupo de checklists">
                <small id="idCursoHElp" class="form-text text-muted">Este será o nome do grupo de checkboxes.</small>
              </div>
              <div class="form-group col-md-6">
                <label for="exampleInputEmail1">Nome das checkboxes</label>
                <input type="text" required class="form-control" id="nomeChecklistAcompanhamentoAdd" name="nomeChecklistAcompanhamentoAdd" aria-describedby="nomeChecklistAcompanhamento" placeholder="Nome do checklist">
                <small id="nomeChecklistHElp" class="form-text text-muted">Este será o nome que aparecerá em frente de cada checkbox.</small>  
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputPassword4">Quantidade</label>
                  <input type="number" required class="form-control" id="qtdeChecklistAcompanhamentoAdd" name="qtdeChecklistAcompanhamentoAdd" placeholder="Quantidade de checklists">
                  <small id="qtdeChecklistHElp" class="form-text text-muted">Quantidade de vezes que esse checklist se repete.</small>
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">Cod. do Sistema</label>
                  <input type="text" readonly class="form-control" id="codChecklistAcompanhamento" name="codChecklistAcompanhamento" placeholder="Quantidade de checklists">
                  <small id="qtdeChecklistHElp" class="form-text text-muted">Código interno de controle do sistema.</small>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="inputPassword4">Nome situação 1:</label>
                  <input type="text" required class="form-control" id="situacao1Add" name="situacao1Add" placeholder="Situação 1">
                  <small id="qtdeChecklistHElp" class="form-text text-muted">Nome da situação 1. (Ex.: "Pendente")</small>
              </div>
              <div class="form-group col-md-3">
                <label for="inputPassword4">Nome situação 2:</label>
                  <input type="text" required class="form-control" id="situacao2Add" name="situacao2Add" placeholder="Situação 2">
                  <small id="qtdeChecklistHElp" class="form-text text-muted">Nome da situação 2. (Ex.: "Pago")</small>
              </div>
              <div class="form-group col-md-3">
                <label for="inputPassword4">Nome situação 2:</label>
                  <input type="text" required class="form-control" id="situacao3Add" name="situacao3Add" placeholder="Situação 3">
                  <small id="qtdeChecklistHElp" class="form-text text-muted">Nome da situação 3. (Ex.: "Entregue")</small>
              </div>
            </div>
            
            <button type="submit" class="btn btn-primary btn-block">Salvar</button>
          </form>
        </div>
        <div class="modal-footer" id="botoesAddChecklist">
          
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="checklistAluno">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloChecklist">Contratos cadastrados</h5>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
        </div>
        <div class="modal-body" id="corpoChecklist">
          <form id="formChecklistSequencial">
            <button type="submit" class="btn btn-block btn-primary">Salvar checklist sequencial</button>
          
            <h3>Checklists Sequenciais</h3>
            
            <div id="checklistSequencial">
              <div>
                <h5>Livros</h5>
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="livro1" name="livro">
                  <label class="custom-control-label" for="customCheck1">Checkbox</label>
                </div>
                <hr>
              </div>
              
            </div>
            
            
          </form>

          <form id="formChecklistAcompanhamento">
            <button type="submit" class="btn btn-block btn-primary">Salvar checklist de acompanhamento</button>
            <h3>Checklists de Acompanhamento</h3>
            <div >
              <div class="container">
                <div class="row row-cols-2" id="checklistAcompanhamento">
                    
                </div>
               
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer" id="botoesChecklist">
          <!--<button type="button" class="btn btn-primary" onclick="window.frames['fichaPdf'].focus(), window.frames['fichaPdf'].print()">Imprimir</button>-->
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="chamados">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloChecklist">Chamados</h5>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
        </div>
        <div class="modal-body" id="corpoChecklist">
          <div class="container-xl">
            <div class="table-responsive">
              <div class="table-wrapper" style="height: 400px; overflow: scroll;">
                <div class="table-title">
                  <div class="row">
                    <div class="col-sm-6">
                      <h2><b>Lista de chamados</b></h2>
                    </div>
                    <div class="col-sm-6">
                      <a class="btn btn-primary" data-toggle="modal" id="btnAddChamado">&nbsp; <span class="feather-24" data-feather="refresh-cw"></span><span>Atualizar</span></a>
                                  
                    </div>
                  </div>
                </div>
                <table class="table table-striped table-hover" >
                  <thead>
                    <tr>
                      <th>
                        
                      </th>
                      <th>Assunto <span data-feather="help-circle" data-toggle="tooltip" data-placement="top" title="O assunto do chamado."></span> </th>
                      <th>Prioridade <span data-feather="help-circle" data-toggle="tooltip" data-placement="top" title="O nível de prioridade do chamado."></span></th>
                      <th>Data e hora de abertura <span data-feather="help-circle" data-toggle="tooltip" data-placement="top" title="O momento da abertura deste chamado"></span> </th>
                      <th>Situação <span data-feather="help-circle" data-toggle="tooltip" data-placement="left" title="As situações são: Pendente: Quando o suporte ainda não iniciou o atendimento. | Em análise: Quando o suporte iniciou o atendimento e está analisando o problema. | Terminado: Quando o suporte termina o atendimento e resolve ou não o problema."></span> </th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody id="listaChamados">
                    <tr>
                      <td>
                        
                      </td>
                      <td>Nenhum chamado encontrado.</td>
                      
                    </tr>
                  </tbody>
                </table>
                
              </div>
            </div>
          </div>
          <div id="camposAddChamados">
            <form id="formAddChamados">
              
                <h3>Abrir um chamado</h3>
                <div class="input-group has-validation">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Assunto</span>
                  </div>
                  <input type="text" class="form-control" required id="assunto" name="assunto">
                  <div class="invalid-feedback">
                    Escreva um assunto.
                  </div>
                  
                </div>
                <br>
                <div class="mb-3">
                  <label for="validationTextarea">Descrição</label>
                  <textarea class="form-control" id="descricao" name="descricao" placeholder="Descreva aqui..." required></textarea>
                
                  <small id="passwordHelpBlock" class="form-text text-muted">
                    Descreva com detalhes a sua solicitação. O suporte poderá, se necessário, entrar em contato para pedir mais informações sobre a solicitação.
                  </small>
                </div>
                <div class="mb-3">
                  <label for="imagens">Imagens/Prints</label><br>
                  <input type="file" id="imagens" name="imagens" accept="image/*" multiple>
                  
                </div>

                <label class="h5">Prioridade</label>
                <small id="passwordHelpBlock" class="form-text text-muted">
                  Não existem regras para a ordem de prioridade, porém contamos com seu senso e sinceridade para marcação de prioridade. Abaixo deixamos algumas sugestões e tempos de resposta aproximados.
                </small>
                <div class="custom-control custom-radio">
                  <span class="badge badge-pill badge-danger">Crítica</span></td>
                  <input type="radio" id="critica" name="prioridade" class="custom-control-input" value="3">
                  <label class="custom-control-label" for="critica">Prioridade máxima. Selecione esta prioridade caso não possa realizar uma ação crítica no sistema, como lançar notas, emitir um documento, ou outras situações onde é imprescindível o acesso à determinada informação. (Tempo de resposta: no mesmo dia ou em até 1 dia útil)</label>
                </div>
                <br>
                <div class="custom-control custom-radio">
                  <span class="badge badge-pill badge-warning">Alta</span></td>
                  <input type="radio" id="alta" name="prioridade" class="custom-control-input" value="2">
                  <label class="custom-control-label" for="alta">Prioridade alta. Selecione esta prioridade caso alguma funcionalidade não funcione corretamente, e apresenta erros continuamente, ou quando necessita de alguma nova funcionalidade urgentemente no sistema. (Tempo de Resposta: até 2 dias úteis)</label>
                </div>
                <br>
                <div class="custom-control custom-radio">
                  <span class="badge badge-pill badge-info">Média</span></td>
                  <input type="radio" id="media" name="prioridade" checked class="custom-control-input" value="1">
                  <label class="custom-control-label" for="media">Prioridade média. Selecione esta prioridade caso detecte demora no carregamento de certas informações, ou problemas com login/cadastro, ou ainda quando necessita de uma funcionalidade nova no sistema. (Tempo de Resposta: até 4 dias úteis) </label>
                </div>
                <br>
                <div class="custom-control custom-radio">
                  <span class="badge badge-pill badge-success">Baixa</span></td>
                  <input type="radio" id="baixa" name="prioridade" class="custom-control-input" value="0">
                  <label class="custom-control-label" for="baixa">Prioridade baixa. Selecione esta prioridade caso queira pontuar uma falha que não interrompa o fluxo normal de trabalho com o sistema, ou queira propor alguma melhoria ou funcionalidade extra no sistema (Tempo de Resposta: até 7 dias úteis) </label>
                </div>
                <br>
                <div class="input-group has-validation">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Nome</span>
                  </div>
                  <input type="text" class="form-control" required id="nome" name="nome">
                  <div class="invalid-feedback">
                    Escreva seu nome.
                  </div>
                  
                </div>
                <br>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">E-mail para contato</span>
                  </div>
                  <input type="email" class="form-control" required id="email" name="email">
                  <div class="invalid-feedback">
                    Escreva um email para contato.
                  </div>
                  
                </div>
              
              <br>
              <button class="btn btn-block btn-primary">Salvar e enviar chamado</button>
            </form>
          </div>

          <div id="areaEditaChamados" style="display: none;">
            <form id="formEditaChamados">
              <h3>Editar chamado</h3>
                <div class="input-group has-validation">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Assunto</span>
                  </div>
                  <input type="text" class="form-control" required id="assunto" name="assunto">
                  <div class="invalid-feedback">
                    Escreva um assunto.
                  </div>
                  
                </div>
                <br>
                <div class="mb-3">
                  <label for="validationTextarea">Descrição</label>
                  <textarea class="form-control" id="descricao" name="descricao" placeholder="Descreva aqui..." required></textarea>
                
                  <small id="passwordHelpBlock" class="form-text text-muted">
                    Descreva com detalhes a sua solicitação. O suporte poderá, se necessário, entrar em contato para pedir mais informações sobre a solicitação.
                  </small>
                </div>
                
                  
                <label class="h5">Prioridade</label>
                <small id="passwordHelpBlock" class="form-text text-muted">
                  Não existem regras para a ordem de prioridade, porém contamos com seu senso e sinceridade para marcação de prioridade. Abaixo deixamos algumas sugestões e tempos de resposta aproximados.
                </small>
                <div class="custom-control custom-radio">
                  <span class="badge badge-pill badge-danger">Crítica</span></td>
                  <input type="radio" id="critica" name="prioridade" class="custom-control-input" value="3">
                  <label class="custom-control-label" for="critica">Prioridade máxima. Selecione esta prioridade caso não possa realizar uma ação crítica no sistema, como lançar notas, emitir um documento, ou outras situações onde é imprescindível o acesso à determinada informação. (Tempo de resposta: no mesmo dia ou em até 1 dia útil)</label>
                </div>
                <br>
                <div class="custom-control custom-radio">
                  <span class="badge badge-pill badge-warning">Alta</span></td>
                  <input type="radio" id="alta" name="prioridade" class="custom-control-input" value="2">
                  <label class="custom-control-label" for="alta">Prioridade alta. Selecione esta prioridade caso alguma funcionalidade não funcione corretamente, e apresenta erros continuamente, ou quando necessita de alguma nova funcionalidade urgentemente no sistema. (Tempo de Resposta: até 2 dias úteis)</label>
                </div>
                <br>
                <div class="custom-control custom-radio">
                  <span class="badge badge-pill badge-info">Média</span></td>
                  <input type="radio" id="media" name="prioridade" checked class="custom-control-input" value="1">
                  <label class="custom-control-label" for="media">Prioridade média. Selecione esta prioridade caso detecte demora no carregamento de certas informações, ou problemas com login/cadastro, ou ainda quando necessita de uma funcionalidade nova no sistema. (Tempo de Resposta: até 4 dias úteis) </label>
                </div>
                <br>
                <div class="custom-control custom-radio">
                  <span class="badge badge-pill badge-success">Baixa</span></td>
                  <input type="radio" id="baixa" name="prioridade" class="custom-control-input" value="0">
                  <label class="custom-control-label" for="baixa">Prioridade baixa. Selecione esta prioridade caso queira pontuar uma falha que não interrompa o fluxo normal de trabalho com o sistema, ou queira propor alguma melhoria ou funcionalidade extra no sistema (Tempo de Resposta: até 7 dias úteis) </label>
                </div>
                <br>
              
              <br>
              <button class="btn btn-block btn-primary">Salvar alterações</button>
            </form>
          </div>
        </div>
        <div class="modal-footer" id="botoesChecklist">
          <!--<button type="button" class="btn btn-primary" onclick="window.frames['fichaPdf'].focus(), window.frames['fichaPdf'].print()">Imprimir</button>-->
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="escreverEmail">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Escrever e enviar email</h5>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
        </div>
        <form id="emailForm">
          <div class="modal-body" id="corpoEmail">
            <div class="form-group">
              <label for="toEmail">Para:</label>
              <input name="to" required type="email" id="toEmail" class="form-control demo-default selectized" placeholder="Para">
      
            </div>
            
            <div class="form-group">
              <label for="toEmail">Cc:</label>
              <input name="cc" id="ccEmail" type="email" class="form-control demo-default selectized" placeholder="Cc">
            </div>
            <div class="form-group">
              <label for="toEmail">Bcc:</label>
              <input name="bcc" id="bccEmail" type="email" class="form-control demo-default selectized" placeholder="Bcc">
            </div>
            <div class="form-group">
              <label for="toEmail">Assunto:</label>
              <input name="subject" type="text" class="form-control" placeholder="Assunto">
            </div>
            <div class="form-group">
              <label for="toEmail">Mensagem:</label>
              <textarea name="message" id="email_message" class="form-control" placeholder="Message" style="height: 120px;"></textarea>
            </div>
            <div class="form-group">
              <input type="file" name="attachment">
            </div>
          </div>
        
        <div class="modal-footer" id="botoesEmail">
          <button type="submit" class="btn btn-primary">Enviar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </form>
      </div>
    </div>
  </div>
