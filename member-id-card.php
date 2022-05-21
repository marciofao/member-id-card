<?php





/**
 * @wordpress-plugin
 * Plugin Name: Member ID Card
 * Plugin URI: https://github.com/marciofao/member-id-card
 * Description: Adds an ID card link to the user profile
 * Version: 0.1
 * Text Domain: mic
 * Author: Márcio Lopes Fão
 * Author URI: https://marciofao.github.io/
 */

register_activation_hook( __FILE__, 'child_plugin_activate' );
function child_plugin_activate(){

    // Require parent plugin
    if ( !is_plugin_active( 'simple-local-avatars/simple-local-avatars.php' ) and current_user_can( 'activate_plugins' ) ) {
        // Stop activation redirect and show error
        wp_die(
            printf(
                __('Desculpe, este plugin requer o plugin Simple Local Avatars instalado e ativo. <br><a href="%s">&laquo; Voltar aos plugins</a>', 'mic'),
                admin_url( 'plugins.php' )
            )
        );
    }
}


define('MIC_SCRIPT_VER', '1.2.44');
//define('SCRIPT_VER', rand(0,1000)); //for CSS Dev mode

define('MIC_PLUGIN_DIR', dirname(__FILE__).'');
define('MIC_PLUGIN_URI', plugin_dir_url(__FILE__).'');
define('ERR_MSG', __("<h1>Dados inválidos!</h1>", 'mic'));




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
                    <a href="<?php echo get_home_url() ?>?card-view=<?php echo $current_user->ID ?>" target="_blank">
                        <?php _e('Ver/imprimir carteirinha', 'mic') ?>
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
    if(isset($_GET['card-view'])){
        if(!$_GET['card-view']) die(ERR_MSG);
        require_once('card-page.php');
        die();
    }
}

add_action('init', 'mic_show_card');

function mic_qr_generate(){
    if(isset($_GET['card-generate'])){
        if(!$_GET['card-generate']) die(ERR_MSG);
        require_once('card-generate.php');
        die;
    }
}
add_action('init', 'mic_qr_generate');

//debug function
function dump_die($a){
    echo '<pre>';
    var_dump($a);
    die;
}