</div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer 
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>
</div>
-->
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="views/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="views/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="views/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="views/assets/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="views/assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="views/assets/plugins/raphael/raphael.min.js"></script>
<script src="views/assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="views/assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>

<!-- ChartJS -->
<script src="views/assets/plugins/chart.js/Chart.min.js"></script>
<script src="js/charts/dashboard.js"></script>
<script src="js/dashboard/info-box.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="views/assets/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="views/assets/dist/js/pages/dashboard2.js"></script>


<!-- InputMask -->
<script src="views/assets/plugins/moment/moment.min.js"></script>
<script src="views/assets/plugins/inputmask/jquery.inputmask.min.js"></script>

<!--select 2-->
<script src="views/assets/plugins/select2/js/select2.full.min.js"></script>

<!-- Bootstrap Switch -->
<script src="views/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

<!--Swal-->
<script src="views/assets/plugins/sweetalert2/sweetalert2.js"></script>


<!-- DataTables  & Plugins -->
<script src="views/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="views/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="views/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="views/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="views/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="views/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="views/assets/plugins/jszip/jszip.min.js"></script>
<script src="views/assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="views/assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="views/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="views/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="views/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- date-range-picker -->
<script src="views/assets/plugins/daterangepicker/daterangepicker.js"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="views/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- dropzone -->
<script src="views/assets/plugins/dropzone/dropzone.js"></script>
<script src="views/assets/plugins/jquery-validation/jquery.validate.js"></script>


<script>
  Dropzone.autoDiscover = false;
  $('[data-mask]').inputmask();

      var namecard = "";
      var emailcard = "";
      var firstnamecard = "";
      var lastnamecard = "";
      var usertype = "";
      
      $("#username").on('change', function postinput(){
        namecard = $("#username").val();
        $("#username-card").html(namecard);
      });

      $("#firstname").on('change', function postinput(){
        firstnamecard = $("#firstname").val();
        $("#firstname-card").html(firstnamecard);
      });

      $("#lastname").on('change', function postinput(){
        lastnamecard = $("#lastname").val();
        $("#lastname-card").html(lastnamecard);
      });

      $("#email").on('change', function postinput(){
        emailcard = $("#email").val();
        $("#email-card").html(emailcard);
      });


      $("#support").hide();
      $("#operations").hide();
      $("#adm").hide();
      $("#areas").hide();


      $("#usertype").on('change', function postinput(){
        usertype = $("#usertype").val();
        if(usertype == 'o')
        {
          $("#operations").show();
          $("#support").hide();
          $("#adm").hide();
        }
        else if(usertype == 's')
        {
          $("#support").show();
          $("#operations").hide();
          $("#adm").hide();
        }
        else if(usertype == 'a')
        {
          $("#adm").show();
          $("#support").hide();
          $("#operations").hide();
        }
        else
        {
          $("#adm").hide();
          $("#support").hide();
          $("#operations").hide();
        }
      });





      $("#sareas").on('change', function postinput(){
        if($("#sareas").is(":checked") == true){
          $("#areas").show();
        }else{
          $("#areas").hide();
        }
      });






      function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
          $('#blah').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]); // convert to base64 string
      }
    }

    $("#imgInp").change(function() {
      readURL(this);
    });
  



    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      //theme: 'bootstrap4'
    })

    //bootstrap switch
    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })



</script>



<script>

  
  $(function () {
    
    var source = "functions/ajax/data/data.php";
    
    $("#searchButton").click(function(){
        alert("clicked.");
        source = "functions/ajax/data/data.php?id=5";
        Table.clear().draw();
    });

    var table = $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "ajax": source,
      
     
      
      initComplete: function () {
                table.buttons().container()
                .appendTo('#example1_wrapper .col-md-6:eq(0)');
      }

    })



    var source = "functions/ajax/users/view_users.php";
    
   
    var table = $("#userstable").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "ajax": source,
      
     
      
      initComplete: function () {
                table.buttons().container()
                .appendTo('#userstable_wrapper .col-md-6:eq(0)');
      }

    })


    //.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>


<script>
   //Datemask dd/mm/yyyy
   $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
</script>


<script >
  
$(document).ready(function(){
    $('#country').on('change', function(){
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'POST',
                url:'functions/public_functions/dependant_dropdown.php',
                data:'country_id='+countryID,
                success:function(html){
                    $('#state').html(html);
                    $('#city').html('<option value="">Seleccione un pais</option>'); 
                }
            }); 
        }else{
            $('#state').html('<option value="">Seleccione un pais</option>');
            $('#city').html('<option value="">Seleccione un estado</option>'); 
        }
    });
    
    $('#state').on('change', function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:'POST',
                url:'functions/public_functions/dependant_dropdown.php',
                data:'state_id='+stateID,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="">Seleccione un estado</option>'); 
        }
    });
});

</script>






<script>
var form = $( "#imageUploadForm" );
form.validate();  
  

  
myDropzone = new Dropzone('div#imageUpload', {
    addRemoveLinks: true,
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 100,
    maxFiles: 3,
    paramName: 'file',
    clickable: true,
    url: 'functions/property/ajax.php',
    init: function () {

        var myDropzone = this;
        // Update selector to match your button
        $("#uploaderBtn").click(function (e) {
         // alert("hi");
            e.preventDefault();
            if ( $("#imageUploadForm").valid() ) {
                myDropzone.processQueue();
            }
            return false;
        });

        this.on('sending', function (file, xhr, formData) {
            // Append all form inputs to the formData Dropzone will POST
            var data = $("#imageUploadForm").serializeArray();
            $.each(data, function (key, el) {
                formData.append(el.name, el.value);
            });
            console.log(formData);

        });
    },
    error: function (file, response){
        if ($.type(response) === "string")
            var message = response; //dropzone sends it's own error messages in string
        else
            var message = response.message;
        file.previewElement.classList.add("dz-error");
        _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
        _results = [];
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i];
            _results.push(node.textContent = message);
        }
        return _results;
    },
    successmultiple: function (file, response) {
        console.log(file, response);
        //$modal.modal("show");
        //alert("success1");
        $("#fileList").load(location.href + " #fileList");
        //alert("1");
        this.removeAllFiles(true);

    },
    completemultiple: function (file, response) {
        console.log(file, response, "completemultiple");
        //$modal.modal("show");
        //alert("2");
        
    },
    reset: function () {
        //alert("3");
        console.log("resetFiles");
        this.removeAllFiles(true);
    }
});

</script>








</body>
</html>
