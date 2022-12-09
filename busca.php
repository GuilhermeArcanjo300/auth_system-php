<?php
include ("cl_usuario.php");
include ("cl_fruta.php");
include ("cl_banco.php");

$busca=$_POST["fruta"];

$conec=conec::conecta_mysql("localhost","root","","db_frutas");

try
{
    {
        echo htmlspecialchars("você bucou por: ".$busca, ENT_QUOTES, 'UTF-8');
        $conec->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sth=$conec->prepare("SELECT * FROM frutas WHERE nome = :fruta");
        $sth->execute(['fruta' => htmlspecialchars($busca, ENT_QUOTES, 'UTF-8')]);

        print "<table align='center' border='1'> <tr><td>Id</td><td>Nome</td><td>Cor</td></tr>";
        if($sth->rowCount()==0)
        {
            print "<tr><td>Nada para listar</td></tr></table> <br><a href='sistema.php'>Voltar</a>"; 
            exit;
        }
        $linha=$sth->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_FIRST);
        do
        {
            $ous= new contato($linha[0], $linha[1], $linha[2]);
            print "<TR><TD>". $ous->getId()."</TD>". "<TD>".$ous->getNome()."</TD>". "<TD>".$ous->getCor()."</TD></TR>";
        }
        while($linha=$sth->fetch(PDO::FETCH_NUM,PDO::FETCH_ORI_NEXT));
            print"</TABLE><br><a href='sistema.php'>Voltar</a>";
            
    }
}
catch (Exception $e)
{   
    print $e->getMessage();
    print "<br><a href='index.php'>Voltar</a>"; 
    exit;
}

?>