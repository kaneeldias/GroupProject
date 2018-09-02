<!DOCTYPE html>

<head>
    <title>UCSC Academic Support System test 123 </title>
</head>

<body>

<link rel="stylesheet" type="text/css" href="http://<?=base_url("assets/css/form_styles.css")?>">

<?php
$this->view('modals/login');
?>



    <div id="header" style="background-color:#6C7A89; font-size:20px; color:white; padding:10px; position:fixed; top:0px; left:0px; width:100%;">
        UCSC Academic Support System
        <span style="float:right; margin-right:20px;" onclick="document.getElementById('login_modal').style.display='block'">Login</span>
    </div>


    <div id="content">
