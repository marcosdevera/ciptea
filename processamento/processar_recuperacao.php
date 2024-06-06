<?php
    include_once('../classes/pessoa.class.php');
    include_once('../classes/email.class.php');
    include_once('../classes/usuario.class.php');

    if(isset($_POST['MM_action'])){
        $MM_action = $_POST['MM_action'];
    }

    if($MM_action == 1){
        if(isset($_POST['vch_cpf'])){
            $cpf = $_POST['vch_cpf'];
        }
        $cpf_format = str_replace(['.', '-'], '', $cpf);
        $p = new Pessoa();
        $result_pessoa = $p->verificarCPF($cpf_format);
        $retorno_cpf = $result_pessoa->rowCount();
        $row_cpf = $result_pessoa->fetch(PDO::FETCH_ASSOC);
        if($retorno_cpf == 0){
            die("Este CPF não possui um cadastro ativo, por favor, efetue um novo cadastro");
        }else{
        $cod_usuario_encode = base64_encode($row_cpf['cod_usuario']);
        $assunto="Recuperação de senha CIPTEA";
        $corpo = "Conforme solicitado, segue abaixo o link para a recuperação de senha de acesso ao sistema CIPTEA:<br><a href='https://sistemas.camacari.ba.gov.br/sedes/ciptea/pagina_recuperacao_senha.php?cod=". urlencode($cod_usuario_encode)."'>Recuperar Senha</a>";    
        $e = new Email();
        $email = $row_cpf['vch_login'];    
        if ($row_cpf['vch_login'] != '') {
            try {
                $json_obj = $e->enviarEmailFila($email,$assunto, $corpo);

                if ($json_obj != null) {
                    if (count($json_obj->objErrorServiceList) > 0) {
                        $msgEmail = $json_obj->objErrorServiceList[0]->descricao;
                    }

                    if (count($json_obj->objMensagemServiceArrayList) > 0) {
                        $msgEmail = $json_obj->objMensagemServiceArrayList[0]->descricao;
                    }
                }
                $login_cod = base64_encode($row_cpf['vch_login']);
                header("location:../recuperar_senha.php?msg=1&login=" . urlencode($login_cod));
            } catch (Exception $e) {
                $msgEmail = "Erro ao enviar email";
            }
        }
            // header('Location: ../recupera_senha.php?cpf='.$email);
        }
    }else if($MM_action == 2){
        // die(var_dump($_POST['cod_usuario']));
        $usuario = new Usuario();
        if (isset($_POST['confirmacao'])) {
            $usuario->setVch_senha(password_hash($_POST['confirmacao'], PASSWORD_DEFAULT));
        }
        if(isset($_POST['cod_usuario'])){
            $usuario->setCod_usuario($_POST['cod_usuario']);
        }
        // $usuario->setCod_usuario($cod_usuario_recuperacao);
        $usuario->alterarSenha();
    }

?>