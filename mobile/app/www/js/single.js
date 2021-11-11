

const queryString = window.location.search;
console.log(queryString);
const urlParams = new URLSearchParams(queryString);

$(document).ready(function(){
  var action = 'inactive';
  
  const property = urlParams.get('id')
  console.log(property);
  
  function load_data(){

      $.ajax({
        url:"https://smartlaboratory.tech/novahaus/api/v2/single.php?id="+property,
        method:"POST",
        data:{property:property},
        cache:false,
        success:function(data)
        {
            $('#load_data').append(data);
            if(data == '')
            {
                $('#load_data_message').html("<!--<div><button style='width:100%' class='btn deep-purple'>Data Loaded</button></div>-->");
                action = 'active';
            }
            else
            {
                $('#load_data_message').html("<div><button style='width:100%' class='btn deep-purple'>Cargando, por favor espere...</button></div>");
                action = 'inactive';

            }
        }
      })
  }

  
  if(action == 'inactive')
  {
    action = 'active';
    load_data();
  }
  
});