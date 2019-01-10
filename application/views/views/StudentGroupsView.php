<link href="<?=base_url("assets/css/table_styles.css")?>" rel="stylesheet" type="text/css"></link>

<div class="row control_panel col-md-12">

    <div class="control_panel_title align-text-bottom">Student Groups</div>

    <div class="flex-grow-1"></div>

    <div class="control_panel_actions">
        <a href="<?=base_url("student-groups/add")?>"><button>Add Group</button></a>
    </div>

    <style>
        .control_panel{
            background-color:#22313f;
            color:white;
            margin-bottom:20px;
            padding:20px;
            border-radius:5px;
        }

        .control_panel_title{
            font-size:25px;
            font-weight:bold;
            display: flex;
            align-items: center;
        }

        .control_panel_actions button{
            background-color:white;
            border:none;
            color:#22313f;
            padding:10px;
            font-size:20px;
            border-radius:3px;
            transition:all 0.2s;
            padding-left:20px;
            padding-right:20px;
            cursor:pointer;
        }

        .control_panel_actions button:hover{
            background-color:#DDDDDD;
            color:#22313f;
        }
    </style>
</div>


<?php if(isset($_GET['success']) && $_GET['success'] == true):?>
    <div id="successModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Success</h4>
                </div>
                <div class="modal-body">
                    <p>Student group has been added successfully.</p>
                </div>
                <div class="modal-footer">
                    <button type="button"  data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <script>
        $('#successModal').modal('show');
    </script>
<?php endif ?>

<!--Used these 2 libraries to genereta the tree structure of the student groups-->
<script src="<?=base_url("assets/libraries/treant/vendor/raphael.js")?>"></script>
<script src="<?=base_url("assets/libraries/treant/Treant.js")?>"></script>
<link rel="stylesheet" href="<?=base_url("assets/libraries/treant/Treant.css")?>">

<div class="chart" id="basic-example" style="width:100%; height:100%;"></div>


<style>
    body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,fieldset,input,textarea,p,blockquote,th,td { margin:0; padding:0; }
    table { border-collapse:collapse; border-spacing:0; }
    fieldset,img { border:0; }
    address,caption,cite,code,dfn,em,strong,th,var { font-style:normal; font-weight:normal; }
    caption,th { text-align:left; }
    h1,h2,h3,h4,h5,h6 { font-size:100%; font-weight:normal; }
    q:before,q:after { content:''; }
    abbr,acronym { border:0; }

    body { background: #fff; }
    /* optional Container STYLES */
    .chart { height: 600px; margin: 5px; width: 900px; }
    .Treant > .node {  }
    .Treant > p { font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; font-weight: bold; font-size: 12px; }
    .node-name { font-weight: bold;}

    .nodeExample1 {
        padding: 2px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        background-color: #ffffff;
        border: 1px solid #000;
        width: 200px;
        font-family: Tahoma;
        font-size: 12px;
    }

    .nodeExample1 img {
        margin-right:  10px;
    }
</style>

<style>
    #basic-example{
        padding:10px;
        border-style:solid;
        border-radius:3px;
        border-color:black;
        border-width:1px;
    }

    .node{
        padding:10px;
        border-style:solid;
        border-radius:3px;
        border-color:black;
        border-width:1px;
        max-width:120px;
    }

    .node-degree{
        font-size:12px;
    }

    .node-year, .node-delete, .node-edit{
        font-size:12px;
    }

    .node-edit{
        margin-top:10px;
        margin-right:10px;
    }

    .node-delete, .node-delete:hover{
        color:red;
    }


</style>

<script>
    var config = {
            container: "#basic-example",

            connectors: {
                type: 'step'
            },
            node: {
                HTMLclass: 'node'
            }
        },
        <?php foreach($groups as $group):?>
            //because group id is an int a variable name cant start with an int we add a character at the begining
            p<?=$group['group']->getGroupId()?> = {
                <?php if($group['parent']->getGroupId() != ""):?>
                    parent: p<?=$group['parent']->getGroupId()?>,
                <?php endif?>

            //things that should be printed inside a node
            text:{
                name:"<?=$group['group']->getName()?>",
                degree:"<?=$group['degree']->getName()?>",
                <?php if($group['group']->getYear() != ""):?>year:"Year <?=$group['group']->getYear()?>",<?php endif?>
                //edit button
                edit:{
                    val:"Edit",
                    href: "<?=base_url("student-groups/edit/?id=".$group['group']->getGroupId())?>"
                },
                //delete button
                delete:{
                    val:"Delete",
                    href: "<?=base_url("student-groups/delete/?id=".$group['group']->getGroupId())?>"
                },
        }
        },

        <?php endforeach?>

        //can't end with a comma so we add an extra node at the end
            abc = {
                text:{
                    name:""
                }
            }
    chart_config = [
        config,
        <?php foreach($groups as $group):?>
            p<?=$group['group']->getGroupId()?>,
        <?php endforeach?>
        abc
    ];
    new Treant( chart_config );
</script>

<!--<table id="StudentGroupTable" class="custom_table col-md-12">
    <tr class="header">

        <td>Name</td>
        <td>Degree</td>
        <td>Year</td>
        <td>Parent Group</td>
        <td></td>
        <td></td>
    </tr>
    <?php foreach($groups as $group):?>
        <tr>
            <td><?=$group['group']->getName()?></td>
            <td><?=$group['degree']->getName()?></td>
            <td><?=$group['group']->getYear()?></td>
            <td><?=$group['parent']->getName()?></td>
            <td><a href="<?=base_url("student-groups/edit/?id=".$group['group']->getGroupId())?>"><button class="edit_button">Edit</button></a></td>
            <td><a href="<?=base_url("student-groups/delete/?id=".$group['group']->getGroupId())?>"><button class="delete_button">Delete</button></a></td>
        </tr>
    <?php endforeach?>
</table>-->


<style>
    td{
        border-width:1px;
        border-style:solid;
        border-color:black;
        padding:10px;
    }
</style>
