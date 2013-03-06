jQuery(document).ready(function($){
  $('#searchform input[type=text], #searchform input[type=search]').autocomplete({
    source: autocompletePlugin.dataUrl
  });
});
