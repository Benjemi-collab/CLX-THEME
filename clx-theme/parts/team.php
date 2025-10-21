<?php
/**
 * Template part: team.
 *
 * @package CLX
 */

$team_query = get_posts(
    array(
        'post_type'      => 'clx_team',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    )
);
?>
<section class="clx-section team-section" id="clx-team" aria-labelledby="clx-team-title">
    <div class="clx-wrap">
        <div class="section-header">
            <h2 class="section-title" id="clx-team-title"><?php esc_html_e( 'Crew CLX', 'clx' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'Directeurs photo, réalisatrices live, motion designers et storytellers pilotent vos formats.', 'clx' ); ?></p>
        </div>
        <div class="team-carousel" role="list">
            <?php if ( $team_query ) : ?>
                <?php foreach ( $team_query as $member ) : ?>
                    <?php
                    $photo_id   = get_post_thumbnail_id( $member->ID );
                    $hover_id   = absint( get_post_meta( $member->ID, 'team_hover_id', true ) );
                    $role       = get_post_meta( $member->ID, 'team_role', true );
                    $photo_data = clx_get_image_data( $photo_id );
                    $hover_data = $hover_id ? clx_get_image_data( $hover_id ) : array(
                        'src' => '',
                        'alt' => '',
                    );
                    $name       = get_the_title( $member );
                    ?>
                    <article class="team-card" role="listitem">
                        <div class="team-frame">
                            <img class="team-photo" src="<?php echo esc_url( $photo_data['src'] ); ?>" alt="<?php echo esc_attr( $photo_data['alt'] ? $photo_data['alt'] : $name ); ?>"<?php if ( $hover_data['src'] ) : ?> data-hover-src="<?php echo esc_attr( $hover_data['src'] ); ?>" data-hover-alt="<?php echo esc_attr( $hover_data['alt'] ? $hover_data['alt'] : $name ); ?>"<?php endif; ?>>
                        </div>
                        <div class="team-meta">
                            <h3 class="team-name"><?php echo esc_html( $name ); ?></h3>
                            <?php if ( $role ) : ?>
                                <p class="team-role"><?php echo esc_html( $role ); ?></p>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <article class="team-card" role="listitem">
                    <div class="team-meta">
                        <h3 class="team-name"><?php esc_html_e( 'Votre crew', 'clx' ); ?></h3>
                        <p class="team-role"><?php esc_html_e( 'Ajoutez vos talents via le CPT “Équipe”.', 'clx' ); ?></p>
                    </div>
                </article>
            <?php endif; ?>
        </div>
    </div>
</section>
