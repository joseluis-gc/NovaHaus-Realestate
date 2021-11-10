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


?>



<div class="col-md-12">
    <div class="card">
        <div class="card-header">
        <h3 class="card-title">Users</h3>
        </div>
            <div class="card-body">

              
                <table  id="userstable" class="table table-hover table-striped">
                    <thead>
                    <tr>
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>User Name</th>
                    <th>E-mail</th>
                    <th>Phone</th>
                    <th>Emp No.</th>
                    <th>Options</th>
                    <th>Details</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
