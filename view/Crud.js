export default class Crud {

  constructor(baseURL) {
    this.baseURL = "http://localhost/LIVA/";
    this.error = {'error': "Não foi possível realizar esta operação"};
  }

  get(url) {
    let response = this.error
    $.ajax({
      type: "GET",
      async: false,
      url: this.baseURL + url,
      datatype: 'json',
      success: function (getReponse) {
        response = getReponse;
      },
    });
    return JSON.parse(response);
  }

  post(url, data){
    let response = this.error;
    $.ajax({
      type: "POST",
      url: this.baseURL + url,
      async: false,
      data: data,
      processData: false,
      contentType: false,
      success: function(postResponse){
        response = postResponse;
      },
    });
    return JSON.parse(response);
  }

  delete(url, id){
    let response = this.error
    $.ajax({
      url: this.baseURL + url,
      type: 'DELETE',
      async: false,
      beforeSend: function (xhrObj) {
        xhrObj.setRequestHeader("Content-Type", "application/json");
        xhrObj.setRequestHeader("id", id);
      }, success: function (deleteResponse) {
        response = deleteResponse;
      }
    });
    return JSON.parse(response);
  }
}