<!DOCTYPE html>

<html lang="fr">



<head>

    <meta charset="UTF-8">

    <title>code barre</title>

    <link rel="stylesheet" href="css/style.css">

</head>



<body>

    <h1>Generateur de Code barre</h1>

    <form method="post">

        <div>

            <label id="lbl_nom" for="code">Entrer votre Code barre</label><br>

            <input id="code" name="code" type="text" />

            <input id="send" name="send" type="submit" value="envoyer" />

        </div>

    </form>

    <?php

   

        include_once 'codebarre.class.php';

        $code = $_POST['code'];

        $codebarre = new CodeBarre($code);
        $codebarre->display();
        echo "<h2>$code</h2>";
        
    ?>

</body>



</html>