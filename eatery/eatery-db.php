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

function addEatery($id, $name, $email, $description){
    global $db;
    $query = "insert into eatery (ID, name, email, description)
    VALUES (:id, :name, :email, :description)";
    $statement = $db->prepare($query); 
    $statement->bindValue(':id', $id);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();
}

function getMaxIDFromEatery(){
    global $db;
    $query = "select MAX(ID) FROM eatery";
    $statement = $db->prepare($query); 
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
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

// function updateEatery($name, $email, $new_description, $new_cuisine, $new_street_address, $new_city, $new_state, $new_zip_code, $new_phone){
//     global $db;
//     $query = "UPDATE eatery 
//     SET description=:new_description,
//     cuisine=:new_cusine,
//     street_address=:new_street_address,
//     city=:new_city,
//     state=:new_state,
//     zip_code=:new_zip_code,
//     phone=:new_phone,
//     WHERE email=:email AND name=:name;
    
//     $statement = $db->prepare($query); 
//     $statement->bindValue(':name', $name);
//     $statement->bindValue(':email', $email);
//     $statement->bindValue(':new_description', $new_description);
//     $statement->bindValue(':new_cuisine', $new_cuisine);
//     $statement->bindValue(':new_street_address', $new_street_address);
//     $statement->bindValue(':new_city', $new_city);
//     $statement->bindValue(':new_state', $new_state);
//     $statement->bindValue(':new_zip_code', $new_zip_code);
//     $statement->bindValue(':new_phone', $new_phone);
//     $statement->execute();
//     $statement->closeCursor();
// }

?>
