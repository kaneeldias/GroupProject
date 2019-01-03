<div class="row">
    <div class="col-md-6 mx-auto form_container">

        <div class="form_title">Edit Subject</div>

        <form id="editSubjectForm" class="column form_content" method="POST" action="<?=base_url("subjects/edit/process?id=$id")?>">

            <input type="hidden" id="id_field" value="<?=$id?>"/>

            <div class="row col-md-12">
                <div class="form_item col-md-4">
                    <span class="form_label">Subject Code</span>
                    <input class="form_input" type="text" placeholder="Code" name="code" value="<?=$subject->getCode()?>"/>
                </div>

                <div class="form_item col-md-8">
                    <span class="form_label">Subject Name</span>
                    <input  class="form_input" type="text" placeholder="Name" name="name" value="<?=$subject->getName()?>"/>
                </div class="form_item">
            </div>

            <div class="row col-md-12">
                    <div class="form_item col-md-4">
                        <span class="form_label">Degree</span>
                        <select class="form_input" name="degree">
                            <option value="" disabled>Type</option>
                            <option value="1" <?php if($subject->getDegreeId() == "1") echo "selected"?>>Bsc in Computer Science</option>
                            <option value="2" <?php if($subject->getDegreeId() == "2") echo "selected"?>>BSc in Information Systems</option>
                            <option value="3" <?php if($subject->getDegreeId() == "3") echo "selected"?>>BSc in Software Engineering</option>
                        </select>
                    </div>

                    <div class="form_item col-md-4">
                        <span class="form_label">Year</span>
                        <select class="form_input" name="year">
                            <option value="" disabled>Type</option>
                            <option value="1" <?php if($subject->getYear() == "1") echo "selected"?>>1st Year</option>
                            <option value="2" <?php if($subject->getYear() == "2") echo "selected"?>>2nd Year</option>
                            <option value="3" <?php if($subject->getYear() == "3") echo "selected"?>>3rd Year</option>
                            <option value="4" <?php if($subject->getYear() == "4") echo "selected"?>>4th Year</option>
                        </select>
                    </div>

                    <div class="row col-md-4">
                        <div class="form_item">
                            <span class="form_label">Semester</span>
                            <select class="form_input" name="semester">
                                <option value="" disabled>Type</option>
                                <option value="1" <?php if($subject->getSemester() == "1") echo "selected"?>>1st Semester</option>
                                <option value="2" <?php if($subject->getSemester() == 2) echo "selected"?>>2nd Semester</option>
                            </select>
                        </div>
                    </div>
            </div>


            <div class="form_item col-md-2">
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
                    <p>Subject has been edited successfully.</p>
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

    <script src="<?=base_url('/assets/js/validation/edit_subject_validation.js')?>"></script>

    <style>
        label.error{
            color:red;
            font-size:12px;
            margin:0px;
            margin-left:5px;
        }
    </style>