<?php
    require 'connection.php';
    require 'functions.php';

    session_start();

    if(!isset($_SESSION['loggedIn'])) {
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $userInfo = getUserInfoByEmail($email);
        $passwordCheck = checkPassword($email, $password);
        $firstname = $userInfo['firstname'];

        if(isset($firstname) && $passwordCheck) {
            $_SESSION['loggedIn'] = TRUE;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['user_id'] = $userInfo['id'];

            $people = getPeopleList($userInfo['id']);
            $_SESSION['peopleInfo'] = $people;
            $peopleList = buildPeopleList($people);
            $_SESSION['peopleList'] = $peopleList;

            $eventsInfo = [];
            foreach($people as $person) {
                $eventsList = getEventsInfoByPersonId($person['id']);
                if(count($eventsList) > 0) {
                    array_push($eventsInfo, $eventsList);
                }
            }
            var_dump($eventsInfo);
            
            // header('Location: ../dashboard.php');
            exit;
        }
    //     } else {
    //         header('Location: ../index.php');
    //         exit;
    //     }
    // } else {
    //     header('Location: ../index.php');
    //     exit;
    }
?>