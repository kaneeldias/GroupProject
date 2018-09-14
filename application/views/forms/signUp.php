<div class="row">
    <div class="col-md-5 mx-auto form_container">

        <div class="form_title">Sign Up</div>


        <form class="column form_content" method="POST" action="<?=base_url("signUp")?>">

            <div class="row col-md-12">
                <div class="form_item col-md-6">
                    <span class="form_label">First Name</span>
                    <input  class="form_input" type="fname" placeholder="First Name" name="fname"/>
                </div>

                <div class="form_item col-md-6">
                    <span class="form_label">Last Name</span>
                    <input  class="form_input" type="lname" placeholder="Last Name" name="lname"/>
                </div>
            </div>


            <div class="form_item col-md-12">
                <span class="form_label">Email</span>
                <input  class="form_input" type="email" placeholder="Enter Email" name="email"/>
            </div>

            <div class="row col-md-12">
                <div class="form_item col-md-6">
                    <span class="form_label">Password</span>
                    <input  class="form_input" type="password" placeholder="Password" name="password"/>
                </div>

                <div class="form_item col-md-6">
                    <span class="form_label">Confirm Password</span>
                    <input  class="form_input" type="cpassword" placeholder="Repeat Password" name="cpassword"/>
                </div>
            </div>


            <div class="form_item col-md-3">
                <button type="submit">Submit</button>
            </div>

        </form>
    </div>
</div>