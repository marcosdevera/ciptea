<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('../classes/usuario.class.php');
include_once('../classes/pessoa.class.php');
include_once('../classes/obs.class.php');
include_once('../classes/documentos.class.php');

$pessoa = new Pessoa();


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
if (isset($_POST['vch_cpf'])) {
    // Remover pontos e traços do CPF
    $cpf_sem_pontos = str_replace(array(".", "-"), "", $_POST['vch_cpf']);

    // Setar o CPF sem pontos e traços
    $pessoa->setVchCpf($cpf_sem_pontos);
}
if (isset($_POST['vch_num_cartao_sus'])) {
    $num_cartao_sus_format = str_replace(' ', '', $_POST['vch_num_cartao_sus']);
    $pessoa->setVchNumCartaoSus($num_cartao_sus_format);
}
if (isset($_POST['bool_representante_legal'])) {
    $pessoa->setBoolRepresentanteLegal($_POST['bool_representante_legal']);
}

// if (isset($_POST['bool_representante_legal'])) {
//     $pessoa->setBoolRepresentanteLegal($_POST['bool_representante_legal']);
// }

if (isset($_POST['cod_usuario'])) {
    $cod_usuario = $_POST['cod_usuario'];
}


if ($_POST['MM_action'] == 1) {

    $l = new Documentos();
    $f = new Documentos();
    $c = new Documentos();
    $d = new Documentos();

    if (isset($_FILES['laudo']) && isset($_FILES['foto']) && isset($_FILES['comp_residencia'])) {
        $laudo = $_FILES['laudo'];
        $foto = $_FILES['foto'];
        $comprovante = $_FILES['comp_residencia'];
        $doc_foto = $_FILES['doc_foto'];

        if ($laudo['error']) {
            die("Falha ao enviar o laudo");
        }
        if ($foto['error']) {
            die("Falha ao enviar imagem");
        }
        if ($comprovante['error']) {
            die("Falha ao enviar comprovante de residência");
        }

        if ($doc_foto['error']) {
            die("Falha ao enviar comprovante de residência");
        }

        if ($laudo['size'] > 5242880) {
            die("O laudo inserido excede o valor máximo, por favor envie novamente");
        }
        if ($foto['size'] > 2097152) {
            die("A imagem inserida excede o valor máximo, por favor envie novamente");
        }
        if ($comprovante['size'] > 2097152) {
            die("O comprovante de residência inserido excede o valor máximo, por favor envie novamente");
        }

        if ($doc_foto['size'] > 2097152) {
            die("O documento enviado excede o tamanho máximo, por favor envie novamente");
        }

        $pasta = "../uploads/";

        $nomeLaudo = $laudo['name'];
        $novoNomeLaudo = uniqid();
        $extensaoLaudo = strtolower(pathinfo($nomeLaudo, PATHINFO_EXTENSION));
        $caminhoLaudo = $pasta . $novoNomeLaudo . "." . $extensaoLaudo;

        $nomeFoto = $foto['name'];
        $novoNomeFoto = uniqid();
        $extensaoFoto = strtolower(pathinfo($nomeFoto, PATHINFO_EXTENSION));
        $caminhoFoto = $pasta . $novoNomeFoto . "." . $extensaoFoto;

        $nomeComprovante = $comprovante['name'];
        $novoNomeComprovante = uniqid();
        $extensaoComprovante = strtolower(pathinfo($nomeComprovante, PATHINFO_EXTENSION));
        $caminhoComprovante = $pasta . $novoNomeComprovante . "." . $extensaoComprovante;

        $nomeDocFoto = $doc_foto['name'];
        $novoNomeDocFoto = uniqid();
        $extensaoDocFoto = strtolower(pathinfo($nomeDocFoto, PATHINFO_EXTENSION));
        $caminhoDocFoto = $pasta . $novoNomeDocFoto . "." . $extensaoDocFoto;

        if ($extensaoLaudo != "pdf" && $extensaoLaudo != "png" && $extensaoLaudo != "jpg" && $extensaoLaudo != "jpeg") {
            die("O laudo enviado não está no tipo especificado, por favor, envie em outro formato");
        }

        if ($extensaoFoto != "png" && $extensaoFoto != "jpg" && $extensaoFoto != "jpeg") {
            die("A foto enviada não está no tipo especificado, por favor, envie em outro formato");
        }

        if ($extensaoComprovante != "pdf" && $extensaoComprovante != "png" && $extensaoComprovante != "jpg" && $extensaoComprovante != "jpeg") {
            die("O comprovante enviada não está no tipo especificado, por favor, envie em outro formato");
        }

        if ($extensaoDocFoto != "pdf" && $extensaoDocFoto != "png" && $extensaoDocFoto != "jpg" && $extensaoDocFoto != "jpeg") {
            die("O documento enviado não está no tipo especificado, por favor, envie em outro formato");
        }
        
        
        move_uploaded_file($laudo["tmp_name"], $pasta . $novoNomeLaudo . "." . $extensaoLaudo);
        move_uploaded_file($foto["tmp_name"], $pasta . $novoNomeFoto . "." . $extensaoFoto);
        move_uploaded_file($comprovante["tmp_name"], $pasta . $novoNomeComprovante . "." . $extensaoComprovante);
        move_uploaded_file($doc_foto["tmp_name"], $pasta . $novoNomeDocFoto . "." . $extensaoDocFoto);

        $f->setCodTipoDocumento(1);
        $f->setVchDocumento($caminhoFoto);
        $f->setStatus(0);

        $l->setCodTipoDocumento(2);
        $l->setVchDocumento($caminhoLaudo);
        $l->setStatus(0);

        $c->setCodTipoDocumento(3);
        $c->setVchDocumento($caminhoComprovante);
        $c->setStatus(0);

        $d->setCodTipoDocumento(4);
        $d->setVchDocumento($caminhoDocFoto);
        $d->setStatus(0);
    }else{
        die("Erro, insira todos os documentos obrigatórios!");
    }

    //Setando alguns dados do usuário aqui, para caso haja modificações ou delete não ocorrer nenhuma confusão nos dados, assim, só será setado dessa forma quando for cadastro.
    $usuario = new Usuario();
    if (isset($_POST['vch_login'])) {
        $usuario->setVch_login($_POST['vch_login']);
    }
    
    if (isset($_POST['vch_senha'])) {
        $usuario->setVch_senha(password_hash($_POST['vch_senha'], PASSWORD_DEFAULT));
    }
    $usuario->setInt_perfil(1);
    $usuario->setInt_situacao(1);

    // die(var_dump($_POST['bool_representante_legal']));
    if ($_POST['bool_representante_legal'] == 0) {
        $pessoa->inserirPessoa($l, $f, $c, $d, $usuario);
    } else if ($_POST['bool_representante_legal'] == 1) {
        $responsavel = new Responsavel();

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
        

        if (isset($_POST['vch_endereco_responsavel'])) {
            $responsavel->setVchEnderecoResponsavel($_POST['vch_endereco_responsavel']);
        }

        if (isset($_POST['num_responsavel'])) {
            $responsavel->setNumResponsavel($_POST['num_responsavel']);
        }

        if (isset($_POST['comp_responsavel'])) {
            $responsavel->setCompResponsavel($_POST['comp_responsavel']);
        }

        if (isset($_POST['vch_bairro_responsavel'])) {
            $responsavel->setVchBairroResponsavel($_POST['vch_bairro_responsavel']);
        }

        if (isset($_POST['vch_cep_responsavel'])) {
            $cep_responsavel_format = str_replace('-', '', $_POST['vch_cep_responsavel']);
            $responsavel->setVchCepResponsavel($cep_responsavel_format);
        }
        

        if (isset($_POST['vch_cidade_responsavel'])) {
            $responsavel->setVchCidadeResponsavel($_POST['vch_cidade_responsavel']);
        }
        
        $pessoa->setResposavel($responsavel);
        $pessoa->inserirPessoaResponsavel($l, $f, $c, $d, $usuario);
    }

} else if ($_POST['MM_action'] == 2) {
    $doc = new Documentos();
    $doc->setCodPessoa($_POST['cod_pessoa']);
    $doc->setCodTipoDocumento($_POST['cod_tipo_documento']);
    $doc->setStatus($_POST['status']);
    $doc->validarDocumento();
}else if($_POST['MM_action'] == 3){
    $obs = new Obs();
    $obs->setCodPessoa($_POST['cod_pessoa']);   
    $obs->setObs($_POST['obs']);
    $obs->inserirObs();
}else if($_POST['MM_action'] == 4){

    $cod_pessoa = $_POST['cod_pessoa'];
    $sl = 0;
    $sf = 0;
    $sc = 0;
    $sd = 0;
    $sr = 0;

    $l = new Documentos();
    $f = new Documentos();
    $c = new Documentos();
    $d = new Documentos();
    $r = new Documentos();

    if (isset($_FILES['laudo']) && $_FILES['laudo']['error'] == UPLOAD_ERR_OK) {
        $sl= 1;

        $caminho_laudo_antigo = $_POST['laudo_atual'];
        if(file_exists($caminho_laudo_antigo)){
            unlink($caminho_laudo_antigo);
        }

        $laudo = $_FILES['laudo'];

        if ($laudo['error']) {
            die("Falha ao reenviar o laudo");
        }

        if ($laudo['size'] > 5242880) {
            die("O laudo inserido excede o valor máximo, por favor envie novamente");
        }

        $pasta = "../uploads/";
        $nomeLaudo = $laudo['name'];
        $novoNomeLaudo = uniqid();
        $extensaoLaudo = strtolower(pathinfo($nomeLaudo, PATHINFO_EXTENSION));
        $caminhoLaudo = $pasta . $novoNomeLaudo . "." . $extensaoLaudo;

        if ($extensaoLaudo != "pdf" && $extensaoLaudo != "png" && $extensaoLaudo != "jpg" && $extensaoLaudo != "jpeg") {
            die("O laudo enviado não está no tipo especificado, por favor, envie em outro formato");
        }

        move_uploaded_file($laudo["tmp_name"], $pasta . $novoNomeLaudo . "." . $extensaoLaudo);

        $l->setCodTipoDocumento(2);
        $l->setVchDocumento($caminhoLaudo);
        $l->setStatus(0);
    }else{
        $l = 0;
    }
    
    
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $sf = 1;

        $caminho_foto_antiga = $_POST['foto_atual'];
        if(file_exists($caminho_foto_antiga)){
            unlink($caminho_foto_antiga);
        }

        $foto = $_FILES['foto'];

        if ($foto['error']) {
            die("Falha ao enviar imagem");
        }

        if ($foto['size'] > 5242880) {
            die("O laudo inserido excede o valor máximo, por favor envie novamente");
        }

        $pasta = "../uploads/";
        $nomeFoto = $foto['name'];
        $novoNomeFoto = uniqid();
        $extensaoFoto = strtolower(pathinfo($nomeFoto, PATHINFO_EXTENSION));
        $caminhoFoto = $pasta . $novoNomeFoto . "." . $extensaoFoto;

        if ($extensaoFoto != "png" && $extensaoFoto != "jpg" && $extensaoFoto != "jpeg") {
            die("A foto enviada não está no tipo especificado, por favor, envie em outro formato");
        }
        move_uploaded_file($foto["tmp_name"], $pasta . $novoNomeFoto . "." . $extensaoFoto);

        $f->setCodTipoDocumento(1);
        $f->setVchDocumento($caminhoFoto);
        $f->setStatus(0);
    }else{
        $f = 0;
    }

    if (isset($_FILES['comp_residencia']) && $_FILES['comp_residencia']['error'] == UPLOAD_ERR_OK) {
        $sc= 1;
        
        $caminho_comprovante_antigo = $_POST['comprovante_atual'];
        if(file_exists($caminho_comprovante_antigo)){
            unlink($caminho_comprovante_antigo);
        }

        $comprovante = $_FILES['comp_residencia'];

        if ($comprovante['error']) {
            die("Falha ao reenviar o comprovante");
        }

        if ($comprovante['size'] > 5242880) {
            die("O comprovante inserido excede o valor máximo, por favor envie novamente");
        }

        $pasta = "../uploads/";
        $nomeComprovante = $comprovante['name'];
        $novoNomeComprovante = uniqid();
        $extensaoComprovante = strtolower(pathinfo($nomeComprovante, PATHINFO_EXTENSION));
        $caminhoComprovante = $pasta . $novoNomeComprovante . "." . $extensaoComprovante;

        if ($extensaoComprovante != "pdf" && $extensaoComprovante != "png" && $extensaoComprovante != "jpg" && $extensaoComprovante != "jpeg") {
            die("O Comprovante enviado não está no tipo especificado, por favor, envie em outro formato");
        }

        move_uploaded_file($comprovante["tmp_name"], $pasta . $novoNomeComprovante . "." . $extensaoComprovante);

        $c->setCodTipoDocumento(3);
        $c->setVchDocumento($caminhoComprovante);
        $c->setStatus(0);
    }else{
        $c = 0;
    }

    if (isset($_FILES['doc_foto']) && $_FILES['doc_foto']['error'] == UPLOAD_ERR_OK) {
        $sd= 1;

        $caminho_documento_antigo = $_POST['documento_atual'];
        if(file_exists($caminho_documento_antigo)){
            unlink($caminho_documento_antigo);
        }

        $documento = $_FILES['doc_foto'];

        if ($documento['error']) {
            die("Falha ao reenviar o comprovante");
        }

        if ($documento['size'] > 5242880) {
            die("O comprovante inserido excede o valor máximo, por favor envie novamente");
        }

        $pasta = "../uploads/";
        $nomeDocumento = $documento['name'];
        $novoNomeDocumento = uniqid();
        $extensaoDocumento = strtolower(pathinfo($nomeDocumento, PATHINFO_EXTENSION));
        $caminhoDocumento = $pasta . $novoNomeDocumento . "." . $extensaoDocumento;

        if ($extensaoDocumento != "pdf" && $extensaoDocumento != "png" && $extensaoDocumento != "jpg" && $extensaoDocumento != "jpeg") {
            die("O Documento enviado não está no tipo especificado, por favor, envie em outro formato");
        }

        move_uploaded_file($documento["tmp_name"], $pasta . $novoNomeDocumento . "." . $extensaoDocumento);

        $d->setCodTipoDocumento(4);
        $d->setVchDocumento($caminhoDocumento);
        $d->setStatus(0);
    }else{
        $d = 0;
    }

    if (isset($_FILES['form_requerimento']) && $_FILES['form_requerimento']['error'] == UPLOAD_ERR_OK) {
        $sr= 1;

        $caminho_requerimento_antigo = $_POST['requerimento_atual'];
        if(file_exists($caminho_requerimento_antigo)){
            unlink($caminho_requerimento_antigo);
        }

        $requerimento = $_FILES['form_requerimento'];

        if ($requerimento['error']) {
            die("Falha ao reenviar o requerimento");
        }

        if ($requerimento['size'] > 5242880) {
            die("O requerimento inserido excede o valor máximo, por favor envie novamente");
        }

        $pasta = "../uploads/";
        $nomeRequerimento = $requerimento['name'];
        $novoNomeRequerimento = uniqid();
        $extensaoRequerimento = strtolower(pathinfo($nomeRequerimento, PATHINFO_EXTENSION));
        $caminhoRequerimento = $pasta . $novoNomeRequerimento . "." . $extensaoRequerimento;

        if ($extensaoRequerimento != "pdf" && $extensaoRequerimento != "png" && $extensaoRequerimento != "jpg" && $extensaoRequerimento != "jpeg") {
            die("O Requerimento enviado não está no tipo especificado, por favor, envie em outro formato");
        }

        move_uploaded_file($requerimento["tmp_name"], $pasta . $novoNomeRequerimento . "." . $extensaoRequerimento);

        $r->setCodTipoDocumento(4);
        $r->setVchDocumento($caminhoRequerimento);
        $r->setStatus(0);
    }else{
        $r = 0;
    }
    

    if ($_POST['bool_representante_legal'] == 0) {
        $pessoa->atualizarPessoa($sl, $sf, $sc, $sd, $sr, $l, $f, $c, $d, $r, $cod_usuario, $cod_pessoa);
    } else if ($_POST['bool_representante_legal'] == 1) {
        $responsavel = new Responsavel();
        
        if (isset($_POST['cod_pessoa'])) {
            $responsavel->setCodPessoa($_POST['cod_pessoa']);
        }

        if (isset($_POST['vch_nome_reponsavel'])) {
            $responsavel->setVchNomeResponsavel($_POST['vch_nome_reponsavel']);
        }

        if (isset($_POST['vch_telefone_responsavel'])) {
            $responsavel->setVchTelefoneResponsavel($_POST['vch_telefone_responsavel']);
        }

        if (isset($_POST['vch_cpf_responsavel'])) {
            $responsavel->setVchCpfResponsavel($_POST['vch_cpf_responsavel']);
        }

        if (isset($_POST['vch_endereco_responsavel'])) {
            $responsavel->setVchEnderecoResponsavel($_POST['vch_endereco_responsavel']);
        }

        if (isset($_POST['vch_bairro_responsavel'])) {
            $responsavel->setVchBairroResponsavel($_POST['vch_bairro_responsavel']);
        }

        if (isset($_POST['vch_cep_responsavel'])) {
            $responsavel->setVchCepResponsavel($_POST['vch_cep_responsavel']);
        }

        if (isset($_POST['vch_cidade_responsavel'])) {
            $responsavel->setVchCidadeResponsavel($_POST['vch_cidade_responsavel']);
        }
        $pessoa->setResposavel($responsavel);
        $pessoa->atualizarPessoaResponsavel($sl, $sf, $sc, $sd, $sr, $l, $f, $c, $d, $r, $cod_usuario, $cod_pessoa);

    }
}else if($_POST['MM_action'] == 5){

    $cod_pessoa = $_POST['cod_pessoa'];
    $doc_requerimento = new Documentos();
    // die(var_dump($_FILES['form_requerimento']));
    if (isset($_FILES['form_requerimento']) && $_FILES['form_requerimento']['error'] == UPLOAD_ERR_OK) {
        $requerimento = $_FILES['form_requerimento'];

        if ($requerimento['error']) {
            die("Falha ao enviar o requerimento");
        }
        if ($requerimento['size'] > 5242880) {
            die("O requerimento enviado excede o valor máximo, por favor envie novamente");
        }
        

        $pasta = "../uploads/";

        $nomeRequerimento = $requerimento['name'];
        $novoNomeRequerimento = uniqid();
        $extensaoRequerimento = strtolower(pathinfo($nomeRequerimento, PATHINFO_EXTENSION));
        $caminhoRequerimento = $pasta . $novoNomeRequerimento . "." . $extensaoRequerimento;


        if ($extensaoRequerimento != "pdf" && $extensaoRequerimento != "png" && $extensaoRequerimento != "jpg" && $extensaoRequerimento != "jpeg") {
            die("O requerimento enviado não está no tipo especificado, por favor, envie em outro formato");
        }
        
        
        move_uploaded_file($requerimento["tmp_name"], $pasta . $novoNomeRequerimento . "." . $extensaoRequerimento);
        
        $doc_requerimento->setCodPessoa($cod_pessoa);
        $doc_requerimento->setCodTipoDocumento(5);
        $doc_requerimento->setVchDocumento($caminhoRequerimento);
        $doc_requerimento->setStatus(0);

        $doc_requerimento->inserirRequerimento($cod_pessoa);
    }else{
        echo "Erro ao tentar inserir, provavelmente file vazio";
    }
}
