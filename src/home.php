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
    <title>Covid Helpdesk</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?php echo SITE_PATH ?>home.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.6.2/tailwind.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

</head>

<body>

  <?php require("nav_bar.php"); ?>
    
    <section style="margin: 60px 0;">
        <div class="container my-5">
            <div class="row">
                <div class="col-sm d-flex"><img class="img-fluid resp_mb-35 main_img" src="images/pexels.jpg"></div>            
                <div class="col-sm mx-3">
                    <span class="f-biggest">ABHYUDAY-Blood Donation Drive</span>
                    <div class="row mt-3">
                        <div class="col-lg"> <a href="<?php echo SITE_PATH ?>donate" class="button-primary tab-resp_mb-3">REGISTER AS A DONOR</a> </div>
                        <div class="col-lg"> <a href="<?php echo SITE_PATH ?>patient" class="button-secondary">PATIENT REGISTRATION</a> </div>
                    </div>
                </div>            
            </div>
        </div>
    </section>


    <section class="my-5 pt-5" id="what_we_do">
        <div class="container">
            <div class="text-center">
              <h3 class="text-3xl sm:text-5xl leading-normal font-extrabold tracking-tight fw-bolder">
                What We Do
              </h3>
            </div>
            <h5 class="text-center text-dark">Making a Difference</h5>

            <div class="row my-5 text-dark resp_px-5 ">
                <div class="col-sm resp_mb-3">
                    <img src="images/dabba_1.jpeg" class="img-fluid px-3">
                    <p class="px-3 fs-6">One to one assistance with verified leads of oxygen, medicines etc.</p>
                </div>
                <div class="col-sm resp_mb-3">
                    <img src="images/dabba_2.jpeg" class="img-fluid px-3">
                    <p class="px-3 fs-6"> COVID-19 mental health care support in association with udaan foundation. </p>
                </div>
                <div class="col-sm resp_mb-3">
                    <img src="images/dabba_3.png" class="img-fluid px-3">
                    <p class="px-3 fs-6">Meditation Workshop to strengthen lung capacity via breath.</p>
                </div>
                <div class="col-sm resp_mb-3">
                    <img src="images/dabba_4.jpeg" class="img-fluid px-3">
                    <p class="px-3 fs-6">Helping connect Blood donors & recipients.</p>
                </div>
            </div>
        </div>
    </section>


    <section id="how_it_works">
        <div class="py-24">
          <div class="max-w-screen-md mx-auto px-4 sm:px-6 lg:px-8 flex flex-col justify-between">
            
            <div class="text-center">
              <h3 class="text-3xl sm:text-5xl leading-normal font-extrabold tracking-tight text-gray-900">
                How it <span class="f-color fw-bolder">Works?</span>
              </h3>
            </div>

            <div class="mt-20">
              <ul class="">
                
                <li class="text-left mb-10">
                  <div class="flex flex-row items-start">
                    <div class="flex flex-col items-center justify-center mr-5">
                      <div class="flex items-center justify-center rounded-full bg-indigo-500 text-dark border-4 border-dark text-xl font-semibold" style="width: 7rem; height: 7rem;">
                        <img src="images/dabba_01.jpeg">
                      </div>
                    </div>
                    <div class="">
                      <h4 class="text-lg leading-6 font-semibold text-gray-900">Step 1</h4>
                      <p class="mt-2 text-base leading-6 fw-500">
                        We Register Your details
                      </p>
                    </div>
                  </div>
                </li>
                <li class="text-left mb-10">
                  <div class="flex flex-row items-start">
                    <div class="flex flex-col items-center justify-center mr-5">
                      <div class="flex items-center justify-center rounded-full bg-indigo-500 text-dark border-4 border-dark text-xl font-semibold" style="width: 7rem; height: 7rem;">
                        <img src="images/dabba_02.jpeg">
                      </div>
                    </div>
                    <div class="">
                      <h4 class="text-lg leading-6 font-semibold text-gray-900">Step 2</h4>
                      <p class="mt-2 text-base leading-6 fw-500">
                        Based on results, we match patients with suitable donors. 
                      </p>
                    </div>
                  </div>
                </li>
                <li class="text-left mb-10">
                  <div class="flex flex-row items-start">
                    <div class="flex flex-col items-center justify-center mr-5">
                      <div class="flex items-center justify-center rounded-full bg-indigo-500 text-dark border-4 border-dark text-xl font-semibold" style="width: 7rem; height: 7rem;">
                        <img src="images/dabba_03.jpeg">
                      </div>
                    </div>
                    <div class="">
                      <h4 class="text-lg leading-6 font-semibold text-gray-900">Step 3</h4>
                      <p class="mt-2 text-base leading-6 fw-500">
                        After your match we share details of patients with donors & donor's contact details with patient via E-Mail.
                      </p>
                    </div>
                  </div>
                </li>
                
              </ul>
            </div>
            
          </div>
        </div>
    </section>


    <section id="about">
        <div class="mb-5 about_section">  
            <div class="text-center">
              <h3 class="text-3xl sm:text-5xl leading-normal font-extrabold tracking-tight fw-bolder">
                ABOUT
              </h3>
            </div>
            <p class="text-dark"> 
                <p class="text-center text-dark"> Here at ABHYUDAY. We are driven
                    by a single goal, to do our part in helping mankind fight this crisis. We
                    are a team of National Cadet Corps cadets who are working selflessly day
                    and night to verify resources of oxygen, beds, ventilators, medicines
                    etc.<br> This is yet another initiative where patient in need of Blood
                    and recovered patients willing to donate Blood can come together under
                    one platform and connect with each other.<br> </p> <br> 

                <p class="text-dark">
                Love and Prayers<br> 
                Team Abhyuday.  </p> 
            </p>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $('img').each(function(){
            if($(this).attr('alt') == "www.000webhost.com"){
                $(this).hide();
            }
        });
     });
</script>

</body>

</html>