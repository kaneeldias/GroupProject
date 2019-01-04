<link href="<?=base_url("assets/css/table_styles.css")?>" rel="stylesheet" type="text/css"></link>

<div class="row control_panel col-md-12">

    <div class="control_panel_title align-text-bottom">Bookings</div>

    <div class="flex-grow-1"></div>

    <div class="control_panel_actions">
        <a href="<?=base_url("booking/make")?>"><button>Create Booking</button></a>
    </div>

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
<table id="SubjectsTable" class="custom_table col-md-12">
    <tr class="header">
        <td>Date</td>
        <td>Venue</td>
        <td>Start Time</td>
        <td>End Time</td>
        <td>Requested By</td>
        <td>Reason</td>
        <td>Approved By</td>
        <td></td>
    </tr>
    <?php foreach($bookings as $a):?>
        <tr>
            <td><?=$a->getDate()?></td>
            <td><?=$a->getVenue()->getName()?></td>
            <td><?=$a->getStartTime()?>:00</td>
            <td><?=$a->getEndTime()?>:00</td>
            <td><?=$a->getRequest()?></td>
            <td><?=$a->getReason()?></td>
            <td><?=$a->getApproved()->getName()?></td>
            <td><a href="<?=base_url("booking/delete/?id=".$a->getId())?>"><button class="delete_button">Delete</button></a></td>
        </tr>
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

<?php if(isset($_GET['success']) && $_GET['success'] == true):?>
    <div id="successModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Success</h4>
                </div>
                <div class="modal-body">
                    <p>Subject has been added successfully.</p>
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