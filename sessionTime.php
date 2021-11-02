<?php
    $sekme=session_set_cookie_params(0);
    echo $sekme;
    $inactive=3600;
    $session_life = time()-$_SESSION["timeout"];
    header("Refresh: 3601;");
    if($session_life>$inactive || $sekme){
        header("refresh:0;url=login.php");
    }
    
?>