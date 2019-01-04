$("#editRubricsForm").validate({
    rules:{
        code:{
            required: true,
            remote:{
                url: "http://127.0.0.1/GroupProject/validate/edit-rubrics-exists",
                data: {rubric_id: $("#id_field").val()}
            }
        },
        setter1:{
            required: true
        },
        setter2:{
            required: true,
        },
        semExam:{
            required:true
        },
        assesment:{
            required:true,
        },
        moderator:{
            required:true,
        },
        examRubrics:{
            required:true,
        }

    },
    messages:{
        code:{
            required:"Select a Coursee",
            remote:"Selected subject already exists"
        },
        setter1:{
            required:"Select Setter1"
        },
        setter2:{
            required:"Select Setter2"
        },
        semExam:{
            required:"Select Sem.Exam Percentage"
        },
        assesment:{
            required:"Select Assesment Percentage"
        },
        moderator:{
            required:"Enter Moderator"
        },
        examRubrics:{
            required:"Enter Rubrics"
        }
    }
});
