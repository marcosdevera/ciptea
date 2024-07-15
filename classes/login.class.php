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
        try {
            $pdo = Database::conexao();

            $stmt = $pdo->prepare("SELECT u.*, dp.cod_pessoa
            FROM ciptea.usuario AS u
            LEFT JOIN ciptea.dados_pessoa AS dp
            ON u.cod_usuario = dp.cod_usuario
            WHERE vch_login = :login
            LIMIT 1");
            $stmt->bindParam(':login', $login);
            $stmt->execute();

            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

            if($stmt->rowCount() > 0) {
                $pssd = $userRow['vch_senha'];
                $status = $userRow['int_situacao'];
                $nivel = $userRow['int_perfil'];
                $cod_usuario = $userRow['cod_usuario'];
                $cod_pessoa = $userRow['cod_pessoa'];
                
                if($status == 1) {
                    if(password_verify($upass, $pssd)) {
                        // Nomeia a sessão
                        $_SESSION['user_session'] = $cod_usuario;
                        $_SESSION['cod_pessoa'] = $cod_pessoa;
                        $_SESSION["nivel"] = $nivel;
                        $_SESSION["sessiontime"] = time() + 10000;

                        // Verificação de depuração
                        error_log("Login bem-sucedido: Usuário ID $cod_usuario, Pessoa ID $cod_pessoa, Nível $nivel");

                        return true;
                    } else {
                        error_log("Senha incorreta para o usuário: $login");
                        return false;
                    }
                } else {
                    error_log("Usuário inativo: $login");
                    return false;                    
                }
            } else {
                error_log("Nenhum usuário encontrado para o login: $login");
                return false;
            }
        } catch(PDOException $e) {
            error_log("Erro no login: " . $e->getMessage());
            return false;
        }
    }

    public function logout() {
        if (!isset($_SESSION)) {
            session_start();
        }

        $_SESSION = array();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();
        header('Location: ../index.php');
        exit();
    }
}
?>
