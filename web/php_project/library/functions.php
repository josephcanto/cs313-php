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

    function getUserIdByEmail($email) {
        $db = dbConnect();
        $sql = 'SELECT id FROM users WHERE email = :email';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $userId = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $userId;
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
            $family = "<h2 class='people-list-heading'>Family</h2>";
            $friends = "<h2 class='people-list-heading'>Friends</h2>";
            $numFamily = 0;
            $numFriends = 0;
            foreach($people as $person) {
                if($person['is_family']) {
                    // add the person to the list of family members if they are family, and increase the number of family members added by 1
                    $family .= "<p class='people-list'><a class='person-link' href='library/person.php?id=" . $person['id'] . "' title='Click here to view more information for " . $person['name'] . "'>" . $person['name'] . "</a>: ";
                    if($person['address'] != "") {
                        $family .= $person['address'];
                    } else {
                        $family .= "No address has been entered for this individual.";
                    }
                    $family .= "</p>";
                    $family .= "<p class='modify-links-container'>";
                    $family .= "<a class='modify-links' href='dashboard.php?action=edit&personid=" . $person['id'] . "' title='Click here to edit the information for this person'>Edit</a> | ";
                    $family .= "<a class='modify-links' href='library/delete-data.php?name=people&id=" . $person['id'] . "' title='Click here to delete this person'>Delete</a>";
                    $family .= "</p><br>";
                    $numFamily++;
                } else {
                    // add the person to the list of friends if they aren't family, and increase the number of friends added by 1
                    $friends .= "<p class='people-list'><a class='person-link' href='library/person.php?id=" . $person['id'] . "' title='Click here to view more information for " . $person['name'] . "'>" . $person['name'] . "</a>: ";
                    if($person['address'] != "") {
                        $friends .= $person['address'];
                    } else {
                        $friends .= "No address has been entered for this individual.";
                    }
                    $friends .= "</p>";
                    $friends .= "<p class='modify-links-container'>";
                    $friends .= "<a class='modify-links' href='dashboard.php?action=edit&personid=" . $person['id'] . "' title='Click here to edit the information for this person'>Edit</a> | ";
                    $friends .= "<a class='modify-links' href='library/delete-data.php?name=people&id=" . $person['id'] . "' title='Click here to delete this person'>Delete</a>";
                    $friends .= "</p><br>";
                    $numFriends++;
                }
            }
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
                $eventsList .= "<p class='modify-links-container'>";
                $eventsList .= "<a class='event-link' href='library/event.php?eventid=" . $event['id'] . "' title='View your gift ideas for this event'>View My Gift Ideas</a> | ";
                $eventsList .= "<a class='modify-links' href='view-person.php?action=edit&eventid=" . $event['id'] . "' title='Click here to edit this event'>Edit</a> | ";
                $eventsList .= "<a class='modify-links' href='library/delete-data.php?name=events&id=" . $event['id'] . "' title='Click here to delete this event'>Delete</a>";
                $eventsList .= "</p>";
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
        $giftIdeasList = "";
        if(isset($giftInfo)) {
            foreach($giftInfo as $giftIdea) {
                $giftIdeasList .= "<ul class='gift-info-list'>";
                $giftIdeasList .= "<li>Gift Idea: " . $giftIdea['name'] . "</li>";
                if(!empty($giftIdea['notes'])) {
                    $giftIdeasList .= "<li>Notes: " . $giftIdea['notes'] . "</li>";
                } else {
                    $giftIdeasList .= "<li>Notes: No notes have been entered for this gift idea.</li>";
                }
                $giftIdeasList .= "</ul>";
                $giftIdeasList .= "<p class='modify-links-container'>";
                $giftIdeasList .= "<a class='location-link' href='library/location.php?giftid=" . $giftIdea['id'] . "' title='View the locations and prices you have entered for this gift idea'>View Locations and Prices</a> | ";
                $giftIdeasList .= "<a class='modify-links' href='view-event.php?action=edit&giftid=" . $giftIdea['id'] . "' title='Click here to edit this gift idea'>Edit</a> | ";
                $giftIdeasList .= "<a class='modify-links' href='library/delete-data.php?name=ideas&id=" . $giftIdea['id'] . "' title='Click here to delete this gift idea'>Delete</a>";
                $giftIdeasList .= "</p>";
            }
        }
        return $giftIdeasList;
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
                if(!empty($location['address'])) {
                    $locationsList .= "<li>Address: " . $location['address'] . "</li>";
                } else {
                    $locationsList .= "<li>Address: Not specified</li>";
                }
                if(!empty($location['website'])) {
                    $locationsList .= "<li>Website: <a class='store-website-link' target='_blank' href='" . $location['website'] . "' title='Click here to go to " . $location['website'] . "'>" . $location['website'] . "</a></li>";
                } else {
                    $locationsList .= "<li>Website: Not specified</li>";
                }
                if(!empty($location['price'])) {
                    $locationsList .= "<li>Price: $" . $location['price'] . "</li>";
                } else {
                    $locationsList .= "<li>Price: Not specified</li>";
                }
                $locationsList .= "</ul>";
                $locationsList .= "<p class='modify-links-container'>";
                $locationsList .= "<a class='modify-links' href='view-location.php?action=edit&locationid=" . $location['id'] . "' title='Click here to edit this location'>Edit</a> | ";
                $locationsList .= "<a class='modify-links' href='library/delete-data.php?name=locations&id=" . $location['id'] . "' title='Click here to delete this location'>Delete</a>";
                $locationsList .= "</p>";
            }
        }
        return $locationsList;
    }

    function addPerson($name, $isFamily, $address, $userId){
        $db = dbConnect();
        $sql = 'INSERT INTO people (name, is_family, address, user_id)
                VALUES (:name, :isFamily, :address, :user_id)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':isFamily', $isFamily, PDO::PARAM_BOOL);
        $stmt->bindValue(':address', $address, PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }

    function addEvent($name, $date, $frequency, $reminder, $personId) {
        $db = dbConnect();
        $sql = 'INSERT INTO events (name, date, frequency, reminder, person_id)
                VALUES (:name, :date, :frequency, :reminder, :person_id)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':date', $date, PDO::PARAM_STR);
        $stmt->bindValue(':frequency', $frequency, PDO::PARAM_STR);
        $stmt->bindValue(':reminder', $reminder, PDO::PARAM_STR);
        $stmt->bindValue(':person_id', $personId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }

    function addGiftIdea($name, $notes, $eventId) {
        $db = dbConnect();
        $sql = 'INSERT INTO ideas (name, notes, event_id)
                VALUES (:name, :notes, :event_id)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':notes', $notes, PDO::PARAM_STR);
        $stmt->bindValue(':event_id', $eventId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }

    function addLocation($name, $address, $website, $price, $giftId) {
        $db = dbConnect();
        $sql = 'INSERT INTO locations (name, address, website, price, gift_id)
                VALUES (:name, :address, :website, :price, :gift_id)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':address', $address, PDO::PARAM_STR);
        $stmt->bindValue(':website', $website, PDO::PARAM_STR);
        $stmt->bindValue(':price', $price, PDO::PARAM_STR);
        $stmt->bindValue(':gift_id', $giftId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;        
    }

    function deleteData($tableName, $itemId) {
        $db = dbConnect();
        $sql = 'DELETE FROM ' . $tableName . ' WHERE id=:itemId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':itemId', $itemId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;          
    }

    function updatePerson($name, $isFamily, $address, $personId) {
        $db = dbConnect();
        $sql = 'UPDATE people SET name=:name, is_family=:isFamily, address=:address WHERE id=:personId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_INT);
        $stmt->bindValue(':isFamily', $isFamily, PDO::PARAM_BOOL);
        $stmt->bindValue(':address', $address, PDO::PARAM_STR);
        $stmt->bindValue(':personId', $personId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsUpdated = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsUpdated; 
    }

    function updateEvent($name, $date, $frequency, $reminder, $eventId) {
        $db = dbConnect();
        $sql = 'UPDATE events SET name=:name, date=:date, frequency=:frequency, reminder=:reminder WHERE id=:eventId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':date', $date, PDO::PARAM_STR);
        $stmt->bindValue(':frequency', $frequency, PDO::PARAM_STR);
        $stmt->bindValue(':reminder', $reminder, PDO::PARAM_STR);
        $stmt->bindValue(':eventId', $eventId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsUpdated = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsUpdated;         
    }

    function updateGiftIdea($name, $notes, $giftId) {
        $db = dbConnect();
        $sql = 'UPDATE ideas SET name=:name, notes=:notes WHERE id=:giftId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':notes', $notes, PDO::PARAM_STR);
        $stmt->bindValue(':giftId', $giftId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsUpdated = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsUpdated;         
    }

    function updateLocation($name, $address, $website, $price, $locationId) {
        $db = dbConnect();
        $sql = 'UPDATE locations SET name=:name, address=:address, website=:website, price=:price WHERE id=:locationId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':address', $address, PDO::PARAM_STR);
        $stmt->bindValue(':website', $website, PDO::PARAM_STR);
        $stmt->bindValue(':price', $price, PDO::PARAM_STR);
        $stmt->bindValue(':locationId', $locationId, PDO::PARAM_INT);
        $stmt->execute();
        $rowsUpdated = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsUpdated;         
    }
?>