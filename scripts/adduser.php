<?php

    $__ROOT__ = dirname(__FILE__)."/..";
    
    require_once $__ROOT__."/lib/lib.php";
    
    echo "Username : ";
  
    $username = trim(fgets(STDIN));
    
    echo "Password : ";
    
    $password = trim(fgets(STDIN));
    
    $hash = getHash($password, $username);
    $api_key = getApiKey($password, $username);
    
    $db = getConnexion();
    
    if(!$db)
    {
        echo "Error connecting database, check your configuration file";
    }
    else
    {
        $sql = "INSERT INTO users(user, hash, api_key)  VALUES(:user, :pass, :api_key)";
        
        $stmt = $db->prepare($sql);
        
        $stmt->execute(array("user" => $username, "pass" => $hash, "api_key" => $api_key));
        
        echo "User inserted";
    }

?>