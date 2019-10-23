import card from "./Card.js";

export default class MultimediaInterface {
    constructor(typeOfMultimedia, cardButtons) {
        this.list = "";
        this.button = "";
        this.cardButtons = cardButtons;
        this.typeOfMultimedia = this.setMultimediaType(typeOfMultimedia);
    }

    buildInterface() {
        let multimediaInterface = this.createInterface();
        return multimediaInterface;
    }

    createInterface(){
        return(
        `<div class="col-11 list-group d-flex flex-row mx-auto justify-content-between text-center my-2" id="list-tab" role="tablist">
            ${this.button}
        </div>    
        <div class="ml-1 py-1 ">
            <div class="col-12 p-0" >
                <div class="tab-content" id="nav-tabContent" >
                    ${this.list}
                </div>
            </div>
        </div>`
        );
    }

    setMultimediaType(type) {
        let cards;
        switch (type) {
            case 'image':
                this.typeOfMultimedia = 2;
                cards = this.getImageCards();
                this.createImageButton();
                this.createImageList(cards);
                break;
            case 'video':
                this.typeOfMultimedia = 3;
                cards = this.getVideoCards();
                this.createVideoButton();
                this.createVideoList(cards);
                break;

            case 'sound':
                this.typeOfMultimedia = 4;
                cards = this.getSoundCards();
                this.createSoundButton();
                this.createSoundList(cards);
                break;

            default:
                this.typeOfMultimedia = 1;
                this.createAllMediaButton();
                this.createImageButton();
                this.createVideoButton();
                this.createSoundButton();
                cards = this.getAllCards ();
                this.createAllMediaList(cards);

                cards = this.getImageCards();
                this.createImageList(cards);

                cards = this.getVideoCards();
                this.createVideoList(cards);

                cards = this.getSoundCards();
                this.createSoundList(cards);
                break;
        }
        return type;
    }

    getAllCards(){
        let AllMultimediaCards = new card("allMultimedia", this.cardButtons);
        return AllMultimediaCards.buildCards();
    }

    getImageCards(){
        let imageCards = new card("image", this.cardButtons);
        return imageCards.buildCards();
    }

    getVideoCards(){
        let videoCards = new card("video", this.cardButtons);
        return videoCards.buildCards();
    }

    getSoundCards(){
        let soundCards = new card("sound", this.cardButtons);
        return soundCards.buildCards();
    }

    checkHasActiveClass(type){
        return type == this.typeOfMultimedia ? "active show" : "";
    }

    createAllMediaButton(){
        this.button += 
        `<a class="col p-1 lead active" 
            id="allMediaButton" 
            data-toggle="list" 
            href="#allMediaList" 
            role="tab">Todos</a>`;
    }

    createImageButton(){
        let activeClass = this.checkHasActiveClass(2);
        this.button += 
        `<a class="col p-1 lead ${activeClass}"
            id="imageButton" 
            data-toggle="list" 
            href="#imageList" 
            role="tab">Fotos</a>`;
    }

    createVideoButton(){
        let activeClass = this.checkHasActiveClass(3);
        this.button +=
        `<a class="col p-1 lead ${activeClass}" 
            id="videoButton" 
            data-toggle="list" 
            href="#videoList" 
            role="tab">Vídeos</a>`;
    }

    createSoundButton(){
        let activeClass = this.checkHasActiveClass(4);
        this.button +=
        `<a class="col p-1 lead ${activeClass}" 
            id="soundButton" 
            data-toggle="list" 
            href="#soundList" 
            role="tab">Sons</a>`;
    }

    createAllMediaList(cards){

        this.list +=
        `<div class="row m-0 tab-pane fade show active" 
            id="allMediaList" 
            role="tabpanel">
            ${cards}</div>`;
    }

    createImageList(cards){
        
        let activeClass = this.checkHasActiveClass(2);
        this.list +=
        `<div class="row m-0 tab-pane fade ${activeClass}"
        id="imageList" 
        role="tabpanel">
        ${cards}</div>`;
        
    }

    createVideoList(cards){
        let activeClass = this.checkHasActiveClass(3);
        this.list +=
        `<div class="row m-0 tab-pane fade ${activeClass}" 
        id="videoList" 
        role="tabpanel">
        ${cards}</div>`;

    }

    createSoundList(cards){
        let activeClass = this.checkHasActiveClass(4);
        this.list +=
        `<div class="row m-0 tab-pane fade ${activeClass}" 
        id="soundList" 
        role="tabpanel">
        ${cards}</div>`;
    }



}

