<?php

namespace IslamQA\PostTypes;

trait PostTypeLabelUtility {
    /**
     * Generate labels for a post type.
	 *
	 * @param string $singular          Uppercase, singular label.
	 * @param string $plural            Uppercase, plural label.
	 * @param array  $additional_labels Additional labels.
	 *
	 * @return array Labels.
     */
	protected function generate_labels( string $singular, string $plural, array $additional_labels = [] ): array {
		$labels = [
			'name'                  => _x( $plural, 'post type general name', 'islamqa' ),
			'singular_name'         => _x( $singular, 'post type singular name', 'islamqa' ),
			'menu_name'             => _x( $plural, 'admin menu', 'islamqa' ),
			'name_admin_bar'        => _x( $singular, 'add new on admin bar', 'islamqa' ),
			'add_new'               => _x( 'Add New', $singular, 'islamqa' ),
			'add_new_item'          => __( "Add New {$singular}", 'islamqa' ),
			'new_item'              => __( "New {$singular}", 'islamqa' ),
			'edit_item'             => __( "Edit {$singular}", 'islamqa' ),
			'view_item'             => __( "View {$singular}", 'islamqa' ),
			'all_items'             => __( "All {$plural}", 'islamqa' ),
			'search_items'          => __( "Search {$plural}", 'islamqa' ),
			'parent_item_colon'     => __( "Parent {$plural}:", 'islamqa' ),
			'not_found'             => __( "No {$plural} found.", 'islamqa' ),
			'not_found_in_trash'    => __( "No {$plural} found in Trash.", 'islamqa' ),
			'archives'              => __( "{$singular} Archives", 'islamqa' ),
            'update_item'           => __( "Update {$singular}", 'islamqa' ),
            'insert_into_item'      => __( "Insert into {$singular}", 'islamqa' ),
            'uploaded_to_this_item' => __( "Uploaded to this {$singular}", 'islamqa' ),
            'items_list'            => __( "{$plural} list", 'islamqa' ),
            'items_list_navigation' => __( "{$plural} list navigation", 'islamqa' ),
            'filter_items_list'     => __( "Filter {$plural} list", 'islamqa' ),
		];

		return array_merge( $labels, $additional_labels );
	}
}
