<?php

function registerUser($username, $passwordHash, $full_name, $email) {
  global $db;

  // create user
  $query = "insert into user (username, passwordHash, full_name, email)
  VALUES (:username, :passwordHash, :full_name, :email)";
  $statement = $db->prepare($query); 
  $statement->bindValue(':username', $username);
  $statement->bindValue(':passwordHash', $passwordHash);
  $statement->bindValue(':full_name', $full_name);
  $statement->bindValue(':email', $email);
  $result = $statement->execute();
  $statement->closeCursor();

  // create reviewer class
  $query = "insert into reviewer (username)
  VALUES (:username)";
  $statement = $db->prepare($query); 
  $statement->bindValue(':username', $username);
  $result = $statement->execute();
  $statement->closeCursor();

  return $result;
}

function fetchUserProfile($username) {
  global $db;
  $query = 'select * from user natural join reviewer where username=:username';
  $statement = $db->prepare($query);
  $statement->bindValue(':username', $username);
  $statement->execute();
  $result = $statement->fetch();
  return $result;
}

function updateUserProfile($username, $full_name, $email, $expertise, $bio) {
  global $db;
  $query = 'update user set full_name=:full_name, email=:email, bio=:bio where username=:username';
  $statement = $db->prepare($query);
  $statement->bindValue(':username', $username);
  $statement->bindValue(':full_name', $full_name);
  $statement->bindValue(':email', $email);
  $statement->bindValue(':bio', $bio);
  $statement->execute();
  $statement->closeCursor();

  echo("made it here");

  $query = 'update reviewer set expertise=:expertise where username=:username';
  $statement = $db->prepare($query);
  $statement->bindValue(':username', $username);
  $statement->bindValue(':expertise', $expertise);
  $statement->execute();
  $statement->closeCursor();

  echo("here as well?");

}

function fetchAvgRating($username) {
  global $db;
  $query = 'SELECT AVG(number_rating) FROM `review` WHERE reviewer_username=:username';
  $statement = $db->prepare($query);
  $statement->bindValue(':username', $username);
  $statement->execute();
  $result = $statement->fetch();
  $statement->closeCursor();
  return $result;
}

function fetchAllUsers() {
  global $db;
  $query = 'SELECT * FROM user WHERE 1';
  $statement = $db->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
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