$("input[name='expiry-data']").mask("00 / 00");
function validate(){
  var cardno = document.getElementById("cardno").value;
  var hol = document.getElementById("hol").value;
  var error_message = document.getElementById("error_message");
  error_message.style.padding = "10px";
  
  var text;
  if(isNaN(cardno) || cardno.length != 16){
    text = "Please Enter valid Card Number";
    error_message.innerHTML = text;
    return false;
  }
   if(hol.length < 5){
    text = "Please Enter valid Card Name";
    error_message.innerHTML = text;
    return false;
  }
  alert("Successfully received your payment");
  
}
 
  
