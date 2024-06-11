<?php

include_once('conexao.class.php');
include_once('avaliador.class.php');


class Usuario {

    private Avaliador $avaliador;
    private $vch_login;
    private $vch_senha;
    private $int_perfil;
    private $int_situacao;
    private $cod_usuario;

    // Métodos getters e setters


    public function setAvaliador($avaliador) {
        $this->avaliador = $avaliador;
    }

    public function getAvaliador() {
        return $this->avaliador;
    }

    public function setVch_login($vch_login) {
        $this->vch_login = $vch_login;
    }

    public function getVch_login() {
        return $this->vch_login;
    }

    public function setVch_senha($vch_senha) {
        $this->vch_senha = $vch_senha;
    }

    public function getVch_senha() {
        return $this->vch_senha;
    }

    public function setInt_perfil($int_perfil) {
        $this->int_perfil = $int_perfil;
    }

    public function getInt_perfil() {
        return $this->int_perfil;
    }

    public function setInt_situacao($int_situacao) {
        $this->int_situacao = $int_situacao;
    }

    public function getInt_situacao() {
        return $this->int_situacao;
    }

    public function setCod_usuario($cod_usuario) {
        $this->cod_usuario = $cod_usuario;
    }

    public function getCod_usuario() {
        return $this->cod_usuario;
    }

    //public function inserirUsuarios() old
    //public function inserirUsuarios(não tava passando as variaveis para o funcionamento) old
   
    
    public function inserirUsuarios($vch_login, $vch_senha, $int_perfil, $int_situacao ){
    try{
        $pdo = Database::conexao();
        $int_situacao = 1;
        $insert = $pdo->prepare("INSERT INTO ciptea.usuario(vch_login, vch_senha, int_perfil, int_situacao) 
            VALUES (:vch_login, :vch_senha, :int_perfil, :int_situacao)");
            $insert->bindParam(':vch_login', $vch_login);
            $insert->bindParam(':vch_senha', $vch_senha);
            $insert->bindParam(':int_perfil', $int_perfil);
            $insert->bindParam(':int_situacao', $int_situacao);
            $insert->execute();   
    }
catch(PDOException $e) {
    echo ''. $e->getMessage();
   }
}
   public function inserirUsuarioAvaliador($avaliador){
    try{
        $pdo = Database::conexao();
        $pdo->beginTransaction();
        $insert = $pdo->prepare("INSERT INTO ciptea.usuario(vch_login, vch_senha, int_perfil, int_situacao) 
            VALUES (:vch_login, :vch_senha, :int_perfil, :int_situacao)");
        $insert->bindParam(':vch_login', $this->vch_login);
        $insert->bindParam(':vch_senha', $this->vch_senha);
        $insert->bindParam(':int_perfil', $this->int_perfil);
        $insert->bindParam(':int_situacao', $this->int_situacao);
        $insert->execute();
        
        $cod_usuario = $pdo->lastInsertId();
        $this->setAvaliador($avaliador);
        $vch_avaliador = $this->avaliador->getVchAvaliador();

        $insert2 = $pdo->prepare("INSERT INTO ciptea.dados_avaliador(vch_avaliador, cod_usuario) 
            VALUES (:vch_avaliador, :cod_usuario)");
        $insert2->bindParam(':vch_avaliador', $vch_avaliador);
        $insert2->bindParam(':cod_usuario', $cod_usuario);
        $insert2->execute();

        $pdo->commit();
        header('Location: ../pessoa_cadastrada.php');
    }catch (PDOException $e) {
        $pdo->rollBack();
        echo "Ocorreu um erro: $e";
    }
    }

    public function alterarSenha(){
        $pdo = Database::conexao();
        $update = $pdo->prepare("UPDATE ciptea.usuario SET vch_senha = :vch_senha WHERE cod_usuario = :cod_usuario");
            $update->bindParam(':vch_senha', $this->vch_senha);
            $update->bindParam(':cod_usuario', $this->cod_usuario);
            $update->execute(); 
            header('Location: ../index.php');   
       }
}

?>
