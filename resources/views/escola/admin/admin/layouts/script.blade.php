
   <!-- script do btn  -->
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
 <!-- FIM -->

  <!-- script de toda as logicas do salaruio-->
<script>
$(document).ready(function () {
    function calcularSalarioTotal() {
        const salarioBase = parseFloat($('#salario_base').val()) || 0;
        const bonificacoes = parseFloat($('#bonus').val()) || 0;
        const descontos = parseFloat($('#descontos').val()) || 0;
        const total = salarioBase + bonificacoes - descontos;
        $('#total_receber').val(total.toFixed(2));
    }

    $('#funcionario-select').select2({
        placeholder: 'Digite o nome do funcionário...',
        minimumInputLength: 2,
        ajax: {
            url: '{{ route('funcionarios.buscar') }}',
            dataType: 'json',
            delay: 300,
            data: function (params) {
                return {
                    q: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data.results
                };
            }
        }
    });

    $('#funcionario-select').on('select2:select', function (e) {
        const data = e.params.data;
        $('#salario_base').val(data.salario_base);
        calcularSalarioTotal();
    });

    $('#bonus, #descontos').on('input', function () {
        calcularSalarioTotal();
    });

     $('#funcionario-select').on('select2:select', function (e) {
    const data = e.params.data;
    $('#salario_base').val(data.salario_base);
    $('#cargo').val(data.cargo);
    calcularSalarioTotal();
});
});
</script>
 <!-- FIM-->

  <!-- Script de mensagem em tempo real -->
<script>
    import Echo from 'laravel-echo';
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: "your-app-key",
    cluster: "mt1",
    encrypted: true
});

Echo.private(`conversas.${conversationId}`)
    .listen('NovaMensagemEnviada', (e) => {
        // Exibir mensagem nova ou alerta
        appendNovaMensagem(e.message);
        tocarSomNotificacao();
    });

    Echo.private(`conversas.${userId}`)
    .listen('NovaMensagemEnviada', (e) => {
        if (!window.location.href.includes(`/conversas/${e.message.conversation_id}`)) {
            // Exibir notificação
            showToast(`Nova mensagem de ${e.message.sender.nome}: "${e.message.body}"`);
        }
    });

function showToast(mensagem) {
    const toast = document.createElement('div');
    toast.className = 'toast-notification';
    toast.innerHTML = mensagem;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 5000);
}
</script>
 <!-- FIM -->

  <!-- Inicializando o Select2 da mensagem -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#receiver_type').on('change', function () {
        const tipo = $(this).val();

        $('#receiver_id').val(null).trigger('change'); // Limpa o select
        $('#receiver_id').select2({
            ajax: {
                url: '{{ route("chat.buscar.usuarios") }}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        tipo: tipo,
                        q: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(user => ({
                            id: user.id,
                            text: user.nome
                        }))
                    };
                },
                cache: true
            },
            placeholder: 'Selecione o usuário...',
            minimumInputLength: 0
        });
    });

    // Inicializa o Select2
    $('#receiver_id').select2({
        placeholder: 'Selecione o usuário...'
    });
</script>
 <!-- Fim -->

 <!-- Script da conversa de mensagem view show -->
 <script>
    const chatBox = document.getElementById('chat-box');
    chatBox.scrollTop = chatBox.scrollHeight;
</script>
<script>
    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const body = this.dataset.body;

            const form = document.getElementById('edit-message-form');
            const textarea = document.getElementById('edit-message-body');

            textarea.value = body;
            form.action = `/chat/messages/${id}`;

            const modal = new bootstrap.Modal(document.getElementById('editMessageModal'));
            modal.show();
        });
    });
</script>
