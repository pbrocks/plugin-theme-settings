<?php
/**
 * Tabbed Submenu on admin.php
 */


add_action( 'init', 'sidetrack_mailchimp_admin_init' );
add_action( 'admin_menu', 'sidetrack_mailchimp_settings_page_init', 13 );
function sidetrack_mailchimp_admin_init() {
			 $settings = get_option( 'sidetrack_mailchimp_tabbed_settings' );
	if ( empty( $settings ) ) {
		$settings = array(
			'sidetrack_mailchimp_intro'     => 'Some intro text for the home page',
			'sidetrack_mailchimp_tag_class' => false,
			'sidetrack_mailchimp_whatever'  => false,
		);
		add_option( 'sidetrack_mailchimp_tabbed_settings', $settings, '', 'yes' );
	}
}

function sidetrack_mailchimp_settings_page_init() {
			 $plugin_data = get_sidetrack_mailchimp_setup_data();

	$slug          = preg_replace( '/_+/', '-', __FUNCTION__ );
	$label         = ucwords( preg_replace( '/_+/', ' ', __FUNCTION__ ) );
	$settings_page = add_menu_page( __( $plugin_data['Name'] . ' Settings', 'sidetrack-mailchimp' ), __( $plugin_data['Name'], 'sidetrack-mailchimp' ), 'manage_options', 'sidetrack-mailchimp', 'sidetrack_mailchimp_settings_page' );
	add_action( "load-{$settings_page}", 'sidetrack_mailchimp_load_settings_page' );
}

function sidetrack_mailchimp_load_settings_page() {
	if ( isset( $_POST['sidetrack-mailchimp-settings-submit'] ) && $_POST['sidetrack-mailchimp-settings-submit'] === 'Y' ) {
		check_admin_referer( 'sidetrack-mailchimp-settings-page' );
		sidetrack_mailchimp_save_tabbed_settings();
		$url_parameters = isset( $_GET['tab'] ) ? 'updated=true&tab=' . $_GET['tab'] : 'updated=true';
		wp_redirect( admin_url( 'admin.php?page=sidetrack-mailchimp&' . $url_parameters ) );
		exit;
	}
}

function sidetrack_mailchimp_save_tabbed_settings() {
	global $pagenow;
	$settings = get_option( 'sidetrack_mailchimp_tabbed_settings' );

	if ( $pagenow == 'admin.php' && $_GET['page'] == 'sidetrack-mailchimp' ) {
		if ( isset( $_GET['tab'] ) ) {
			$tab = $_GET['tab'];
		} else {
			$tab = 'textarea';
		}

		switch ( $tab ) {
			case 'front_tab':
				$settings['sidetrack_mailchimp_tag_class'] = $_POST['sidetrack_mailchimp_tag_class'];
				break;
			case 'checkbox':
				$settings['sidetrack_mailchimp_tag_class'] = $_POST['sidetrack_mailchimp_tag_class'];
				break;
			case 'text_input':
				$settings['sidetrack_mailchimp_whatever'] = $_POST['sidetrack_mailchimp_whatever'];
				break;
			case 'textarea':
				$settings['sidetrack_mailchimp_intro'] = $_POST['sidetrack_mailchimp_intro'];
				break;
		}
	}
	if ( ! current_user_can( 'unfiltered_html' ) ) {
		if ( $settings['sidetrack_mailchimp_whatever'] ) {
			$settings['sidetrack_mailchimp_whatever'] = stripslashes( esc_textarea( wp_filter_post_kses( $settings['sidetrack_mailchimp_whatever'] ) ) );
		}
		if ( $settings['sidetrack_mailchimp_intro'] ) {
			$settings['sidetrack_mailchimp_intro'] = stripslashes( esc_textarea( wp_filter_post_kses( $settings['sidetrack_mailchimp_intro'] ) ) );
		}
	}

	$updated = update_option( 'sidetrack_mailchimp_tabbed_settings', $settings );
}

function sidetrack_mailchimp_admin_tabs( $current = 'front_tab' ) {
	$tabs  = array(
		'front_tab'  => __( 'Home', 'sidetrack-mailchimp' ),
		'textarea'   => __( 'Textarea', 'sidetrack-mailchimp' ),
		'checkbox'   => __( 'Checkbox', 'sidetrack-mailchimp' ),
		'text_input' => __( 'Text Input', 'sidetrack-mailchimp' ),
	);
	$links = array();
	echo '<div id="icon-themes" class="icon32"><br></div>';
	echo '<h2 class="nav-tab-wrapper">';
	foreach ( $tabs as $tab => $name ) {
		$class = ( $tab == $current ) ? ' nav-tab-active' : '';
		echo "<a class='nav-tab$class' href='?page=sidetrack-mailchimp&tab=$tab'>$name</a>";
	}
	echo '</h2>';
}

function get_sidetrack_mailchimp_setup_data() {
			 $plugin_data['Name'] = 'Sidetrack Mailchimp';
	return $plugin_data;
}
function sidetrack_mailchimp_settings_page() {
	global $pagenow;
	$settings    = get_option( 'sidetrack_mailchimp_tabbed_settings' );
	$plugin_data = get_sidetrack_mailchimp_setup_data();
	?>
	
	<div class="wrap">
		<h2><?php echo __( $plugin_data['Name'] . ' Settings', 'sidetrack-mailchimp' ); ?></h2>
		<style type="text/css">
		h1, p {
			margin: 0 0 1em 0;
		}

		/**
		 * no grid support? 
		 */
		.sidebar {
			float: left;
		}

		.content {
			float: right;
		}

		/**
		 * make a grid 
		 */
		.grid-wrapper {
			margin: 0 auto;
			display: grid;
			grid-template-columns: 1fr 4fr;
			grid-gap: .5rem;
		}

		.grid-wrapper > * {
			background-color: mintcream;
			color: maroon;
			border-radius: .2rem;
			padding: 1rem;
			font-size: 150%;
			/* needed for the floated layout*/
			margin-bottom: .5rem;
		}
		h4 {
			margin: 0 0 1rem;
		}
		.header, .footer {
			grid-column: 1 / -1;
			/* needed for the floated layout */
			clear: both;
		}

		#poststuff > form > div > article > pre {
			white-space: pre-wrap;
		}

		input.wide {
			width: 77%;
			line-height: 2;
		}
/*      input:not(.button-primary),
		input:not(input[type=checkbox]) {
			width: 77%;
			line-height: 2;
			#poststuff > form > div > article > pre
		}*/
		
		/**
		 * We need to set the widths used on floated items back to auto, and remove the bottom margin as when we have grid we have gaps.
		 * @param  {[type]} display: grid          [description]
		 * @return {[type]}          [description]
		 */
		@supports (display: grid) {
			.grid-wrapper > * {
				width: auto;
				margin: 0;
			}
		}
	</style>
	<?php
	if ( isset( $_GET['updated'] ) && 'true' === esc_attr( $_GET['updated'] ) ) {
		echo '<div class="updated" ><p>' . __( 'Settings updated.', 'sidetrack-mailchimp' ) . '</p></div>';
	}

	if ( isset( $_GET['tab'] ) ) {
		sidetrack_mailchimp_admin_tabs( $_GET['tab'] );
	} else {
		sidetrack_mailchimp_admin_tabs( 'front_tab' );
	}
	?>

	<div id="poststuff">
			<form method="post" action="<?php admin_url( 'admin.php?page=sidetrack-mailchimp' ); ?>">
		<div class="grid-wrapper">
			<header class="header"><?php echo __( 'The header area', 'sidetrack-mailchimp' ); ?> | <?php echo ( isset( $_GET['tab'] ) ? $_GET['tab'] : 'front_tab' ); ?></header>
				<?php
				wp_nonce_field( 'sidetrack-mailchimp-settings-page' );

				if ( $pagenow == 'admin.php' && $_GET['page'] == 'sidetrack-mailchimp' ) {
					if ( isset( $_GET['tab'] ) ) {
						$tab = $_GET['tab'];
					} else {
						$tab = 'textarea';
					}

					echo '<table class="form-table">';
					switch ( $tab ) {
						case 'checkbox':
							?>
						<aside class="sidebar"><?php echo __( 'Sidebar', 'sidetrack-mailchimp' ); ?></aside>
						<article class="content">
							<h4>
								<label for="sidetrack_mailchimp_intro">
								<?php echo __( 'Checkbox Settings', 'sidetrack-mailchimp' ); ?>
								</label>
							</h4>
							<p>
								<input id="sidetrack_mailchimp_tag_class" name="sidetrack_mailchimp_tag_class" type="checkbox" 
								<?php
								if ( $settings['sidetrack_mailchimp_tag_class'] ) {
									echo 'checked="checked"';
								}
								?>
									value="true" /> 
									<span class="description">Output each post tag with a specific CSS class using its slug.</span>
								</p>
							</article>
							<?php
							break;
						case 'text_input':
							?>
							<aside class="sidebar"><?php echo __( 'Sidebar', 'sidetrack-mailchimp' ); ?></aside>                        
							<article class="content">
								<h4><label for="sidetrack_mailchimp_whatever">Text Input settings</label></h4>
								<p>
									<input class="wide" placeholder="sidetrack_mailchimp_intro" id="sidetrack_mailchimp_intro" name="sidetrack_mailchimp_intro" value="<?php echo esc_html( stripslashes( $settings['sidetrack_mailchimp_intro'] ) ); ?>" /><br>
									<span class="description">Enter your Google tracking code:</span>
								</p>
							</article>
							<?php
							break;
						case 'textarea':
							?>
							<aside class="sidebar"><?php echo __( 'Sidebar', 'sidetrack-mailchimp' ); ?></aside>
							<article class="content">
								<h4><label for="sidetrack_mailchimp_whatever">Textarea settings</label></h4>
								<p>
									<textarea id="sidetrack_mailchimp_intro" name="sidetrack_mailchimp_intro" cols="60" rows="5" ><?php echo esc_html( stripslashes( $settings['sidetrack_mailchimp_intro'] ) ); ?></textarea><br/>
									<span class="description">Enter the introductory text for the home page:</span>
								</p>
							</article>
							<?php
							break;
						case 'front_tab':
							?>
							<aside class="sidebar"><?php echo __( 'Sidebar', 'sidetrack-mailchimp' ); ?></aside>                        
							<article class="content">
								<h4>
									<label for="sidetrack_mailchimp_intro">
										<?php echo __( 'Current Settings', 'sidetrack-mailchimp' ); ?>
									</label>
								</h4>
								<p>
									<?php
										$saved_settings = get_option( 'sidetrack_mailchimp_tabbed_settings' );
										echo '<pre>$saved_settings ';
										print_r( $saved_settings );
										echo '</pre>';
									?>
								</p>
							</article>
							<?php
							break;
					}
						echo '</table>';
				}
				?>
					<footer class="footer"><?php echo __( 'The Footer Area', 'sidetrack-mailchimp' ); ?>
					<?php echo ( isset( $_GET['tab'] ) ? $_GET['tab'] : 'front_tab' ); ?>
						<?php if ( isset( $_GET['tab'] ) && 'front_tab' !== $_GET['tab'] ) { ?>
						<p class="submit" style="clear: both;">
							<input type="submit" name="Submit"  class="button-primary" value="Update Settings" />
							<input type="hidden" name="sidetrack-mailchimp-settings-submit" value="Y" />
						</p>
						<p>
							<?php
								$saved_settings = get_option( 'sidetrack_mailchimp_tabbed_settings' );
								echo '<pre>$saved_settings ';
								print_r( $saved_settings );
								echo '</pre>';
							?>
						</p>
						<?php } ?>
					</footer>
				</div>
			</form>
		</div>
	</div>
	<?php
}
