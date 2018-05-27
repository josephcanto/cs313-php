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
        $sql = 'SELECT id, name, is_family, address FROM people WHERE user_id = :userId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $people = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $people;
    }

    function buildPeopleList($people) {
        if(!empty($people)) {
            $family = "<h2 class='people-list-heading'>Family</h2><ul class='people-list'>";
            $friends = "<h2 class='people-list-heading'>Friends</h2><ul class='people-list'>";
            $numFamily = 0;
            $numFriends = 0;
            foreach($people as $person) {
                if($person['is_family']) {
                    // add the person to the list of family members if they are family, and increase the number of family members added by 1
                    $family .= "<li><a href='person.php?id=" . $person['id'] . "' title='Click here to view more information for " . $person['name'] . "'>" . $person['name'] . "</a><ul><li>" . $person['address'] . "</li></ul></li>";
                    $numFamily++;
                } else {
                    // add the person to the list of friends if they aren't family, and increase the number of friends added by 1
                    $friends .= "<li><a href='person.php?id=" . $person['id'] . "' title='Click here to view more information for " . $person['name'] . "'>" . $person['name'] . "</a><ul><li>" . $person['address'] . "</li></ul></li>";
                    $numFriends++;
                }
            }
            $family .= "</ul>";
            $friends .= "</ul>";
            if($numFamily != 0 && $numFriends != 0) {
                $peopleList = $family . $friends;
            } elseif($numFamily != 0 && $numFriends == 0) {
                $peopleList = $family . "<h2 class='people-list-heading'>Friends</h2><p class='notice'>Looks like you haven't added any friends yet.</p>";
            } else {
                $peopleList = "<h2 class='people-list-heading'>Family</h2><p class='notice'>Looks like you haven't added any family yet.</p>" . $friends;
            }
        }
        return $peopleList;
    }
?>