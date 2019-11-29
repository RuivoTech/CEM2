<?php

include_once '../init.php';
if(filter_input(INPUT_POST, "inscricao")){
    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $celular = filter_input(INPUT_POST, "celular", FILTER_SANITIZE_NUMBER_INT);
    $idEvento = filter_input(INPUT_POST, "evento", FILTER_SANITIZE_NUMBER_INT);
    try{
        $PDO = db_connect();
                
        $sql =  "INSERT INTO inscricoes SET nome = :nome, email = :email, celular = :celular, idEvento = :evento";
        $stmt = $PDO->prepare($sql);
        
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":celular", $celular);
        $stmt->bindParam(":evento", $idEvento);
        
        $result = $stmt->execute();
        
        if(!$result){
            header("Location: ./index.php?m=2");
        }
        echo print_r($result, true);
        echo print_r($stmt->errorInfo(), true);
        header("Location: ./index.php?m=1");
    }catch (PDOException $e){
        error_log("Error: " . $e->getMessage());
    }
}