<footer class="footer mt-auto">
    <div class="container">
        <span class="text-muted">By &copy; NikahYuk 2020</span><br>
        <small class="text-muted">Icons made by <a class="text-muted font-weight-bold" href="http://www.freepik.com" title="Freepik">Freepik</a> from <a class="text-muted font-weight-bold" href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></small>
    </div>
</footer> 

<!--   Core JS Files   -->
<script src="<?= base_url('assets/js/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url(); ?>assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="<?= base_url(); ?>assets/js/plugins/bootstrap-switch.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="<?= base_url(); ?>assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/js/plugins/moment.min.js"></script>
<script src="<?= base_url(); ?>assets/js/plugins/datetimepicker.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>assets/js/plugins/bootstrap-datepicker.min.js"></script>
<!-- Control Center for Argon UI Kit: parallax effects, scripts for the example pages etc -->
<!--  Google Maps Plugin    -->
<script src="<?= base_url(); ?>assets/js/argon-design-system/argon-design-system.min.js?v=1.2.0" type="text/javascript"></script>
<!-- Custom -->
<script src="<?= base_url('assets/js/custom/script.js') ?>"></script>
<?php if(isset($modal_active)):?>
<script>
    $('#daftarModal').modal('show');
</script>
<?php endif; ?>
</body> 
 
</html