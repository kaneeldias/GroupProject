<div class="row">
      <div class="col-md-6 mx-auto form_container">

          <div class="form_title">Edit Student Group</div>

          <form id="editStudentGroup" class="column form_content" method="POST" action="<?=base_url("student-groups/edit/process?id=$id")?>">



                  <div class="form_item col-md-8">
                      <span class="form_label">Group Name</span>
                      <input  class="form_input" type="text" placeholder="Group Name" name="groupname" value="<?=$group->getName()?>"/>
                  </div class="form_item">


                <div class="row col-md-12">

                    <div class="form_item col-md-4">
                        <span class="form_label">Degree</span>
                        <select class="form_input" name="degree_id">
                            <option value="" disabled>Type</option>
                            <option value="1" <?php if($group->getDegreeId() == "1") echo "selected"?>>Bsc in Computer Science</option>
                            <option value="2" <?php if($group->getDegreeId() == "2") echo "selected"?>>BSc in Information Systems</option>
                            <option value="3" <?php if($group->getDegreeId() == "3") echo "selected"?>>BSc in Software Engineering</option>
                        </select>
                    </div>

                                       <div class="form_item col-md-4">
                        <span class="form_label">Year</span>
                        <select class="form_input" name="year">
                            <option value="" disabled>Type</option>
                            <option value="1" <?php if($group->getYear() == "1") echo "selected"?>>1st Year</option>
                            <option value="2" <?php if($group->getYear() == "2") echo "selected"?>>2nd Year</option>
                            <option value="3" <?php if($group->getYear() == "3") echo "selected"?>>3rd Year</option>
                            <option value="4" <?php if($group->getYear() == "4") echo "selected"?>>4th Year</option>
                        </select>
                    </div>

                    <div class="form_item col-md-10">
                        <span class="form_label">Parent Group</span>
                        <select class="form_input" name="parentgroup">
                            <option value="" disabled>Group</option>
                            <?php foreach($groups as $group): ?>
                                <option value="<?=$group->getGroupID()?>"><?= $group->getName()?></option>
                            <?php endforeach ?>
                        </select>
                    </div>




                </div>
              <div class="form_item col-md-2">
                  <button type="submit">Submit</button>
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
                    <p>Lecture Hall has been edited successfully.</p>
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


    <script src="<?=base_url('/assets/js/validation/edit_student_group_validation.js')?>"></script>

    <style>
        label.error{
            color:red;
            font-size:12px;
            margin:0px;
            margin-left:5px;
        }
    </style>
