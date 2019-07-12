<?php
$conn = new mysqli('localhost', 'root', 'pasword', 'xero_db');
if ($conn->connect_error) {
    die('Errore di connessione (' . $conn->connect_errno . ') '
    . $conn->connect_error);
} else {
    echo 'Connesso. ' . $conn->host_info . "\n";
}

$sql = "SELECT contactid, accountid, email, b.smownerid as user_azienda, c.smownerid as user_contact  FROM vtiger_contactdetails as a left join vtiger_crmentity as b on a.accountid = b.crmid left join vtiger_crmentity as c on a.contactid = c.crmid ;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //echo "id: " . $row["contactid"]. " - Azienda id: " . $row["accountid"]. " -- " . $row["email"]. " -userAzienda- " . $row["user_azienda"]. " -usercontatto- " . $row["user_contact"]. "<br>";
        if($row["user_azienda"] != $row["user_contact"]){
            

            $updater = "UPDATE vtiger_crmentity SET `smownerid`=".$row["user_azienda"]." WHERE  `crmid`=".$row["contactid"].";";

            echo $updater;
            if ($conn->query($updater) === TRUE) {
                echo "<br>ESEGUIto UPDATE per ".$row["contactid"].'--'.$row["email"]." con utente azienda ".$row["user_azienda"]." Untente contatto  ".$row["user_contact"]."<br>";
            } else {
                echo "Error updating record: " . $conn->error;
            }
            
        
        
        }
    }
} else {
    echo "0 results";
}


?>