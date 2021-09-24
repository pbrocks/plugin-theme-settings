<?php
/**
 * Tabbed Menu on admin.php
 * 
 * @package plugin_theme_settings
 */


add_action( 'init', 'pbrocks_sample_admin_init' );
add_action( 'admin_menu', 'pbrocks_sample_settings_page_init', 13 );
/**
 * Undocumented function
 *
 * @return void
 */
function pbrocks_sample_admin_init() {
	$settings = get_option( 'pbrocks_sample_tabbed_settings' );
	if ( empty( $settings ) ) {
		$settings = array(
			'pbrocks_sample_intro'     => 'Some intro text for the home page',
			'pbrocks_sample_tag_class' => false,
			'pbrocks_sample_whatever'  => false,
		);
		add_option( 'pbrocks_sample_tabbed_settings', $settings, '', 'yes' );
	}
}

/**
 * Undocumented function
 *
 * @return void
 */
function pbrocks_sample_settings_page_init() {
			 $plugin_data = get_pbrocks_sample_setup_data();

	$slug          = preg_replace( '/_+/', '-', __FUNCTION__ );
	$label         = ucwords( preg_replace( '/_+/', ' ', __FUNCTION__ ) );
	$settings_page = add_menu_page( __( $plugin_data['Name'] . ' Settings', 'sidetrack-mailchimp' ), __( $plugin_data['Name'], 'sidetrack-mailchimp' ), 'manage_options', 'sidetrack-mailchimp', 'pbrocks_sample_settings_page' );
	add_action( "load-{$settings_page}", 'pbrocks_sample_load_settings_page' );
}

/**
 * Undocumented function
 *
 * @return void
 */
function pbrocks_sample_load_settings_page() {
	if ( isset( $_POST['sidetrack-mailchimp-settings-submit'] ) && $_POST['sidetrack-mailchimp-settings-submit'] === 'Y' ) {
		check_admin_referer( 'sidetrack-mailchimp-settings-page' );
		pbrocks_sample_save_tabbed_settings();
		$url_parameters = isset( $_GET['tab'] ) ? 'updated=true&tab=' . $_GET['tab'] : 'updated=true';
		wp_redirect( admin_url( 'admin.php?page=sidetrack-mailchimp&' . $url_parameters ) );
		exit;
	}
}

/**
 * Undocumented function
 *
 * @return void
 */
function pbrocks_sample_save_tabbed_settings() {
	global $pagenow;
	$settings = get_option( 'pbrocks_sample_tabbed_settings' );

	if ( $pagenow == 'admin.php' && $_GET['page'] == 'sidetrack-mailchimp' ) {
		if ( isset( $_GET['tab'] ) ) {
			$tab = $_GET['tab'];
		} else {
			$tab = 'textarea';
		}

		switch ( $tab ) {
			case 'front_tab':
				$settings['pbrocks_sample_tag_class'] = $_POST['pbrocks_sample_tag_class'];
				break;
			case 'checkbox':
				$settings['pbrocks_sample_tag_class'] = $_POST['pbrocks_sample_tag_class'];
				break;
			case 'text_input':
				$settings['pbrocks_sample_whatever'] = $_POST['pbrocks_sample_whatever'];
				break;
			case 'textarea':
				$settings['pbrocks_sample_intro'] = $_POST['pbrocks_sample_intro'];
				break;
		}
	}
	if ( ! current_user_can( 'unfiltered_html' ) ) {
		if ( $settings['pbrocks_sample_whatever'] ) {
			$settings['pbrocks_sample_whatever'] = stripslashes( esc_textarea( wp_filter_post_kses( $settings['pbrocks_sample_whatever'] ) ) );
		}
		if ( $settings['pbrocks_sample_intro'] ) {
			$settings['pbrocks_sample_intro'] = stripslashes( esc_textarea( wp_filter_post_kses( $settings['pbrocks_sample_intro'] ) ) );
		}
	}

	$updated = update_option( 'pbrocks_sample_tabbed_settings', $settings );
}

/**
 * Undocumented function
 *
 * @param string $current
 * @return void
 */
function pbrocks_sample_admin_tabs( $current = 'front_tab' ) {
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

/**
 * Undocumented function
 *
 * @return void
 */
function get_pbrocks_sample_setup_data() {
	$plugin_data['Name'] = 'Sidetrack Mailchimp';
	return $plugin_data;
}

/**
 * Undocumented function
 *
 * @return void
 */
function pbrocks_sample_settings_page() {
	global $pagenow;
	$settings    = get_option( 'pbrocks_sample_tabbed_settings' );
	$plugin_data = get_pbrocks_sample_setup_data();
	?>
	
	<div class="wrap">
		<h2><?php echo __( $plugin_data['Name'] . ' Settings', 'sidetrack-mailchimp' ); ?></h2>
		<style type="text/css">

	</style>
	<?php
	if ( isset( $_GET['updated'] ) && 'true' === esc_attr( $_GET['updated'] ) ) {
		echo '<div class="updated" ><p>' . __( 'Settings updated.', 'sidetrack-mailchimp' ) . '</p></div>';
	}

	if ( isset( $_GET['tab'] ) ) {
		pbrocks_sample_admin_tabs( $_GET['tab'] );
	} else {
		pbrocks_sample_admin_tabs( 'front_tab' );
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
								<label for="pbrocks_sample_intro">
								<?php echo __( 'Checkbox Settings', 'sidetrack-mailchimp' ); ?>
								</label>
							</h4>
							<p>
								<input id="pbrocks_sample_tag_class" name="pbrocks_sample_tag_class" type="checkbox" 
								<?php
								if ( $settings['pbrocks_sample_tag_class'] ) {
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
								<h4><label for="pbrocks_sample_whatever">Text Input settings</label></h4>
								<p>
									<input class="wide" placeholder="pbrocks_sample_intro" id="pbrocks_sample_intro" name="pbrocks_sample_intro" value="<?php echo esc_html( stripslashes( $settings['pbrocks_sample_intro'] ) ); ?>" /><br>
									<span class="description">Enter your Google tracking code:</span>
								</p>
							</article>
							<?php
							break;
						case 'textarea':
							?>
							<aside class="sidebar"><?php echo __( 'Sidebar', 'sidetrack-mailchimp' ); ?></aside>
							<article class="content">
								<h4><label for="pbrocks_sample_whatever">Textarea settings</label></h4>
								<p>
									<textarea id="pbrocks_sample_intro" name="pbrocks_sample_intro" cols="60" rows="5" ><?php echo esc_html( stripslashes( $settings['pbrocks_sample_intro'] ) ); ?></textarea><br/>
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
									<label for="pbrocks_sample_intro">
										<?php echo __( 'Current Settings', 'sidetrack-mailchimp' ); ?>
									</label>
								</h4>
								<p>
									<?php
										$saved_settings = get_option( 'pbrocks_sample_tabbed_settings' );
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
								$saved_settings = get_option( 'pbrocks_sample_tabbed_settings' );
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
