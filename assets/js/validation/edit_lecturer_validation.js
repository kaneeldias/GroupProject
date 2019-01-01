$("#editLecturerForm").validate({
    rules:{
        id:{
            required: true,
            minlength:5
            //remote: "<?=base_url('validate/id-exists')?>"
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
