<?php
/**
 * Block Editor Assets Manager
 *
 * @package FSE Theme
 */

declare ( strict_types = 1 );

namespace FSE;

/**
 * Block Editor Assets Manager
 */
class Block_Editor_Assets {

	/**
	 * Setup Hooks
	 *
	 * @return void
	 */
	public function setup_hooks(): void {
		add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_block_editor_assets' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_assets' ) );
	}

	/**
	 * Enqueue Block Editor Assets
	 *
	 * @return void
	 */
	public function enqueue_block_editor_assets(): void {
		$asset_data = include get_stylesheet_directory() . '/assets/blocks.asset.php';
		wp_enqueue_script(
			'block-registration',
			get_stylesheet_directory_uri() . '/assets/blocks.js',
			$asset_data['dependencies'],
			$asset_data['version'],
			true
		);

		wp_enqueue_style(
			'fse-theme-style',
			get_stylesheet_directory_uri() . '/assets/blocks.css',
			[],
			$asset_data['version']
		);
	}

	/**
	 * Enqueue Frontend Assets
	 *
	 * @return void
	 */
	public function enqueue_frontend_assets(): void {
		$asset_data = include get_stylesheet_directory() . '/assets/frontend.asset.php';
		wp_enqueue_style(
			'fse-theme-style',
			get_stylesheet_directory_uri() . '/assets/frontend.css',
			[],
			$asset_data['version'],
		);
		wp_enqueue_script(
			'fse-theme-script',
			get_stylesheet_directory_uri() . '/assets/frontend.js',
			$asset_data['dependencies'],
			$asset_data['version'],
			true
		);
	}
}
