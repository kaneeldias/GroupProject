$("#addGuestLecturerForm").validate({
    rules:{
        id:{
            required: true,
        },
        nic:{
            required: true,
            remote: "http://127.0.0.1/GroupProject/validate/valid-nic"
        },
        code:{
            required: true,
        },
        name:{
            required:true
        },
        subject:{
            required:true,
        }

    },
    messages:{
        id:{
            required:"Enter code"
        },
        nic:{
            required:"Enter name"
        },
        code:{
            required:"Enter degree"
        },
        name:{
            required:"Select year"
        },
        subject:{
            required:"Enter semester"
        }
    }
});
