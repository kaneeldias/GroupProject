<!DOCTYPE html>

<head>
    <title>UCSC Academic Support System</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?=base_url("assets/css/form_styles.css")?>"

    <!--<script type="text/javascript" src="<?=base_url("assets/js/modal_script.js")?>"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?=base_url("assets/js/jqueryvalidate/jquery.validate.js")?>"></script>
    <script type="text/javascript" src="<?=base_url("assets/js/jqueryvalidate/additional-methods.js")?>"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>



</head>

<body>

<style>
    html,body{
        overflow:auto;
        height:100%;
    }

    body{
        font-family: 'Roboto', sans-serif;
    }
</style>

    <link rel="stylesheet" type="text/css" href="<?=base_url("assets/css/custom_modal_styles.css")?>">

    <div id="header" class="row align-middle" style="width:100%; margin:0px;">
        <div class="flex-row col-md-12" style="display:flex; align-items:center;">

            <div id="sidebarCollapse" style="padding:5px; margin-right:25px;">
                <i class="fas fa-bars"></i>
                <style>
                    #sidebarCollapse{
                        color:#DDDDDD;
                        transition:all 0.2s;
                        cursor:pointer;
                    }
                    #sidebarCollapse:hover{
                        color:white;
                    }
                </style>
            </div>
            <div>
                <a href="<?=base_url('/Dashboard');?>">
                    <img src="<?=base_url('images/ucsc_logo.png')?>" width="50px">                </a>
            </div>
            <div>
                <link rel="stylesheet" type="text/css" href="<?=base_url("assets/css/header_styles.css")?>">
                <!--<div id="header_title">UCSC Academic Support System</div>-->
            </div>

            <div class="flex-grow-1"></div>

            <!--<div style="margin-right:20px;">
                <div>
                    <a href="https://www.facebook.com/PahasaraUCSC/">
                        <img src="<?=base_url('images/facebook.png')?>" width="40px">
                    </a>
                    <a href="https://twitter.com/UCSC_LK">
                        <img src="<?=base_url('images/twitter.png')?>" width="40px" style="margin-right: 10px">
                    </a>
                    <a href="https://www.instagram.com/ucsc_lk/">
                        <img src="<?=base_url('images/instagram.png')?>" width="40px" style="margin-right: 10px">
                    </a>
                    <a href="https://plus.google.com/+UniversityofColomboSchoolofComputingUCSC">
                        <img src="<?=base_url('images/googlePlus.png')?>" width="40px" style="margin-right: 10px">
                    </a>
                    <a href="https://www.youtube.com/channel/UC0gdcqEL6ZZeT67s0IbOrHg">
                        <img src="<?=base_url('images/youtube.png')?>" width="40px">
                    </a>
                </div>
            </div>-->
            <div>
                <div id="header_links">
                    <?php if($this->session->userdata('logged') !== null && $this->session->userdata('logged')): ?>
                        <span><a href="<?=base_url("Dashboard")?>">Dashboard</a></span>
                        <span><a href="<?=base_url("profile")?>"><?php $fname = $this->session->userdata('fname'); echo $fname; ?></a></span>
                        <span><a href="<?=base_url("auth/logout")?>">Log out</a></span>
                    <?php else : ?>
                        <span><a href="<?=base_url("log-in")?>">Login</a></span>
                    <?php endif ?>
                </div>
            </div>

        </div>
    </div>

<?php $this->load->view("templates/sidebar")?>

<?php if (isset($path)):?>
<nav aria-label="breadcrumb" style="margin-top:44px;">
    <ol class="breadcrumb" style="background-color:#2c3e50; border-radius:0px; color:white;">
        <?php foreach($path as $p=>$k):?>
        <li class="breadcrumb-item"><a style="color:white;" href="<?=$k?>"><?=$p?></a></li>
        <?php endforeach?>
    </ol>
</nav>
<?php endif?>

<div class="column" id="content" style="margin-top:100px; margin-bottom:50px; min-height:100%; padding-left:20px; padding-right:20px;">
