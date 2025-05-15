
    <div class="form-group">
        <label for="aluno_id">Aluno</label>
        <select id="aluno_id" name="aluno_id" class="form-control" style="width: 100%"></select>
    </div>  
    <input type="hidden" name="aluno_id" id="aluno_id">
    
    <div class="form-group">
        <label for="mensalidade_ids">Mensalidades em aberto</label>
        <select name="mensalidade_id[]" id="mensalidade_ids" class="form-control" multiple></select>
    </div>
    
        <div class="mb-3">
            <label for="data_pagamento" class="form-label">Data de Pagamento</label>
            <input type="date" name="data_pagamento" class="form-control" required>
        </div>

       
  <div class="mb-3">
    <label for="valor_pago">Valor Total (Kz)</label>
    <input type="number" step="0.01" name="valor_pago" id="valor_pago" class="form-control" readonly>
  </div> 

        <div class="form-group col-auto">
            <label for="forma_pagamento" class="form-label">Forma de Pagamento</label>
            <select name="forma_pagamento" class="form-control" required>
                <option value="Dinheiro">Dinheiro</option>
                <option value="Transferência">Transferência</option>
                <option value="POS">POS</option>
                <option value="Multicaixa Express">Multicaixa Express</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="referencia" class="form-label">Referência (Opcional)</label>
            <input type="text" name="referencia" class="form-control">
        </div>

