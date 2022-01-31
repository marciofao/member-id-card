<?php

/**
 * @wordpress-plugin
 * Plugin Name: Member ID Card
 * Plugin URI: http://opah.com.br
 * Description: Adds a ID card link to user info page
 * Version: 1.0
 * Text Domain: mic
 * Author: Márcio Lopes Fão
 * Author URI: https://marciofao.github.io/

 */

define('MIC_SCRIPT_VER', '1.2.44');
//define('SCRIPT_VER', rand(0,1000)); //for CSS Dev mode

define('MIC_PLUGIN_DIR', dirname(__FILE__).'');
define('MIC_PLUGIN_URI', plugin_dir_url(__FILE__).'');


//TRANSLATIONS SETUP
function ni_set_user_locale(){
  
    switch_to_locale(get_user_locale());

    load_plugin_textdomain( 'nilab', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}
add_filter('init', 'ni_set_user_locale', 1);


function mic_profile_fields()
{
    global $current_user;

    $site_name = get_bloginfo();
  
?>

<table class="form-table user-member-id-card-wrap-table" role="presentation">
    <tbody>
        <tr class="user-member-id-card-wrap">
            <th scope="row"><?php echo __('Carteirinha ', 'mic').$site_name ?> </th>
            <td>
                <label for="mic-link">
                    <a href="../?mic-id-card-view=<?php echo $current_user->ID ?>" target="_blank">
                        <?php _e('Ver carteirinha', 'mic') ?>
                    </a>
                </label>
            </td>
        </tr>

    </tbody>
</table>
<?php

}

add_action('show_user_profile', 'mic_profile_fields',25);
add_action('edit_user_profile', 'mic_profile_fields',25);

function mic_show_card(){
    if(isset($_GET['mic-id-card-view'])){
        require_once('card-page.php');
        die();
    }
}


add_action('init', 'mic_show_card');

//debug function
function dump_die($a){
    echo '<pre>';
    var_dump($a);
    die;
}