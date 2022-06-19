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
        <?php require_once("style.css") ?>
        <?php do_action('mic_card_page_custom_css') ?>
    </style>
</head>

<body>
    <div class="print">
        <a href="javascript:window.print()"><?php _e('Print page', 'mic') ?></a>
    </div>

    <div class="card card-front">
        <?php
        do_action('mic_card_page_html_before_front');
        ?>
        <div class="user-info">
            <h2><span class="display-name"><?php echo $usr->display_name ?> </span></h2>
            <?php $profile_pic = get_user_meta($usr->ID, 'simple_local_avatar', true)['full'] ?>
                <?php if (!$profile_pic) $profile_pic = MIC_PLUGIN_URI . 'img/blank_profile.png' ?>
            <div class="picture" style="background: url('<?php echo $profile_pic ?>')">
               
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