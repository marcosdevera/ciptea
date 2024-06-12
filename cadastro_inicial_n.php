<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pessoa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('images/background_login2.webp') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }
        input[type="text"], input[type="date"], input[type="number"], input[type="password"], input[type="submit"], select, input[type="file"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            border-radius: 20px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .step {
            display: none;
        }
        .step.active {
            display: block;
        }
        .progress-bar {
            background-color: #e0e0e0;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .progress {
            height: 20px;
            background-color: #007bff;
            border-radius: 5px;
            width: 0;
            transition: width 0.3s;
        }
        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .buttons button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 20px;
            border: none;
        }
        .buttons .next {
            background-color: #007bff;
            color: #fff;
        }
        .buttons .next:hover {
            background-color: #0056b3;
        }
        .buttons .prev {
            background-color: #ccc;
            color: #333;
        }
        .buttons .prev:hover {
            background-color: #999;
        }
        .section-title {
            font-size: 20px;
            margin-top: 20px;
            color: #007bff;
        }
        .radio-group {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .radio-group label {
            font-size: 16px;
        }
        .radio-group input[type="radio"] {
            margin-right: 5px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 150px;
        }
        .representante_legal {
            display: none;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="images/ciptea.png" alt="CIPTEA Logo">
        </div>
        <div class="progress-bar">
            <div class="progress"></div>
        </div>
        <form name="form" id="registrationForm" action="processamento/processar_usuario_n.php" method="POST" enctype="multipart/form-data" onsubmit="return validarSenhas()">
            <div class="step active" id="step1">
                <h2>Informações Pessoais</h2>
                <label for="vch_nome">Nome:</label>
                <input type="text" name="vch_nome" id="vch_nome" required>
                <label for="vch_nome_social">Nome Social:</label>
                <input type="text" name="vch_nome_social" id="vch_nome_social">
                <label for="sexo">Sexo:</label>
                <div class="radio-group">
                    <input type="radio" name="sexo" id="sexo_m" value="1" required><label for="sexo_m">Masculino</label>
                    <input type="radio" name="sexo" id="sexo_f" value="2" required><label for="sexo_f">Feminino</label>
                </div>
                <label for="sdt_nascimento">Data de Nascimento:</label>
                <input type="date" name="sdt_nascimento" id="sdt_nascimento" required>
            </div>
            <div class="step" id="step2">
                <h2>Contato e Documento</h2>
                <label for="vch_telefone">Telefone:</label>
                <input type="text" name="vch_telefone" id="vch_telefone" oninput="aplicarMascaraTelefone('vch_telefone')" maxlength="15" required>
                <label for="vch_cpf">CPF:</label>
                <input type="text" name="vch_cpf" id="vch_cpf" oninput="formatarCPF('vch_cpf')" onblur="validarCPFOnBlur('vch_cpf')" maxlength="14" required>
                <label for="vch_rg">RG:</label>
                <input type="text" name="vch_rg" id="vch_rg" onkeyup="formatarRG()" maxlength="13" required>
            </div>
            <div class="step" id="step3">
                <h2>Endereço</h2>
                <label for="endereco">Endereço:</label>
                <input type="text" name="endereco" id="endereco" required>
                <label for="bairro">Bairro:</label>
                <input type="text" name="bairro" id="bairro" required>
                <label for="cep">CEP:</label>
                <input type="text" name="cep" id="cep" oninput="aplicarMascaraCEP('cep')" maxlength="9" required>
                <label for="cidade">Cidade:</label>
                <input type="text" name="cidade" id="cidade" required>
            </div>
            <div class="step" id="step4">
                <h2>Possui Representante Legal?</h2>
                <label for="bool_representante_legal">Possui Representante Legal?</label>
                <select name="bool_representante_legal" id="bool_representante_legal" required>
                    <option value="">Selecione...</option>
                    <option value="0">Não</option>
                    <option value="1">Sim</option>
                </select>
                <div class="representante_legal">
                    <h3>Informações do Representante Legal</h3>
                    <label for="vch_nome_reponsavel">Nome do Responsável Legal:</label>
                    <input type="text" name="vch_nome_reponsavel" id="vch_nome_reponsavel">

                    <label for="sexo_responsavel_legal">Sexo do Responsável:</label>
                    <div class="radio-group">
                        <input type="radio" name="sexo_responsavel" id="sexo_responsavel_m" value="1"><label for="sexo_responsavel_m">Masculino</label>
                        <input type="radio" name="sexo_responsavel" id="sexo_responsavel_f" value="2"><label for="sexo_responsavel_f">Feminino</label>
                    </div>

                    <label for="vch_telefone_responsavel">Telefone do Responsável Legal:</label>
                    <input type="text" name="vch_telefone_responsavel" id="vch_telefone_responsavel" oninput="aplicarMascaraTelefone('vch_telefone_responsavel')" maxlength="15">

                    <label for="vch_cpf_responsavel">CPF do Responsável Legal:</label>
                    <input type="text" name="vch_cpf_responsavel" id="vch_cpf_responsavel" oninput="formatarCPF('vch_cpf_responsavel')" onblur="validarCPFOnBlur('vch_cpf_responsavel')" maxlength="14">

                    <label for="vch_cep_responsavel">CEP do Responsável Legal:</label>
                    <input type="text" name="vch_cep_responsavel" id="vch_cep_responsavel" oninput="aplicarMascaraCEP('vch_cep_responsavel')" maxlength="9">

                    <label for="vch_endereco_responsavel">Endereço do Responsável Legal:</label>
                    <input type="text" name="vch_endereco_responsavel" id="vch_endereco_responsavel">

                    <label for="comp_responsavel">Complemento:</label>
                    <input type="text" name="comp_responsavel" id="comp_responsavel">

                    <label for="vch_bairro_responsavel">Bairro do Responsável Legal:</label>
                    <input type="text" name="vch_bairro_responsavel" id="vch_bairro_responsavel">

                    <label for="vch_cidade_responsavel">Cidade do Responsável Legal:</label>
                    <input type="text" name="vch_cidade_responsavel" id="vch_cidade_responsavel">
                </div>
            </div>
            <div class="step" id="step5">
                <h2>Informações de Acesso</h2>
                <label for="vch_login">Email (Será utilizado para acessar o sistema):</label>
                <input type="text" name="vch_login" id="vch_login" onblur="verificarLogin()" onclick="exibirAlerta()">
                <label for="vch_senha">Criar senha de acesso (mínimo de 8 caracteres):</label>
                <input type="password" name="vch_senha" id="vch_senha" minlength="8" required>
                <label for="vch_confirm_senha">Confirmar senha de acesso:</label>
                <input type="password" name="vch_confirm_senha" id="vch_confirm_senha" minlength="8" required>
                <input type="checkbox" id="showPassword"> Mostrar senha
            </div>
            <div class="buttons">
                <button type="button" class="prev" onclick="nextPrev(-1)">Anterior</button>
                <button type="button" class="next" onclick="nextPrev(1)">Próximo</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var currentStep = 0;
        showStep(currentStep);

        function showStep(n) {
            var steps = document.getElementsByClassName("step");
            steps[n].style.display = "block";
            updateProgressBar(n);
            if (n == 0) {
                document.querySelector(".prev").style.display = "none";
            } else {
                document.querySelector(".prev").style.display = "inline";
            }
            if (n == (steps.length - 1)) {
                document.querySelector(".next").innerHTML = "Cadastrar";
            } else {
                document.querySelector(".next").innerHTML = "Próximo";
            }
        }

        function nextPrev(n) {
            var steps = document.getElementsByClassName("step");
            steps[currentStep].style.display = "none";
            currentStep = currentStep + n;
            if (currentStep >= steps.length) {
                document.getElementById("registrationForm").submit();
                return false;
            }
            showStep(currentStep);
        }

        function updateProgressBar(n) {
            var progress = document.querySelector(".progress");
            var steps = document.getElementsByClassName("step");
            var percent = ((n + 1) / steps.length) * 100;
            progress.style.width = percent + "%";
        }

        $(document).ready(function(){
            $('#showPassword').change(function(){
                var passwordField = $('#vch_senha');
                var confirmPasswordField = $('#vch_confirm_senha');
                if($(this).is(':checked')) {
                    passwordField.attr('type', 'text');
                    confirmPasswordField.attr('type', 'text');
                } else {
                    passwordField.attr('type', 'password');
                    confirmPasswordField.attr('type', 'password');
                }
            });

            $('#vch_login').blur(function() {
                verificarLogin();
            });

            $('#bool_representante_legal').change(function(){
                if($(this).val() == '1'){
                    $('.representante_legal').show();
                } else {
                    $('.representante_legal').hide();
                }
            });
        });

        function exibirAlerta() {
            var alertDiv = document.getElementById("alert-message");
            alertDiv.style.display = "block";
        }

        function verificarLogin() {
            var login = document.getElementById('vch_login').value;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'processamento/verificar_login.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    if (response === '1') {
                        alert('Este login já está vinculado a um CPF, por favor, tente a recuperação de senha, ou um outro email.');
                    }
                }
            };
            xhr.send('login=' + login);
        }

        function validarSenhas() {
            var senha = document.getElementById("vch_senha").value;
            var confirmacao = document.getElementById("vch_confirm_senha").value;
            if (senha !== confirmacao) {
                alert("As senhas digitadas não são iguais. Para realizar o cadastro, as senhas precisam ser iguais.");
                return false;
            }
            return true;
        }

        function formatCPF(cpf) {
            cpf = cpf.replace(/\D/g, ''); 
            cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); 
            cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); 
            cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2'); 
            return cpf;
        }

        function validarCPF(cpf) {
            cpf = cpf.replace(/\D/g, ''); 
            if (cpf.length !== 11) return false;

            var cpfArray = cpf.split('').map(Number);
            var sum = 0;
            var mod;

            for (var i = 0, j = 10; i < 9; i++, j--) {
                sum += cpfArray[i] * j;
            }
            mod = sum % 11;
            var firstDigit = mod < 2 ? 0 : 11 - mod;
            if (cpfArray[9] !== firstDigit) return false;

            sum = 0;
            for (var i = 0, j = 11; i < 10; i++, j--) {
                sum += cpfArray[i] * j;
            }
            mod = sum % 11;
            var secondDigit = mod < 2 ? 0 : 11 - mod;
            if (cpfArray[10] !== secondDigit) return false;
            if (cpf.length !== 11 || 
                cpf === '00000000000' || 
                cpf === '11111111111' || 
                cpf === '22222222222' || 
                cpf === '33333333333' || 
                cpf === '44444444444' || 
                cpf === '55555555555' || 
                cpf === '66666666666' || 
                cpf === '77777777777' || 
                cpf === '88888888888' || 
                cpf === '99999999999') {
                return false;
            }

            return true;
        }

        function formatarCPF(inputId) {
            var cpfInput = document.getElementById(inputId);
            cpfInput.value = formatCPF(cpfInput.value);
        }

        function validarCPFOnBlur(inputId) {
            var cpfInput = document.getElementById(inputId);
            var cpf = cpfInput.value.replace(/\D/g, '');
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'processamento/verificar_cpf.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    if (response === '1') {
                        if (confirm('CPF já cadastrado. Para recuperar a senha, clique em "OK" para ser redirecionado para a Aba de recuperação de senha.')) {
                            window.location.href = 'recuperar_senha.php';
                        }
                        cpfInput.value = ''; 
                    }
                }
            };
            xhr.send('cpf=' + cpf);

            var isValid = validarCPF(cpf);
            if (!isValid) {
                alert('CPF inválido');
                cpfInput.value = ''; 
            }
        }

        function formatarRG() {
            var rgInput = document.getElementById('vch_rg');
            var rg = rgInput.value.replace(/\D/g, ''); 

            if (rg.length > 2) {
                rg = rg.substring(0, 2) + '.' + rg.substring(2);
            }
            if (rg.length > 6) {
                rg = rg.substring(0, 6) + '.' + rg.substring(6);
            }
            if (rg.length > 10) {
                rg = rg.substring(0, 10) + '-' + rg.substring(10);
            }

            rgInput.value = rg;
        }

        function formatarCNS() {
            var cnsInput = document.getElementById('vch_num_cartao_sus');
            var cns = cnsInput.value.replace(/\D/g, ''); 

            if (cns.length > 3) {
                cns = cns.substring(0, 3) + ' ' + cns.substring(3);
            }
            if (cns.length > 8) {
                cns = cns.substring(0, 8) + ' ' + cns.substring(8);
            }
            if (cns.length > 13) {
                cns = cns.substring(0, 13) + ' ' + cns.substring(13);
            }

            cnsInput.value = cns;
        }

        function formatarCEP(cep) {
            cep = cep.replace(/\D/g, '');
            cep = cep.replace(/^(\d{5})(\d{1})/, '$1-$2');
            return cep;
        }

        function aplicarMascaraCEP(inputId) {
            var inputCEP = document.getElementById(inputId);
            var cep = inputCEP.value;
            inputCEP.value = formatarCEP(cep);
        }

        function formatarTelefone(telefone) {
            telefone = telefone.replace(/\D/g, '');
            if (telefone.length === 11) {
                telefone = telefone.replace(/^(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            } else if (telefone.length === 10) {
                telefone = telefone.replace(/^(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
            } else if (telefone.length === 9) {
                telefone = telefone.replace(/^(\d{5})(\d{4})/, '$1-$2');
            } else if (telefone.length === 8) {
                telefone = telefone.replace(/^(\d{4})(\d{4})/, '$1-$2');
            }
            return telefone;
        }

        function aplicarMascaraTelefone(id) {
            var inputTelefone = document.getElementById(id);
            var telefone = inputTelefone.value;
            inputTelefone.value = formatarTelefone(telefone);
        }
    </script>
</body>
</html>