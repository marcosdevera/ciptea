<?php

include_once('conexao.class.php');
include_once('responsavel.class.php');
include_once('documentos.class.php');
include_once('usuario.class.php');

class Pessoa
{
    private Responsavel $responsavel;
    private Documentos $laudo;
    private Documentos $foto;
    private Documentos $comprovante;
    private Documentos $documento;
    private Documentos $requerimento;
    private Usuario $usuario;
    private $vch_nome;
    private $vch_telefone;
    private $vch_telefone_contato;
    private $int_sexo;
    private $cid;
    private $vch_tipo_sanguineo;
    private $vch_nome_social;
    private $vch_nome_pai;
    private $vch_nome_mae;
    private $sdt_nascimento;
    private $endereco;
    private $bairro;
    private $cep;
    private $cidade;
    private $vch_rg;
    private $vch_cpf;
    private $vch_num_cartao_sus;
    private $bool_representante_legal;

    public function setResposavel($responsavel)
    {
        $this->responsavel = $responsavel;
    }

    public function getResponsavel()
    {
        return $this->responsavel;
    }

    public function setLaudo($laudo)
    {
        $this->laudo = $laudo;
    }

    public function getLaudo()
    {
        return $this->laudo;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function setComprovante($comprovante)
    {
        $this->comprovante = $comprovante;
    }

    public function getComprovante()
    {
        return $this->comprovante;
    }

    public function setDocumento($documento)
    {
        $this->documento = $documento;
    }

    public function getDocumento()
    {
        return $this->documento;
    }

    public function setRequerimento($requerimento)
    {
        $this->requerimento = $requerimento;
    }

    public function getRequerimento()
    {
        return $this->requerimento;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setVchNome($vch_nome)
    {
        $this->vch_nome = $vch_nome;
    }

    public function getVchNome()
    {
        return $this->vch_nome;
    }

    public function setVchTelefone($vch_telefone)
    {
        $this->vch_telefone = $vch_telefone;
    }

    public function getVchTelefone()
    {
        return $this->vch_telefone;
    }

    public function setVchTelefoneContato($vch_telefone_contato)
    {
        $this->vch_telefone_contato = $vch_telefone_contato;
    }

    public function getVchTelefoneContato()
    {
        return $this->vch_telefone_contato;
    }

    public function setVchNomeSocial($vch_nome_social)
    {
        $this->vch_nome_social = $vch_nome_social;
    }

    public function getVchNomeSocial()
    {
        return $this->vch_nome_social;
    }

    public function setIntSexo($int_sexo)
    {
        $this->int_sexo = $int_sexo;
    }

    public function getIntSexo()
    {
        return $this->int_sexo;
    }

    public function setCid($cid)
    {
        $this->cid = $cid;
    }

    public function getCid()
    {
        return $this->cid;
    }

    public function setVchTipoSanguineo($vch_tipo_sanguineo)
    {
        $this->vch_tipo_sanguineo = $vch_tipo_sanguineo;
    }

    public function getVchTipoSanguineo()
    {
        return $this->vch_tipo_sanguineo;
    }

    public function setVchNomePai($vch_nome_pai)
    {
        $this->vch_nome_pai = $vch_nome_pai;
    }

    public function getVchNomePai()
    {
        return $this->vch_nome_pai;
    }

    public function setVchNomeMae($vch_nome_mae)
    {
        $this->vch_nome_mae = $vch_nome_mae;
    }

    public function getVchNomeMae()
    {
        return $this->vch_nome_mae;
    }

    public function setSdtNascimento($sdt_nascimento)
    {
        $this->sdt_nascimento = $sdt_nascimento;
    }

    public function getSdtNascimento()
    {
        return $this->sdt_nascimento;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function setVchRg($vch_rg)
    {
        $this->vch_rg = $vch_rg;
    }

    public function getVchRg()
    {
        return $this->vch_rg;
    }

    public function setVchCpf($vch_cpf)
    {
        $this->vch_cpf = $vch_cpf;
    }

    public function getVchCpf()
    {
        return $this->vch_cpf;
    }

    public function setVchNumCartaoSus($vch_num_cartao_sus)
    {
        $this->vch_num_cartao_sus = $vch_num_cartao_sus;
    }

    public function getVchNumCartaoSus()
    {
        return $this->vch_num_cartao_sus;
    }

    public function setBoolRepresentanteLegal($bool_representante_legal)
    {
        $this->bool_representante_legal = $bool_representante_legal;
    }

    public function getBoolRepresentanteLegal()
    {
        return $this->bool_representante_legal;
    }

    public function inserirPessoa($laudo, $foto, $comprovante, $documento, $usuario)
    {
        try {
            $pdo = Database::conexao();
            $pdo->beginTransaction();

            $consulta = $pdo->prepare("INSERT INTO ciptea.dados_pessoa(vch_nome, vch_nome_social, vch_telefone, vch_telefone_contato, cid, vch_tipo_sanguineo, int_sexo, vch_nome_pai, vch_nome_mae, sdt_nascimento, endereco, bairro, cep, cidade, vch_rg, vch_cpf, vch_num_cartao_sus, bool_representante_legal) 
            VALUES (:vch_nome, :vch_nome_social, :vch_telefone, :vch_telefone_contato, :cid, :vch_tipo_sanguineo, :int_sexo, :vch_nome_pai, :vch_nome_mae, :sdt_nascimento, :endereco, :bairro, :cep, :cidade, :vch_rg, :vch_cpf, :vch_num_cartao_sus, :bool_representante_legal)");
            $consulta->bindParam(':vch_nome', $this->vch_nome);
            $consulta->bindParam(':vch_nome_social', $this->vch_nome_social);
            $consulta->bindParam(':vch_telefone_contato', $this->vch_telefone_contato);
            $consulta->bindParam(':cid', $this->cid);
            $consulta->bindParam(':vch_tipo_sanguineo', $this->vch_tipo_sanguineo);
            $consulta->bindParam(':vch_telefone', $this->vch_telefone);
            $consulta->bindParam(':int_sexo', $this->int_sexo);
            $consulta->bindParam(':vch_nome_pai', $this->vch_nome_pai);
            $consulta->bindParam(':vch_nome_mae', $this->vch_nome_mae);
            $consulta->bindParam(':sdt_nascimento', $this->sdt_nascimento);
            $consulta->bindParam(':endereco', $this->endereco);
            $consulta->bindParam(':bairro', $this->bairro);
            $consulta->bindParam(':cep', $this->cep);
            $consulta->bindParam(':cidade', $this->cidade);
            $consulta->bindParam(':vch_rg', $this->vch_rg);
            $consulta->bindParam(':vch_cpf', $this->vch_cpf);
            $consulta->bindParam(':vch_num_cartao_sus', $this->vch_num_cartao_sus);
            $consulta->bindParam(':bool_representante_legal', $this->bool_representante_legal);
            $consulta->execute();

            $codPessoa = $pdo->lastInsertId();


            $data_atual = date('Y-m-d H:i:s');
            $this->setLaudo($laudo);
            $cod_tipo_laudo = $this->laudo->getCodTipoDocumento();
            $vch_documento_laudo = $this->laudo->getVchDocumento();
            $status_laudo = $this->laudo->getStatus();

            $this->setFoto($foto);
            $cod_tipo_foto = $this->foto->getCodTipoDocumento();
            $vch_documento_foto = $this->foto->getVchDocumento();
            $status_foto = $this->foto->getStatus();

            $this->setComprovante($comprovante);
            $cod_tipo_comprovante = $this->comprovante->getCodTipoDocumento();
            $vch_documento_comprovante = $this->comprovante->getVchDocumento();
            $status_comprovante = $this->comprovante->getStatus();

            $this->setDocumento($documento);
            $cod_tipo_documento = $this->documento->getCodTipoDocumento();
            $vch_documento_documento = $this->documento->getVchDocumento();
            $status_documento = $this->documento->getStatus(); 

            $consulta_documentos = $pdo->prepare("INSERT INTO ciptea.documentos(cod_pessoa, cod_tipo_documento, vch_documento, sdt_insercao, status) 
            VALUES (:cod_pessoa, :cod_tipo_documento, :vch_documento, :sdt_insercao, :status)");

            $consulta_documentos->bindParam(':cod_pessoa', $codPessoa);
            $consulta_documentos->bindParam(':cod_tipo_documento', $cod_tipo_laudo);
            $consulta_documentos->bindParam(':vch_documento', $vch_documento_laudo);
            $consulta_documentos->bindParam(':sdt_insercao', $data_atual);
            $consulta_documentos->bindParam(':status', $status_laudo);
            $consulta_documentos->execute();

            $consulta_documentos->bindParam(':cod_pessoa', $codPessoa);
            $consulta_documentos->bindParam(':cod_tipo_documento', $cod_tipo_foto);
            $consulta_documentos->bindParam(':vch_documento', $vch_documento_foto);
            $consulta_documentos->bindParam(':sdt_insercao', $data_atual);
            $consulta_documentos->bindParam(':status', $status_foto);
            $consulta_documentos->execute();

            $consulta_documentos->bindParam(':cod_pessoa', $codPessoa);
            $consulta_documentos->bindParam(':cod_tipo_documento', $cod_tipo_comprovante);
            $consulta_documentos->bindParam(':vch_documento', $vch_documento_comprovante);
            $consulta_documentos->bindParam(':sdt_insercao', $data_atual);
            $consulta_documentos->bindParam(':status', $status_comprovante);
            $consulta_documentos->execute();

            $consulta_documentos->bindParam(':cod_pessoa', $codPessoa);
            $consulta_documentos->bindParam(':cod_tipo_documento', $cod_tipo_documento);
            $consulta_documentos->bindParam(':vch_documento', $vch_documento_documento);
            $consulta_documentos->bindParam(':sdt_insercao', $data_atual);
            $consulta_documentos->bindParam(':status', $status_documento);
            $consulta_documentos->execute();

            $this->setUsuario($usuario);
            $vch_login = $this->usuario->getVch_login();
            $vch_senha = $this->usuario->getVch_senha();
            $int_perfil = $this->usuario->getInt_perfil();
            $int_situacao = $this->usuario->getInt_situacao();
            $consulta_usuario = $pdo->prepare("INSERT INTO ciptea.usuario(vch_login, vch_senha, int_perfil, int_situacao) 
            VALUES (:vch_login, :vch_senha, :int_perfil, :int_situacao)");
            $consulta_usuario->bindParam(':vch_login', $vch_login);
            $consulta_usuario->bindParam(':vch_senha', $vch_senha);
            $consulta_usuario->bindParam(':int_perfil', $int_perfil);
            $consulta_usuario->bindParam(':int_situacao', $int_situacao);
            $consulta_usuario->execute();

            $cod_usuario = $pdo->lastInsertId();
            $update_pessoa = $pdo->prepare("UPDATE ciptea.dados_pessoa 
            SET cod_usuario = :cod_usuario 
            WHERE cod_pessoa = :cod_pessoa");
            $update_pessoa->bindParam(':cod_usuario', $cod_usuario);
            $update_pessoa->bindParam(':cod_pessoa', $codPessoa);
            $update_pessoa->execute();

            $pdo->commit();
            header('Location: ../index.php?msg=1');
        } catch (PDOException $e) {
            $pdo->rollBack();
            echo "Ocorreu um erro: $e";
        }
    }

    public function inserirPessoaResponsavel($laudo, $foto, $comprovante, $documento, $usuario)
    {
        try {
            $pdo = Database::conexao();
            // Iniciando a transação
            $pdo->beginTransaction();

            // Inserindo os dados na tabela pessoa
            $consulta = $pdo->prepare("INSERT INTO ciptea.dados_pessoa(vch_nome, vch_nome_social, vch_telefone, vch_telefone_contato, cid, vch_tipo_sanguineo, int_sexo, vch_nome_pai, vch_nome_mae, sdt_nascimento, endereco, bairro, cep, cidade, vch_rg, vch_cpf, vch_num_cartao_sus, bool_representante_legal) 
            VALUES (:vch_nome, :vch_nome_social, :vch_telefone, :vch_telefone_contato, :cid, :vch_tipo_sanguineo, :int_sexo, :vch_nome_pai, :vch_nome_mae, :sdt_nascimento, :endereco, :bairro, :cep, :cidade, :vch_rg, :vch_cpf, :vch_num_cartao_sus, :bool_representante_legal)");
            $consulta->bindParam(':vch_nome', $this->vch_nome);
            $consulta->bindParam(':vch_nome_social', $this->vch_nome_social);
            $consulta->bindParam(':vch_telefone_contato', $this->vch_telefone_contato);
            $consulta->bindParam(':cid', $this->cid);
            $consulta->bindParam(':vch_tipo_sanguineo', $this->vch_tipo_sanguineo);
            $consulta->bindParam(':vch_telefone', $this->vch_telefone);
            $consulta->bindParam(':int_sexo', $this->int_sexo);
            $consulta->bindParam(':vch_nome_pai', $this->vch_nome_pai);
            $consulta->bindParam(':vch_nome_mae', $this->vch_nome_mae);
            $consulta->bindParam(':sdt_nascimento', $this->sdt_nascimento);
            $consulta->bindParam(':endereco', $this->endereco);
            $consulta->bindParam(':bairro', $this->bairro);
            $consulta->bindParam(':cep', $this->cep);
            $consulta->bindParam(':cidade', $this->cidade);
            $consulta->bindParam(':vch_rg', $this->vch_rg);
            $consulta->bindParam(':vch_cpf', $this->vch_cpf);
            $consulta->bindParam(':vch_num_cartao_sus', $this->vch_num_cartao_sus);
            $consulta->bindParam(':bool_representante_legal', $this->bool_representante_legal);
            $consulta->execute();
            // Obtendo o ID gerado pela inserção na tabela pessoa
            $codPessoa = $pdo->lastInsertId();

            $vch_nome_resp = $this->responsavel->getVchNomeResponsavel();
            $vch_telefone_resp = $this->responsavel->getVchTelefoneResponsavel();
            $vch_cpf_resp = $this->responsavel->getVchCpfResponsavel();
            $vch_endereco_resp = $this->responsavel->getVchEnderecoResponsavel();
            $vch_bairro_resp = $this->responsavel->getVchBairroResponsavel();
            $vch_cep = $this->responsavel->getVchCepResponsavel();
            $vch_cidade_resp = $this->responsavel->getVchCidadeResponsavel();
            $int_sexo_responsavel = $this->responsavel->getIntSexoResponsavel();
            $int_num_responsavel = $this->responsavel->getNumResponsavel();
            $vch_comp_responsavel = $this->responsavel->getCompResponsavel();

            // Inserindo os dados na tabela responsavel usando o ID da pessoa
            $stmtResponsavel = $pdo->prepare("INSERT INTO ciptea.dados_responsavel_legal(vch_nome_responsavel, int_sexo_responsavel, vch_telefone_responsavel, vch_cpf_responsavel, vch_endereco_responsavel, int_num_responsavel, vch_comp_responsavel, vch_bairro_responsavel, vch_cep_responsavel, vch_cidade_responsavel, cod_pessoa) 
            VALUES (:vch_nome_responsavel, :int_sexo_responsavel,:vch_telefone_responsavel, :vch_cpf_responsavel, :vch_endereco_responsavel, :int_num_responsavel, :vch_comp_responsavel, :vch_bairro_responsavel, :vch_cep_responsavel, :vch_cidade_responsavel, :cod_pessoa)");
            $stmtResponsavel->bindParam(':cod_pessoa', $codPessoa);
            $stmtResponsavel->bindParam(':vch_nome_responsavel', $vch_nome_resp);
            $stmtResponsavel->bindParam(':int_sexo_responsavel', $int_sexo_responsavel);
            $stmtResponsavel->bindParam(':vch_telefone_responsavel', $vch_telefone_resp);
            $stmtResponsavel->bindParam(':vch_cpf_responsavel', $vch_cpf_resp);
            $stmtResponsavel->bindParam(':vch_endereco_responsavel', $vch_endereco_resp);
            $stmtResponsavel->bindParam(':int_num_responsavel', $int_num_responsavel);
            $stmtResponsavel->bindParam(':vch_comp_responsavel', $vch_comp_responsavel);
            $stmtResponsavel->bindParam(':vch_bairro_responsavel', $vch_bairro_resp);
            $stmtResponsavel->bindParam(':vch_cep_responsavel', $vch_cep);
            $stmtResponsavel->bindParam(':vch_cidade_responsavel', $vch_cidade_resp);
            $stmtResponsavel->execute();


            $data_atual = date('Y-m-d H:i:s');
            $this->setLaudo($laudo);
            $this->setFoto($foto);
            $cod_tipo_laudo = $this->laudo->getCodTipoDocumento();
            $vch_documento_laudo = $this->laudo->getVchDocumento();
            $status_laudo = $this->laudo->getStatus();

            $cod_tipo_foto = $this->foto->getCodTipoDocumento();
            $vch_documento_foto = $this->foto->getVchDocumento();
            $status_foto = $this->foto->getStatus();

            $this->setComprovante($comprovante);
            $cod_tipo_comprovante = $this->comprovante->getCodTipoDocumento();
            $vch_documento_comprovante = $this->comprovante->getVchDocumento();
            $status_comprovante = $this->comprovante->getStatus();

            $this->setDocumento($documento);
            $cod_tipo_documento = $this->documento->getCodTipoDocumento();
            $vch_documento_documento = $this->documento->getVchDocumento();
            $status_documento = $this->documento->getStatus();

            $consulta_documentos = $pdo->prepare("INSERT INTO ciptea.documentos(cod_pessoa, cod_tipo_documento, vch_documento, sdt_insercao, status) 
            VALUES (:cod_pessoa, :cod_tipo_documento, :vch_documento, :sdt_insercao, :status)");

            $consulta_documentos->bindParam(':cod_pessoa', $codPessoa);
            $consulta_documentos->bindParam(':cod_tipo_documento', $cod_tipo_laudo);
            $consulta_documentos->bindParam(':vch_documento', $vch_documento_laudo);
            $consulta_documentos->bindParam(':sdt_insercao', $data_atual);
            $consulta_documentos->bindParam(':status', $status_laudo);
            $consulta_documentos->execute();

            $consulta_documentos->bindParam(':cod_pessoa', $codPessoa);
            $consulta_documentos->bindParam(':cod_tipo_documento', $cod_tipo_foto);
            $consulta_documentos->bindParam(':vch_documento', $vch_documento_foto);
            $consulta_documentos->bindParam(':sdt_insercao', $data_atual);
            $consulta_documentos->bindParam(':status', $status_foto);
            $consulta_documentos->execute();

            $consulta_documentos->bindParam(':cod_pessoa', $codPessoa);
            $consulta_documentos->bindParam(':cod_tipo_documento', $cod_tipo_comprovante);
            $consulta_documentos->bindParam(':vch_documento', $vch_documento_comprovante);
            $consulta_documentos->bindParam(':sdt_insercao', $data_atual);
            $consulta_documentos->bindParam(':status', $status_comprovante);
            $consulta_documentos->execute();

            $consulta_documentos->bindParam(':cod_pessoa', $codPessoa);
            $consulta_documentos->bindParam(':cod_tipo_documento', $cod_tipo_documento);
            $consulta_documentos->bindParam(':vch_documento', $vch_documento_documento);
            $consulta_documentos->bindParam(':sdt_insercao', $data_atual);
            $consulta_documentos->bindParam(':status', $status_documento);
            $consulta_documentos->execute();

            $this->setUsuario($usuario);
            $vch_login = $this->usuario->getVch_login();
            $vch_senha = $this->usuario->getVch_senha();
            $int_perfil = $this->usuario->getInt_perfil();
            $int_situacao = $this->usuario->getInt_situacao();
            $consulta_usuario = $pdo->prepare("INSERT INTO ciptea.usuario(vch_login, vch_senha, int_perfil, int_situacao) 
            VALUES (:vch_login, :vch_senha, :int_perfil, :int_situacao)");
            $consulta_usuario->bindParam(':vch_login', $vch_login);
            $consulta_usuario->bindParam(':vch_senha', $vch_senha);
            $consulta_usuario->bindParam(':int_perfil', $int_perfil);
            $consulta_usuario->bindParam(':int_situacao', $int_situacao);
            $consulta_usuario->execute();

            $cod_usuario = $pdo->lastInsertId();
            
            $update_pessoa = $pdo->prepare("UPDATE ciptea.dados_pessoa 
            SET cod_usuario = :cod_usuario 
            WHERE cod_pessoa = :cod_pessoa");
            $update_pessoa->bindParam(':cod_usuario', $cod_usuario);
            $update_pessoa->bindParam(':cod_pessoa', $codPessoa);
            $update_pessoa->execute();
            // Comitando a transação
            $pdo->commit();

            header('Location: ../index.php?msg=1');
        } catch (PDOException $e) {
            // Se ocorrer algum erro, reverta a transação
            $pdo->rollBack();
            echo "Erro: " . $e->getMessage();
        }
    }

    public function atualizarPessoa($sl, $sf, $sc, $sd, $sr, $laudo, $foto, $comprovante, $documento, $requerimento, $cod_usuario, $cod_pessoa){
        try {
            $pdo = Database::conexao();
            // Iniciando a transação
            $pdo->beginTransaction();
            $data_atual = date('Y-m-d H:i:s');
            // Inserindo os dados na tabela pessoa
            $update_pessoa = $pdo->prepare("UPDATE ciptea.dados_pessoa 
            SET vch_nome = :vch_nome,
                cid = :cid,
                vch_tipo_sanguineo = :vch_tipo_sanguineo,
                vch_telefone_contato = :vch_telefone_contato,
                vch_nome_pai = :vch_nome_pai,
                vch_nome_mae = :vch_nome_mae,
                sdt_nascimento = :sdt_nascimento,
                endereco = :endereco,
                bairro = :bairro,
                cep = :cep,
                cidade = :cidade,
                vch_rg = :vch_rg,
                vch_cpf = :vch_cpf,
                vch_num_cartao_sus = :vch_num_cartao_sus,
                bool_representante_legal = :bool_representante_legal 
            WHERE cod_usuario = :cod_usuario");
            $update_pessoa->bindParam(':cod_usuario', $cod_usuario);
            $update_pessoa->bindParam(':vch_nome', $this->vch_nome);
            $update_pessoa->bindParam(':cid', $this->cid);
            $update_pessoa->bindParam(':vch_tipo_sanguineo', $this->vch_tipo_sanguineo);
            $update_pessoa->bindParam(':vch_telefone_contato', $this->vch_telefone_contato);
            $update_pessoa->bindParam(':vch_nome_pai', $this->vch_nome_pai);
            $update_pessoa->bindParam(':vch_nome_mae', $this->vch_nome_mae);
            $update_pessoa->bindParam(':sdt_nascimento', $this->sdt_nascimento);
            $update_pessoa->bindParam(':endereco', $this->endereco);
            $update_pessoa->bindParam(':bairro', $this->bairro);
            $update_pessoa->bindParam(':cep', $this->cep);
            $update_pessoa->bindParam(':cidade', $this->cidade);
            $update_pessoa->bindParam(':vch_rg', $this->vch_rg);
            $update_pessoa->bindParam(':vch_cpf', $this->vch_cpf);
            $update_pessoa->bindParam(':vch_num_cartao_sus', $this->vch_num_cartao_sus);
            $update_pessoa->bindParam(':bool_representante_legal', $this->bool_representante_legal);
            $update_pessoa->execute();
            // Obtendo o ID gerado pela inserção na tabela pessoa
            // $codPessoa = $pdo->lastInsertId();

            if($sl == 1){
                $this->setLaudo($laudo);
                $vch_documento_laudo = $this->laudo->getVchDocumento();
                $status_laudo = $this->laudo->getStatus();
                $update_documentos = $pdo->prepare("UPDATE ciptea.documentos 
                SET vch_documento = :vch_documento,
                    status = :status, sdt_insercao = :sdt_insercao 
                WHERE cod_pessoa = :cod_pessoa AND cod_tipo_documento = 2");
                $update_documentos->bindParam(':cod_pessoa', $cod_pessoa);
                $update_documentos->bindParam(':vch_documento', $vch_documento_laudo);
                $update_documentos->bindParam(':status', $status_laudo);
                $update_documentos->bindParam(':sdt_insercao', $data_atual);
                $update_documentos->execute();
            }
            if($sf == 1){
                $this->setFoto($foto);
                $vch_documento_foto = $this->foto->getVchDocumento();
                $status_foto = $this->foto->getStatus();

                $update_documentos2 = $pdo->prepare("UPDATE ciptea.documentos 
                SET vch_documento = :vch_documento,
                    status = :status, sdt_insercao = :sdt_insercao 
                WHERE cod_pessoa = :cod_pessoa AND cod_tipo_documento = 1");
                $update_documentos2->bindParam(':cod_pessoa', $cod_pessoa);
                $update_documentos2->bindParam(':vch_documento', $vch_documento_foto);
                $update_documentos2->bindParam(':status', $status_foto);
                $update_documentos2->bindParam(':sdt_insercao', $data_atual);
                $update_documentos2->execute();
            }
            if($sc == 1){
                $this->setComprovante($comprovante);
                $vch_documento_comprovante = $this->comprovante->getVchDocumento();
                $status_comprovante = $this->comprovante->getStatus();

                $update_documentos3 = $pdo->prepare("UPDATE ciptea.documentos 
                SET vch_documento = :vch_documento,
                    status = :status, sdt_insercao = :sdt_insercao  
                WHERE cod_pessoa = :cod_pessoa AND cod_tipo_documento = 3");
                $update_documentos3->bindParam(':cod_pessoa', $cod_pessoa);
                $update_documentos3->bindParam(':vch_documento', $vch_documento_comprovante);
                $update_documentos3->bindParam(':status', $status_comprovante);
                $update_documentos3->bindParam(':sdt_insercao', $data_atual);
                $update_documentos3->execute();    
            }
            if($sd == 1){
                $this->setDocumento($documento);
                $vch_documento_documento = $this->documento->getVchDocumento();
                $status_documento = $this->documento->getStatus();

                $update_documentos4 = $pdo->prepare("UPDATE ciptea.documentos 
                SET vch_documento = :vch_documento,
                    status = :status, sdt_insercao = :sdt_insercao 
                WHERE cod_pessoa = :cod_pessoa AND cod_tipo_documento = 4");
                $update_documentos4->bindParam(':cod_pessoa', $cod_pessoa);
                $update_documentos4->bindParam(':vch_documento', $vch_documento_documento);
                $update_documentos4->bindParam(':status', $status_documento);
                $update_documentos4->bindParam(':sdt_insercao', $data_atual);
                $update_documentos4->execute();    
            }

            if($sr == 1){
                $this->setRequerimento($requerimento);
                $vch_documento_requerimento = $this->requerimento->getVchDocumento();
                $status_requerimento = $this->requerimento->getStatus();

                $update_documentos5 = $pdo->prepare("UPDATE ciptea.documentos 
                SET vch_documento = :vch_documento, 
                    status = :status, sdt_insercao = :sdt_insercao 
                WHERE cod_pessoa = :cod_pessoa AND cod_tipo_documento = 5");
                $update_documentos5->bindParam(':cod_pessoa', $cod_pessoa);
                $update_documentos5->bindParam(':vch_documento', $vch_documento_requerimento);
                $update_documentos5->bindParam(':status', $status_requerimento);
                $update_documentos5->bindParam(':sdt_insercao', $data_atual);
                $update_documentos5->execute();    
            }
            // Comitando a transação
            $pdo->commit();

            header('Location: ../pagina_usuario.php');
        } catch (PDOException $e) {
            // Se ocorrer algum erro, reverta a transação
            $pdo->rollBack();
            echo "Erro: " . $e->getMessage();
        }        
    }

    // public function atualizarPessoaResponsavel($sl, $sf, $sc, $sd, $sr, $laudo, $foto, $comprovante, $documento, $requerimento, $cod_usuario, $cod_pessoa){
    //     try {
    //         $pdo = Database::conexao();
    //         // Iniciando a transação
    //         $pdo->beginTransaction();

    //         // Inserindo os dados na tabela pessoa
    //         $update_pessoa = $pdo->prepare("UPDATE ciptea.dados_pessoa 
    //         SET vch_nome = :vch_nome,
    //             vch_nome_pai = :vch_nome_pai,
    //             vch_nome_mae = :vch_nome_mae,
    //             sdt_nascimento = :sdt_nascimento,
    //             endereco = :endereco,
    //             bairro = :bairro,
    //             cep = :cep,
    //             cidade = :cidade,
    //             vch_rg = :vch_rg,
    //             vch_cpf = :vch_cpf,
    //             vch_num_cartao_sus = :vch_num_cartao_sus,
    //             bool_representante_legal = :bool_representante_legal 
    //         WHERE cod_usuario = :cod_usuario");
    //         $update_pessoa->bindParam(':cod_usuario', $cod_usuario);
    //         $update_pessoa->bindParam(':vch_nome', $this->vch_nome);
    //         $update_pessoa->bindParam(':vch_nome_pai', $this->vch_nome_pai);
    //         $update_pessoa->bindParam(':vch_nome_mae', $this->vch_nome_mae);
    //         $update_pessoa->bindParam(':sdt_nascimento', $this->sdt_nascimento);
    //         $update_pessoa->bindParam(':endereco', $this->endereco);
    //         $update_pessoa->bindParam(':bairro', $this->bairro);
    //         $update_pessoa->bindParam(':cep', $this->cep);
    //         $update_pessoa->bindParam(':cidade', $this->cidade);
    //         $update_pessoa->bindParam(':vch_rg', $this->vch_rg);
    //         $update_pessoa->bindParam(':vch_cpf', $this->vch_cpf);
    //         $update_pessoa->bindParam(':vch_num_cartao_sus', $this->vch_num_cartao_sus);
    //         $update_pessoa->bindParam(':bool_representante_legal', $this->bool_representante_legal);
    //         $update_pessoa->execute();
    //         // Obtendo o ID gerado pela inserção na tabela pessoa
    //         // $codPessoa = $pdo->lastInsertId();

    //         $cod_pessoa = $this->responsavel->getCodPessoa();
    //         $vch_nome_resp = $this->responsavel->getVchNomeResponsavel();
    //         $vch_telefone_resp = $this->responsavel->getVchTelefoneResponsavel();
    //         $vch_cpf_resp = $this->responsavel->getVchCpfResponsavel();
    //         $vch_endereco_resp = $this->responsavel->getVchEnderecoResponsavel();
    //         $vch_bairro_resp = $this->responsavel->getVchBairroResponsavel();
    //         $vch_cep = $this->responsavel->getVchCepResponsavel();
    //         $vch_cidade_resp = $this->responsavel->getVchCidadeResponsavel();

    //         // Inserindo os dados na tabela responsavel usando o ID da pessoa
    //         $stmtResponsavel = $pdo->prepare("UPDATE ciptea.dados_responsavel_legal 
    //         SET vch_nome_responsavel = :vch_nome_responsavel,
    //             vch_telefone_responsavel = :vch_telefone_responsavel,
    //             vch_cpf_responsavel = :vch_cpf_responsavel,
    //             vch_endereco_responsavel = :vch_endereco_responsavel,
    //             vch_bairro_responsavel = :vch_bairro_responsavel,
    //             vch_cep_responsavel = :vch_cep_responsavel,
    //             vch_cidade_responsavel = :vch_cidade_responsavel 
    //         WHERE cod_pessoa = :cod_pessoa");
    //         $stmtResponsavel->bindParam(':cod_pessoa', $cod_pessoa);
    //         $stmtResponsavel->bindParam(':vch_nome_responsavel', $vch_nome_resp);
    //         $stmtResponsavel->bindParam(':vch_telefone_responsavel', $vch_telefone_resp);
    //         $stmtResponsavel->bindParam(':vch_cpf_responsavel', $vch_cpf_resp);
    //         $stmtResponsavel->bindParam(':vch_endereco_responsavel', $vch_endereco_resp);
    //         $stmtResponsavel->bindParam(':vch_bairro_responsavel', $vch_bairro_resp);
    //         $stmtResponsavel->bindParam(':vch_cep_responsavel', $vch_cep);
    //         $stmtResponsavel->bindParam(':vch_cidade_responsavel', $vch_cidade_resp);
    //         $stmtResponsavel->execute();

    //         if($sl == 1){
    //             $this->setLaudo($laudo);
    //             $vch_documento_laudo = $this->laudo->getVchDocumento();
    //             $status_laudo = $this->laudo->getStatus();

    //             $update_documentos = $pdo->prepare("UPDATE ciptea.documentos 
    //             SET vch_documento = :vch_documento,
    //                 status = :status 
    //             WHERE cod_pessoa = :cod_pessoa AND cod_tipo_documento = 2");
    //             $update_documentos->bindParam(':cod_pessoa', $cod_pessoa);
    //             $update_documentos->bindParam(':vch_documento', $vch_documento_laudo);
    //             $update_documentos->bindParam(':status', $status_laudo);
    //             $update_documentos->execute();
    //         }
    //         if($sf == 1){
    //             $this->setFoto($foto);
    //             $vch_documento_foto = $this->foto->getVchDocumento();
    //             $status_foto = $this->foto->getStatus();

    //             $update_documentos2 = $pdo->prepare("UPDATE ciptea.documentos 
    //             SET vch_documento = :vch_documento,
    //                 status = :status 
    //             WHERE cod_pessoa = :cod_pessoa AND cod_tipo_documento = 1");
    //             $update_documentos2->bindParam(':cod_pessoa', $cod_pessoa);
    //             $update_documentos2->bindParam(':vch_documento', $vch_documento_foto);
    //             $update_documentos2->bindParam(':status', $status_foto);
    //             $update_documentos2->execute();
    //         }
    //         if($sc == 1){
    //             $this->setComprovante($comprovante);
    //             $vch_documento_comprovante = $this->comprovante->getVchDocumento();
    //             $status_comprovante = $this->comprovante->getStatus();

    //             $update_documentos3 = $pdo->prepare("UPDATE ciptea.documentos 
    //             SET vch_documento = :vch_documento,
    //                 status = :status 
    //             WHERE cod_pessoa = :cod_pessoa AND cod_tipo_documento = 3");
    //             $update_documentos3->bindParam(':cod_pessoa', $cod_pessoa);
    //             $update_documentos3->bindParam(':vch_documento', $vch_documento_comprovante);
    //             $update_documentos3->bindParam(':status', $status_comprovante);
    //             $update_documentos3->execute();
    //         }
    //         if($sd == 1){
    //             $this->setDocumento($documento);
    //             $vch_documento_documento = $this->documento->getVchDocumento();
    //             $status_documento = $this->documento->getStatus();

    //             $update_documentos4 = $pdo->prepare("UPDATE ciptea.documentos 
    //             SET vch_documento = :vch_documento,
    //                 status = :status 
    //             WHERE cod_pessoa = :cod_pessoa AND cod_tipo_documento = 4");
    //             $update_documentos4->bindParam(':cod_pessoa', $cod_pessoa);
    //             $update_documentos4->bindParam(':vch_documento', $vch_documento_documento);
    //             $update_documentos4->bindParam(':status', $status_documento);
    //             $update_documentos4->execute();
    //         }
    //         if($sr == 1){
    //             $this->setRequerimento($requerimento);
    //             $vch_documento_requerimento = $this->requerimento->getVchDocumento();
    //             $status_requerimento = $this->requerimento->getStatus();

    //             $update_documentos5 = $pdo->prepare("UPDATE ciptea.documentos 
    //             SET vch_documento = :vch_documento,
    //                 status = :status 
    //             WHERE cod_pessoa = :cod_pessoa AND cod_tipo_documento = 5");
    //             $update_documentos5->bindParam(':cod_pessoa', $cod_pessoa);
    //             $update_documentos5->bindParam(':vch_documento', $vch_documento_requerimento);
    //             $update_documentos5->bindParam(':status', $status_requerimento);
    //             $update_documentos5->execute();
    //         }
    //         // Comitando a transação
    //         $pdo->commit();

    //         header('Location: ../pagina_usuario.php');
    //     } catch (PDOException $e) {
    //         // Se ocorrer algum erro, reverta a transação
    //         $pdo->rollBack();
    //         echo "Erro: " . $e->getMessage();
    //     }        
    // }

    public function atualizarPessoaResponsavel($sl, $sf, $sc, $sd, $sr, $laudo, $foto, $comprovante, $documento, $requerimento, $cod_usuario, $cod_pessoa){
        try {
            $pdo = Database::conexao();
            // Iniciando a transação
            $pdo->beginTransaction();

            // Inserindo os dados na tabela pessoa
            $update_pessoa = $pdo->prepare("UPDATE ciptea.dados_pessoa 
            SET vch_nome = :vch_nome,
                cid = :cid,
                vch_tipo_sanguineo = :vch_tipo_sanguineo,
                vch_telefone_contato = :vch_telefone_contato,   
                vch_nome_pai = :vch_nome_pai,
                vch_nome_mae = :vch_nome_mae,
                sdt_nascimento = :sdt_nascimento,
                endereco = :endereco,
                bairro = :bairro,
                cep = :cep,
                cidade = :cidade,
                vch_rg = :vch_rg,
                vch_cpf = :vch_cpf,
                vch_num_cartao_sus = :vch_num_cartao_sus,
                bool_representante_legal = :bool_representante_legal 
            WHERE cod_usuario = :cod_usuario");
            $update_pessoa->bindParam(':cod_usuario', $cod_usuario);
            $update_pessoa->bindParam(':vch_nome', $this->vch_nome);
            $update_pessoa->bindParam(':cid', $this->cid);
            $update_pessoa->bindParam(':vch_tipo_sanguineo', $this->vch_tipo_sanguineo);
            $update_pessoa->bindParam(':vch_telefone_contato', $this->vch_telefone_contato);
            $update_pessoa->bindParam(':vch_nome_pai', $this->vch_nome_pai);
            $update_pessoa->bindParam(':vch_nome_mae', $this->vch_nome_mae);
            $update_pessoa->bindParam(':sdt_nascimento', $this->sdt_nascimento);
            $update_pessoa->bindParam(':endereco', $this->endereco);
            $update_pessoa->bindParam(':bairro', $this->bairro);
            $update_pessoa->bindParam(':cep', $this->cep);
            $update_pessoa->bindParam(':cidade', $this->cidade);
            $update_pessoa->bindParam(':vch_rg', $this->vch_rg);
            $update_pessoa->bindParam(':vch_cpf', $this->vch_cpf);
            $update_pessoa->bindParam(':vch_num_cartao_sus', $this->vch_num_cartao_sus);
            $update_pessoa->bindParam(':bool_representante_legal', $this->bool_representante_legal);
            $update_pessoa->execute();
            // Obtendo o ID gerado pela inserção na tabela pessoa
            // $codPessoa = $pdo->lastInsertId();

            $cod_pessoa = $this->responsavel->getCodPessoa();
            $vch_nome_resp = $this->responsavel->getVchNomeResponsavel();
            $vch_telefone_resp = $this->responsavel->getVchTelefoneResponsavel();
            $vch_cpf_resp = $this->responsavel->getVchCpfResponsavel();
            $vch_endereco_resp = $this->responsavel->getVchEnderecoResponsavel();
            $vch_bairro_resp = $this->responsavel->getVchBairroResponsavel();
            $vch_cep = $this->responsavel->getVchCepResponsavel();
            $vch_cidade_resp = $this->responsavel->getVchCidadeResponsavel();

            // Inserindo os dados na tabela responsavel usando o ID da pessoa
            $stmtResponsavel = $pdo->prepare("UPDATE ciptea.dados_responsavel_legal 
            SET vch_nome_responsavel = :vch_nome_responsavel,
                vch_telefone_responsavel = :vch_telefone_responsavel,
                vch_cpf_responsavel = :vch_cpf_responsavel,
                vch_endereco_responsavel = :vch_endereco_responsavel,
                vch_bairro_responsavel = :vch_bairro_responsavel,
                vch_cep_responsavel = :vch_cep_responsavel,
                vch_cidade_responsavel = :vch_cidade_responsavel 
            WHERE cod_pessoa = :cod_pessoa");
            $stmtResponsavel->bindParam(':cod_pessoa', $cod_pessoa);
            $stmtResponsavel->bindParam(':vch_nome_responsavel', $vch_nome_resp);
            $stmtResponsavel->bindParam(':vch_telefone_responsavel', $vch_telefone_resp);
            $stmtResponsavel->bindParam(':vch_cpf_responsavel', $vch_cpf_resp);
            $stmtResponsavel->bindParam(':vch_endereco_responsavel', $vch_endereco_resp);
            $stmtResponsavel->bindParam(':vch_bairro_responsavel', $vch_bairro_resp);
            $stmtResponsavel->bindParam(':vch_cep_responsavel', $vch_cep);
            $stmtResponsavel->bindParam(':vch_cidade_responsavel', $vch_cidade_resp);
            $stmtResponsavel->execute();

            if($sl == 1){
                $this->setLaudo($laudo);
                $vch_documento_laudo = $this->laudo->getVchDocumento();
                $status_laudo = $this->laudo->getStatus();

                $update_documentos = $pdo->prepare("UPDATE ciptea.documentos 
                SET vch_documento = :vch_documento,
                    status = :status 
                WHERE cod_pessoa = :cod_pessoa AND cod_tipo_documento = 2");
                $update_documentos->bindParam(':cod_pessoa', $cod_pessoa);
                $update_documentos->bindParam(':vch_documento', $vch_documento_laudo);
                $update_documentos->bindParam(':status', $status_laudo);
                $update_documentos->execute();
            }
            if($sf == 1){
                $this->setFoto($foto);
                $vch_documento_foto = $this->foto->getVchDocumento();
                $status_foto = $this->foto->getStatus();

                $update_documentos2 = $pdo->prepare("UPDATE ciptea.documentos 
                SET vch_documento = :vch_documento,
                    status = :status 
                WHERE cod_pessoa = :cod_pessoa AND cod_tipo_documento = 1");
                $update_documentos2->bindParam(':cod_pessoa', $cod_pessoa);
                $update_documentos2->bindParam(':vch_documento', $vch_documento_foto);
                $update_documentos2->bindParam(':status', $status_foto);
                $update_documentos2->execute();
            }
            if($sc == 1){
                $this->setComprovante($comprovante);
                $vch_documento_comprovante = $this->comprovante->getVchDocumento();
                $status_comprovante = $this->comprovante->getStatus();

                $update_documentos3 = $pdo->prepare("UPDATE ciptea.documentos 
                SET vch_documento = :vch_documento,
                    status = :status 
                WHERE cod_pessoa = :cod_pessoa AND cod_tipo_documento = 3");
                $update_documentos3->bindParam(':cod_pessoa', $cod_pessoa);
                $update_documentos3->bindParam(':vch_documento', $vch_documento_comprovante);
                $update_documentos3->bindParam(':status', $status_comprovante);
                $update_documentos3->execute();
            }
            if($sd == 1){
                $this->setDocumento($documento);
                $vch_documento_documento = $this->documento->getVchDocumento();
                $status_documento = $this->documento->getStatus();

                $update_documentos4 = $pdo->prepare("UPDATE ciptea.documentos 
                SET vch_documento = :vch_documento,
                    status = :status 
                WHERE cod_pessoa = :cod_pessoa AND cod_tipo_documento = 4");
                $update_documentos4->bindParam(':cod_pessoa', $cod_pessoa);
                $update_documentos4->bindParam(':vch_documento', $vch_documento_documento);
                $update_documentos4->bindParam(':status', $status_documento);
                $update_documentos4->execute();
            }
            if($sr == 1){
                $this->setRequerimento($requerimento);
                $vch_documento_requerimento = $this->requerimento->getVchDocumento();
                $status_requerimento = $this->requerimento->getStatus();

                $update_documentos5 = $pdo->prepare("UPDATE ciptea.documentos 
                SET vch_documento = :vch_documento,
                    status = :status 
                WHERE cod_pessoa = :cod_pessoa AND cod_tipo_documento = 5");
                $update_documentos5->bindParam(':cod_pessoa', $cod_pessoa);
                $update_documentos5->bindParam(':vch_documento', $vch_documento_requerimento);
                $update_documentos5->bindParam(':status', $status_requerimento);
                $update_documentos5->execute();
            }
            // Comitando a transação
            $pdo->commit();

            header('Location: ../pagina_usuario.php');
        } catch (PDOException $e) {
            // Se ocorrer algum erro, reverta a transação
            $pdo->rollBack();
            echo "Erro: " . $e->getMessage();
        }        
    }

    public function exibirPessoa()
    {
        $pdo = Database::conexao();
            $sql = "SELECT dp.*, 
                        dr.vch_nome_responsavel, 
                        status_foto.status AS status_foto,
                        status_laudo.status AS status_laudo,
                        status_comprovante.status AS status_comprovante,
                        status_documento.status AS status_documento,
                        status_requerimento.status AS status_requerimento
                    FROM 
                        ciptea.dados_pessoa AS dp
                    LEFT JOIN 
                        ciptea.dados_responsavel_legal AS dr ON dp.cod_pessoa = dr.cod_pessoa
                    LEFT JOIN 
                        (SELECT cod_pessoa, status FROM ciptea.documentos WHERE cod_tipo_documento = 1) AS status_foto ON dp.cod_pessoa = status_foto.cod_pessoa
                    LEFT JOIN 
                        (SELECT cod_pessoa, status FROM ciptea.documentos WHERE cod_tipo_documento = 2) AS status_laudo ON dp.cod_pessoa = status_laudo.cod_pessoa
                    LEFT JOIN 
                            (SELECT cod_pessoa, status FROM ciptea.documentos WHERE cod_tipo_documento = 3) AS status_comprovante ON dp.cod_pessoa = status_comprovante.cod_pessoa
                        LEFT JOIN 
                            (SELECT cod_pessoa, status FROM ciptea.documentos WHERE cod_tipo_documento = 4) AS status_documento ON dp.cod_pessoa = status_documento.cod_pessoa
                    LEFT JOIN 
                            (SELECT cod_pessoa, status FROM ciptea.documentos WHERE cod_tipo_documento = 5) AS status_requerimento ON dp.cod_pessoa = status_requerimento.cod_pessoa    
                    GROUP BY dp.cod_pessoa, dr.vch_nome_responsavel, status_foto,status_laudo, status_comprovante, status_documento, status_requerimento
                        ORDER BY 
                        CASE    
                            WHEN status_foto.status = 0 AND status_laudo.status = 0 AND status_comprovante.status = 0 AND status_documento.status = 0 AND status_requerimento.status = 0 THEN 0
                            WHEN status_foto.status = 0 AND status_laudo.status = 0 AND status_comprovante.status = 0 AND status_documento.status = 0 AND status_requerimento.status is NULL THEN 1
                            WHEN status_foto.status = 1 AND status_laudo.status = 1 AND status_comprovante.status = 1 AND status_documento.status = 1 AND status_requerimento.status = 1 THEN 3
                            ELSE 2
                        END; ";
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        return $consulta;
    }

    public function exibirPessoaUsuario($cod_usuario){
        $pdo = Database::conexao();
        $sql = "SELECT dp.*,dr.cod_responsavel_legal, dr.vch_nome_responsavel, dr.vch_telefone_responsavel, dr.vch_cpf_responsavel, dr.vch_endereco_responsavel, 
                dr.vch_bairro_responsavel, dr.vch_cep_responsavel, dr.vch_cidade_responsavel, dr.int_sexo_responsavel, dr.int_num_responsavel, dr.vch_comp_responsavel, 
         (SELECT vch_documento FROM ciptea.documentos AS d WHERE d.cod_tipo_documento = 1 AND d.cod_pessoa = dp.cod_pessoa) AS foto, 
         (SELECT vch_documento FROM ciptea.documentos AS d WHERE d.cod_tipo_documento = 2 AND d.cod_pessoa = dp.cod_pessoa) AS laudo, 
         (SELECT vch_documento FROM ciptea.documentos AS d WHERE d.cod_tipo_documento = 3 AND d.cod_pessoa = dp.cod_pessoa) AS comp_residencia, 
         (SELECT vch_documento FROM ciptea.documentos AS d WHERE d.cod_tipo_documento = 4 AND d.cod_pessoa = dp.cod_pessoa) AS documento, 
         (SELECT status FROM ciptea.documentos AS d WHERE d.cod_tipo_documento = 1 AND d.cod_pessoa = dp.cod_pessoa) AS status_foto, 
         (SELECT status FROM ciptea.documentos AS d WHERE d.cod_tipo_documento = 2 AND d.cod_pessoa = dp.cod_pessoa) AS status_laudo, 
         (SELECT status FROM ciptea.documentos AS d WHERE d.cod_tipo_documento = 3 AND d.cod_pessoa = dp.cod_pessoa) AS status_comprovante, 
         (SELECT status FROM ciptea.documentos AS d WHERE d.cod_tipo_documento = 4 AND d.cod_pessoa = dp.cod_pessoa) AS status_documento, 
         (SELECT vch_documento FROM ciptea.documentos AS d WHERE d.cod_tipo_documento = 5 AND d.cod_pessoa = dp.cod_pessoa) AS requerimento, 
         (SELECT status FROM ciptea.documentos AS d WHERE d.cod_tipo_documento = 5 AND d.cod_pessoa = dp.cod_pessoa) AS status_requerimento    
        FROM ciptea.dados_pessoa AS dp
        LEFT JOIN ciptea.dados_responsavel_legal as dr
        ON dp.cod_pessoa = dr.cod_pessoa
        WHERE dp.cod_usuario = :cod_usuario;";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':cod_usuario', $cod_usuario);
        $consulta->execute();
        return $consulta;
    }

    public function verificarCPF($cpf){
        try{
            $pdo = Database::conexao();
            $sql ="SELECT dp.cod_usuario, dp.vch_cpf, u.vch_login
            FROM ciptea.dados_pessoa AS dp
            INNER JOIN ciptea.usuario AS u
            ON u.cod_usuario = dp.cod_usuario
            WHERE vch_cpf = :cpf";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(':cpf', $cpf);
            $consulta->execute();
            return $consulta;
        }catch(PDOException $e){
            echo "Erro: ". $e ;
        }    
    }
}
