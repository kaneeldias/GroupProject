$("#editLecturerForm").validate({
    rules:{
        id:{
            required: true,
            minlength:2,
            remote:{
                url: "http://127.0.0.1/GroupProject/validate/edit-lecturer-id-exists",
                data: {staff_id: $("#id_field").val()}
            }
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
