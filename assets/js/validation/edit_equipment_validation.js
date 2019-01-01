$("#editEquipmentForm").validate({
    rules:{
        code:{
            required: true,
            //remote: "<?=base_url('validate/code-exists')?>"
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
