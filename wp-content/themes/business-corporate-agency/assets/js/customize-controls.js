( function( api ) {

	// Extends our custom "business-corporate-agency" section.
	api.sectionConstructor['business-corporate-agency'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );