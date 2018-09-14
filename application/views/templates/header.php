<!DOCTYPE html>

<head>
    <title>UCSC Academic Support System</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?=base_url("assets/css/form_styles.css")?>"

    <!--<script type="text/javascript" src="<?=base_url("assets/js/modal_script.js")?>"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>



</head>

<body>

<style>
    body{
        font-family: 'Roboto', sans-serif;
    }
</style>

    <link rel="stylesheet" type="text/css" href="<?=base_url("assets/css/custom_modal_styles.css")?>">


    <script>

        <?php if(isset($_GET['login']) && $_GET['login'] == "false"): ?>
            show_alert("Incorrect email and/or password.");
        <?php endif?>

    </script>


    <div id="header">
        <div class="row">
            <div class="col-lg-1" >
                <a href="http://ucsc.cmb.ac.lk/">
                    <img src="images/ucsc.png" width="150px">
                </a>
            </div>
            <div class="col-lg-8">
                <link rel="stylesheet" type="text/css" href="<?=base_url("assets/css/header_styles.css")?>">
                <div id="header_title">UCSC Academic Support System</div>
            </div>
            <div class="col-lg-5" style=" padding-top: 15px" >

                <a href="https://www.facebook.com/PahasaraUCSC/">
                    <img src="images/facebook.png" width="50px">
                </a>
                <a href="https://twitter.com/UCSC_LK">
                    <img src="images/twitter.png" width="35px" style="margin-right: 10px">
                </a>
                <a href="https://www.instagram.com/ucsc_lk/">
                    <img src="images/instagram.png" width="30px" style="margin-right: 10px">
                </a>
                <a href="https://plus.google.com/+UniversityofColomboSchoolofComputingUCSC">
                    <img src="images/googlePlus.png" width="35px" style="margin-right: 10px">
                </a>
                <a href="https://www.youtube.com/channel/UC0gdcqEL6ZZeT67s0IbOrHg">
                    <img src="images/youtube.png" width="36px">
                </a>

            </div>
            <div class="col-lg-1">
                <div id="header_links">
                    <span><a href="<?=base_url("signup")?>">Sign Up</a></span>

                    <?php if($this->session->userdata('logged') !== null && $this->session->userdata('logged')): ?>
                        <span><a href="<?=base_url("auth/logout")?>">Log out</a></span>
                    <?php else : ?>
                        <span><a href="<?=base_url("log-in")?>">Login</a></span>
                    <?php endif ?>
                </div>
            </div>

        </div>
    </div>


    <div id="content" style="margin-top:100px;">
