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
            <th scope="row"><?php echo __('Member ID Card ', 'mic').$site_name ?> </th>
            <td>
                <label for="mic-link">
                    <?php 

                    // If admin or logged user will show user id
                    $user_id = $current_user->ID;
                    if(isset($_GET["user_id"]))
                    $user_id = $_GET["user_id"];

                    $noprint = false;
                    //dump_die(get_user_meta($user_id, 'simple_local_avatar', true)['full']);
                    if(!isset(get_user_meta($user_id, 'simple_local_avatar', true)['full'])){
                        $noprint = true;
                    }

                    ?>
                    <?php if($noprint): ?>
                        <?php _e('To show the member ID card, first upload a local avatar picture and save', 'mic') ?>
                    <?php else: ?>
                    <a href="<?php echo get_home_url() ?>?card-view=<?php echo base64_encode($user_id) ?>" target="_blank">
                        <?php _e('See/Print Member ID Card', 'mic') ?>
                    </a>
                    <?php endif ?>
                </label>
            </td>
        </tr>

    </tbody>
</table>
<?php

}

add_action('show_user_profile', 'mic_profile_fields',11);
add_action('edit_user_profile', 'mic_profile_fields',11);

function mic_show_card(){
    if(isset($_GET['card-view'])){
        if(!$_GET['card-view']) die(ERR_MSG);
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