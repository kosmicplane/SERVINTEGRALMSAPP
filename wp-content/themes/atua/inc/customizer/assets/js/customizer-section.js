( function( api ) {

	// Extends our custom "example-1" section.
	api.sectionConstructor['plugin-section'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );


function atuafrontpagesectionsscroll( atua_section_id ){
    var navigation_id = "dt_slider";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( atua_section_id ) {
        case 'accordion-section-information_options':
        navigation_id = "dt_service_one";
        break;

        case 'accordion-section-about_options':
        navigation_id = "dt_about";
        break;
		
        case 'accordion-section-service_options':
        navigation_id = "dt_service_two";
        break;
		
		case 'accordion-section-features_options':
        navigation_id = "dt_features_area";
        break;
		
		case 'accordion-section-blog_options':
        navigation_id = "dt_posts";
        break;
		
    }

    if( $contents.find('#'+navigation_id).length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + navigation_id ).offset().top
        }, 1000);
    }
}



 jQuery('body').on('click', '#sub-accordion-panel-atua_frontpage_options .control-subsection .accordion-section-title', function(event) {
        var atua_section_id = jQuery(this).parent('.control-subsection').attr('id');
        atuafrontpagesectionsscroll( atua_section_id );
});