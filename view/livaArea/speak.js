import SpeechSynthesis from '../SpeechSynthesis.js';

var phrase = "";
var timeoutId = 0;

$("#speak").on("click", function(){
	speak(phrase);
});

$(".character").on("click", function(){
	write($(this).attr('alt'));
});

$('#erase').on('click', function(){
	erase();
});



$('#erase').on('mousedown', function() {
    timeoutId = setTimeout(eraseAll, 1000);
}).on('mouseup mouseleave', function() {
    clearTimeout(timeoutId);
});

$('.yesOrNo').on('click', function () {
	let yesOrNo = $(this).attr('alt');
	console.log(yesOrNo);
	let audio;
	if(yesOrNo == "Sim"){
		audio = new Audio('../assets/multimedia/sounds/speak/sim.wav');
	}else{
		audio = new Audio('../assets/multimedia/sounds/speak/nao.wav');

	}
	audio.play();
});



function speak(phrase) {
	let speechSynthesis = new SpeechSynthesis(phrase);
	speechSynthesis.speak();

}

function write(character){
     phrase += character;
     document.getElementById("label").innerHTML += character;
}

function erase(){
	phrase = phrase.slice(0,phrase.length - 1);
	document.getElementById("label").innerHTML = phrase;
}
function eraseAll(){
	phrase = "";
	document.getElementById("label").innerHTML = "";
}

