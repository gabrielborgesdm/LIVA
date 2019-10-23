export default class SpeechSynthesis{
    constructor(text){
        let msg = new SpeechSynthesisUtterance(text);
        let voices = window.speechSynthesis.getVoices();
        msg.voiceURI = 'native';
        msg.volume = 1; // 0 to 1
        msg.rate = 1; // 0.1 to 10
        msg.pitch = 1; //0 to 2
        msg.text = text;
        msg.lang = 'pt-BR';
        this.msg = msg;
  
    }
    speak() {
        window.speechSynthesis.speak(this.msg);
    }
}
