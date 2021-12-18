<?php

namespace IslamQA\PostTypes;

use IslamQA\Interfaces\Hookable;
use IslamQA\Interfaces\CustomPostType;

class FatwaPostType implements CustomPostType, Hookable {
    use PostTypeLabelUtility;

    const KEY = 'fatwa';
    const GRAPHQL_SINGLE_NAME = 'Fatwa';

    public function register_hooks(): void {
        add_action( 'init', [ $this, 'register' ] );
    }

    public function register(): void {
        register_post_type( self::KEY, [
			'labels'              => $this->generate_labels( 'Fatwa', 'Fatwas' ),
            'public'              => true,
            'menu_icon'           => 'dashicons-welcome-write-blog',
            'supports'            => ['title', 'editor'],
            'show_in_graphql'     => true,
            'graphql_single_name' => self::GRAPHQL_SINGLE_NAME,
            'graphql_plural_name' => 'Fatwas',
		] );
    }
}
