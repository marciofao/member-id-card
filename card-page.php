<?php
$usr = get_user_by('id', base64_decode($_GET['card-view']));
?>

<!DOCTYPE html>
<html>

<head>
    <title>
        <?php _e('Member ID Card', 'mic') ?>
    </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script type="text/javascript" src="<?php echo MIC_PLUGIN_URI ?>/vendor/html5qrcode/qrcode.js">
        <?php echo MIC_PLUGIN_URI ?>
    </script>
    <script type="text/javascript" src="<?php echo MIC_PLUGIN_URI ?>/vendor/html5qrcode/html5-qrcode.js">
    </script>
    <style>
        /* It envisions a A4 printing logic */
        html {
            font-size: 1vw;
            font-family: Arial, Helvetica, sans-serif;
        }

        @media only screen and (max-width: 600px) {
            html {
                font-size: 2vw;
            }
            body{
                margin: 0;
            }
        }

        h1 {
            font-size: 2em;
        }

        .card {
            border: 1px solid black;
            width: 50em;
            height: 28.9em;
            position: relative;
            margin-bottom: 2em;
            padding: 1em;
            box-sizing: border-box;
        }

        .qrcode {
            width: 8em;
        }
        .picture{
            width: 30%;
        }
        .user-pic {
            width: 100%;
        }

        .tac {
            text-align: center;
        }

        .prel {
            position: relative;
        }

        .w100 {
            width: 100%;
        }

        .activity {

            position: absolute;
            bottom: 0;
            text-transform: uppercase;
            font-size: 3em;

        }

        <?php
        do_action('mic_card_page_custom_css');
        ?>
    </style>
</head>

<body>

    <div class="card card-front">
        <?php
        do_action('mic_card_page_html_before_front');
        ?>
        <div class="user-info">
            <h2><span class="display-name"><?php echo $usr->display_name ?> </span></h2>
            <div class="picture">
                <?php $profile_pic = get_usermeta($usr->ID, 'simple_local_avatar') ?>
                <img src="<?php echo $profile_pic['full'] ?>" alt="<?php _e('Profile Picture', 'mic') ?>" class="user-pic">
            </div>
        </div>


        <!-- This is where our QRCode will appear in. -->
        <div id="qrcode"></div>

        <script type="text/javascript">
            function updateQRCode(text) {

                var element = document.getElementById("qrcode");

                var bodyElement = document.body;
                if (element.lastChild)
                    element.replaceChild(showQRCode(text), element.lastChild);
                else
                    element.appendChild(showQRCode(text));

            }

            updateQRCode('<?php echo get_home_url() . "/?card-view=" . $_GET['card-view'] ?>');
        </script>

        <div class="user-activity tac w100">
            <div class="activity w100"><?php _e("Active User", "mic") ?></div>
        </div>

        <?php
        do_action('mic_card_page_html_after_front');
        ?>
    </div>
    <div class="card card-back">
        <?php
        do_action('mic_card_page_html_before_back');
        ?>

        <?php
        do_action('mic_card_page_html_after_back');
        ?>

    </div>
</body>

</html>
<style>

</style>