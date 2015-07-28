jQuery(document).ready(function() {
  "use strict";
  //open rel="external links in new tab
  jQuery('a[rel="external"]').click(function(){
    jQuery(this).attr('target','_blank');
  });
  
  //open custom menu links in new tab, if the url starts with http  
  jQuery("#menu-main-menu .menu-item-type-custom a[href^='http']").attr("target","_blank");
  
});
