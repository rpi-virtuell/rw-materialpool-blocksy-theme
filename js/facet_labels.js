jQuery(document).on('facetwp-loaded', function() {
    if(!FWP){
        return;
    }

    /**
     * Einige Faccetten ausblenden, solange noch keine Suche durch geführt wurde.
     * Auszublendende Facceten werden innerhalb des <DIV class="second-search-facets"> positioniert
     */

    var second_search = false;
    jQuery.each(FWP.facets, function(i, name){
            if(name.length >0){
                second_search = true;
            }
    });
    if(second_search){
        jQuery('.second-search-facets').show();
    }else{
        jQuery('.second-search-facets').hide();
    }

    /**
     * Wrweiterte Facceten werden innerhalb des <DIV class="advanced-search-facets"> positioniert
     */

    var advanced_search = FWP_HTTP.get.adv;
    if(advanced_search){
        jQuery('.advanced-search-facets').show();
    }else{
        jQuery('.advanced-search-facets').hide();
    }
    /**
     * Die Folgende Schleife durhc alle Facetten macht:
     * 1. automatisch Label über Facetten schreiben
     * 2. Facceten ausblenden, die keine Ergebnisse mehr liefern
     */

    jQuery('.facetwp-facet').each(function () {
        var facet_name = jQuery(this).attr('data-name');
        if(jQuery(this).html()==''){
            jQuery(this).hide();
            jQuery('.facet-label.'+facet_name).hide();
        }else{
            if(facet_name != 'suche'){
                jQuery(this).show();
                var facet_label = FWP.settings.labels[facet_name];
                if (jQuery('.facet-label[data-for="' + facet_name + '"]').length < 1) {
                    jQuery(this).before('<h5 class="facet-label '+facet_name+'" data-for="' + facet_name + '">' + facet_label + '</h5>');
                }
                jQuery('.facet-label.'+facet_name).show();
            }

        }
    });
});