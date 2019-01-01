<style>
       body{
           background-image: url("<?=base_url('assests/images/register_background2.jpg')?>"); 
           background-size: cover;

       }
</style>

<div class="row">
    <div class="col-md-5 mx-auto form_container">

        <div class="form_title">Bulk User Registration</div>


        <form id="signUpBulkForm" class="column form_content" method="POST" action="<?=base_url("signup/bulk/process")?>" enctype="multipart/form-data">

            <div class="row col-md-12">
                <div class="form_item col-md-6">
                    <span><a target="_blank" href="<?=base_url("assets/files/registerUser.csv")?>">Download Template</a></span>
                </div>
            </div>

            <div class="row col-md-12">
                <div class="form_item col-md-6">
                    <span class="form_label">Upload File</span>
                    <input class="form_input" type="file" placeholder="File" name="file"  accept=".csv" style="width:500px;"/>
                </div>
            </div>

            <div class="form_item col-md-3">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>

<script src="<?=base_url('/assets/js/validation/signup_validation.js')?>"></script>

<style>
 label.error{
     color:red;
     font-size:12px;
     margin:0px;
     margin-left:5px;
 }
</style>


<?php if($this->session->flashdata('success') === false):?>
    <div id="errorModal" class="modal fade" role="dialog">
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
        $('#errorModal').modal('show');
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