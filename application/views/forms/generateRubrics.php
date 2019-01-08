<div class="row">
    <div class="col-md-6 mx-auto form_container">

        <div class="form_title">Generate Rubrics</div>


        <form id="generateRubricsForm" class="column form_content" method="POST" action="<?=base_url("rubrics/generate/process")?>">

            <div class="row col-md-12">

                <div class="form_item col-md-5">
                    <span class="form_label">Degree</span>
                    <select class="form_input" name="degree">
                        <option selected disabled></option>
                        <?php foreach($degrees as $degree): ?>
                            <option value="<?=$degree->getId()?>"><?=$degree->getName()?></option>
                        <?php endforeach?>
                    </select>
                </div>

                <div class="form_item col-md-2">
                </div>


                <div class="form_item col-md-5">
                    <span class="form_label">Year</span>
                    <select class="form_input" name="year">
                        <option selected disabled></option>
                        <option value="1">Year 1</option>
                        <option value="2">Year 2</option>
                        <option value="3">Year 3</option>
                        <option value="4">Year 4</option>

                    </select>
                </div>

            </div>

            <div class="row col-md-12">
                <div class="form_item col-md-5">
                    <span class="form_label">Semester</span>
                    <select class="form_input" name="semester">
                        <option selected disabled></option>
                        <option value="1">Semester 1</option>
                        <option value="2">Semester 2</option>
                    </select>
                </div>

            </div>

            <div class="row col-md-12">
                <div class="form_item col-md-3">
                    <button type="submit">Submit</button>
                </div>
            </div>

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

<script src="<?=base_url('/assets/js/validation/add_rubrics_validation.js')?>"></script>

<style>
    label.error{
        color:red;
        font-size:12px;
        margin:0px;
        margin-left:5px;
    }
</style>

