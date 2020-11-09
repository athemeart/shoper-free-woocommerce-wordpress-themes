/*admin css*/
( function( shoper_api ) {

	shoper_api.sectionConstructor['shoper_upsell'] = shoper_api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
