<?php
    include_once("classes/pessoa.class.php");
    include_once("sessao.php");

    $p = new Pessoa();
    $cod_usuario = $_SESSION["user_session"];
    $result_p = $p->exibirPessoaUsuario($cod_usuario);
    $row_p = $result_p->fetch(PDO::FETCH_ASSOC);
?>

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
    </style>
</head>
<body>
    <form name="form" action="processamento/processar_usuario.php" method="POST" enctype="multipart/form-data">
        <h2>Cadastro de Pessoa</h2>
        <label for="vch_nome">Nome:</label>
        <input type="text" name="vch_nome" id="vch_nome" value="<?php echo $row_p['vch_nome'] ?>">
        <label for="vch_nome_pai">Nome do Pai:</label>
        <input type="text" name="vch_nome_pai" id="vch_nome_pai" value="<?php echo $row_p['vch_nome_pai'] ?>">
        <label for="vch_nome_mae">Nome da Mãe:</label>
        <input type="text" name="vch_nome_mae" id="vch_nome_mae" value="<?php echo $row_p['vch_nome_mae'] ?>">
        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="text" name="data_nascimento" id="data_nascimento" value="<?php echo date("d/m/Y", strtotime($row_p["sdt_nascimento"])); ?>">
        <label for="endereco">Endereço:</label>
        <input type="text" name="endereco" id="endereco" value="<?php echo $row_p['endereco'] ?>">
        <label for="bairro">Bairro:</label>
        <input type="text" name="bairro" id="bairro" value="<?php echo $row_p['bairro'] ?>">
        <label for="cep">CEP:</label>
        <input type="text" name="cep" id="cep" value="<?php echo $row_p['cep'] ?>">
        <label for="cidade">Cidade:</label>
        <input type="text" name="cidade" id="cidade" value="<?php echo $row_p['cidade'] ?>">
        <label for="vch_rg">RG:</label>
        <input type="text" name="vch_rg" id="vch_rg" value="<?php echo $row_p['vch_rg'] ?>">
        <label for="vch_cpf">CPF:</label>
        <input type="text" name="vch_cpf" id="vch_cpf" value="<?php echo $row_p['vch_cpf'] ?>">
        <label for="vch_num_cartao_sus">Número do Cartão SUS:</label>
        <input type="text" name="vch_num_cartao_sus" id="vch_num_cartao_sus" value="<?php echo $row_p['vch_num_cartao_sus'] ?>">
        <label for="file1">Envie seu laudo:</label>
        <input type="file" name="laudo" id="laudo">
        <label for="file2">Envie uma foto 3x4 para a carteirinha:</label>
        <input type="file" name="foto" id="foto">
        <label for="comp_residencia">Comprovante de residência:</label>
        <input type="file" name="comp_residencia" id="comp_residencia">
        <label for="doc_foto">Documento com foto:</label>
        <input type="file" name="doc_foto" id="doc_foto">
        <label for="form_requerimento">Fomulário de requerimento:</label>
        <input type="file" name="form_requerimento" id="form_requerimento">
        <input type="hidden" name="sdt_nascimento" id="sdt_nascimento" value="<?php echo $row_p['sdt_nascimento'] ?>">
        <input type="hidden" name="cod_usuario" id="cod_usuario" value="<?php echo $row_p['cod_usuario'] ?>">
        <input type="hidden" name="cod_pessoa" id="cod_pessoa" value="<?php echo $row_p['cod_pessoa'] ?>">
        <input type="hidden" name="laudo_atual" id="laudo_atual" value="<?php echo $row_p['laudo'] ?>">
        <input type="hidden" name="foto_atual" id="foto_atual" value="<?php echo $row_p['foto'] ?>">
        <input type="hidden" name="comprovante_atual" id="comprovante_atual" value="<?php echo $row_p['comp_residencia']; ?>">
        <input type="hidden" name="documento_atual" id="documento_atual" value="<?php echo $row_p['documento'] ?>">
        <input type="hidden" name="requerimento_atual" id="requerimento_atual" value="<?php echo $row_p['requerimento'] ?>">

        <label for="bool_representante_legal">Possui Representante Legal?</label>
        <select name="bool_representante_legal" id="bool_representante_legal">
            <option value="">Selecione...</option>
            <option value="0" <?php if($row_p['bool_representante_legal'] == 0){echo "selected";} ?>>Não</option>
            <option value="1" <?php if($row_p['bool_representante_legal'] == 1){echo "selected";} ?>>Sim</option>
        </select>
        <div class="representante_legal">
            <label for="vch_nome_reponsavel">Nome do Responsável Legal:</label>
            <input type="text" name="vch_nome_reponsavel" id="vch_nome_reponsavel" value="<?php echo $row_p['vch_nome_responsavel'] ?>">
            <label for="vch_telefone_responsavel">Telefone do Responsável Legal:</label>
            <input type="text" name="vch_telefone_responsavel" id="vch_telefone_responsavel" value="<?php echo $row_p['vch_telefone_responsavel'] ?>">
            <label for="vch_cpf_responsavel">CPF do Responsável Legal:</label>
            <input type="text" name="vch_cpf_responsavel" id="vch_cpf_responsavel" value="<?php echo $row_p['vch_cpf_responsavel'] ?>">
            <label for="vch_endereco_responsavel">Endereço do Responsável Legal:</label>
            <input type="text" name="vch_endereco_responsavel" id="vch_endereco_responsavel" value="<?php echo $row_p['vch_endereco_responsavel'] ?>">
            <label for="vch_bairro_responsavel">Bairro do Responsável Legal:</label>
            <input type="text" name="vch_bairro_responsavel" id="vch_bairro_responsavel" value="<?php echo $row_p['vch_bairro_responsavel'] ?>">
            <label for="vch_cep_responsavel">CEP do Responsável Legal:</label>
            <input type="text" name="vch_cep_responsavel" id="vch_cep_responsavel" value="<?php echo $row_p['vch_cep_responsavel'] ?>">
            <label for="vch_cidade_responsavel">Cidade do Responsável Legal:</label>
            <input type="text" name="vch_cidade_responsavel" id="vch_cidade_responsavel" value="<?php echo $row_p['vch_cidade_responsavel'] ?>">
        </div>
        <input type="hidden" name="MM_action" class="MM_action" value="4">
        <input type="submit" value="Recadastrar">
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
        // Verifica o valor selecionado inicialmente
        if($('#bool_representante_legal').val() == '1'){
            $('.representante_legal').show();
        } else {
            $('.representante_legal').hide();
        }

        // Adiciona o evento de mudança
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
            if (this.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });
    </script>
</body>
</html>
