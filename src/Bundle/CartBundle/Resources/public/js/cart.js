(function($) {
  function handleDrop(event, ui) {
    $.ajax({ url: ui.draggable.attr('href'), success: function(response) {
      $("#items div a").draggable('destroy');
      $('#items').html(response);
      $("#items div a").draggable({ opacity: 0.35 });
    }});
  }

  $(document).ready(function(){
    $("#product_list a").draggable({ opacity: 0.35, revert: true });
    $("#items div a").draggable({ opacity: 0.35 });
    $("#cart").droppable({
      drop: handleDrop,
      accept: '#product_list a'
    });

    $('#wastebin').droppable({
      drop: handleDrop,
      accept: '#items div a'
    });
  });
})(jQuery);