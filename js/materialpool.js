/**
 * Created by Joachim on 03.02.2017.
 */

function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};

function copyToClipboard(element) {
    var $temp = jQuery("<input>");
    jQuery("body").append($temp);
    $temp.val(jQuery(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
}

jQuery(document).ready(function ($) {

    var baseUrl = location.href;


    $(document).on('facetwp-loaded', function() {
        // Scroll to the top of the page after the page is refreshed
        //$('html, body').animate({ scrollTop: 0 }, 500);
        jQuery( '.themenseite-gruppen' ).accordion({
            collapsible: true,
            heightStyle: 'content',
            header:'h2'
        });
    });


    jQuery('.facetwp-facet-bildungsstufen_themenseite').on('mouseup', function(){
       /*
        jQuery('body').css('opacity','0.2');
        setTimeout(function(){
            location.reload();
        }, 200);
*/
    });


	/*******************
	 * Startseiten Image wird beim laden kleiner gezogen
     */

	$('.home .custom-header-media img').animate({
		top: '-22vh'
	},2000);
	$('.has-header-image.twentyseventeen-front-page .custom-header').animate({
		'height': '31vh'
	}, 2000, function(){});
	
	/***************/
	
	
    $("#thema-toc").toc({content: "#thema-description", headings: "h2"});

    $("#thema-toc li a").on('click', function () {
        var id = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $(id).offset().top -110
        }, 800);
    })


    jQuery('.rw-search-wrapper input#s').attr('name','fwp_suche');
    jQuery('.rpi-center-col form').attr('action','/facettierte-suche/');

    jQuery( document ).ajaxStart(function() {
        jQuery('#page-loader').addClass('facetwp-loading');
    });
    jQuery( document ).ajaxComplete(function() {
        jQuery('#page-loader').removeClass('facetwp-loading');
    });


    jQuery('.page-template-suche-php .facet-treffer-content h2 a ').each(function() {
        var currHref = $(this).attr("href");
        if (currHref.indexOf('?') > 0)
            jQuery(this).attr("href",currHref+"&sq="+ encodeURIComponent(window.location));
        else
            jQuery(this).attr("href",currHref+"?sq="+ encodeURIComponent(window.location));
    });

    jQuery( document ).ajaxComplete(function( event, request, settings ) {
        jQuery('.page-template-suche-php .facet-treffer-content h2 a ').each(function() {
            var currHref = $(this).attr("href");
            if (currHref.indexOf('?') > 0)
                jQuery(this).attr("href",currHref+"&sq="+ encodeURIComponent(window.location));
            else
                jQuery(this).attr("href",currHref+"?sq="+ encodeURIComponent(window.location));
        });
    });

    jQuery('.mpshortcodegeneration').on('click', function () {
        var auswahl=false;
        var querystring = "";

        var search = getUrlParameter('fwp_suche');
        if ( typeof search != 'undefined') {
            auswahl = true;
            querystring = querystring + " suche='" + search + "' ";
        }
        var bildungsstufe = getUrlParameter('fwp_bildungsstufe');
        if ( typeof bildungsstufe != 'undefined') {
            auswahl = true;
            querystring = querystring + " bildungsstufe='" + bildungsstufe + "' ";
        }
        var kompetenzen = getUrlParameter('fwp_kompetenzen');
        if ( typeof kompetenzen != 'undefined') {
            auswahl = true;
            querystring = querystring + " kompetenz='" + kompetenzen + "' ";
        }
        var medientyp = getUrlParameter('fwp_medientyp');
        if ( typeof medientyp != 'undefined') {
            auswahl = true;
            querystring = querystring + " medientyp='" + medientyp + "' ";
        }
        var alpika = getUrlParameter('fwp_alpika');
        if ( typeof alpika != 'undefined') {
            auswahl = true;
            querystring = querystring + " alpika='" + alpika + "' ";
        }
        var vorauswahl = getUrlParameter('fwp_vorauswahl');
        if ( typeof vorauswahl != 'undefined') {
            auswahl = true;
            querystring = querystring + " vorauswahl='" + vorauswahl + "' ";
        }
        var schlagworte = getUrlParameter('fwp_schlagworte');
        if ( typeof schlagworte != 'undefined') {
            auswahl = true;
            querystring = querystring + " schlagworte='" + schlagworte + "' ";
        }
        var inklusion = getUrlParameter('fwp_inklusion');
        if ( typeof inklusion != 'undefined') {
            auswahl = true;
            querystring = querystring + " inklusion='" + inklusion + "' ";
        }
        var organisation = getUrlParameter('fwp_organisation');
        if ( typeof organisation != 'undefined') {
            auswahl = true;
            querystring = querystring + " organisation='" + organisation + "' ";
        }
        var sprache = getUrlParameter('fwp_sprache');
        if ( typeof sprache != 'undefined') {
            auswahl = true;
            querystring = querystring + " sprache='" + sprache + "' ";
        }
        var autor = getUrlParameter('fwp_autor');
        if ( typeof autor != 'undefined') {
            auswahl = true;
            querystring = querystring + " autor='" + autor + "' ";
        }
        var lizenz = getUrlParameter('fwp_lizenz');
        if ( typeof lizenz != 'undefined') {
            auswahl = true;
            querystring = querystring + " lizenz='" + lizenz + "' ";
        }
        var verfuegbarkeit = getUrlParameter('fwp_verfuegbarkeit');
        if ( typeof verfuegbarkeit != 'undefined') {
            auswahl = true;
            querystring = querystring + " verfuegbarkeit='" + verfuegbarkeit + "' ";
        }
        var zugaenglichkeit = getUrlParameter('fwp_zugaenglichkeit');
        if ( typeof zugaenglichkeit != 'undefined') {
            auswahl = true;
            querystring = querystring + " zugaenglichkeit='" + zugaenglichkeit + "' ";
        }
        var erscheinungsjahr = getUrlParameter('fwp_erscheinungsjahr');
        if ( typeof erscheinungsjahr != 'undefined') {
            auswahl = true;
            querystring = querystring + " erscheinungsjahr='" + erscheinungsjahr + "' ";
        }
        if (auswahl == false) {
            alert( 'Es wurde keine Einschränkung vorgenommen,');
        } else {
            jQuery('#mpshortcode').val( "[materialliste " + querystring + "]" );
            var copyText = jQuery('#mpshortcode');
            copyText.select();
            document.execCommand("copy");

            alert("Der Shortcode ist in die Zwischenablage kopiert.");

        }
    });
});
