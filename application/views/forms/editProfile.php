<div class="row">
    <div class="col-md-6 mx-auto form_container">

        <div class="form_title">
            <div>Edit Profile</div>
        </div>

        <form class="column form_content" method="POST" action="<?=base_url("profile/edit/process")?>">

            <div class="row">
                <div class="form_item col-md-6">
                    <span class="form_label">First Name<span>
                    <input type="text" class="form_input" name="first_name" value="<?=$Details->getFname();?>"/>
                </div>

                <div class="form_item col-md-6">
                    <span class="form_label">Last Name<span>
                    <input type="text" class="form_input" name="last_name" value="<?=$Details->getLname();?>"/>
                </div>
            </div>

            <div class="row">
                <div class="form_item col-md-6">
                    <span class="form_label">Email Address<span>
                    <input type="email" class="form_input" name="email" value="<?=$Details->getEmail();?>"/>
                </div>

                <div class="form_item col-md-6">
                    <span class="form_label">Contact No.<span>
                    <input type="text" class="form_input" name="contact" value="<?=$Details->getTp();?>"/>
                </div>
            </div>

            <?php if($this->session->userdata("type") == "staff"):?>
            <div class="row">
                <div class="form_item col-md-6">
                    <span class="form_label">Time Table Profile<span>
                     <select class="form_input" id="lecturer" name="lecturer">

                         <?php if($timetable_id == -1):?>
                             <option selected disabled>Select Yourself</option>
                         <?php endif?>

                         <?php foreach($lecturers as $lecturer):?>
                             <option <?php if($lecturer->getId() == $timetable_id) echo "selected"?> value="<?=$lecturer->getId()?>"><?=$lecturer->getName()?></option>
                         <?php endforeach ?>
                     </select>
                </div>
            </div>
            <?php endif?>

            <?php if($this->session->userdata("type") == "student"):?>
                <div class="row">
                    <div class="form_item col-md-6">
                    <span class="form_label">Time Table Profile<span>
                     <select class="form_input" id="grpup" name="group">

                         <?php if($timetable_id == -1):?>
                         <option selected disabled>Select Student Group</option>
                         <?php endif?>


                         <?php foreach($groups as $group):?>
                             <option <?php if($group->getGroupId() == $timetable_id) echo "selected"?> value="<?=$group->getGroupId()?>"><?=$group->getName()?></option>
                         <?php endforeach ?>
                     </select>
                    </div>
                </div>
            <?php endif?>


            <div class="row">
                <div class="form_item col-md-3">
                    <button type="submit">Submit</button>
                </div>
            </div>


        </form>
    </div>
</div>
