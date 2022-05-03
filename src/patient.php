<?php
session_start();
require('connection.inc.php');
require('functions.inc.php');


if (isset($_POST['submit_btn'])) {
    if ($_POST['name'] != '' && $_POST['phone_number'] != '' && $_POST['email'] != '' && $_POST['blood_group'] != '' && $_POST['city'] != '') {
        $name = get_safe_value($conn, $_POST['name']);
        $phone_number = get_safe_value($conn, $_POST['phone_number']);
        $email = get_safe_value($conn, $_POST['email']);
        $blood_group = get_safe_value($conn, $_POST['blood_group']);
        $city = get_safe_value($conn, $_POST['city']);

        $sql = "INSERT INTO patient(name, phone_number, email, blood_group, city) VALUES ('$name', '$phone_number', '$email', '$blood_group', '$city')";

        $res = mysqli_query($conn, $sql);
        if ($res) {
            header('location:'.SITE_PATH.'thank-you');
        }
    } else {
        echo "Blank Fields Detected";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Patient Registration form</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo SITE_PATH ?>style.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>


</head>


<body>

<?php require("nav_bar.php"); ?>

    <div class="container">

        <h1>Patient Registration form</h1>

        <form method="POST" autocomplete="off" name="patient_registration">
            <input type="text" name="csrf_token" hidden value="<?php echo csrf_token('patient'); ?>">

            <div>

                <p>
                    <label>
                        Name<br>
                        <input type="text" name="name" id="name" placeholder="Full Name">
                    </label>
                    <span id="namecheck"></span>
                </p>

                <p>
                    <label>
                        Number<br>
                        <input type="number" name="phone_number" id="mobile" placeholder="123456789">
                    </label>
                    <span id="mobilecheck"></span>
                </p>

                <p>
                    <label>
                        Email<br>
                        <input type="email" name="email" id="email" placeholder="something@email.com">
                    </label>
                    <span id="emailcheck"></span>
                </p>

                <p>
                    <label>
                        Blood Group<br>
                        <select name="blood_group" id="bloodgroup">
                            <option value="" disabled selected>Select...</option>
                            <option>A+</option>
                            <option>A-</option>
                            <option>B+</option>
                            <option>B-</option>
                            <option>AB+</option>
                            <option>AB-</option>
                            <option>O+</option>
                            <option>O-</option>
                        </select>
                    </label>
                    <span id="bloodgroupcheck"></span>
                </p>

                <p>
                    <label>
                        State / UT<br>
                        <select name="city" id="city">
                            <option value="" disabled selected>Select...</option>
                            <option>Andhra Pradesh (AP)</option>
                            <option>Arunachal Pradesh (AR)</option>
                            <option>Assam (AS)</option>
                            <option>Bihar (BR)</option>
                            <option>Chhattisgarh (CG)</option>
                            <option>Goa (GA)</option>
                            <option>Gujarat (GJ)</option>
                            <option>Haryana (HR)</option>
                            <option>Himachal Pradesh (HP)</option>
                            <option>Jammu and Kashmir (JK)</option>
                            <option>Jharkhand (JH)</option>
                            <option>Karnataka (KA)</option>
                            <option>Kerala (KL)</option>
                            <option>Madhya Pradesh (MP)</option>
                            <option>Maharashtra (MH)</option>
                            <option>Manipur (MN)</option>
                            <option>Meghalaya (ML)</option>
                            <option>Mizoram (MZ)</option>
                            <option>Nagaland (NL)</option>
                            <option>Odisha(OR)</option>
                            <option>Punjab (PB)</option>
                            <option>Rajasthan (RJ)</option>
                            <option>Sikkim (SK)</option>
                            <option>Tamil Nadu (TN)</option>
                            <option>Telangana (TS)</option>
                            <option>Tripura (TR)</option>
                            <option>Uttar Pradesh (UP)</option>
                            <option>Uttarakhand (UK)</option>
                            <option>West Bengal (WB)</option>
                            <option>Andaman and Nicobar Islands(AN)</option>
                            <option>Chandigarh (CH)</option>
                            <option>Dadra and Nagar Haveli (DN)</option>
                            <option>Daman and Diu (DD)</option>
                            <option>National Capital Territory of Delhi (DL)</option>
                            <option>Lakshadweep (LD)</option>
                            <option>Pondicherry (PY)</option>
                        </select>
                    </label>
                    <span id="bloodgroupcheck"></span>
                </p>

                <div class="w-100 mt-5">
                    <div class="resp_w-75">
                        <span class="fs-2"> By Submitting this form </span>
                        <ol>

                            <li> I confirm that the information I have provided in here is complete and accurate to the best of my knowledge. </li>

                            <li> I confirm that I wish to share the information provided here with ABHYUDAY for the exclusive purpose(s) of matching the patients with their suitable donors from the database of patients and donors registered with ABHYUDAY and sharing the information directly and solely with the matched patient or their next of kin and the donor.</li>

                            <li> I agree to hold ABHYUDAY harmless for its use of the information for the exclusive purpose(s) set out above. </li>
                        </ol>

                        <label> I accept the Privacy Statement 
                        <input type="checkbox" name="accept_terms" value="check" id="agree" ></label>
                        
                        <div class="row mt-5">
                            <div class="col-auto tab-resp_mb-3"><input type="submit" id="submit_btn" name="submit_btn"></div>
                            <div class="col-auto"><a type="button" href="<?php echo SITE_PATH ?>">Go Back to Home Page</a></div>
                        </div>
                        
                    </div>
                </div>

        </form>
    </div>
</body>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2WulC6fdCHMwJUypDOiEWUstYLT2iXxQ&v=3.exp&sensor=false&libraries=places,geometry"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(function() {
        $("form[name='patient_registration']").validate({
            rules: {
                name: "required",
                phone_number: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 10
                },
                blood_group: "required",
                infected_since: "required",
                city: "required",
                accept_terms: "required",
                email: {
                    required: true,
                    email: true
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });

</script>

<script>
    $(document).ready(function() {
        $('img').each(function(){
            if($(this).attr('alt') == "www.000webhost.com"){
                $(this).hide();
            }
        });
     });
</script>

</html>