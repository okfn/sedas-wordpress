jQuery(document).ready(function() {
  "use strict";
  //open rel="external links in new tab
  jQuery('a[rel="external"]').click(function(){
    jQuery(this).attr('target','_blank');
  }); 
});
