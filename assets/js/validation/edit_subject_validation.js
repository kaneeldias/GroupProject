$("#editSubjectForm").validate({
    rules:{
        code:{
            required: true,
            remote:{
                url: "http://127.0.0.1/GroupProject/validate/edit-subject-code-exists",
                data: {subject_id: $("#id_field").val()}
            }
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
