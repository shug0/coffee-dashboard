var show = 'yes';

function showBox() {
  $(".appear").each(function(i) {
    var $me = $(this);
    setTimeout(function(){
      $me.addClass('reveal');
    }, i*100);
  });  
  show = 'yes';
}

function hideBox() {
  $(".appear").each(function(i) {
    var $me = $(this);
    setTimeout(function(){
      $me.removeClass('reveal');
    }, i*100);
  });  
  show = 'no';
}






