<?php

function fetchAllEateries() {
  global $db;
  $query = "select * from eatery";  
  $statement = $db->prepare($query); 
  $statement->execute();
  $results = $statement->fetchAll();   // fetch()
  $statement->closeCursor();
  return $results;
}

// function addEatery($id, $name, $email, $description){
//     global $db;
//     $query = "insert into eatery (ID, name, email, description)
//     VALUES (:id, :name, :email, :description)";
//     $statement = $db->prepare($query); 
//     $statement->bindValue(':id', $id);
//     $statement->bindValue(':name', $name);
//     $statement->bindValue(':email', $email);
//     $statement->bindValue(':description', $description);
//     $statement->execute();
//     $statement->closeCursor();
// }

function addEatery($new_id, $name, $email, $description, $cuisine, $street_address, $city, $state, $zip_code, $phone, $price){
  global $db;
  $query = "insert into eatery (ID, name, email, description, cuisine, street_address, city, state, zip_code, phone, price)
  VALUES (:id, :name, :email, :description, :cuisine, :street_address, :city, :state, :zip_code, :phone, :price)";
  $statement = $db->prepare($query); 
  $statement->bindValue(':id', $new_id);
  $statement->bindValue(':name', $name);
  $statement->bindValue(':email', $email);
  $statement->bindValue(':description', $description);
  $statement->bindValue(':cuisine', $cuisine);
  $statement->bindValue(':street_address', $street_address);
  $statement->bindValue(':city', $city);
  $statement->bindValue(':state', $state);
  $statement->bindValue(':zip_code', $zip_code);
  $statement->bindValue(':phone', $phone);
  $statement->bindValue(':price', $price);
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

function fetchCreatedReviews_byEateryID($eateryID) {
  global $db;
  $query = 'SELECT 
    review.reviewer_username,
    eatery.name,
    review.comment, 
    review.number_rating
  FROM eatery JOIN review
  WHERE eatery.ID = review.eateryID AND review.eateryID = :eateryID';
  $statement = $db->prepare($query);
  $statement->bindValue(':eateryID', $eateryID);
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

function cafeJoin(){
  global $db;
  $query = "select * from eatery natural join cafe_bakery";
  $statement = $db->prepare($query);
  //$statement->bindValue(':price', $price);
  $statement->execute();
  $results = $statement->fetchAll();   // fetch()
  $statement->closeCursor();
  return $results;  
}

function restaurantJoin(){
  global $db;
  $query = "select * from eatery natural join restaurant";
  $statement = $db->prepare($query);
  $statement->execute();
  $results = $statement->fetchAll();   // fetch()
  $statement->closeCursor();
  return $results;  
}

function barJoin(){
  global $db;
  $query = "select * from eatery natural join bar";
  $statement = $db->prepare($query);
  $statement->execute();
  $results = $statement->fetchAll();   // fetch()
  $statement->closeCursor();
  return $results;  
}

// function createVisitCount() {
//   global $db;
//   $query = "select name, count(distinct username) 
//   from dines_at inner join eatery on dines_at.eateryID = eatery.ID
//   group by eateryID;";
//   $statement = $db->prepare($query);
//   $statement->execute();
//   $results = $statement->fetchAll();   // fetch()
//   $statement->closeCursor();
//   return $results;  
// }

// function getVisitCount(){
//   global $db;
//   $query = "select count (distinct username) from eatery natural join dines_at group by eateryID";
//   $statement = $db->prepare($query);
//   $statement->execute();
//   $results = $statement->fetchAll();   // fetch()
//   $statement->closeCursor();
//   return $results;  
// }

function updateEatery($name, $email, $new_description, $new_cuisine, $new_street_address, $new_city, $new_state, $new_zip_code, $new_phone, $new_price){
    global $db;
    $attributes = [$name, $email, $new_description, $new_cuisine, $new_street_address, $new_city, $new_state, $new_zip_code, $new_phone, $new_price];
    $attribute_names = ["name", "email", 'description', "cuisine", "street_address", "city", "state", "zip_code", "phone", "price"];
    for ($i = 2; $i < count($attributes); $i++) {
        if($attributes[$i]){
            $query = "update eatery set {$attribute_names[$i]}=:{$attribute_names[$i]} WHERE email=:email AND name=:name";
            $statement = $db->prepare($query); 
            $statement->bindValue(':name', $name);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':' . $attribute_names[$i], $attributes[$i]);
            $statement->execute();
            $statement->closeCursor();
        }    
    }
}

function addBar($id, $happy_hour){
  global $db;
  $query = "insert into bar (ID, happy_hour) VALUES (:id, :happy_hour)";
  $statement = $db->prepare($query); 
  $statement->bindValue(':id', $id);
  $statement->bindValue(':happy_hour', $happy_hour);
  $statement->execute();
  $statement->closeCursor();
}

function addRestaurant($id, $reservation_policy, $dress_code){
  global $db;
  $query = "insert into restaurant (ID, reservation_policy, dress_code) VALUES (:id, :reservation_policy, :dress_code)";
  $statement = $db->prepare($query); 
  $statement->bindValue(':id', $id);
  $statement->bindValue(':reservation_policy', $reservation_policy);
  $statement->bindValue(':dress_code', $dress_code);
  $statement->execute();
  $statement->closeCursor();
}

function addCafeBakery($id, $wifi_available){
  global $db;
  $i = 1;
  $query = "insert into cafe_bakery (ID, wifi_available) VALUES (:id, {$i})";
  $statement = $db->prepare($query); 
  $statement->bindValue(':id', $id);
  $statement->bindValue(':wifi_available', $wifi_available);
  $statement->execute();
  $statement->closeCursor();
}

?>

