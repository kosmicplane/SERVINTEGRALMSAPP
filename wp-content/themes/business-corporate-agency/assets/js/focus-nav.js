( function( window, document ) {
  function business_corporate_agency_keepFocusInMenu() {
    document.addEventListener( 'keydown', function( e ) {
      const business_corporate_agency_nav = document.querySelector( '.sidenav' );
      if ( ! business_corporate_agency_nav || ! business_corporate_agency_nav.classList.contains( 'open' ) ) {
        return;
      }
      const elements = [...business_corporate_agency_nav.querySelectorAll( 'input, a, button' )],
        business_corporate_agency_lastEl = elements[ elements.length - 1 ],
        business_corporate_agency_firstEl = elements[0],
        business_corporate_agency_activeEl = document.activeElement,
        tabKey = e.keyCode === 9,
        shiftKey = e.shiftKey;
      if ( ! shiftKey && tabKey && business_corporate_agency_lastEl === business_corporate_agency_activeEl ) {
        e.preventDefault();
        business_corporate_agency_firstEl.focus();
      }
      if ( shiftKey && tabKey && business_corporate_agency_firstEl === business_corporate_agency_activeEl ) {
        e.preventDefault();
        business_corporate_agency_lastEl.focus();
      }
    } );
  }
  business_corporate_agency_keepFocusInMenu();
} )( window, document );