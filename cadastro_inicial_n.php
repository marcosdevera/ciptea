<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pessoa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 20px auto; /* Centralizar o formulário */
        }
        input[type="text"], input[type="date"], input[type="number"], input[type="password"], input[type="submit"], select, input[type="file"] {
            width: calc(100% - 15px); /* Reduzindo o tamanho dos componentes */
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%; /* Ajustando o botão de envio */
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .representante_legal {
            display: none;
            padding-top: 10px;
        }
        label {
            display: block;
            margin-bottom: 5px; /* Espaçamento entre os labels */
        }
        /* .radio-container {
            display: inline-block;
            /* margin-right: 10px; */
        /* } */
        #alert-message {
            display: none;
            background-color: #ffcccc;
            padding: 10px;
            border: 1px solid #ff0000;
            margin-bottom: 10px;
            border-radius: 5px; /* Adiciona bordas arredondadas */
            font-size: 14px; /* Define tamanho da fonte */
        }
        h3{
            color: red;
        }
    </style>

<script>
var alertaExibido = false; // Variável de controle para verificar se o alerta já foi exibido
function formatCPF(cpf) {
    cpf = cpf.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona o primeiro ponto
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona o segundo ponto
    cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2'); // Adiciona o hífen
    return cpf;
}

function validarCPF(cpf) {
    cpf = cpf.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
    if (cpf.length !== 11) return false;

    var cpfArray = cpf.split('').map(Number);
    var sum = 0;
    var mod;

    // Verifica o primeiro dígito verificador
    for (var i = 0, j = 10; i < 9; i++, j--) {
        sum += cpfArray[i] * j;
    }
    mod = sum % 11;
    var firstDigit = mod < 2 ? 0 : 11 - mod;
    if (cpfArray[9] !== firstDigit) return false;

    // Verifica o segundo dígito verificador
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
    // Enviar solicitação AJAX para o servidor
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'processamento/verificar_cpf.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            var response = xhr.responseText;
            console.log(response);
            if (response === '1') {
                if (confirm('CPF já cadastrado. Para recuperar a senha, clique em "OK" para ser redirecionado para a Aba de recuperação de senha.')) {
                        window.location.href = 'recuperar_senha.php';
                    }
                cpfInput.value = ''; // Limpar o campo de CPF
            }
        }
    };
    xhr.send('cpf=' + cpf);

    var isValid = validarCPF(cpf);
    if (!isValid && !alertaExibido) {
        alertaExibido = true; // Marca o alerta como exibido
        alert('CPF inválido');
        cpfInput.value = ''; // Limpa o campo se o CPF for inválido
    }else {
        alertaExibido = false; // Reseta a variável de controle
    }
}

function formatarRG() {
    var rgInput = document.getElementById('vch_rg');
    var rg = rgInput.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos

    // Formatação do RG (XX.XXX.XXX-X)
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
    var cns = cnsInput.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos

    // Formatação do CNS (XXX XXXX XXXX XXXX)
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
            // Remove todos os caracteres não numéricos
            cep = cep.replace(/\D/g, '');
            
            // Aplica a máscara de formatação
            cep = cep.replace(/^(\d{5})(\d{1})/, '$1-$2');
            
            return cep;
        }
        
        function aplicarMascaraCEP(inputId) {
            var inputCEP = document.getElementById(inputId);
            var cep = inputCEP.value;
            inputCEP.value = formatarCEP(cep);
        }

        function formatarTelefone(telefone) {
            // Remove todos os caracteres não numéricos
            telefone = telefone.replace(/\D/g, '');

            // Verifica o tamanho do número de telefone para aplicar a máscara adequada
            if (telefone.length === 11) {
                // Formato: (XX) XXXXX-XXXX
                telefone = telefone.replace(/^(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            } else if (telefone.length === 10) {
                // Formato: (XX) XXXX-XXXX
                telefone = telefone.replace(/^(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
            } else if (telefone.length === 9) {
                // Formato: XXXXX-XXXX
                telefone = telefone.replace(/^(\d{5})(\d{4})/, '$1-$2');
            } else if (telefone.length === 8) {
                // Formato: XXXX-XXXX
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
</head>
<body>
    <form name="form" action="processamento/processar_usuario_n.php" method="POST" enctype="multipart/form-data" onsubmit="return validarSenhas()">
        <h2>Cadastro da pessoa com TEA e de seu representante legal (se houver) </h2>
        <br><br>
        <label for="vch_nome">Nome:</label>
        <input type="text" name="vch_nome" id="vch_nome" required>
        <label for="vch_nome">Nome Social:</label>
        <input type="text" name="vch_nome_social" id="vch_nome_social">
        <br><br>
        <label for="sexo">SEXO:</label>
        <input type="radio" name="sexo" id="sexo" value="1" required>Masculino</label>
        <input type="radio" name="sexo" id="sexo" value="2" required>Feminino</label>
        <br><br>
        <label for="cid">CID (O CID está presente no relatório médico):</label>
        <input type="text" name="cid" id="cid">
        <label for="vch_tipo_sanguineo">Tipo sanguineo:</label>
        <input type="text" name="vch_tipo_sanguineo" id="vch_tipo_sanguineo">
        <label for="vch_telefone">Telefone da pessoa:</label>
        <input type="text" name="vch_telefone" id="vch_telefone" oninput="aplicarMascaraTelefone('vch_telefone')" maxlength="15">
        <label for="vch_telefone_contato">Contato em caso de emergência:</label>
        <input type="text" name="vch_telefone_contato" id="vch_telefone_contato" oninput="aplicarMascaraTelefone('vch_telefone_contato')" maxlength="15" required>
        <label for="vch_cpf">CPF:</label>
        <input type="text" name="vch_cpf" id="vch_cpf" oninput="formatarCPF('vch_cpf')" onblur="validarCPFOnBlur('vch_cpf')" maxlength="14" required>
        <label for="vch_rg">RG:</label>
        <input type="text" name="vch_rg" id="vch_rg" onkeyup="formatarRG()" maxlength="13" required>
        <label for="vch_num_cartao_sus">Número do Cartão SUS:</label>
        <input type="text" name="vch_num_cartao_sus" id="vch_num_cartao_sus"  onkeyup="formatarCNS()" maxlength="18" required>
        <label for="vch_nome_pai">Nome do Pai:</label>
        <input type="text" name="vch_nome_pai" id="vch_nome_pai" required>
        <label for="vch_nome_mae">Nome da Mãe:</label>
        <input type="text" name="vch_nome_mae" id="vch_nome_mae" required>
        <label for="sdt_nascimento">Data de Nascimento:</label>
        <input type="date" name="sdt_nascimento" id="sdt_nascimento" required>
        <label for="endereco">Endereço:</label>
        <input type="text" name="endereco" id="endereco" required>
        <label for="bairro">Bairro:</label>
        <input type="text" name="bairro" id="bairro" required>
        <label for="cep">CEP:</label>
        <input type="text" name="cep" id="cep" oninput="aplicarMascaraCEP('cep')" maxlength="9" required>
        <label for="cidade">Cidade:</label>
        <input type="text" name="cidade" id="cidade" required>

        
        <label for="bool_representante_legal">Possui Representante Legal?</label>
        <select name="bool_representante_legal" id="bool_representante_legal" required>
            <option value="">Selecione...</option>
            <option value="0">Não</option>
            <option value="1">Sim</option>
        </select>
        <div class="representante_legal">
            <label for="vch_nome_reponsavel">Nome do Responsável Legal:</label>
            <input type="text" name="vch_nome_reponsavel" id="vch_nome_reponsavel">
            <br><br>
            <label for="sexo_responsavel_legal">SEXO:</label>
            <input type="radio" name="sexo_responsavel" id="sexo_responsavel" value="1">Masculino</label>
            <input type="radio" name="sexo_responsavel" id="sexo_responsavel" value="2">Feminino</label>
            <br><br>
            <label for="vch_telefone_responsavel">Telefone do Responsável Legal:</label>
            <input type="text" name="vch_telefone_responsavel" id="vch_telefone_responsavel" oninput="aplicarMascaraTelefone('vch_telefone_responsavel')" maxlength="15">
            <label for="vch_cpf_responsavel">CPF do Responsável Legal:</label>
            <input type="text" name="vch_cpf_responsavel" id="vch_cpf_responsavel" oninput="formatarCPF('vch_cpf_responsavel')" onblur="validarCPFOnBlur('vch_cpf_responsavel')" maxlength="14">
            <label for="vch_cep_responsavel">CEP do Responsável Legal:</label>
            <input type="text" name="vch_cep_responsavel" id="vch_cep_responsavel" oninput="aplicarMascaraCEP('vch_cep_responsavel')" maxlength="9">
            <label for="vch_endereco_responsavel">Endereço do Responsável Legal:</label>
            <input type="text" name="vch_endereco_responsavel" id="vch_endereco_responsavel">
            <label for="num_responsavel">Número da residência:</label>
            <input type="number" name="num_responsavel" id="num_responsavel">
            <label for="comp">Complemento:</label>
            <input type="text" name="comp_responsavel" id="comp_responsavel" > 
            <label for="vch_bairro_responsavel">Bairro do Responsável Legal:</label>
            <input type="text" name="vch_bairro_responsavel" id="vch_bairro_responsavel">
            <label for="vch_cidade_responsavel">Cidade do Responsável Legal:</label>
            <input type="text" name="vch_cidade_responsavel" id="vch_cidade_responsavel">
        </div>

        <div>
        <br><br>
        <label for="vch_login">Email (Será utilizado para acessar o sistema):</label>
        <input type="text" name="vch_login" id="vch_login" onblur="verificarLogin()" onclick="exibirAlerta()">
        <label for="vch_senha">Criar senha de acesso (mínimo de 8 caracteres):</label>
        <input type="password" name="vch_senha" id="vch_senha" minlength="8">
        <label for="vch_confirm_senha">Confirmar senha de acesso:</label>
        <input type="password" name="vch_confirm_senha" id="vch_confirm_senha" minlength="8">
        <input type="checkbox" id="showPassword"> Mostrar senha            
        </div>
        <input type="hidden" name="MM_action" class="MM_action" value="1">
        <input type="submit" value="Cadastrar">
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#bool_representante_legal').change(function(){
                if($(this).val() == '1'){
                    $('.representante_legal').show();
                } else {
                    $('.representante_legal').hide();
                }
            });
        });

        document.getElementById('showPassword').addEventListener('change', function() {
            var passwordField = document.getElementById('vch_senha');
            var ConfirmpasswordField = document.getElementById('vch_confirm_senha');
            if (this.checked) {
                passwordField.type = 'text';
                ConfirmpasswordField.type = 'text';
            } else {
                passwordField.type = 'password';
                ConfirmpasswordField.type = 'password';
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            var optSim = document.getElementById("opt_sim");
            var optNao = document.getElementById("opt_nao");
            var docFoto = document.getElementById("documento");

            // Verifica o estado dos botões de rádio ao carregar a página
            if (optSim.checked) {
                docFoto.style.display = "block";
            } else if (optNao.checked) {
                docFoto.style.display = "none";
                alert("É necessário um documento com foto.");
            } else {
                docFoto.style.display = "none";
            }

            optSim.addEventListener("change", function() {
                if (optSim.checked) {
                    docFoto.style.display = "block";
                }
            });

            optNao.addEventListener("change", function() {
                if (optNao.checked) {
                    alert("Para o cadastro é necessário que o requerente tenha um documento com foto. Caso o mesmo não possua, entre em contato com a SEDES através do email GEDEF.DEF@GMAIL.COM ou por telefone através do número 3644-5727.");
                    docFoto.style.display = "none";
                }
            });
        });

        function exibirAlerta() {
            var alertDiv = document.getElementById("alert-message");
            alertDiv.style.display = "block";
        }

        function verificarLogin() {
            var login = document.getElementById('vch_login').value;
                console.log(login);
            // Enviar solicitação AJAX para o servidor
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
        

        // Função para verificar se as senhas são iguais antes de enviar o formulário
        function validarSenhas() {
            var senha = document.getElementById("vch_senha").value;
            var confirmacao = document.getElementById("vch_confirm_senha").value;

            // Verifica se as senhas são diferentes
            if (senha !== confirmacao) {
                alert("As senhas digitadas não são iguais. Para realizar o cadastro as senhas abaixo precisam ser iguais.");
                return false; // Impede o envio do formulário
            }

            return true; // Permite o envio do formulário se as senhas forem iguais
        }

        function validarEmail(email) {
        // Expressão regular para validar o formato do email
        const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!regexEmail.test(email)) {
            return false; // Formato de email inválido
        }

        // Dividir o email para obter o domínio
        const partes = email.split('@');
        const dominio = partes[1];

        // Verificar se o domínio termina com .com ou .com.br
        if (dominio.endsWith('.com') || dominio.endsWith('.com.br')) {
            // Aqui você pode adicionar uma verificação adicional de validade do domínio
            // Esta parte é mais complexa e pode requerer o uso de serviços externos
            return true;
        }

        return false;
    }
    </script>
</body>
</html>
