// (function ($) {
//   $(document).ready(function () {
//     $('.field--name-body').each(function () {
//       var maxL = 200;
//       var text = $(this).text();
//       if(text.length > maxL) {
//         var begin = text.substr(0, maxL),
//           end = text.substr(maxL);
//         $(this).html(begin)
//           .append($('<a class="readmore"/>').attr('href', '#').html('read more...'))
//           .append($('<div class="hidden" />').html(end));
//       }
//     });
//     $(document).on('click', '.readmore', function () {
//       $(this).next('.hidden').slideToggle(400);
//     });
//   });
// })(jQuery);

(function ($) {
  $(document).ready(function () {
    $('.field--name-body').each(function(){
      var words = $(this).text().split(" ");
      var maxWords = 50;
      if(words.length > maxWords){
        html = words.slice(0,maxWords) +'<span class="more_text" style="display:none; overflow-wrap:break-word;"> '+words.slice(maxWords, words.length)+'</span>' + '<a href="#" class="read_more">...Read More</a>'
        $(this).html(html)
        $(this).find('a.read_more').click(function(event){
          $(this).toggleClass("less");
          event.preventDefault();
          if($(this).hasClass("less")){
            $(this).html("Show Less")
            $(this).parent().find(".more_text").show();
          }
          else {
            $(this).html("...Read More")
            $(this).parent().find(".more_text").hide();
          }
        })
      }
    })
  });
})(jQuery);
