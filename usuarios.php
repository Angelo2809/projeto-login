<?php

class Usuario{

    private $pdo;
    public $msgErro = '';

    public function conectar($nome, $host, $usuario, $senha){
        global  $pdo;
        try{
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
        } catch(PDOException $e){
            $msgErro = $e->getMessage();
            echo "Não foi possível conectar ao banco de dados";
        }
    }

    public function cadastrar($nome, $apelido, $email, $senha ){
        global  $pdo;
        $sql = $pdo->prepare("SELECT id FROM usuarios WHERE email = :e");
        $sql->bindValue(":e", $email);
        $sql->execute();
        if($sql->rowCount() > 0){
            return false; // já está cadastrado

        } else{
            $sql = $pdo->prepare("INSERT INTO  usuarios(nome, apelido, email, senha) VALUES (:n, :a, :e, :s)");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":a", $apelido);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", md5($senha));
            $sql->execute();
            return true;
        }
    }

    public function logar($email, $senha){
        global  $pdo;
        $sql = $pdo->prepare("SELECT id FROM usuarios WHERE email = :e AND senha = :s");
        $sql->bindValue(":e", $email);
        $sql->bindValue(":s", md5($senha));
        $sql->execute();
        if($sql->rowCount() > 0){

            $dado = $sql->fetch();
            session_start();
            $_SESSION['id'] = $dado['id'];
            return true; // logado 

        }else{
            return false;

        }
    }
}

?>