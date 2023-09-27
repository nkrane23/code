<?php

function classes() {
    list($options) = get_sub_field('options');

    echo 'builder-section-padding-top-' . $options['section_padding_top'];
    echo ' ' . 'builder-section-padding-bottom-' . $options['section_padding_bottom'];
    echo ' ' . 'builder-layout-padding-' . $options['layout_padding'];

    if ($options['font_color']) {
        echo ' ' . $options['font_color'];
    }

    if ($options['custom_class']) {
        echo ' ' . $options['custom_class'];
    }

    if ($options['background_repeat'] == true) {
        echo ' repeated';
    }
}

function sec_ID() {
    list($options) = get_sub_field('options');

    if ($options['custom_id']) {
        echo 'id="' . $options['custom_id'] . '"';
    }
}

function styles() {
    list($options) = get_sub_field('options');

    if ($options['background_image']) {
        echo 'background-image: url('. $options['background_image'] . '); ';
    }

    if ($options['background_color']) {
        echo 'background-color:'. $options['background_color'] . ';';
    }

    if ($options['background_position']) {
        echo 'background-position:'. $options['background_position'] . ';';
    }

    if (!is_array($options['background_size']) && isset($options['background_size'])) {
        echo 'background-size:'. $options['background_size'] . ';';
    }
}

function btn_opts() {
    return $align = 'style="text-align: ' . get_sub_field('alignment') . ';"';
}

function btn_classes() {
    if(get_sub_field('animate') == 'true') {
        return 'class="builder-component builder-component-button-special"';
    } else {
        return 'class="builder-component builder-component-button"';
    }
}

function jump_link() {
    list($options) = get_sub_field('options');
    echo '<span class="'. $options['jump_link'] .'" data-scroll='. $options['jump_link'] .'></span>';
}