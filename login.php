<?php

include ("cl_usuario.php");
include ("cl_banco.php");

try
{
    $usuario=new usuario($_POST["usuario"],$_POST["senha"],"");

    $conec=conec::conecta_mysql("localhost","root","","db_frutas");
    $conec->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sth=$conec->prepare("SELECT * FROM usuario WHERE usuario = :user");
    $sth->execute(['user' => htmlspecialchars($usuario->getUsuario(), ENT_QUOTES, 'UTF-8')]);

    $linha=$sth->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_FIRST);

    if ($sth->rowCount()==0 || !password_verify($usuario->getSenha(), $linha[1]))
    {
        print "Usuário/senha inválidos";
        print "<br><a href='index.php'>Voltar</a>";
        exit;
    }

    $usuario->setNome($linha[2]); 

    session_start(); 
    $_SESSION = array(); 
    $_SESSION['usuario']=$usuario->getUsuario(); 
    $_SESSION['nome']=$usuario->getNome(); 
    $_SESSION['timeout']=time(); 
    header("Location: sistema.php");
}
catch (Exception $e)
{   
    print $e->getMessage();
    print "<br><a href='index.php'>Voltar</a>"; 
    exit;
}

?>