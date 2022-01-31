<?php

/**
 * @wordpress-plugin
 * Plugin Name: Member ID Card
 * Plugin URI: http://opah.com.br
 * Description: Adds a ID card link to user info page
 * Version: 1.0
 * Text Domain: user-id-card
 * Author: Márcio Lopes Fão
 * Author URI: https://marciofao.github.io/

 */
function mic_profile_fields()
{

?>

    <table class="form-table user-member-id-card-wrap-table" role="presentation">
        <tbody>
            <tr class="user-member-id-card-wrap">
                <th scope="row">Visualizar carteirinha</th>
                <td>
                    <label for="mic-link"><input name="rich_editing" type="checkbox" id="rich_editing" value="false">
                    <a href="#">
                        Ver carteirinha
                    </a>
                     </label>
                </td>
            </tr>

        </tbody>
    </table>
<?php

}

add_action('show_user_profile', 'mic_profile_fields');
add_action('edit_user_profile', 'mic_profile_fields');
