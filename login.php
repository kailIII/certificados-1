<html> 
    <head>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>Login</title>
    </head>
    <body>
        <?php

        if($_POST["login"] == "testenome" || $_POST["senha"] == "testesenha" )
        {
            session_start();
            $_SESSION["Login"] = "YES";
            header("Location: gerar.php");
        }
        else
        {
            session_start();
            $_SESSION["Login"] = "NO";
            echo "<p>Login ou Senha incorreta! Clique <a href='index.php'>aqui</a> para tentar novamente.</p>";
        }

        ?>
    </body>
</html>