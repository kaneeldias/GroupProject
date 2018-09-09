<div class="row">
    <div class="col-md-10 col-md-offset-1 form_container">

        <div class="form_title">Add Lecture</div>


        <form class="form_content">

            <div class="form_item col-md-4">
                <span class="form_label">Degree</span>
                <select class="form_input">
                    <option value="" disabled selected>Degree</option>
                    <option value="lecture_hall">BSc Computer Science</option>
                    <option value="lab">BSc Software Engineering</option>
                    <option value="other">BSc Information Systems</option>
                </select>
            </div>

            <div class="form_item col-md-4">
                <span class="form_label">Year</span>
                <select class="form_input">
                    <option value="" disabled selected>Year</option>
                    <option value="lecture_hall">1st Year</option>
                    <option value="lecture_hall">2nd Year</option>
                    <option value="lecture_hall">3rd Year</option>
                    <option value="lecture_hall">4th Year</option>
                </select>
            </div>

            <div class="form_item col-md-4">
                <span class="form_label">Semester</span>
                <select class="form_input">
                    <option value="" disabled selected>Semester</option>
                    <option value="lecture_hall">1st Semester</option>
                    <option value="lecture_hall">2nd Semester</option>
                </select>
            </div>

            <div class="col-md-12 filler">
                <div class="form_item col-md-6">
                    <span class="form_label">Subject</span>
                    <select class="form_input">
                        <option value="" disabled selected>Subject</option>
                        <option value="lecture_hall">SCS2101 - Programming III</option>
                        <option value="lecture_hall">SCS2102 - Data Structures and Algorithms II</option>
                    </select>
                </div>

                <div class="form_item col-md-4">
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

            <div class="col-md-12 filler">

                <div class="form_item col-md-4">
                    <span class="form_label">Student Group</span>
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


            <div class="form_item col-md-4">
            <span class="form_label">Day<span>
            <select class="form_input">
                <option value="" disabled selected>Day</option>
                <option value="lecture_hall">Monday</option>
                <option value="lecture_hall">Tuesday</option>
                <option value="lecture_hall">Wednesday</option>
                <option value="lecture_hall">Thursday</option>
                <option value="lecture_hall">Friday</option>
            </select>
            </div>

            <div class="form_item col-md-4">
                <span class="form_label">Start Time<span>
                <select class="form_input">
                    <option value="" disabled selected>Start Time</option>
                    <option value="lecture_hall">8 AM</option>
                    <option value="lecture_hall">9 AM</option>
                    <option value="lecture_hall">10 AM</option>
                    <option value="lecture_hall">11 AM</option>
                    <option value="lecture_hall">12 PM</option>
                    <option value="lecture_hall">1 PM</option>
                    <option value="lecture_hall">2 PM</option>
                    <option value="lecture_hall">3 PM</option>
                    <option value="lecture_hall">4 PM</option>
                    <option value="lecture_hall">5 PM</option>
                </select>
            </div>

            <div class="form_item col-md-4">
                <span class="form_label">End Time<span>
                <select class="form_input">
                    <option value="" disabled selected>End Time</option>
                    <option value="lecture_hall">8 AM</option>
                    <option value="lecture_hall">9 AM</option>
                    <option value="lecture_hall">10 AM</option>
                    <option value="lecture_hall">11 AM</option>
                    <option value="lecture_hall">12 PM</option>
                    <option value="lecture_hall">1 PM</option>
                    <option value="lecture_hall">2 PM</option>
                    <option value="lecture_hall">3 PM</option>
                    <option value="lecture_hall">4 PM</option>
                    <option value="lecture_hall">5 PM</option>
                </select>
            </div>

            <link href="<?=base_url("assets/libraries/lou-multi-select/css/multi-select.css")?>" media="screen" rel="stylesheet" type="text/css">

            <div class="col-md-12 filler">
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