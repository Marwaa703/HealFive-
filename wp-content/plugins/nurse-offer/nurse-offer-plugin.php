<?php
/*
Plugin Name: Nurse Offer
Description: Allows patients to enter their case via a form, with the form information being stored in a custom table.
Version: 1.0.0
Author: Healfive Team.
*/


///////////////cases_table////////////////////////

function create_cases_table()
{
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
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    $result = dbDelta($sql);

    if ($result === false) {
        error_log('Failed to create the custom table.');
    } else {
        error_log('Custom table created successfully.');
    }
}

register_activation_hook(__FILE__, 'create_cases_table');



////////////////// noffers_table/////////////////

function create_nurse_offer_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'nurse_offers';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        nurse_id bigint(20) unsigned,
        user_id bigint(20) unsigned,
        patient_name varchar(255) NOT NULL,
        gender varchar(255) NOT NULL,
        patient_case varchar(255) NOT NULL,
        case_description text NULL,
        other_diseases varchar(3) NOT NULL,
        patient_address varchar(255) NOT NULL,
        time_of_service DATE NOT NULL,
        type_of_services varchar(255) NOT NULL,
        date_submitted datetime NOT NULL,
        status varchar(255) NOT NULL,
        PRIMARY KEY  (id),
        FOREIGN KEY (nurse_id) REFERENCES wp_users(ID)
        ON DELETE CASCADE 
        ON UPDATE CASCADE
    ) $charset_collate;";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    $result = dbDelta($sql);

    if ($result === false) {
        error_log('Failed to create the custom table.');
    } else {
        error_log('Custom table created successfully.');
    }
}

register_activation_hook(__FILE__, 'create_nurse_offer_table');

//////// Add form shortcode//////////////////

add_shortcode('nurse_offer_form', 'render_nurse_offer_form');
function render_nurse_offer_form()
{
    ob_start();
?>
    <style>
        #nurse-offer-form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            max-width: 90%;
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }

        label {
            font-weight: bold;
            margin-bottom: 10px;
            display: block;
        }

        input[type="text"],
        input[type="date"],
        textarea,
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    <form id="nurse-offer-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
        <label for="patient-name">Patient Name:</label>
        <input type="text" id="patient-name" name="patient_name" required><br>

        <label for="gender">Gender:</label><br>
        <input type="radio" id="gender-male" name="gender" value="male" required> Male
        <input type="radio" id="gender-female" name="gender" value="female" required> Female<br><br>

        <label for="patient-case">Patient Case:</label>
        <select id="patient-case" name="patient_case" required>
            <option value="Wound Care - $40">Wound Care - $40</option>
            <option value="Medication Management - $30">Medication Management - $30</option>
            <option value="Chronic Disease Management - $50">Chronic Disease Management - $50</option>
            <option value="Personal Care Assistance - $20">Personal Care Assistance - $20</option>
            <option value="Emotional Support and Companionship - $15">Emotional Support and Companionship - $15</option>
            <option value="Nutrition and Meal Assistance - $25">Nutrition and Meal Assistance - $25</option>
            <option value="Cannula insertion - $50">Cannula insertion - $50</option>
            <option value="Intravenous (IV) line insertion - $70">Intravenous (IV) line insertion - $70</option>
            <option value="Urinary catheter insertion - $60">Urinary catheter insertion - $60</option>
            <option value="Wound dressing change - $40">Wound dressing change - $40</option>
            <option value="Medication administration - $30">Medication administration - $30</option>
            <option value="Blood glucose monitoring - $20">Blood glucose monitoring - $20</option>
            <option value="Tracheostomy care - $80">Tracheostomy care - $80</option>
            <option value="Nasogastric tube insertion or care - $90">Nasogastric tube insertion or care - $90</option>
            <option value="Central line dressing change - $100">Central line dressing change - $100</option>
            <option value="Suture removal - $25">Suture removal - $25</option>
            <option value="Stoma care - $55">Stoma care - $55</option>
            <option value="Oxygen therapy setup or assessment - $75">Oxygen therapy setup or assessment - $75</option>
            <option value="Assessment and management of pressure ulcers - $85">Assessment and management of pressure ulcers - $85</option>
            <option value="Palliative care assessment and symptom management - $95">Palliative care assessment and symptom management - $95</option>
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
        <input type="date" id="time_of_service" name="time_of_service" required><br><br>


        <input type="hidden" name="action" value="submit_nurse_offer">
        <input type="submit" name="submit_nurse_offer" value="Next Step">
    </form>
<?php
    return ob_get_clean();
}



///////////////////////INSERT_FUNCTION////////////////////////////

add_action('admin_post_submit_nurse_offer', 'process_nurse_offer_form');
add_action('admin_post_nopriv_submit_nurse_offer', 'process_nurse_offer_form');

function process_nurse_offer_form()
{
    if (isset($_POST['submit_nurse_offer'])) {
        global $wpdb;

        // Check if the user is logged in
        if (is_user_logged_in()) {
            // Sanitize input data
            $patient_name = sanitize_text_field($_POST['patient_name']);
            $gender = sanitize_text_field($_POST['gender']);
            $patient_case = sanitize_text_field($_POST['patient_case']);
            $case_description = sanitize_textarea_field($_POST['case_description']);
            $other_diseases = isset($_POST['other_diseases']) ? sanitize_text_field($_POST['other_diseases']) : '';
            $patient_address = sanitize_text_field($_POST['patient_address']);
            $type_of_services = sanitize_text_field($_POST['type_of_services']);
            $time_of_service = sanitize_text_field($_POST['time_of_service']);
            $date_submitted = current_time('mysql');

            // Get current user ID
            $user_id = get_current_user_id();

            // Insert data into the database
            if ($user_id) {
                $offer_table_name = $wpdb->prefix . 'nurse_offers';
                $wpdb->insert(
                    $offer_table_name,
                    array(
                        'nurse_id' => $user_id,
                        'user_id' => $user_id, 
                        'patient_name' => $patient_name,
                        'gender' => $gender,
                        'patient_case' => $patient_case,
                        'case_description' => $case_description,
                        'other_diseases' => $other_diseases,
                        'patient_address' => $patient_address,
                        'type_of_services' => $type_of_services,
                        'time_of_service' => $time_of_service,
                        'date_submitted' => $date_submitted,
                        'status' => 'pending'
                    ),
                    array(
                        '%d',
                        '%d', 
                        '%s',
                        '%s',
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

                // Redirect after form submission with user_id included in URL
                $id = $wpdb->insert_id;
                wp_redirect(home_url('/nurses/?offer_id=' . $id . '&user_id=' . $user_id));
                exit;
            } else {
                // User is not logged in
                wp_redirect(wp_login_url());
                exit;
            }
        } else {
            // Redirect to login page if the user is not logged in
            wp_redirect(wp_login_url());
            exit;
        }
    }
}


//////////////Nurse_card/////////////////////


add_shortcode('display_nurse_cases', 'display_nurse_cases_shortcode');
function display_nurse_cases_shortcode($atts)
{
    global $wpdb;
  $output = '';

   // Get current user ID
   
   $user_id = get_current_user_id();
   
    if (!$user_id) {
        return '<p>No user ID found.</p>';
    }

   $table_name = $wpdb->prefix . 'nurse_offers';
$query = $wpdb->prepare("SELECT * FROM $table_name WHERE status = 'pending' AND nurse_id = %d", $user_id);


    $cases = $wpdb->get_results($query);

    // Debugging: Output the generated query and nurse ID
    //error_log('Generated Query: ' . $wpdb->last_query);
    //error_log('Nurse ID: ' . $user_id);

    //$output = '<p>Current user ID: ' . $user_id . '</p>';

    if ($cases) {
        // Debugging: Output the number of cases retrieved
        //$output .= '<p>Number of cases: ' . count($cases) . '</p>';
        $output .= '<style>
            .nurse-case {
                background-color: #f9f9f9;
                padding: 20px;
                margin-bottom: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .nurse-case:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1);
            }

            .case-title {
                margin-bottom: 10px;
                font-size: 20px;
            }

            .case-date {
                font-style: italic;
                color: #666;
                font-size: 0.9em;
            }

            .case-details p {
                margin: 5px 0;
                font-size: 16px;
            }

            .btn-done {
                background-color: #2ecc71;
                color: #fff;
                border: none;
                border-radius: 5px;
                padding: 8px 16px;
                cursor: pointer;
                font-size: 18px;
                transition: background-color 0.3s;
                margin-top: 10px;
                margin-left:100px;
                width:50%;
            }

            .btn-done:hover {
                background-color: #0c1406;
            }
        </style>';

        // Start nurse cases container
        $output .= '<div class="nurse-cases">';

        // Loop through each case and format it
        foreach ($cases as $case) {
            // Generate a unique ID for each case div
            $caseDivId = 'case-' . $case->id;

            $output .= '<div id="' . $caseDivId . '" class="nurse-case">';

            // Case header
            $output .= '<div class="case-header">';
            $output .= '<h3 class="case-title">';
            // Add gender prefix before patient's name
            $output .= '<span style="font-weight:bold;">' . ($case->gender === 'male' ? 'Mr. ' : 'Ms. ') . '</span>';
            $output .= esc_html($case->patient_name) . '</h3>';
            $output .= '<p class="case-date">Date Submitted: ' . esc_html($case->date_submitted) . '</p>';
            $output .= '</div>'; // Close case-header

            // Case details
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

            // "Done" button with confirmation
            $output .= '<button class="btn-done" onclick="confirmAction(' . $case->id . ')">Done</button>';

            $output .= '</div>'; // Close case-details

            // Close nurse-case div
            $output .= '</div>';
        }

        // Close nurse cases container
        $output .= '</div>';

        // JavaScript for confirmation
        $output .= '<script>
            function confirmAction(caseId) {
                if (confirm("Is This Service Done?")) {
                    document.getElementById("case-" + caseId).style.display = "none";
                    var formData = new FormData();
                    formData.append("action", "remove_nurse_case");
                    formData.append("case_id", caseId);
                    fetch("' . admin_url('admin-post.php') . '", {
                        method: "POST",
                        body: formData
                    });
                }
            }
        </script>';

    } else {
        $output .= '<p>No cases have been submitted yet.</p>';
    }

    return $output;
}


//////////////patient_card/////////////////////

add_shortcode('display_patient_cards', 'display_patient_cards_shortcode');
function display_patient_cards_shortcode($atts)
{
    global $wpdb;
    
    $output = ''; // Initialize $output variable

    // Get current user ID
    $user_id = get_current_user_id();
    if (!$user_id) {
        return '<p>No user ID found.</p>';
    }

    $table_name = $wpdb->prefix . 'nurse_offers';
    $query = $wpdb->prepare("SELECT * FROM $table_name WHERE status = 'pending' AND nurse_id = %d", $user_id);

    $cases = $wpdb->get_results($query);

    // Debugging: Output the generated query and patient ID
    // error_log('Generated Query: ' . $wpdb->last_query);
    // error_log('Patient ID: ' . $user_id);
    //$output = '<p>Current user ID: ' . $user_id . '</p>';

//print_r($cases);

    if ($cases) {
        // Debugging: Output the number of cases retrieved
        //$output .= '<p>Number of cases: ' . count($cases) . '</p>';
        // Start patient cards container
        $output .= '<div class="patient-cards">';

        // Loop through each case and format it as a card
        foreach ($cases as $case) {
            $output .= '<div class="patient-card-wrapper">';
            $output .= '<div class="patient-card" id="card-' . $case->id . '">';

            $output .= '<h4>';
            // Add gender prefix before patient's name
            $output .= '<span style="font-weight:bold;">' . ($case->gender === 'male' ? 'Mr. ' : 'Ms. ') . '</span>';
            $output .= esc_html($case->patient_name) . '</h4>';
            $output .= '<p class="case-date" style="font-style: italic; color: grey;">Date Submitted: ' . esc_html($case->date_submitted) . '</p>';
            if (isset($case->patient_case)) {
                $output .= '<p>Patient Case: ' . esc_html($case->patient_case) . '</p>';
            }
            if (isset($case->case_description)) {
                $output .= '<p>Case Description: ' . esc_html($case->case_description) . '</p>';
            }
            if (isset($case->other_diseases)) {
                $output .= '<p>Other Diseases: ' . esc_html($case->other_diseases) . '</p>';
            }
            if (isset($case->patient_address)) {
                $output .= '<p>Patient Address: ' . esc_html($case->patient_address) . '</p>';
            }

            // Add the "Done" button with its action to remove the card
            $output .= '<button class="btn btn-done" onclick="confirmAction(' . $case->id . ');">Done</button>';

            // Check type of service for button action
            if ($case->type_of_services === 'Online Treatment') {
                $output .= '<a href="https://dev-healfive.pantheonsite.io/messages/#/new-conversation?&to=' . $case->nurse_id . '" class="btn btn-chat">Go to Chat</a>';
            } elseif ($case->type_of_services === 'Home Care') {
                $output .= '<a href="' . home_url('/tracking-service/') . '" class="btn btn-status">Go to Your Status</a>';
            }

            $output .= '</div>'; // Close patient-card div
            $output .= '</div>'; // Close patient-card-wrapper div
        }

        // Close the container div
        $output .= '</div>';
        
        $output .= '<style>
            .patient-cards {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
            }

            .patient-card-wrapper {
                width: calc(50% - 20px); /* Two cards in a row with margin */
                margin-bottom: 20px;
            }

            .patient-card {
                background-color: #edfbe2;
                color: black;
                font-family: Arial, sans-serif;
                padding: 15px;
                border-radius: 10px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .patient-card:hover {
                transform: translateY(-2px);
                box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
            }

            .patient-card p {
                margin: 5px 0;
                font-size: 16px;
            }

            .patient-card h4 {
                margin-bottom: 10px;
                font-size: 20px;
            }

            .btn {
                display: inline-block;
                outline: 0;
                border: 0;
                cursor: pointer;
                border-radius: 8px;
                padding: 14px 24px 16px;
                font-size: 18px;
                font-weight: 700;
                line-height: 1;
                transition: transform 200ms, background 200ms;
                text-decoration: none;
            }

            .btn:hover {
                transform: translateY(-2px);
            }

            .btn-done {
                background: #e75480; /* Dark pink */
                color: #FFFFFF;
                margin-right: 10px;
            }

            .btn-chat {
                background: #4CAF50; /* Green */
                color: #FFFFFF;
            }

            .btn-status {
                background: #2ECC71; /* Another shade of green */
                color: #FFFFFF;
            }

            .btn-done:hover {
                background: #000000;
            }

            .btn-chat:hover,
            .btn-status:hover {
                background: #FFFFFF;
            }
        </style>';

        // Add JavaScript for confirmation
        $output .= '<script>
            function confirmAction(cardId) {
                if (confirm("Is This Service Done?")) {
                    document.getElementById("card-" + cardId).style.display = "none";
                    var formData = new FormData();
                    formData.append("action", "remove_patient_card");
                    formData.append("card_id", cardId);
                    fetch("' . admin_url('admin-post.php') . '", {
                        method: "POST",
                        body: formData
                    });
                }
            }
        </script>';
        

    } else {
        // If there are no cases, display a message
        $output .= '<p>No cases have been submitted yet.</p>';
    }

    return $output;
}