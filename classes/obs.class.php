<?php

class Obs {
    private $cod_obs;
    private $cod_pessoa;
    private $obs;
    private $sdt_criacao;
    private $cod_tipo_documento;

    public function setCodObs($cod_obs) {
        $this->cod_obs = $cod_obs;
    }

    public function getCodObs() {
        return $this->cod_obs;
    }

    public function setCodPessoa($cod_pessoa) {
        $this->cod_pessoa = $cod_pessoa;
    }

    public function getCodPessoa() {
        return $this->cod_pessoa;
    }

    public function setObs($obs) {
        $this->obs = $obs;
    }

    public function getObs() {
        return $this->obs;
    }

    public function setSdtCriacao($sdt_criacao) {
        $this->sdt_criacao = $sdt_criacao;
    }

    public function getSdtCriacao() {
        return $this->sdt_criacao;
    }

    public function setCodTipoDocumento($cod_tipo_documento) {
        $this->cod_tipo_documento = $cod_tipo_documento;
    }

    public function getCodTipoDocumento() {
        return $this->cod_tipo_documento;
    }

    public function inserirObs() {
        try {
            $pdo = Database::conexao();            
            $data_atual = date('Y-m-d H:i:s');            
            $consulta = $pdo->prepare("INSERT INTO ciptea.observacao(cod_pessoa, cod_tipo_documento, obs, sdt_criacao) values (:cod_pessoa, :cod_tipo_documento, :obs, :sdt_criacao)");
            $consulta->bindParam(':cod_pessoa', $this->cod_pessoa);
            $consulta->bindParam(':cod_tipo_documento', $this->cod_tipo_documento);
            $consulta->bindParam(':obs', $this->obs);
            $consulta->bindParam(':sdt_criacao', $data_atual);
            $consulta->execute();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    public function removerObsAntigas($cod_pessoa, $cod_tipo_documento) {
        try {
            $pdo = Database::conexao();
            $consulta = $pdo->prepare("DELETE FROM ciptea.observacao WHERE cod_pessoa = :cod_pessoa AND cod_tipo_documento = :cod_tipo_documento");
            $consulta->bindParam(':cod_pessoa', $cod_pessoa);
            $consulta->bindParam(':cod_tipo_documento', $cod_tipo_documento);
            $consulta->execute();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    public function exibirobs($cod_pessoa){
        try {
            $pdo = Database::conexao();
            $consulta = $pdo->prepare("SELECT * 
                                       FROM ciptea.observacao 
                                       WHERE cod_pessoa = :cod_pessoa");
            $consulta->bindParam(':cod_pessoa', $cod_pessoa);
            $consulta->execute();
            return $consulta;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage(); 
        }
    }

    public function exibirobsPorDocumento($cod_pessoa, $cod_tipo_documento) {
        try {
            $pdo = Database::conexao();
            $consulta = $pdo->prepare("SELECT * 
                                       FROM ciptea.observacao 
                                       WHERE cod_pessoa = :cod_pessoa AND cod_tipo_documento = :cod_tipo_documento");
            $consulta->bindParam(':cod_pessoa', $cod_pessoa);
            $consulta->bindParam(':cod_tipo_documento', $cod_tipo_documento);
            $consulta->execute();
            return $consulta;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage(); 
        }
    }
}
?>
