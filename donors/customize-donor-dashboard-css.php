<?php
/**
 * Customize the Donor Dashboard CSS
 *
 * Add the following CSS to your favorite snippet plugin or to your theme's functions.php file. The CSS provided changes the colors of the Donor Dashboard to black and white.
 */
function gwp_my_inject_css_into_iframe() {
	?>
	<script type="text/javascript">
		window.addEventListener( 'load', function() {
			var iframe = document.querySelector( 'iframe[name="give-embed-donor-profile"]' );
			var style = document.createElement( 'style' );
			style.textContent = `
				#give-donor-dashboard {
					font-family: "General Sans", sans-serif !important;
				}

                .give-donor-dashboard-desktop-layout,
                .give-donor-dashboard-desktop-layout__tab-menu,
                .give-donor-dashboard-dashboard__stats,
                .give-donor-dashboard-table,
                .give-donor-dashboard-table__donation-amount,
                .give-donor-dashboard-table__header,
                .give-donor-dashboard-table .give-donor-dashboard-table__rows .give-donor-dashboard-table__pill,
                .give-donor-dashboard-dashboard__stats .give-donor-dashboard-dashboard__stat,
                .give-donor-dashboard__add-primary-address
                 {
                    background-color: #000 !important;
                    background: #000 !important;
                    color: #fff !important;
                }

				.give-donor-dashboard-donation-receipt__table,
				.give-donor-dashboard-dashboard__stats .give-donor-dashboard-dashboard__stat,
                .give-donor-dashboard-desktop-layout,
                .give-donor-dashboard-table .give-donor-dashboard-table__rows .give-donor-dashboard-table__pill,
                 .give-donor-dashboard-table {
                    border: 1px solid #FFF;
                    border-radius: 0 !important;
                }

                .give-donor-dashboard-radio-control .give-donor-dashboard-radio-control__option label,
				.give-donor-dashboard-radio-control .give-donor-dashboard-radio-control__legend,
				.give-donor-dashboard-avatar-control .give-donor-dashboard-avatar-control__label,
				.give-donor-dashboard-select-control .give-donor-dashboard-select-control__label,
                .give-donor-dashboard-desktop-layout__tab-menu .give-donor-dashboard-tab-link,
				.give-donor-dashboard-dashboard__stats .give-donor-dashboard-dashboard__detail,
				.give-donor-dashboard-table__donation-id,
				.give-donor-dashboard-donation-receipt__table,
				.give-donor-dashboard-donor-info__details .give-donor-dashboard-donor-info__detail,
				.give-donor-dashboard-heading,
                .give-donor-dashboard-donor-info__details .give-donor-dashboard-donor-info__name {            color: #fff !important;
                }

				.give-donor-dashboard-radio-control .give-donor-dashboard-radio-control__description,
				.give-donor-dashboard-text-control .give-donor-dashboard-text-control__label,
                .give-donor-dashboard-desktop-layout__tab-menu .give-donor-dashboard-tab-link.give-donor-dashboard-tab-link--is-active {
                     background-color: #000 !important;
                		color: #fff !important;
                }

            `;
			iframe.contentDocument.head.appendChild( style );
		} );
	</script>
	<?php
}

add_action( 'wp_footer', 'gwp_my_inject_css_into_iframe' );