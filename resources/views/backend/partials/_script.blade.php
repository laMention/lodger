<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
</script>
<script type="text/javascript">
  window.tinyMCE.triggerSave()
</script>
<!-- build:js assets/vendor/js/core.js -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{asset('backend/assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{asset('backend/assets/vendor/libs/popper/popper.js')}}"></script>
<script src="{{asset('backend/assets/vendor/js/bootstrap.js')}}"></script>
<script src="{{asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.2/b-2.3.4/b-html5-2.3.4/datatables.min.js"></script>

<script src="{{asset('backend/assets/vendor/js/menu.js')}}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{asset('backend/assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

<!-- Main JS -->
<script src="{{asset('backend/assets/js/main.js')}}"></script>

<!-- Page JS -->
<script src="{{asset('backend/assets/js/dashboards-analytics.js')}}"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<!-- <script async defer src="https://buttons.github.io/buttons.js"></script> -->
<script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>

 <script src="{{asset('backend/assets/js/ui-popover.js')}}"></script>
 <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>

 <!-- <script src="{{asset('/js/validation.js')}}"></script> -->

<script src="{{asset('backend/js/custom.js')}}"></script>

<script src="{{asset('backend/js/functions.js')}}"></script>
<script src="{{asset('backend/js/separateur.js')}}"></script>



<!-- <script src=" https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> -->
<!-- <script src=" https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script> -->

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.2.0/zxcvbn.js"></script>


<script type="text/javascript">
  $(document).ready(function () {
      $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf'
        ]
    });
      // $('#demandes').DataTable();
  });

  $(document).ready(function() {
      $('.show-tick').select2();
  });

  $(document).ready(function() {
      $('.js-example-basic-single').select2();
  });
    $(document).ready(function() {
      $('.js-example-basic-multiple').select2();
  });
</script>

<script type="text/javascript">
  $("#formAgenceAccountSettings :input").prop('readonly', true);



  $(".btn_modifierInfos").on("click",function(e){
    // e.preventDefault()
    window.location.href = "{{route('agence.edit',[config('app.locale')])}}"
  })
</script>








