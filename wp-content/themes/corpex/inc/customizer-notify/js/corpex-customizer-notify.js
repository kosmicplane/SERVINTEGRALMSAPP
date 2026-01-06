/**
 * Customizer notification system
 */


(function (api) {

	api.sectionConstructor['corpex-customizer-notify-section'] = api.Section.extend(
		{

			// No events for this type of section.
			attachEvents: function () {
			},

			// Always make the section active.
			isContextuallyActive: function () {
				return true;
			}
		}
	);

})( wp.customize );

jQuery( document ).ready(
	function () {

		jQuery( '.corpex-customizer-notify-dismiss-recommended-action' ).click(
			function () {

				var id = jQuery( this ).attr( 'id' ),
				action = jQuery( this ).attr( 'data-action' );
				jQuery.ajax(
					{
						type: 'GET',
						data: {action: 'quality_customizer_notify_dismiss_action', id: id, todo: action},
						dataType: 'html',
						url: CorpexCustomizercompanionObject.corpex_ajaxurl,
						beforeSend: function () {
							jQuery( '#' + id ).parent().append( '<div id="temp_load" style="text-align:center"><img src="' + CorpexCustomizercompanionObject.corpex_base_path + '/images/spinner-2x.gif" /></div>' );
						},
						success: function (data) {
							var container          = jQuery( '#' + data ).parent().parent();
							var index              = container.next().data( 'index' );
							var recommended_sction = jQuery( '#accordion-section-Corpex-customizer-notify-section' );
							var actions_count      = recommended_sction.find( '.corpex-customizer-plugin-notify-actions-count' );
							var section_title      = recommended_sction.find( '.section-title' );
							jQuery( '.corpex-customizer-plugin-notify-actions-count .current-index' ).text( index );
							container.slideToggle().remove();
							if (jQuery( '.corpex-theme-recomended-actions_container > .epsilon-recommended-actions' ).length === 0) {

								actions_count.remove();

								if (jQuery( '.corpex-theme-recomended-actions_container > .epsilon-recommended-plugins' ).length === 0) {
									jQuery( '.control-section-corpex-customizer-notify-section' ).remove();
								} else {
									section_title.text( section_title.data( 'plugin_text' ) );
								}

							}
						},
						error: function (jqXHR, textStatus, errorThrown) {
							console.log( jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown );
						}
					}
				);
			}
		);

jQuery( '.corpex-customizer-notify-dismiss-button-recommended-plugin' ).click(
	function () {
		var id = jQuery( this ).attr( 'id' ),
		action = jQuery( this ).attr( 'data-action' );
		jQuery.ajax(
			{
				type: 'GET',
				data: {action: 'ti_customizer_notify_dismiss_recommended_plugins', id: id, todo: action},
				dataType: 'html',
				url: CorpexCustomizercompanionObject.corpex_ajaxurl,
				beforeSend: function () {
					jQuery( '#' + id ).parent().append( '<div id="temp_load" style="text-align:center"><img src="' + CorpexCustomizercompanionObject.corpex_base_path + '/images/spinner-2x.gif" /></div>' );
				},
				success: function (data) {
					var container = jQuery( '#' + data ).parent().parent();
					var index     = container.next().data( 'index' );
					jQuery( '.corpex-customizer-plugin-notify-actions-count .current-index' ).text( index );
					container.slideToggle().remove();

					if (jQuery( '.corpex-theme-recomended-actions_container > .epsilon-recommended-plugins' ).length === 0) {
						jQuery( '.control-section-corpex-customizer-notify-section' ).remove();
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.log( jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown );
				}
			}
		);
	}
);

		// Remove activate button and replace with activation in progress button.
		jQuery( document ).on(
			'DOMNodeInserted','.activate-now', function () {
				var activateButton = jQuery( '.activate-now' );
				if (activateButton.length) {
					var url = jQuery( activateButton ).attr( 'href' );
					if (typeof url !== 'undefined') {
						// Request plugin activation.
						jQuery.ajax(
							{
								beforeSend: function () {
									jQuery( activateButton ).replaceWith( '<a class="button updating-message">' + CorpexCustomizercompanionObject.corpex_activating_string + '...</a>' );
								},
								async: true,
								type: 'GET',
								url: url,
								success: function () {
									// Reload the page.
									location.reload();
								}
							}
						);
					}
				}
			}
		);
	}
);

					
					
/**
 * Remove activate button and replace with activation in progress button.
 *
 * @package Corpex
 */


jQuery( document ).ready(
	function ($) {
		$( 'body' ).on(
			'click', ' .corpex-install-plugin ', function () {
				var slug = $( this ).attr( 'data-slug' );

				wp.updates.installPlugin(
					{
						slug: slug
					}
				);
				return false;
			}
		);

		$( '.activate-now' ).on(
			'click', function (e) {
				
				var activateButton = $( this );
				e.preventDefault();
				if ($( activateButton ).length) {
					var url = $( activateButton ).attr( 'href' );

					if (typeof url !== 'undefined') {
						// Request plugin activation.
						$.ajax(
							{
								beforeSend: function () {
									$( activateButton ).replaceWith( '<a class="button updating-message">'+"activating"+'...</a>' );
								},
								async: true,
								type: 'GET',
								url: url,
								success: function () {
									// Reload the page.
									location.reload();
								}
							}
						);
					}
				}
			}
		);
	}
);
