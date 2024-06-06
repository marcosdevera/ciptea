<?php
    include_once("conexao.class.php");
    
class Login {
    private $vch_login;
    private $vch_senha;

    public function setVchLogin($vch_login) {
        $this->vch_login = $vch_login;
    }

    public function getVchLogin() {
        return $this->vch_login;
    }

    public function setVchSenha($vch_senha) {
        $this->vch_senha = $vch_senha;
    }

    public function getVchSenha() {
        return $this->vch_senha;
    }

    public function login($login, $upass){
        try{

            $pdo = Database::conexao();

            $stmt = $pdo->prepare("SELECT u.*, dp.cod_pessoa
            FROM ciptea.usuario AS u
            LEFT JOIN ciptea.dados_pessoa AS dp
            ON u.cod_usuario = dp.cod_usuario
            WHERE vch_login = '$login'
            LIMIT 1");
            $stmt->execute();
            // $stmt->bindParam(':vch_login', );
            // die(var_dump($stmt));
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
            // die(var_dump($userRow));
            if($stmt->rowCount() > 0){
                $pssd = $userRow['vch_senha'];
                $status = $userRow['int_situacao'];
                $nivel = $userRow['int_perfil'];
                $cod_usuario = $userRow['cod_usuario'];
                $cod_pessoa = $userRow['cod_pessoa'];
                if($status == 1){
                    if(password_verify($upass, $pssd)){
                        //Nomeia a sessão
                        $_SESSION['user_session'] = $cod_usuario;

                        $_SESSION['cod_pessoa'] = $cod_pessoa;
                        //Nível na Sessão
                        $_SESSION["nivel"] = $nivel;
                        //Seta o tempo da sessão 
                        $_SESSION["sessiontime"] = time() + 10000;
                        //Nomeia o usuário / Por enquanto nenhum nome está sendo atribuído para o usuário.
                        // $_SESSION['usuarioNome'] = $userRow['vch_login'];
                        // $usuario = $userRow['vch_login'];
                        return true;
                    }else{               
                        return false;
                    }
                }else{
                    return false;                    
                }
            }


        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function logout(){
        session_destroy();
        unset($_SESSION['user_session']);
        header('Location: ../index.php');
        return true;
    }
}

?>
