
<!-- jQuery -->
<script src="views/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="views/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="views/assets/dist/js/adminlte.min.js"></script>
<!--select 2-->
<script src="views/assets/plugins/select2/js/select2.full.min.js"></script>


<script>



//Initialize Select2 Elements
$('.select2').select2()


$(document).ready(function(){
    $('#planta').on('change', function(){
        var plantaID = $(this).val();
        if(plantaID){
            $.ajax({
                type:'POST',
                url:'functions/public_functions/dependant_dropdown.php',
                data:'plant_id='+plantaID,
                success:function(html){
                    $('#state').html(html);
                    $('#city').html('<option value="">Select a site first</option>'); 
                }
            }); 
        }else{
            $('#state').html('<option value="">Select a plant first</option>');
            $('#city').html('<option value="">Select a site first</option>'); 
        }
    });
    
    $('#state').on('change', function(){
        var siteID = $(this).val();
        if(siteID){
            $.ajax({
                type:'POST',
                url:'functions/public_functions/dependant_dropdown.php',
                data:'site_id='+siteID,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="">Select a site first</option>'); 
        }
    });
});

</script>




</body>
</html