<?php
/**
 * Statify frontend tests.
 *
 * @package Statify
 */

namespace Statify;

use WP_UnitTestCase;

/**
 * Class Test_Frontend.
 * Tests for frontend integration.
 */
class Test_Frontend extends WP_UnitTestCase {
	use Statify_Test_Support;

	/**
	 * Test wp_footer() generation.
	 */
	public function test_wp_footer() {
		// Disable JS tracking.
		$this->init_statify_tracking( Statify::TRACKING_METHOD_DEFAULT );
		$this->assertNotFalse(
			has_action( 'wp_footer', array( 'Statify\Frontend', 'wp_footer' ) ),
			'Statify footer action not registered'
		);

		Frontend::wp_footer();
		$this->assertFalse(
			wp_script_is( 'statify-js', 'enqueued' ),
			'Statify JS should not be enqueued if JS tracking is disabled'
		);

		// Enable JS tracking.
		$this->init_statify_tracking( Statify::TRACKING_METHOD_JAVASCRIPT_WITH_NONCE_CHECK );

		Frontend::wp_footer();
		$this->assertTrue(
			wp_script_is( 'statify-js', 'enqueued' ),
			'Statify JS must be equeued if JS tracking is enabled'
		);
		$script_data = wp_scripts()->registered['statify-js']->extra['data'];
		$this->assertNotNull( $script_data, 'Statify script not localized' );
		$this->assertMatchesRegularExpression(
			'/^var statifyAjax = {"url":"[^"]+","nonce":"[^"]+"};$/',
			$script_data,
			'unexpected JS localization values'
		);
	}

	/**
	 * Test query_vars() integration.
	 */
	public function test_query_vars() {
		Statify::init();
		$this->assertNotFalse(
			has_action(
				'query_vars',
				array( 'Statify\Frontend', 'query_vars' )
			),
			'Statify query_vars action not registered'
		);

		$vars = Frontend::query_vars( array() );
		$this->assertCount( 2, $vars, 'Unexpected number of query vars' );
		$this->assertContains( 'statify_referrer', $vars, 'Referrer variable not declared' );
		$this->assertContains( 'statify_target', $vars, 'Target variable not declared' );
	}
}
