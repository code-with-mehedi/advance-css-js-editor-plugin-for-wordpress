<?php 

if ( ! defined( 'ABSPATH' ) ) //Directly not access
     exit;


/*
* ACS Admin frontend
*/

function acs_file_type_metabox_callback( $post ) {

wp_nonce_field( 'acs_filetype_metabox_nonce', 'acs_filetype_nonce' ); ?>

<?php
    $file_type   = get_post_meta( $post->ID, 'acs-file-type', true );
    if($file_type == ''){
        $file_type = 'css';
    }
    $checked = $file_type;
  ?>
<p>
<input onclick="acs_editor_type(this)" type="radio" name="acs_file_type" value="<?php echo esc_html('html'); ?>" <?php if($checked == 'html'){echo 'checked'; } ?> disabled > <?php echo esc_html('HTML'); ?> <br>
<input onclick="acs_editor_type(this)" type="radio" name="acs_file_type" value="<?php echo esc_html('css'); ?>" <?php if($checked == 'css'){echo 'checked'; } ?>> <?php echo esc_html('CSS'); ?> <br>
<input onclick="acs_editor_type(this)" type="radio" name="acs_file_type" value="<?php echo esc_html('js'); ?>" <?php if($checked == 'js'){echo 'checked'; } ?>> <?php echo esc_html('JS'); ?> <br>
<input onclick="acs_editor_type(this)" type="radio" name="acs_file_type" value="<?php echo esc_html('php'); ?>" <?php if($checked == 'php'){echo 'checked'; } ?> disabled > <?php echo esc_html('PHP'); ?>
</p>

<?php 
}

/*
* ACS file editor
*/
function acs_file_editor_metabox_callback( $post ) {

wp_nonce_field( 'acs_editor_metabox_nonce', 'acs_editor_nonce' ); ?>
<?php         
    //$acs_editor_html = get_post_meta( $post->ID, 'acs_editor_html', true );
    $acs_editor_css = get_post_meta( $post->ID, 'acs_editor_css', true );
    $acs_editor_js = get_post_meta( $post->ID, 'acs_editor_js', true );
    //$acs_editor_php = get_post_meta( $post->ID, 'acs_editor_php', true );
?>

<h4 class="code-type">Please select code type</h4>
<!--
<h4 class="code-html">Write HTML code here</h4>
<textarea name="acs_editor_html" class="editor-theme" id="acs_code_editor_page_html" editor-theme="<?php //echo get_option('acs_select_theme'); ?>"><?php //echo wp_unslash($acs_editor_html); ?></textarea>
-->

<h4 class="code-css">Write CSS code here</h4>
<textarea name="acs_editor_css" class="editor-theme" id="acs_code_editor_page_css" editor-theme="<?php echo get_option('acs_select_theme'); ?>"><?php echo wp_unslash($acs_editor_css); ?></textarea>

<h4 class="code-js">Write JS code here</h4>
<textarea name="acs_editor_js" class="editor-theme" id="acs_code_editor_page_js" editor-theme="<?php echo get_option('acs_select_theme'); ?>"><?php echo wp_unslash($acs_editor_js); ?></textarea>
<!--
<h4 class="code-php">Write PHP code here</h4>
<textarea name="acs_editor_php" class="editor-theme" id="acs_code_editor_page_php" editor-theme="<?php //echo get_option('acs_select_theme'); ?>"><?php //echo wp_unslash($acs_editor_php); ?></textarea>
-->
<?php 
}

/*
* ACS linking options
*/
function acs_file_linking_metabox_callback( $post ) {

wp_nonce_field( 'acs_linking_metabox_nonce', 'acs_linking_nonce' ); ?>

<!--Enqueue all css and js-->
<p style="font-weight:600">Add all CSS and JS?</p>
<hr>

<?php         
    $acs_enq_all_css_js = get_post_meta( $post->ID, 'acs_enq_all_css_js', true );
    if(empty($acs_enq_all_css_js)){
        $acs_enq_all_css_js = 'all_css_js';
    }
    $checked = $acs_enq_all_css_js;
    ?>
<p>
<input type="radio" name="acs_enq_all_css_js" value="<?php echo esc_html('all_css_js'); ?>" <?php if($checked == 'all_css_js'){echo 'checked'; } ?>> <?php echo esc_html('Yes'); ?> <br>
<input type="radio" name="acs_enq_all_css_js" value="<?php echo esc_html('all_no'); ?>" <?php if($checked == 'all_no'){echo 'checked'; } ?>> <?php echo esc_html('No'); ?>
<br>
<input type="radio" name="acs_enq_all_css_js" value="<?php echo esc_html('only_css'); ?>" <?php if($checked == 'only_css'){echo 'checked'; } ?>> <?php echo esc_html('Only CSS'); ?> <br>
<input type="radio" name="acs_enq_all_css_js" value="<?php echo esc_html('only_js'); ?>" <?php if($checked == 'only_js'){echo 'checked'; } ?>> <?php echo esc_html('Only JS'); ?>
</p>

<!--HTML Linking type-->
<div id="html-sec">
<p style="font-weight:600">HTML Linking Options</p>
<hr>

<!--Location-->
<?php         
    $acs_htmlfile_location = get_post_meta( $post->ID, 'acs_htmlfile_location', true );
    $checked = $acs_htmlfile_location;
    ?>
<p style="font-weight:500">Set File Location</p>
<p>
    <input type="radio" name="acs_htmlfile_location" value="<?php echo esc_html('head'); ?>" <?php if($checked == 'head'){echo 'checked'; } ?>> <?php echo esc_html('header'); ?> <br>
    <input type="radio" name="acs_htmlfile_location" value="<?php echo esc_html('footer'); ?>" <?php if($checked == 'footer'){echo 'checked'; } ?>> <?php echo esc_html('Footer'); ?>
</p>

<!--Set Priority-->
<?php         
    $acs_htmlfile_priority = get_post_meta( $post->ID, 'acs_htmlfile_priority', true );
    if(empty($acs_htmlfile_priority)){
        $acs_htmlfile_priority = '99';
    }
    ?>
<p style="font-weight:500">Set Priority</p>
<p>
    <input min="5" type="number" name="acs_htmlfile_priority" value="<?php echo esc_attr($acs_htmlfile_priority); ?>" disabled>
</p>
</div>


<div id="css-sec">
<!-- Css Linking Type -->
<p style="font-weight:600">CSS Linking Options</p>
<hr>

<?php         
    $acs_cssfile_linking_type = get_post_meta( $post->ID, 'acs_cssfile_linking_type', true );
    if($acs_cssfile_linking_type = ''){
        $acs_cssfile_linking_type = 'external';
    }
    $checked = 'external';
    ?>
<p style="font-weight:500">Linking Type</p>
<p>
    <input type="radio" name="acs_cssfile_linking_type" value="<?php echo esc_html('external'); ?>" <?php if($checked == 'external'){echo 'checked'; } ?>> External <br>
    <input type="radio" name="acs_cssfile_linking_type" value="<?php echo esc_html('internal'); ?>" <?php if($checked == 'internal'){echo 'checked'; } ?> disabled> Internal
</p>
<!--Location-->
<?php         
    $acs_cssfile_location = get_post_meta( $post->ID, 'acs_cssfile_location', true );
    if($acs_cssfile_location == ''){
        $acs_cssfile_location = 'head';
    }
    $checked = $acs_cssfile_location;
    ?>
<p style="font-weight:500">Set File Location</p>
<p>
    <input type="radio" name="acs_cssfile_location" value="<?php echo esc_html('head'); ?>" <?php if($checked == 'head'){echo 'checked'; } ?>> header <br>
    <input type="radio" name="acs_cssfile_location" value="<?php echo esc_html('footer'); ?>" <?php if($checked == 'footer'){echo 'checked'; } ?> disabled> Footer
</p>
<!--Where in site-->
<?php         
    $acs_cssfile_site_location = get_post_meta( $post->ID, 'acs_cssfile_site_location', true );
    if($acs_cssfile_site_location == ''){
        $acs_cssfile_site_location = 'frontend';
    }
    $checked = $acs_cssfile_site_location;
    ?>
<p style="font-weight:500">Where in site</p>
<p>
    <input class="acs-site-location" type="radio" name="acs_cssfile_site_location" value="<?php echo esc_html('admin'); ?>" <?php if($checked == 'admin'){echo 'checked'; } ?>> Admin Area <br>
    <input class="acs-site-location" type="radio" name="acs_cssfile_site_location" value="<?php echo esc_html('frontend'); ?>" <?php if($checked == 'frontend'){echo 'checked'; } ?>> Frontend
</p>
<!--Set Priority-->
<?php         
    $acs_cssfile_priority = get_post_meta( $post->ID, 'acs_cssfile_priority', true );
    if(empty($acs_cssfile_priority)){
        $acs_cssfile_priority = '99';
    }

    $acs_cssfile_site_location = get_post_meta( $post->ID, 'acs_cssfile_site_location', true );
    if($acs_cssfile_site_location == ''){
        $acs_cssfile_site_location = 'frontend';
    }
    $checked = $acs_cssfile_site_location;
    ?>
<p style="font-weight:500">Set Priority</p>
<p>
    <input class="acs-file-priority" type="number" min="5" name="acs_cssfile_priority" value="<?php echo esc_attr($acs_cssfile_priority); ?>" <?php if($checked == 'frontend'){echo 'disabled';} ?> disabled >
</p>
</div>


<!--JS linking type-->
<div id="js-sec">
<p style="font-weight:600">JS Linking Options</p>
<hr>

<?php         
    $acs_jsfile_linking_type = get_post_meta( $post->ID, 'acs_jsfile_linking_type', true );
    $checked = 'external';
    ?>
<p style="font-weight:500">Linking Type</p>
<p>
    <input type="radio" name="acs_jsfile_linking_type" value="<?php echo esc_html('external'); ?>" <?php if($checked == 'external'){echo 'checked'; } ?>> External <br>
    <input type="radio" name="acs_jsfile_linking_type" value="<?php echo esc_html('internal'); ?>" <?php if($checked == 'internal'){echo 'checked'; } ?> disabled> Internal
</p>
<!--Location-->
<?php         
    $acs_jsfile_location = get_post_meta( $post->ID, 'acs_jsfile_location', true );
    if($acs_jsfile_location == ''){
        $acs_jsfile_location = 'footer';
    }
    $checked = $acs_jsfile_location;
    ?>
<p style="font-weight:500">Set File Location</p>
<p>
    <input type="radio" name="acs_jsfile_location" value="head" <?php if($checked == 'head'){echo 'checked'; } ?> disabled> header <br>
    <input type="radio" name="acs_jsfile_location" value="footer" <?php if($checked == 'footer'){echo 'checked'; } ?>> Footer
</p>
<!--Where in site-->
<?php         
    $acs_jsfile_site_location = get_post_meta( $post->ID, 'acs_jsfile_site_location', true );
    if($acs_jsfile_site_location == ''){
        $acs_jsfile_site_location = 'frontend';
    }
    $checked = $acs_jsfile_site_location;
    ?>
<p style="font-weight:500">Where in site</p>
<p>
    <input class="acs-site-location" type="radio" name="acs_jsfile_site_location" value="<?php echo esc_html('admin'); ?>" <?php if($checked == 'admin'){echo 'checked'; } ?> > Admin Area <br>
    <input class="acs-site-location" type="radio" name="acs_jsfile_site_location" value="<?php echo esc_html('frontend'); ?>" <?php if($checked == 'frontend'){echo 'checked'; } ?>> Frontend
</p>
<!--Set Priority-->
<?php         
    $acs_jsfile_priority = get_post_meta( $post->ID, 'acs_jsfile_priority', true );
    if(empty($acs_jsfile_priority)){
        $acs_jsfile_priority = '99';
    }

    $acs_jsfile_site_location = get_post_meta( $post->ID, 'acs_jsfile_site_location', true );
    if($acs_jsfile_site_location == ''){
        $acs_jsfile_site_location = 'frontend';
    }
    $checked = $acs_jsfile_site_location;
    ?>
<p style="font-weight:500">Set Priority</p>
<p>
    <input class="acs-file-priority" type="number" name="acs_jsfile_priority" value="<?php echo esc_attr($acs_jsfile_priority); ?>" <?php if($checked == 'frontend'){echo 'disabled';} ?> disabled >
</p>
</div>
<?php 
}