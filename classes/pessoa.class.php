<?php

include_once('conexao.class.php');
include_once('responsavel.class.php');
include_once('documentos.class.php');
include_once('usuario.class.php');

class Pessoa {

    private $conn;

    public function __construct() {
        $this->conn = Database::conexao();
    }

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

    public function setResponsavel($responsavel) {
        $this->responsavel = $responsavel;
    }

    public function getResponsavel() {
        return $this->responsavel;
    }

    public function setLaudo($laudo) {
        $this->laudo = $laudo;
    }

    public function getLaudo() {
        return $this->laudo;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function setComprovante($comprovante) {
        $this->comprovante = $comprovante;
    }

    public function getComprovante() {
        return $this->comprovante;
    }

    public function setDocumento($documento) {
        $this->documento = $documento;
    }

    public function getDocumento() {
        return $this->documento;
    }

    public function setRequerimento($requerimento) {
        $this->requerimento = $requerimento;
    }

    public function getRequerimento() {
        return $this->requerimento;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function setVchNome($vch_nome) {
        $this->vch_nome = $vch_nome;
    }

    public function getVchNome() {
        return $this->vch_nome;
    }

    public function setVchTelefone($vch_telefone) {
        $this->vch_telefone = $vch_telefone;
    }

    public function getVchTelefone() {
        return $this->vch_telefone;
    }

    public function setVchTelefoneContato($vch_telefone_contato) {
        $this->vch_telefone_contato = $vch_telefone_contato;
    }

    public function getVchTelefoneContato() {
        return $this->vch_telefone_contato;
    }

    public function setVchNomeSocial($vch_nome_social) {
        $this->vch_nome_social = $vch_nome_social;
    }

    public function getVchNomeSocial() {
        return $this->vch_nome_social;
    }

    public function setIntSexo($int_sexo) {
        $this->int_sexo = $int_sexo;
    }

    public function getIntSexo() {
        return $this->int_sexo;
    }

    public function setCid($cid) {
        $this->cid = $cid;
    }

    public function getCid() {
        return $this->cid;
    }

    public function setVchTipoSanguineo($vch_tipo_sanguineo) {
        $this->vch_tipo_sanguineo = $vch_tipo_sanguineo;
    }

    public function getVchTipoSanguineo() {
        return $this->vch_tipo_sanguineo;
    }

    public function setVchNomePai($vch_nome_pai) {
        $this->vch_nome_pai = $vch_nome_pai;
    }

    public function getVchNomePai() {
        return $this->vch_nome_pai;
    }

    public function setVchNomeMae($vch_nome_mae) {
        $this->vch_nome_mae = $vch_nome_mae;
    }

    public function getVchNomeMae() {
        return $this->vch_nome_mae;
    }

    public function setSdtNascimento($sdt_nascimento) {
        $this->sdt_nascimento = $sdt_nascimento;
    }

    public function getSdtNascimento() {
        return $this->sdt_nascimento;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function getCep() {
        return $this->cep;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function setVchRg($vch_rg) {
        $this->vch_rg = $vch_rg;
    }

    public function getVchRg() {
        return $this->vch_rg;
    }

    public function setVchCpf($vch_cpf) {
        $this->vch_cpf = $vch_cpf;
    }

    public function getVchCpf() {
        return $this->vch_cpf;
    }

    public function setVchNumCartaoSus($vch_num_cartao_sus) {
        $this->vch_num_cartao_sus = $vch_num_cartao_sus;
    }

    public function getVchNumCartaoSus() {
        return $this->vch_num_cartao_sus;
    }

    public function setBoolRepresentanteLegal($bool_representante_legal) {
        $this->bool_representante_legal = $bool_representante_legal;
    }

    public function getBoolRepresentanteLegal() {
        return $this->bool_representante_legal;
    }

    // Função para inserir uma nova pessoa
    public function inserirPessoa($usuario) {
        try {
            $pdo = Database::conexao();
            $pdo->beginTransaction();

            $consulta = $pdo->prepare("INSERT INTO ciptea.dados_pessoa(
                vch_nome, vch_nome_social, vch_telefone, vch_telefone_contato, cid, vch_tipo_sanguineo, 
                int_sexo, vch_nome_pai, vch_nome_mae, sdt_nascimento, endereco, bairro, cep, cidade, 
                vch_rg, vch_cpf, vch_num_cartao_sus, bool_representante_legal
            ) VALUES (
                :vch_nome, :vch_nome_social, :vch_telefone, :vch_telefone_contato, :cid, :vch_tipo_sanguineo, 
                :int_sexo, :vch_nome_pai, :vch_nome_mae, :sdt_nascimento, :endereco, :bairro, :cep, :cidade, 
                :vch_rg, :vch_cpf, :vch_num_cartao_sus, :bool_representante_legal
            )");
            $consulta->bindParam(':vch_nome', $this->vch_nome);
            $consulta->bindParam(':vch_nome_social', $this->vch_nome_social);
            $consulta->bindParam(':vch_telefone', $this->vch_telefone);
            $consulta->bindParam(':vch_telefone_contato', $this->vch_telefone_contato);
            $consulta->bindParam(':cid', $this->cid);
            $consulta->bindParam(':vch_tipo_sanguineo', $this->vch_tipo_sanguineo);
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

            $this->setUsuario($usuario);
            $vch_login = $this->usuario->getVch_login();
            $vch_senha = $this->usuario->getVch_senha();
            $int_perfil = $this->usuario->getInt_perfil();
            $int_situacao = $this->usuario->getInt_situacao();
            $consulta_usuario = $pdo->prepare("INSERT INTO ciptea.usuario(
                vch_login, vch_senha, int_perfil, int_situacao
            ) VALUES (
                :vch_login, :vch_senha, :int_perfil, :int_situacao
            )");
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

            session_start();
            $_SESSION['cod_pessoa'] = $codPessoa;
            $_SESSION['user_session'] = $cod_usuario;
            $_SESSION["nivel"] = $int_perfil;
            $_SESSION["sessiontime"] = time() + 10000;

            $pdo->commit();
            return $codPessoa;

        } catch (PDOException $e) {
            $pdo->rollBack();
            echo "Ocorreu um erro: $e";
        }
    }

    // Função para inserir pessoa com responsável
    public function inserirPessoaResponsavel($responsavel, $usuario) {
        try {
            $pdo = Database::conexao();
            $pdo->beginTransaction();

            $consulta = $pdo->prepare("INSERT INTO ciptea.dados_pessoa(
                vch_nome, vch_nome_social, vch_telefone, vch_telefone_contato, cid, vch_tipo_sanguineo, 
                int_sexo, vch_nome_pai, vch_nome_mae, sdt_nascimento, endereco, bairro, cep, cidade, 
                vch_rg, vch_cpf, vch_num_cartao_sus, bool_representante_legal
            ) VALUES (
                :vch_nome, :vch_nome_social, :vch_telefone, :vch_telefone_contato, :cid, :vch_tipo_sanguineo, 
                :int_sexo, :vch_nome_pai, :vch_nome_mae, :sdt_nascimento, :endereco, :bairro, :cep, :cidade, 
                :vch_rg, :vch_cpf, :vch_num_cartao_sus, :bool_representante_legal
            )");
            $consulta->bindParam(':vch_nome', $this->vch_nome);
            $consulta->bindParam(':vch_nome_social', $this->vch_nome_social);
            $consulta->bindParam(':vch_telefone', $this->vch_telefone);
            $consulta->bindParam(':vch_telefone_contato', $this->vch_telefone_contato);
            $consulta->bindParam(':cid', $this->cid);
            $consulta->bindParam(':vch_tipo_sanguineo', $this->vch_tipo_sanguineo);
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

            $this->setResponsavel($responsavel);
            $vch_nome_resp = $this->responsavel->getVchNomeResponsavel();
            $vch_telefone_resp = $this->responsavel->getVchTelefoneResponsavel();
            $vch_cpf_resp = $this->responsavel->getVchCpfResponsavel();
            $vch_endereco_resp = $this->responsavel->getVchEnderecoResponsavel();
            $vch_bairro_resp = $this->responsavel->getVchBairroResponsavel();
            $vch_cep = $this->responsavel->getVchCepResponsavel();
            $vch_cidade_resp = $this->responsavel->getVchCidadeResponsavel();
            $int_sexo_responsavel = $this->responsavel->getIntSexoResponsavel();

            $stmtResponsavel = $pdo->prepare("INSERT INTO ciptea.dados_responsavel_legal(
                cod_pessoa, vch_nome_responsavel, int_sexo_responsavel, vch_telefone_responsavel, 
                vch_cpf_responsavel, vch_endereco_responsavel, vch_bairro_responsavel, vch_cep_responsavel, 
                vch_cidade_responsavel
            ) VALUES (
                :cod_pessoa, :vch_nome_responsavel, :int_sexo_responsavel, :vch_telefone_responsavel, 
                :vch_cpf_responsavel, :vch_endereco_responsavel, :vch_bairro_responsavel, :vch_cep_responsavel, 
                :vch_cidade_responsavel
            )");
            $stmtResponsavel->bindParam(':cod_pessoa', $codPessoa);
            $stmtResponsavel->bindParam(':vch_nome_responsavel', $vch_nome_resp);
            $stmtResponsavel->bindParam(':int_sexo_responsavel', $int_sexo_responsavel);
            $stmtResponsavel->bindParam(':vch_telefone_responsavel', $vch_telefone_resp);
            $stmtResponsavel->bindParam(':vch_cpf_responsavel', $vch_cpf_resp);
            $stmtResponsavel->bindParam(':vch_endereco_responsavel', $vch_endereco_resp);
            $stmtResponsavel->bindParam(':vch_bairro_responsavel', $vch_bairro_resp);
            $stmtResponsavel->bindParam(':vch_cep_responsavel', $vch_cep);
            $stmtResponsavel->bindParam(':vch_cidade_responsavel', $vch_cidade_resp);
            $stmtResponsavel->execute();

            $this->setUsuario($usuario);
            $vch_login = $this->usuario->getVch_login();
            $vch_senha = $this->usuario->getVch_senha();
            $int_perfil = $this->usuario->getInt_perfil();
            $int_situacao = $this->usuario->getInt_situacao();
            $consulta_usuario = $pdo->prepare("INSERT INTO ciptea.usuario(
                vch_login, vch_senha, int_perfil, int_situacao
            ) VALUES (
                :vch_login, :vch_senha, :int_perfil, :int_situacao
            )");
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

            session_start();
            $_SESSION['cod_pessoa'] = $codPessoa;
            $_SESSION['user_session'] = $cod_usuario;
            $_SESSION["nivel"] = $int_perfil;
            $_SESSION["sessiontime"] = time() + 10000;

            $pdo->commit();
            return $codPessoa;

        } catch (PDOException $e) {
            $pdo->rollBack();
            echo "Ocorreu um erro: $e";
        }
    }

    // Função para atualizar pessoa com ou sem responsável
    public function atualizarPessoaResponsavel($cod_pessoa, $responsavel) {
        try {
            $pdo = Database::conexao();
            $pdo->beginTransaction();

            $update_pessoa = $pdo->prepare("UPDATE ciptea.dados_pessoa 
            SET vch_nome = :vch_nome, vch_nome_social = :vch_nome_social, cid = :cid, vch_tipo_sanguineo = :vch_tipo_sanguineo, 
                vch_telefone = :vch_telefone, vch_telefone_contato = :vch_telefone_contato, vch_nome_pai = :vch_nome_pai, 
                vch_nome_mae = :vch_nome_mae, sdt_nascimento = :sdt_nascimento, endereco = :endereco, bairro = :bairro, 
                cep = :cep, cidade = :cidade, vch_rg = :vch_rg, vch_cpf = :vch_cpf, vch_num_cartao_sus = :vch_num_cartao_sus, 
                bool_representante_legal = :bool_representante_legal, int_sexo = :int_sexo 
            WHERE cod_pessoa = :cod_pessoa");
            $update_pessoa->bindParam(':cod_pessoa', $cod_pessoa);
            $update_pessoa->bindParam(':vch_nome', $this->vch_nome);
            $update_pessoa->bindParam(':vch_nome_social', $this->vch_nome_social);
            $update_pessoa->bindParam(':cid', $this->cid);
            $update_pessoa->bindParam(':vch_tipo_sanguineo', $this->vch_tipo_sanguineo);
            $update_pessoa->bindParam(':vch_telefone', $this->vch_telefone);
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
            $update_pessoa->bindParam(':int_sexo', $this->int_sexo);
            $update_pessoa->execute();

            $this->setResponsavel($responsavel);

            $checkResponsavel = $pdo->prepare("SELECT COUNT(*) FROM ciptea.dados_responsavel_legal WHERE cod_pessoa = :cod_pessoa");
            $checkResponsavel->bindParam(':cod_pessoa', $cod_pessoa);
            $checkResponsavel->execute();
            $exists = $checkResponsavel->fetchColumn();

            if ($exists) {
                $updateResponsavel = $pdo->prepare("UPDATE ciptea.dados_responsavel_legal 
                SET vch_nome_responsavel = :vch_nome_responsavel, vch_telefone_responsavel = :vch_telefone_responsavel, 
                    vch_cpf_responsavel = :vch_cpf_responsavel, vch_endereco_responsavel = :vch_endereco_responsavel, 
                    vch_bairro_responsavel = :vch_bairro_responsavel, vch_cep_responsavel = :vch_cep_responsavel, 
                    vch_cidade_responsavel = :vch_cidade_responsavel, int_sexo_responsavel = :int_sexo_responsavel 
                WHERE cod_pessoa = :cod_pessoa");
                $updateResponsavel->bindParam(':cod_pessoa', $cod_pessoa);
                $updateResponsavel->bindParam(':vch_nome_responsavel', $this->responsavel->getVchNomeResponsavel());
                $updateResponsavel->bindParam(':vch_telefone_responsavel', $this->responsavel->getVchTelefoneResponsavel());
                $updateResponsavel->bindParam(':vch_cpf_responsavel', $this->responsavel->getVchCpfResponsavel());
                $updateResponsavel->bindParam(':vch_endereco_responsavel', $this->responsavel->getVchEnderecoResponsavel());
                $updateResponsavel->bindParam(':vch_bairro_responsavel', $this->responsavel->getVchBairroResponsavel());
                $updateResponsavel->bindParam(':vch_cep_responsavel', $this->responsavel->getVchCepResponsavel());
                $updateResponsavel->bindParam(':vch_cidade_responsavel', $this->responsavel->getVchCidadeResponsavel());
                $updateResponsavel->bindParam(':int_sexo_responsavel', $this->responsavel->getIntSexoResponsavel());
                $updateResponsavel->execute();
            } else {
                if ($this->bool_representante_legal == 1) {
                    $insertResponsavel = $pdo->prepare("INSERT INTO ciptea.dados_responsavel_legal (
                        cod_pessoa, vch_nome_responsavel, vch_telefone_responsavel, vch_cpf_responsavel, 
                        vch_endereco_responsavel, vch_bairro_responsavel, vch_cep_responsavel, vch_cidade_responsavel, 
                        int_sexo_responsavel
                    ) VALUES (
                        :cod_pessoa, :vch_nome_responsavel, :vch_telefone_responsavel, :vch_cpf_responsavel, 
                        :vch_endereco_responsavel, :vch_bairro_responsavel, :vch_cep_responsavel, :vch_cidade_responsavel, 
                        :int_sexo_responsavel
                    )");
                    $insertResponsavel->bindParam(':cod_pessoa', $cod_pessoa);
                    $insertResponsavel->bindParam(':vch_nome_responsavel', $this->responsavel->getVchNomeResponsavel());
                    $insertResponsavel->bindParam(':vch_telefone_responsavel', $this->responsavel->getVchTelefoneResponsavel());
                    $insertResponsavel->bindParam(':vch_cpf_responsavel', $this->responsavel->getVchCpfResponsavel());
                    $insertResponsavel->bindParam(':vch_endereco_responsavel', $this->responsavel->getVchEnderecoResponsavel());
                    $insertResponsavel->bindParam(':vch_bairro_responsavel', $this->responsavel->getVchBairroResponsavel());
                    $insertResponsavel->bindParam(':vch_cep_responsavel', $this->responsavel->getVchCepResponsavel());
                    $insertResponsavel->bindParam(':vch_cidade_responsavel', $this->responsavel->getVchCidadeResponsavel());
                    $insertResponsavel->bindParam(':int_sexo_responsavel', $this->responsavel->getIntSexoResponsavel());
                    $insertResponsavel->execute();
                }
            }

            $pdo->commit();
            header('Location: ../cadastro_inicialUP.php');
        } catch (PDOException $e) {
            $pdo->rollBack();
            echo "Erro: " . $e->getMessage();
        }
    }

    public function exibirPessoa() {
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
                    END;";
        $consulta = $this->conn->prepare($sql);
        $consulta->execute();
        return $consulta;
    }

    public function exibirPessoaUsuario($cod_pessoa) {
        $pdo = Database::conexao();
        $sql = "SELECT dp.*, dr.cod_responsavel_legal, dr.vch_nome_responsavel, dr.vch_telefone_responsavel, dr.vch_cpf_responsavel, dr.vch_endereco_responsavel, 
                dr.vch_bairro_responsavel, dr.vch_cep_responsavel, dr.vch_cidade_responsavel, dr.int_sexo_responsavel, dr.int_num_responsavel, dr.vch_comp_responsavel 
                FROM ciptea.dados_pessoa AS dp
                LEFT JOIN ciptea.dados_responsavel_legal as dr
                ON dp.cod_pessoa = dr.cod_pessoa
                WHERE dp.cod_pessoa = :cod_pessoa";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':cod_pessoa', $cod_pessoa);
        $consulta->execute();
        return $consulta;
    }

    public function verificarCPF($cpf) {
        try {
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
        } catch(PDOException $e) {
            echo "Erro: ". $e;
        }    
    }
    public function inserirDocumento() {
        try {
            $pdo = Database::conexao();
            $sql = "INSERT INTO ciptea.documentos (cod_pessoa, cod_tipo_documento, vch_documento, status, sdt_insercao) VALUES (:cod_pessoa, :cod_tipo_documento, :vch_documento, :status, :sdt_insercao)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(':cod_pessoa', $this->cod_pessoa);
            $consulta->bindParam(':cod_tipo_documento', $this->cod_tipo_documento);
            $consulta->bindParam(':vch_documento', $this->vch_documento);
            $consulta->bindParam(':status', $this->status);
            $consulta->bindParam(':sdt_insercao', $this->sdt_insercao);
            $consulta->execute();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    // Função para atualizar um documento
    public function atualizarDocumento() {
        try {
            $pdo = Database::conexao();
            $sql = "UPDATE ciptea.documentos SET vch_documento = :vch_documento, status = :status, sdt_insercao = :sdt_insercao WHERE cod_pessoa = :cod_pessoa AND cod_tipo_documento = :cod_tipo_documento";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(':vch_documento', $this->vch_documento);
            $consulta->bindParam(':status', $this->status);
            $consulta->bindParam(':sdt_insercao', $this->sdt_insercao);
            $consulta->bindParam(':cod_pessoa', $this->cod_pessoa);
            $consulta->bindParam(':cod_tipo_documento', $this->cod_tipo_documento);
            $consulta->execute();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

     public function pesquisarPessoa($localizar, $cpf) {
        $pdo = Database::conexao(); // Certifique-se de que há uma conexão com o banco de dados
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
                WHERE  dp.vch_cpf ilike :cpf
                GROUP BY dp.cod_pessoa, dr.vch_nome_responsavel, status_foto, status_laudo, status_comprovante, status_documento, status_requerimento
                ORDER BY 
                    CASE    
                        WHEN status_foto.status = 0 AND status_laudo.status = 0 AND status_comprovante.status = 0 AND status_documento.status = 0 AND status_requerimento.status = 0 THEN 0
                        WHEN status_foto.status = 0 AND status_laudo.status = 0 AND status_comprovante.status = 0 AND status_documento.status = 0 AND status_requerimento.status is NULL THEN 1
                        WHEN status_foto.status = 1 AND status_laudo.status = 1 AND status_comprovante.status = 1 AND status_documento.status = 1 AND status_requerimento.status = 1 THEN 3
                        ELSE 2
                    END;";
        $stmt = $pdo->prepare($sql);
//        $stmt->bindValue(':localizar', '%' . $localizar . '%');  dp.vch_nome ilike :localizar OR
        $stmt->bindValue(':cpf', '%' . $cpf . '%');
        $stmt->execute();
        return $stmt;
    }


    // Função para apagar pessoa
    public function apagarPessoa($cod_pessoa) {
        $sql = "DELETE FROM ciptea.dados_pessoa WHERE cod_pessoa = :cod_pessoa";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cod_pessoa', $cod_pessoa);
        return $stmt->execute();
    }
}

?>
