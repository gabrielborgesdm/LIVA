import SpeechSynthesis from '../SpeechSynthesis.js';

$(document).on('click','.listenButton',function(){
    let number = $(this).parent().prev().text();
    speak(number);
});  

function speak(number){    
    let speechSynthesis = new SpeechSynthesis(number);
    speechSynthesis.speak();
}

$(document).on('click', '.videoButton', function () {
    let video = $(this).parent().prev().prev();
    video.submit();       
});