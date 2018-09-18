<div class="row">
    <div class="col-md-5 mx-auto form_container">

        <div class="form_title">Sign Up</div>


        <form class="column form_content" method="POST" action="<?=base_url("signup/process")?>">

            <div class="row col-md-12">
                <div class="form_item col-md-6">
                    <span class="form_label">First Name</span>
                    <input  class="form_input" type="fname" placeholder="First Name" name="fname"/>
                </div>

                <div class="form_item col-md-6">
                    <span class="form_label">Last Name</span>
                    <input  class="form_input" type="lname" placeholder="Last Name" name="lname"/>
                </div>
            </div>


            <div class="row col-md-12">
                <div class="form_item col-md-6">
                    <span class="form_label">Email</span>
                    <input  class="form_input" type="email" placeholder="Enter Email" name="email"/>
                </div>

                <div class="form_item col-md-6">
                    <span class="form_label">Type</span>
                    <select class="form_input" name="type">
                        <option value="" disabled selected>Type</option>
                        <option value="admin">Admin</option>
                        <option value="staff">Staff</option>
                        <option value="student">Student</option>
                    </select>
                </div>
            </div>

            <div class="row col-md-12">
                <div class="form_item col-md-6">
                    <span class="form_label">Password</span>
                    <input  class="form_input" type="password" placeholder="Password" name="password"/>
                </div>

                <div class="form_item col-md-6">
                    <span class="form_label">Confirm Password</span>
                    <input  class="form_input" type="password" placeholder="Repeat Password" name="cpassword"/>
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
                    <p>User has been registered successfully.</p>
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