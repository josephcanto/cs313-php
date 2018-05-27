<?php    
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
    function registerUser($email, $password, $firstname, $lastname){
       $db = dbConnect();
       $sql = 'INSERT INTO users (email, password, firstname, lastname)
               VALUES (:email, :password, :firstname, :lastname)';
       $stmt = $db->prepare($sql);
       $stmt->bindValue(':email', $email, PDO::PARAM_STR);
       $stmt->bindValue(':password', $password, PDO::PARAM_STR);
       $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
       $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
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

    // This function will get a user's first name using his or her email address
    function getUserInfoByEmail($email) {
        $db = dbConnect();
        $sql = 'SELECT email, password, firstname, lastname FROM users WHERE email = :email';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;
    }

    function buildPeopleList($userId) {
        $db = dbConnect();
        $sql = 'SELECT firstname FROM users WHERE id = :userId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':userID', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $people = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        if(!empty($people) && $person['is_family']) {
            echo "<ul>";
            foreach($people as $person) {
                echo "<li>" . $person['name'] . "</li>";
            }
            echo "</ul>";
        }
    }
?>