<?php
/**
 * Team slider section partial.
 *
 * @package CLX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$team_query = new WP_Query(
    array(
        'post_type'      => 'clx_team',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    )
);
?>
<section class="clx-section team-section" id="team" aria-labelledby="team-title">
    <div class="clx-wrap">
        <div class="section-header">
            <h2 class="section-title" id="team-title"><?php esc_html_e( 'Votre escouade créative', 'clx' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'Directeurs photo, motion designers et producteurs d\'expériences.', 'clx' ); ?></p>
        </div>
        <div class="team-slider" data-slider="team" tabindex="0">
            <div class="team-track" role="list" aria-live="polite">
                <?php if ( $team_query->have_posts() ) : ?>
                    <?php
                    while ( $team_query->have_posts() ) :
                        $team_query->the_post();
                        $post_id   = get_the_ID();
                        $role      = clx_get_meta_text( $post_id, 'team_role' );
                        $hover_id  = clx_get_meta_int( $post_id, 'team_hover_id' );
                        $hover_url = $hover_id ? clx_attachment_url( $hover_id, 'medium' ) : '';
                        $thumb_id  = get_post_thumbnail_id( $post_id );
                        $thumb_url = $thumb_id ? clx_attachment_url( $thumb_id, 'medium' ) : '';
                        ?>
                        <article class="team-card card-glass" role="listitem">
                            <div class="team-card-media">
                                <?php if ( $thumb_id ) : ?>
                                    <?php
                                    echo clx_attachment_image(
                                        $thumb_id,
                                        'medium',
                                        array(
                                            'class'          => 'team-photo',
                                            'data-base-src'  => $thumb_url,
                                            'data-hover-src' => $hover_url,
                                            'alt'            => get_the_title(),
                                            'loading'        => 'lazy',
                                            'decoding'       => 'async',
                                        )
                                    );
                                    ?>
                                <?php else : ?>
                                    <div class="team-photo team-photo--empty" aria-hidden="true"></div>
                                <?php endif; ?>
                            </div>
                            <div class="team-card-body">
                                <h3 class="team-name"><?php the_title(); ?></h3>
                                <?php if ( $role ) : ?>
                                    <p class="team-role"><?php echo esc_html( $role ); ?></p>
                                <?php endif; ?>
                                <?php if ( has_excerpt() ) : ?>
                                    <p class="team-bio"><?php echo esc_html( get_the_excerpt() ); ?></p>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <article class="team-card card-glass" role="listitem">
                        <div class="team-card-body">
                            <h3 class="team-name"><?php esc_html_e( 'Équipe CLX', 'clx' ); ?></h3>
                            <p class="team-role"><?php esc_html_e( 'Ajoutez vos talents depuis le tableau de bord.', 'clx' ); ?></p>
                        </div>
                    </article>
                <?php endif; ?>
            </div>
            <div class="team-nav">
                <button class="pill-ghost" type="button" data-slider-prev="team" aria-label="<?php esc_attr_e( 'Défilement précédent', 'clx' ); ?>"><?php esc_html_e( 'Précédent', 'clx' ); ?></button>
                <button class="pill-ghost" type="button" data-slider-next="team" aria-label="<?php esc_attr_e( 'Défilement suivant', 'clx' ); ?>"><?php esc_html_e( 'Suivant', 'clx' ); ?></button>
            </div>
        </div>
    </div>
</section>
