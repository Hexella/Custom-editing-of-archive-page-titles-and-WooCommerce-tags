<?php

// hexella-custom-meta-title-woocommerce ===========================
add_action('product_cat_add_form_fields', 'custom_category_fields');
add_action('product_tag_add_form_fields', 'custom_category_fields');
add_action('product_cat_edit_form_fields', 'custom_category_fields');
add_action('product_tag_edit_form_fields', 'custom_category_fields');

function custom_category_fields($term)
{

    $selected_meta_value = get_term_meta($term->term_id, 'custom_category_meta', true);

?>

    <tr class="form-field">
        <th scope="row" valign="top"><label for="custom-category-meta"><?php _e('Custom Title H1', 'text-domain'); ?></label></th>
        <td>
            <input type="text" name="custom_category_meta" id="custom-category-meta" value="<?php echo esc_attr($selected_meta_value); ?>">
            <p class="description"><?php _e('Custom title h1 for SEO', 'text-domain'); ?></p>
        </td>
    </tr>

<?php
}

add_action('edited_product_cat', 'save_custom_category_fields');
add_action('edited_product_tag', 'save_custom_category_fields');
add_action('create_product_cat', 'save_custom_category_fields');
add_action('create_product_tag', 'save_custom_category_fields');

function save_custom_category_fields($term_id)
{
    if (isset($_POST['custom_category_meta'])) {
        update_term_meta($term_id, 'custom_category_meta', sanitize_text_field($_POST['custom_category_meta']));
    }
}

function custom_meta_display()
{
    $term_id = get_queried_object_id();
    $custom_category_meta = get_term_meta($term_id, 'custom_category_meta', true);
    $title = '<h1 class="woocommerce-products-header__title page-title"></h1>';
    if (!empty($custom_category_meta)) {
        echo '<h1 class="woocommerce-products-header__title page-title">' . $custom_category_meta . '</h1>';
    } else {
        return $title;
    }
}
add_action('woocommerce_show_page_title', 'custom_meta_display', 10);
