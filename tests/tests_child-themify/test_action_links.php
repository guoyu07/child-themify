<?php

class WP_Test_CTF_Action_Links extends WP_UnitTestCase {

	/**
	 * @var WP_User
	 */
	protected $user;

	/**
	 * @var WP_Theme
	 */
	protected $theme;

	public function setUp() {
		parent::setUp();
		$this->user = $this->factory->users->create();
		$this->user->add_cap( 'install_themes' );
		if ( is_multisite() ) {
			grant_super_admin( $this->user->ID );
		}
		$this->theme = wp_get_theme();
	}

	public function test_get_link_regular() {
		if ( is_multisite() ) {
			$this->markTestSkipped();
			return;
		}
		$theme_slug = $this->theme->get_stylesheet();
		$args = array(
			'action' => 'child-themify',
			'theme' => $theme_slug,
			'_ctf_nonce' => wp_create_nonce( "child_themify_$theme_slug" ),
		);
		$link = add_query_arg( $args, admin_url( 'themes.php' ) );
		$this->assertEquals( $link, CTF_Babymaker::getLink( $theme_slug ) );
	}

	/**
	 * @runInSeparateProcess
	 */
	public function test_get_link_network() {
		if ( !is_multisite() ) {
			$this->markTestSkipped();
			return;
		}
		define( 'WP_NETWORK_ADMIN', true );
		$theme_slug = $this->theme->get_stylesheet();
		$args = array(
			'action' => 'child-themify',
			'theme' => $theme_slug,
			'_ctf_nonce' => wp_create_nonce( "child_themify_$theme_slug" ),
		);
		$link = add_query_arg( $args, network_admin_url( 'themes.php' ) );
		$this->assertEquals( $link, CTF_Babymaker::getLink( $theme_slug ) );
	}

	/**
	 * @runInSeparateProcess
	 */
	public function test_action_links() {
		$theme_slug = $this->theme->get_stylesheet();
		$links = CTF_Babymaker::moodLighting( array( ), $this->theme );
		$this->assertInternalType( 'array', $links );
		$this->assertArrayHasKey( 'child-themify', $links );
		$link = CTF_Babymaker::getLink( $theme_slug );
		$this->assertContains( $link, $links['child-themify'] );
		define( 'DISALLOW_FILE_MODS', true );
		$links = CTF_Babymaker::moodLighting( array( ), $this->theme );
		$this->assertInternalType( 'array', $links );
		$this->assertArrayNotHasKey( 'child-themify', $links );
	}

}
