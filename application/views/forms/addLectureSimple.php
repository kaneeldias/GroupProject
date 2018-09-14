<div class="row">
    <div class="col-md-10 mx-auto form_container">

        <div class="form_title">
            <div>Add Lecture</div>
            <div style="font-size:18px;">to BSc in Computer Science Year 1 Semester 2</div>
        </div>


        <form class="column form_content">

            <div class="row col-md-12">
                <div class="form_item col-md-6">
                    <span class="form_label">Subject</span>
                    <select class="form_input">
                        <option value="" disabled selected>Subject</option>
                        <option value="lecture_hall">SCS2101 - Programming III</option>
                        <option value="lecture_hall">SCS2102 - Data Structures and Algorithms II</option>
                    </select>
                </div>

                <div class="form_item col-md-6">
                    <span class="form_label">Type</span>
                    <select class="form_input">
                        <option value="" disabled selected>Type</option>
                        <option value="lecture_hall">Lecture</option>
                        <option value="lecture_hall">Lab Practical</option>
                        <option value="lecture_hall">Tutorial</option>
                        <option value="lecture_hall">Other</option>
                    </select>
                </div>
            </div>

            <div class="row col-md-12">

                <div class="form_item col-md-4">
                    <span class="form_label" style="margin-bottom:0px;">Student Group</span>
                    <select class="form_input">
                        <option value="" disabled selected>Student Group</option>
                        <option value="lecture_hall">CS Year 1 Group 1</option>
                        <option value="lecture_hall">CS Year 1 Group 2</option>
                    </select>
                </div>

                <div class="form_item col-md-4">
                    <span class="form_label">Venue<span>
                    <select class="form_input">
                        <option value="" disabled selected>Venue</option>
                        <option value="lecture_hall">W002</option>
                        <option value="lecture_hall">S104</option>
                    </select>
                </div>
            </div>

            <link href="<?=base_url("assets/libraries/lou-multi-select/css/multi-select.css")?>" media="screen" rel="stylesheet" type="text/css">

            <div class="row col-md-12">
                <div class="form_item col-md-4">
                <span class="form_label">Staff<span>
                <select multiple="multiple" id="my-select" name="staff[]">
                    <option value="lecture_hall">Supun Dissanayake</option>
                    <option value="lecture_hall">Tharindu Wijethilake</option>
                    <option value="lecture_hall">Tharindud Wijethilake</option>
                </select>
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