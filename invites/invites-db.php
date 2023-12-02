<?php

function invite($invitee, $inviter, $eateryID, $date_time_from, $date_time_to) {
    global $db;
    $query = "insert into invites (invitee, inviter, eateryID, date_time_from, date_time_to, accepted, denied)
    VALUES (:invitee, :inviter, :eateryID, :date_time_from, :date_time_to, FALSE, FALSE)";
    $statement = $db->prepare($query);
    $statement->bindValue(':invitee', $invitee);
    $statement->bindValue(':inviter', $inviter);
    $statement->bindValue(':eateryID', $eateryID);
    $statement->bindValue(':date_time_from', $date_time_from);
    $statement->bindValue(':date_time_to', $date_time_to);
    $result = $statement->execute();
    $statement->closeCursor();
    return $result;
}

function fetchInviteeInvites($invitee) {
    global $db;
    $query = 'select * from invites where invitee = :invitee';
    $statement = $db->prepare($query); 
    $statement->bindValue(':invitee', $invitee);
    $statement->execute();
    $result = $statement->fetchAll();
    return $result;
}

function fetchInviterInvites($inviter) {
    global $db;
    $query = 'select * from invites where inviter = :inviter';
    $statement = $db->prepare($query); 
    $statement->bindValue(':invitee', $inviter);
    $statement->execute();
    $result = $statement->fetchAll();
    return $result;
}

?>
