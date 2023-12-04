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

function filterCuisine($cuisine){
  global $db;
  $query = "select * from eatery where cuisine = :cuisine";
  $statement = $db->prepare($query);
  $statement->bindValue(':cuisine', $cuisine);
  $statement->execute();
  $results = $statement->fetchAll();   // fetch()
  $statement->closeCursor();
  return $results;  
}

function filterPrice($price){
  global $db;
  $query = "select * from eatery where price = :price";
  $statement = $db->prepare($query);
  $statement->bindValue(':price', $price);
  $statement->execute();
  $results = $statement->fetchAll();   // fetch()
  $statement->closeCursor();
  return $results;  
}

?>
