<div class="row">
    <div class="col-md-6 mx-auto form_container">

        <div class="form_title">Select Time Table</div>


        <form class="column form_content" method="POST" action="<?=base_url("generate-time-table")?>">



        <div class="row col-md-12">

            <div class="form_item col-md-4">
                <span class="form_label">Student Group</span>
                <select class="form_input" name="studentGroup">
                    <option value="" disabled>Group</option>
                    <?php foreach($groups as $group): ?>
                        <option value="<?=$group->getGroupID()?>"><?= $group->getName()?></option>
                    <?php endforeach ?>
                </select>
            </div>


            <div class="form_item col-md-4">
                <span class="form_label">Semester</span>
                <select class="form_input" name="semester">
                    <option value="" disabled>Type</option>
                    <option value="1"  > 1st Semester</option>
                    <option value="2"  > 2nd Semester</option>
                </select>
            </div>

        </div>

        <div class="form_item col-md-3">
            <button type="submit">Submit</button>
        </div>

        </form>
    </div>
</div>
