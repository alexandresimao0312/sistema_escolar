<div class="container" onload="carregaDadosParaDashboard()">
    <!--<button type="button" class="btn btn-light btn-sm">
      Alunos cadastrados <span class="badge badge-primary" id="alunosCadastradosNum">0</span>
    </button>-->
    <button type="button" class="btn btn-light btn-sm" onclick="document.getElementById('btnAbaAlunos').click()">
     Total de Alunos <span class="badge badge-success" id="alunosMatriculadosNum">{{ $totalAlunos }}</span>
    </button>
    <button type="button" class="btn btn-light btn-sm" onclick="document.getElementById('btnAbaAlunosDesativados').click()">
        Total de Matrículas <span class="badge badge-success" id="alunosDesativadosNum">{{ $totalMatriculas }}</span>
    </button>
    <button type="button" class="btn btn-light btn-sm" onclick="document.getElementById('btnAbaTurmas').click()">
        Mensalidades Pagas <span class="badge badge-success" id="turmasCadastradasNum">{{ $mensalidadesPagas }}</</span>
    </button>
    <button type="button" class="btn btn-light btn-sm" onclick="document.getElementById('btnAbaTurmas').click()">
        Mensalidades Pendentes <span class="badge badge-danger" id="turmasCadastradasNum">{{ $mensalidadesPendentes }}</span>
      </button>
  </div>
