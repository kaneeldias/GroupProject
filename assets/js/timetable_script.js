function selectableClick(element){
    $(element).removeClass("selectable").addClass("selected");
    $(element).unbind( "click" );
    $(element).click(function(){
        selectedClick(element);
    })
    selected_click_action();
}

function selectedClick(element){
    $(element).removeClass("selected").addClass("selectable");
    $(element).unbind( "click" );
    $(element).click(function(){
        selectableClick(element);
    })
}


$(".selected").click(function(){
    selectedClick(this);
});



$(".selectable").click(function(){
    selectableClick(this);
});
