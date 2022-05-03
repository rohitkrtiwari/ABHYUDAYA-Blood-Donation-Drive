<?php
session_start();
require('connection.inc.php');
require('functions.inc.php');


if(isset($_GET['e']))
{
  $e = get_safe_value($conn, $_GET['e']);
  if($_GET['e'] == DONOR_VERIFICATION_TOKEN)
  {

    $sql = "SELECT * FROM donar order by id desc";
    $res = mysqli_query($conn, $sql);

    $old_matches = array();
    $new_matches = array();
    $eligible_for_match = true;
    $management = array();
    $patient = array();
    $donar = array();


    // Fetch all patients
    if(mysqli_num_rows($res) > 0)
    {

      // Iterate thgrough every single patient 
      while($row = mysqli_fetch_assoc($res)) 
      {

        // Fetch all the previous matches of this patient
        $old_matches = old_matches($conn, $row['id']);

        // fetch all the patients matching donor requirements 
          $patient_sql = "SELECT * FROM patient WHERE blood_group = '".$row['blood_group']."' and city = '".$row['city']."' ORDER by id DESC LIMIT 2";

          $patient_res = mysqli_query($conn, $patient_sql);

          $rows_available = mysqli_num_rows($patient_res);

          // Patients found 
          if($rows_available > 0)
          {
            // Create an array for the Donor with all its information 
            $donar = array("name"=>$row['name'], "phone_number"=>$row['phone_number'], "email"=>$row['email']);

            // Iterate through every donar matching the requirements and push them in an array
            while($patient_row = mysqli_fetch_assoc($patient_res)) 
            {

              // Check if donor is already matched with patient
              if(!empty($old_matches))
              {
                foreach ($old_matches as $old_match) {
                  if($old_match == $patient_row['id'])
                    $eligible_for_match = false;
                }
              }

              if($eligible_for_match)
              {
                // Push the donor in the donar array of patient
                array_push($patient, array("name"=>$patient_row['name'], "email"=>$patient_row['email'], "phone_number"=>$patient_row['phone_number']));

                // Push this record in the new match array 
                array_push($new_matches, array("donar_id"=>$row['id'], "patient_id"=>$patient_row['id']));
              }

            }


            // Then add the donars array in patient's array 
            $donar['patient'] = $patient;

            unset($patient); 
            $patient = array();

          }

          // Finally add that patient in the management array
          array_push($management, $donar);
          
          unset($donar); 
          $donar = array();

      }

    }

    foreach ($management as $i) 
    {
      
      if(!empty($i) && !empty($i['patient']))
      {
        $body = generate_mail_body($i['name'], $i['phone_number'], $i['patient']);
        try{
          // $mail_sent = 1;
          $mail_sent = sendMail($i['email'], "ABHYUDAY - Blood Donation Drive", $body);
          sleep(5);
        }
        catch(Exception $e){
        }

        // echo $body;

      }

    }

    // Update the match table
    if(isset($mail_sent))
    {
      if($mail_sent)
      {
        $match_sql = "INSERT INTO donar_matches (patient_id, donar_id) VALUES ";
        $i=0;
        foreach ($new_matches as $match ) {

          if($i!=0)
            $match_sql.=",";

          $match_sql.= "(".$match['patient_id'].", ".$match['donar_id'].")";

          $i+=1;
        }

        mysqli_query($conn, $match_sql);

      }
    }    

  }

  else
    echo "Wrong Verification token";
}
else
  echo "Bad Request";





function old_matches($conn, $id)
{
  $old_matches_sql = "SELECT patient_id from donar_matches where donar_id = ".$id;

  $old_matches_res = mysqli_query($conn, $old_matches_sql);

  $old_matches_data=array();
  while ($old_matches_row=mysqli_fetch_assoc($old_matches_res)){
    $old_matches_data[] = $old_matches_row['patient_id'];
  }

  return $old_matches_data;
}



function generate_mail_body($name, $phone_number, $patient_arr)
{
	$body = '<div style="width: 90%; margin: auto; border: 1px solid #e3e3e3; padding: 19px; margin-bottom: 20px; box-shadow: inset 0 1px 1px rgba(0,0,0,.05);">';
	$body .= '<p style="font-size: 22px;">Dear '.$name.', </p>';

	$body .= '<div style="margin-left: 14px;">';
	$body .= "<p style='font-size: 17px;'>Hope you are in pink of your health & Sprit. You are an example of how people can be full of compassion, and be selfless even in these tough times.<br></p>";
  $c=1;
	foreach ($patient_arr as $patient ) {
		$body .= "<p style='font-size: 17px;'>".$c.": ".$patient['name']." (".$patient['phone_number'].")</p>";
    $c+=1;
	}

  if(count($patient_arr) >1)
	  $body .= "<p style='font-size: 17px;'>These Paitents are in need of your Blood. <br>They will contact you shortly.<br>Thank you for your help.<br> </p>";
  else
    $body .= "<p style='font-size: 17px;'>This Paitent is in need of your Blood. <br>He/She will contact you shortly.<br>Thank you for your help.<br> </p>";

	

	$body .= "<p style='font-size: 17px;'><br> Regards<br> Team Abhyuday<br> (@kitncc)</p>";
	$body .= '</div>';
	$body .= '</div>';

	return $body;
}


?>