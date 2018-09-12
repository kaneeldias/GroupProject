<div class="row">
    <div class="col-md-4 col-md-offset-4 form_container">

        <div class="form_title">Sign Up</div>


        <form class="form_content" method="POST" action="<?=base_url("signUp")?>">

            <div class="form_item">
                <span class="form_label">First Name</span>
                <input  class="form_input" type="fname" placeholder="First Name" name="fname"/>
            </div>

            <div class="form_item">
                <span class="form_label">Last Name</span>
                <input  class="form_input" type="lname" placeholder="Last Name" name="lname"/>
            </div>

            <div class="form_item">
                <span class="form_label">Email</span>
                <input  class="form_input" type="email" placeholder="Enter Email" name="email"/>
            </div>

            <div class="form_item">
                <span class="form_label">Password</span>
                <input  class="form_input" type="password" placeholder="Password" name="password"/>
            </div>

            <div class="form_item">
                <span class="form_label">Confirm Password</span>
                <input  class="form_input" type="cpassword" placeholder="Repeat Password" name="cpassword"/>
            </div>

            <div class="form_item">
                <button type="submit">Submit</button>
            </div>

        </form>
    </div>
</div>