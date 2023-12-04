<?php

function fetchReceivedInvites($invitee)
{
    global $db;
    $query = 'SELECT 
        invites.id,
        user.full_name, 
        eatery.name,
        invites.date_time_from,
        invites.date_time_to,
        invites.status
    FROM invites JOIN eatery JOIN user
    ON invites.eateryID = eatery.ID AND invites.invitee = user.username
    WHERE invites.invitee = :invitee';
    $statement = $db->prepare($query);
    $statement->bindValue(':invitee', $invitee);
    $statement->execute();
    $result = $statement->fetchAll();
    return $result;
}

function fetchSentInvites($inviter)
{
    global $db;
    $query = 'SELECT 
        invites.id,
        user.full_name, 
        eatery.name,
        invites.date_time_from,
        invites.date_time_to,
        invites.status
    FROM invites JOIN eatery JOIN user
    ON invites.eateryID = eatery.ID AND invites.invitee = user.username
    WHERE invites.inviter = :inviter';
    $statement = $db->prepare($query);
    $statement->bindValue(':inviter', $inviter);
    $statement->execute();
    $result = $statement->fetchAll();
    return $result;
}

function deleteInvitation($invitationID) {
    global $db;
    $query = 'delete from invites where ID = :invitationID';
    $statement = $db->prepare($query);
    $statement->bindValue(':invitationID', $invitationID);
    $statement->execute();
    $statement->closeCursor();  
}

function acceptInvitation($invitationID) {
    global $db;
    $query = 'update invites set status = "accepted" where ID = :invitationID';
    $statement = $db->prepare($query);
    $statement->bindValue(':invitationID', $invitationID);
    $statement->execute();
    $statement->closeCursor();  
}

function denyInvitation($invitationID) {
    global $db;
    $query = 'update invites set status = "denied" where ID = :invitationID';
    $statement = $db->prepare($query);
    $statement->bindValue(':invitationID', $invitationID);
    $statement->execute();
    $statement->closeCursor();  
}

function cancelInvitation($invitationID) {
    global $db;
    $query = 'update invites set status = "cancelled" where ID = :invitationID';
    $statement = $db->prepare($query);
    $statement->bindValue(':invitationID', $invitationID);
    $statement->execute();
    $statement->closeCursor();  
}

function createInvitation($inviter, $invitee, $eateryID, $date_time_from, $date_time_to) {
    global $db;
    $query = "insert into invites (inviter, invitee, eateryID, date_time_from, date_time_to, status)
    VALUES (:inviter, :invitee, :eateryID, :date_time_from, :date_time_to, 'pending')";
    $statement = $db->prepare($query);
    $statement->bindValue(':inviter', $inviter);
    $statement->bindValue(':invitee', $invitee);
    $statement->bindValue(':eateryID', $eateryID);
    $statement->bindValue(':date_time_from', $date_time_from);
    $statement->bindValue(':date_time_to', $date_time_to);
    $statement->execute();
    $statement->closeCursor();  
}

?>