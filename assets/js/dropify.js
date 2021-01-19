$(function() {
  'use strict';

  $('.dropify').dropify({
    tpl: {
        clearButton:     '<button type="button" onclick="angular.element(this).scope().deleteimage(angular.element(this).scope().data.guid, angular.element(this).scope().data.imageurl)" class="dropify-clear">{{ remove }}</button>',
    }
});
  

//   var drEvent2 = $('#myDropify').dropify();

//   drEvent2.on('dropify.beforeClear', function(event, element){
//     console.log('File deleted', element);
//     angular.element(this).scope().deleteimage(angular.element(this).scope().data.stocksid, angular.element(this).scope().data.imageurl);
// });
});