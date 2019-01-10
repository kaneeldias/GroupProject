<div class="row">
      <div class="col-md-6 mx-auto form_container">

          <div class="form_title">Add Guest</div>

          <form id="lectureHallForm" class="column form_content" method="POST" action="<?=base_url("guestLecturers/add/process")?>">

              <div class="row col-md-12">
                  <div class="form_item col-md-4">
                      <span class="form_label">Code</span>
                      <input class="form_input" type="text" placeholder="Code" name="code"/>
                  </div>

                  <div class="form_item col-md-8">
                      <span class="form_label">Name</span>
                      <input  class="form_input" type="text" placeholder="Name" name="name"/>
                  </div class="form_item">
              </div>

                <div class="row col-md-12">
                    <div class="form_item col-md-6">
                        <span class="form_label">Subject</span>
                        <select class="form_input" name="subject">
                            <?php foreach($subjects as $s):?>
                                <option value="<?=$s->getId()?>"><?= $s->getName(); ?></option>
                            <?php endforeach ?>
                            <option value="" disabled selected>Type</option>
                            <option value="lecture_hall">Lecture Hall</option>
                            <option value="lab">Lab</option>
                            <option value="other">Other</option>
                        </select>
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
                    <p>Lecture Hall has been added successfully.</p>
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

    <!--<script src="<?=base_url('/assets/js/validation/add_lecture_hall_validation.js')?>"></script>-->

    <style>
        label.error{
            color:red;
            font-size:12px;
            margin:0px;
            margin-left:5px;
        }
    </style>
