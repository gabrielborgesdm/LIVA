import Crud from "./Crud.js";

const crud = new Crud();

export default class Card{
    constructor(typeOfCard, buttons = null, filterCondition = null){
        this.cardClass = typeOfCard;
        this.typeOfCard = this.setCardType(typeOfCard);
        this.buttons = buttons != null ? this.appendButtons(buttons) : "";
        this.filterCondition = filterCondition;
        this.directory = "";
        this.baseURL = window.location.origin + "/LIVA/view/";
    }

    buildCards(){
        let arrayOfElements = this.getElements();
        if(typeof arrayOfElements.error == "undefined"){
            let directory, media, cards = "";
            arrayOfElements = this.filterElementsAccordingTheirType(arrayOfElements); 
            arrayOfElements = this.filterElementsAccordingConditions(arrayOfElements);          
            arrayOfElements.forEach(element =>{
                media = this.getMediaIfCategoryOrItem(element);
                directory = this.getCardImageAccordingItsType(element);
                cards += this.createCard(element.name, element.id, directory, media, this.cardClass);
            });
            
        return cards != "" ? cards : '<li>Não há elementos cadastrados</li>';
        } else{
            return arrayOfElements.error;
        }
        
    }

    getElements(){
        let arrayOfElements, url;
        if(this.typeOfCard == 5){
            url = "controller/dashboardController/itemHandler.php";
        } else if(this.typeOfCard == 6){
            url = "controller/dashboardController/categoryHandler.php";
        }else{
            url = "controller/dashboardController/multimediaHandler.php";
        }
        arrayOfElements = crud.get(url);
        return arrayOfElements;
    }

    getMediaIfCategoryOrItem(element){
        let response;
        if(element.type == undefined){
            response = 
            `<form name="formVideo" class="d-none formVideo" action="video.php" method="post">
                <input type="text" name="videoUrl" value="${element.videoDirectory}"/>
            </form>
            <audio class="cardSound">
                <source src="../${element.soundDirectory}" type="audio/mpeg">
            </audio>`;
        } else{
            response = "";
        }
        return response;
    }

    countCards(){
        let arrayOfElements = this.getElements(), arrayLength;
        if(typeof arrayOfElements.error == "undefined"){
            arrayOfElements = this.filterElementsAccordingTheirType(arrayOfElements);
            arrayLength = arrayOfElements.length;
        } else{
            arrayLength = 0;
        }
        return arrayLength;
    }

    filterElementsAccordingTheirType(arrayOfElements){
        let typeOfCard = this.typeOfCard;
        if(typeOfCard != 1 && typeOfCard != 5 && typeOfCard != 6){ 
            arrayOfElements = arrayOfElements.filter(function(element){
                return element.type == typeOfCard;
            });
        }
        
        return arrayOfElements;
    }

    filterElementsAccordingConditions(arrayOfElements) {
        let filterCondition = this.filterCondition;
        if (filterCondition){
            let check = 1;
            arrayOfElements = arrayOfElements.filter(function (element) {
                Object.entries(filterCondition).forEach(([key, value]) => {
                    check = element[key] == value ? 1 : 0;
                });
                return check == 1;
            });
        }
        return arrayOfElements;
    }

    createCard (name, id, directory, sound, cardClass) {
        let card =
            `<div class="card col-12 col-sm-4 ${cardClass}" style="width: 18rem;">
            <img src="${directory}" class="card-img-top img-fluid" alt="Card ${name}">
            <div class="card-body">
                <h5 class="card-title m-0 py-2">${name}</h5>
                ${sound}
                <div id="${id}" class="buttonsContainer justify-content-around py-2 m-0 d-flex"> 
                ${this.buttons}
                </div> 
            </div>
          </div>`;
          
        return card;
    }

    createButton(type){
        let buttonIcon = '';
        switch(type){
            case 'select':
                buttonIcon = '<i class="far fa-check-square selectButton" title="Selecionar"></i>';
                break;
            case 'remove':
                buttonIcon = '<i class="far fa-trash-alt removeButton" title="Remover"></i>';
                break;
            case 'listen':   
                buttonIcon = '<i class="fas fa-volume-up listenButton" title="Ouvir"></i>';
                break;
            
            case 'video':   
                buttonIcon = '<i class="fas fa-video videoButton" title="Assistir"></i>';
                break;
        }
        return buttonIcon;
    }

    appendButtons(cardButtons){
        let buttons = '';
        cardButtons.forEach((type) => {
            buttons += this.createButton(type);
        });
        return buttons;
    }

    setCardType(type){
        let cardClass;
        switch(type){
            case 'image':
                cardClass = "imageCard";
                type = 2;
                break;
            case 'video':
                cardClass = "videoCard";
                type = 3;
                break;
                
            case 'sound':
                cardClass = "soundCard";
                type = 4;
                break;

            case 'item':
                cardClass = "itemCard";
                type = 5;
                break;

            case 'category':
                cardClass = "categoryCard";
                type = 6;
                break;

            default:
                type = 1;
                break;
        }
        this.cardClass = cardClass;
        return type;
    }

    getCardImageAccordingItsType(element){
        let directory;
        if(element.type != null){
            switch(element.type){
                case '2':
                    directory = this.baseURL + element.directory;
                    break;
                case '3':
                    directory = this.baseURL + 'assets/icons/videoIcon.png';
                    break;
                case '4':
                    directory = this.baseURL + 'assets/icons/soundIcon.png';
                    break;
            }
        } else{
            
            directory = this.baseURL + element.imageDirectory;
        }
        
        return directory;  
    }

    
}