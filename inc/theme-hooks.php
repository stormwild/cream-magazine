<?php
/**
 * Definition of theme's custom hook actions.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Cream_Magazine
 */

if ( ! function_exists( 'cream_magazine_doctype_action' ) ) {
	/**
	 * Doctype declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_doctype_action() {
		?>
		<!doctype html>
		<html <?php language_attributes(); ?>>
		<?php
	}
}
add_action( 'cream_magazine_doctype', 'cream_magazine_doctype_action', 10 );



if ( ! function_exists( 'cream_magazine_head_action' ) ) {
	/**
	 * Head declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_head_action() {
		?>
		<head>
			<meta charset="<?php bloginfo( 'charset' ); ?>">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="profile" href="http://gmpg.org/xfn/11">
			<?php wp_head(); ?>
		</head>
		<?php
	}
}
add_action( 'cream_magazine_head', 'cream_magazine_head_action', 10 );



if ( ! function_exists( 'cream_magazine_body_before_action' ) ) {
	/**
	 * Body Before declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_body_before_action() {
		?>
		<body <?php body_class(); ?>>
			<?php
			if ( function_exists( 'wp_body_open' ) ) {
				wp_body_open();
			}
			?>
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'cream-magazine' ); ?></a>
		<?php
	}
}
add_action( 'cream_magazine_body_before', 'cream_magazine_body_before_action', 10 );



if ( ! function_exists( 'cream_magazine_page_wrapper_start_action' ) ) {
	/**
	 * Page Wapper Start declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_page_wrapper_start_action() {
		?>
		<div class="page-wrapper">
		<?php
	}
}
add_action( 'cream_magazine_page_wrapper_start', 'cream_magazine_page_wrapper_start_action', 10 );



if ( ! function_exists( 'cream_magazine_header_section_action' ) ) {
	/**
	 * Header layout selection declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_header_section_action() {

		$header_layout = cream_magazine_get_option( 'cream_magazine_select_header_layout' );

		if ( 'header_1' === $header_layout ) {
			get_template_part( 'template-parts/header/header', 'one' );
		} else {
			get_template_part( 'template-parts/header/header', 'two' );
		}
	}
}
add_action( 'cream_magazine_header_section', 'cream_magazine_header_section_action', 10 );



if ( ! function_exists( 'cream_magazine_top_header_menu_action' ) ) {
	/**
	 * Header top menu declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_top_header_menu_action() {

		if ( has_nav_menu( 'menu-2' ) ) {

			wp_nav_menu(
				array(
					'theme_location' => 'menu-2',
					'container'      => '',
					'depth'          => 1,
				)
			);
		}
	}
}
add_action( 'cream_magazine_top_header_menu', 'cream_magazine_top_header_menu_action', 10 );



if ( ! function_exists( 'cream_magazine_main_menu_action' ) ) {
	/**
	 * Main menu declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_main_menu_action() {

		$menu_args = array(
			'theme_location' => 'menu-1',
			'container'      => '',
			'menu_class'     => '',
			'menu_id'        => '',
			'items_wrap'     => cream_magazine_main_menu_wrap(),
			'fallback_cb'    => 'cream_magazine_navigation_fallback',
		);
		wp_nav_menu( $menu_args );
	}
}
add_action( 'cream_magazine_main_menu', 'cream_magazine_main_menu_action', 10 );



if ( ! function_exists( 'cream_magazine_site_identity_action' ) ) {
	/**
	 * Site identity declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_site_identity_action() {
		?>
		<div class="logo">
			<?php
			if ( has_custom_logo() ) {
				if (
					(
						is_front_page() &&
						(
							cream_magazine_get_option( 'cream_magazine_enable_home_content' ) === true ||
							is_page_template( 'template-home.php' )
						)
					) ||
					is_home()
				) {
					?>
					<h1 class="site-logo">
					<?php
				}

				the_custom_logo();

				if (
					(
						is_front_page() &&
						(
							cream_magazine_get_option( 'cream_magazine_enable_home_content' ) === true ||
							is_page_template( 'template-home.php' )
						)
					) ||
					is_home()
				) {
					?>
					</h1>
					<?php
				}
			} else {
				if (
					(
						is_front_page() &&
						(
							cream_magazine_get_option( 'cream_magazine_enable_home_content' ) === true ||
							is_page_template( 'template-home.php' )
						)
					) ||
					is_home()
				) {
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				} else {
					?>
					<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
					<?php
				}

				$site_description = get_bloginfo( 'description', 'display' );
				if ( $site_description || is_customize_preview() ) {
					?>
					<p class="site-description"><?php echo esc_html( $site_description ); // phpcs:ignore ?></p>
					<?php
				}
			}
			?>
		</div><!-- .logo -->
		<?php
	}
}
add_action( 'cream_magazine_site_identity', 'cream_magazine_site_identity_action', 10 );



if ( ! function_exists( 'cream_magazine_social_links_action' ) ) {
	/**
	 * Social links declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_social_links_action() {

		$show_on_new_tab = cream_magazine_get_option( 'cream_magazine_show_social_links_in_new_tab' );
		?>
		<ul class="social-icons">
			<?php
			$facebook_link = cream_magazine_get_option( 'cream_magazine_facebook_link' );
			if ( ! empty( $facebook_link ) ) {
				?>
				<li>
					<a
						href="<?php echo esc_url( $facebook_link ); ?>"
						<?php
						if ( $show_on_new_tab ) {
							?>
							target="_blank"
							<?php
						}
						?>
					><?php echo esc_html__( 'Facebook', 'cream-magazine' ); ?></a></li>
				<?php
			}

			$twitter_link = cream_magazine_get_option( 'cream_magazine_twitter_link' );
			if ( ! empty( $twitter_link ) ) {
				?>
				<li>
					<a
						href="<?php echo esc_url( $twitter_link ); ?>"
						<?php
						if ( $show_on_new_tab ) {
							?>
							target="_blank"
							<?php
						}
						?>
					><?php echo esc_html__( 'Twitter', 'cream-magazine' ); ?></a></li>
				<?php
			}

			$instagram_link = cream_magazine_get_option( 'cream_magazine_instagram_link' );
			if ( ! empty( $instagram_link ) ) {
				?>
				<li>
					<a
						href="<?php echo esc_url( $instagram_link ); ?>"
						<?php
						if ( $show_on_new_tab ) {
							?>
							target="_blank"
							<?php
						}
						?>
					><?php echo esc_html__( 'Instagram', 'cream-magazine' ); ?></a></li>
				<?php
			}

			$youtube_link = cream_magazine_get_option( 'cream_magazine_youtube_link' );
			if ( ! empty( $youtube_link ) ) {
				?>
				<li>
					<a
						href="<?php echo esc_url( $youtube_link ); ?>"
						<?php
						if ( $show_on_new_tab ) {
							?>
							target="_blank"
							<?php
						}
						?>
					><?php echo esc_html__( 'Youtube', 'cream-magazine' ); ?></a></li>
				<?php
			}

			$vk_link = cream_magazine_get_option( 'cream_magazine_vk_link' );
			if ( ! empty( $vk_link ) ) {
				?>
				<li>
					<a
						href="<?php echo esc_url( $vk_link ); ?>"
						<?php
						if ( $show_on_new_tab ) {
							?>
							target="_blank"
							<?php
						}
						?>
					><?php echo esc_html__( 'VK', 'cream-magazine' ); ?></a></li>
				<?php
			}

			$linkedin_link = cream_magazine_get_option( 'cream_magazine_linkedin_link' );
			if ( ! empty( $linkedin_link ) ) {
				?>
				<li>
					<a
						href="<?php echo esc_url( $linkedin_link ); ?>"
						<?php
						if ( $show_on_new_tab ) {
							?>
							target="_blank"
							<?php
						}
						?>
					><?php echo esc_html__( 'Linkedin', 'cream-magazine' ); ?></a></li>
				<?php
			}

			$vimeo_link = cream_magazine_get_option( 'cream_magazine_vimeo_link' );
			if ( ! empty( $vimeo_link ) ) {
				?>
				<li>
					<a
						href="<?php echo esc_url( $vimeo_link ); ?>"
						<?php
						if ( $show_on_new_tab ) {
							?>
							target="_blank"
							<?php
						}
						?>
					><?php echo esc_html__( 'Vimeo', 'cream-magazine' ); ?></a></li>
				<?php
			}
			?>
		</ul>
		<?php
	}
}
add_action( 'cream_magazine_social_links', 'cream_magazine_social_links_action', 10 );


if ( ! function_exists( 'cream_magazine_ticker_news_action' ) ) {
	/**
	 * Ticker news declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_ticker_news_action() {

		$news_ticker_section_title = cream_magazine_get_option( 'cream_magazine_ticker_news_title' );
		$news_ticker_post_cats     = cream_magazine_get_option( 'cream_magazine_ticker_news_categories' );
		$news_ticker_post_nos      = cream_magazine_get_option( 'cream_magazine_ticker_news_posts_no' );

		$news_ticker_args = array(
			'post_type'           => 'post',
			'ignore_sticky_posts' => true,
		);

		if ( ! empty( $news_ticker_post_cats ) ) {

			if ( cream_magazine_get_option( 'cream_magazine_save_value_as' ) === 'slug' ) {

				$news_ticker_args['category_name'] = implode( ',', $news_ticker_post_cats );
			} else {

				$news_ticker_args['cat'] = implode( ',', $news_ticker_post_cats );
			}
		}

		if ( absint( $news_ticker_post_nos ) > 0 ) {
			$news_ticker_args['posts_per_page'] = absint( $news_ticker_post_nos );
		} else {
			$news_ticker_args['posts_per_page'] = 6;
		}

		$news_ticker_query = new WP_Query( $news_ticker_args );

		if ( $news_ticker_query->have_posts() ) {
			?>
			<div class="news_ticker_wrap clearfix">
				<?php if ( ! empty( $news_ticker_section_title ) ) { ?>
					<div class="ticker_head">
						<span class="ticker_icon"><i class="fa fa-bolt" aria-hidden="true"></i></span>
						<div class="ticker_title"><?php echo esc_html( $news_ticker_section_title ); ?></div>
					</div><!-- .ticker_head -->
				<?php } ?>
				<div class="ticker_items">
					<div class="owl-carousel ticker_carousel">
						<?php
						while ( $news_ticker_query->have_posts() ) {
							$news_ticker_query->the_post();
							?>
							<div class="item">
								<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
							</div><!-- .item -->
							<?php
						}
						wp_reset_postdata();
						?>
					</div><!-- .owl-carousel -->
				</div><!-- .ticker_items -->
			</div><!-- .news_ticker_wrap.clearfix -->
			<?php
		}
	}
}
add_action( 'cream_magazine_ticker_news', 'cream_magazine_ticker_news_action', 10 );


if ( ! function_exists( 'cream_magazine_breadcrumb_action' ) ) {
	/**
	 * Breadcrumb declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_breadcrumb_action() {

		if ( is_front_page() ) {
			return;
		}

		$enable_breadcrumb = cream_magazine_get_option( 'cream_magazine_enable_breadcrumb' );

		$breadcrumb_class = '';

		if ( true === $enable_breadcrumb ) {

			$breadcrumb_source = cream_magazine_get_option( 'cream_magazine_breadcrumb_sources' );

			switch ( $breadcrumb_source ) {
				case 'yoast':
					$breadcrumb_class .= ' yoast-breadcrumb';
					break;
				case 'rank_math':
					$breadcrumb_class .= ' rank_math-breadcrumb';
					break;
				case 'bcn':
					$breadcrumb_class .= ' navxt-breadcrumb';
					break;
				default:
					$breadcrumb_class .= ' default-breadcrumb';
			}
			?>
			<div class="breadcrumb <?php echo ( $breadcrumb_class ) ? esc_attr( $breadcrumb_class ) : ''; ?>">
				<?php
				switch ( $breadcrumb_source ) {
					case 'yoast':
						yoast_breadcrumb();
						break;
					case 'rank_math':
						rank_math_the_breadcrumbs();
						break;
					case 'bcn':
						bcn_display();
						break;
					default:
						$breadcrumb_args = array(
							'show_browse' => false,
						);
						cream_magazine_breadcrumb_trail( $breadcrumb_args );
				}
				?>
			</div>
			<?php
		}
	}
}
add_action( 'cream_magazine_breadcrumb', 'cream_magazine_breadcrumb_action', 10 );


if ( ! function_exists( 'cream_magazine_pagination_action' ) ) {
	/**
	 * Pagination declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_pagination_action() {

		global $wp_query;

		if ( 1 !== $wp_query->max_num_pages ) {
			?>
			<div class="pagination">
				<?php
				the_posts_pagination(
					array(
						'mid_size'  => 2,
						'prev_text' => esc_html__( 'Prev', 'cream-magazine' ),
						'next_text' => esc_html__( 'Next', 'cream-magazine' ),
					)
				);
				?>
			</div>
			<?php
		}
	}
}
add_action( 'cream_magazine_pagination', 'cream_magazine_pagination_action', 10 );


if ( ! function_exists( 'cream_magazine_banner_slider_action' ) ) {
	/**
	 * Banner/Slider layout selection declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_banner_slider_action() {

		get_template_part( 'template-parts/banner/banner', 'five' );
	}
}
add_action( 'cream_magazine_banner_slider', 'cream_magazine_banner_slider_action', 10 );



if ( ! function_exists( 'cream_magazine_top_news_action' ) ) {
	/**
	 * Top news section contents declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_top_news_action() {

		if ( is_active_sidebar( 'home-top-news-area' ) ) {

			dynamic_sidebar( 'home-top-news-area' );
		}
	}
}
add_action( 'cream_magazine_top_news', 'cream_magazine_top_news_action', 10 );



if ( ! function_exists( 'cream_magazine_middle_news_action' ) ) {
	/**
	 * Middle news section contents declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_middle_news_action() {

		if ( is_active_sidebar( 'home-middle-news-area' ) ) {

			dynamic_sidebar( 'home-middle-news-area' );
		}
	}
}
add_action( 'cream_magazine_middle_news', 'cream_magazine_middle_news_action', 10 );



if ( ! function_exists( 'cream_magazine_bottom_news_action' ) ) {
	/**
	 * Bottom news section contents declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_bottom_news_action() {

		if ( is_active_sidebar( 'home-bottom-news-area' ) ) {

			dynamic_sidebar( 'home-bottom-news-area' );
		}
	}
}
add_action( 'cream_magazine_bottom_news', 'cream_magazine_bottom_news_action', 10 );



if ( ! function_exists( 'cream_magazine_page_wrapper_end_action' ) ) {
	/**
	 * Page Wapper End declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_page_wrapper_end_action() {
		?>
		</div><!-- .page_wrap -->
		<?php
	}
}
add_action( 'cream_magazine_page_wrapper_end', 'cream_magazine_page_wrapper_end_action', 10 );



if ( ! function_exists( 'cream_magazine_footer_wrapper_start_action' ) ) {
	/**
	 * Footer Wapper Start declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_footer_wrapper_start_action() {

		$footer_inner_class = 'footer_inner';

		if ( cream_magazine_get_option( 'cream_magazine_show_footer_widget_area' ) === false ) {

			$footer_inner_class .= ' no-footer-widget-areas';
		}
		?>
		<footer class="footer">
			<div class="<?php echo esc_attr( $footer_inner_class ); ?>">
				<div class="cm-container">
		<?php
	}
}
add_action( 'cream_magazine_footer_wrapper_start', 'cream_magazine_footer_wrapper_start_action', 10 );



if ( ! function_exists( 'cream_magazine_footer_widget_wrapper_start_action' ) ) {
	/**
	 * Footer Widget Wapper Start declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_footer_widget_wrapper_start_action() {

		$footer_widget_area_class = 'row footer-widget-container';

		$show_on_mobile_n_tablet = cream_magazine_get_option( 'cream_magazine_show_footer_widget_area_on_mobile_n_tablet' );

		if ( ! $show_on_mobile_n_tablet ) {

			$footer_widget_area_class .= ' hide-tablet hide-mobile';
		}
		?>
		<div class="<?php echo esc_attr( $footer_widget_area_class ); ?>">
		<?php
	}
}
add_action( 'cream_magazine_footer_widget_wrapper_start', 'cream_magazine_footer_widget_wrapper_start_action', 10 );


if ( ! function_exists( 'cream_magazine_left_footer_widgetarea_action' ) ) {
	/**
	 * Left Footer Widgetarea declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_left_footer_widgetarea_action() {
		?>
		<div class="cm-col-lg-4 cm-col-12">
			<div class="blocks">
				<?php
				if ( is_active_sidebar( 'footer-left' ) ) {

					dynamic_sidebar( 'footer-left' );
				}
				?>
			</div><!-- .blocks -->
		</div><!-- .cm-col-->
		<?php
	}
}
add_action( 'cream_magazine_left_footer_widgetarea', 'cream_magazine_left_footer_widgetarea_action', 10 );



if ( ! function_exists( 'cream_magazine_middle_footer_widgetarea_action' ) ) {
	/**
	 * Middle Footer Widgetarea declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_middle_footer_widgetarea_action() {
		?>
		<div class="cm-col-lg-4 cm-col-12">
			<div class="blocks">
				<?php
				if ( is_active_sidebar( 'footer-middle' ) ) {

					dynamic_sidebar( 'footer-middle' );
				}
				?>
			</div><!-- .blocks -->
		</div><!-- .cm-col-->
		<?php
	}
}
add_action( 'cream_magazine_middle_footer_widgetarea', 'cream_magazine_middle_footer_widgetarea_action', 10 );



if ( ! function_exists( 'cream_magazine_right_footer_widgetarea_action' ) ) {
	/**
	 * Right Footer Widgetarea declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_right_footer_widgetarea_action() {
		?>
		<div class="cm-col-lg-4 cm-col-12">
			<div class="blocks">
				<?php
				if ( is_active_sidebar( 'footer-right' ) ) {

					dynamic_sidebar( 'footer-right' );
				}
				?>
			</div><!-- .blocks -->
		</div><!-- .cm-col-->
		<?php
	}
}
add_action( 'cream_magazine_right_footer_widgetarea', 'cream_magazine_right_footer_widgetarea_action', 10 );


if ( ! function_exists( 'cream_magazine_footer_widget_wrapper_end_action' ) ) {
	/**
	 * Footer Widget Wapper End declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_footer_widget_wrapper_end_action() {
		?>
		</div><!-- .row -->
		<?php
	}
}
add_action( 'cream_magazine_footer_widget_wrapper_end', 'cream_magazine_footer_widget_wrapper_end_action', 10 );


if ( ! function_exists( 'cream_magazine_footer_copyright_wrapper_start_action' ) ) {
	/**
	 * Footer Copyright Wapper Start declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_footer_copyright_wrapper_start_action() {
		?>
		<div class="copyright_section">
		<div class="row">
		<?php
	}
}
add_action( 'cream_magazine_footer_copyright_wrapper_start', 'cream_magazine_footer_copyright_wrapper_start_action', 10 );



if ( ! function_exists( 'cream_magazine_copyright_action' ) ) {
	/**
	 * Copyright Declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_copyright_action() {

		$copyright_text = cream_magazine_get_option( 'cream_magazine_copyright_credit' );
		?>
		<div class="cm-col-lg-7 cm-col-md-6 cm-col-12">
			<div class="copyrights">
				<p>
					<?php
					if ( ! empty( $copyright_text ) ) {
						if ( str_contains( $copyright_text, '{copy}' ) ) {
							$copy_right_symbol = '&copy;';
							$copyright_text    = str_replace( '{copy}', $copy_right_symbol, $copyright_text );
						}

						if ( str_contains( $copyright_text, '{year}' ) ) {
							$year           = gmdate( 'Y' );
							$copyright_text = str_replace( '{year}', $year, $copyright_text );
						}

						if ( str_contains( $copyright_text, '{site_title}' ) ) {
							$title          = get_bloginfo( 'name' );
							$copyright_text = str_replace( '{site_title}', $title, $copyright_text );
						}

						if ( str_contains( $copyright_text, '{theme_author}' ) ) {
							$theme_author   = '<a href="https://themebeez.com" rel="author" target="_blank">Themebeez</a>';
							$copyright_text = str_replace( '{theme_author}', $theme_author, $copyright_text );
						}

						echo wp_kses_post( $copyright_text );

					}
					?>
				</p>
			</div>
		</div><!-- .col -->
		<?php
	}
}
add_action( 'cream_magazine_copyright', 'cream_magazine_copyright_action', 10 );





if ( ! function_exists( 'cream_magazine_footer_menu_action' ) ) {
	/**
	 * Footer menu declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_footer_menu_action() {
		?>
		<div class="cm-col-lg-5 cm-col-md-6 cm-col-12">
			<div class="footer_nav">
				<?php
				if ( has_nav_menu( 'menu-3' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'menu-3',
							'container'      => '',
							'depth'          => 1,
						)
					);
				}
				?>
			</div><!-- .footer_nav -->
		</div><!-- .col -->
		<?php
	}
}
add_action( 'cream_magazine_footer_menu', 'cream_magazine_footer_menu_action', 10 );



if ( ! function_exists( 'cream_magazine_footer_copyright_wrapper_end_action' ) ) {
	/**
	 * Footer Copyright Wapper End declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_footer_copyright_wrapper_end_action() {
		?>
		</div><!-- .row -->
		</div><!-- .copyright_section -->
		<?php
	}
}
add_action( 'cream_magazine_footer_copyright_wrapper_end', 'cream_magazine_footer_copyright_wrapper_end_action', 10 );


if ( ! function_exists( 'cream_magazine_footer_wrapper_end_action' ) ) {
	/**
	 * Footer Wapper End declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_footer_wrapper_end_action() {
		?>
		</div><!-- .cm-container -->
		</div><!-- .footer_inner -->
		</footer><!-- .footer -->
		<?php
	}
}
add_action( 'cream_magazine_footer_wrapper_end', 'cream_magazine_footer_wrapper_end_action', 10 );



if ( ! function_exists( 'cream_magazine_footer_action' ) ) {
	/**
	 * Footer Declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_footer_action() {

		wp_footer();
		?>
		</body>
		</html>
		<?php
	}
}
add_action( 'cream_magazine_footer', 'cream_magazine_footer_action', 10 );


if ( ! function_exists( 'cream_magazine_scroll_top_button_template' ) ) {
	/**
	 * Render scroll top button.
	 *
	 * @since 2.0.0
	 */
	function cream_magazine_scroll_top_button_template() {

		if ( cream_magazine_get_option( 'cream_magazine_enable_scroll_top_button' ) === true ) {
			?>
			<div class="backtoptop">
				<button id="toTop" class="btn btn-info">
					<i class="fa fa-angle-up" aria-hidden="true"></i>
				</button>
			</div><!-- ./ backtoptop -->
			<?php
		}
	}
}
add_action( 'cream_magazine_scroll_top_button', 'cream_magazine_scroll_top_button_template', 10 );
