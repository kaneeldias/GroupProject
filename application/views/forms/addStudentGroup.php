<div class="row">
    <div class="col-md-6 mx-auto form_container">

        <div class="form_title">Add Student Group</div>



        <form class="column form_content" method="POST" action=<?=base_url("student-group/add/process")?>">
=======

        <form class="column form_content"method="post"action="<?=base_url("student-groups/add/process")?>">



            <div class="form_item col-md-6">
                <span class="form_label">Group Name</span>
                <input  class="form_input"name="groupname" type="text" placeholder="Group Name"/>

            </div>


            <div class="row col-md-12">

                <div class="form_item col-md-4">
                    <span class="form_label">Degree</span>
                    <select class="form_input" name="degree_id">
                        <option selected disabled>Degree</option>
                        <?php foreach($degrees as $degree): ?>
                            <option value="<?=$degree->getId()?>"><?=$degree->getName()?></option>
                        <?php endforeach?>
                    </select>
                </div>

                <div class="form_item col-md-4">
                    <span class="form_label">Year</span>

                    <select class="form_input" name="year">
                        <option selected disabled>Year</option>
                        <option value="1">1st Year</option>
                        <option value="2">2nd Year</option>
                        <option value="3">3rd Year</option>
                        <option value="4">4th Year</option>
                    </select>
                </div>

                <div class="form_item col-md-4">
                    <span class="form_label">Parent Group</span>
                    <select class="form_input"name="parentgroup">
                        <option value="lecture_hall" disabled selected>None</option>
                        <?php foreach($groups as $group): ?>
                            <option value="<?=$group->getGroupId()?>"><?=$group->getName()?></option>
                        <?php endforeach?>
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
