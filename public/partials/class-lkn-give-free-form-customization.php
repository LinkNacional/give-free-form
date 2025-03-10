<?php
$id_prefix = !empty($args) ? $args : '';
$form_meta_keys = [
    'free_form-fields_lkn_form_style_status' => 'status',
    'free_form-fields_lkn_form_color' => 'color',
    'free_form-fields_lkn_details_color' => 'colorDet',
    'free_form-fields_lkn_title_color' => 'titleColor',
    'free_form-fields_lkn_title_size' => 'titleSize',
    'free_form-fields_lkn_section_margin' => 'margin',
    'free_form-fields_lkn_btn_border_color' => 'btnBorderColor',
    'free_form-fields_lkn_btn_border_size' => 'btnBorderSize',
    'free_form-fields_lkn_btn_border_radius' => 'btnBorderRadius',
    'free_form-fields_lkn_btn_paddingA' => 'paddingA',
    'free_form-fields_lkn_btn_paddingL' => 'paddingL',
    'free_form-fields_lkn_btn_text_size' => 'textSize',
    'free_form-fields_lkn_css' => 'css',
    'free_form-fields_stripe_input_lkn_css' => 'stripeCss',
];

foreach ($form_meta_keys as $meta_key => $var_name) {
    $$var_name = get_post_meta($form_id, $meta_key, true);
}

if ($status !== 'enabled') {
    return;
}
?>

<style>
    .lkn_notice_wrapper {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        margin-top: 75px;
    }
    .lknNoticeText {
        font-size: 10px;
        color: #989898;
    }
    .lknIframeText {
        font-size: 13px;
    }
    .lknIframeWrapper {
        margin-top: 25px;
        margin-bottom: 25px;
    }

    #give-purchase-button {
        background-color: <?php echo esc_attr($color) ?>;
        color: <?php echo esc_attr($colorDet) ?>;
        padding: 18px 70px;
        font-size: 1.4em;
        line-height: 1.4em;
        font-weight: 600;
        border-radius: 15px;
    }

    .give-submit-button-wrap {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .give-submit-button-wrap:focus {
        filter: brightness(120%);
    }

    [id*=give-form] div.summary {
        width: 100%;
        float: none;
    }

    #give-sidebar-left,
    #lkn_give_purchase_form_wrap {
        display: none;
    }

    .give-donation-level-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: <?php echo esc_attr($color) ?>;
        border: <?php echo esc_attr($btnBorderSize) ?> solid <?php echo esc_attr($btnBorderColor) ?>;
        border-radius: <?php echo esc_attr($btnBorderRadius) ?>;
        color: <?php echo esc_attr($colorDet) ?>;
        padding: 12px 15px;
        cursor: pointer;
        line-height: 1.7em;
        font-size: <?php echo esc_attr($textSize) ?>;
        width: 100%;
        height: 100%;
    }

    .give-donation-level-btn:hover,
    .give-default-level:hover {
        background-color: <?php echo esc_attr($color) ?>;
        color: <?php echo esc_attr($colorDet) ?>;
        filter: brightness(120%);
    }

    .give-default-level {
        background-color: <?php echo esc_attr($colorDet) ?>;
        color: <?php echo esc_attr($color) ?>;
    }

    form[id*=give-form] #give-gateway-radio-list > li input[type=radio] {
        display: none;
    }

    .give-gateway-option-selected {
        background-color: <?php echo esc_attr($colorDet) ?> !important;
        color: <?php echo esc_attr($color) ?> !important;
    }

    form[id*=give-form] #give-gateway-radio-list > li {
        background-color: <?php echo esc_attr($color) ?>;
        color: <?php echo esc_attr($colorDet) ?>;
        border: solid <?php echo esc_attr($btnBorderSize) ?> <?php echo esc_attr($btnBorderColor) ?>;
        margin: 5px;
        text-align: center;
        justify-content: center;
        align-items: center;
        display: flex;
        cursor: pointer;
        line-height: 2em;
        font-weight: 600;
        height: 100%;
        font-size: <?php echo esc_attr($textSize) ?>;
        border-radius: <?php echo esc_attr($btnBorderRadius) ?>;
    }

    form[id*=give-form] #give-gateway-radio-list {
        display: grid;
        grid-gap: 10px;
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .give-total-wrap {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    form[id*=give-form] .give-donation-amount {
        width: fit-content;
        max-width: 80%;
        justify-content: center;
        align-items: center;
        display: flex;
        box-shadow: inset 0 1px 4px rgb(0 0 0 / 22%);
        border-radius: 5px;
        overflow: hidden;
        padding: 12px 16px;
        float: none;
        border-image: linear-gradient(to right, <?php echo esc_attr($colorDet) ?>, <?php echo esc_attr($color) ?>) 1;
        border-left: none;
        border-right: none;
        border-top: none;
        border-bottom: 3px solid;
    }

    form[id*=give-form] .give-donation-amount #give-amount,
    form[id*=give-form] .give-donation-amount #give-amount-text {
        display: block;
        text-align: center;
        border: none;
        line-height: 1.7em;
        height: auto;
        font-size: 1.7em;
        min-width: 180px;
    }
</style>
