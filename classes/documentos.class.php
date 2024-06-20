<?php

include_once('conexao.class.php');

class Documentos {
    private $cod_pessoa;
    private $cod_tipo_documento;
    private $vch_documento;
    private $status;

    public function setCodPessoa($cod_pessoa) {
        $this->cod_pessoa = $cod_pessoa;
    }

    public function getCodPessoa() {
        return $this->cod_pessoa;
    }

    public function setCodTipoDocumento($cod_tipo_documento) {
        $this->cod_tipo_documento = $cod_tipo_documento;
    }

    public function getCodTipoDocumento() {
        return $this->cod_tipo_documento;
    }

    public function setVchDocumento($vch_documento) {
        $this->vch_documento = $vch_documento;
    }

    public function getVchDocumento() {
        return $this->vch_documento;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getStatus() {
        return $this->status;
    }

    public function exibirDocumentos($cod_pessoa) {
        $pdo = Database::conexao();
        $sql = "SELECT d.*, dp.vch_nome, dp.vch_cpf
        FROM ciptea.documentos AS d
        INNER JOIN ciptea.dados_pessoa AS dp 
        ON d.cod_pessoa = dp.cod_pessoa
        WHERE d.cod_pessoa = :cod_pessoa";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':cod_pessoa', $cod_pessoa);
        $consulta->execute();
        return $consulta;
    }

    public function validarDocumento() {
        $pdo = Database::conexao();
        $sql = "UPDATE ciptea.documentos
                SET status = :status
                WHERE cod_pessoa = :cod_pessoa AND cod_tipo_documento = :cod_tipo_documento";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':cod_pessoa', $this->cod_pessoa);
        $consulta->bindParam(':cod_tipo_documento', $this->cod_tipo_documento);
        $consulta->bindParam(':status', $this->status);
        $consulta->execute();
        $cod_pessoa_encode = base64_encode($this->cod_pessoa);
        $cod_pessoa = urlencode($cod_pessoa_encode);

        header('Location: ../avaliacao_documento.php?cod=' . $cod_pessoa);
    }


    public function buscarDocumentoPessoa($cod_pessoa, $cod_tipo_documento) {
        try{
            $pdo = Database::conexao();
            $sql = "SELECT *
                    FROM ciptea.documentos
                    WHERE cod_pessoa = :cod_pessoa and cod_tipo_documento = :cod_tipo_documento";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(':cod_pessoa', $cod_pessoa);
            $consulta->bindParam(':cod_tipo_documento', $cod_tipo_documento);
            $consulta->execute();
            return $consulta;
        }catch(PDOException $e){
            echo $e->getMessage();            

        }    
    }



    public function buscarRequerimento($cod_pessoa) {
        $pdo = Database::conexao();
        $sql = "SELECT *
        FROM ciptea.documentos
        WHERE cod_pessoa = :cod_pessoa and cod_tipo_documento = 5;";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':cod_pessoa', $cod_pessoa);
        $consulta->execute();
        return $consulta;
    }

    public function inserirRequerimento() {
        $pdo = Database::conexao();
        $data_atual = date('Y-m-d H:i:s');
        $sql = "INSERT INTO ciptea.documentos(cod_pessoa, cod_tipo_documento, vch_documento, sdt_insercao, status)
        VALUES (:cod_pessoa, :cod_tipo_documento, :vch_documento, :sdt_insercao, :status)";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':cod_pessoa', $this->cod_pessoa);
        $consulta->bindParam(':cod_tipo_documento', $this->cod_tipo_documento);
        $consulta->bindParam(':vch_documento', $this->vch_documento);
        $consulta->bindParam(':sdt_insercao', $data_atual);
        $consulta->bindParam(':status', $this->status);
        $consulta->execute();
        header('Location: ../pagina_usuario.php');
    }

    public function inserirDocumento() {
        $pdo = Database::conexao();
        $data_atual = date('Y-m-d H:i:s');
        $sql = "INSERT INTO ciptea.documentos (cod_pessoa, cod_tipo_documento, vch_documento, sdt_insercao, status)
                VALUES (:cod_pessoa, :cod_tipo_documento, :vch_documento, :sdt_insercao, :status)";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':cod_pessoa', $this->cod_pessoa);
        $consulta->bindParam(':cod_tipo_documento', $this->cod_tipo_documento);
        $consulta->bindParam(':vch_documento', $this->vch_documento);
        $consulta->bindParam(':sdt_insercao', $data_atual);
        $consulta->bindParam(':status', $this->status);
        return $consulta->execute();
    }
}

?>
