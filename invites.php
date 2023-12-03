<?php

require("connect-db.php");
require("invites/invites-db.php");
require("auth/user-db.php");
include("header.html");

// check if user is logged in, if not redirect to login.php
$user = $_COOKIE["user"];
$password = $_COOKIE["password"];

if (strlen($password) == 0 or strlen($user) == 0 or !checkUserPassword($user, $password)) {
    // Redirect the browser to another page using the header() function to specify the target URL
    header('Location: https://www.cs.virginia.edu/~dch6auf/project/auth/login.php');
}

// fetch all incoming and outgoing invites
$received_invites = fetchReceivedInvites($user);
$sent_invites = fetchSentInvites($user);

// handle post requests
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    

    if (!empty($_POST['deleteInvitation'])) {
        deleteInvitation($_POST['delete_invitation_id']);
    } else if (!empty($_POST['acceptInvitation'])) {
        acceptInvitation($_POST['accept_invitation_id']);
    } else if (!empty($_POST['denyInvitation'])) {
        denyInvitation($_POST['deny_invitation_id']);
    } else if (!empty($_POST['cancelInvitation'])) {
        cancelInvitation($_POST['cancel_invitation_id']);
    }
    header("Refresh:0"); // refresh page for users to see changes
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="../static/css/auth.css" rel="stylesheet" crossorigin="anonymous" />

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <title>Restaurant Buddy - Invites</title>
</head>

<body>
    <div id="header"></div>

    <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
        <div class="card bg-glass">
            <div class="card-body px-4 py-5 px-md-5">
                <h3>Received Invites</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Inviter</th>
                            <th scope="col">Eatery</th>
                            <th scope="col">From</th>
                            <th scope="col">Until</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($received_invites as $invite) {
                            $id = $invite['id']; // extract id 

                            echo "<tr>";
                            echo "<td>{$invite['full_name']}</td>";
                            echo "<td>{$invite['name']}</td>";
                            echo "<td>{$invite['date_time_from']}</td>";
                            echo "<td>{$invite['date_time_to']}</td>";
                            if ($invite["status"] == "pending") { 
                                echo "<td>Pending</td>";
                                echo "<td>
                                        <form action='invites.php' method='post'>
                                            <input type='submit' name='acceptInvitation' value='Accept' class='btn btn-secondary' />
                                            <input type='hidden' name='accept_invitation_id' value='$id'/>
                                        </form>
                                        <form action='invites.php' method='post'>
                                            <input type='submit' name='denyInvitation' value='Deny' class='btn btn-danger' />
                                            <input type='hidden' name='deny_invitation_id' value='$id'/>
                                        </form>
                                    </td>";
                            } else if ($invite["status"] == "accepted") {
                                echo "<td>Accepted</td>";
                                echo "<td>
                                        <form action='invites.php' method='post'>
                                            <input type='submit' name='cancelInvitation' value='Cancel' class='btn btn-danger' />
                                            <input type='hidden' name='cancel_invitation_id' value='$id'/>
                                        </form>
                                    </td>";
                            } else if ($invite["status"] == "denied") {
                                echo "<td>Denied</td>";
                                echo "<td>
                                        &nbsp
                                    </td>";
                            } else if ($invite["status"] == "cancelled") {
                                echo "<td>Cancelled</td>";
                                echo "<td>
                                        &nbsp
                                    </td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <h3>Sent Invites</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Invitee</th>
                            <th scope="col">Eatery</th>
                            <th scope="col">From</th>
                            <th scope="col">Until</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($sent_invites as $invite) {
                            echo "<tr>";
                            echo "<td>{$invite['full_name']}</td>";
                            echo "<td>{$invite['name']}</td>";
                            echo "<td>{$invite['date_time_from']}</td>";
                            echo "<td>{$invite['date_time_to']}</td>";
                            if ($invite["status"] == "pending") { 
                                echo "<td>Pending</td>";
                            } else if ($invite["status"] == "accepted") {
                                echo "<td>Accepted</td>";
                            } else if ($invite["status"] == "denied") {
                                echo "<td>Denied</td>";
                            } else {
                                echo "<td>Cancelled</td>";
                            } 
                            
                            $id = $invite['id'];
                            echo "<td>
                                    <form action='invites.php' method='post'>
                                        <input type='submit' name='deleteInvitation' value='Delete' class='btn btn-danger' />
                                        <input type='hidden' name='delete_invitation_id' value='$id'/>
                                    </form>
                                </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>