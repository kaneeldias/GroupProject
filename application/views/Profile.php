
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container emp-profile col-md-6">
                <div class="row">
                    <div class="col-md-8">
                        <div class="profile-head">
                            <h5> <?php echo $Details->getFname()?> <?php echo $Details->getLname()?></h5>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <?php if($this->session->userdata("type") == "staff" || $this->session->userdata("type") == "student"):?>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Time Table</a>
                                </li>
                                <?php endif?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4" style="float:left;">
                        <a href="<?=base_url("profile/edit")?>">
                            <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>First Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $Details->getFname()?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Last Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $Details->getLname()?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $Details->getEmail()?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Contact Number</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $Details->getTp()?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Account Type</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $this->session->userdata("type")?></p>
                                    </div>
                                </div>
                            </div>

                            <?php if($this->session->userdata("type") == "staff" || $this->session->userdata("type") == "student"):?>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Time Table Profile</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>
                                            <?php if(isset($cal_lec)):?>
                                                <?= $cal_lec->getName();?>
                                            <?php else: ?>
                                                Not set
                                            <?php endif?>
                                        </p>
                                    </div>
                                </div>

                                <?php if($calendar):?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Google Calendar Account</label>
                                    </div>
                                    <div class="col-md-6">
                                       <?php if($calendar):?>
                                        <p><?=$cal_email?></p>
                                        <?php endif?>
                                    </div>
                                </div>
                                <?php endif?>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Google Calendar Integration</label>
                                    </div>
                                    <div class="column col-md-6">
                                        <!--<?php if($this->session->userdata("type") == "staff"):?>
                                            <form class="row" method="POST" action="<?=base_url("calendar/setAccountLecturer")?>">
                                            <select class="form_input" id="lecturer" name="lecturer">
                                                <?php foreach($lecturers as $lecturer):?>
                                                    <option <?php if($lecturer->getId() == $timetable_id) echo "selected"?> value="<?=$lecturer->getId()?>"><?=$lecturer->getName()?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <input type="submit" value="Submit"/>
                                            </form>
                                        <?php endif?>-->
                                        <?php if($calendar): ?>
                                        <p>Integrated</p>
                                        <p>
                                            <a href="<?=base_url("calendar/refresh")?>">Refresh</a>
                                            <a style="margin-left:10px;" href="<?=base_url("calendar/remove")?>">Remove</a>
                                        </p>
                                        <?php else: ?>
                                        <p onclick="getCodeWindow()" style="cursor:pointer;">Get Code</p>
                                            <script>
                                                function getCodeWindow() {
                                                    var newWin = window.open('<?=$authUrl?>', 'example', 'width=600,height=400');
                                                }
                                            </script>
                                            <form class="form_item row" method="POST" action="<?=base_url("calendar/integrate")?>">
                                                <input style="width:5000px; margin-bottom:10px;" class="custom_form_item" type="text" name="authCode" placeholder="Enter Code"/>
                                                <button type="submit">Integrate</button>
                                            </form>

                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                            <?php endif?>
                        </div>
                    </div>
                </div>
        </div>

<style>
    body{
        background: -webkit-linear-gradient(left, #3931af, #00c6ff);
    }
    .emp-profile{
        padding: 3%;
        margin-top: 3%;
        margin-bottom: 3%;
        border-radius: 0.5rem;
        background: #fff;
    }
    .profile-img{
        text-align: center;
    }
    .profile-img img{
        width: 70%;
        height: 100%;
    }
    .profile-img .file {
        position: relative;
        overflow: hidden;
        margin-top: -20%;
        width: 70%;
        border: none;
        border-radius: 0;
        font-size: 15px;
        background: #212529b8;
    }
    .profile-img .file input {
        position: absolute;
        opacity: 0;
        right: 0;
        top: 0;
    }
    .profile-head h5{
        color: #333;
    }
    .profile-head h6{
        color: #0062cc;
    }
    .profile-edit-btn{
        border: none;
        border-radius: 1.5rem;
        width: 70%;
        padding: 2%;
        font-weight: 600;
        color: #6c757d;
        cursor: pointer;
    }
    .proile-rating{
        font-size: 12px;
        color: #818182;
        margin-top: 5%;
    }
    .proile-rating span{
        color: #495057;
        font-size: 15px;
        font-weight: 600;
    }
    .profile-head .nav-tabs{
        margin-bottom:5%;
    }
    .profile-head .nav-tabs .nav-link{
        font-weight:600;
        border: none;
    }
    .profile-head .nav-tabs .nav-link.active{
        border: none;
        border-bottom:2px solid #0062cc;
    }
    .profile-work{
        padding: 14%;
        margin-top: -15%;
    }
    .profile-work p{
        font-size: 12px;
        color: #818182;
        font-weight: 600;
        margin-top: 10%;
    }
    .profile-work a{
        text-decoration: none;
        color: #495057;
        font-weight: 600;
        font-size: 14px;
    }
    .profile-work ul{
        list-style: none;
    }
    .profile-tab label{
        font-weight: 600;
    }
    .profile-tab p{
        font-weight: 600;
        color: #0062cc;
    }
</style>