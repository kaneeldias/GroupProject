<div class="row">
    <div class="col-md-6 mx-auto form_container">

        <div class="form_title">Add Student Group</div>


        <form class="column form_content">

            <div class="row col-md-12">
                <div class="form_item col-md-6">
                    <span class="form_label">Degree</span>
                    <select class="form_input" name="degree">
                        <option selected disabled>Degree</option>
                        <?php foreach($degrees as $degree): ?>
                            <option value="<?=$degree->getId()?>"><?=$degree->getName()?></option>
                        <?php endforeach?>
                    </select>
                </div>

                <div class="form_item col-md-6">
                    <span class="form_label">Year</span>
                    <select class="form_input">
                        <option value="" disabled selected>Year</option>
                        <option value="1">1st Year</option>
                        <option value="2">2nd Year</option>
                        <option value="3">3rd Year</option>
                        <option value="4">4th Year</option>
                    </select>
                </div>
            </div>



            <div class="row col-md-12">

                <div class="form_item col-md-4">
                    <span class="form_label">Parent Group</span>
                    <select class="form_input">
                        <option value="lecture_hall" disabled selected>None</option>
                        <?php foreach($groups as $group): ?>
                            <option value="<?=$group->getGroupId()?>"><?=$group->getName()?></option>
                        <?php endforeach?>
                    </select>
                </div>

                <div class="form_item col-md-8">
                    <span class="form_label">Group Name</span>
                    <input  class="form_input" type="text" placeholder="Group Name"/>

                </div>

            </div>

            <div class="form_item col-md-3">
                <button type="submit">Submit</button>
            </div>

        </form>
    </div>
</div>

<script src="<?=base_url("assets/libraries/lou-multi-select/js/jquery.multi-select.js")?>" type="text/javascript"></script>

<script>
    $('#my-select').multiSelect();
</script>