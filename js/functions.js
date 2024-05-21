function populateFormByID(id,form){
    if(!Number(id) && id != 0){ //Set blank if invalid id
      return document.getElementsByClassName("form")[0].innerHTML = "";
    }
  
    var xmlhttp = new XMLHttpRequest(); //Define request
  
    xmlhttp.onreadystatechange = function() { //Function run when request state changes (error, sent, pending etc.)
      form = document.getElementsByClassName("form form--fill")[0];
      if (this.readyState == 4 && this.status == 200) { //If request successfull
        form.innerHTML = this.responseText; //Populate Form
      }
      if(this.status == 404){ //Connection Error
        form.innerHTML = "Error 404: Problem with the connection";
      }
    };
  
    xmlhttp.open("GET",form+"?id="+id,true); //Open request
    xmlhttp.send(); //Submit request
  }