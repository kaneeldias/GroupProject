<div class="row">
    <div class="col-md-6 mx-auto form_container">

        <div class="form_title">Request for Equipment</div>


        <form id="equipmentRequestForm" class="column form_content" method="POST" action="<?=base_url("equipment/request/process")?>">

            <div class="row col-md-12">
                <div class="form_item col-md-8">
                    <span class="form_label">Item</span>
                    <select class="form_input" name="item">
                        <option selected disabled>Item</option>
                        <?php foreach($items as $item): ?>
                            <option value="<?=$item->getName()?>"><?=$item->getName()?></option>
                        <?php endforeach?>
                    </select>
                </div>
            </div>



            <div class="row col-md-12">

                <div class="form_item col-md-6">
                    <span class="form_label">Date</span>
                    <input class="form_input" type="date" name="date">
                </div>

                <div class="form_item col-md-3">
                    <span class="form_label">From</span>
                    <select id="from" class="form_input" name="from">
                        <option value="06">6:00</option>
                        <option value="07">7:00</option>
                        <option value="08">8:00</option>
                        <option value="09">9:00</option>
                        <option value="10">10:00</option>
                        <option value="11">11:00</option>
                        <option value="12">12:00</option>
                        <option value="13">13:00</option>
                        <option value="14">14:00</option>
                        <option value="15">15:00</option>
                        <option value="16">16:00</option>
                        <option value="17">17:00</option>
                    </select>
                </div>

                <div class="form_item col-md-3">
                    <span class="form_label">To</span>
                    <select class="form_input" name="to">
                        <option value="06">6:00</option>
                        <option value="07">7:00</option>
                        <option value="08">8:00</option>
                        <option value="09">9:00</option>
                        <option value="10">10:00</option>
                        <option value="11">11:00</option>
                        <option value="12">12:00</option>
                        <option value="13">13:00</option>
                        <option value="14">14:00</option>
                        <option value="15">15:00</option>
                        <option value="16">16:00</option>
                        <option value="17">17:00</option>
                    </select>
                </div>



            </div>

            <div class="form_item col-md-3">
                <button type="submit">Submit</button>
            </div>

        </form>
    </div>
</div>

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
                    <p>Request pending . . . .</p>
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

    <script src="<?=base_url('/assets/js/validation/equipment_requests_validation.js')?>"></script>

    <style>
        label.error{
            color:red;
            font-size:12px;
            margin:0px;
            margin-left:5px;
        }
    </style>