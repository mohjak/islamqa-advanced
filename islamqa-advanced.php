<?php

/**
 * Plugin Name: IslamQA Advanced
 * Description: A WordPress plugin to extend WPGrapQL functionalites.
 * Version:     0.1.0
 * Author:      Mohammad Jaqmaqji
 * Author URI:  https://github.com/mohjak
 * License:     MIT
 * License URI: https://github.com/mohjak/islamqa-advanced/LICENSE
 */

add_action('plugins_loaded', function () {
    $autoload = plugin_dir_path(__FILE__) . 'vendor/autoload.php';

    $dependencies = [
        'Composer autoload files' => is_readable($autoload),
        'WPGraphQL' => class_exists('WPGraphQL'),
    ];

    $missing_dependencies = array_keys(array_diff($dependencies, array_filter($dependencies)));

    $display_admin_notice = function () use ($missing_dependencies) {
?>
        <div class="notice notice-error">
            <p>The IslamQA core plugin can't be loaded because these dependencies are missing:</p>
            <ul>
                <?php foreach ($missing_dependencies as $missing_dependency) : ?>
                    <li><?php echo esc_html($missing_dependency); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
<?php
    };

    // If dependencies are missing, display admin notice and return early.
    if ($missing_dependencies) {
        add_action('admin_notices', $display_admin_notice);
        add_action('network_admin_notices', $display_admin_notice); // Needed for multisite only.

        return;
    }

    require_once $autoload;

    (new IslamQA\IslamQA() )->run();
});
