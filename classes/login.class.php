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

    public function login($login, $upass) {
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

            if ($stmt->rowCount() > 0) {
                $pssd = $userRow['vch_senha'];
                $status = $userRow['int_situacao'];
                $nivel = $userRow['int_perfil'];
                $cod_usuario = $userRow['cod_usuario'];
                $cod_pessoa = $userRow['cod_pessoa'];

                if ($status == 1) {
                    if (password_verify($upass, $pssd)) {
                        // Nomeia a sessão
                        $_SESSION['user_session'] = $cod_usuario;
                        $_SESSION['cod_pessoa'] = $cod_pessoa;
                        $_SESSION["nivel"] = $nivel;
                        $_SESSION["sessiontime"] = time() + 10000;

                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;                    
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {
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

    public function validarCPF($cpf) {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        if (strlen($cpf) != 11) {
            return false;
        }
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    public function verificarCPF($cpf) {
        try {
            if (!$this->validarCPF($cpf)) {
                return ['status' => 'error', 'message' => 'CPF inválido.'];
            }

            $pdo = Database::conexao();
            $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM ciptea.dados_pessoa WHERE vch_cpf = :cpf");
            $stmt->bindParam(':cpf', $cpf);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result['total'] > 0) {
                return [
                    'status' => 'error', 
                    'message' => 'CPF já cadastrado. <a href="recuperar_senha.php">Recuperar senha</a>'
                ];
            } else {
                return ['status' => 'success'];
            }
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => 'Erro ao conectar ao banco de dados: ' . $e->getMessage()];
        }
    }

    public function verificarLogin($login) {
        try {
            $pdo = Database::conexao();
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM ciptea.usuario WHERE vch_login = :login");
            $stmt->bindParam(':login', $login);
            $stmt->execute();

            $result = $stmt->fetchColumn();

            return $result > 0 ? '1' : '0';
        } catch (PDOException $e) {
            return 'Erro ao conectar ao banco de dados: ' . $e->getMessage();
        }
    }
}
?>
