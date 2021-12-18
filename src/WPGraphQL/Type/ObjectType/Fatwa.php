<?php

namespace IslamQA\WPGraphQL\Type\ObjectType;

use WPGraphQL\Model\Post;
use IslamQA\Interfaces\Hookable;
use IslamQA\PostTypes\FatwaPostType;

class Fatwa implements Hookable {
    public function register_hooks(): void {
        add_action( 'graphql_register_types', [ $this, 'register_fields' ] );
    }

    public function register_fields(): void {
        register_graphql_fields(
            FatwaPostType::GRAPHQL_SINGLE_NAME,
            [
                'fatwaNumber' => [
                    'type'        => 'String',
                    'description' => __( 'Fatwa number', 'islamqa' ),
                    'resolve'     => function( Post $fatwa ) {
                        $fatwa_number = get_post_meta( $fatwa->ID, 'fatwa_number', true );

                        return $fatwa_number ?: null;
                    }
                ],
            ]
        );
    }
}
