<?php
/**
 * Footer template.
 *
 * @package CLX
 */
?>
<footer class="clx-footer" role="contentinfo">
<div class="clx-wrap footer-inner">
<p class="footer-copy">&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></p>
</div>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>
