<div class="column time_table_container mx-auto col-md-12" style="text-align:center;">

    <h2>Time Slots for <?=$venue->getName()?></h2>

    <link href="<?=base_url("assets/css/table_styles.css")?>" rel="stylesheet" type="text/css"></link>
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
                    <td<?php if($booked[$date][$i]):?> class="booked" <?php else:?> class="selectable"<?php endif ?>></td>
                <?php endforeach ?>
            </tr>
        <?php endfor?>
    </table>

</div>

<div id="book" class="fab" onclick="$('#add_modal').modal('show')">BOOK</div>

<style>
    #book{
        position:fixed;
        right:30px;
        bottom:20px;
        background-color:red;
        padding:20px;
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

<link href="<?=base_url("assets/css/timetable_styles.css")?>" rel="stylesheet" type="text/css"/>
