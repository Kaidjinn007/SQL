
<?php
    //redirection si aucun ID n'a été renseigné
//if (!isset($GET["id"])) {
//    //die ("Paramètre requis !");
//    header("location: sql.php"); 
//}

$user = "root";     //DB Username
$pass = "";         //DB password
$host = "localhost";
$dbname = "wp_micro_hs";

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

    try { $query = 'SELECT wp_micro_hsposts.ID, post_title, LEFT(post_content, 100) INNER JOIN wp_micro_hs.posts.ID ON wp_micro_hs.posts_author = wp_micro_hsusers.ID FROM post_author, wp_micro_hsusers
                        --WHERE post_author = wp_micro_hsusers.ID
                        --AND wp_posts.ID = ' . $_GET["id"]
                        ;
    //die($query); 

    $req = $dbh->query($query);
    $req->setFetchMode(PDO::FETCH_ASSOC);
    $tab = $req->fetch(); 
    $req->closeCursor();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Sheik Albert">
    <title>Articles</title>
</head>
<body>
        <h1>Acceuil du blog</h1>
        <?php foreach($tab as $row) { ?>
            <h1><?= $row['post_title'] ?></h1>
            <h2><?= $row['post_content_tr'] ?></h2>
            <P>Rédigé par: <?= $row['display_name'] ?> - Date : <?= $row['post_date'] ?></P>
        <?php }?>   
    </body>
</html>
<?php
foreach ($tab as $row) //Display table content as row
    {
    //var_dump($row); 
    }
    $dbh = null; // flush the request from memory

echo 'Connection établie !'; 
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>"; 
    die();
}