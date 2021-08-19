
{{--<script src="https://code.jquery.com/jquery-3.6.0.min.js"--}}
{{--    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="--}}
{{--    crossorigin="anonymous"></script>--}}
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>--}}
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>


<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
<script src="{{asset("backend/assets/libs/jquery/jquery.min.js")}}"></script>
<script src="{{asset("backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{asset("backend/assets/libs/metismenu/metisMenu.min.js")}}"></script>
<script src="{{asset("backend/assets/libs/simplebar/simplebar.min.js")}}"></script>
<script src="{{asset("backend/assets/libs/node-waves/waves.min.js")}}"></script>
<script src="{{asset("backend/assets/libs/waypoints/lib/jquery.waypoints.min.js")}}"></script>
<script src="{{asset("backend/assets/libs/jquery.counterup/jquery.counterup.min.js")}}"></script>
<script src="{{asset("backend/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js")}}"></script>
<script src="{{asset("backend/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js")}}"></script>
<!-- Datatable init js -->
<script src="{{asset('backend/assets/js/pages/datatables.init.js')}}"></script>
<script src="{{asset("backend/assets/libs/jszip/jszip.min.js")}}"></script>
<script src="{{asset("backend/assets/libs/pdfmake/build/pdfmake.min.js")}}"></script>
<script src="{{asset("backend/assets/libs/pdfmake/build/vfs_fonts.js")}}"></script>
<script src="{{asset(" backend/assets/libs/datatables.net-buttons/js/buttons.html5.min.js")}}"></script>
<script src="{{asset("backend/assets/libs/datatables.net-buttons/js/buttons.print.min.js")}}"></script>
<script src="{{asset("backend/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js")}}"></script>
<!-- apexcharts -->
<script src="{{asset("backend/assets/libs/apexcharts/apexcharts.min.js")}}"></script>
<script src="{{asset("backend/assets/js/pages/dashboard.init.js")}}"></script>
<!-- App js -->
<script src="{{asset("backend/assets/js/app.js")}}"></script>
<!-- Required datatable js -->
<script src="{{asset("backend/assets/libs/datatables.net/js/jquery.dataTables.min.js")}}"></script>
<script src="{{asset("backend/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
<!-- Responsive examples -->
<script src="{{asset("backend/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js")}}"></script>
<script src="{{asset("backend/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js")}}"></script>

<!-- Datatable init js -->
<script src="{{asset("backend/assets/js/pages/datatables.init.js")}}"></script>

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

{{--Summer note--}}
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src ="{{asset("backend/assets/summernote/summernote.js")}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.2/js/bootstrap-switch.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{asset("/vendor/laravel-filemanager/js/stand-alone-button.js")}}"></script>


<script>
    $('#lfm').filemanager('image');
</script>
<script>
    $('#is_parent').change(function (e) {
        e.preventDefault();
        var is_checked = $('#is_parent').prop('checked')
        //alert(is_checked);
        if (is_checked){
            $('#parent_cat_div').addClass('d-none');
            $('#parent_cat_div').val('');
        }
        else{
            $('#parent_cat_div').removeClass('d-none');


        }
    })

</script>

<script>
    $(document).ready(function() {
        $('#description').summernote();
    });

</script>
<script>
    $(document).ready(function() {
        $('#summary').summernote();
    });

</script>
<script>
    setTimeout(function (){
       $('#alert').slideUp();
    },4000);
</script>


