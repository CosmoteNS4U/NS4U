// Force the display of the cookie settings if the cookie is not set
(function(){
  window.addEventListener('DOMContentLoaded', () => {
	  setTimeout(function(){
	   	  let cookieBtn = document.querySelector('#moove_gdpr_cookie_info_bar .change-settings-button');
		  if (cookieBtn) {
			  if ( document.cookie.indexOf('moove_gdpr_popup') == -1 ) {
				  cookieBtn.click();
			  }
		  }
    },5000);
  });
})();
