<?php
    //redirection si aucun ID n'a été renseigné
//if (!isset($GET["s"])) {
//    //die ("Paramètre requis !");
//    header("location: sql.php"); 
//}



try {
    $dsn ='mysql:host=' . $host . ';dbname=' . $dbname;
    //echo $dsn (Data Source Name);
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", //PDO(PHP Data Object) Start connection
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION         //Return Error
    );

    $dbh = new PDO($dsn, $user, $pass, $options); 
    //var_dump($dbh);
    //echo "Connexion établie !";

    } catch (PDOException $e){
        print "Erreur connection !: " . $e->getMessage() . "<br/>";
        die();
    }

    try { 
        $query = 'SELECT wp_micro_hsposts.ID, post_title, LEFT(post_content, 100) 
                    AS post_content_tr, post_date, display_name FROM wp_micro_hsposts 
                    INNER JOIN wp_micro_hsusers ON post_author = wp_micro_hsusers.ID 
                    WHERE( post_type = "post" AND post_status = "publish") 
                    AND (post_title LIKE :s 
                    OR post_content LIKE :s )';  
                    
                    //die($query); 
            $req = $dbh->prepare($query);                                   // préparation et neutralisation de la requete
            $req ->bindValue(':s', '%' . $_GET['s'] . '%', PDO::PARAM_STR); // ajout de de charactères spéciaux
            
            $req ->execute();

            $req ->setFetchMode(PDO::FETCH_ASSOC);
            $tab = $req->fetchAll(); 
            $req->closeCursor();
            
            } catch (PDOException $e) {
                print "Erreur !: " . $e->getMessage() . "<br/>"; 
                //die();
            
            //echo 'Connection établie !'; 
            }?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charsegimt="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Resultat de la recherche</title>
    </head>
    <body>
        <form action="search.php">
            <input type="text" name="s">
            <input type="submit" value="Chercher">
        </form>
    
        <h1>Résultats de la recherche</h1>
        
        <?php
        foreach ($tab as $row) //Display table content as row
                {
        //echo $row['ID']; 
        ?>
            <h1><?= $row['post_title'] ?></h1>
            <h2><?= $row['post_content_tr'] ?></h2>
            <P>Rédigé par: <?= $row['display_name'] ?> - Date : <?= $row['post_date'] ?></P>     
        <?php   }; ?>