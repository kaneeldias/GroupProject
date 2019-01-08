$("#addEquipmentForm").validate({
    rules:{
        code:{
            required: true,
            remote: "http://127.0.0.1/GroupProject/validate/code-exists"
        },
        name:{
            required: true
        },
        info:{
            required: true,
        }

    },
    messages:{
        code:{
            required:"Enter code",
            remote:"Enter a valid Equipment Code"
        },
        name:{
            required:"Choose a type"
        },
        info:{
            required:"Enter description"
        }
    }
});
