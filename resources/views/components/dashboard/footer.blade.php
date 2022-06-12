<div class="container">
    <!-- Main Footer -->
    <footer class="main-footer row">
        <div class="col-md-7">
            <strong>Copyright &copy; 2014-2021 <a href="info">kt.eg</a>.</strong>
            All rights reserved.
        </div>
        <div class="flex-r col-md-3">
            <b>Version</b> 3.1.0
        </div>
    </footer>
    <!-- REQUIRED SCRIPTS -->
</div>

<!-- Cdn DataTables -->

<script>
function checkAll() {
    $('input[class="item"]:checkbox').each(function () {

        if ($('input[class="ckeck-all"]:checkbox:checked').length == 0) {
            $(this).prop('checked', false);
        } else {
            $(this).prop('checked', true);
        }
    });
}
// delete
$(document).on('click' , '.delete' , function (){
    var checkedItem = $('input[class="item"]:checkbox').filter(":checked").length;
    $(this).prop('checked' , true);
    if (checkedItem > 0){
        $('.modal-body').text('Are you sure to delete '+checkedItem +' records ?');
        $('.modal-footer').show();
    }else{
        $('.modal-body').text('No records found');
        $('.modal-footer').hide();
    }
    $('#exampleModal').modal('show');
});
// perm delete
$(document).on('click' , '.subdel' , function (){
    $('#form').submit();
});

</script>

<!-- Jquery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>--}}

<script src="{{URL::asset('js/dataTables.buttons.min.js')}}"></script>

<script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>
<!-- AdminLTE -->
<script src="{{URL::asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE -->
{{--<script src="{{URL::asset('js/dropzone.js')}}"></script>--}}
<!-- OPTIONAL SCRIPTS -->
{{--<script src="{{URL::asset('plugins/chart.js/Chart.min.js')}}"></script>--}}
{{--<!-- AdminLTE for demo purposes -->--}}
{{--<script src="{{URL::asset('dist/js/demo.js')}}"></script>--}}
{{--<!-- AdminLTE dashboard demo (This is only for demo purposes) -->--}}
{{--<script src="{{URL::asset('dist/js/pages/dashboard3.js')}}"></script>--}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@stack('script')
</body>
</html>
