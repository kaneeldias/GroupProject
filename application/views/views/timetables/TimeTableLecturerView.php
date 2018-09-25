<div class="column time_table_container mx-auto col-md-12" style="text-align:center;">

    <h2 style="margin-bottom:20px;">Viewing Time Table for <?=$staff->getName()?> Semester <?=$_GET['semester']?></h2>

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
                    <td class="selectable" day="<?=$j?>" start_time="<?=$i?>" end_time="<?=$i+1?>">
                        <?php if(isset($lectures[$j][$i])): ?>
                            <div><?=$lectures[$j][$i]["subject"]->getCode()?></div>
                            <div style="font-size:12px;">
                                <?php
                                    $group_id = $lectures[$j][$i]['group']->getGroupId();
                                    $semester = $_GET['semester'];
                                ?>
                                <a href="<?=base_url("time-table/group?group=$group_id&semester=$semester")?>"><?= $lectures[$j][$i]['group']->getName()?></a>
                            </div>
                            <!--<div style="font-size:12px;"><?=$lectures[$j][$i]["subject"]->getName()?></div>-->
                            <div style="font-size:12px;">
                                <?php
                                $v = [];
                                foreach($lectures[$j][$i]["venues"] as $venue){
                                    $id = $venue->getId();
                                    $linked = "<a href=".base_url("time-table/lecture-hall?venue_id=$id&semester=$semester").">".$venue->getName()."</a>";
                                    array_push($v, $linked);
                                }
                                echo implode(", ", $v);
                                ?>
                            </div>
                        <?php endif ?>
                    </td>
                <?php endfor?>
            </tr>
        <?php endfor?>
    </table>

</div>
