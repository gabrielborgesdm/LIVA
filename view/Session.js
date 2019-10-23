import Crud from "./Crud.js";

const crud = new Crud;

export default class Session {
    constructor(){
        this.url = "controller/sessionHandler.php";
    }
    getSessionId() {
        let sessionId = crud.get(this.url);
        return (sessionId) ?JSON.parse(sessionId) : null;
    }

    checkPermission(elementId){
        let sessionId = this.getSessionId();
        return  (sessionId == elementId) ? true : false;

    }

    logoff(){
        $.ajax({
            type: "DELETE",
            url: "../../controller/SessionHandler.php",
        });
    }
}