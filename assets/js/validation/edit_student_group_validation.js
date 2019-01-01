$("#editStudentGroup").validate({
    rules:{
        groupname:{
            required: true,
            //remote: "<?=base_url('validate/group-name-exists')?>"
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
