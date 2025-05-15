<div class="form-row">
    <div class="form-group col-sm-2">
      <label for="inputEmail4">Matrícula</label>
      <input type="number" class="form-control" id="matriculaAluno" name="" placeholder="Número de matrícula">
    </div>
    <div class="form-group col-md-4">
      <label for="inputPassword4">Nome</label>
      <input type="name" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome', $aluno->nome ?? '') }}">
      @error('nome')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>
    <div class="form-group col-auto">
      <label for="inputPassword4">Data de nascimento</label>
      <input type="date" class="form-control  @error('data_nascimento') is-invalid @enderror"  id="dataNascimentoAluno" name="data_nascimento" placeholder="Data" value="{{ old('data_nascimento', $aluno->data_nascimento ?? '') }}">
      @error('data_nascimento')
      <div class="invalid-feedback">{{ $message }}</div>
  @enderror
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-auto">
      <label for="inputEmail4">Telefone</label>
      <input type="phone"  class="form-control  @error('telefone') is-invalid @enderror"  name="telefone" placeholder="Número" value="{{ old('telefone', $aluno->telefone ?? '') }}">
      @error('telefone')
      <div class="invalid-feedback">{{ $message }}</div>
  @enderror
    </div>
    <div class="form-group col-auto">
        <label for="inputAddress">Gênero</label>
        <select class="form-control @error('genero') is-invalid @enderror" name="genero" id="turmaAluno">
            <option value="Masculino" {{ old('genero', $aluno->genero ?? '') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
            <option value="Feminino" {{ old('genero', $aluno->genero ?? '') == 'Feminino' ? 'selected' : '' }}>Feminino</option>
        </select>
        @error('genero')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
      </div>
    <div class="form-group col-md-5">
      <label for="inputPassword4">Email</label>
      <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email', $aluno->email ?? '') }}">
      @error('email')
      <div class="invalid-feedback">{{ $message }}</div>
  @enderror
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputEmail4">Senha de acesso ao portal</label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <input type="checkbox" aria-label="Mostra e esconde a senha" onclick="this.checked ? (document.getElementById('senhaAluno').type = 'text'):(document.getElementById('senhaAluno').type = 'password')">
          </div>
        </div>
        <input type="password" class="form-control" id="senhaAluno" name="senhaAluno" placeholder="Senha">
      </div>
      <small id="senhaHelp" class="form-text text-muted">A senha precisa ter no mínimo 6 caracteres.</small>
    </div>
    <div class="form-group col-auto">
      <label for="inputEmail4">Endereço</label>
      <input type="text" class="form-control @error('endereco') is-invalid @enderror" id="rgAluno" name="endereco" placeholder="Endereço" value="{{ old('endereco', $aluno->endereco ?? '') }}">
      @error('endereco')
      <div class="invalid-feedback">{{ $message }}</div>
  @enderror
    </div>
    <div class="form-group col-auto">
      <label for="inputPassword4">NIF ou Cedula</label>
      <input type="text" class="form-control @error('nif') is-invalid @enderror" id="cpfAluno" name="nif" placeholder="Bilhete ou Cedula" value="{{ old('nif', $aluno->nif ?? '') }}">
      @error('nif')
      <div class="invalid-feedback">{{ $message }}</div>
   @enderror
    </div>
  </div>
    <label class="h6">Gerar de documentos no ato do cadastro?</label>
    <div class="form-group">
      <div class="custom-control custom-checkbox">
        <input class="custom-control-input" type="checkbox" id="geraPDFAluno" name="geraPDFAluno">
        <label class="custom-control-label" for="geraPDFAluno">
          Gerar ficha de matrícula
        </label>
      </div>
    </div>
    <div class="form-group">
      <div class="custom-control custom-checkbox">
        <input class="custom-control-input" type="checkbox" id="geraBoleto" name="geraBoleto">
        <label class="custom-control-label" for="geraBoleto">
          Gerar boletos/carnê de pagamento
        </label>
      </div>
    </div>
  </section>