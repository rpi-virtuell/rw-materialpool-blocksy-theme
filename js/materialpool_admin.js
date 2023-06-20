//ACF Feld füller für Themenseiten Themengruppen

//WIP

// jQuery(document).ready(function ($) {
//
//     // Add default 'Select one'
//     // $( '#materialpool-themenseiten' ).prepend( $('<option></option>').val('0').html('Select Country').attr({ selected: 'selected', disabled: 'disabled'}) );
//
//     /**
//      * Get country option on select menu change
//      *
//      */
//     $('#materialpool-themenseiten').change(function () {
//
//         var selected_themenseite = ''; // Selected value
//
//         // Get selected value
//         $('#materialpool-themenseiten select').each(function () {
//             selected_themenseite += $(this).val();
//         });
//
//     }).change();
// });
jQuery(document).ready(function ($) {


    $('.acf-field[data-name="material_themenseiten"]').on('change', add_thmengruppen_to_select_box);


    add_thmengruppen_to_select_box();

    function add_thmengruppen_to_select_box(e = null){

        var selected_themenseite = ''; // Selected value
        var themengruppen_elem = '';

        $('.acf-field[data-name="material_themenseiten"] .acf-repeater .acf-table tr:not(.acf-clone) td[data-name="single_themenseite"]').each(function (i, doc_elem) {

            selected_themenseite = $(doc_elem).find('select').val();
            themengruppen_elem = $(doc_elem).next();




            // If default is not selected get areas for selected country
            let themengruppen_elem_select;
            if (themengruppen_elem.find('option')['length'] <= 0) {

                console.log($(themengruppen_elem).find('select'));
                themengruppen_elem_select = $(themengruppen_elem).find('select');
                if (Number(selected_themenseite) > 0) {
                    // Send AJAX request
                    data = {
                        action: 'get_themengruppen_by_themenseiten',
                        themenseite: selected_themenseite,
                    };

                    // Get response and populate area select field
                    $.post(ajaxurl, data, function (response) {

                        if (response) {
                            // Disable 'Select Area' field until country is selected

                            themengruppen_elem_select.html($('<option></option>').val('0').html('Select Area').attr({
                                selected: 'selected',
                                disabled: 'disabled'
                            }));

                            // Add areas to select field options
                            $.each(response, function (val, grp) {

                                let params = new URL(document.location).searchParams;
                                let post = params.get("post");
                                let selected = '';


                                if (Array.isArray(grp['auswahl']) && grp['auswahl'].includes(Number(post))) {

                                    selected = 'selected';
                                } else if (typeof grp['auswahl'] === "object" && Object.values(grp['auswahl']).includes(Number(post))) {
                                    selected = 'selected';

                                }

                                themengruppen_elem_select.append($('<option ' + selected + '></option>').val(grp['gruppe']).html(grp['gruppe']));

                            });

                            // Enable 'Select Area' field
                            themengruppen_elem_select.removeAttr('disabled');

                        }
                    });
                }
            }
        });
    }

});
