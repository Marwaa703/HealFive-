<?php
/*
Template Name: Custom Form Submissions
*/
get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="container">
            <?php
            global $wpdb;

            // Specify the form ID
            $form_id = 1076;

            // Query to retrieve form submission data for the specified form ID
            $query = $wpdb->prepare(
                "SELECT * FROM {$wpdb->prefix}frm_items WHERE form_id = %d",
                $form_id
            );

            // Retrieve the data
            $form_submissions = $wpdb->get_results($query);

            // Display data
            if ($form_submissions) {
                echo '<table>';
                echo '<tr><th>Submission ID</th><th>Field 1</th><th>Field 2</th></tr>';

                foreach ($form_submissions as $submission) {
                    echo '<tr>';
                    echo '<td>' . $submission->id . '</td>';
                    echo '<td>' . $submission->Name . '</td>';
                    echo '<td>' . $submission->Address . '</td>';
                    echo '<td>' . $submission->Patient_Case . '</td>';
                    // Add more fields as needed
                    echo '</tr>';
                }

                echo '</table>';
            } else {
                echo 'No submissions found for form ID ' . $form_id;
            }
            ?>
        </div>
    </main>
</div>

<?php get_footer(); ?>