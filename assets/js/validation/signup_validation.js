    $("#signUpForm").validate({
        rules:{
            fname:{
                required: true,
            },
            lname:{
                required: true
            },
            email:{
                required: true,
                email:true,
                remote: "http://127.0.0.1/GroupProject/validate/email-exists"
            },
            type:{
                required:true
            },
            password:{
                required:true,
                minlength:8,
                maxlength:10,
            },
            cpassword:{
                equalTo: "#password"
            }
        },
        messages:{
            fname:{
                required:"Enter first name"
            },
            lname:{
                required:"Enter last name"
            },
            email:{
                required:"Enter email address"
            },
            type:{
                required:"Select user type"
            },
            password:{
                required:"Enter password"
            },
            cpassword:{
                equalTo: "The two passwords do not match"
            }
        }
    });
