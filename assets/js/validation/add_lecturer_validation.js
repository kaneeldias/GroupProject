$("#addLecturerForm").validate({
    rules:{
        id:{
            required: true,
            minlength:5,
            remote: "http://127.0.0.1/GroupProject/validate/lecturer-id-exists"
        },
        name:{
            required: true
        },
        shortform:{
            required: true,
            minlength:2
        }
    },
    messages:{
        id:{
            required:"Enter your id",
            minlength:"Enter a valid id",
            remote:"Id already exists"
        },
        name:{
            required:"Enter your name"
        },
        shortform:{
            required:"Enter a shortform",
            minlength:"Enter a valid id",
        }
    }
});
