<?php
/*
Plugin Name: Nurse Offer
Description: Allows patients to enter their case via a form, with the form information being stored in a custom database table.
*/


///////////////cases_table////////////////////////

function create_cases_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'cases';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        nurse_id bigint(20) unsigned ,
        PRIMARY KEY  (id),
        FOREIGN KEY (nurse_id) REFERENCES wp_users(ID)
        ON DELETE CASCADE 
        ON UPDATE CASCADE
    ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    $result = dbDelta( $sql );

    if ($result === false) {
        error_log('Failed to create the custom table.');
    } else {
        error_log('Custom table created successfully.');
    }
}

register_activation_hook(__FILE__, 'create_cases_table');



////////////////// offers_table/////////////////

function create_nurse_offer_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'offer';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        nurse_id bigint(20) unsigned,
        case_id bigint(20) unsigned,
        patient_name varchar(255) NOT NULL,
        patient_case varchar(255) NOT NULL,
        case_description text NULL,
        other_diseases varchar(3) NOT NULL,
        patient_address varchar(255) NOT NULL,
        time_of_service DATE(255) NOT NULL,
        type_of_services varchar(255) NOT NULL,
        date_submitted datetime NOT NULL,
        PRIMARY KEY  (id),
        FOREIGN KEY (nurse_id) REFERENCES wp_users(ID),
        FOREIGN KEY (case_id) REFERENCES {$wpdb->prefix}cases(id)

        ON DELETE CASCADE 
        ON UPDATE CASCADE
    ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    $result = dbDelta( $sql );

    if ($result === false) {
        error_log('Failed to create the custom table.');
    } else {
        error_log('Custom table created successfully.');
    }
}

register_activation_hook(__FILE__, 'create_nurse_offer_table');

//////// Add form shortcode//////////////////

add_shortcode( 'nurse_offer_form', 'render_nurse_offer_form' );
function render_nurse_offer_form() {
    ob_start(); 
    ?>
    <form id="nurse-offer-form" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
        <label for="patient-name">Patient Name:</label>
        <input type="text" id="patient-name" name="patient_name" required><br>

        <label for="patient-case">Patient Case:</label>
        <select id="patient-case" name="patient_case" required>
            <option value="Wound Care">Wound Care</option>
            <option value="Medication Management">Medication Management</option>
            <option value="Chronic Disease Management">Chronic Disease Management</option>
            <option value="Personal Care Assistance">Personal Care Assistance</option>
            <option value="Emotional Support and Companionship">Emotional Support and Companionship</option>
            <option value="Nutrition and Meal Assistance">Nutrition and Meal Assistance</option>
        </select><br>

        <label for="case-description">Case Description:(Optional)</label>
        <textarea id="case-description" name="case_description"></textarea><br>

        <label for="other-diseases">Other Diseases:</label>
        <input type="radio" id="other-diseases-yes" name="other_diseases" value="Yes"> Yes
        <input type="radio" id="other-diseases-no" name="other_diseases" value="No"> No<br>

        <label for="patient-address">Patient Address:</label>
        <input type="text" id="patient-address" name="patient_address" required><br>
        
        <label for="type-of-services">Type of Services:</label><br>
        <input type="radio" id="type-of-services-online" name="type_of_services" value="Online Treatment" required> Online Treatment<br>
        <input type="radio" id="type-of-services-home-care" name="type_of_services" value="Home Care" required> Home Care<br><br>

      <label for="date-of-service">Date of Service:</label><br>
<input type="date" id="date-of-service" name="date_of_service" required><br><br>


        <input type="hidden" name="action" value="submit_nurse_offer">
        <input type="submit" name="submit_nurse_offer" value="Submit">
    </form>
    <?php
    return ob_get_clean();
}

///////////////////////INSERT_FUNCTION////////////////////////////

add_action('admin_post_submit_nurse_offer', 'process_nurse_offer_form');
add_action('admin_post_nopriv_submit_nurse_offer', 'process_nurse_offer_form');

function process_nurse_offer_form() {
    if (isset($_POST['submit_nurse_offer'])) {
        global $wpdb;
        $offer_table_name = $wpdb->prefix . 'offer';
        $cases_table_name = $wpdb->prefix . 'cases';
        $patient_name = sanitize_text_field($_POST['patient_name']);
        $patient_case = sanitize_text_field($_POST['patient_case']);
        $case_description = sanitize_textarea_field($_POST['case_description']);
        $other_diseases = isset($_POST['other_diseases']) ? sanitize_text_field($_POST['other_diseases']) : '';
        $patient_address = sanitize_text_field($_POST['patient_address']);
        $type_of_services = sanitize_text_field($_POST['type_of_services']);
        $time_of_service = sanitize_text_field($_POST['time_of_service']);
        $date_submitted = current_time('mysql');

        $nurse_id = get_current_user_id();

        $wpdb->insert(
            $offer_table_name,
            array(
                'nurse_id' => $nurse_id,
                'patient_name' => $patient_name,
                'patient_case' => $patient_case,
                'case_description' => $case_description,
                'other_diseases' => $other_diseases,
                'patient_address' => $patient_address,
                'type_of_services' => $type_of_services,
                'time_of_service' => $time_of_service,
                'date_submitted' => $date_submitted
            ),
            array(
                '%d',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s'
            )
        );

        // Get the ID of the inserted row
        $offer_id = $wpdb->insert_id;

        // Insert nurse_id and offer_id into cases table
        $wpdb->insert(
            $cases_table_name,
            array(
                'nurse_id' => $nurse_id,
                'offer_id' => $offer_id,
            ),
            array(
                '%d',
                '%d',
            )
        );

        wp_redirect(home_url('/nurses/'));
        exit;
    }
}


//////////////Nurse_card/////////////////////


add_shortcode('display_nurse_cases', 'display_nurse_cases_shortcode');
function display_nurse_cases_shortcode($atts) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'offer';
    $cases = $wpdb->get_results("SELECT * FROM $table_name");

    if ($cases) {
        // Initialize output variable
        $output = '<div class="nurse-cases">';

        // Loop through each case and format it
        foreach ($cases as $case) {
            $output .= '<div class="nurse-case" style="background-color: lightgrey; padding: 15px; margin-bottom: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">';
            $output .= '<div class="case-header">';
            $output .= '<h3 class="case-title" style="margin-bottom: 5px; text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">' . esc_html($case->patient_name) . '</h3>';
            $output .= '<p class="case-date" style="font-style: italic; color: #666; font-size: 0.9em; text-shadow: 1px 1px 2px rgba(0,0,0,0.1);">Date Submitted: ' . esc_html($case->date_submitted) . '</p>';
            $output .= '</div>'; // Close case-header

            $output .= '<div class="case-details">';
            if (isset($case->patient_case)) {
                $output .= '<p><strong>Patient Case:</strong> ' . esc_html($case->patient_case) . '</p>';
            }
            if (isset($case->case_description)) {
                $output .= '<p><strong>Case Description:</strong> ' . esc_html($case->case_description) . '</p>';
            }
            if (isset($case->other_diseases)) {
                $output .= '<p><strong>Other Diseases:</strong> ' . esc_html($case->other_diseases) . '</p>';
            }
            if (isset($case->patient_address)) {
                $output .= '<p><strong>Patient Address:</strong> ' . esc_html($case->patient_address) . '</p>';
            }
            if (isset($case->type_of_services)) {
                $output .= '<p><strong>Type of Service:</strong> ' . esc_html($case->type_of_services) . '</p>';
            }
            if (isset($case->time_of_service)) {
                $output .= '<p><strong>Time of Service:</strong> ' . esc_html($case->time_of_service) . '</p>';
            }
            $output .= '</div>'; // Close case-details
            $output .= '</div>'; // Close nurse-case
        }

        // Close the container div
        $output .= '</div>';
    } else {
        // If there are no cases, display a message
        $output = '<p class="no-cases" style="background-color: #f0f0f0; padding: 15px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">No cases have been submitted yet.</p>';
    }

    return $output;
}




//////////////patient_card/////////////////////

add_shortcode('display_patient_cards', 'display_patient_cards_shortcode');
function display_patient_cards_shortcode($atts) {
    global $wpdb;

    $offer_table_name = $wpdb->prefix . 'offer';
    
    // Fetch all rows from the offer table
    $cases = $wpdb->get_results("SELECT * FROM $offer_table_name");

    // Check if there are any cases
    if ($cases) {
        // Initialize output variable
        $output = '<div class="patient-cards">';

        // Loop through each case and format it as a card
        foreach ($cases as $case) {
            $output .= '<div class="patient-card" style="background-color: #f5f5f5; color: #333; font-family: Arial, sans-serif; padding: 15px; margin-bottom: 20px;">';
            $output .= '<h3 style="margin-bottom: 10px;">' . esc_html($case->patient_name) . '</h3>';
            $output .= '<p style="margin-bottom: 5px;">Nurse ID: ' . esc_html($case->nurse_id) . '</p>';
            if (isset($case->patient_case)) {
                $output .= '<p style="margin-bottom: 5px;">Patient Case: ' . esc_html($case->patient_case) . '</p>';
            }
            if (isset($case->case_description)) {
                $output .= '<p style="margin-bottom: 5px;">Case Description: ' . esc_html($case->case_description) . '</p>';
            }
            if (isset($case->other_diseases)) {
                $output .= '<p style="margin-bottom: 5px;">Other Diseases: ' . esc_html($case->other_diseases) . '</p>';
            }
            if (isset($case->patient_address)) {
                $output .= '<p style="margin-bottom: 5px;">Patient Address: ' . esc_html($case->patient_address) . '</p>';
            }
            if (isset($case->type_of_services)) {
                $output .= '<p style="margin-bottom: 5px;">Type of Service: ' . esc_html($case->type_of_services) . '</p>';
            }
            if (isset($case->time_of_service)) {
                $output .= '<p style="margin-bottom: 5px;">Time of Service: ' . esc_html($case->time_of_service) . '</p>';
            }
            $output .= '<p style="margin-bottom: 5px;">Date Submitted: ' . esc_html($case->date_submitted) . '</p>';

            // Check type of service for button action
            if ($case->type_of_services === 'Online Treatment') {
                $output .= '<a href="' . home_url('/messages/') . '" class="btn btn-primary" style="display: inline-block; background-color: #007bff; color: #fff; padding: 8px 16px; text-decoration: none; border-radius: 4px;">Go to Chat</a>';
            } elseif ($case->type_of_services === 'Home Care') {
                $output .= '<a href="' . home_url('/tracking-service/') . '" class="btn btn-primary" style="display: inline-block; background-color: #007bff; color: #fff; padding: 8px 16px; text-decoration: none; border-radius: 4px;">Go to Your Status</a>';
            }

            $output .= '</div>'; // Close patient-card div
        }

        // Close the container div
        $output .= '</div>';
    } else {
        // If there are no cases, display a message
        $output = '<p>No cases have been submitted yet.</p>';
    }

    // Return the formatted output
    return $output;
}