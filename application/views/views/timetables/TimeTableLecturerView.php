<div class="row">
    <div class="col-md-11"></div>
    <div class="btn col-md-1" onclick="print()">
        <i class="fa fa-print" aria-hidden="true"></i>
        <style>
            .btn{
                background-color:#062c33;
                color:white;
                font-weight:bold;
                font-size:20px;
                padding:10px;
                padding-left:20px;
                padding-right:20px;
                cursor:pointer;
                transition:all 0.2s;
            }

            .btn:hover{
                background-color: #0a4d59;
            }
        </style>

    </div>
</div>


<div  id="table_p" class="column time_table_container mx-auto col-md-12" style="text-align:center;">

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
                        <?php foreach($lectures[$j][$i] as $item): ?>
                        <div style="margin-top:5px; margin-bottom:5px;">
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
                            </div>
                            <?php endforeach ?>





                            
                    </td>
                <?php endfor?>
            </tr>
        <?php endfor?>
    </table>

</div>

<script src="<?=base_url("assets/libraries/html2canvas.min.js")?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
<script>
    function print(){
        const filename = "pdf.pdf";

        html2canvas(document.getElementById("table_p"), {
            allowTaint:true,
            useCORS: true
        })
            .then(function(canvas) {
                //document.body.appendChild(canvas);
                let pdf = new jsPDF('l', 'mm', 'a4');
                pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 10, 10, 277, 190);
                pdf.save(filename);
            });
    }

</script>