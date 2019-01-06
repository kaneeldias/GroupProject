$("#addRubricsForm").validate({
    rules:{
        code:{
            required: true,
            remote: "http://127.0.0.1/GroupProject/validate/rubrics-exists"
        },
        setter1:{
            required: true
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
        semExam:{
            required:"Select Sem.Exam Percentage"
        },
        assesment:{
            required:"Select Assesment Percentage"
        },
        moderator:{
            required:"Enter moderator"
        },
        examRubrics:{
            required:"Enter moderator"
        }
    }
});
