<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processamento</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    


<?php
    require_once 'usuarios.php';
    $u = new usuario;
    
    $nome = addslashes($_POST['nome']);
    $apelido = addslashes($_POST['apelido']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    $confirmarSenha =addslashes($_POST['confirmarSenha']);
    
    //verificacao se esta vazio por php
        
        $u->conectar("projeto_login", "localhost", "root", "");
        if($u->msgErro == ''){ //ok
            if($senha == $confirmarSenha){
                if($u->cadastrar($nome, $apelido, $email, $senha)){
                    ?>
                    <div class="msg-erro">cadastrado com sucesso</div> 
                    <?php
                }else{
                    ?>
                    <div class="msg-erro">Email já cadastrado</div> 
                    <?php
                }
            }else{
                ?>
                <div class="msg-erro">As senhas não correspondem!</div> 
                <?php
            }
        } else{
            echo "Erro :".$u->msgErro;
        }
    
?>
</body>
</html>