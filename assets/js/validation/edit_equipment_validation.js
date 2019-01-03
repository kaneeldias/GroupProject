$("#editEquipmentForm").validate({
    rules:{
        code:{
            required: true,
            remote: {
                url:"http://127.0.0.1/GroupProject/validate/edit-code-exists",
                data: {eq_id:$("#id_field").val()}
            }
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
            remote:"Enter a valid Subject Code"
        },
        name:{
            required:"Enter name"
        },
        info:{
            required:"Enter degree"
        }
    }
});
