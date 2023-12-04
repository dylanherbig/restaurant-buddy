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

function checkCredentials($username, $password) {
  global $db;
  $query = "select passwordHash from user where username = :username";
  $statement = $db->prepare($query);
  $statement->bindValue(":username", $username);
  $statement->execute();
  $passwordCheck = $statement->fetch();

  if (password_verify($password, $passwordCheck[0])) {
    return [true, $passwordCheck[0]];
  } else {
    return [false, ""];
  }
}

function checkUserPassword($username, $passwordHash) { 
  global $db;
  $query = "select passwordHash from user where username = :username";
  $statement = $db->prepare($query);
  $statement->bindValue(":username", $username);
  $statement->execute();
  $passwordCheck = $statement->fetch();
  if ($passwordHash == $passwordCheck[0]) {
    return true;
  } else {
    return false;
  }
}

?>