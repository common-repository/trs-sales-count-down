jQuery(document).ready(function ($){
    if ($('#_trs_sales_count_down__style_type').val() === 'flyout'){
        $('#flyout').toggle();
    }else if ($('#_trs_sales_count_down__style_type').val() === 'fancy'){
        $('#fancy').toggle();
    }else if ($('#_trs_sales_count_down__style_type').val() === 'simple'){
        $('#simple').toggle();
    }else if ($('#_trs_sales_count_down__style_type').val() === 'nobe'){
        $('#nobe').toggle();
    }else if ($('#_trs_sales_count_down__style_type').val() === 'whiteblock'){
        $('#whiteblock').toggle();
    }else if ($('#_trs_sales_count_down__style_type').val() === 'flipmodern'){
        $('#flipmodern').toggle();
    }


    $('#_trs_sales_count_down__style_type').change(function (){
        if ($('#_trs_sales_count_down__style_type').val() === 'flyout'){
            $('#flyout').toggle();

            $('#whiteblock').hide();
            $('#flipmodern').hide();
            $('#fancy').hide();
            $('#simple').hide();
            $('#nobe').hide();
        }else if ($('#_trs_sales_count_down__style_type').val() === 'fancy'){
            $('#fancy').toggle();

            $('#whiteblock').hide();
            $('#flipmodern').hide();
            $('#flyout').hide();
            $('#simple').hide();
            $('#nobe').hide();
        }else if ($('#_trs_sales_count_down__style_type').val() === 'simple'){
            $('#simple').toggle();

            $('#fancy').hide();
            $('#flyout').hide();
            $('#nobe').hide();
        } else if ($('#_trs_sales_count_down__style_type').val() === 'nobe'){
            $('#nobe').toggle();

            $('#whiteblock').hide();
            $('#flipmodern').hide();
            $('#simple').hide();
            $('#fancy').hide();
            $('#flyout').hide();
        }else if ($('#_trs_sales_count_down__style_type').val() === 'whiteblock'){
            $('#whiteblock').toggle();

            $('#simple').hide();
            $('#fancy').hide();
            $('#flyout').hide();
            $('#nobe').hide();
            $('#flipmodern').hide();
        }else if ($('#_trs_sales_count_down__style_type').val() === 'flipmodern'){
            $('#flipmodern').toggle();

            $('#simple').hide();
            $('#fancy').hide();
            $('#flyout').hide();
            $('#nobe').hide();
            $('#whiteblock').hide();
        }
    });

    // ===================================================================

    if ($('#_trs_sales_count_down__override_global_settings').val() === 'no'){
        $('.sales_count_down_options').hide();
    }

    $('#_trs_sales_count_down__override_global_settings').change(function (){
        $('.sales_count_down_options').toggle();
    });



    // ===================================================================


    // check on load time
    if ($('#_trs_sales_count_down__display_progress_bar').val() === 'no'){
        $('.form-field._trs_sales_count_down__progress_bar_text_field').hide();
        $('.form-field._trs_sales_count_down__progress_bar_primary_color_field').hide();
        $('.form-field._trs_sales_count_down__progress_bar_secondary_color_field').hide();
        $('.form-field._trs_sales_count_down__progress_bar_percentage_field').hide();

        // for settings page.
        $('.show_if_display_progress_bar').hide();
    }

    // check if its changed
    $('#_trs_sales_count_down__display_progress_bar').change(function (){
        $('.form-field._trs_sales_count_down__progress_bar_text_field').toggle();
        $('.form-field._trs_sales_count_down__progress_bar_primary_color_field').toggle();
        $('.form-field._trs_sales_count_down__progress_bar_secondary_color_field').toggle();
        $('.form-field._trs_sales_count_down__progress_bar_percentage_field').toggle();

        // for settings page.
        $('.show_if_display_progress_bar').toggle();
    });

    // ===================================================================


    $('#_trs_sales_count_down__progress_bar_primary_color').wpColorPicker();
    $('#_trs_sales_count_down__progress_bar_secondary_color').wpColorPicker();
});