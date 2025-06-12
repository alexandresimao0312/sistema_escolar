
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Eugenia Gonsalves</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            margin: 0;
            padding: 0;
            color: #000;
        }

        .container {
            width: 90%;
            margin: auto;
            padding: 20px;
            border: 1px solid #000;
        }

        .header {
            text-align: center;
            border-bottom: 1px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header img {
            max-height: 70px;
            margin-bottom: 10px;
        }

        .header h2, .header h4 {
            margin: 0;
        }

        .info-section {
            margin-bottom: 20px;
        }

        .info-section h4 {
            margin-bottom: 10px;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .label {
            font-weight: bold;
        }

        .total {
            font-size: 15px;
            font-weight: bold;
            text-align: right;
            border-top: 1px solid #000;
            padding-top: 10px;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
        }

        .assinatura {
            margin-top: 50px;
            text-align: left;
        }

        .assinatura span {
            display: block;
            border-top: 1px solid #000;
            width: 200px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Cabeçalho da escola -->
        <div class="header">
            <img src="{{ public_path('images/eugenia_gonsalves.webp') }}" alt="Logo da Escola">
         <h2>Instituto Politécnico Privado Eugenia Gonsalves</h2>
            <h4>Escola do Ensino Médio Técnico Profissional</h4>
            <h4>NIF: 123456789 | Tel: +244 933 045 587</h4>
            <p>Rua Principal nº 123, Luanda, Angola</p>
        </div>

        @yield('conteudo')

        <!-- Rodapé -->
      
        <div class="footer">
            <p>Este recibo é válido sem rasuras e representa o pagamento oficial referente ao período mencionado.</p>
        </div>

        <br><br>

    <div class="linha">Assinatura do Responsável: _____________________________</div>
    </div>
</body>
</html>

