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

    foreach ($tab as $row) //Display table content as row
    {
    //    var_dump($row); 
    }
    $dbh = null; // flush the request from memory

//echo 'Connection établie !'; 
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>"; 
    die();
}