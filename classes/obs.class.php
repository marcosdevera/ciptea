<?php

class Obs {
    private $cod_obs;
    private $cod_pessoa;
    private $obs;
    private $sdt_criacao;

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

    public function inserirObs(){
        try {
            $pdo = Database::conexao();            
            $data_atual = date('Y-m-d H:i:s');            
            // Inserindo os dados na tabela pessoa
            $consulta = $pdo->prepare("INSERT INTO ciptea.observacao(cod_pessoa, obs, sdt_criacao) values (:cod_pessoa, :obs, :sdt_criacao)");
            $consulta->bindParam(':cod_pessoa', $this->cod_pessoa);
            $consulta->bindParam(':obs', $this->obs);
            $consulta->bindParam(':sdt_criacao', $data_atual);
            $consulta->execute();
            $cod_pessoa_encode = base64_encode($this->cod_pessoa);
            $cod_pessoa = urlencode($cod_pessoa_encode);
            header('Location: ../avaliacao_documento.php?cod='. $cod_pessoa);
        } catch (PDOException $e) {
            // Se ocorrer algum erro, reverta a transação
            echo "Erro: " . $e->getMessage();
        }
    }

    public function exibirobs($cod_pessoa){
        try{
            $pdo = Database::conexao();
            $consulta = $pdo->prepare("SELECT * 
                                       FROM ciptea.observacao 
                                       WHERE cod_pessoa = :cod_pessoa");
            $consulta->bindParam(':cod_pessoa', $cod_pessoa);
            $consulta->execute();
            return $consulta;
        }catch (PDOException $e){
            echo "Erro: " . $e->getMessage(); 
        }
    }
}

// Exemplo de uso:
// $obs = new Obs();
// $obs->setCodObs(1);
// $obs->setCodPessoa(1);
// $obs->setObs("Observação XYZ");
// $obs->setSdtCriacao("2024-02-19");

// echo $obs->getCodObs(); // Saída: 1
// echo $obs->getCodPessoa(); // Saída: 1
// echo $obs->getObs(); // Saída: Observação XYZ
// echo $obs->getSdtCriacao(); // Saída: 2024-02-19

?>
