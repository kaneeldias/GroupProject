$("#editStudentGroup").validate({
    rules:{
        groupname:{
            required: true,
            remote:{
                url: "http://127.0.0.1/GroupProject/validate/edit-group-name-exists",
                data: {group_id: $("#id_field").val()}
            }
        },
        degree_id:{
            required: true
        },
        year:{
            required: true

        },
        parentgroup:{
            required:true
        }
    },
    messages:{
        groupname:{
            required:"Enter Group Name",
            remote:"group name already exists"
        },
        degreeid:{
            required:"Enter Degree ID"
        },
        year:{
            required:"Enter year"
        },
        parentgroup:{
            required:"Enter parentgroup"
        }
    }
});
