<div class="column time_table_container mx-auto col-md-12" style="text-align:center;">

    <?php if($set):?>
    <h2 style="margin-bottom:20px;">Your Time Table for this week</h2>

    <link href="<?=base_url("assets/css/table_styles.css")?>" rel="stylesheet" type="text/css"></link>
    <link href="<?=base_url("assets/css/timetable_styles.css")?>" rel="stylesheet" type="text/css"></link>

    <table class="custom_table time_table col-md-12 mx-auto">
        <tr class="header">
            <td>Time</td>
            <td>Monday</td>
            <td>Tuesday</td>
            <td>Wednesday</td>
            <td>Thursday</td>
            <td>Friday</td>
        </tr>
        <?php for($i = 8; $i <=17; $i++): ?>
            <tr>
                <td><?= $i.":00 - ".($i+1).":00" ?></td>
                <?php for($j = 1; $j <= 5; $j++): ?>
                    <td <?php if($this->session->userdata('type') == 'admin'):?> class="selectable" day="<?=$j?>" start_time="<?=$i?>" end_time="<?=$i+1?>"<?php endif?>>
                        <?php foreach($lectures[$j][$i] as $item): ?>
                        <div style="margin-top:10px; margin-bottom:10px;">
                            <div><?=$item["subject"]->getCode()?></div>
                            <div style="font-size:12px;">
                                <?php
                                $group_id = $item['group']->getGroupId();
                                $semester = $_GET['semester'];
                                ?>
                                <a href="<?=base_url("time-table/group?group=$group_id&semester=$semester")?>"><?= $item['group']->getName()?></a>
                                <!--<div style="font-size:12px;"><?=$item["subject"]->getName()?></div>-->
                                <div style="font-size:12px;">
                                    <?php
                                    $v = [];
                                    foreach($item["venues"] as $venue){
                                        $id = $venue->getId();
                                        $linked = "<a href=".base_url("time-table/lecture-hall?venue_id=$id&semester=$semester").">".$venue->getName()."</a>";
                                        array_push($v, $linked);
                                    }
                                    echo implode(", ", $v);
                                    ?>
                                </div>
                                <div style="font-size:12px; font-weight:bold;">
                                    <?php
                                    $s = [];
                                    foreach($item["staff"] as $staff){
                                        $id = $staff->getId();
                                        $linked = "<a href=".base_url("time-table/lecturer?lecturer_id=$id&semester=$semester").">".strtoupper($staff->getShortform())."</a>";
                                        array_push($s, $linked);
                                    }
                                    echo implode(", ", $s);
                                    ?>
                                </div>
                                <?php if($this->session->userdata('type') == 'admin'):?>
                                    <?php
                                    $lec_id = $item['lecture_id'];
                                    $delete = base_url("lecture/delete?lecture_id=$lec_id")
                                    ?>
                                    <span><a style="color:#d91e18;" href="<?=$delete?>">Remove</a></span>
                                <?php endif?>
                            </div>
                            <?php endforeach ?>
                    </td>
                <?php endfor?>
            </tr>
        <?php endfor?>
    </table>

    <?php else: ?>

        <h2>Get started by setting up your <a href="<?=base_url("profile/edit")?>">profile</a></h2>

    <?php endif?>

</div>


<style>

    #dashboard{
        border-color:#22313f;
        border-radius:5px;
        border-style:solid;
        border-width:2px;
        //box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        padding:0px;
    }

    .dashboard_links{
        background-color:#22313f;
    }

    .dashboard_links a{
        text-decoration:none;
    }

    .dashboard_link{
        padding:20px;
        background-color:#22313f;
        color:white;
        text-transform:uppercase;
        font-size:18px;
        transition:all 0.2s;
        cursor:pointer;
    }

    .dashboard_link:hover{
        background-color: #364e64;
    }
</style>