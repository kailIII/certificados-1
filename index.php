<?php

    session_start();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>Tela de Login - Ferramenta para gerar Certificados</title>
    </head>
    <body>
        
        <table align="center" border="1px"><td>
                <h1><p>Login para Ferramenta</p></h1>
        <form method="post" action="login.php">
            <p>Digite o login e a senha para acessar a ferramenta</p>
            <p>Login:<input type="text" name="login" /></p>
            <p>Senha:<input type="password" name="senha" /></p>    
            <p><input type="submit" value="Acessar" /></p><br>     
        </form></td>
        </table>
    </body>
</html>
