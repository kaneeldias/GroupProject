<table>
    <tr>
        <td>Code</td>
        <td>Name</td>
        <td>Degree</td>
        <td>Year</td>
        <td>Semester</td>
    </tr>
    <?php foreach($subjects as $subject):?>
        <tr>
            <td><?=$subject->getCode()?></td>
            <td><?=$subject->getName()?></td>
            <td><?=$subject->getDegreeId()?></td>
            <td><?=$subject->getYear()?></td>
            <td><?=$subject->getSemester()?></td>
        </tr>
    <?php endforeach?>
</table>


<style>
    td{
        border-width:1px;
        border-style:solid;
        border-color:black;
        padding:10px;
    }
</style>