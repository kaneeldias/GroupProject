<div class="time_table_container">

    <table class="time_table">
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
                <td class="selectable"></td>
                <td class="selectable"></td>
                <td class="selectable"></td>
                <td class="selectable"></td>
                <td class="selectable"></td>
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
                <?php $this->load->view("forms/addLectureSimple"); ?>
    </div>

</div>

<style>
    .time_table td{
        padding:10px;
        border-style:solid;
        border-color:black;
        border-width:1px;
        width:200px;
        height:50px;
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