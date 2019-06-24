function toastrError(message, title){
  toastr.error(message,title,{
    "positionClass": "toast-bottom-right"
  });
}
function toastrExito(message, title){
  toastr.success(message,title,{
    "positionClass": "toast-bottom-right"
  });
}
function toastrInformativa(message, title){
  toastr.info(message,title,{
    "positionClass": "toast-bottom-right"
  });
}

function toastrLogin(message, title){
  toastr.error(message,title,{
    "positionClass": "toast-top-center",
  });
}