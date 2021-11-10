<?php
require_once("../../manager/config/db.php");


if(isset($_GET['id']))
{
    $query = "SELECT * FROM property WHERE id = {$_GET['id']}";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_array($result)):
    ?>

        <div class="col l12">
          <h2><?php echo $row['name'] ?></h2>
          <h5><?php echo $row['street'] . " " . $row['number'] . " " . $row['section'] ?> · <span class=""><?php echo number_format($row['precio'],2) . " " . $row['moneda'] ; ?></span></h5>  
        </div>


        <div style='border-radius:15px; height:300px;background-image: url("http://localhost/adminsystems/realestate/manager/<?php echo $row['imagen_principal'] ?>"); background-size:cover; background-position:center center' class="card-image col s12 m12">

        </div>

        <div class="col s12 m8 ">
        
            <div style="height: 80px;" class="col s4 m4 l3 center-align card  ">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M13.2 7.07L10.25 11l2.25 3c.33.44.24 1.07-.2 1.4-.44.33-1.07.25-1.4-.2-1.05-1.4-2.31-3.07-3.1-4.14-.4-.53-1.2-.53-1.6 0l-4 5.33c-.49.67-.02 1.61.8 1.61h18c.82 0 1.29-.94.8-1.6l-7-9.33c-.4-.54-1.2-.54-1.6 0z"/></svg>                    
                <br>
                <b>Area:</b><br> 
                <?php echo $row['terreno'] . " mts2" ?>
            </div>

            <div style="height: 80px;" class="col s4 m4 l3 center-align card ">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M10 19v-5h4v5c0 .55.45 1 1 1h3c.55 0 1-.45 1-1v-7h1.7c.46 0 .68-.57.33-.87L12.67 3.6c-.38-.34-.96-.34-1.34 0l-8.36 7.53c-.34.3-.13.87.33.87H5v7c0 .55.45 1 1 1h3c.55 0 1-.45 1-1z"/></svg>
                <br><b>Construcción:</b><br> 
                <?php echo $row['construccion'] . " mts2" ?>
            </div>
             
            <?php 
            if($row['recamaras'] > 0){
            ?>   
            <div style="height: 80px;" class="col s4 m4 l3 center-align card ">
            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><rect fill="none" height="24" width="24"/><path d="M10.8,3.9l-6,4.5C4.3,8.78,4,9.37,4,10v9c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2v-9c0-0.63-0.3-1.22-0.8-1.6l-6-4.5 C12.49,3.37,11.51,3.37,10.8,3.9z M9.75,12.5c0.69,0,1.25,0.56,1.25,1.25S10.44,15,9.75,15S8.5,14.44,8.5,13.75S9.06,12.5,9.75,12.5 z M16.5,18L16.5,18c-0.28,0-0.5-0.22-0.5-0.5v-1H8v1C8,17.78,7.78,18,7.5,18h0C7.22,18,7,17.78,7,17.5v-6C7,11.22,7.22,11,7.5,11h0 C7.78,11,8,11.22,8,11.5v4h3.5v-3c0-0.28,0.22-0.5,0.5-0.5h3c1.1,0,2,0.9,2,2v3.5C17,17.78,16.78,18,16.5,18z"/></svg>
                <br><b>Recamaras:</b><br> 
                <?php echo $row['recamaras'] ?>
            </div>
            <?php
            }
            ?>

            <?php 
            if($row['bathrooms'] > 0){
            ?>   
            <div style="height: 80px;" class="col s4 m4 l3 center-align card ">
            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><g><rect fill="none" height="24" width="24"/></g><g><g><circle cx="7" cy="7" r="2"/><path d="M20,13V4.83C20,3.27,18.73,2,17.17,2c-0.75,0-1.47,0.3-2,0.83l-1.25,1.25C13.76,4.03,13.59,4,13.41,4 c-0.4,0-0.77,0.12-1.08,0.32l2.76,2.76c0.2-0.31,0.32-0.68,0.32-1.08c0-0.18-0.03-0.34-0.07-0.51l1.25-1.25 C16.74,4.09,16.95,4,17.17,4C17.63,4,18,4.37,18,4.83V13h-6.85c-0.3-0.21-0.57-0.45-0.82-0.72l-1.4-1.55 c-0.19-0.21-0.43-0.38-0.69-0.5C7.93,10.08,7.59,10,7.24,10C6,10.01,5,11.01,5,12.25V13H2v6c0,1.1,0.9,2,2,2c0,0.55,0.45,1,1,1h14 c0.55,0,1-0.45,1-1c1.1,0,2-0.9,2-2v-6H20z M20,19H4v-4h16V19z"/></g></g></svg>                
                <br><b>Baños:</b><br> 
                <?php echo $row['bathrooms'] ?>
            </div>
            <?php
            }
            ?>



            
       
        

            <?php 
            if($row['patio'] > 0){
            ?>   
            <div style="height: 80px;" class="col s4 m4 l3 center-align card">
            <br/>
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 22c4.56 0 8.33-3.4 8.92-7.8.09-.64-.48-1.21-1.12-1.12-4.4.59-7.8 4.36-7.8 8.92zM5.6 10.25c0 1.38 1.12 2.5 2.5 2.5.53 0 1.01-.16 1.42-.44l-.02.19c0 1.38 1.12 2.5 2.5 2.5s2.5-1.12 2.5-2.5l-.02-.19c.4.28.89.44 1.42.44 1.38 0 2.5-1.12 2.5-2.5 0-1-.59-1.85-1.43-2.25.84-.4 1.43-1.25 1.43-2.25 0-1.38-1.12-2.5-2.5-2.5-.53 0-1.01.16-1.42.44l.02-.19C14.5 2.12 13.38 1 12 1S9.5 2.12 9.5 3.5l.02.19c-.4-.28-.89-.44-1.42-.44-1.38 0-2.5 1.12-2.5 2.5 0 1 .59 1.85 1.43 2.25-.84.4-1.43 1.25-1.43 2.25zM12 5.5c1.38 0 2.5 1.12 2.5 2.5s-1.12 2.5-2.5 2.5S9.5 9.38 9.5 8s1.12-2.5 2.5-2.5zm-8.92 8.7C3.67 18.6 7.44 22 12 22c0-4.56-3.4-8.33-7.8-8.92-.64-.09-1.21.48-1.12 1.12z"/></svg>
                <b>Jardin</b><br> 
            </div>
            <?php
            }
            ?>




            <?php 
            if($row['alberca'] > 0){
            ?>   
            <div style="height: 80px;" class="col s4 m4 l3 center-align card">
            <br>
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6.11 5.56C7.3 5.7 8.14 6.14 9 7l1 1-3.25 3.25c.31.12.56.27.77.39.37.23.59.36 1.15.36s.78-.13 1.15-.36c.46-.27 1.08-.64 2.19-.64s1.73.37 2.18.64c.37.22.6.36 1.15.36.55 0 .78-.13 1.15-.36.12-.07.26-.15.41-.23L10.48 5C9.22 3.74 8.04 3.2 6.3 3.05 5.6 2.99 5 3.56 5 4.26v.09c0 .63.49 1.13 1.11 1.21zm15.24 13.35c-.17-.06-.32-.15-.5-.27-.45-.27-1.07-.64-2.18-.64s-1.73.37-2.18.64c-.37.23-.6.36-1.15.36-.55 0-.78-.14-1.15-.36-.45-.27-1.07-.64-2.18-.64s-1.73.37-2.19.64c-.37.23-.59.36-1.15.36s-.78-.13-1.15-.36c-.45-.27-1.07-.64-2.18-.64s-1.73.37-2.19.64c-.18.11-.33.2-.5.27-.38.13-.65.45-.65.85v.12c0 .67.66 1.13 1.3.91.37-.13.65-.3.89-.44.37-.22.6-.35 1.15-.35.55 0 .78.13 1.15.36.45.27 1.07.64 2.18.64s1.73-.37 2.19-.64c.37-.23.59-.36 1.15-.36.55 0 .78.14 1.15.36.45.27 1.07.64 2.18.64s1.72-.37 2.18-.64c.37-.23.59-.36 1.15-.36.55 0 .78.14 1.15.36.23.14.51.31.88.44.63.22 1.3-.24 1.3-.91v-.12c0-.41-.27-.73-.65-.86zM3.11 16.35c.47-.13.81-.33 1.09-.49.37-.23.6-.36 1.15-.36.55 0 .78.14 1.15.36.45.27 1.07.64 2.18.64s1.73-.37 2.18-.64c.37-.23.59-.36 1.15-.36.55 0 .78.14 1.15.36.45.27 1.07.64 2.18.64s1.73-.37 2.18-.64c.37-.23.59-.36 1.15-.36.55 0 .78.14 1.15.36.23.14.5.3.85.43.63.23 1.31-.24 1.31-.91v-.12c0-.4-.27-.72-.64-.86-.17-.06-.32-.15-.51-.26-.45-.27-1.07-.64-2.18-.64s-1.73.37-2.18.64c-.37.23-.6.36-1.15.36s-.78-.14-1.15-.36c-.45-.27-1.07-.64-2.18-.64s-1.73.37-2.18.64c-.37.23-.59.36-1.15.36-.55 0-.78-.14-1.15-.36-.45-.27-1.07-.64-2.18-.64s-1.73.37-2.18.64c-.18.11-.33.2-.5.27-.38.13-.65.45-.65.85v.23c0 .58.55 1.02 1.11.86z"/><circle cx="16.5" cy="5.5" r="2.5"/></svg>
                <b>Alberca</b><br> 
                
            </div>
            <?php
            }
            ?>

            

            <div class="col l12">
                <h4 class="deep-purple-text darken-4">Descripción</h4>
                <?php echo $row['description'] ?>
            </div>
           
            

           
         


        </div>


        <div  class="col s12 m4">
        


            <div  class="card">
                <!--
                <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" src="images/office.jpg">
                </div>
                -->
                <div style="height:350px;" class="card-content">
                    <span style="font-weight: 900;" class="card-title activator grey-text text-darken-4">¿Te interesa?<i class="material-icons right">more_vert</i></span>
                    <p>Deja tus datos y nosotros nos pondremos en contacto contigo.</p>
                    <br>
                    <p><a style="width: 100%;" class="activator btn white-text deep-purple" >Ingresa Tus Datos</a></p>

                    </div>
                    <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Ingresa Tus Datos<i class="material-icons right">close</i></span>
                    <p>
                       <form id="myForm" method="POST">
                           <input type="email" name="email" id="email">
                           <label for="email">Correo electronico</label>
                           <input type="tel" name="tel" id="tel">
                           <label>Telefono</label>
                           <br><br>
                           <button style="width:100%" class="btn deep-purple">Enviar</button>
                       </form>
                    </p>
                    </div>
            </div>
            



        </div>

        
        <div style="margin-top: 50px;" class="col l12 s12">
                <?php 
                $get_images = "SELECT * FROM property_images WHERE property_id = {$_GET['id']}";
                $run_image_query = mysqli_query($connection, $get_images);
                while($row_image = mysqli_fetch_array($run_image_query)):
                ?>
                    <div class="col m4 s12">
                        <div style='border-radius:5px; height:200px; width:100%; background-image: url("http://localhost/adminsystems/realestate/manager/<?php echo $row['imagen_principal'] ?>"); background-size:cover; background-position:center center'  class=" ">
                            
                        </div>
                    </div>
                                
                    

                <?php endwhile; ?> 
        </div>
      
    <?php 
    endwhile;      
}else{
    echo "Not set";
}
?>

<script>
    $(document).ready(function() {
        $("#myForm").on('submit', function(event) {
            event.preventDefault();
            alert("triggered"); 
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: 'api/v1/sendmail.php',
                dataType: "json",
                data: formData,
                success: function(response) { 
                    alert(response.success); 
                },
                error: function(xhr, status, error){
                    console.log(xhr); 
                }
            });
        });
    });
  </script>