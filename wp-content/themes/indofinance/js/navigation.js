/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
const navModule = () => {
	const body = document.querySelector( 'body' );
	const navBtn = document.querySelector( '.mobile-btn' );
	const mobileNav = document.querySelector( '.mobile-navigation' );
	const navClose = mobileNav.querySelector( '#close-menu' );
	const goToBottom = mobileNav.querySelector( '.go-to-bottom' );
	const goToTop = mobileNav.querySelector( '.go-to-top' );
	const dropdowns = mobileNav.querySelectorAll( 'span' );

	const toggleNavMenu = ( item ) => {
		item.classList.toggle( 'is-visible' );
	};

	navBtn.addEventListener( 'click', () => {
		mobileNav.classList.add( 'expanded' );
		navBtn.setAttribute( 'aria-expanded', true );
		mobileNav.setAttribute( 'aria-hidden', false );
		body.classList.add( 'no-scroll' );
		navClose.focus();
	} );

	document.addEventListener( 'click', ( e ) => {
		if ( ! mobileNav.contains( e.target ) && ! navBtn.contains( e.target ) && mobileNav.classList.contains( 'expanded' ) ) {
			mobileNav.classList.remove( 'expanded' );
			navBtn.setAttribute( 'aria-expanded', false );
			mobileNav.setAttribute( 'aria-hidden', true );
			body.classList.remove( 'no-scroll' );
			navBtn.focus();
		}
	} );

	navClose.addEventListener( 'click', () => {
		mobileNav.classList.remove( 'expanded' );
		navBtn.setAttribute( 'aria-expanded', false );
		mobileNav.setAttribute( 'aria-hidden', true );
		body.classList.remove( 'no-scroll' );
		navBtn.focus();
	} );

	goToBottom.addEventListener( 'focus', () => {
		const links = document.querySelectorAll( 'ul.mobile-menu li' );
		links[ links.length - 1 ].querySelector( 'a' ).focus();
	} );

	goToTop.addEventListener( 'focus', () => {
		navClose.focus();
	} );

	// Accessing sub-menus
	if ( dropdowns.length !== 0 ) {
		dropdowns.forEach( ( dropdown ) => {
			const subMenu = dropdown.nextElementSibling;
			dropdown.addEventListener( 'click', () => toggleNavMenu( subMenu ) );
			dropdown.addEventListener( 'keydown', ( e ) => {
				if ( [ 'Space', 'Enter' ].includes( e.code ) ) {
					toggleNavMenu( subMenu );
				}
			} );
		} );
	}
};
navModule();

document.addEventListener("DOMContentLoaded", function () {
    const searchButton = document.getElementById("searchOpen");
    const searchOverlay = document.getElementById("searchOverlay");
    const closeButton = document.getElementById("searchClose");
    const searchFormWrapper = document.querySelector(".search__form-wrapper");

    searchButton.addEventListener("click", function () {
        searchOverlay.classList.add("active");
    });

    closeButton.addEventListener("click", function () {
        searchOverlay.classList.remove("active");
    });

    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            searchOverlay.classList.remove("active");
        }
    });
});
