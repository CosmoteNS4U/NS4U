(function(){
	let wishlistBtn = document.querySelectorAll('.wlfmc_add_to_wishlist');

	if ( wishlistBtn.length > 0 ) {
    wishlistBtn.forEach(function(item){
  	  item.addEventListener('click', function(e){
  		  window.dataLayer = window.dataLayer || [];
  		  window.dataLayer.push({
  			  event: 'addToWishlist',
  			  productId: item.dataset.parentProductId
  		  });
  	  });
	  });
  }
})();
