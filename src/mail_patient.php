<?php
session_start();
require('connection.inc.php');
require('functions.inc.php');



if(isset($_GET['e']))
{
  $e = get_safe_value($conn, $_GET['e']);
  if($_GET['e'] == PATIENT_VERIFICATION_TOKEN)
  {
	$sql = "SELECT * FROM patient order by id desc";
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

			// fetch all the donars matching patient requirements 
		    $donor_sql = "SELECT * FROM donar WHERE blood_group = '".$row['blood_group']."' and city = '".$row['city']."' ORDER by id DESC LIMIT 2";
		    $donor_res = mysqli_query($conn, $donor_sql);

		    $rows_available = mysqli_num_rows($donor_res);

		    // Donars found 
		    if($rows_available > 0)
		    {

		    	// Create an array for the patient with all its information 
		    	$patient = array("name"=>$row['name'], "email"=>$row['email'], "phone_number"=>$row['phone_number'], "blood_group"=>$row['blood_group'], "infected_since"=>$row['infected_since'], "city"=>$row['city']);


		    	// Iterate through every donar matching the requirements and push them in an array
		    	while($donor_row = mysqli_fetch_assoc($donor_res)) 
		    	{

		    		// Check if donor is already matched with patient
		    		if(!empty($old_matches))
		    		{
			    		foreach ($old_matches as $old_match) {
			    			if($old_match == $donor_row['id'])
			    				$eligible_for_match = false;
			    		}
		    		}


		    		if($eligible_for_match)
		    		{
		    			// Push the donor in the donar array of patient
				    	array_push($donar, array("name"=>$donor_row['name'], "phone_number"=>$donor_row['phone_number'], "email"=>$donor_row['email'], "blood_group"=>$donor_row['blood_group'], "recoverd_since"=>$donor_row['recovered_since'], "antibody_test"=>$donor_row['antibody_test'], "city"=>$donor_row['city']));

				    	// Push this record in the new match array 
				    	array_push($new_matches, array("donar_id"=>$donor_row['id'], "patient_id"=>$row['id']));
				    }

		    	}

		    	// Then add the donars array in patient's array 
			    $patient['donar'] = $donar;

			    unset($donar); 
				$donar = array();

		    }

		    // Finally add that patient in the management array
		    array_push($management, $patient);
		    
		    unset($patient); 
			$patient = array();

		}

	}

	foreach ($management as $i) 
	{
		
		if(!empty($i) && !empty($i['donar']))
		{
			$body = generate_mail_body($i['name'], $i['phone_number'], $i['donar']);
			try{
				// $mail_sent = 1;
				$mail_sent = sendMail($i['email'], "ABHYUDAY - Blood Donation Drive", $body);
				sleep(5);
			}
			catch(Exception $e){
			}

		}

	}

 }

  else
    echo "Wrong Verification token";
}
else
  echo "Bad Request";




// Update the match table
if(isset($mail_sent))
{
	if($mail_sent)
	{
		$match_sql = "INSERT INTO patient_matches (patient_id, donar_id) VALUES ";
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



function generate_mail_body($name, $phone_number, $donar_arr)
{
	$body = '<div style="width: 90%; margin: auto; border: 1px solid #e3e3e3; padding: 19px; margin-bottom: 20px; box-shadow: inset 0 1px 1px rgba(0,0,0,.05);">';
	$body .= '<p style="font-size: 22px;">Dear '.$name.', </p>';

	$body .= '<div style="margin-left: 14px;">';
	$body .= "<p style='font-size: 17px;'>It's rightly said When the going gets tough, the tough get going. And so are you. We completely understand the phase you are going through and based on your requirements we have shortlisted following Donors for you.<br></p>";

  	$c=1;
	foreach ($donar_arr as $donor ) {
		$body .= "<p style='font-size: 17px;'>".$c.": ".$donor['name']."(".$donor['phone_number'].")</p>";
    	$c+=1;
	}
	

	$body .= "<p style='font-size: 17px;'>We request you to reach out to them as soon as possible.<br> Wishing you a speedy recovery.<br></p>";
	$body .= "<p style='font-size: 17px;'><br> Regards<br> Team Abhyuday<br> (@kitncc)</p>";
	$body .= '</div>';
	$body .= '</div>';

	return $body;
}



function old_matches($conn, $id)
{
	$old_matches_sql = "SELECT donar_id from patient_matches where patient_id = ".$id;

	$old_matches_res = mysqli_query($conn, $old_matches_sql);

	$old_matches_data=array();
	while ($old_matches_row=mysqli_fetch_assoc($old_matches_res)){
		$old_matches_data[] = $old_matches_row['donar_id'];
	}

	return $old_matches_data;
}

?>