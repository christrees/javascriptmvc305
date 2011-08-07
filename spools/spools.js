/*
 * @page spools Spools
 * @tag home
 *
 * ###Spools - Party Play
 *  
 * Spools attempting to document and test a Spools game:
 * A list
 *
 * * Spools List item 1 
 * * Spools List item 2 
 */
 steal.plugins(	
	'jquery/controller',			// a widget factory
	'jquery/controller/subscribe',	// subscribe to OpenAjax.hub
	'jquery/view/ejs',				// client side templates
	'jquery/controller/view',		// lookup views with the controller's name
	'jquery/model',					// Ajax wrappers
      'jquery/model/list/cookie',
//	'jquery/dom/fixture',			// simulated Ajax requests
	'jquery/dom/form_params')		// form data helper
	
//	.css('spools')	// loads styles

	.resources()					// 3rd party script's (like jQueryUI), in resources folder

	.models('token', 'game')						// loads files in models folder

	.controllers('token', 'game')					// loads files in controllers folder

	.views();						// adds views to be added to build