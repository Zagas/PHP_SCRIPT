<?php
/** Created By Giuseppe Zagaria  */

//Add Contact email to a List version 2
function add_to_list_2($email,$id){
  $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.sendinblue.com/v3/contacts",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"email\":\"".urlencode($email)."\",\"listIds\":[$id],\"updateEnabled\":true}",
  CURLOPT_HTTPHEADER => array(
    "accept: application/json",
    "api-key: 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",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
}




//Add Contact email to a List
function add_to_list($email,$id){
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.sendinblue.com/v3/contacts/".urlencode($email)."",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_POSTFIELDS => "{\"listIds\":[$id]}",
        CURLOPT_HTTPHEADER => array(
          "accept: application/json",
          "content-type: application/json",
          "api-key: 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"
        ),
      ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $response;
    }
    
    }

    //Retrieve all email info about a single contact
    function retrieve_email_info($email){

      
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.sendinblue.com/v3/contacts/".urlencode($email)."",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "accept: application/json",
          "api-key: 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"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
         echo "cURL Error #:" . $err;
        } else {
         return $response;
        }

    }

//Delete all elements from a sendinblue list
function delete_all_list($id){
    $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.sendinblue.com/v3/contacts/lists/$id/contacts/remove",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\"all\":true}",
    CURLOPT_HTTPHEADER => array(
      "accept: application/json",
      "api-key: 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",
      "content-type: application/json"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
  echo $response;
  }
}

//Allow to create a new passing the new name and the folder_id where you eant to insert
function create_new_list($name,$folderId){

  
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.sendinblue.com/v3/contacts/lists",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"name\":\"$name\",\"folderId\":$folderId}",
  CURLOPT_HTTPHEADER => array(
    "accept: application/json",
    "api-key: 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",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

}

function add_click_user($emails, $id,$type){ //add campaign click to vtiger campaign module
  $conn = new mysqli('localhost', 'user', 'passwrod', 'nome_db');

  $risposta = retrieve_email_info($emails);

$array_risp = json_decode($risposta, true);
if(!empty($array_risp['statistics']['clicked'])){
foreach ($array_risp['statistics']['clicked'] as $click){

  //echo $click['campaignId']."xxx<br>";

      if(!empty($click['campaignId'])){

          $sql3 = "Select campaignid from vtiger_campaign where campaign_no =".$click['campaignId'];

          $con_res3 = $conn->query($sql3);

          while($con_r3 = $con_res3->fetch_assoc()) {
              $campaignid3 = $con_r3['campaignid'];
          }
          if ($type == 'A'){
              $update_rel= "UPDATE `vtiger_campaignaccountrel` SET `campaignrelstatusid`= 3 WHERE  `campaignid`=".$campaignid3." AND accountid=".$id." LIMIT 1;";
          }elseif($type == 'C'){
              $update_rel= "UPDATE `vtiger_campaigncontrel` SET `campaignrelstatusid`= 3 WHERE  `campaignid`=".$campaignid3." AND contactid=".$id." LIMIT 1;";
          }
          echo '<br>'.$update_rel;
         if ($conn->query($update_rel) === TRUE) {
              echo "<br>New record created successfully".$update_rel;
          } else {
           break;
           echo "Error: " . $update_rel . "<br>" . $conn->error;
          }

      }
  
}
mysqli_close($conn);
}
}
//restrieve the complete list of all sent campaign
function all_campaign(){

  $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.sendinblue.com/v3/emailCampaigns?status=sent&limit=500&offset=0",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "accept: application/json",
    "api-key: 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"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  return $response;
}
}
?>