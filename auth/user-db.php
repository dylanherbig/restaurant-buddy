<?php

function registerUser($username, $password, $full_name, $email, $bio) {
  global $db;
  $query = "insert into user (username, password, full_name, email, bio)
  VALUES (:username, :password, :full_name, :email, :bio)";
  $statement = $db->prepare($query); 
  $statement->bindValue(':username', $username);
  $statement->bindValue(':password', $password);
  $statement->bindValue(':full_name', $full_name);
  $statement->bindValue(':email', $email);
  $statement->bindValue(':bio', $bio);
  $statement->execute();
  $statement->closeCursor();
}

function updateFriendByName($name, $major, $year) {
    global $db;
    $query = "update friends set major=:major, year=:year where name=:name";
    $statement = $db->prepare($query); 
    $statement->bindValue(':name', $name);
    $statement->bindValue(':major', $major);
    $statement->bindValue(':year', $year);
    $statement->execute();
    $statement->closeCursor();
}

function deleteFriend($name) {
    global $db;
    $query = "delete from friends where name=:name";
    $statement = $db->prepare($query); 
    $statement->bindValue(':name', $name);
    $statement->execute();
    $statement->closeCursor();
}

?>