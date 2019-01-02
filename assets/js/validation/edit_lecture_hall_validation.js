$("#editLectureHallForm").validate({
    rules:{
        code:{
            required: true,
            remote:{
                url: "http://127.0.0.1/GroupProject/validate/edit-hall-code-exists",
                data: {hall_id: $("#id_field").val()}
            }
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
