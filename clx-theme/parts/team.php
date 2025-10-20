<?php
/**
 * Team section.
 *
 * @package CLX\Theme
 */

?>
<section class="clx-section team-section" id="team" aria-labelledby="team-title">
    <div class="clx-wrap">
        <div class="section-header">
            <h2 class="section-title" id="team-title"><?php esc_html_e( 'L\'équipe studio & growth', 'clx' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'Producteurs, réalisateurs, stratégistes et ingénieurs média réunis pour votre lancement.', 'clx' ); ?></p>
        </div>
        <div class="team-slider" data-slider="team">
            <button class="team-nav team-nav-prev pill-ghost" type="button" aria-label="<?php echo esc_attr__( 'Voir le profil précédent', 'clx' ); ?>">
                <span aria-hidden="true">&#8592;</span>
            </button>
            <div class="team-track" role="list">
                <?php
                $team_query = new WP_Query(
                    [
                        'post_type'      => 'clx_team',
                        'posts_per_page' => 6,
                        'post_status'    => 'publish',
                        'orderby'        => 'menu_order',
                        'order'          => 'ASC',
                    ]
                );

                if ( $team_query->have_posts() ) :
                    while ( $team_query->have_posts() ) :
                        $team_query->the_post();
                        $member_name = get_the_title();
                        $team_role   = get_post_meta( get_the_ID(), 'clx_team_role', true );
                        $team_role   = $team_role ? $team_role : __( 'Expertise à compléter', 'clx' );
                        $hover_id    = absint( get_post_meta( get_the_ID(), 'clx_team_hover_id', true ) );
                        $hover_src   = $hover_id ? clx_attachment_url( $hover_id, 'large' ) : '';
                        $hover_alt   = $hover_id ? clx_attachment_alt( $hover_id ) : '';
                        $thumb_id    = get_post_thumbnail_id();
                        ?>
                        <article class="team-card card-glass" role="listitem" tabindex="0">
                            <div class="team-photo">
                                <?php if ( $thumb_id ) :
                                    $base_alt = clx_attachment_alt( $thumb_id );
                                    $image_attrs = [
                                        'class'   => 'team-image',
                                        'loading' => 'lazy',
                                        'alt'     => $base_alt ? $base_alt : $member_name,
                                    ];

                                    if ( $hover_src ) {
                                        $image_attrs['data-hover-src'] = $hover_src;
                                    }

                                    if ( $hover_alt ) {
                                        $image_attrs['data-hover-alt'] = $hover_alt;
                                    }

                                    if ( $base_alt ) {
                                        $image_attrs['data-base-alt'] = $base_alt;
                                    }

                                    echo wp_get_attachment_image( $thumb_id, 'medium_large', false, $image_attrs );
                                else : ?>
                                    <div class="team-image team-image-placeholder" aria-hidden="true"></div>
                                <?php endif; ?>
                            </div>
                            <div class="team-meta">
                                <h3 class="team-name"><?php echo esc_html( $member_name ); ?></h3>
                                <p class="team-role"><?php echo esc_html( $team_role ); ?></p>
                            </div>
                        </article>
                        <?php
                    endwhile;
                else :
                    $placeholder_team = [
                        [
                            'name' => __( 'Élise Navarro', 'clx' ),
                            'role' => __( 'Réalisatrice créative', 'clx' ),
                        ],
                        [
                            'name' => __( 'Malik Amsalem', 'clx' ),
                            'role' => __( 'Head of Growth XR', 'clx' ),
                        ],
                        [
                            'name' => __( 'Léa Dupont', 'clx' ),
                            'role' => __( 'Productrice live', 'clx' ),
                        ],
                        [
                            'name' => __( 'Jonas Weber', 'clx' ),
                            'role' => __( 'Ingénieur diffusion', 'clx' ),
                        ],
                        [
                            'name' => __( 'Aïcha Mendes', 'clx' ),
                            'role' => __( 'Creative Strategist', 'clx' ),
                        ],
                        [
                            'name' => __( 'Tao Nguyen', 'clx' ),
                            'role' => __( 'Lead Motion designer', 'clx' ),
                        ],
                    ];
                    foreach ( $placeholder_team as $member ) :
                        ?>
                        <article class="team-card card-glass" role="listitem" tabindex="0">
                            <div class="team-photo">
                                <div class="team-image team-image-placeholder" aria-hidden="true"></div>
                            </div>
                            <div class="team-meta">
                                <h3 class="team-name"><?php echo esc_html( $member['name'] ); ?></h3>
                                <p class="team-role"><?php echo esc_html( $member['role'] ); ?></p>
                            </div>
                        </article>
                        <?php
                    endforeach;
                endif;
                wp_reset_postdata();
                ?>
            </div>
            <button class="team-nav team-nav-next pill-ghost" type="button" aria-label="<?php echo esc_attr__( 'Voir le profil suivant', 'clx' ); ?>">
                <span aria-hidden="true">&#8594;</span>
            </button>
        </div>
    </div>
</section>
