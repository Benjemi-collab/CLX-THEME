<?php
/**
 * Footer template for CLX Theme Pro.
 *
 * @package CLX
 */
?>
</main>
<footer id="site-footer" class="site-footer">
    <div class="clx-wrap">
        <p>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></p>
    </div>
</footer>
<a id="backTop" href="#site-content" aria-label="<?php esc_attr_e( 'Retour en haut', 'clx' ); ?>">↑</a>
<?php wp_footer(); ?>
</body>
</html>
