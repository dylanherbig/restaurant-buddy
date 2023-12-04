<?php

function fetchAllEateries() {
  global $db;
  $query = "SELECT * from eatery WHERE 1";
  $statement = $db->prepare($query); 
  $statement->execute();
  $results = $statement->fetchAll();   // fetch()
  $statement->closeCursor();
  return $results;
}


function addEatery($name, $email, $description){
    global $db;
    $query = "insert into eatery (name, email, description)
    VALUES (:name, :email, :description)";
    $statement = $db->prepare($query); 
    $statement->bindValue(':name', $name);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();
}

function getEatery($name, $email){
    global $db;
    $query = "select * FROM eatery WHERE name=:name AND email=:email";
    $statement = $db->prepare($query); 
    $statement->bindValue(':name', $name);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}

function getEatery_byID($eateryID){
  global $db;
  $query = "select * FROM eatery WHERE ID=:eateryID";
  $statement = $db->prepare($query); 
  $statement->bindValue(':eateryID', $eateryID);
  $statement->execute();
  $results = $statement->fetchAll();
  $statement->closeCursor();
  return $results;

}
  
function fetchCreatedEateries($username) {
  global $db;
  $query = 'select * from eatery where createdBy = :username';
  $statement = $db->prepare($query);
  $statement->bindValue(':username', $username);
  $statement->execute();
  $results = $statement->fetchAll();
  $statement->closeCursor();
  return $results;
}

function fetchCreatedReviews($username) {
  global $db;
  $query = 'SELECT 
    review.reviewer_username,
    eatery.name,
    review.comment, 
    review.number_rating
  FROM eatery JOIN review
  WHERE eatery.ID = review.eateryID AND review.reviewer_username = :username';
  $statement = $db->prepare($query);
  $statement->bindValue(':username', $username);
  $statement->execute();
  $results = $statement->fetchAll();
  $statement->closeCursor();
  return $results;
}

function addReview($ID, $reviewer_username, $eateryID, $createdAt, $comment, $number_rating){
  global $db;
  $query = "insert into review (ID, reviewer_username, eateryID, createdAt, comment, number_rating)
  VALUES (:ID, :reviewer_username, :eateryID, :createdAt, :comment, :number_rating)";
  $statement = $db->prepare($query); 
  $statement->bindValue(':ID', $ID);
  $statement->bindValue(':reviewer_username', $reviewer_username);
  $statement->bindValue(':eateryID', $eateryID);
  $statement->bindValue(':createdAt', $createdAt);
  $statement->bindValue(':comment', $comment);
  $statement->bindValue(':number_rating', $number_rating);
  $statement->execute();
  $statement->closeCursor();
}

?>
