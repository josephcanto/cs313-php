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

    function checkPassword($email, $password) {
        $db = dbConnect();
        $sql = 'SELECT email, password, firstname, lastname FROM users WHERE email = :email';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        if($password == $userInfo['password']){
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    // This function will get a user's first name using his or her email address
    function getUserInfoByEmail($email) {
        $db = dbConnect();
        $sql = 'SELECT id, email, password, firstname, lastname FROM users WHERE email = :email';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;
    }

    function getPeopleList($userId) {
        $db = dbConnect();
        $sql = 'SELECT name, is_family, address FROM people WHERE user_id = :userId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $people = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
    }

    function buildPeopleList($people) {
        $output = "<p>Here is what's in the people variable: " . $people . "</p>";
        // if(!empty($people) && $person['is_family']) {
        //     $output .= "<h1 class='people-list-heading'>Family</h1><ul class='people-list'>";
        //     for($i = 0; $i < count($people); $i++) {
        //         foreach($people[$i] as $person) {
        //             $output .= "<li>" . $person['name'] . "<ul><li>" . $person['address'] . "</li></ul></li>";
        //         }
        //     }
        //     $output .= "</ul>";
        // }
        return $output;
    }
?>