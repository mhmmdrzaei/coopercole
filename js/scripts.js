/*!
  Read more / read less jQuery plugin.
  https://github.com/AndreF010203/jQuery-Read-More.git
  version 1.0.0 (Nov, 2020)

  Copyright (c) 2020 Andrea Facchini
  Licensed under the MIT (http://www.opensource.org/licenses/mit-license.php) license.
*/
(function($) {
  // console.log('tessst');

  // var main = document.getElementById('artworksPages');

  // /* Register main to the click event 
  // || when clicked ANYWHERE within main 
  // || toggle() is called
  // */
  // main.addEventListener('click', toggle, false);

  // function toggle(e) {
  //    Determine if the current element in the
  //   || event chain is the anchor that was 
  //   || clicked.
    

  //   if (e.target !== e.currentTarget && e.target.class('toggleText')) {
  //     console.log('fuck');
  //     /* tgt is the clicked link
  //     || txt is the div that follows tgt
  //     */
  //     var tgt = e.target;
  //     var txt = tgt.nextElementSibling;
  //     // Toggle classes .on and .off
  //     txt.classList.toggle('on');
  //     txt.classList.toggle('off');
  //   }
  // }
  $(".artworkItemEach").click(function() {
      $(this).find('.artworkIteminfo').addClass("open");
       // $(this).find('.artworkIteminfo').toggleClass("closed");
      // $(this).find('.artworkIteminfo').css("display","block");

  });

 $(".closeInfo").click(function() {
  // if($('#artworksOpenItem').hasClass('open')){
  //    $('#artworksOpenItem').removeClass('open')
  // }else{
    // parent = el.closest('.displayText');
  // }
  // $(".artworkItemEach").find('.artworkIteminfo').removeClass("open");
    if ($('.artworkIteminfo').hasClass('open')) {
      // parent.find('.displayText').slideToggle();
      $('.artworkIteminfo').removeClass('open');
    } 
    return false;
      // $('.artworkIteminfo').toggleClass("closed");
      // console.log('fuck');

  });

  
  // $( ".toggleText" ).each(function(index) {
  //     $(this).on("click", function(){
  //       console.log('bitchface')
  //       $('.artworkItemEach').each(function(){
  //         $(this).toggleClass('on');
  //       });
  //         // // For the boolean value
  //         // var boolKey = $(this).data('selected');
  //         // // For the mammal value
  //         // var mammalKey = $(this).attr('id'); 
  //     });
  // });


  /**
   *  
   * @param {*} options Options object: 
   *    lines           int     number of lines to show
   *    readMoreLabel   string  Label for the expand action default Read more
   *    readLessLabel   string  Label for the collapse action default Read less
   *    ellipsis        string  Label for the separator, default ...
   *    splitOn         string/regex  split on the defined character/regex
   */
  $.fn.readMore = function(options) {
    if(options === 'destroy') {
      $(this).each(function (_j, element) {
        $($(element).data().controller).off('click');
        $(element).html($(element).children().last().html());
      });
      return;
    }

    var maxLines = parseInt(options.lines),
      readMoreLabel = options.readMoreLabel || "+ Read more",
      readLessLabel = options.readLessLabel || "- Less",
      ellipsis = options.ellipsis || "",
      splitOn = options.splitOn || ' ';

    if(!maxLines || isNaN(maxLines)) {
      console.error("lines must be an integer");
      return;
    }
  
    $(this).each(function (_j, element) {
      var originalText = $(element).html(),
        textArr = originalText.split(splitOn),
        $newDiv = $("<div/>"),
        $fullDiv = $("<div/>"),
        $readMore = $($(element).data().controller),
        hPrev = 0, 
        lines = 0, 
        overflow = false, 
        l = textArr.length, 
        i;
  
      $fullDiv.html(originalText);
      $(element).html($newDiv).append($fullDiv);
      
      for(i=0; i < l; i++) {
        $newDiv.append(textArr[i] + ' ');
        var h = $newDiv.height();
        if(h > hPrev) {
          hPrev = h;
          lines++;
          if(lines > maxLines) {
            overflow = true;
            $newDiv.html(textArr.slice(0, i).join(' '))
            break;
          }
        }
      }
  
      if(overflow) {
        $readMore.text(readMoreLabel).css('display', 'block');
        $newDiv.append(ellipsis);
        var minH = $newDiv.height();
        var realH =  $fullDiv.height();
        var display = $newDiv.css('display');
  
        function callback() {
          if($(element).data().expanded) {
            $fullDiv.animate(6000, function() {
              $newDiv.css('display', display);
              $fullDiv.css('display', 'none');
            });
            $readMore.animate({opacity: 0}, 500, function() {
              $readMore.text(readMoreLabel);
            }).animate({opacity: 1}, 500);
            $(element).data('expanded', false);
          } else {
            $newDiv.css('display', 'none');
            $fullDiv.css('display', display);
            // $fullDiv.css('height', minH + 'px')
            // $fullDiv.animate({height: realH + 'px'}, 1000);
            $readMore.animate({opacity: 0}, 500, function() {
              $readMore.text(readLessLabel);
            }).animate({opacity: 1}, 500);
            $(element).data('expanded', true);
          }
        }

        $readMore.on('click', callback);
      } else {
        $readMore.css('display', 'none');
      }
      $fullDiv.css('display', 'none');
    });
  }
})(jQuery);

$(".text-area").readMore({lines: 15})
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("menu-languages-menu").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementById("menu-languages-menu");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
} 
//video Link
$(document).ready(function(){
  $(".featuredVideoTitle").click(function(){
    $("#featuredVideoLink").toggle(1000);
    
  });

  $(".newsOpen").click(function(){
    $("#newsContentID").toggle(500);
    $( this ).toggleClass( "highlight" );
    
  });
    $(".exhibitionsOpen").click(function(){
    $("#exhibitionContentID").toggle(500);
    $( this ).toggleClass( "highlight" );
    
  });
      $(".mailing-list-open").click(function(){
      // $(".mailing-list").toggle(500);
      $('.mailing-list').toggleClass( "highlightML" );
      
    });
    $(".closelistML").click(function(){
      
      // $(".mailing-list").toggle(500);
      $('.mailing-list').toggleClass( "highlightML" );
      
    });
    $(".toggle-mailing-list").click(function(){
      // $(".mailing-list").toggle(500);
      $('.mailing-list').toggleClass( "highlightML" );
      
    });

    


  //smooth scroll
  // Add smooth scrolling to all links
   $("a").on('click', function(event) {

     // Make sure this.hash has a value before overriding default behavior
     if (this.hash !== "") {
       // Prevent default anchor click behavior
       event.preventDefault();

       // Store hash
       var hash = this.hash;

       // Using jQuery's animate() method to add smooth page scroll
       // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
       $('html, body').animate({
         scrollTop: $(hash).offset().top
       }, 800, function(){

         // Add hash (#) to URL when done scrolling (default click behavior)
         window.location.hash = hash;
       });
     } // End if
   });
});



//scrolling fade in and out
var height = $('.exhibitionMain').height();
var detailHeights = $('.exhibtionArtists').height();
var detailArtFairHeight = $('.exhibtionArtists').height();
$(document).scroll(function() {
  var y = $(this).scrollTop();
  if (y > height - (detailHeights + 200) ) {
    // $('.outer').fadeOut();
    $(".exhibtionArtists").css({"position": "relative"});


  } else if (y > height - 500) {
    $('.outer').fadeOut();
    $(".artFairTitle").css({"position": "relative"});
    $(".artFairArtists").css({"position": "relative"});

  } else if (y < 700) {
    $('.outer').fadeOut();
    $(".exhibtionArtists").css({"position": "relative"});
    $(".artFairTitle").css({"position": "relative"});
    // $(".artFairDates").css({"position": "relative"});
    $(".artFairArtists").css({"position": "relative"});

  } else {
    $('.outer').fadeIn();
    $(".exhibtionArtists").css({"position": "fixed"});
    $(".artFairTitle").css({"position": "fixed"});
    // $(".artFairDates").css({"position": "fixed"});
    $(".artFairArtists").css({"position": "fixed"});


  }
});
const buttonDown = document.getElementById('downClick');
const buttonUp = document.getElementById('upClick');
var scrolled = 0;
$(buttonDown).click(function(){
   scrolled=scrolled+19;
        
        $("#menu-exhibition-years").animate({
                scrollTop:  scrolled
           });

});

$(buttonUp).click(function(){
   scrolled=scrolled-19;
        
        $("#menu-exhibition-years").animate({
                scrollTop:  scrolled
           });

});

//Artworks

// Reference the parent element


// When a toggle is clicked (activated) show their content
$('.closeBox').click(function () {
  var el = $(this),
      parent = el.closest('.displayText');

  if (parent.hasClass('on')) {
    // parent.find('.displayText').slideToggle();
    parent.removeClass('on');
    parent.addClass('off');
  } else {
    // parent.find('.displayText').slideToggle();
    parent.addClass('on');
    parent.removeClass('off');
  }
  return false;
});
// $(document).scroll(function() {
//   var z = $(this).scrollTop();
//   if (z > height - 400 ) {
//   } else if (z < 700) {
//       $(".exhibtionArtists").stop().css({"position": "relative", "marginLeft":($(window).scrollLeft()) + "px"}, "slow" );
    
//   } else {
//     $(".exhibtionArtists").stop().css({"position": "fixed", "marginLeft":($(window).scrollLeft()) + "px"}, "slow" );

//   }
// });


// $(window).scroll(function(){
//   var z = $(this).scrollTop();
//   if (z > height - 200) {
//   $(".exhibtionArtists").stop().css({"position": "relative", "marginLeft":($(window).scrollLeft()) + "px"}, "slow" );
//   }else {
//     $(".exhibtionArtists").stop().css({"position": "fixed", "marginLeft":($(window).scrollLeft()) + "px"}, "slow" );
//   }
// });



// $.fn.isOnScreen = function(){
    
//     var win = $(window);
    
//     var viewport = {
//         top : win.scrollTop(),
//         left : win.scrollLeft()
//     };
//     viewport.right = viewport.left + win.width();
//     viewport.bottom = viewport.top + win.height();
    
//     var bounds = this.offset();
//     bounds.right = bounds.left + this.outerWidth();
//     bounds.bottom = bounds.top + this.outerHeight();
    
//     return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
    
// };

// $(window).scroll(function(){

//    // alert($('.artworksMain').isOnScreen());
// });



// $(document).scroll(function() {
//   var z = $(this).scrollTop();
//   if (z > height - 600) {
//     console.log('bitch');
//     $('.exhibitionSide').css("margin-top","0");
//   } else {
//     $('.exhibitionSide').css('','')
//   }
// });

// $(document).ready(function(){
//   var maxLength = 700;
//   $(".show-read-more").each(function(){
//     var myStr = $(this).text();
//     if($.trim(myStr).length > maxLength){
//       var newStr = myStr.substring(0, maxLength);
//       var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
//       $(this).empty().html(newStr);
//       $(this).append(' <a href="javascript:void(0);" class="read-more">read more...</a>');
//       $(this).append('<span class="more-text">' + removedStr + '</span>');
//     }
//   });
//   $(".read-more").click(function(){
//     $(this).siblings(".more-text").contents().unwrap();
//     $(this).remove();
//   });
// });