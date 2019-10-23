var leftPos, scrollingSize;


$(document).on('click', '#buttonLeft', function (event) {
    scroll("left");
});

$(document).on('click', '#buttonRight', function (event) {
   scroll("right");
});

function showCards(arrayCards){
    $("#cards").html(arrayCards);
    $(".loading").addClass('d-none');
    showArrows();
    checkIfPossibleToScroll(0);
    addBorder(); 

}

function showArrows(){
    var cardsLenght = $("#cards").find(".card").length ;
    if(cardsLenght > 1){  
        $(".cardArrows").removeClass("d-none");
    }
    
}

function addBorder(){
    var cardsLenght = $("#cards").find(".card").length ;
    if(cardsLenght > 1){  
        $("#cards").addClass("border rounded shadow");
    }   
}

function scroll(direction){
    leftPos = $('#cards').scrollLeft();
    scrollingSize = $('.card').width() + 42;

    if(direction == "right"){
        checkIfPossibleToScroll(leftPos + scrollingSize) ;
        $("#cards").animate({scrollLeft: leftPos + scrollingSize}, 800);
    } else{
        checkIfPossibleToScroll(leftPos - scrollingSize) ;
        $("#cards").animate({scrollLeft: leftPos - scrollingSize}, 800);
    }
    
}

function checkIfPossibleToScroll(leftPos){
    let element = document.getElementById("cards");
    let maxScrollLeft = element.scrollWidth - element.clientWidth;
    
    checkLeftArrow(leftPos);
    checkRightArrow(leftPos, maxScrollLeft);
}

function checkLeftArrow(leftPos){
    if(leftPos > 0){
        enableArrow("left");
    } else{
        disableArrow("left");
    }
}

function checkRightArrow(leftPos, maxScrollLeft){
    if(leftPos < maxScrollLeft){
        
        enableArrow("right");
    } else{
        disableArrow("right");
    }
}

function disableArrow(arrowSide){
    if(arrowSide == "left"){
        $("#buttonLeft i").addClass("arrowDisabled");
    } else{
        $("#buttonRight i").addClass("arrowDisabled");
    }
} 

function enableArrow(arrowSide){
    if(arrowSide == "left"){
        $("#buttonLeft i").removeClass("arrowDisabled");
    } else{
        $("#buttonRight i").removeClass("arrowDisabled");
    }
} 
