$(document).ready( function() {
  var clipboard = new ClipboardJS('.btn');
  clipboard.on('success', function() {
    $('#btn-copy').attr('title', 'Signature copied').tooltip('enable').tooltip('show');    
  });
  clipboard.on('error', function() {
    $('#btn-copy').attr('title', 'Error copying').tooltip('enable').tooltip('show');    
  });
  $('#btn-copy').hover(
    function() { },
    function() { $('#btn-copy').tooltip('disable'); }
  );
});
