<?php
    // This function will get a user's first name using his or her email address
    function getUserFirstNameByEmail($email) {
        $db = dbConnect();
        $sql = 'SELECT firstname FROM users WHERE email = :email';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result[0];
    }
    
    // This function will check for an existing email address
    function checkExistingEmail($email){
        $db = dbConnect();
        $sql = 'SELECT email FROM users WHERE email = :email';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if(empty($matchEmail)){
            return 0;
        }
        else {
            return 1;
        }
    }

    // This function will handle site registrations
    function registerUser($firstname, $lastname, $email, $password){
       $db = dbConnect();
       $sql = 'INSERT INTO users (firstname, lastname, email, "password")
               VALUES (:firstname, :lastname, :email, :"password")';
       $stmt = $db->prepare($sql);
       $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
       $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
       $stmt->bindValue(':email', $email, PDO::PARAM_STR);
       $stmt->bindValue(':password', $password, PDO::PARAM_STR);
       $stmt->execute();
       $rowsChanged = $stmt->rowCount();
       $stmt->closeCursor();
       return $rowsChanged;
    }

    function checkPassword($password) {
        $db = dbConnect();
        $sql = 'SELECT "password" FROM users WHERE "password" = :"password"';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
        $matchPassword = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if(empty($matchPassword)){
            return FALSE;
        }
        else {
            return TRUE;
        }        
    }
?>