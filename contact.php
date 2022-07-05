<?php
    include 'config.php';
    myPrint_r($_POST);
    // myPrint_r($_SERVER);
    if ( isset($_POST['action']) AND $_POST['action'] == 'contact') : 
    
    $sql = sprintf("INSERT INTO contact SET name='%s', email ='%s', message ='%s'", 
            ($_POST['nom'] != '') ? $_POST['nom'] : 'inconnu',
            $_POST['email'],
            //PHP 8 Plus besoins de commande anti injection SQL
            strip_tags($_POST['message'])
);
    // echo $sql;
    $connect->query($sql);
    echo $connect->error;
    //va permettre d'éviter de renoueler la requête au referesh
    header("location:contact.php?contact=ok");
    exit;
    endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
</head>
<body>
    <h1>Contact</h1>
    <!--mettre name par defaut pour ajouter les param a l'url lors de l'envoi'-->
    <form action="" method="post">
        <input type="text" name="nom" placeholder="votre nom"><br>
        <input type="email" name="email" placeholder="Votre email"><br>
        <textarea cols="30" name="message" rows="10"></textarea><br>
        <input type="hidden" name="action" value="contact">
        <button>Envoyer</button>
    </form>
    <?php if(isset($_GET['contact']) AND $_GET['contact'] == 'ok'):?>
        <p>MESSAGE SAVED</p>
    <?php endif;?>
</body>
</html>

<!--Formulaire de recherche c'est en GET les formulaires pour envoi de données en POST-->