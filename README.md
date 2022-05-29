# member-id-card

Simple Wordpress plugin for user's id card creation and display <br>

<b>Features:</b><br>

<ul>
<li>
Adds a link to the user profile for viewing the user ID card.
</li>
<li>
Generates a QR code for Card validating and air-gap visualization from phones.
</li>
<li>
Loco translate compatible
</li>
<li>
Print link on card page
</li>
</ul>

Use the following hooks for custom contents in the card page:<br><br>
<b>Styling</b> <br>
add_action( 'mic_card_page_custom_css', 'custom_css_content_function' );<br><br>

<b>Content</b> <br>
add_action( 'mic_card_page_html_before_front', 'custom_html_before_front_function' ); <br>
add_action( 'mic_card_page_html_after_front', 'custom_html_after_front_function' );<br>
add_action( 'mic_card_page_html_before_back', 'custom_html_before_back_function' );<br>
add_action( 'mic_card_page_html_after_back', 'custom_html_after_back_function' );<br>

<p><b>Screenshots:</b></p>
<img src="https://raw.githubusercontent.com/marciofao/member-id-card/master/img/profile.png" alt="Wordpress profile page"> <br>
<img src="https://raw.githubusercontent.com/marciofao/member-id-card/master/img/generated-id-card.png" alt="Generated card">
