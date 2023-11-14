
(function($) {
  'use strict';
  $.fn.andSelf = function() {
    return this.addBack.apply(this, arguments);
  }
  
  $(function() {
        $(document).ready(function() {
            ClassicEditor
                .create( document.querySelector( '#editor' ))
                .catch( error => {
                    console.error( error );
                });
        });
    });
})(jQuery);