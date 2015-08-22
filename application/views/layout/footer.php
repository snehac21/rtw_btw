
</div> <!-- End of Wrapper -->
<!-- Vendor scripts -->
<!--<script src="<?php echo base_url(); ?>vendor/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>vendor/slimScroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>vendor/jquery-flot/jquery.flot.js"></script>
<script src="<?php echo base_url(); ?>vendor/jquery-flot/jquery.flot.resize.js"></script>
<script src="<?php echo base_url(); ?>vendor/jquery-flot/jquery.flot.pie.js"></script>
<script src="<?php echo base_url(); ?>vendor/flot.curvedlines/curvedLines.js"></script>
<script src="<?php echo base_url(); ?>vendor/jquery.flot.spline/index.js"></script>

<script src="<?php echo base_url(); ?>vendor/peity/jquery.peity.min.js"></script>
<script src="<?php echo base_url(); ?>vendor/sparkline/index.js"></script>
<script src="<?php echo base_url(); ?>vendor/metisMenu/dist/metisMenu.min.js"></script>
<script src="<?php echo base_url(); ?>vendor/iCheck/icheck.min.js"></script>-->

<!-- Vendor scripts -->
<script src="<?php echo base_url(); ?>vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>vendor/slimScroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>vendor/sparkline/index.js"></script>
<script src="<?php echo base_url(); ?>vendor/metisMenu/dist/metisMenu.min.js"></script>
<script src="<?php echo base_url(); ?>vendor/iCheck/icheck.min.js"></script>

<script src="<?php echo base_url(); ?>vendor/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js"></script>

<!-- App scripts -->
<script src="<?php echo base_url(); ?>scripts/homer.js"></script>
<!--<script src="<?php echo base_url(); ?>scripts/charts.js"></script>-->
<script src="<?php echo base_url(); ?>scripts/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>scripts/custom/common.js"></script>
<script src="<?php echo base_url(); ?>scripts/custom/form_validate.js"></script>



<script>

    $(function () {

        $('#datepicker').datepicker();
        $('.datepicker').datepicker();
        $('.datepicker2').datepicker();
            $("#datepicker").on("changeDate", function(event) {
                $("#my_hidden_input").val(
                        $("#datepicker").datepicker('getFormattedDate')
                )
            });

            $('#datapicker2, #tentative').datepicker();

    });

</script>

<!-- Site: HackForums.Ru | E-mail: abuse@hackforums.ru | Skype: h2osancho -->
</html>