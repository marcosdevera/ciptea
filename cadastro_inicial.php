<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pessoa</title>
    <link rel="icon" href="images/imagemtopo.png" type="image/png">
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

        .step {
            display: none;
        }

        .step.active {
            display: block;
            animation: fadeIn 0.5s;
        }

        .step.finished {
            display: block;
            animation: fadeOut 0.5s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
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

        .progress.complete {
            background-color: #28a745;
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

        .is-invalid {
            border-color: red;
        }

        .radio-group input.is-invalid + label {
            color: red;
        }

        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }

        .btn-error {
            animation: shake 0.5s;
            background-color: red !important;
        }

        @keyframes shake {
            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            50% {
                transform: translateX(5px);
            }

            75% {
                transform: translateX(-5px);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header text-center">
            <img src="images/ciptea.png" alt="CIPTEA Logo" class="img-fluid">
        </div>
        <div class="progress-bar">
            <div class="progress"></div>
        </div>
        <form name="form" id="registrationForm" action="processamento/processar_usuario.php" method="POST" enctype="multipart/form-data" onsubmit="return validarFormulario()">
            <div class="step active" id="step1">
                <h2>Informações Pessoais</h2>
                <div class="form-group">
                    <label for="vch_nome">Nome:</label>
                    <input type="text" class="form-control" name="vch_nome" id="vch_nome" required>
                </div>
                <div class="form-group">
                    <label for="vch_nome_social">Nome Social (caso tenha):</label>
                    <input type="text" class="form-control" name="vch_nome_social" id="vch_nome_social">
                </div>
                <div class="form-group">
                    <label for="sexo">Sexo:</label>
                    <div class="radio-group">
                        <input type="radio" name="sexo" id="sexo_m" value="1" required><label for="sexo_m">Masculino</label>
                        <input type="radio" name="sexo" id="sexo_f" value="2" required><label for="sexo_f">Feminino</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="sdt_nascimento">Data de Nascimento:</label>
                    <input type="date" class="form-control" name="sdt_nascimento" id="sdt_nascimento" required>
                </div>
            </div>
            <div class="step" id="step2">
                <h2>Endereço</h2>
                <div class="form-group">
                    <label for="cep">CEP:</label>
                    <input type="text" class="form-control" name="cep" id="cep" oninput="aplicarMascaraCEP('cep')" maxlength="9" required onblur="buscarEndereco('cep', 'endereco', 'bairro', 'cidade', 'cepError')">
                    <div id="cepError" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="endereco">Endereço:</label>
                    <input type="text" class="form-control" name="endereco" id="endereco" required>
                </div>
                <div class="form-group">
                    <label for="bairro">Bairro:</label>
                    <input type="text" class="form-control" name="bairro" id="bairro" required>
                </div>
                <div class="form-group">
                    <label for="cidade">Cidade:</label>
                    <input type="text" class="form-control" name="cidade" id="cidade" required>
                </div>
            </div>
            <div class="step" id="step3">
                <h2>Contato e Documento</h2>
                <div class="form-group">
                    <label for="vch_telefone">Telefone:</label>
                    <input type="text" class="form-control" name="vch_telefone" id="vch_telefone" oninput="aplicarMascaraTelefone('vch_telefone')" maxlength="15" required>
                </div>
                <div class="form-group">
                    <label for="cid">CID:</label>
                    <input type="text" class="form-control" name="cid" id="cid" maxlength="6" required>
                </div>
                <div class="form-group">
                    <label for="vch_nome_pai">Nome do Pai:</label>
                    <input type="text" class="form-control" name="vch_nome_pai" id="vch_nome_pai" maxlength="50" required>
                </div>
                <div class="form-group">
                    <label for="vch_nome_mae">Nome da Mãe:</label>
                    <input type="text" class="form-control" name="vch_nome_mae" id="vch_nome_mae" maxlength="50" required>
                </div>
                <div class="form-group">
                    <label for="vch_cpf">CPF:</label>
                    <input type="text" class="form-control" name="vch_cpf" id="vch_cpf" oninput="formatarCPF('vch_cpf')" onblur="validarCPFOnBlur('vch_cpf')" maxlength="14" required>
                    <div id="cpf-error" class="text-danger"></div>
                </div>
                <div class="form-group">
                    <label for="vch_rg">RG:</label>
                    <input type="text" class="form-control" name="vch_rg" id="vch_rg" onkeyup="formatarRG()" maxlength="13" required>
                </div>
                <div class="form-group">
                    <label for="vch_num_cartao_sus">Número do Cartão do SUS:</label>
                    <input type="text" class="form-control" name="vch_num_cartao_sus" id="vch_num_cartao_sus" oninput="formatarCNS()" maxlength="18" required>
                </div>
                <div class="form-group">
                    <label for="vch_tipo_sanguineo">Tipo Sanguíneo:</label>
                    <select class="form-control" name="vch_tipo_sanguineo" id="vch_tipo_sanguineo" required>
                        <option value="">Selecione o tipo sanguíneo</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                </div>
            </div>
            <div class="step" id="step4">
                <h2>Representante Legal</h2>
                <div class="form-group">
                    <label for="tem_representante">Possui Representante Legal?</label>
                    <select class="form-control" name="bool_representante_legal" id="tem_representante" onchange="toggleRepresentanteLegal()" required>
                        <option value="">Selecione uma opção</option>
                        <option value="0">Não</option>
                        <option value="1">Sim</option>
                    </select>
                </div>
                <div id="representante_legal" style="display: none;">
                    <div class="form-group">
                        <label for="vch_nome_responsavel">Nome do Representante:</label>
                        <input type="text" class="form-control" name="vch_nome_responsavel" id="vch_nome_responsavel">
                    </div>
                    <div class="form-group">
                        <label for="int_sexo_responsavel">Sexo do Responsável:</label>
                        <div class="radio-group">
                            <input type="radio" name="int_sexo_responsavel" id="sexo_responsavel_m" value="1"><label for="sexo_responsavel_m">Masculino</label>
                            <input type="radio" name="int_sexo_responsavel" id="sexo_responsavel_f" value="2"><label for="sexo_responsavel_f">Feminino</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="vch_telefone_responsavel">Telefone do Responsável:</label>
                        <input type="text" class="form-control" name="vch_telefone_responsavel" id="vch_telefone_responsavel" oninput="aplicarMascaraTelefone('vch_telefone_responsavel')" maxlength="15">
                    </div>
                    <div class="form-group">
                        <label for="vch_cpf_responsavel">CPF do Responsável:</label>
                        <input type="text" class="form-control" name="vch_cpf_responsavel" id="vch_cpf_responsavel" oninput="formatarCPF('vch_cpf_responsavel')" onblur="validarCPFOnBlurResponsavel('vch_cpf_responsavel')" maxlength="14">
                        <div id="cpfErrorResponsavel" class="error-message"></div>
                    </div>
                    <div class="form-group">
                        <label for="vch_cep_responsavel">CEP do Responsável:</label>
                        <input type="text" class="form-control" name="vch_cep_responsavel" id="vch_cep_responsavel" oninput="aplicarMascaraCEP('vch_cep_responsavel')" maxlength="9" onblur="buscarEndereco('vch_cep_responsavel', 'vch_endereco_responsavel', 'vch_bairro_responsavel', 'vch_cidade_responsavel', 'cepErrorResponsavel')">
                        <div id="cepErrorResponsavel" class="error-message"></div>
                    </div>
                    <div class="form-group">
                        <label for="vch_endereco_responsavel">Endereço do Responsável:</label>
                        <input type="text" class="form-control" name="vch_endereco_responsavel" id="vch_endereco_responsavel">
                    </div>
                    <div class="form-group">
                        <label for="vch_bairro_responsavel">Bairro do Responsável:</label>
                        <input type="text" class="form-control" name="vch_bairro_responsavel" id="vch_bairro_responsavel">
                    </div>
                    <div class="form-group">
                        <label for="vch_cidade_responsavel">Cidade do Responsável:</label>
                        <input type="text" class="form-control" name="vch_cidade_responsavel" id="vch_cidade_responsavel">
                    </div>
                </div>
            </div>
            <div class="step" id="step5">
                <h2>Informações de Acesso</h2>
                <div class="form-group">
                    <label for="vch_login">Email (Será utilizado para acessar o sistema):</label>
                    <input type="text" class="form-control" name="vch_login" id="vch_login" onblur="verificarLogin()" required>
                    <div id="loginError" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="vch_senha">Criar senha de acesso (mínimo de 8 caracteres):</label>
                    <input type="password" class="form-control" name="vch_senha" id="vch_senha" minlength="8" required>
                </div>
                <div class="form-group">
                    <label for="vch_confirm_senha">Confirmar senha de acesso:</label>
                    <input type="password" class="form-control" name="vch_confirm_senha" id="vch_confirm_senha" minlength="8" required>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="showPassword">
                    <label class="form-check-label" for="showPassword">Mostrar senha</label>
                </div>
            </div>
            <div class="buttons">
                <button type="button" class="prev btn btn-secondary" onclick="nextPrev(-1)">Anterior</button>
                <button type="button" class="next btn btn-primary" onclick="nextPrev(1)">Próximo</button>
                <button type="submit" class="submit btn btn-primary" style="display: none;">Enviar</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var currentStep = 0;
        var cpfValido = false;
        var emailValido = false;
        var cepValido = false;

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
                document.querySelector(".next").style.display = "none";
                document.querySelector(".submit").style.display = "inline";
            } else {
                document.querySelector(".next").style.display = "inline";
                document.querySelector(".submit").style.display = "none";
            }
        }

        function nextPrev(n) {
            var steps = document.getElementsByClassName("step");

            if (n == 1 && !validateStep(currentStep)) {
                triggerButtonError();
                return false;
            }

            steps[currentStep].classList.remove('active');
            steps[currentStep].classList.add('finished');
            setTimeout(function() {
                steps[currentStep].style.display = "none";
                steps[currentStep].classList.remove('finished');
                currentStep = currentStep + n;
                if (currentStep >= steps.length) {
                    document.getElementById("registrationForm").submit();
                    return false;
                }
                steps[currentStep].classList.add('active');
                showStep(currentStep);
            }, 500);
        }

        function validateStep(n) {
            var steps = document.getElementsByClassName("step");
            var inputs = steps[n].getElementsByTagName("input");
            var selects = steps[n].getElementsByTagName("select");
            var valid = true;

            for (var i = 0; i < inputs.length; i++) {
                if (inputs[i].hasAttribute("required") && inputs[i].value === "") {
                    inputs[i].classList.add("is-invalid");
                    valid = false;
                } else {
                    inputs[i].classList.remove("is-invalid");
                }
            }

            for (var i = 0; i < selects.length; i++) {
                if (selects[i].hasAttribute("required") && selects[i].value === "") {
                    selects[i].classList.add("is-invalid");
                    valid = false;
                } else {
                    selects[i].classList.remove("is-invalid");
                }
            }

            var radios = steps[n].querySelectorAll('input[type="radio"][name="sexo"]');
            var radioChecked = Array.from(radios).some(radio => radio.checked);
            if (radios.length > 0 && !radioChecked) {
                radios.forEach(radio => radio.classList.add("is-invalid"));
                valid = false;
            } else {
                radios.forEach(radio => radio.classList.remove("is-invalid"));
            }

            if (n == 2 && !cpfValido) {
                document.getElementById("cpf-error").innerText = "CPF inválido.";
                valid = false;
            } else if (n == 4 && !emailValido) {
                document.getElementById("loginError").innerText = "Email já cadastrado.";
                valid = false;
            }

            if (n == 1 && !cepValido) {
                document.getElementById("cepError").innerText = "CEP inválido.";
                valid = false;
            }

            if (n == 3) {
                var hasRepresentante = document.getElementById("tem_representante").value == "1";
                var representanteInputs = document.getElementById("representante_legal").getElementsByTagName("input");
                var representanteSelects = document.getElementById("representante_legal").getElementsByTagName("select");
                var representanteRadios = document.querySelectorAll('input[type="radio"][name="int_sexo_responsavel"]');

                if (hasRepresentante) {
                    for (var i = 0; i < representanteInputs.length; i++) {
                        if (representanteInputs[i].hasAttribute("required") && representanteInputs[i].value === "") {
                            representanteInputs[i].classList.add("is-invalid");
                            valid = false;
                        } else {
                            representanteInputs[i].classList.remove("is-invalid");
                        }
                    }

                    for (var i = 0; i < representanteSelects.length; i++) {
                        if (representanteSelects[i].hasAttribute("required") && representanteSelects[i].value === "") {
                            representanteSelects[i].classList.add("is-invalid");
                            valid = false;
                        } else {
                            representanteSelects[i].classList.remove("is-invalid");
                        }
                    }

                    var representanteRadioChecked = Array.from(representanteRadios).some(radio => radio.checked);
                    if (representanteRadios.length > 0 && !representanteRadioChecked) {
                        representanteRadios.forEach(radio => radio.classList.add("is-invalid"));
                        valid = false;
                    } else {
                        representanteRadios.forEach(radio => radio.classList.remove("is-invalid"));
                    }
                }
            }

            return valid;
        }

        function updateProgressBar(n) {
            var progress = document.querySelector(".progress");
            var steps = document.getElementsByClassName("step");
            var percent = ((n + 1) / steps.length) * 100;
            progress.style.width = percent + "%";
        }

        $(document).ready(function() {
            $('#showPassword').change(function() {
                var passwordField = $('#vch_senha');
                var confirmPasswordField = $('#vch_confirm_senha');
                if ($(this).is(':checked')) {
                    passwordField.attr('type', 'text');
                    confirmPasswordField.attr('type', 'text');
                } else {
                    passwordField.attr('type', 'password');
                    confirmPasswordField.attr('type', 'password');
                }
            });

            $('#tem_representante').change(function() {
                if ($(this).val() == '1') {
                    $('#representante_legal').show();
                    $('#vch_nome_responsavel').attr('required', 'required');
                    $('#vch_telefone_responsavel').attr('required', 'required');
                    $('#vch_cpf_responsavel').attr('required', 'required');
                    $('#vch_cep_responsavel').attr('required', 'required');
                    $('#vch_endereco_responsavel').attr('required', 'required');
                    $('#vch_bairro_responsavel').attr('required', 'required');
                    $('#vch_cidade_responsavel').attr('required', 'required');
                } else {
                    $('#representante_legal').hide();
                    $('#vch_nome_responsavel').removeAttr('required');
                    $('#vch_telefone_responsavel').removeAttr('required');
                    $('#vch_cpf_responsavel').removeAttr('required');
                    $('#vch_cep_responsavel').removeAttr('required');
                    $('#vch_endereco_responsavel').removeAttr('required');
                    $('#vch_bairro_responsavel').removeAttr('required');
                    $('#vch_cidade_responsavel').removeAttr('required');
                }
            });

            const dataNascimentoInput = document.getElementById('sdt_nascimento');
            const dataAtual = new Date();
            const anoAtual = dataAtual.getFullYear();
            const mesAtual = String(dataAtual.getMonth() + 1).padStart(2, '0');
            const diaAtual = String(dataAtual.getDate()).padStart(2, '0');
            const dataMaxima = `${anoAtual}-${mesAtual}-${diaAtual}`;
            const anoMinimo = 1900;
            const dataMinima = `${anoMinimo}-01-01`;

            dataNascimentoInput.setAttribute('max', dataMaxima);
            dataNascimentoInput.setAttribute('min', dataMinima);
        });

        function exibirAlerta() {
            var alertDiv = document.getElementById("alert-message");
            alertDiv.style.display = "block";
        }

        function validarCPFOnBlur(inputId) {
            var cpfInput = document.getElementById(inputId);
            var cpf = cpfInput.value.replace(/\D/g, '');
            var cpfErrorDiv = document.getElementById('cpf-error');

            if (!validarCPF(cpf)) {
                cpfErrorDiv.innerHTML = 'CPF inválido.';
                cpfErrorDiv.style.display = 'block';
                cpfInput.classList.add('is-invalid');
                cpfValido = false;
                return;
            }

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'processamento/verificar_cpf.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'error') {
                        cpfErrorDiv.innerHTML = response.message;
                        cpfErrorDiv.style.display = 'block';
                        cpfInput.classList.add('is-invalid');
                        cpfValido = false;
                    } else {
                        cpfErrorDiv.innerHTML = '';
                        cpfErrorDiv.style.display = 'none';
                        cpfInput.classList.remove('is-invalid');
                        cpfValido = true;
                    }
                } else {
                    cpfErrorDiv.innerHTML = 'Erro ao verificar o CPF.';
                    cpfErrorDiv.style.display = 'block';
                    cpfInput.classList.add('is-invalid');
                    cpfValido = false;
                }
            };
            xhr.send('cpf=' + cpf);
        }

        function validarCPFOnBlurResponsavel(inputId) {
            var cpfInput = document.getElementById(inputId);
            var cpf = cpfInput.value.replace(/\D/g, '');
            var isValid = validarCPF(cpf);
            if (!isValid) {
                document.getElementById("cpfErrorResponsavel").innerText = 'CPF inválido.';
                cpfValido = false;
            } else {
                document.getElementById("cpfErrorResponsavel").innerText = '';
                cpfValido = true;
            }
        }

        function triggerButtonError() {
            var buttons = document.querySelectorAll(" .next, .submit");
            buttons.forEach(button => {
                button.classList.add("btn-error");
                setTimeout(function() {
                    button.classList.remove("btn-error");
                }, 500);
            });
        }

        function validarFormulario() {
            if (!cpfValido || !emailValido) {
                triggerButtonError();
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

        function formatarCPF(inputId) {
            var cpfInput = document.getElementById(inputId);
            cpfInput.value = formatCPF(cpfInput.value);
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
        function verificarLogin() {
            var login = document.getElementById('vch_login').value;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'processamento/verificar_login.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    if (response === '1') {
                        document.getElementById('loginError').innerText = 'Este login já está vinculado a um CPF, por favor, tente a recuperação de senha, ou um outro email.';
                        emailValido = false;
                    } else {
                        document.getElementById('loginError').innerText = '';
                        emailValido = true;
                    }
                }
            };
            xhr.send('login=' + login);
        }

        function buscarEndereco(cepId, enderecoId, bairroId, cidadeId, errorId) {
            var cep = document.getElementById(cepId).value.replace(/\D/g, '');
            if (cep.length === 8) {
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.erro) {
                            document.getElementById(enderecoId).value = data.logradouro;
                            document.getElementById(bairroId).value = data.bairro;
                            document.getElementById(cidadeId).value = data.localidade;
                            document.getElementById(errorId).innerText = '';
                            cepValido = true;
                        } else {
                            document.getElementById(errorId).innerText = 'CEP inválido.';
                            cepValido = false;
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao buscar CEP:', error);
                        document.getElementById(errorId).innerText = 'Erro ao buscar CEP.';
                        cepValido = false;
                    });
            } else {
                document.getElementById(errorId).innerText = 'CEP inválido.';
                cepValido = false;
            }
        }
    </script>
</body>

</html>
