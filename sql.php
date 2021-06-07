<?php

$user = "root";     //DB Username
$pass = "";         //DB password
$host = "localhost";
$dbname = "wp_micro_hs";

try {
    $dsn ='mysql:host=' . $host . ';dbname=' . $dbname;
    //echo $dsn (Data Source Name);
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", //PDO(PHP Data Object) Start connection
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION       //Return Error
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
                    AS post_content_tr, post_date, display_name
                    FROM wp_micro_hsposts, wp_micro_hsusers
                    WHERE post_type ="post"
                    AND post_status = "publish"
                    AND post_author = wp_micro_hsusers.ID
                    ORDER BY post_date DESC';

    $req = $dbh->query($query);
    $req->setFetchMode(PDO::FETCH_ASSOC);
    $tab = $req->fetchAll(); 
    $req->closeCursor();

    //var_dump($tab); 
    //die();
    // Création html
   ?> 
   <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charsegimt="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Réparateur agréé Bob l'éponge</title>
    </head>
    <body>
        <form action="search.php">
            <input type="text" name="S">
            <input type="submit" value="Chercher">        </form>


        <h1>Acceuil du blog</h1>
<?php

foreach ($tab as $row) //Display table content as row
{
    //echo $row['ID']; 
    ?>
        <h2><a href="article.php?id=<?= $row['ID'] ?>"><?= $row['post_title'] ?></a></h2>
        <h2><?= $row['post_content_tr'] ?></h2>
        <P>Rédigé par: <?= $row['display_name'] ?> - Date : <?= $row['post_date'] ?></P>  
<?php

  //  var_dump($row); 
}
    ?>
     </body>
    </html>
    <?php
    $dbh = null; // flush the request from memory
//echo 'Connection établie !'; 
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>"; 
    //die();

//echo 'Connection établie !'; 
}