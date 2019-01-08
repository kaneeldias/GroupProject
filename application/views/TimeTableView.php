
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

<div id="table_p"  class="column time_table_container mx-auto col-md-12" style="text-align:center;">

    <h2 style="margin-bottom:20px;">Viewing Time Table for <?php if(isset($group)) echo $group->getName()?> Semester <?php if(isset($semester)) echo $semester?></h2>

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

</div>

<?php if($this->session->userdata('type') == 'admin'):?>
<div id="add_lecture" class="fab" onclick="getAdd()"> +
    <style>
        .fab{
            display:none;
            font-size:50px;
            font-weight:bold;
            color:white;
            text-align:center;
            line-height:70px;
            vertical-align:middle;
            border-radius:300px;
            width:70px;
            height:70px;
            position:fixed;
            margin:30px;
            bottom:0px;
            right:0px;
            background-color: #208a4c;
            cursor:pointer;
            transition:all 0.2s;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        }

        .fab:hover{
            background-color: #269f58   ;
        }
    </style>
</div>


<div id="add_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border:none; background:none;">
            <div>
                <?php $this->load->view("forms/addLectureSimple", $formData)?>
            </div>
        </div>
    </div>
</div>

<script>

    function selectableClick(element){

        /*$("#day_input").val($(element).attr("day"));
        $("#start_time_input").val($(element).attr("start_time"));
        $("#end_time_input").val($(element).attr("end_time"));*/
        $("#add_lecture").show(200);
        $(element).removeClass("selectable").addClass("selected");
        $(element).unbind( "click" );
        $(element).click(function(){
            selectedClick(element);
        })
    }

    function selectedClick(element){
        $(element).removeClass("selected").addClass("selectable");
        $(element).unbind( "click" );
        $("#add_lecture").hide(200);
        $(element).click(function(){
            selectableClick(element);
        })
    }


    $(".selected").click(function(){
        selectedClick(this);
    });



    $(".selectable").click(function(){
        selectableClick(this);
    });

    function getAdd(){
        var days = [];
        var start_times = [];
        var end_times = [];
        $( ".selected" ).each(function(index){
            days.push($(this).attr("day"));
            start_times.push($(this).attr("start_time"));
            end_times.push($(this).attr("end_time"));
        });
        $("#day_input").val(days.toString());
        $("#start_time_input").val(start_times.toString());
        $("#end_time_input").val(end_times.toString());
        $("#add_modal").modal("show");
    }
</script>

<?php if(isset($_GET['success']) && $_GET['success'] == true):?>
    <div id="successModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Success</h4>
                </div>
                <div class="modal-body">
                    <p>L</p>
                </div>
                <div class="modal-footer">
                    <button type="button"  data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <script>
        $('#successModal').modal('show');
    </script>
<?php endif ?>

<?php if($this->session->flashdata('success') === true):?>
        <div id="successModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Success</h4>
                    </div>
                    <div class="modal-body">
                        <p><?=$this->session->flashdata('message')?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button"  data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <script>
            $('#successModal').modal('show');
        </script>
<?php endif ?>



    <?php if($this->session->flashdata('success') === false):?>
        <div id="successModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Error</h4>
                    </div>
                    <div class="modal-body">
                        <p><?=$this->session->flashdata('message')?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button"  data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <script>
            $('#successModal').modal('show');
        </script>
    <?php endif ?>


    <?php if(isset($_GET['error']) && $_GET['error'] == true):?>
    <div id="errorModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Error</h4>
                </div>
                <div class="modal-body">
                    <p>There was an error in your form. Please try again.</p>
                </div>
                <div class="modal-footer">
                    <button type="button"  data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <script>
        $('#errorModal').modal('show');
    </script>
<?php endif ?>
<?php endif?>


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
                if(canvas.height*277/canvas.width > 190){
                    pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 10, 10, canvas.width*190/canvas.height, 190);
                }
                else{
                    pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 10, 10, 277, canvas.height*277/canvas.width);
                }
                pdf.save(filename);
            });
    }

</script>