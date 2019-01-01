$("#lectureHallForm").validate({
    rules:{
        code:{
            required: true,
            //remote: "<?=base_url('validate/lecture-hall-exists')?>"
        },
        name:{
            required: true
        },
        type:{
            required: true

        },
        capacity:{
            required:true
        }
    },
    messages:{
        code:{
            required:"Enter Lecture Hall code",
            remote:"Lecture Hall Code already exists"
        },
        name:{
            required:"Enter name"
        },
        type:{
            required:"Select hall type"
        },
        capacity:{
            required:"Enter capacity"
        }
    }
});
