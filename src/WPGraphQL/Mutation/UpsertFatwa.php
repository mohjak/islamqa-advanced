<?php

namespace IslamQA\WPGraphQL\Mutation;

use GraphQL\Error\UserError;

/**
 * Code used for both Fatwa creation and updates.
 */
trait UpsertFatwa {
    private function get_upsert_input_fields(): array {
        return [
            'fatwaNumber' => [
                'type'        => [ 'non_null' => 'String' ],
                'description' => __( 'Fatwa number', 'islamqa' ),
            ],
        ];
    }

    private function validate_fatwa_number( string $fatwa_number ): void {
        $min_length = 6;
        $is_valid_length = strlen( $fatwa_number ) >= $min_length;

        if ( ! $is_valid_length ) {
            throw new UserError( "Fatwa numbers must be at least {$min_length} characters long." );
        }

        $is_alphanumeric = ctype_alnum( $fatwa_number );

        if ( ! $is_alphanumeric ) {
            throw new UserError( 'Fatwa numbers must contain only letters and numbers.' );
        }
    }

    private function save_additional_upsert_data( int $post_id, array $input ): void {
        $fatwa_number_sanitized = sanitize_text_field( $input['fatwaNumber'] );

        update_post_meta( $post_id, 'fatwa_number', $fatwa_number_sanitized );
    }
}
