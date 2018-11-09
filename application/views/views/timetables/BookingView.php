<div class="column time_table_container mx-auto col-md-12" style="text-align:center;">

    <h2>Time Slots for <?=$venue->getName()?></h2>

    <link href="<?=base_url("assets/css/table_styles.css")?>" rel="stylesheet" type="text/css"></link>
    <link href="<?=base_url("assets/css/form_styles.css")?>" rel="stylesheet" type="text/css"></link>
    <link href="<?=base_url("assets/css/timetable_styles.css")?>" rel="stylesheet" type="text/css"></link>

    <table class="custom_table time_table col-md-12 mx-auto">
        <tr class="header">
            <td>Time</td>
            <?php foreach($dates as $date):?>
                <td><?=$date?></td>
            <?php endforeach ?>
        </tr>
        <?php for($i = 8; $i <=17; $i++): ?>
            <tr>
                <td><?=$i?>:00 to <?=($i+1)?>:00</td>
                <?php foreach($dates as $date):?>
                    <td date="<?=$date?>" start_time="<?=$i?>" end_time="<?=$i+1?>" <?php if($booked[$date][$i] || $bookedBooked[$date][$i]):?> class="booked" <?php else:?> class="selectable"<?php endif ?>>
                        <?php if($booked[$date][$i]):?>Lecture<?php endif?>
                        <?php if($bookedBooked[$date][$i]):?>Booked<?php endif?>
                    </td>
                <?php endforeach ?>
            </tr>
        <?php endfor?>
    </table>

</div>

<!--<div id="book" class="fab" onclick="$('#add_modal').modal('show')">BOOK</div>-->
<button id="book" class="form_fab" onclick="getAdd()">Book</button>


<style>
    #book{
        position:fixed;
        right:30px;
        bottom:20px;
        display:none;
    }
</style>

<script>
    function selectableClick(element){

        /*$("#day_input").val($(element).attr("day"));
         $("#start_time_input").val($(element).attr("start_time"));
         $("#end_time_input").val($(element).attr("end_time"));*/
        $("#book").show(200);
        $(element).removeClass("selectable").addClass("selected");
        $(element).unbind( "click" );
        $(element).click(function(){
            selectedClick(element);
        })
    }

    function selectedClick(element){
        $(element).removeClass("selected").addClass("selectable");
        $(element).unbind( "click" );
        $("#book").hide(200);
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

<style>
    .booked{
        background-color:#e74c3c;
    }
</style>

<div id="add_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border:none; background:none;">
            <div>
                <?php $this->load->view("forms/addBooking", $formData)?>
            </div>
        </div>
    </div>
</div>

<script>
    function getAdd(){
        var dates = [];
        var start_times = [];
        var end_times = [];
        $( ".selected" ).each(function(index){
            dates.push($(this).attr("date"));
            start_times.push($(this).attr("start_time"));
            end_times.push($(this).attr("end_time"));
        });
        $("#date_input").val(dates.toString());
        $("#start_time_input").val(start_times.toString());
        $("#end_time_input").val(end_times.toString());
        $("#add_modal").modal("show");
    }
</script>


<link href="<?=base_url("assets/css/timetable_styles.css")?>" rel="stylesheet" type="text/css"/>

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


<?php if(isset($_GET['success']) && $_GET['success'] == true):?>
    <div id="successModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Success</h4>
                </div>
                <div class="modal-body">
                    <p>Booking has been made</p>
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