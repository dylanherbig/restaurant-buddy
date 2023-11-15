<?php

function getAllEateries() {
  global $db;
  $query = "select * from eatery";
  $statement = $db->prepare($query); 
  $statement->execute();
  $results = $statement->fetchAll();   // fetch()
  $statement->closeCursor();
  return $results;
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
