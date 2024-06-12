<?php
    
class Responsavel {
    private $vch_nome_responsavel;
    private $int_sexo_responsavel;
    private $vch_telefone_responsavel;
    private $vch_cpf_responsavel;
    private $vch_endereco_responsavel;
    private $num_responsavel;
    private $comp_responsavel;
    private $vch_bairro_responsavel;
    private $vch_cep_responsavel;
    private $vch_cidade_responsavel;
    private $cod_pessoa;

    public function setVchNomeResponsavel($vch_nome_responsavel) {
        $this->vch_nome_responsavel = $vch_nome_responsavel;
    }

    public function getVchNomeResponsavel() {
        return $this->vch_nome_responsavel;
    }

    public function setIntSexoResponsavel($int_sexo_responsavel) {
        $this->int_sexo_responsavel = $int_sexo_responsavel;
    }

    public function getIntSexoResponsavel() {
        return $this->int_sexo_responsavel;
    }

    public function setVchTelefoneResponsavel($vch_telefone_responsavel) {
        $this->vch_telefone_responsavel = $vch_telefone_responsavel;
    }

    public function getVchTelefoneResponsavel() {
        return $this->vch_telefone_responsavel;
    }

    public function setVchCpfResponsavel($vch_cpf_responsavel) {
        $this->vch_cpf_responsavel = $vch_cpf_responsavel;
    }

    public function getVchCpfResponsavel() {
        return $this->vch_cpf_responsavel;
    }

    public function setVchEnderecoResponsavel($vch_endereco_responsavel) {
        $this->vch_endereco_responsavel = $vch_endereco_responsavel;
    }

    public function getVchEnderecoResponsavel() {
        return $this->vch_endereco_responsavel;
    }

    public function setNumResponsavel($num_responsavel) {
        $this->num_responsavel = $num_responsavel;
    }

    public function getNumResponsavel() {
        return $this->num_responsavel;
    }

    public function setCompResponsavel($comp_responsavel) {
        $this->comp_responsavel = $comp_responsavel;
    }

    public function getCompResponsavel() {
        return $this->comp_responsavel;
    }

    public function setVchBairroResponsavel($vch_bairro_responsavel) {
        $this->vch_bairro_responsavel = $vch_bairro_responsavel;
    }

    public function getVchBairroResponsavel() {
        return $this->vch_bairro_responsavel;
    }

    public function setVchCepResponsavel($vch_cep_responsavel) {
        $this->vch_cep_responsavel = $vch_cep_responsavel;
    }

    public function getVchCepResponsavel() {
        return $this->vch_cep_responsavel;
    }

    public function setVchCidadeResponsavel($vch_cidade_responsavel) {
        $this->vch_cidade_responsavel = $vch_cidade_responsavel;
    }

    public function getVchCidadeResponsavel() {
        return $this->vch_cidade_responsavel;
    }

    public function setCodPessoa($cod_pessoa) {
        $this->cod_pessoa = $cod_pessoa;
    }

    public function getCodPessoa() {
        return $this->cod_pessoa;
    }
}

// // Exemplo de uso:
// $responsavel = new Responsavel();
// $responsavel->setVchNome("Fulano");
// $responsavel->setVchTelefone("123456789");
// $responsavel->setVchCpf("123.456.789-00");
// $responsavel->setVchEndereco("Rua A");
// $responsavel->setVchBairro("Bairro B");
// $responsavel->setVchCep("12345-678");
// $responsavel->setVchCidade("Cidade C");
// $responsavel->setCodPessoa(1);

// echo $responsavel->getVchNome(); // Saída: Fulano
// echo $responsavel->getVchTelefone(); // Saída: 123456789
// // E assim por diante para as outras propriedades

?>