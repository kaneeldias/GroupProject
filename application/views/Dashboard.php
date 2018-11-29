<div class="row col-md-12" id="dashboard">
    <div class="row col-md-12 dashboard_links" style="padding:0px;">
        <a href="<?=base_url("signup")?>"><div class="dashboard_link">Register User</div></a>
        <a href="<?=base_url("lecturer")?>"><div class="dashboard_link">Lecturer</div></a>
        <a href="<?=base_url("subjects")?>"><div class="dashboard_link">Subjects</div></a>
        <a href="<?=base_url("lecture-halls")?>"><div class="dashboard_link">Lecture Halls</div></a>
        <a href="<?=base_url("student-groups")?>"><div class="dashboard_link">Student Group</div></a>
        <a href="<?=base_url("time-table-view")?>"><div class="dashboard_link">Time Tables</div></a>
        <a href="<?=base_url("booking")?>"><div class="dashboard_link">Bookings</div></a>
        <a href="<?=base_url("equipment")?>"><div class="dashboard_link">Equipment Reservation</div></a>
    </div>
    <div class="row col-md-9" style="display:flex; align-items:center; text-align:center;">
        <!--<div class="col-md-12 mx-auto form_container">

            <div class="form_title" style="font-size:18px;">Notes</div>

            <form class="column form_content" method="POST" action="<?=base_url("notes/update")?>">
                <div class="form_item">
                    <textarea style="width:100%; height:190px;" class="form_input" type="text" name="notes"><?=$notes?></textarea>
                </div>
                <div class="form_item col-md-1">
                    <button type="submit">Save</button>
                </div>

            </form>
        </div>-->


    </div>
</div>


<link href="<?=base_url("assets/css/table_styles.css")?>" rel="stylesheet" type="text/css"/>
<link href="<?=base_url("assets/css/timetable_styles.css")?>" rel="stylesheet" type="text/css"/>

<div class="column col-md-12">

    <div><h1 style="text-align:center;">Today's Time Table</h1></div>

    <table style="margin:50px;" class="custom_table time_table col-md-12 mx-auto">
        <tr class="header">
            <td rowspan="2" style="width:500px;">Time</td>
            <td colspan="2">Year 1</td>
            <td colspan="2">Year 2</td>
            <td colspan="2">Year 3</td>
            <td colspan="2">Year 4</td>
        </tr>
        <tr class="header">
            <td>CS</td>
            <td>IS</td>
            <td>CS</td>
            <td>IS</td>
            <td>CS</td>
            <td>IS</td>
            <td>CS</td>
            <td>IS</td>
        </tr>

        <?php for($i = 8; $i <=17; $i++): ?>
        <tr>
            <td style="width:800px;"><?= $i.":00 - ".($i+1).":00" ?></td>
            <?php foreach($groups as $key => $value): ?>
                <td>
                    <?php foreach($lectures[$key][$i] as $item): ?>
                    <div style="margin-top:10px; margin-bottom:10px;">
                        <div><?=$item["subject"]->getCode()?></div>
                        <div style="font-size:12px;">
                            <?php
                            $group_id = $item['group']->getGroupId();
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
                        </div>
                        <?php endforeach ?>
                </td>
            <?php endforeach?>
            <?php endfor?>
        </tr>
    </table>
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

