<?php

/*-- CUSTOM GALLERY START--*/

add_filter('post_gallery', 'my_post_gallery', 10, 2);
function my_post_gallery($output, $attr) {
    global $post;

    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }

    extract(shortcode_atts(array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post->ID,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => ''
    ), $attr));

    $id = intval($id);
    if ('RAND' == $order) $orderby = 'none';

    if (!empty($include)) {
        $include = preg_replace('/[^0-9,]+/', '', $include);
        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

        $attachments = array();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    }

    if (empty($attachments)) return '';

    // Here's your actual output, you may customize it to your need
    $output = "<div class=\"slideshow-wrapper gallery-wrapper\">\n";
    $output .= "<div class=\"preloader\"></div>\n";
    $output .= "<ul data-orbit>\n";

    // Now you loop through each attachment
    foreach ($attachments as $id => $attachment) {
        // Fetch the thumbnail (or full image, it's up to you)
        $img = wp_get_attachment_image_src($id, 'thumbnail');
//      $img = wp_get_attachment_image_src($id, 'medium');
//      $img = wp_get_attachment_image_src($id, 'my-custom-image-size');
//      $img = wp_get_attachment_image_src($id, 'full');
        $imgHires = wp_get_attachment_image_src($id, 'full');
        $caption = $attachment->post_excerpt;
        $fnam = basename($imgHires[0], ".jpg");

        $output .= "<li href=\"{$imgHires[0]}\" data-mfp-src=\"{$imgHires[0]}\" data-caption=\"$caption\" >\n";
        $output .= "<img src=\"{$img[0]}\" width=\"{$img[1]}\" height=\"{$img[2]}\" alt=\"$fnam\" />\n";
        $output .= "<span>".$caption."</span>\n";
        $output .= "</li>\n";
    }

    $output .= "</ul>\n";
    $output .= "</div>\n";

    return $output;

}


/*-- CUSTOM GALLERY END--*/

/*-- CUSTOM IMAGE LINKS --*/
function add_class_to_image_links($html, $attachment_id, $attachment) {
    $linkptrn = "/<a[^>]*>/";
    $found = preg_match($linkptrn, $html, $a_elem);
    // If no link, do nothing
    if($found <= 0) return $html;
    $a_elem = $a_elem[0];
    // Check to see if the link is to an uploaded image
    $is_attachment_link = strstr($a_elem, "wp-content/uploads/");
    // If link is to external resource, do nothing
    if($is_attachment_link === FALSE) return $html;
    if(strstr($a_elem, "class=\"") !== FALSE){ // If link already has class defined inject it to attribute
        $a_elem_new = str_replace("class=\"", "class=\"mfp-image-popup", $a_elem);
        $html = str_replace($a_elem, $a_elem_new, $html);
    }else{ // If no class defined, just add class attribute
        $html = str_replace("<a ", "<a class=\"mfp-image-popup\" ", $html);
    }
    return $html;
}
add_filter('image_send_to_editor', 'add_class_to_image_links', 10, 3);

?>
