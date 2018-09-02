<!DOCTYPE html>

<head>
    <title>UCSC Academic Support System</title>

    <link rel="stylesheet" type="text/css" href="<?=base_url("assets/css/form_styles.css")?>"

</head>

<body>


    <?php
    $this->view('modals/login');
    $this->view('modals/alert');
    ?>

    <script>

        <?php if(isset($_GET['login']) && $_GET['login'] == "true"): ?>
            show_alert("You have successfully logged in.");
        <?php endif?>

        <?php if(isset($_GET['login']) && $_GET['login'] == "false"): ?>
        show_alert("Incorrect email and/or password.");
        <?php endif?>

        <?php if(isset($_GET['logout']) && $_GET['logout'] == "true"): ?>
        show_alert("You have successfully logged out.");
        <?php endif?>

    </script>


    <div id="header">
        <link rel="stylesheet" type="text/css" href="<?=base_url("assets/css/header_styles.css")?>">
        <div id="header_title">UCSC Academic Support System</div>

        <div id="header_links">
            <?php if($this->session->userdata('logged') !== null && $this->session->userdata('logged')): ?>
                <span><a href="<?=base_url("auth/logout")?>">Log out</a></span>
            <?php else : ?>
                <span onclick="document.getElementById('login_modal').style.display='block'">Login</span>
                <span>Register</span>
            <?php endif ?>
        </div>
    </div>


    <div id="content">
