<?php
/**
 * Functions to create custom posts
 * @package 
 */


class quorania_microsite_custom_post_type {
		
	/*
	 *  construct
	 */	
	public function __construct() {
		
		$this->settings_init();	
		
	}

	/*
	 *  settings_init
	 */			
	public function settings_init() {
		
		// Register Posts types
		add_action( 'init', [ $this, 'add_floor_post_type' ] );
		add_action( 'init', [ $this, 'add_parking_boxroom_post_type' ] );
		add_action( 'init', [ $this, 'add_building_taxonomy' ] );
		
	}

	/*
	 *  Register floor post type
	 */	
	public function add_floor_post_type() {
		
		$labels = [
			"name" => __( "Pisos", "quorania-microsite" ),
			"singular_name" => __( "Piso", "quorania-microsite" ),
		];
		
		$args = [
			"label" => __( "Pisos", "quorania-microsite" ),
			"labels" => $labels,
			'public' => true,
			'publicly_queryable' => false,
			'exclude_from_search' => true,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 5, 
			'menu_icon' => 'dashicons-admin-home',
			'has_archive' => false,
			'capability_type' => 'post',
			'hierarchical' => false,
			"supports" => [ "title", "custom-fields" ],
		];
		
		register_post_type( "floor", $args );		
	}

	/*
	 *  Register parking boxroom post type
	 */	
	public function add_parking_boxroom_post_type() {
		
		$labels = [
			"name" => __( "Parqueo o trasteros", "quorania-microsite" ),
			"singular_name" => __( "Parqueo o trasteros", "quorania-microsite" ),
		];
		
		$args = [
			"label" => __( "Parqueo o trasteros", "quorania-microsite" ),
			"labels" => $labels,
			'public' => true,
			'publicly_queryable' => false,
			'exclude_from_search' => true,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 5, 
			'menu_icon' => 'dashicons-admin-generic',
			'has_archive' => false,
			'capability_type' => 'post',
			'hierarchical' => false,
			"supports" => [ "title", "custom-fields" ],
		];
		
		register_post_type( "parking_boxroom", $args );		
	}

	/*
	 *  Register building taxonomy
	 */	
	public function add_building_taxonomy() {

		$labels = [
			"name" => __( "Edificios", "quorania-microsite" ),
			"singular_name" => __( "Edificio", "quorania-microsite" ),
		];

		$args = array(
			'publicly_queryable' => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_in_menu'      => true,
			'query_var'         => true,
		);

		register_taxonomy( 'building', array( 'parking_boxroom', 'floor' ), $args );
	}
}

new quorania_microsite_custom_post_type();
	
