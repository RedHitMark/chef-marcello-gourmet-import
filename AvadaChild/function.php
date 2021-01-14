<?php
function theme_enqueue_styles() {
    wp_enqueue_style('child-style', get_stylesheet_directory_uri().'/style.css', array('avada-stylesheet'));
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function avada_lang_setup() {
    $lang = get_stylesheet_directory().'/languages';
    load_child_theme_textdomain('Avada', $lang);
}
add_action('after_setup_theme', 'avada_lang_setup');


function convertYoutube($video_url) {
    return preg_replace(
        '/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i',
        '<iframe width="1920" height="1080" src="//www.youtube.com/embed/$2" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>',
        $video_url
    );
}
function get_recipe_video($post_id) {
    $video_location = get_field('video_location', $post_id);

    switch ($video_location) {
        case 'facebook':
            break;

        case 'youtube':
            return '<div class="fluid-width-video-wrapper" style="padding-top: 56.25%;">' . convertYoutube(get_field('youtube_video', $post_id)) . '</div>';
    }
    return '';
}

function do_recipe_content($atts) {
    $post_id = get_the_ID();

    $content = get_the_content($post_id);
    $content = apply_filters( 'the_content', $content );
    $content = str_replace( ']]>', ']]&gt;', $content );

    $ingredients = get_field('ingredients', $post_id);
    $people_text = get_field('people', $post_id);

    $slider_container =
        '[fusion_builder_container type="flex" hundred_percent="no" hundred_percent_height="no" hundred_percent_height_scroll="no" align_content="stretch" flex_align_items="flex-start" flex_justify_content="center" hundred_percent_height_center_content="yes" equal_height_columns="no" container_tag="div" hide_on_mobile="small-visibility,medium-visibility,large-visibility" status="published" border_style="solid" box_shadow="no" box_shadow_blur="0" box_shadow_spread="0" gradient_start_position="0" gradient_end_position="100" gradient_type="linear" radial_direction="center center" linear_angle="180" background_position="center center" background_repeat="no-repeat" fade="no" background_parallax="none" enable_mobile="no" parallax_speed="0.3" background_blend_mode="none" video_aspect_ratio="16:9" video_loop="yes" video_mute="yes" absolute="off" absolute_devices="small,medium,large" sticky="off" sticky_devices="small-visibility,medium-visibility,large-visibility" sticky_transition_offset="0" scroll_offset="0" animation_direction="left" animation_speed="0.3" filter_hue="0" filter_saturation="100" filter_brightness="100" filter_contrast="100" filter_invert="0" filter_sepia="0" filter_opacity="100" filter_blur="0" filter_hue_hover="0" filter_saturation_hover="100" filter_brightness_hover="100" filter_contrast_hover="100" filter_invert_hover="0" filter_sepia_hover="0" filter_opacity_hover="100" filter_blur_hover="0" padding_bottom="0px" margin_bottom="0px"]
            [fusion_builder_row]
                [fusion_builder_column type="3_4" type="3_4" align_self="auto" content_layout="column" align_content="flex-start" content_wrap="wrap" spacing="" center_content="no" link="" target="_self" min_height="" hide_on_mobile="small-visibility,medium-visibility,large-visibility" sticky_display="normal,sticky" class="" id="" type_medium="" type_small="" order_medium="0" order_small="0" dimension_spacing_medium="" dimension_spacing_small="" dimension_spacing="" dimension_margin_medium="" dimension_margin_small="" dimension_margin="" padding_medium="" padding_small="" padding_top="" padding_right="" padding_bottom="" padding_left="" hover_type="none" border_sizes="" border_color="" border_style="solid" border_radius="" box_shadow="yes" dimension_box_shadow="" box_shadow_blur="10" box_shadow_spread="0" box_shadow_color="rgba(18,18,18,0.15)" box_shadow_style="" background_type="single" gradient_start_color="" gradient_end_color="" gradient_start_position="0" gradient_end_position="100" gradient_type="linear" radial_direction="center center" linear_angle="180" background_color="#f1f1f1" background_image="" background_image_id="" background_position="left top" background_repeat="no-repeat" background_blend_mode="none" animation_type="" animation_direction="left" animation_speed="0.3" animation_offset="" filter_type="regular" filter_hue="0" filter_saturation="100" filter_brightness="100" filter_contrast="100" filter_invert="0" filter_sepia="0" filter_opacity="100" filter_blur="0" filter_hue_hover="0" filter_saturation_hover="100" filter_brightness_hover="100" filter_contrast_hover="100" filter_invert_hover="0" filter_sepia_hover="0" filter_opacity_hover="100" filter_blur_hover="0" border_radius_top_left="3px" border_radius_top_right="3px" border_radius_bottom_right="3px" border_radius_bottom_left="3px" box_shadow_horizontal="5px" box_shadow_vertical="5px" last="no" border_position="all" margin_bottom="0"]
                    [fusion_tb_featured_slider show_first_featured_image="yes" hover_type="none" hide_on_mobile="small-visibility,medium-visibility,large-visibility" class="" id="" /]
                [/fusion_builder_column]
            [/fusion_builder_row]
        [/fusion_builder_container]';

    $share_container =
        '[fusion_builder_container type="flex" hundred_percent="no" hundred_percent_height="no" hundred_percent_height_scroll="no" align_content="stretch" flex_align_items="flex-start" flex_justify_content="flex-start" hundred_percent_height_center_content="yes" equal_height_columns="no" container_tag="div" hide_on_mobile="small-visibility,medium-visibility,large-visibility" status="published" border_style="solid" box_shadow="no" box_shadow_blur="0" box_shadow_spread="0" gradient_start_position="0" gradient_end_position="100" gradient_type="linear" radial_direction="center center" linear_angle="180" background_position="center center" background_repeat="no-repeat" fade="no" background_parallax="none" enable_mobile="no" parallax_speed="0.3" background_blend_mode="none" video_aspect_ratio="16:9" video_loop="yes" video_mute="yes" absolute="off" absolute_devices="small,medium,large" sticky="off" sticky_devices="small-visibility,medium-visibility,large-visibility" sticky_transition_offset="0" scroll_offset="0" animation_direction="left" animation_speed="0.3" filter_hue="0" filter_saturation="100" filter_brightness="100" filter_contrast="100" filter_invert="0" filter_sepia="0" filter_opacity="100" filter_blur="0" filter_hue_hover="0" filter_saturation_hover="100" filter_brightness_hover="100" filter_contrast_hover="100" filter_invert_hover="0" filter_sepia_hover="0" filter_opacity_hover="100" filter_blur_hover="0"]
            [fusion_builder_row]
                [fusion_builder_column type="1_1" type="1_1" align_self="center" content_layout="column" align_content="flex-start" content_wrap="wrap" spacing="" center_content="no" link="" target="_self" min_height="" hide_on_mobile="small-visibility,medium-visibility,large-visibility" sticky_display="normal,sticky" class="" id="" type_medium="" type_small="" order_medium="0" order_small="0" dimension_spacing_medium="" dimension_spacing_small="" dimension_spacing="" dimension_margin_medium="" dimension_margin_small="" dimension_margin="20px 20px" padding_medium="" padding_small="" padding_top="" padding_right="" padding_bottom="" padding_left="" hover_type="none" border_sizes="" border_color="" border_style="solid" border_radius="" box_shadow="no" dimension_box_shadow="" box_shadow_blur="0" box_shadow_spread="0" box_shadow_color="" box_shadow_style="" background_type="single" gradient_start_color="" gradient_end_color="" gradient_start_position="0" gradient_end_position="100" gradient_type="linear" radial_direction="center center" linear_angle="180" background_color="" background_image="" background_image_id="" background_position="left top" background_repeat="no-repeat" background_blend_mode="none" animation_type="" animation_direction="left" animation_speed="0.3" animation_offset="" filter_type="regular" filter_hue="0" filter_saturation="100" filter_brightness="100" filter_contrast="100" filter_invert="0" filter_sepia="0" filter_opacity="100" filter_blur="0" filter_hue_hover="0" filter_saturation_hover="100" filter_brightness_hover="100" filter_contrast_hover="100" filter_invert_hover="0" filter_sepia_hover="0" filter_opacity_hover="100" filter_blur_hover="0" margin_top="20px" margin_bottom="20px" last="no" border_position="all"]
                    [fusion_sharing tagline="" tagline_color="" backgroundcolor="#ffffff" title="" link="" description="" icons_boxed="yes" icons_boxed_radius="50%" color_type="" icon_colors="" box_colors="" tooltip_placement="none" pinterest_image="" pinterest_image_id="" hide_on_mobile="small-visibility,medium-visibility,large-visibility" sticky_display="normal,sticky" class="" id="" /]
                [/fusion_builder_column]
            [/fusion_builder_row]
        [/fusion_builder_container]';

    $introduction_container =
        '[fusion_builder_container type="flex" hundred_percent="no" hundred_percent_height="no" hundred_percent_height_scroll="no" align_content="stretch" flex_align_items="flex-start" flex_justify_content="flex-start" hundred_percent_height_center_content="yes" equal_height_columns="no" container_tag="div" hide_on_mobile="small-visibility,medium-visibility,large-visibility" status="published" border_style="solid" box_shadow="no" box_shadow_blur="0" box_shadow_spread="0" gradient_start_position="0" gradient_end_position="100" gradient_type="linear" radial_direction="center center" linear_angle="180" background_position="center center" background_repeat="no-repeat" fade="no" background_parallax="none" enable_mobile="no" parallax_speed="0.3" background_blend_mode="none" video_aspect_ratio="16:9" video_loop="yes" video_mute="yes" absolute="off" absolute_devices="small,medium,large" sticky="off" sticky_devices="small-visibility,medium-visibility,large-visibility" sticky_transition_offset="0" scroll_offset="0" animation_direction="left" animation_speed="0.3" filter_hue="0" filter_saturation="100" filter_brightness="100" filter_contrast="100" filter_invert="0" filter_sepia="0" filter_opacity="100" filter_blur="0" filter_hue_hover="0" filter_saturation_hover="100" filter_brightness_hover="100" filter_contrast_hover="100" filter_invert_hover="0" filter_sepia_hover="0" filter_opacity_hover="100" filter_blur_hover="0"]
            [fusion_builder_row]
                [fusion_builder_column type="1_1" type="1_1" align_self="center" content_layout="column" align_content="flex-start" content_wrap="wrap" spacing="" center_content="no" link="" target="_self" min_height="" hide_on_mobile="small-visibility,medium-visibility,large-visibility" sticky_display="normal,sticky" class="" id="" type_medium="" type_small="" order_medium="0" order_small="0" dimension_spacing_medium="" dimension_spacing_small="" dimension_spacing="" dimension_margin_medium="" dimension_margin_small="" dimension_margin="" padding_medium="" padding_small="" padding_top="" padding_right="" padding_bottom="" padding_left="" hover_type="none" border_sizes="" border_color="" border_style="solid" border_radius="" box_shadow="no" dimension_box_shadow="" box_shadow_blur="0" box_shadow_spread="0" box_shadow_color="" box_shadow_style="" background_type="single" gradient_start_color="" gradient_end_color="" gradient_start_position="0" gradient_end_position="100" gradient_type="linear" radial_direction="center center" linear_angle="180" background_color="" background_image="" background_image_id="" background_position="left top" background_repeat="no-repeat" background_blend_mode="none" animation_type="" animation_direction="left" animation_speed="0.3" animation_offset="" filter_type="regular" filter_hue="0" filter_saturation="100" filter_brightness="100" filter_contrast="100" filter_invert="0" filter_sepia="0" filter_opacity="100" filter_blur="0" filter_hue_hover="0" filter_saturation_hover="100" filter_brightness_hover="100" filter_contrast_hover="100" filter_invert_hover="0" filter_sepia_hover="0" filter_opacity_hover="100" filter_blur_hover="0" last="no" border_position="all"]
                    [fusion_title title_type="text" rotation_effect="bounceIn" display_time="1200" highlight_effect="circle" loop_animation="off" highlight_width="9" highlight_top_margin="0" before_text="" rotation_text="" highlight_text="" after_text="" content_align_medium="" content_align_small="" content_align="center" size="2" font_size="" animated_font_size="" line_height="" letter_spacing="" text_shadow="no" text_shadow_blur="0" text_shadow_color="" dimensions_medium="" dimensions_small="" text_color="" animated_text_color="" highlight_color="" style_type="default" sep_color="" animation_type="" animation_direction="left" animation_speed="0.3" animation_offset="" hide_on_mobile="small-visibility,medium-visibility,large-visibility" sticky_display="normal,sticky" class="" id="" fusion_font_variant_title_font=""]
                        INTRODUCTION
                    [/fusion_title]
                    [fusion_text columns="" column_min_width="" column_spacing="" rule_style="default" rule_size="" rule_color="" font_size="" line_height="" letter_spacing="" text_color="" content_alignment_medium="" content_alignment_small="" content_alignment="" animation_type="" animation_direction="left" animation_speed="0.3" animation_offset="" hide_on_mobile="small-visibility,medium-visibility,large-visibility" sticky_display="normal,sticky" class="" id=""]
                        '. $content .'
                    [/fusion_text]                 
                [/fusion_builder_column]
            [/fusion_builder_row]
        [/fusion_builder_container]';


    $ingredients_container = '';
    if ($ingredients && count($ingredients)>0) {

        $ingredient_blocks = '';
        foreach ($ingredients as $ingredient_block) {
            $left_bullet_list = '<ul>';
            $right_bullet_list = '<ul>';
            for($i = 0; $i < count($ingredient_block['ingredient_block_list']); $i++) {
                if ($i % 2 === 0) {
                    $left_bullet_list .= '<li>'.$ingredient_block['ingredient_block_list'][$i]['ingredient_name'].'</li>';
                } else {
                    $right_bullet_list .= '<li>'.$ingredient_block['ingredient_block_list'][$i]['ingredient_name'].'</li>';
                }
            }
            $left_bullet_list .= '</ul>';
            $right_bullet_list .= '</ul>';

            if ($ingredient_block['block_name'] !== '') {
                $ingredient_blocks .=
                    '[fusion_title title_type="text" rotation_effect="bounceIn" display_time="1200" highlight_effect="circle" loop_animation="off" highlight_width="9" highlight_top_margin="0" before_text="" rotation_text="" highlight_text="" after_text="" content_align_medium="" content_align_small="" content_align="center" size="4" font_size="" animated_font_size="" line_height="" letter_spacing="" text_shadow="no" text_shadow_blur="0" text_shadow_color="" dimensions_medium="" dimensions_small="" text_color="" animated_text_color="" highlight_color="" style_type="default" sep_color="" animation_type="" animation_direction="left" animation_speed="0.3" animation_offset="" hide_on_mobile="small-visibility,medium-visibility,large-visibility" sticky_display="normal,sticky" class="" id="" fusion_font_variant_title_font=""]
                        ' . $ingredient_block['block_name'] . '
                    [/fusion_title]';
            }
            $ingredient_blocks .=
                '[fusion_builder_row_inner]
                    [fusion_builder_column_inner type="1_2" type="1_2" align_self="auto" content_layout="column" align_content="flex-start" content_wrap="wrap" spacing="" center_content="no" link="" target="_self" min_height="" hide_on_mobile="small-visibility,medium-visibility,large-visibility" sticky_display="normal,sticky" class="" id="" order_medium="0" order_small="0" hover_type="none" border_color="" border_style="solid" box_shadow="no" box_shadow_blur="0" box_shadow_spread="0" box_shadow_color="" box_shadow_style="" background_type="single" gradient_start_position="0" gradient_end_position="100" gradient_type="linear" radial_direction="center center" linear_angle="180" background_color="" background_image="" background_image_id="" background_position="left top" background_repeat="no-repeat" background_blend_mode="none" animation_type="" animation_direction="left" animation_speed="0.3" animation_offset="" filter_type="regular" filter_hue="0" filter_saturation="100" filter_brightness="100" filter_contrast="100" filter_invert="0" filter_sepia="0" filter_opacity="100" filter_blur="0" filter_hue_hover="0" filter_saturation_hover="100" filter_brightness_hover="100" filter_contrast_hover="100" filter_invert_hover="0" filter_sepia_hover="0" filter_opacity_hover="100" filter_blur_hover="0" last="no" border_position="all"]
                        [fusion_text columns="1" column_min_width="" column_spacing="" rule_style="default" rule_size="" rule_color="" font_size="" line_height="" letter_spacing="" text_color="" content_alignment_medium="" content_alignment_small="" content_alignment="" animation_type="" animation_direction="left" animation_speed="0.3" animation_offset="" hide_on_mobile="small-visibility,medium-visibility,large-visibility" sticky_display="normal,sticky" class="" id="" fusion_font_variant_text_font=""]
                            ' . $left_bullet_list . '
                        [/fusion_text]
                    [/fusion_builder_column_inner]
                    [fusion_builder_column_inner type="1_2" type="1_2" align_self="auto" content_layout="column" align_content="flex-start" content_wrap="wrap" spacing="" center_content="no" link="" target="_self" min_height="" hide_on_mobile="small-visibility,medium-visibility,large-visibility" sticky_display="normal,sticky" class="" id="" order_medium="0" order_small="0" hover_type="none" border_color="" border_style="solid" box_shadow="no" box_shadow_blur="0" box_shadow_spread="0" box_shadow_color="" box_shadow_style="" background_type="single" gradient_start_position="0" gradient_end_position="100" gradient_type="linear" radial_direction="center center" linear_angle="180" background_color="" background_image="" background_image_id="" background_position="left top" background_repeat="no-repeat" background_blend_mode="none" animation_type="" animation_direction="left" animation_speed="0.3" animation_offset="" filter_type="regular" filter_hue="0" filter_saturation="100" filter_brightness="100" filter_contrast="100" filter_invert="0" filter_sepia="0" filter_opacity="100" filter_blur="0" filter_hue_hover="0" filter_saturation_hover="100" filter_brightness_hover="100" filter_contrast_hover="100" filter_invert_hover="0" filter_sepia_hover="0" filter_opacity_hover="100" filter_blur_hover="0" last="no" border_position="all"]
                        [fusion_text columns="1" column_min_width="" column_spacing="" rule_style="default" rule_color="" font_size="" line_height="" letter_spacing="" text_color="" content_alignment_medium="" content_alignment_small="" content_alignment="" animation_type="" animation_direction="left" animation_speed="0.3" animation_offset="" hide_on_mobile="small-visibility,medium-visibility,large-visibility" sticky_display="normal,sticky" class="" id="" fusion_font_variant_text_font=""]
                            ' . $right_bullet_list . '
                        [/fusion_text]
                    [/fusion_builder_column_inner]
                [/fusion_builder_row_inner]';
        }



        $ingredients_container =
            '[fusion_builder_container type="flex" hundred_percent="no" hundred_percent_height="no" hundred_percent_height_scroll="no" align_content="stretch" flex_align_items="flex-start" flex_justify_content="flex-start" hundred_percent_height_center_content="yes" equal_height_columns="no" container_tag="div" hide_on_mobile="small-visibility,medium-visibility,large-visibility" status="published" border_style="solid" box_shadow="no" box_shadow_blur="0" box_shadow_spread="0" gradient_start_position="0" gradient_end_position="100" gradient_type="linear" radial_direction="center center" linear_angle="180" background_position="center center" background_repeat="no-repeat" fade="no" background_parallax="none" enable_mobile="no" parallax_speed="0.3" background_blend_mode="none" video_aspect_ratio="16:9" video_loop="yes" video_mute="yes" absolute="off" absolute_devices="small,medium,large" sticky="off" sticky_devices="small-visibility,medium-visibility,large-visibility" sticky_transition_offset="0" scroll_offset="0" animation_direction="left" animation_speed="0.3" filter_hue="0" filter_saturation="100" filter_brightness="100" filter_contrast="100" filter_invert="0" filter_sepia="0" filter_opacity="100" filter_blur="0" filter_hue_hover="0" filter_saturation_hover="100" filter_brightness_hover="100" filter_contrast_hover="100" filter_invert_hover="0" filter_sepia_hover="0" filter_opacity_hover="100" filter_blur_hover="0"]
                [fusion_builder_row]
                    [fusion_builder_column type="1_1" type="1_1" align_self="auto" content_layout="column" align_content="flex-start" content_wrap="wrap" spacing="" center_content="no" link="" target="_self" min_height="" hide_on_mobile="small-visibility,medium-visibility,large-visibility" sticky_display="normal,sticky" class="" id="" type_medium="" type_small="" order_medium="0" order_small="0" dimension_spacing_medium="" dimension_spacing_small="" dimension_spacing="" dimension_margin_medium="" dimension_margin_small="" dimension_margin="" padding_medium="" padding_small="" padding_top="" padding_right="30px" padding_bottom="" padding_left="30px" hover_type="none" border_sizes="" border_color="" border_style="solid" border_radius="" box_shadow="yes" dimension_box_shadow="" box_shadow_blur="10" box_shadow_spread="0" box_shadow_color="rgba(18,18,18,0.15)" box_shadow_style="" background_type="single" gradient_start_color="" gradient_end_color="" gradient_start_position="0" gradient_end_position="100" gradient_type="linear" radial_direction="center center" linear_angle="180" background_color="#f1f1f1" background_image="" background_image_id="" background_position="left top" background_repeat="no-repeat" background_blend_mode="none" animation_type="" animation_direction="left" animation_speed="0.3" animation_offset="" filter_type="regular" filter_hue="0" filter_saturation="100" filter_brightness="100" filter_contrast="100" filter_invert="0" filter_sepia="0" filter_opacity="100" filter_blur="0" filter_hue_hover="0" filter_saturation_hover="100" filter_brightness_hover="100" filter_contrast_hover="100" filter_invert_hover="0" filter_sepia_hover="0" filter_opacity_hover="100" filter_blur_hover="0" border_radius_top_left="5px" border_radius_top_right="5px" border_radius_bottom_right="5px" border_radius_bottom_left="5px" box_shadow_vertical="5px" box_shadow_horizontal="5px" last="no" border_position="all"]
                        [fusion_title title_type="text" rotation_effect="bounceIn" display_time="1200" highlight_effect="circle" loop_animation="off" highlight_width="9" highlight_top_margin="0" before_text="" rotation_text="" highlight_text="" after_text="" content_align_medium="" content_align_small="" content_align="center" size="2" font_size="" animated_font_size="" line_height="" letter_spacing="" text_shadow="no" text_shadow_blur="0" text_shadow_color="" dimensions_medium="" dimensions_small="" text_color="" animated_text_color="" highlight_color="" style_type="default" sep_color="" animation_type="" animation_direction="left" animation_speed="0.3" animation_offset="" hide_on_mobile="small-visibility,medium-visibility,large-visibility" sticky_display="normal,sticky" class="" id="" fusion_font_variant_title_font=""]
                            INGREDIENTS
                        [/fusion_title]
                        [fusion_title title_type="text" rotation_effect="bounceIn" display_time="1200" highlight_effect="circle" loop_animation="off" highlight_width="9" highlight_top_margin="0" before_text="" rotation_text="" highlight_text="" after_text="" content_align_medium="" content_align_small="" content_align="center" size="3" font_size="" animated_font_size="" line_height="" letter_spacing="" text_shadow="no" text_shadow_blur="0" text_shadow_color="" dimensions_medium="" dimensions_small="" text_color="" animated_text_color="" highlight_color="" style_type="default" sep_color="" animation_type="" animation_direction="left" animation_speed="0.3" animation_offset="" hide_on_mobile="small-visibility,medium-visibility,large-visibility" sticky_display="normal,sticky" class="" id="" fusion_font_variant_title_font=""]
                            ' . $people_text . '
                        [/fusion_title]
                        ' . $ingredient_blocks . '
                    [/fusion_builder_column]
                [/fusion_builder_row]
            [/fusion_builder_container]';
    }


    $preparation_container =
        '[fusion_builder_container type="flex" hundred_percent="no" hundred_percent_height="no" hundred_percent_height_scroll="no" align_content="stretch" flex_align_items="flex-start" flex_justify_content="center" hundred_percent_height_center_content="yes" equal_height_columns="no" container_tag="div" hide_on_mobile="small-visibility,medium-visibility,large-visibility" status="published" border_style="solid" box_shadow="no" box_shadow_blur="0" box_shadow_spread="0" gradient_start_position="0" gradient_end_position="100" gradient_type="linear" radial_direction="center center" linear_angle="180" background_position="center center" background_repeat="no-repeat" fade="no" background_parallax="none" enable_mobile="no" parallax_speed="0.3" background_blend_mode="none" video_aspect_ratio="16:9" video_loop="yes" video_mute="yes" absolute="off" absolute_devices="small,medium,large" sticky="off" sticky_devices="small-visibility,medium-visibility,large-visibility" sticky_transition_offset="0" scroll_offset="0" animation_direction="left" animation_speed="0.3" filter_hue="0" filter_saturation="100" filter_brightness="100" filter_contrast="100" filter_invert="0" filter_sepia="0" filter_opacity="100" filter_blur="0" filter_hue_hover="0" filter_saturation_hover="100" filter_brightness_hover="100" filter_contrast_hover="100" filter_invert_hover="0" filter_sepia_hover="0" filter_opacity_hover="100" filter_blur_hover="0"]
            [fusion_builder_row]
                [fusion_builder_column type="1_1" type="1_1" align_self="auto" content_layout="column" align_content="flex-start" content_wrap="wrap" spacing="" center_content="no" link="" target="_self" min_height="" hide_on_mobile="small-visibility,medium-visibility,large-visibility" sticky_display="normal,sticky" class="" id="" order_medium="0" order_small="0" hover_type="none" border_color="" border_style="solid" box_shadow="no" box_shadow_blur="0" box_shadow_spread="0" box_shadow_color="" box_shadow_style="" background_type="single" gradient_start_position="0" gradient_end_position="100" gradient_type="linear" radial_direction="center center" linear_angle="180" background_color="" background_image="" background_image_id="" background_position="left top" background_repeat="no-repeat" background_blend_mode="none" animation_type="" animation_direction="left" animation_speed="0.3" animation_offset="" filter_type="regular" filter_hue="0" filter_saturation="100" filter_brightness="100" filter_contrast="100" filter_invert="0" filter_sepia="0" filter_opacity="100" filter_blur="0" filter_hue_hover="0" filter_saturation_hover="100" filter_brightness_hover="100" filter_contrast_hover="100" filter_invert_hover="0" filter_sepia_hover="0" filter_opacity_hover="100" filter_blur_hover="0" last="no" border_position="all"]
                    [fusion_title title_type="text" rotation_effect="bounceIn" display_time="1200" highlight_effect="circle" loop_animation="off" highlight_width="9" highlight_top_margin="0" before_text="" rotation_text="" highlight_text="" after_text="" content_align_medium="" content_align_small="" content_align="center" size="2" font_size="" animated_font_size="" line_height="" letter_spacing="" text_shadow="no" text_shadow_blur="0" text_shadow_color="" dimensions_medium="" dimensions_small="" text_color="" animated_text_color="" highlight_color="" style_type="default" sep_color="" animation_type="" animation_direction="left" animation_speed="0.3" animation_offset="" hide_on_mobile="small-visibility,medium-visibility,large-visibility" sticky_display="normal,sticky" class="" id="" fusion_font_variant_title_font=""]
                        PREPARATION
                    [/fusion_title]
                [/fusion_builder_column]
                [fusion_builder_column type="3_4" type="3_4" align_self="auto" content_layout="column" align_content="center" content_wrap="wrap" spacing="" center_content="no" link="" target="_self" min_height="" hide_on_mobile="small-visibility,medium-visibility,large-visibility" sticky_display="normal,sticky" class="" id="" type_medium="" type_small="" order_medium="0" order_small="0" dimension_spacing_medium="" dimension_spacing_small="" dimension_spacing="" dimension_margin_medium="" dimension_margin_small="" dimension_margin="" padding_medium="" padding_small="" padding_top="" padding_right="" padding_bottom="" padding_left="" hover_type="none" border_sizes="" border_color="" border_style="solid" border_radius="" box_shadow="yes" dimension_box_shadow="" box_shadow_blur="10" box_shadow_spread="0" box_shadow_color="rgba(18,18,18,0.15)" box_shadow_style="" background_type="single" gradient_start_color="" gradient_end_color="" gradient_start_position="0" gradient_end_position="100" gradient_type="linear" radial_direction="center center" linear_angle="180" background_color="#f1f1f1" background_image="" background_image_id="" background_position="left top" background_repeat="no-repeat" background_blend_mode="none" animation_type="" animation_direction="left" animation_speed="0.3" animation_offset="" filter_type="regular" filter_hue="0" filter_saturation="100" filter_brightness="100" filter_contrast="100" filter_invert="0" filter_sepia="0" filter_opacity="100" filter_blur="0" filter_hue_hover="0" filter_saturation_hover="100" filter_brightness_hover="100" filter_contrast_hover="100" filter_invert_hover="0" filter_sepia_hover="0" filter_opacity_hover="100" filter_blur_hover="0" border_radius_top_left="3px" border_radius_top_right="3px" border_radius_bottom_right="3px" border_radius_bottom_left="3px" box_shadow_horizontal="5px" box_shadow_vertical="5px" last="no" border_position="all" margin_bottom="0"]
                    [fusion_code]
                        '. get_recipe_video($post_id) .'
                    [/fusion_code]
                [/fusion_builder_column]
            [/fusion_builder_row]
        [/fusion_builder_container]';

    $style =
        '<style>
            .fusion-sharing-box {
                margin: 0 !important;
            }
            .fusion-sharing-box .fusion-social-networks{
                text-align: center !important;
            }
            .flexslider {
                margin: 0 !important;
            }
        </style>';

    return $style . do_shortcode($slider_container . $share_container . $introduction_container . $ingredients_container . $preparation_container);
}
add_shortcode('recipe-content-shortcode', 'do_recipe_content');

function action_woocommerce_before_single_product_summary() {
    $youtube_promoting_video = get_field('youtube_promoting_video');
    if ($youtube_promoting_video && $youtube_promoting_video !== "") {
        $output =
            '<div class="promoting-container">
                <div class="promoting-video-contianer">
                    <div class="fluid-width-video-wrapper" style="padding-top: 56.25%;">'.convertYoutube($youtube_promoting_video).'</div>
                </div>
            </div>';

        $style =
            '<style>
                .promoting-container{clear:both; width: 100%;display: flex;justify-content: center; margin-bottom: 10px}
                .promoting-video-contianer {
                        width: 100%;max-width: 1000px;overflow: hidden;
                        border-radius: 8px !important;box-shadow: rgba(128, 128, 128, 0.5) 5px 5px 10px 0;
                }
            </style>';

        echo $style . $output;
    }

    $link_for_more_details = get_field('link_for_more_details');
    if ($link_for_more_details && $link_for_more_details !== "") {
        $output =
            '<div class="more-details-container">
                <a class="fusion-button button-flat fusion-button-default-size button-default button-1 fusion-button-default-span fusion-button-default-type" target="_blank" rel="noopener noreferrer" href="'.$link_for_more_details.'">
                    <span class="fusion-button-text">More details</span>
                </a>
            </div>';

        $style =
            '<style>
                .more-details-container{clear:both; width: 100%;display: flex;justify-content: center;}
            </style>';

        echo $style . $output;
    }
}
add_action( 'woocommerce_after_single_product_summary', 'action_woocommerce_before_single_product_summary', 2);

