/* eslint-disable no-undef */
//JS for Admin Area

( function() {
	wp.customize.bind( 'ready', function() {
		const customize = this;
		handleHeaderWidget.call(customize);
	} );

    function handleHeaderWidget() {
        const headerBtn = this.control('indofinance_header_widget_btn').container.find('button');
        const headerSidebar = this.section('sidebar-widgets-header-widget');

        if (headerBtn.length !== 0) {
            headerBtn[0].addEventListener('click', () => {
                headerSidebar.focus();
            });
        } 
    };
}( jQuery ) );
