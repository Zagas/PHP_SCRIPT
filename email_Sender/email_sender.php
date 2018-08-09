<?php

//Esempio con scandeza di polizze assicurative
function send_email($nome_cognome,$phone,$email,$fax,$nome_polizza,$data_scadenza,$id_polizza,$data_sotto,$recipients){
    $to = implode(",",$recipients); //array with all email
    //$to      = 'rubino@sharks.net,mrhide@hideme.com';
    $subject = 'Scadenza '.$nome_polizza.' di '.$nome_cognome.' il '.$data_scadenza;
    $message = 'La polizza'. $id_polizza.'-'.$nome_polizza.'  di '.$nome_cognome.'  sta scandendo, conttatalo al più presto!
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