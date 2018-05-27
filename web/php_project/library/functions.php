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
                    $family .= "<li><a class='person-link' href='library/person.php?id=" . $person['id'] . "' title='Click here to view more information for " . $person['name'] . "'>" . $person['name'] . "</a><ul><li>" . $person['address'] . "</li></ul></li>";
                    $numFamily++;
                } else {
                    // add the person to the list of friends if they aren't family, and increase the number of friends added by 1
                    $friends .= "<li><a class='person-link' href='library/person.php?id=" . $person['id'] . "' title='Click here to view more information for " . $person['name'] . "'>" . $person['name'] . "</a><ul><li>" . $person['address'] . "</li></ul></li>";
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

    function getNameByPersonId($personId) {
        $db = dbConnect();
        $sql = 'SELECT name FROM people WHERE id = :personId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':personId', $personId, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;
    }

    function getEventsInfoByPersonId($personId) {
        $db = dbConnect();
        $sql = 'SELECT id, name, date, frequency, reminder, person_id FROM events WHERE person_id = :personId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':personId', $personId, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;        
    }

    function buildEventsInfoList($personEventsInfo) {
        $eventsList = "";
        if(isset($personEventsInfo)) {
            foreach($personEventsInfo as $event) {
                $eventsList .= "<ul class='event-info-list'>";
                $eventsList .= "<li>Event: " . $event['name'] . "</li>";
                $eventsList .= "<li>Date of event: " . $event['date'] . "</li>";
                $eventsList .= "<li>Frequency of event: " . $event['frequency'] . "</li>";
                $eventsList .= "<li>You will be reminded on: " . $event['reminder'] . "</li>";
                $eventsList .= "</ul>";
                $eventsList .= "<a class='event-link' href='library/event.php?eventid=" . $event['id'] . "' title='View your gift ideas for this event'>View My Gift Ideas</a>";
            }
        }
        return $eventsList;
    }

    function getNameByEventId($eventId) {
        $db = dbConnect();
        $sql = 'SELECT name FROM events WHERE id = :eventId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':eventId', $eventId, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;
    }

    function getGiftIdeasByEventId($eventId) {
        $db = dbConnect();
        $sql = 'SELECT id, name, notes, event_id FROM ideas WHERE event_id = :eventId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':eventId', $eventId, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;        
    }

    function buildGiftIdeasList($giftInfo) {
        $ideasList = "";
        if(isset($giftInfo)) {
            foreach($giftInfo as $idea) {
                $ideasList .= "<ul class='gift-info-list'>";
                $ideasList .= "<li>Gift Idea: " . $idea['name'] . "</li>";
                $ideasList .= "<li>Notes: " . $idea['notes'] . "</li>";
                $ideasList .= "</ul>";
                $ideasList .= "<a class='location-link' href='library/location.php?giftid=" . $idea['id'] . "' title='View the locations and prices you have entered for this gift idea'>View Locations and Prices</a>";
            }
        }
        return $ideasList;
    }

    function getNameByGiftId($giftId) {
        $db = dbConnect();
        $sql = 'SELECT name FROM ideas WHERE id = :giftId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':giftId', $giftId, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;
    }

    function getLocationsByGiftId($giftId) {
        $db = dbConnect();
        $sql = 'SELECT id, name, address, website, price, gift_id FROM locations WHERE gift_id = :giftId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':giftId', $giftId, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;        
    }

    function buildLocationsList($locationInfo) {
        $locationsList = "";
        if(isset($locationInfo)) {
            foreach($locationInfo as $location) {
                $locationsList .= "<ul class='gift-info-list'>";
                $locationsList .= "<li>Store Name: " . $location['name'] . "</li>";
                if(isset($location['address'])) {
                    $locationsList .= "<li>Address: " . $location['address'] . "</li>";
                } else {
                    $locationsList .= "<li>Address: Not specified</li>";
                }
                if(isset($location['website'])) {
                    $locationsList .= "<li>Website: <a class='store-website-link' target='_blank' href='http://www." . $location['website'] . "' title='Click here to go to " . $location['website'] . "'>" . $location['website'] . "</a></li>";
                } else {
                    $locationsList .= "<li>Website: Not specified</li>";
                }
                if(isset($location['price'])) {
                    $locationsList .= "<li>Price: " . $location['price'] . "</li>";
                } else {
                    $locationsList .= "<li>Price: Not specified</li>";
                }
                $locationsList .= "</ul>";
            }
        }
        return $locationsList;
    }
?>