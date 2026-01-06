<?php
/**
 * Help Panel.
 *
 * @package Remote_Startup_Solutions
 */
?>

<div id="help-panel" class="panel-left visible">

    <div class="panel-aside active">
        <h4><?php printf( esc_html__( ' DEMO CONTENT IMPORTER', 'remote-startup-solutions' )); ?></h4>
        <p><?php esc_html_e( 'Your journey to a powerful and stylish website begins here. Let’s get everything set up in just a few clicks!', 'remote-startup-solutions' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url(admin_url('themes.php?page=remotestartupsolutions-wizard')); ?>" title="<?php esc_attr_e( 'Demo Importer', 'remote-startup-solutions' ); ?>" target="_blank">
            <?php esc_html_e( 'DEMO IMPORTER', 'remote-startup-solutions' ); ?>
        </a>
    </div>

    <div class="panel-aside active">
        <h4><?php printf( esc_html__( ' VISIT FREE DOCUMENTATION', 'remote-startup-solutions' )); ?></h4>
        <p><?php esc_html_e( 'Are you a newcomer to the WordPress universe? Our comprehensive and user-friendly documentation guide is designed to assist you in effortlessly building a captivating and interactive website, even if you lack any coding expertise or prior experience. Follow our step-by-step instructions to create a visually appealing and engaging online presence.', 'remote-startup-solutions' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( REMOTE_STARTUP_SOLUTION_FREE_DOC_URL ); ?>" title="<?php esc_attr_e( 'Visit the Documentation', 'remote-startup-solutions' ); ?>" target="_blank">
            <?php esc_html_e( 'FREE DOCUMENTATION', 'remote-startup-solutions' ); ?>
        </a>
    </div>

    <div class="panel-aside">
        <h4><?php esc_html_e( 'Review', 'remote-startup-solutions' ); ?></h4>
        <p><?php esc_html_e( 'If you are passionate about the Remote Startup Solutions theme, we would love to hear your thoughts and feedback regarding our theme. Your review will be highly valuable to us as we strive to enhance and improve our theme based on the needs and preferences of our users. Your opinion matters, and we sincerely appreciate your time and effort in sharing your experience with the Remote Startup Solutions theme.', 'remote-startup-solutions' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( REMOTE_STARTUP_SOLUTION_REVIEW_URL ); ?>" title="<?php esc_attr_e( 'Visit the Review', 'remote-startup-solutions' ); ?>" target="_blank">
            <?php esc_html_e( 'REVIEW', 'remote-startup-solutions' ); ?>
        </a>
    </div>
    
    <div class="panel-aside">
        <h4><?php esc_html_e( 'CONTACT SUPPORT', 'remote-startup-solutions' ); ?></h4>
        <p>
            <?php esc_html_e( 'Thank you for choosing Remote Startup Solutions! We appreciate your interest in our theme and are here to assist you with any support you may need.', 'remote-startup-solutions' ); ?></p>
        <a class="button button-primary" href="<?php echo esc_url( REMOTE_STARTUP_SOLUTION_SUPPORT_URL ); ?>" title="<?php esc_attr_e( 'Visit the Support', 'remote-startup-solutions' ); ?>" target="_blank">
            <?php esc_html_e( 'CONTACT SUPPORT', 'remote-startup-solutions' ); ?>
        </a>
    </div>

    
</div>