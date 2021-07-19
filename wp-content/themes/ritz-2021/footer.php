<?php
/**
 * The template for displaying the footer.
 *
 * Comtains closing divs for header.php.
 *
 * For more info: https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */
?>

<footer class="footer" role="contentinfo">

    <div class="inner-footer grid-x grid-margin-x grid-padding-x">

        <div class="small-12 medium-12 large-12 cell">
            <nav role="navigation">
                <?php joints_footer_links(); ?>
            </nav>
        </div>

        <div class="small-12 medium-12 large-12 cell">
            <p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.</p>
        </div>

    </div> <!-- end #inner-footer -->

</footer> <!-- end .footer -->

</div>  <!-- end .off-canvas-content -->

</div> <!-- end .off-canvas-wrapper -->

<script type="text/javascript">
    var BOOKING_SETTINGS = {
        "hotel": "ritzlondon",
        "theme": "luxury",
        "lang": "en",
        "emergency": {
            "email": "reservations@theritzlondon.com",
            "phone": "4402073002222"
        }
    };
</script>
<booking-layout></booking-layout>


<?php wp_footer(); ?>

</body>

</html> <!-- end page -->