<?php

function twitstrap_options_page_sections() {
    $sections = array();
    $sections['text_section']     = __('Text Form Fields', 'twitstrap');
    $sections['textarea_section'] = __('Textarea Form Fields', 'twitstrap');
    $sections['select_section']   = __('Select Form Fields', 'twitstrap');
    $sections['checkbox_section'] = __('Checkbox Form Fields', 'twitstrap');

    return $sections;
}

?>