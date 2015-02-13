(function($)
{
  $.fn.jAnim=function(options){

    var defauts={
      "interval": 150,
      "speed": 500,
      "animFunction": 'ease',
      "animation": "fading",
      "action": true, // True = fading , False = Disfading
      "callback": null
    };

    var options = $.extend(defauts, options);
     
    return this.each(function(){

      var element=$(this);

      // Laisse le temps au selecteur de recevoir le CSS de pré-animation
      setTimeout(function(){

        if (options.action) {
          $(element.children()).each(function(i) {
            var $me = $(this);
            setTimeout(function(){
              $me.addClass('jAnim-' + options.animation + "-show");
            }, i*options.interval);
          });  
        }
        else {
          $(element).each(function(i) {
            var $me = $(this);
            setTimeout(function(){
              $me.removeClass('jAnim-' + options.animation + "-show");
            }, i*options.interval);
          });  
        }

      }, options.speed);

         
      if(options.callback){ options.callback(); }
    });
  };
})(jQuery);


