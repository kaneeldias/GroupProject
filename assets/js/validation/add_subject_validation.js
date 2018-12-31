$("#addSubjectForm").validate({
    rules:{
        code:{
            required: true,
            remote: "<?=base_url('validate/code-exists')?>"
        },
        name:{
            required: true
        },
        degree:{
            required: true,
        },
        year:{
            required:true
        },
        semester:{
            required:true,
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
        degree:{
            required:"Enter degree"
        },
        year:{
            required:"Select year"
        },
        semester:{
            required:"Enter semester"
        }
    }
});
