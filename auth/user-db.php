<?php

function registerUser($username, $passwordHash, $full_name, $email) {
  global $db;
  $query = "insert into user (username, passwordHash, full_name, email)
  VALUES (:username, :passwordHash, :full_name, :email)";
  $statement = $db->prepare($query); 
  $statement->bindValue(':username', $username);
  $statement->bindValue(':passwordHash', $passwordHash);
  $statement->bindValue(':full_name', $full_name);
  $statement->bindValue(':email', $email);
  $result = $statement->execute();
  $statement->closeCursor();
  echo($result);
  return $result;
}

function checkUserExists($username) {
  global $db;
  $query = "select * from user where username = :username";
  $statement = $db->prepare($query); 
  $statement->bindValue(':username', $username);
  $statement->execute();
  $statement->fetch();
  if ($statement->rowCount() > 0) {
    return true;
  } else {
    return false;
  }
}

function login($username, $password) {
  global $db;
  $query = "select passwordHash from user where username = :username";
  $statement = $db->prepare($query);
  $statement->bindValue(":username", $username);
  $statement->execute();
  $passwordCheck = $statement->fetch();
  if (password_verify($password, $passwordCheck[0])) {
    return true;
  } else {
    return false;
  }
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