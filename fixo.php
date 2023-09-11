<!DOCTYPE html>
<html>
<head>
    <style>
        .form-container1 {
            display: grid;
            grid-template-columns: 120px auto;
            gap: 10px;
            margin-bottom: 10px;
            width: 500px;
        }
        .form-container2 {
            display: grid;
            grid-template-columns: 120px auto;
            gap: 10px;
            margin-bottom: 10px;
            width: 500px;
        }
        .form-container3 {
            display: grid;
            grid-template-columns: 120px auto;
            gap: 10px;
            margin-bottom: 10px;
            width: 500px;
        }

        #form1 {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        width: 500px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        #form2 {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        width: 500px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        #form3 {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        width: 500px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        h2 {
            margin-top: 30px;
        }
 


  
    </style>
</head>
<body>
    <header>
        <h1>Formulários</h1>
    </header>
    <link rel="stylesheet" href="style.css">
    <h2>Formulário I</h2>
    <form id="form1" onsubmit="addForm1Data(event)">
        <div class="form-container1">
            <label for="contrato">Contrato:</label>
            <input type="text" id="contrato" required>
        </div>
        <div class="form-container1">
            <label for="contratada">Contratada:</label>
            <input type="text" id="contratada" required>
        </div>
        <div class="form-container1">
            <label for="objeto">Objeto:</label>
            <input type="text" id="objeto" required>
        </div>
        <div class="form-container1">
            <label for="valor_contratual">Valor Contratual:</label>
            <input type="text" id="valor_contratual" required>
        </div>
        <div class="form-container1">
            <label for="saldo">Saldo:</label>
            <input type="text" id="saldo" required>
        </div>
        <button type="submit">Adicionar</button>
    </form>

    <h2>Tabela de Dados do Formulário I</h2>
    <table id="form1-data">
        <tr>
            <th>Contrato</th>
            <th>Contratada</th>
            <th>Objeto</th>
            <th>Valor Contratual</th>
            <th>Saldo</th>
        </tr>
    </table>

    <h2>Formulário II</h2>
    <form id="form2" onsubmit="addForm2Data(event)">
        <div class="form-container2">
            <label for="processo">Processo:</label>
            <input type="text" id="processo" required>
        </div>
        <div class="form-container2">
            <label for="portaria">Portaria:</label>
            <input type="text" id="portaria" required>
        </div>
        <div class="form-container2">
            <label for="inicio">Início:</label>
            <input type="text" id="inicio" pattern="\d{2}/\d{2}/\d{4}" required>
            
        </div>
        <div class="form-container2">
            <label for="expiracao">Expiração:</label>
            <input type="text" id="expiracao" pattern="\d{2}/\d{2}/\d{4}" required>
        
        </div>
        <button type="submit">Adicionar</button>
    </form>

    <h2>Tabela de Dados do Formulário II</h2>
    <table id="form2-data">
        <tr>
            <th>Processo</th>
            <th>Portaria</th>
            <th>Início</th>
            <th>Expiração</th>
        </tr>
    </table>

    <h2>Formulário III</h2>
    <form id="form3" onsubmit="addForm3Data(event)">
        <div class="form-container3">
            <label for="termo_aditivo">Termo Aditivo:</label>
            <input type="text" id="termo_aditivo" required>
        </div>
        <button type="submit">Adicionar</button>
    </form>

    <h2>Tabela de Dados do Formulário III</h2>
    <table id="form3-data">
        <tr>
            <th>Termo Aditivo</th>
        </tr>
    </table><br><br><br>
    <a href="index.php">Voltar</a>
 

    <script>
        // Função para adicionar os dados do Formulário I à tabela
        function addForm1Data(event) {
            event.preventDefault();

            // Obter os valores do formulário
            const contrato = document.getElementById('contrato').value;
            const contratada = document.getElementById('contratada').value;
            const objeto = document.getElementById('objeto').value;
            const valorContratual = document.getElementById('valor_contratual').value;
            const saldo = document.getElementById('saldo').value;

            // Adicionar os valores à tabela
            const table = document.getElementById('form1-data');
            const newRow = table.insertRow();
            newRow.innerHTML = `
                <td>${contrato}</td>
                <td>${contratada}</td>
                <td>${objeto}</td>
                <td>${valorContratual}</td>
                <td>${saldo}</td>
            `;

            // Armazenar os dados no Local Storage
            const form1Data = JSON.parse(localStorage.getItem('form1Data')) || [];
            form1Data.push({
                contrato,
                contratada,
                objeto,
                valorContratual,
                saldo
            });
            localStorage.setItem('form1Data', JSON.stringify(form1Data));

            // Limpar os campos do formulário
            document.getElementById('contrato').value = '';
            document.getElementById('contratada').value = '';
            document.getElementById('objeto').value = '';
            document.getElementById('valor_contratual').value = '';
            document.getElementById('saldo').value = '';
        }

        // Função para recuperar os dados do Formulário I do Local Storage e preencher a tabela
        function populateForm1Table() {
            const form1Data = JSON.parse(localStorage.getItem('form1Data')) || [];
            const table = document.getElementById('form1-data');
            table.innerHTML = '';
            form1Data.sort((a, b) => b.contrato.localeCompare(a.contrato)); // Ordena os dados de maneira decrescente
            form1Data.forEach(data => {
                const newRow = table.insertRow();
                newRow.innerHTML = `
                    <td>${data.contrato}</td>
                    <td>${data.contratada}</td>
                    <td>${data.objeto}</td>
                    <td>${data.valorContratual}</td>
                    <td>${data.saldo}</td>
                `;
            });
        }

        // Função para adicionar os dados do Formulário II à tabela
        function addForm2Data(event) {
            event.preventDefault();

            // Obter os valores do formulário
            const processo = document.getElementById('processo').value;
            const portaria = document.getElementById('portaria').value;
            const inicio = document.getElementById('inicio').value;
            const expiracao = document.getElementById('expiracao').value;

            // Adicionar os valores à tabela
            const table = document.getElementById('form2-data');
            const newRow = table.insertRow();
            newRow.innerHTML = `
                <td>${processo}</td>
                <td>${portaria}</td>
                <td>${inicio}</td>
                <td>${expiracao}</td>
            `;

            // Armazenar os dados no Local Storage
            const form2Data = JSON.parse(localStorage.getItem('form2Data')) || [];
            form2Data.push({
                processo,
                portaria,
                inicio,
                expiracao
            });
            localStorage.setItem('form2Data', JSON.stringify(form2Data));

            // Limpar os campos do formulário
            document.getElementById('processo').value = '';
            document.getElementById('portaria').value = '';
            document.getElementById('inicio').value = '';
            document.getElementById('expiracao').value = '';
        }

        // Função para recuperar os dados do Formulário II do Local Storage e preencher a tabela
        function populateForm2Table() {
            const form2Data = JSON.parse(localStorage.getItem('form2Data')) || [];
            const table = document.getElementById('form2-data');
            table.innerHTML = '';
            form2Data.sort((a, b) => b.processo.localeCompare(a.processo)); // Ordena os dados de maneira decrescente
            form2Data.forEach(data => {
                const newRow = table.insertRow();
                newRow.innerHTML = `
                    <td>${data.processo}</td>
                    <td>${data.portaria}</td>
                    <td>${data.inicio}</td>
                    <td>${data.expiracao}</td>
                `;
            });
        }

        // Função para adicionar os dados do Formulário III à tabela
        function addForm3Data(event) {
            event.preventDefault();

            // Obter o valor do formulário
            const termoAditivo = document.getElementById('termo_aditivo').value;

            // Adicionar o valor à tabela
            const table = document.getElementById('form3-data');
            const newRow = table.insertRow();
            newRow.innerHTML = `
                <td>${termoAditivo}</td>
            `;

            // Armazenar os dados no Local Storage
            const form3Data = JSON.parse(localStorage.getItem('form3Data')) || [];
            form3Data.push({
                termoAditivo
            });
            localStorage.setItem('form3Data', JSON.stringify(form3Data));

            // Limpar o campo do formulário
            document.getElementById('termo_aditivo').value = '';
        }

        // Função para recuperar os dados do Formulário III do Local Storage e preencher a tabela
        function populateForm3Table() {
            const form3Data = JSON.parse(localStorage.getItem('form3Data')) || [];
            const table = document.getElementById('form3-data');
            table.innerHTML = '';
            form3Data.sort((a, b) => b.termoAditivo.localeCompare(a.termoAditivo)); // Ordena os dados de maneira decrescente
            form3Data.forEach(data => {
                const newRow = table.insertRow();
                newRow.innerHTML = `
                    <td>${data.termoAditivo}</td>
                `;
            });
        }

        // Preencher as tabelas quando a página carrega
        populateForm1Table();
        populateForm2Table();
        populateForm3Table();
    </script>
</body>
</html>
