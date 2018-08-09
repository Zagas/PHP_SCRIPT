<?php 
/**
 * zcron.php
 *
 * Cron Script that remind on every launch the project that will expire soon 
 *
 * @category   Vtiger_Script
 * @package    PackageName
 * @author     GIuseppe Zagaria
 * @copyright  2018 Giuseppe Zagaria
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 *
 */
$host = 'localhost';
$username = 'username';
$password ='password';
$nome_db = 'nomeDB';
$today = date("Y-m-d");
//echo date("Y-m-d",strtotime("-3 Months"));

//Connessione DB
$con = new mysqli($host, $username , $password , $nome_db );
    if ($mysqli->connect_error) {
        die('Errore di connessione (' . $mysqli->connect_errno . ') '
        . $mysqli->connect_error);
    } else {
        echo 'Connesso. ' . $mysqli->host_info . "\n";
    }
//Recupero email a cui spedirò
$sql_email= "SELECT email1 FROM vtiger_users";
$ris_email = $con->query($sql_email);
$recipients = array();
while($row_email = $ris_email->fetch_assoc()) {
   array_push($recipients,$row_email['email1']);
}
//SELECT DATA Expire project
$sql = "SELECT * FROM vtiger_project";
$risultato = $con->query($sql);

if ($risultato->num_rows > 0) {
    // output data of each row
    while($row = $risultato->fetch_assoc()) {
        $nome_project = $row['projectname'];
        $id_project = $row['project_no'];
        $data_scadenza = $row['targetenddate'];
        $data_sotto = $row['startdate'];
        $scadenza = date('Y-m-d', strtotime($data_scadenza . ' -4 Months')); //project that will expire in 4 months
        $id_azienda = $row['linktoaccountscontacts'];

            if ($today >= $scadenza && $id_azienda > 140){
                    //print_r($scadenza);
                    echo '<br>'.$today.'<br>'.$id_project.'-'.$nome_project.' '.$data_scadenza.' '.$id_azienda.'<br>';

                    $sql_azienda = "SELECT * FROM vtiger_account WHERE accountid=$id_azienda";
                    $ris_azienda = $con->query($sql_azienda);
                    while($row_azienda = $ris_azienda->fetch_assoc()) {
                         $nome_cognome = $row_azienda['accountname'];
                         $phone = $row_azienda['phone'];
                         $email = $row_azienda['email1'];
                         $website = $row_azienda['website'];
                         $fax = $row_azienda['fax'];

                     echo $nome_cognome.' '.$email.' '.$scadenza.'<br>';
                    send_email($nome_cognome,$phone,$email,$fax,$nome_project,$data_scadenza,$id_project,$data_sotto,$recipients);
                    }
            }
    }
} else {
    echo "0 results";
}
$con->close();





//Esempio con scandeza di progetti
function send_email($nome_cognome,$phone,$email,$fax,$nome_project,$data_scadenza,$id_project,$data_sotto,$recipients){
    $to = implode(",",$recipients); //array with all email
    //$to      = 'rubino@sharks.net,mrhide@hideme.com';
    $subject = 'Scadenza '.$nome_project.' di '.$nome_cognome.' il '.$data_scadenza;
    $message = 'La polizza'. $id_project.'-'.$nome_project.'  di '.$nome_cognome.'  sta scandendo, conttatalo al più presto!
    Sottoscritta '.$data_sotto.' e scadrà '.$data_scadenza.'
    
    Email: '.$email.'
    Telefono/Fax: '.$phone.' - '.$fax.'
    ';
    $headers = 'From: crm@lgs.srl' . "\r\n" .
        'Reply-To: xero@guidagalatticaperinternauti.it' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    
    mail($to, $subject, $message, $headers);
}
?>