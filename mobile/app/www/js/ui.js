//loader
$('#app-content').hide();

function splash(param){
  var time = param;
  
  setTimeout(function (){
    $('#splashscreen').fadeOut("1000");
    $('#app-content').show();
  },time);

}


//select boxes
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, {});
});