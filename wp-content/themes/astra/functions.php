<?php
/**
 * Astra functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Define Constants
 */
define( 'ASTRA_THEME_VERSION', '4.6.5' );
define( 'ASTRA_THEME_SETTINGS', 'astra-settings' );
define( 'ASTRA_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'ASTRA_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );

/**
 * Minimum Version requirement of the Astra Pro addon.
 * This constant will be used to display the notice asking user to update the Astra addon to the version defined below.
 */
define( 'ASTRA_EXT_MIN_VER', '4.6.4' );

/**
 * Setup helper functions of Astra.
 */
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-theme-options.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-theme-strings.php';
require_once ASTRA_THEME_DIR . 'inc/core/common-functions.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-icons.php';

define( 'ASTRA_PRO_UPGRADE_URL', astra_get_pro_url( 'https://wpastra.com/pro/', 'dashboard', 'free-theme', 'upgrade-now' ) );
define( 'ASTRA_PRO_CUSTOMIZER_UPGRADE_URL', astra_get_pro_url( 'https://wpastra.com/pro/', 'customizer', 'free-theme', 'upgrade' ) );

/**
 * Update theme
 */
require_once ASTRA_THEME_DIR . 'inc/theme-update/astra-update-functions.php';
require_once ASTRA_THEME_DIR . 'inc/theme-update/class-astra-theme-background-updater.php';

/**
 * Fonts Files
 */
require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-font-families.php';
if ( is_admin() ) {
	require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-fonts-data.php';
}

require_once ASTRA_THEME_DIR . 'inc/lib/webfont/class-astra-webfont-loader.php';
require_once ASTRA_THEME_DIR . 'inc/lib/docs/class-astra-docs-loader.php';
require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-fonts.php';

require_once ASTRA_THEME_DIR . 'inc/dynamic-css/custom-menu-old-header.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/container-layouts.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/astra-icons.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-walker-page.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-enqueue-scripts.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-gutenberg-editor-css.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-wp-editor-css.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/block-editor-compatibility.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/inline-on-mobile.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/content-background.php';
require_once ASTRA_THEME_DIR . 'inc/class-astra-dynamic-css.php';
require_once ASTRA_THEME_DIR . 'inc/class-astra-global-palette.php';

/**
 * Custom template tags for this theme.
 */
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-attr.php';
require_once ASTRA_THEME_DIR . 'inc/template-tags.php';

require_once ASTRA_THEME_DIR . 'inc/widgets.php';
require_once ASTRA_THEME_DIR . 'inc/core/theme-hooks.php';
require_once ASTRA_THEME_DIR . 'inc/admin-functions.php';
require_once ASTRA_THEME_DIR . 'inc/core/sidebar-manager.php';

/**
 * Markup Functions
 */
require_once ASTRA_THEME_DIR . 'inc/markup-extras.php';
require_once ASTRA_THEME_DIR . 'inc/extras.php';
require_once ASTRA_THEME_DIR . 'inc/blog/blog-config.php';
require_once ASTRA_THEME_DIR . 'inc/blog/blog.php';
require_once ASTRA_THEME_DIR . 'inc/blog/single-blog.php';

/**
 * Markup Files
 */
require_once ASTRA_THEME_DIR . 'inc/template-parts.php';
require_once ASTRA_THEME_DIR . 'inc/class-astra-loop.php';
require_once ASTRA_THEME_DIR . 'inc/class-astra-mobile-header.php';

/**
 * Functions and definitions.
 */
require_once ASTRA_THEME_DIR . 'inc/class-astra-after-setup-theme.php';

// Required files.
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-admin-helper.php';

require_once ASTRA_THEME_DIR . 'inc/schema/class-astra-schema.php';

/* Setup API */
require_once ASTRA_THEME_DIR . 'admin/includes/class-astra-api-init.php';

if ( is_admin() ) {
	/**
	 * Admin Menu Settings
	 */
	require_once ASTRA_THEME_DIR . 'inc/core/class-astra-admin-settings.php';
	require_once ASTRA_THEME_DIR . 'admin/class-astra-admin-loader.php';
	require_once ASTRA_THEME_DIR . 'inc/lib/astra-notices/class-astra-notices.php';
}

/**
 * Metabox additions.
 */
require_once ASTRA_THEME_DIR . 'inc/metabox/class-astra-meta-boxes.php';

require_once ASTRA_THEME_DIR . 'inc/metabox/class-astra-meta-box-operations.php';

/**
 * Customizer additions.
 */
require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-customizer.php';

/**
 * Astra Modules.
 */
require_once ASTRA_THEME_DIR . 'inc/modules/posts-structures/class-astra-post-structures.php';
require_once ASTRA_THEME_DIR . 'inc/modules/related-posts/class-astra-related-posts.php';

/**
 * Compatibility
 */
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-gutenberg.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-jetpack.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/woocommerce/class-astra-woocommerce.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/edd/class-astra-edd.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/lifterlms/class-astra-lifterlms.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/learndash/class-astra-learndash.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-beaver-builder.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-bb-ultimate-addon.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-contact-form-7.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-visual-composer.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-site-origin.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-gravity-forms.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-bne-flyout.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-ubermeu.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-divi-builder.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-amp.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-yoast-seo.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-surecart.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-starter-content.php';
require_once ASTRA_THEME_DIR . 'inc/addons/transparent-header/class-astra-ext-transparent-header.php';
require_once ASTRA_THEME_DIR . 'inc/addons/breadcrumbs/class-astra-breadcrumbs.php';
require_once ASTRA_THEME_DIR . 'inc/addons/scroll-to-top/class-astra-scroll-to-top.php';
require_once ASTRA_THEME_DIR . 'inc/addons/heading-colors/class-astra-heading-colors.php';
require_once ASTRA_THEME_DIR . 'inc/builder/class-astra-builder-loader.php';

// Elementor Compatibility requires PHP 5.4 for namespaces.
if ( version_compare( PHP_VERSION, '5.4', '>=' ) ) {
	require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-elementor.php';
	require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-elementor-pro.php';
	require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-web-stories.php';
}

// Beaver Themer compatibility requires PHP 5.3 for anonymous functions.
if ( version_compare( PHP_VERSION, '5.3', '>=' ) ) {
	require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-beaver-themer.php';
}

require_once ASTRA_THEME_DIR . 'inc/core/markup/class-astra-markup.php';

/**
 * Load deprecated functions
 */
require_once ASTRA_THEME_DIR . 'inc/core/deprecated/deprecated-filters.php';
require_once ASTRA_THEME_DIR . 'inc/core/deprecated/deprecated-hooks.php';
require_once ASTRA_THEME_DIR . 'inc/core/deprecated/deprecated-functions.php';
////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////



add_shortcode("form_1","reserve");
function reserve(){
    return '
    <style>


        form {
            background-color: #fff;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			color:#3B945E;
		    font-family: Georgia, serif;
        }

        h2 {
            margin-top: 0;
			color:#3B945E;
			
        }

        label {
            display: inline-block;
            margin-bottom: 5px;
            font-weight: bold;
			color:#3B945E;
        }

        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="radio"],
        input[type="checkbox"] {
            margin-right: 5px;
        }

        textarea {
            height: 100px;
            resize: none;
        }

        input[type="submit"] {
            background-color:  #3b945e;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
			 width: 200px;
			 height: 50px;
            display: block;
            margin: 0 auto; 

           
        }

        input[type="submit"]:hover {
            background-color: #57ba98;
        }
		.date{
            margin-bottom: 20px;
        }
        .time{
            margin-bottom: 20px;
        }
        
    </style>

  
    <form action ="https://dev-healfive.pantheonsite.io/elementor-721/"   method="post" >
          <h2>Paitent Details</h2>
      <div>
          <label for="name"><b>Username</b></label>
          <input type="text"  name="user" required>
    </div>
   
  <div>
        <label for="dropdown">Patient Case</label><br>
        <select id="dropdown" name="option">
			 <option></option>
            <option value="option1">Measuring suger</option>
            <option value="option2">Pressure gauge</option>
            <option value="option3">Solution compostion</option>
            <option value="option3">Cnnula installation</option>
            <option value="option3">Allergyc test</option>
            <option value="option3">Intramuscular injection</option>
            <option value="option3">Intramuscular injection</option>
            <option value="option3">Other service</option>
        </select><br>
		 <p>Please enter your case </p>
        <textarea id="field2"></textarea><br><br>
    </div>
    <div>
        <p>Type Of Visit</p>
        <input type="radio" id="visit1" name="visit">
        <label for="visit1">One Time</label><br>
        <input type="radio" id="visit2" name="visit">
        <label for="visit2">Long visit</label><br>

        <p>Do you have any medical diseases?</p>
        <input type="radio" id="redio_yes" name="medical">
        <label for="redio_yes">YES</label><br>
        <input type="radio" id="radio_no" name="medical">
        <label for="radio_no">NO</label><br>

        <p>Please describe any additional diseases ?</p>
        <textarea id="field1"></textarea><br><br>
    </div>

    <div>
        <label for="address">Current Address</label><br>
        <input type="text" id="address" name="address"><br>

    </div>
      <p>Time Of Service</p>
        <input type="radio" id="now" name="time">
        <label for="now">Now</label><br>
        <input type="radio" id="later" name="time">
        <label for="later"> Appointment</label><br>
        
      <p id="date&time">select your visit ? </p>

        <label for="date" class="date">Date</label>
        <input type="date" class="date" id="date" name="date"><br>

        <label for="appt"  class="appt" >Time</label>
        <input type="time" class="time" id="appt" name="time"><br>
 
        <input type="submit" value="Reserve">
    </form>
	
	
    <script src="https://dev-healfive.pantheonsite.io/wp-content/themes/astra/js/reserve.js?ver=1.0.0" id="script-name-js"></script>
    ';

}

function select_nurse(){
	
	
};





    function themeslug_enqueue_script() {
        wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
        wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/reserve.js', array(), '1.0.0', true );
        }
        add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_script' );
          function theme_script() {
            wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/reserve.js', array(), '1.0.0', true );
            }
            add_action( 'wp_enqueue_scripts', 'theme_script' );
            
            
            
        
        
        

        
            
 
/////////////////////////////////////////////////////////////////
// add_shortcode('mas', 'massage');

// function massage() {
//     global $wpdb;
// 	  $table = $wpdb->prefix .'users';
// 	$nurse_id = $wpdb->get_var($wpdb->prepare("select nurse_id from $table where ID = %d", $_GET['ID']));
//     // Shortcode attributes and default values
//             $url = 'https://dev-healfive.pantheonsite.io/make-appointment/?nurse_id='.$nurse_id.'&subject=Have+a+question+to+you&message=Lorem+Ipsum+is+simply+dummy+text+of+the+printing+and+typesetting+industry.&';



    // Return the HTML
//     return $button_html;
// }
///////////////////////////////////////////////
// add_shortcode('init', 'custom_bettermassage_chat_users');

// function custom_bettermassage_chat_users() {
//     if (class_exists('Bettermassage')) {
//         // Nurse ID and username
//         $nurse_id =36; // Replace 123 with the actual nurse ID
//         $nurse_username = 'user_login'; // Replace 'nurse_username' with the actual nurse username
        
//         // Get the user object by ID
//         $nurse_user = get_user_by('id', $nurse_id);
        
//         if ($nurse_user && $nurse_user->user_login === $nurse_username) {
//             // Nurse user found, restrict chat to only this user
//             Bettermassage::get_instance()->set_allowed_chat_users(array($nurse_user->ID));
//         }
//     }
// }


///////////////////////////////////////////////////////////////////////////////
add_shortcode("show","showDoctor");
function showDoctor(){
	
	error_reporting(E_ERROR | E_PARSE);
ob_start();
	global $wpdb;
$args = array(
	'role'    => 'nurse'
);
	$users = get_users( $args );
//    print_r($users);
 	//print_r($users);
   echo'<div class="e-con-inner"style="display: flex; justify-content: space-between; ">';

	foreach ($users as $user) {
		
    $name = $user->user_login;
    $id = $user->ID;
    $id = (int) $id;
    $data = get_user_meta($id);
	$user_status = get_user_meta($id, 'user_status', true);

          
// 		print_r($data);
	$url=$data['Img'][0];
		
// 	echo "<img src='https://dev-healfive.pantheonsite.io/wp-content/uploads/ultimatemember/$id/$url'>";	
//     $name = isset($data['user_nicename'][0]) ? $name : ''; // Corrected spelling
    $experince = isset($data['experience'][0]) ? $data['experience'][0] : ''; // Corrected spelling
    $Price = isset($data['priCe'][0]) ? $data['priCe'][0] : ''; // Corrected spelling
		um_fetch_user($id);
    $img = um_get_avatar_uri(um_profile('profile_photo'),100);
//       echo "<img src='$img'>";

$form_url = add_query_arg( 'nurse_id', $id, home_url('/payment/') );
		echo'<div class="elementor-element elementor-element-aebfe68 e-con-full e-flex e-con e-child" data-id="aebfe68" data-element_type="container" data-settings="{&quot;content_width&quot;:&quot;full&quot;,&quot;_ha_eqh_enable&quot;:false}">
            <div class="elementor-element elementor-element-ae6a2c1 ha-card--top ha-card--tablet-top ha-card--mobile-top elementor-widget elementor-widget-ha-card happy-addon ha-card" data-id="ae6a2c1" data-element_type="widget" data-widget_type="ha-card.default">
                <div class="elementor-widget-container">
                    <figure class="ha-card-figure">
 <img fetchpriority="high" decoding="async" width="100" height="300" src="https://dev-healfive.pantheonsite.io/wp-content/uploads/ultimatemember/'.$id.'/'.$url.'"	class="attachment-large size-large wp-image-780" alt="" srcset="https://dev-healfive.pantheonsite.io/wp-content/uploads/ultimatemember/'.$id.'/'.$url.'" sizes="(max-width: 200px) 100vw, 600px">
                    </figure>
                    <div class="ha-card-body">
                        <h3 class="ha-card-title">' . $experince . 'year</h3>
                        <div class="ha-card-text">
                            <p>' . $Price . '</p>
                            <p>' . $name . '</p>
                        </div>
                        <a class="ha-btn" href="'. $form_url .'"><span class="ha-btn-text">Reserve</span></a>
                            
                    </div>
                </div>
            </div>
		</div>';
}

	echo '</div>';
return ob_get_clean();
    }


function enqueue_custom_styles() {
    // Replace 'your-style' with a unique handle for your style.
    wp_enqueue_style( 'your-style', get_stylesheet_directory_uri() . '/css/custom.css');
}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_styles' );
///////////////////////////////////////////////////////////////////////////////////////////
add_shortcode("all","showall");
function showall(){
    error_reporting(E_ERROR | E_PARSE);
    ob_start();
    global $wpdb;
    $args = array(
        'role'    => 'nurse'
    );
    $users = get_users( $args );

    echo '<div class="e-con-inner" style="display: flex; justify-content: space-between; ">';

    echo '<table>'; // Start table

    // Table header

 echo    '<tr>';
   echo '<th>Name</th>';
  echo  '<th>Experience</th>';
   echo'<th>Price</th>';
   echo '<th>Action</th>';
	
	echo'<th>Email</th>';
 echo'<th>password</th>';
	echo'<th>img</th>';
	 echo'<th>cv</th>';
  echo '<th>national id </th>';
    echo'<th>Membership card</th>';
   echo '<th>Practice license</th>';


    foreach ($users as $user) {
        $id = $user->ID;
        $data = get_user_meta($id);
        $name = $user->user_login;
        $experience = isset($data['experience'][0]) ? $data['experience'][0] : '';
        $price = isset($data['priCe'][0]) ? $data['priCe'][0] : '';
			$url=$data['Img'][0];
			$url2=$data['CV'][0];
			$url3=$data['NID'][0];
		   $url4=$data['MC'][0];
		   $url5=$data['PL'][0];
			um_fetch_user($id);
 //  $img = um_get_avatar_uri(um_profile('profile_photo'),100);
//$form_url = add_query_arg( 'nurse_id', $id, home_url('/payment/') );
	//	$img=isset($data['Img'][0]) ? $data['Img'][0] : '';

       // $form_url = add_query_arg('nurse_id', $id, home_url('/payment/'));
		$email=isset($data['user_email'][0]) ? $data['user_email'][0] : '';
		$password=isset($data['user_pass'][0]) ? $data['user_pass'][0] : '';
		$cv=isset($data['CV'][0]) ? $data['CV'][0] : '';
		$NID=isset($data['NID'][0]) ? $data['NID'][0] : '';
		$MC=isset($data['MC'][0]) ? $data['MC'][0] : '';
		$PL=isset($data['PL'][0]) ? $data['PL'][0] : '';

        echo '<tr>';
        echo '<td>' . $name . '</td>';
        echo '<td>' . $experience . '</td>';
        echo '<td>' . $price . '</td>';
        echo '<td><a href="' . $form_url . '">Reserve</a></td>';

		echo '<td>' . $email . '</td>';
		echo '<td>' . $password . '</td>';
		echo '<td><img src="https://dev-healfive.pantheonsite.io/wp-content/uploads/ultimatemember/'.$id.'/'.$url.'" ></td>';
   echo '<td><a href= "https://dev-healfive.pantheonsite.io/wp-content/uploads/ultimatemember/'.$id.'/'.$url2.'" ></a></td>';
   echo '<td><a href="https://dev-healfive.pantheonsite.io/wp-content/uploads/ultimatemember/'.$id.'/'.$url3.'" ></a></td>';
	
// 		echo '<td>' .$cv . '</td>';
// 		echo '<td>' . $NID . '</td>';
		echo '<td><img src="https://dev-healfive.pantheonsite.io/wp-content/uploads/ultimatemember/'.$id.'/'.$url4.'" ></td>';
			echo '<td><img src="https://dev-healfive.pantheonsite.io/wp-content/uploads/ultimatemember/'.$id.'/'.$url5.'" ></td>';
        echo '</tr>';
    }

    echo '</table>'; // End table

    echo '</div>';
    return ob_get_clean();
}
