<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('../classes/usuario.class.php');
include_once('../classes/pessoa.class.php');
include_once('../classes/obs.class.php');
include_once('../classes/documentos.class.php');
include_once('../classes/responsavel.class.php');

try {
    $pessoa = new Pessoa();
    $responsavel = new Responsavel();
    $usuario = new Usuario();
    $documentos = new Documentos();
   

    // Verificação e definição de cada campo, caso esteja presente
    if (isset($_POST['vch_nome'])) {
        $pessoa->setVchNome($_POST['vch_nome']);
    }

    if (isset($_POST['vch_telefone'])) {
        $telefone_format = str_replace(['(', ')', '-', ' '], '', $_POST['vch_telefone']);
        $pessoa->setVchTelefone($telefone_format);
    }

    if (isset($_POST['vch_telefone_contato'])) {
        $telefone_contato_format = str_replace(['(', ')', '-', ' '], '', $_POST['vch_telefone_contato']);
        $pessoa->setVchTelefoneContato($telefone_contato_format);
    }

    if (isset($_POST['sexo'])) {
        $pessoa->setIntSexo($_POST['sexo']);
    }

    if (isset($_POST['cid'])) {
        $pessoa->setCid($_POST['cid']);
    }

    if (isset($_POST['vch_tipo_sanguineo'])) {
        $pessoa->setVchTipoSanguineo($_POST['vch_tipo_sanguineo']);
    }

    if (isset($_POST['vch_nome_social'])) {
        $pessoa->setVchNomeSocial($_POST['vch_nome_social']);
    }

    if (isset($_POST['vch_nome_pai'])) {
        $pessoa->setVchNomePai($_POST['vch_nome_pai']);
    }

    if (isset($_POST['vch_nome_mae'])) {
        $pessoa->setVchNomeMae($_POST['vch_nome_mae']);
    }

    if (isset($_POST['sdt_nascimento'])) {
        $pessoa->setSdtNascimento($_POST['sdt_nascimento']);
    }

    if (isset($_POST['endereco'])) {
        $pessoa->setEndereco($_POST['endereco']);
    }

    if (isset($_POST['bairro'])) {
        $pessoa->setBairro($_POST['bairro']);
    }

    if (isset($_POST['cep'])) {
        $cep_format = str_replace('-', '', $_POST['cep']);
        $pessoa->setCep($cep_format);
    }

    if (isset($_POST['cidade'])) {
        $pessoa->setCidade($_POST['cidade']);
    }

    if (isset($_POST['vch_rg'])) {
        $rg_format = str_replace(['.', '-'], '', $_POST['vch_rg']);
        $pessoa->setVchRg($rg_format);
    }

    if (isset($_POST['vch_num_cartao_sus'])) {
        $cartao_sus_format = str_replace(['.', '-'], '', $_POST['vch_num_cartao_sus']);
        $pessoa->setVchNumCartaoSus($cartao_sus_format);
    }

    if (isset($_POST['vch_cpf'])) {
        // Remover pontos e traços do CPF
        $cpf_sem_pontos = str_replace(array(".", "-"), "", $_POST['vch_cpf']);
        // Setar o CPF sem pontos e traços
        $pessoa->setVchCpf($cpf_sem_pontos);
    }

    // Verificação se bool_representante_legal está definido
    if (isset($_POST['bool_representante_legal'])) {
        $pessoa->setBoolRepresentanteLegal($_POST['bool_representante_legal']);
    } else {
        $pessoa->setBoolRepresentanteLegal(0); // Definindo valor padrão se não estiver definido
    }

    // Campos do representante legal, caso existam
    if (isset($_POST['bool_representante_legal']) && $_POST['bool_representante_legal'] == 1) {
        if (isset($_POST['vch_nome_reponsavel'])) {
            $responsavel->setVchNomeResponsavel($_POST['vch_nome_reponsavel']);
        }

        if (isset($_POST['sexo_responsavel'])) {
            $responsavel->setIntSexoResponsavel($_POST['sexo_responsavel']);
        }

        if (isset($_POST['vch_telefone_responsavel'])) {
            $telefone_responsavel_format = str_replace(['(', ')', '-', ' '], '', $_POST['vch_telefone_responsavel']);
            $responsavel->setVchTelefoneResponsavel($telefone_responsavel_format);
        }

        if (isset($_POST['vch_cpf_responsavel'])) {
            $cpf_responsavel_format = str_replace(['.', '-'], '', $_POST['vch_cpf_responsavel']);
            $responsavel->setVchCpfResponsavel($cpf_responsavel_format);
        }

        if (isset($_POST['vch_cep_responsavel'])) {
            $cep_responsavel_format = str_replace('-', '', $_POST['vch_cep_responsavel']);
            $responsavel->setVchCepResponsavel($cep_responsavel_format);
        }

        if (isset($_POST['vch_endereco_responsavel'])) {
            $responsavel->setVchEnderecoResponsavel($_POST['vch_endereco_responsavel']);
        }

        if (isset($_POST['num_responsavel'])) {
            $responsavel->setNumResponsavel($_POST['num_responsavel']);
        }

        if (isset($_POST['vch_bairro_responsavel'])) {
            $responsavel->setVchBairroResponsavel($_POST['vch_bairro_responsavel']);
        }

        if (isset($_POST['vch_cidade_responsavel'])) {
            $responsavel->setVchCidadeResponsavel($_POST['vch_cidade_responsavel']);
        }
    }

    if (isset($_POST['vch_login'])) {
        $usuario->setVch_login($_POST['vch_login']);
    }

    if (isset($_POST['vch_senha'])) {
        $usuario->setVch_senha(password_hash($_POST['vch_senha'], PASSWORD_DEFAULT));
    }

    // Verifica se é atualização ou inserção
    if (isset($_POST['cod_usuario']) && !empty($_POST['cod_usuario'])) {
        // Atualiza pessoa
        $pessoa->atualizarPessoa($_POST['cod_usuario']);
        $codPessoa = $_POST['cod_usuario'];
        echo "Dados atualizados com sucesso!";
    } else {
        // Inserir nova pessoa
        $usuario->setInt_situacao(1);
        if ($_POST['bool_representante_legal'] == 1) {
            $codPessoa = $pessoa->inserirPessoaResponsavel($responsavel, $usuario);
        } else {
            $codPessoa = $pessoa->inserirPessoa($usuario);
        }
        echo "Cadastro realizado com sucesso!";
    }

    // Processamento dos arquivos enviados
    $uploadDir = '../uploads/'; // Diretório de upload
    $status = 1; // Status inicial dos documentos

    $documentFiles = [
        'form_requerimento' => 1,
        'foto' => 2,
        'doc_foto' => 3,
        'comp_residencia' => 4,
        'laudo' => 5
    ];

    foreach ($documentFiles as $inputName => $docType) {
        if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES[$inputName]['tmp_name'];
            $fileName = $_FILES[$inputName]['name'];
            $destination = $uploadDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $destination)) {
                // Inserir registro do documento no banco
                $sql = "INSERT INTO ciptea.documentos (cod_pessoa, cod_tipo_documento, vch_documento, sdt_insercao, status) 
                        VALUES (:cod_pessoa, :cod_tipo_documento, :vch_documento, NOW(), :status)";
                $params = [
                    ':cod_pessoa' => $codPessoa,
                    ':cod_tipo_documento' => $docType,
                    ':vch_documento' => $fileName,
                    ':status' => $status
                ];
                $db->execute($sql, $params);
            } else {
                throw new Exception('Erro ao mover o arquivo ' . $fileName);
            }
        }
    }

} catch (Exception $e) {
    echo "Erro ao realizar a operação: " . $e->getMessage();
    header("Location: ../cadastro_inicialUP.php");
    exit();
}
?>
