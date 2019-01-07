$("#addSubjectForm").validate({
    rules:{
        code:{
            required: true,
            remote: "http://127.0.0.1/GroupProject/validate/subject-code-exists"
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
            required:"Enter code"
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
