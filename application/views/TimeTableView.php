<div class="column time_table_container mx-auto col-md-12" style="text-align:center;">

    <h2 style="margin-bottom:20px;">Viewing Time Table for <?php if(isset($group)) echo $group->getName()?> Semester <?php if(isset($semester)) echo $semester?></h2>

    <table class="time_table col-md-10 mx-auto">
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
                <td><?= $i." to ".($i+1) ?></td>
                <?php for($j = 1; $j <= 5; $j++): ?>
                    <td class="selectable" day="<?=$j?>" start_time="<?=$i?>" end_time="<?=$i+1?>">
                        <?php
                            if(isset($lectures[$j][$i])){
                               echo $lectures[$j][$i]["subject"]->getName();
                            }
                        ?>
                    </td>
                <?php endfor?>
            </tr>
        <?php endfor?>
    </table>

</div>

<div class="fab" onclick="$('#add_modal').modal('show')">
    <style>
        .fab{
            border-radius:300px;
            width:70px;
            height:70px;
            position:fixed;
            margin:30px;
            bottom:0px;
            right:0px;
            background-color:#2e3131;
            cursor:pointer;
            transition:all 0.2s;
        }

        .fab:hover{
            background-color: #595f5f;
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

<style>
    .time_table td{
        padding:10px;
        border-style:solid;
        border-color:black;
        border-width:1px;
        width:200px;
        height:45px;
        text-align:center;
    }

    .time_table .header td{
        font-weight:bold;
        font-size:18px;
    }

    .time_table .selectable{
        transition:all 0.3s;
    }

    .time_table .selectable:hover{
        background-color:#EEEEEE;
        cursor:pointer;
    }

    .time_table .selected{
        transition:all 0.3s;
        background-color:#4daf7c;
        cursor:pointer;
    }

    .time_table .selected:hover{
        background-color: #428a60;
    }
</style>

<script>

    function selectableClick(element){

        $("#day_input").val($(element).attr("day"));
        $("#start_time_input").val($(element).attr("start_time"));
        $("#end_time_input").val($(element).attr("end_time"));
        $(element).removeClass("selectable").addClass("selected");
        $(element).unbind( "click" );
        $(element).click(function(){
            selectedClick(element);
        })
    }

    function selectedClick(element){
        $(element).removeClass("selected").addClass("selectable");
        $(element).unbind( "click" );
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
                    <p>Lecture has been added to the time table</p>
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