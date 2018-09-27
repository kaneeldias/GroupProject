<div class="row">
    <div class="col-md-6 mx-auto form_container">

        <div class="form_title">Book Hall</div>


        <form class="column form_content" method="POST" action="<?=base_url("booking/process-select")?>">

            <div class="row col-md-12">

                <div class="form_item col-md-6">
                    <span class="form_label">Hall</span>
                    <select class="form_input" name="hall">
                        <option selected disabled>Hall</option>
                        <?php foreach($halls as $hall): ?>
                            <option value="<?=$hall->getId()?>"><?=$hall->getName()?></option>
                        <?php endforeach?>
                    </select>
                </div>

                <div class="form_item col-md-6">
                    <span class="form_label">Week</span>
                    <input class="form_input" type="date" name="week">
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

