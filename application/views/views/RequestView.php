<link href="<?=base_url("assets/css/table_styles.css")?>" rel="stylesheet" type="text/css"></link>

<div class="row control_panel col-md-12">

    <div class="control_panel_title align-text-bottom">Requests</div>

    <div class="flex-grow-1"></div>


    <style>
        .control_panel{
            background-color:#22313f;
            color:white;
            margin-bottom:20px;
            padding:20px;
            border-radius:5px;
        }

        .control_panel_title{
            font-size:25px;
            font-weight:bold;
            display: flex;
            align-items: center;
        }

        .control_panel_actions button{
            background-color:white;
            border:none;
            color:#22313f;
            padding:10px;
            font-size:20px;
            border-radius:3px;
            transition:all 0.2s;
            padding-left:20px;
            padding-right:20px;
            cursor:pointer;
        }

        .control_panel_actions button:hover{
            background-color:#DDDDDD;
            color:#22313f;
        }
    </style>

</div>
<table id="lecturersTable" class="custom_table col-md-12">
    <tr class="header">
        <td>Date</td>
        <td>Item</td>
        <td>From</td>
        <td>To</td>
        <td>Requested By</td>
        <td>Status</td>

        <td></td>
        <td></td>
        <!--<td></td>-->
    </tr>
    <?php foreach($Items as $Item):?>
        <tr>
            <td><?=$Item->getDate()?></td>
            <td><?=$Item->getItem()?></td>
            <td><?=$Item->getFrom()?>:00</td>
            <td><?=$Item->getTo()?>:00</td>
            <td><?=$Item->getRequestedBy()->getFname()?> <?=$Item->getRequestedBy()->getLname()?></td>
            <td><?=$Item->getStatus()?></td>

            <td><?php if($Item->getStatus() != "Approved"):?><a href="<?=base_url("request/approve/?id=".$Item->getId())?>"><button class="edit_button" >Approve</button></a><?php endif?></td>
            <td><?php if($Item->getStatus() != "Rejected"):?><a href="<?=base_url("request/reject/?id=".$Item->getId())?>"><button class="delete_button" >Reject</button></a><?php endif?></td>        </tr>
    <?php endforeach?>
</table>


<style>
    td{
        border-width:1px;
        border-style:solid;
        border-color:black;
        padding:10px;
    }
</style>

<script>
    $(document).ready(function () {
        $('#lectureHallsTable').DataTable();
        //$('.dataTables_length').addClass('bs-select');
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
                    <p>Item has been added successfully.</p>
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