
(function($) {

  $(".artworkItemEach").click(function() {
    if ($('.artworkIteminfo').hasClass('open')) {
      $('.artworkIteminfo').removeClass('open');
    } 
      $(this).find('.artworkIteminfo').addClass("open");
      $('body').addClass('bodyOveflowArt');
      // $(this).find('.inquiry').html("<div><p>[forminator_form id=\"15029\"]</p></div>");
       // $(this).find('.artworkIteminfo').toggleClass("closed");
      // $(this).find('.artworkIteminfo').css("display","block");

  });

 $(".closeInfo").click(function() {
    $('body').removeClass('bodyOveflowArt');

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

// // Close the dropdown if the user clicks outside of it
// window.onclick = function(event) {
//   if (!event.target.matches('.dropbtn')) {
//     var dropdowns = document.getElementById("menu-languages-menu");
//     var i;
//     for (i = 0; i < dropdowns.length; i++) {
//       var openDropdown = dropdowns[i];
//       if (openDropdown.classList.contains('show')) {
//         openDropdown.classList.remove('show');
//       }
//     }
//   }
// } 
//video Link
$(document).ready(function(){
  $(".featuredVideo").each(function(){
    $(this).click(function() {
    $(this).find("#featuredVideoLink").toggle(1000);
   });   
  });
  //   $(".featuredVideo").each(function(){
  //   $( ".featuredVideoTitle" ).click(function() {
  //   $(this).find("#featuredVideoLink").toggle(1000);
  //  });   
  // });

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
    if ($(".noShowContainerNew")[0]){

        // $("body").css('background-image', 'linear-gradient(to right, #DC03FC, #0322FC, #03FCEF, #23FC03, #FCE303, #FC7A03, #FC0303)');
        $('footer').css('background','white');
        $('footer').css('position','fixed');
        // $('.logoall').css('fill','white');
        // $('#gtranslate_selector').css('color','white');
        // $('form.searchForm input').css('border-bottom','1px solid #ffffff');
        // $('.artFairHome').css('background','white');
        // $('.searchForm label svg g path').css('fill','white');

    }
 

    if(($('.noShowContainer')[0]) && (($(window).width()) < 730)) {
      // $('section.logo').html('<img src="https://coopercolegallery.com/wp-content/uploads/2021/03/Cooper-Coole-Logos-Full-W-Small.png" alt="Cooper Cole Gallery Logo"class="exhibitionImgsLL">');
      // $('footer').css('position','absolute');
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
      if ($this.find('li').length > 4) { //if looking for direct descendants then do .children('div').length
          $this.addClass('scroll');
          // $this.find('li:nth-child(n+5)').addClass('artistNameHidden');
          // $this.find('.moreArtistNamesOpen').html('<p>+ More Artists</p>');
      };


    });

    $('.moreArtistNamesOpen').each(function (i, value) {
        $(this).hover(function (e) {
            $(this).fadeOut();
            $(this).parent().find('.artistNameHidden').fadeIn();
            $(this).parent().next('.exhibitionDateLocation').css('top','49%');
            // $(this).prev('.artistNameHidden').fadeIn();
        });
    });


//news items more than 10

   $('.newsContent').each(function() {
     var $this = $(this);
     var x = $(window).width();
     if ($this.find('li').length > 13) { //if looking for direct descendants then do .children('div').length
         $this.find('li:nth-child(n+13)').addClass('newsHidden');
         $this.find('.moreNewsOpen').html('<p>+ More News</p>');
     }
       $('.moreNewsOpen').click(function(){
         $('.newsHidden').fadeIn();
         $(this).fadeOut();
         
       

     });

   });
//Artworks
$('.single').each(function(){
  if ($('.artworksMain').length){
    $('.outerArtworks').css('display','block');
  }
});

//hamburger menu

$('.headerMainMenu').click(function(){
  $('.hamburger-menu').toggleClass('animate');
  $('.menu__hero').toggleClass('menuvisibleMobile');
  $('body').toggleClass('bodyOveflow');
  // $(body).toggleClass('hidden');
  window.setTimeout(function() {
    $('.language').toggleClass('languageIn');
    $('.searchField').toggleClass('searchIn');
    $('.menu-item-15020 a').toggleClass('mobileSocialVisIG');
    $('.menu-instagram a').toggleClass('mobileSocialVisIG');
    $('.mailing-list-open').toggleClass('mobileSocialVis');
  }, 0);
     if(($(window).width()) < 730) {
      $('#gtranslate_selector').css('color','black');
    $('form.searchForm input').css('border-bottom','1px solid black');
    $('.artFairHome').css('background','black');
    $('.searchForm label svg g path').css('fill','black');
      // $('footer').css('position','absolute');
    }


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





// var detailArtFairHeight = $('.exhibtionArtists').height();
$(window).scroll(function() {
  var y = $(this).scrollTop();
  var x = $(window).width();
  //scrolling fade in and out
  var height = $('.exhibitionMain').height();
  var detailHeights = $('.exhibitors').height();
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
   scrolled=scrolled+22;
        
        $("#menu-exhibition-years").animate({
                scrollTop:  scrolled
           });

});

$(buttonUp).click(function(){
   scrolled=scrolled-22;
        
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

$(window).scroll(function() {
  var y = $(this).scrollTop();
  var x = $(window).width();
  if ((y > 500) && (x > 700)) {
    $("#topMenu").addClass('stickyMenu');
    $('#topMenu h3').css('display','none');
    $('.ccLogo').fadeIn();
  } else if ((y < 500) && (x > 700)) {
    $("#topMenu").removeClass('stickyMenu');
    $('.ccLogo').fadeOut(100);
    $('#topMenu h3').css('display','block');

  }
});

// // messages back inquire / confimration box mailing list

// var App = App || {};

// App.constants = {
//     win : $(window),
//     document : $(document),
//     html : $('html'),
//     body : $('body'),
//     body_html : $('html, body')
// };


// App.mailingList = function() {

//     var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

//     var trigger = $('.toggle-mailing-list');
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

   var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

    $('.inquireSubmit').click(function(event) {
        event.preventDefault();
        
        var $this = $(this).parent()
        var email = $($this).find('[name="email"]');
        var name = $($this).find('[name="name"]');
        var phone = $($this).find('[name="phone"]');
        // var location = $($this).find('[name="location"]');
        // var note = $($this).find('[name="note"]');
        var data = $($this).serialize();

        var valid_name = true;
        var valid_email = true;
        var valid_phone = true;

        //remove invalids
        $('em.invalid').remove();
        $('input.invalid').removeClass('invalid');

        //keydowns
        name.keydown(function(event) {
            $(this).removeClass('invalid');
            $('.invalid-name').remove();
        });

        email.keydown(function(event) {
            $(this).removeClass('invalid');
            $('.invalid-phone').remove();
        });

        email.keydown(function(event) {
            $(this).removeClass('invalid');
            $('.invalid-email').remove();
        });

        //check name
        if(name.val() === '') {
            name.addClass('invalid');
            name.after('<em class="invalid invalid-name">please enter your name</em>');
            valid_name = false;
        }

        //check email
        if (!emailRegex.test(email.val())) {
            email.addClass('invalid');
            email.after('<em class="invalid invalid-email">please enter a valid email address</em>');
            valid_email = false;
        }

        //check phone
        if(phone.val() === '') {
            phone.addClass('invalid');
            phone.after('<em class="invalid invalid-phone">please enter your phone number</em>');
            valid_phone = false;
        }

        //return if not valid
        if(!valid_name || !valid_email || !valid_phone) {
            return false;
        }

        //ok good to go
        $.ajax({
            url: AjaxHandler.ajaxurl,
            dataType: 'html',
            data: {
                action: 'inquire',
                data: data
            },
        })
        .done(function(response) {
            console.log(response);
            $this.fadeOut(300, function() {
                $this.after('<div class="response">'+response+'</div>');
            });            
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    });








