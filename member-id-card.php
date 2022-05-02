<?php





/**
 * @wordpress-plugin
 * Plugin Name: Member ID Card
 * Plugin URI: http://marciofao.github.io
 * Description: Adds an ID card link to the user profile
 * Version: 1.0
 * Text Domain: mic
 * Author: Márcio Lopes Fão
 * Author URI: https://marciofao.github.io/
 */

register_activation_hook( __FILE__, 'child_plugin_activate' );
function child_plugin_activate(){

    // Require parent plugin
    if ( ! is_plugin_active( 'simple-local-avatars/simple-local-avatars.php' ) and current_user_can( 'activate_plugins' ) ) {
        // Stop activation redirect and show error
        wp_die(_('Desculpe, este plugin requer o plugin Simple Local Avatars instalado e ativo. <br><a href="' . admin_url( 'plugins.php' ) . '">&laquo; Voltar aos plugins</a>'));
    }
}


define('MIC_SCRIPT_VER', '1.2.44');
//define('SCRIPT_VER', rand(0,1000)); //for CSS Dev mode

define('MIC_PLUGIN_DIR', dirname(__FILE__).'');
define('MIC_PLUGIN_URI', plugin_dir_url(__FILE__).'');




//TRANSLATIONS SETUP - set user language
function mic_set_user_locale(){
  
    switch_to_locale(get_user_locale());

    load_plugin_textdomain( 'mic', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}
add_filter('init', 'mic_set_user_locale', 1);


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

function mic_qr_generate(){
    if(isset($_GET['qr-generate'])){
        require_once('card-generate.php');
        die();
    }
}
add_action('init', 'mic_qr_generate');

//debug function
function dump_die($a){
    echo '<pre>';
    var_dump($a);
    die;
}