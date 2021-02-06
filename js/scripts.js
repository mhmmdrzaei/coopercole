
(function($) {

  $(".artworkItemEach").click(function() {
    if ($('.artworkIteminfo').hasClass('open')) {
      $('.artworkIteminfo').removeClass('open');
    } 
      $(this).find('.artworkIteminfo').addClass("open");
       // $(this).find('.artworkIteminfo').toggleClass("closed");
      // $(this).find('.artworkIteminfo').css("display","block");

  });

 $(".closeInfo").click(function() {

    if ($('.artworkIteminfo').hasClass('open')) {
      $('.artworkIteminfo').removeClass('open');
    } 
    return false;
      // $('.artworkIteminfo').toggleClass("closed");
      // console.log('fuck');

  });

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

 //no exhibition class
    if ($(".noShowContainer")[0]){

        $("body").css('background-image', 'linear-gradient(to right, #DC03FC, #0322FC, #03FCEF, #23FC03, #FCE303, #FC7A03, #FC0303)');
        $('footer').css('background','white');
        $('.artFairHome').css('background','white');

    }

//mobile exhibition date time move 
// var windoSize = $(window).width();
// var artistNames = $('.artistNameExhibition').height();;
// if (windoSize < 700) {

//   $('.exhibitionDateLocation').css('bottom', artistNames + 'px' );
// }

 //more than 4 artists listed in Exhibition 
    $('.mohammadUl').each(function() {
      var $this = $(this);
      var x = $(window).width();
      if ($this.find('li').length > 7) { //if looking for direct descendants then do .children('div').length
          $this.find('li:nth-child(n+9)').addClass('artistNameHidden');
          $this.find('.moreArtistNamesOpen').html('<p>+ More Artists</p>');
      }
        $('.moreArtistNamesOpen').hover(function(){
          $('.artistNameHidden').fadeIn();
          $(this).fadeOut();
          $('.exhibitionDateLocation').css('top','49%');
        

      });

    });


//hamburger menu

$('.headerMainMenu').click(function(){
  $('.hamburger-menu').toggleClass('animate');
  window.setTimeout(function() {
    $('.language').toggleClass('languageIn');
    $('.searchField').toggleClass('searchIn');
    $('.menu-item-15020 a').toggleClass('mobileSocialVisIG');
    $('.mailing-list-open').toggleClass('mobileSocialVis');
  }, 0);


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
var detailHeights = $('.exhibitors').height();

// var detailArtFairHeight = $('.exhibtionArtists').height();
$(document).scroll(function() {
  var y = $(this).scrollTop();
  var x = $(window).width();
  if (y > height - (detailHeights + 200) ) {
    $('.outer').fadeOut();
    $(".exhibtionArtists").css({"position": "relative"});
     $(".exhibtionArtists").css({"bottom": "0"});


  } else if (y > height - 500) {
    $('.outer').fadeOut();
    $(".artFairTitle").css({"position": "relative"});
    $(".artFairArtists").css({"position": "relative"});

  } else if (y < 900) {
    $('.outer').fadeOut();
    $(".exhibtionArtists").css({"position": "relative"});
    $(".exhibtionArtists").css({"bottom": "0"});
    $(".artFairTitle").css({"position": "relative"});
    // $(".artFairDates").css({"position": "relative"});
    $(".artFairArtists").css({"position": "relative"});

  } else if (x > 700){
    $('.outer').fadeIn();
    $(".exhibtionArtists").css({"position": "fixed"});
    $(".exhibtionArtists").css({"bottom": "50px"});

    $(".artFairTitle").css({"position": "fixed"});
    // $(".artFairDates").css({"position": "fixed"});
    $(".artFairArtists").css({"position": "fixed"});

  } else {
    $('.outer').fadeIn();
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


// sticky menu

$(document).scroll(function() {
  var y = $(this).scrollTop();
  var x = $(window).width();
  if ((y > 500) && (x > 700)) {
    $("#topMenu").addClass('stickyMenu');
    $('.ccLogo').fadeIn();
  } else if ((y < 500) && (x > 700)) {
    $("#topMenu").removeClass('stickyMenu');
    $('.ccLogo').fadeOut(100);
  }
});

// messages back inquire / confimration box mailing list

// var App = App || {};


// App.mailingList = function() {

//     var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

//     var trigger = $('.toggle-mailing-list a');
//     var body = App.constants.body;
//     var form = $('.mailing-list');
//     var close = $('.close-mailing-list');

//     trigger.on('click', function(event) {
//         event.preventDefault();
//         body.toggleClass('mailing-list--visible');
//         form.find('.email-address').focus();
//     });

//     close.on('click', function(event) {
//         event.preventDefault();
//         body.removeClass('mailing-list--visible');
//     });

//     // form.on('submit', function(event) {
//     //     event.preventDefault();
//     //     console.log('submit');
//     //     if (!emailRegex.test($(this).find('[type="email"]').val())) {
//     //       return false;
//     //     }
//     //     $('.subscribe-to-mailing-list').addClass('loading');
//     // });

//     App.constants.document.keydown(function(e) {
//         if (e.keyCode == 27) {
//              body.removeClass('mailing-list--visible');
//         }
//     });

// };

// App.inquire = function() {

//    var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

//     $('.inquireSubmit').on('submit', function(event) {
//         event.preventDefault();
        
//         var $this = $(this);
//         var email = $(this).find('[name="email"]');
//         var name = $(this).find('[name="name"]');
//         var phone = $(this).find('[name="phone"]');
//         var data = $(this).serialize();

//         var valid_name = true;
//         var valid_email = true;
//         var valid_phone = true;

//         //remove invalids
//         $('em.invalid').remove();
//         $('input.invalid').removeClass('invalid');

//         //keydowns
//         name.keydown(function(event) {
//             $(this).removeClass('invalid');
//             $('.invalid-name').remove();
//         });

//         email.keydown(function(event) {
//             $(this).removeClass('invalid');
//             $('.invalid-phone').remove();
//         });

//         email.keydown(function(event) {
//             $(this).removeClass('invalid');
//             $('.invalid-email').remove();
//         });

//         //check name
//         if(name.val() === '') {
//             name.addClass('invalid');
//             name.after('<em class="invalid invalid-name">please enter your name</em>');
//             valid_name = false;
//         }

//         //check email
//         if (!emailRegex.test(email.val())) {
//             email.addClass('invalid');
//             email.after('<em class="invalid invalid-email">please enter a valid email address</em>');
//             valid_email = false;
//         }

//         //check phone
//         if(phone.val() === '') {
//             phone.addClass('invalid');
//             phone.after('<em class="invalid invalid-phone">please enter your phone number</em>');
//             valid_phone = false;
//         }

//         //return if not valid
//         if(!valid_name || !valid_email || !valid_phone) {
//             return false;
//         }

//         //ok good to go
//         $.ajax({
//             url: AjaxHandler.ajaxurl,
//             dataType: 'html',
//             data: {
//                 action: 'inquire',
//                 data: data
//             },
//         })
//         .done(function(response) {
//             console.log(response);
//             $this.fadeOut(300, function() {
//                 $this.after('<div class="response">'+response+'</div>');
//             });            
//         })
//         .fail(function() {
//             console.log("error");
//         })
//         .always(function() {
//             console.log("complete");
//         });
//     });

// }

// (function($){
//     var  $doc = $(document);

//     /** create mod exec controller */
//     $.readyFn = {
//         list: [
//             App.mailingList,
//             App.inquire
//         ],
//         register: function(fn) {
//             $.readyFn.list.push(fn);
//         },
//         execute: function() {
//             for (var i = 0; i < $.readyFn.list.length; i++) {
//                 try {
//                    $.readyFn.list[i].apply(document, [$]);
//                 }
//                 catch (e) {
//                     throw e;
//                 }
//             };
//         }
//     };

//     /** run all functions */
//     $doc.ready(function(){
//         $.readyFn.execute();
//     });

//     /** register function */
//     $.fn.ready = function(fn) {
//         $.readyFn.register(fn);
//     };

// })(jQuery);


