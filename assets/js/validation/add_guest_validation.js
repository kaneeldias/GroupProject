$("#addGuest").validate({
    rules:{
        code:{
            required: true,
            remote: "http://127.0.0.1/GroupProject/validate/guest-code"
        },
        name:{
            required: true
        },
        nic:{
            required: true,
            remote: "http://127.0.0.1/GroupProject/validate/guest-nic"
        }

    },
    messages:{
        code:{
            required:"Enter code",
            remote:"Already in system"
        },
        name:{
            required:"Name is required"
        },
        nic:{
            required:"Enter valid NIC",
        }
    }
});
