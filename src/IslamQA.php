<?php

namespace IslamQA;

use IslamQA\Interfaces\Hookable;

/**
 * Main plugin class.
 */
final class IslamQA {
    /**
	 * Class instances.
	 */
	private $instances = [];

    /**
     * Main method for running the plugin
     */
    public function run() {
		$this->create_instances();
		$this->register_hooks();
    }

	private function create_instances() {
		$this->instances['fatwa_post_type']       = new PostTypes\FatwaPostType();
		$this->instances['fatwa_object_type']     = new WPGraphQL\Type\ObjectType\Fatwa();
		$this->instances['create_fatwa_mutation'] = new WPGraphQL\Mutation\CreateFatwa();
		$this->instances['update_fatwa_mutation'] = new WPGraphQL\Mutation\UpdateFatwa();
	}

	private function register_hooks() {
		foreach ( $this->get_hookable_instances() as $instance ) {
            $instance->register_hooks();
        }
	}

	private function get_hookable_instances() {
        return array_filter( $this->instances, function( $instance ) {
			return $instance instanceof Hookable;
		} );
    }
}
