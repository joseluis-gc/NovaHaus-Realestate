<?php
require_once("classes/AndonResponse.php");
$response = new AndonResponse();

if (isset($response)) {
    if ($response->errors) {
        foreach ($response->errors as $error) {
            echo "
                <script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', function(event) {
                        swal.fire('Error!','$error','error');
                    });
                </script>
            ";
        }
    }
    if ($response->messages) {
        foreach ($response->messages as $message) {
           
            echo "
            <script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', function(event) {
                
                swal.fire({
                    title: 'Success!',
                    icon: 'success',
                    text: '$message',
                    type: 'success'
                }).then(function() {
                    window.location = 'index.php';
                });
            });
        </script>
        ";

        }
    }
}


if(isset($_GET['andon_id']) && is_numeric($_GET['andon_id']))
{

    $query = "SELECT * FROM andon  
    LEFT JOIN alerts ON andon.andon_alert_main = alerts.alert_id 
    LEFT JOIN alert_child ON andon.andon_alert_child = alert_child.child_id  
    LEFT JOIN site ON andon.andon_site_id = site.site_id 
    LEFT JOIN assets ON andon.andon_asset_id = assets.asset_id  
    WHERE andon_id = {$_GET['andon_id']}";
    $result = mysqli_query($connection, $query);
    
    $row = mysqli_fetch_array($result);
    if($row['andon_attention'] == 1)
    {
        die("Atention for this issue has been registered <a href='index.php'>Go Back</a>");
    }
}
else
{
    //parameter is not numeric
    die("Invalid Parameter.");
}


?>



<div class="col-md-12">
    <!-- Widget: user widget style 1 -->
    <div class="card card-widget widget-user">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-info">
        <h3 class="widget-user-username"><?php echo $row['alert_name']; ?></h3>
        <h5 class="widget-user-desc"> <?php ($row['andon_alert_child'] != 0) ? ($child = "  " . $row['child_name']) : ( $child = ""); echo $child; ?></h5>
        </div>
        <div class="widget-user-image">
        <img style="height: 90px; width:100px;" class="img-circle elevation-2" src="views/assets/img/bulb.png" alt="User Avatar">
        </div>
        <div class="card-footer">
        <div class="row">
            <div class="col-sm-4 border-right">
            <div class="description-block">
                <h5 class="description-header">Asset: <?php echo $row['asset_name']; ?></h5>
                <span class="description-text">Work Center: <?php echo $row['asset_work_center']; ?></span>
                <br>
                <span class="description-text">Control Number: <?php echo $row['asset_control_number']; ?></span>
                <br>
                <span class="description-text">Part #: <?php echo $row['andon_partno']; ?></span>
                <br>
                <span class="description-text">Order #: <?php echo $row['andon_orderno']; ?></span>
            </div>
            <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-4 border-right">
            <div class="description-block">
                <h5 class="description-header">Cell: <?php echo $row['site_name'] ?></h5>
                <span class="description-text"><?php # echo $row['plant_name'] ?></span>
            </div>
            <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-4">
            <div class="description-block">
                <h5 class="description-header">Date: <?php echo date_format(date_create($row['andon_start']), "d/m/Y")  ?></h5>
                <span class="description-text">Time: <?php echo date_format(date_create($row['andon_start']), "H:i:s")  ?></span>
                <p id="timmer"></p>
            </div>
            <!-- /.description-block -->
            </div>

        </div>


            <div class="row">
                    
                    <form style="width: 100%;" method="post">


                    <div class="form-group col-lg-4">
                        <label for="inputName" class="col-sm-12 col-form-label">User Error</label>
                        <div class="col-sm-12">
                        <select name="user_error" id="" class="form-control" required>
                            <option value="">Select</option>
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                        </div>
                    </div>

                    <div class="form-group col-lg-12">
                        <label for="inputName3" class="col-sm-12 col-form-label">Additional Notes</label>
                        <div class="col-sm-12">
                        <textarea class="form-control" name="notes" id="summernote" placeholder="Notes"></textarea>
                        </div>
                    </div>

                   
                    <div class="form-group col-lg-12">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-info" name="respond">Respond</button>
                        </div>
                    </div>
                   


                    </form>

                    


            </div>
        </div>
        </div>
    </div>
</div>


<script>
    //c++;  
    var startDateTime = new Date("<?php echo $row['andon_start'] ?>"); // YYYY (M-1) D H m s (start time and date from DB)
    var startStamp = startDateTime.getTime();

    var newDate = new Date();
    var newStamp = newDate.getTime();

    var timer;

    function updateClock() {
        newDate = new Date();
        newStamp = newDate.getTime();
        var diff = Math.round((newStamp-startStamp)/1000);
        
        var d = Math.floor(diff/(24*60*60));
        diff = diff-(d*24*60*60);
        var h = Math.floor(diff/(60*60));
        diff = diff-(h*60*60);
        var m = Math.floor(diff/(60));
        diff = diff-(m*60);
        var s = diff;
        
        document.getElementById("timmer").innerHTML = d+" day(s), "+h+" hr(s), "+m+" min(s), "+s+" seg(s) ago";
    }

    setInterval(updateClock, 1000);                            
</script>