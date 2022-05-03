<?php
session_start();
require('connection.inc.php');
require('functions.inc.php');

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Donor Registration form</title>
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
        <h1>Covid-Helpdesk</h1>
        <form method="POST" autocomplete="off">
            <p>
                <label class="text-success"> You have successfully registered to Covid-helpdesk </label>
                <label class="text-success"> We'll contact you soon </label>
            </p>
            <div>

                <p>
                    <a type="button" href="<?php echo SITE_PATH ?>">Go Back to Home Page</a>
                </p>
            </div>
        </form>
    </div>
</body>


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