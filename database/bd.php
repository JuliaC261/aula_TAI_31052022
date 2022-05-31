<?php
include "../config.php";

class BD
{

    private $host = "localhost";
    private $dbname = "db_aula_tai";
    private $port = 3306;
    private $usuario = "root";
    private $senha = "123456";
    private $db_charset = "utf8";

    public function conn()
    {
        $conn = "mysql:host". Config::BD_HOST . ";
            dbname="Config::BD_NOME.";port=" . Config::BD_PORT;

        return new PDO(
            $conn,
            Config::BD_USUARIO,
            Config::BD_SENHA
            $this->senha,
            [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . Config::BD_CHARSET]
        );
    }
    public function select()
    {
        $conn = $this->conn();
        $st = $conn->prepare("SELECT * FROM $nome_tabela");
        $st->execute();

        return $st;
    }

    public function inserir($dados)
    {
        $conn = $this->conn();
        $sql = "INSERT INTO usuario (nome,telefone, cpf) value (?, ?, ?)";

        $st = $conn->prepare($sql);
        $arrayDados = [$dados['nome'], $dados['telefone'], $dados['cpf']];
        $st->execute($arrayDados);

        return $st;
    }

    public function update($dados)
    {
        $conn = $this->conn();
        $sql = "UPDATE usuario SET nome = ?, telefone= ?,
                     cpf= ? WHERE id = ?";

        $st = $conn->prepare($sql);
        $arrayDados = [
            $dados['nome'], $dados['telefone'],
            $dados['cpf'], $dados['id']
        ];
        $st->execute($arrayDados);

        return $st;
    }

    public function remover($nome_tabela, $id)
    {
        $conn = $this->conn();
        $sql = "DELETE FROM $nome_tabela WHERE id = ?";

        $st = $conn->prepare($sql);
        $arrayDados = [$id];
        $st->execute($arrayDados);

        return $st;
    }

    public function buscar($id)
    {
        $conn = $this->conn();
        $sql = "SELECT * FROM $nome_tabela WHERE id = ?";

        $st = $conn->prepare($sql);
        $arrayDados = [$id];
        $st->execute($arrayDados);

        return $st->fetchObject();
    }

    public function pesquisar($nome_tabela, $dados)
    {
        $conn = $this->conn();
        $sql = "SELECT * FROM $nome_tabela WHERE nome LIKE ?;";

        $st = $conn->prepare($sql);
        $arrayDados = ["%" . $dados["valor"] . "%"];
        $st->execute($arrayDados);

        return $st;
    }
}
