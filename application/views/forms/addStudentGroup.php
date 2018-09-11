<div class="row">
    <div class="col-md-6 col-md-offset-3 form_container">

        <div class="form_title">Add Student Group</div>


        <form class="form_content">

            <div class="col-md-12 filler">
                <div class="form_item col-md-6">
                    <span class="form_label">Degree</span>
                    <select class="form_input">
                        <option value="" disabled selected>Degree</option>
                        <option value="lecture_hall">BSc Computer Science</option>
                        <option value="lab">BSc Software Engineering</option>
                        <option value="other">BSc Information Systems</option>
                    </select>
                </div>

                <div class="form_item col-md-6">
                    <span class="form_label">Year</span>
                    <select class="form_input">
                        <option value="" disabled selected>Year</option>
                        <option value="lecture_hall">1st Year</option>
                        <option value="lecture_hall">2nd Year</option>
                        <option value="lecture_hall">3rd Year</option>
                        <option value="lecture_hall">4th Year</option>
                    </select>
                </div>
            </div>



            <div class="col-md-12 filler">

                <div class="form_item col-md-4">
                    <span class="form_label">Parent Group</span>
                    <select class="form_input">
                        <option value="lecture_hall" selected>None</option>
                        <option value="lecture_hall">CS Year 1 Group 1</option>
                        <option value="lecture_hall">CS Year 1 Group 2</option>
                    </select>
                </div>

            </div>

            <div class="col-md-12 filler">

                <div class="form_item col-md-4">
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