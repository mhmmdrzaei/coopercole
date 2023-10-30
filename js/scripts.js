
(function($) {
  if ($('.allexhibtions-home').find('.exhibitionHome').length > 1) {
    $('.exhibitionHome').addClass('slide');
    $('.container-home').append('<div class="timer"></div>');
}
//   // slider type
//   $t = "slide"; // opitions are fade and slide
  
//   //variables
//   $f = 1000,  // fade in/out speed
//   $s = 1000,  // slide transition speed (for sliding carousel)
//   $d = 10000;  // duration per slide
  
//   $n = $('.slide').length; //number of slides
//   $w = $('.slide').width(); // slide width
//   $c = $('.container').width(); // container width
//    $ss = $n * $w; // slideshow width

  
//     function timer() {
//       $('.timer').animate({"width":$w}, $d);
//       $('.timer').animate({"width":0}, 0);
//   }


// // fading function
//   function fadeInOut() {
//     timer();
//       $i = 0;    
//       var setCSS = {
//           'position' : 'absolute',
//           'top' : '0',
//           'left' : '0'
//       }        
      
//       $('.slide').css(setCSS);
      
//       //show first item
//       $('.slide').eq($i).show();
      

//       setInterval(function() {
//         timer();
//           $('.slide').eq($i).fadeOut($f);
//           if ($i == $n - 1) {
//               $i = 0;
//           } else {
//               $i++;
//           }
//           $('.slide').eq($i).fadeIn($f, function() {
//               $('.timer').css({'width' : '0'});
//           });

//       }, $d);
      
//   }
  
//   function slide() {
//     timer();
   
//     var setSlideCSS = {
//         'float': 'left',
//         'display': 'inline-block',
//         'width': $c
//     };
//     var setSlideShowCSS = {
//         'width': $ss // set width of slideshow container
//     };
    
//     $('.slide').css(setSlideCSS);
//     $('.allexhibtions-home').css(setSlideShowCSS);

//     // Duplicate the first slide and append to the end
//     $('.slide:nth-child(1)').clone().appendTo('.allexhibtions-home');
    

//     setInterval(function() {
//         timer();
//         $('.allexhibtions-home').animate({"left": -$w}, $s, function() {
//             // Reset position and move the original first slide to the end
//             $('.allexhibtions-home').css('left', 0);
//             $('.slide:first').appendTo('.allexhibtions-home');
//             // Remove the duplicated slide (now it's the second slide)
//             $('.slide').eq(1).remove();
//         });
//     }, $d);
// }

  
//   if ($t == "fade") {
//       fadeInOut();
      
//   } if ($t == "slide") {
//       slide();
      
//   } else {
    
//   }


  //top button
  let mybutton = document.getElementById("myBtn");
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 2000 || document.documentElement.scrollTop > 2000) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
$('#myBtn').on('click', function(){
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 30;
})


  
  $(document).on('click', function(e) {
    // If the clicked element or its parent is not '.artworkItemEach'
    if (!$(e.target).closest('.artworkItemEach').length) {
      $('.artworkIteminfo').removeClass('open');
      $('body.bodyOveflowArt').removeClass('bodyOveflowArt');
      $('.artworkItemEach.loadingPrev').removeClass('loadingPrev');
      $('.artworkItemEach.loadingNext').removeClass('loadingNext');
    }
  });



$(".artworkItemEach").click(function() {
  // e.stopPropagation();

    if ($('.artworkIteminfo').hasClass('open')) {
      $('.artworkIteminfo').removeClass('open');
    } 
      $(this).find('.artworkIteminfo').addClass("open");
      $('body').addClass('bodyOveflowArt');

      const prev = $(this).prev();
      prev.addClass('loadingPrev');
      const next = $(this).next();
      next.addClass('loadingNext');

      

  });

$('.previous').click(function(){

  if ($('.artworkIteminfo').hasClass('open')) {
    $('.artworkIteminfo').removeClass('open');
  };
  if ($('.artworkItemEach').hasClass('loadingNext')) {
     $('.artworkItemEach').removeClass('loadingNext');
   } 


  $('.loadingPrev').find('.artworkIteminfo').addClass("open");
  $(this).parents(':eq(2)').addClass('loadingNext');
  
  if ($('.artworkItemEach').hasClass('loadingPrev')) {
    $('.artworkItemEach').removeClass('loadingPrev');
  };
  $(this).parents(':eq(2)').prev().prev().addClass('loadingPrev');
  return false;

});
$('.next').click(function(){

  // $('.artworkIteminfo').removeClass('open');
  if ($('.artworkIteminfo').hasClass('open')) {
    $('.artworkIteminfo').removeClass('open');
  };
  if ($('.artworkItemEach').hasClass('loadingPrev')) {
    $('.artworkItemEach').removeClass('loadingPrev');
  };
  
  $('.loadingNext').find('.artworkIteminfo').addClass("open");
  $(this).parents(':eq(2)').addClass('loadingPrev');
  if ($('.artworkItemEach').hasClass('loadingNext')) {
     $('.artworkItemEach').removeClass('loadingNext');
   };
    $(this).parents(':eq(2)').next().next().addClass('loadingNext');
  return false;

});



$(".closeInfo").click(function() {
    $('body').removeClass('bodyOveflowArt');

    if ($('.artworkIteminfo').hasClass('open')) {
      $('.artworkIteminfo').removeClass('open');
    } 
    $('.loadingPrev').removeClass('loadingPrev');
    $('.loadingNext').removeClass('loadingNext');
    return false;


  });





   // resize the slide-read-more Div
   var box = $(".text-area");
   var minimumHeight = 388; // max height in pixels
   var initialHeight = box.innerHeight();
   // reduce the text if it's longer than 200px
   if (initialHeight > minimumHeight) {
      box.css('height', minimumHeight);
      $("#readMore1").show();
   }
  
   SliderReadMore();

   function SliderReadMore() {
      $("#readMore1").on('click', function () {
         // get current height
         var currentHeight = box.innerHeight();

         // get height with auto applied
         var autoHeight = box.css('height', 'auto').innerHeight();

         // reset height and revert to original if current and auto are equal
         var newHeight = (currentHeight | 0) === (autoHeight | 0) ? minimumHeight : autoHeight;

         box.css('height', currentHeight).animate({
            height: (newHeight)
         })
         $('html, body').animate({
            scrollTop: box.offset().top
         });
         // $(this).toggle('- Read Less')
      });
   }


})(jQuery);


function myFunction() {
  document.getElementById("menu-languages-menu").classList.toggle("show");
}

//video Link
$(document).ready(function(){
  $(".featuredVideo").each(function(){
    $(this).click(function() {
    $(this).find("#featuredVideoLink").toggle(1000);
   });   
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
    if ($(".noShowContainerNew")[0]){

        // $("body").css('background-image', 'linear-gradient(to right, #DC03FC, #0322FC, #03FCEF, #23FC03, #FCE303, #FC7A03, #FC0303)');
        // $('footer').css('background','white');
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
    $('.mohammadUl, .nonRepArtists').each(function() {
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


// menu 

    // Your existing menu toggle function
    $('.menu__icon').click(function(e) {
      e.stopPropagation(); // prevent this click from being propagated to document
      $('.menu__hero').toggleClass('openMenu');
      window.setTimeout(function() {
          $('.language').toggleClass('languageIn');
          $('.searchField').toggleClass('searchIn');
          $('.menu-item-15020 a').toggleClass('mobileSocialVisIG');
          $('.menu-instagram a').toggleClass('mobileSocialVisIG');
          $('.mailing-list-open').toggleClass('mobileSocialVis');
      }, 0);
      if ($(window).width() < 730) {
          $('#gtranslate_selector').css('color', 'black');
          $('.menu__hero').toggleClass('menuvisibleMobile');
          $('.artFairHome').css('background', 'black');
      }
      $('.hamburger-menu').toggleClass('animate');
      $('body').toggleClass('bodyOveflow');
  });
    // Hide the menu when clicking outside
    $(document).click(function() {
      if ($('.menu__hero').hasClass('openMenu')) {
          // Reset everything to the initial state
          $('.menu__hero').removeClass('openMenu');
          $('.language, .searchField, .menu-item-15020 a, .menu-instagram a, .mailing-list-open').removeClass('languageIn searchIn mobileSocialVisIG');
          $('.hamburger-menu').removeClass('animate');
          $('body').removeClass('bodyOveflow');
          if ($(window).width() < 730) {
              $('#gtranslate_selector').css('color', '');
              $('.menu__hero').removeClass('menuvisibleMobile');
              $('.artFairHome').css('background', '');
          }
      }
  });

  // Prevent the click event from being propagated to document from the menu itself
  $('.menu__hero').click(function(e) {
      e.stopPropagation();
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

//  dark mode take 2
let darkModeOn = localStorage.getItem('darkMode') === 'enabled';
let btnDarkMode = document.querySelector('.btn-dark-mode');
let mode = document.querySelector('.mode');
let slider = document.querySelector('.slider');


function applyDarkMode() {
  document.body.style.cssText = "background-color:#000000; color: #FFFFFF; transition: 1s;";
  btnDarkMode.style.cssText = "background-color: #fff; justify-content: flex-end; transition: 1s;";
  slider.style.cssText ="background-color: #000;"
  mode.innerHTML = "&#9788;"
  $('svg path, svg g path').css ('fill', 'white');
  $('.menu__nav, .artistNameExhibitionHome, .exhibitionDetailsHome,.exhibitionDateLocationHome, .artworkIteminfo').css('background', 'black');
  $('form.searchForm input, .menu__nav, .artistNameExhibitionHome, .exhibitionDetailsHome,.exhibitionDateLocationHome, footer, .buttonOuter,.toggleText,.artworkIteminfo, video, img,.artFairEach, a:before,.inquireSubmit,.arrow:before,.newsRelatedExhibitions,.tagsInner a,.exhibitionHome').css('border-color','white');

  $('.exhibitionDateLocationHome, a, .open,.nonRepArtists li,.exhibitionsOpen,.newsOpen,#downClick, #upClick,.btn-info,.location,.date').css('color','white');
  $('.mailing-list-open,.infoAnimated, .mobileSocialVisIG').css('color','black');
  $('.mailing-list-open,.infoAnimated,.bookAnAppointment , .mobileSocialVisIG').css('background','white');
  $('.bookAnAppointment a').css('color','black');
  localStorage.setItem('darkMode', 'enabled');
  darkModeOn = true;
}

function applyLightMode() {
  document.body.style.cssText = "background-color:#FFFFFF; color: #000000;  transition: 1s;";
  btnDarkMode.style.cssText = "background-color: #000; justify-content: flex-start; transition: 1s;";
  slider.style.cssText ="background-color: #FFFFFF;"
 mode.innerHTML = "&#9790;"
 $('svg path, svg g path').css ('fill', 'black');
 $('.menu__nav, .artistNameExhibitionHome, .exhibitionDetailsHome,.exhibitionDateLocationHome, .artworkIteminfo').css('background', 'white');
 $('form.searchForm input, .menu__nav, .artistNameExhibitionHome, .exhibitionDetailsHome,.exhibitionDateLocationHome, footer, .buttonOuter,.toggleText,.artworkIteminfo, video, img,.artFairEach, a:before,.inquireSubmit,.newsRelatedExhibitions,.tagsInner a,.exhibitionHome').css('border-color','black');
$(".tags a,.tagsInner a").hover(function(e) { 
  $(this).css("color",e.type === "mouseenter"?"white":"black") 
});

 $('.exhibitionDateLocationHome, a, .open,.exhibitionsOpen,.newsOpen,#downClick, #upClick,.btn-info,.location,.date').css('color','black');
 $('.bookAnAppointment a,.menu__nav li a,.artistsNames li a,.cli-plugin-main-butto,.description h2 a,.newsTitle a,.newsReadMore,.nonRepArtists li,.next,.previous').css('color','white');
 $('.mailing-list-open,.infoAnimated,.newsOpen,.btn-info,.featuredVideoTitle,.arrow,.mobileSocialVisIG').css('color','white');
 $('.mailing-list-open,.infoAnimated,.bookAnAppointment,.mobileSocialVisIG').css('background','black');
 localStorage.setItem('darkMode', 'disabled');
  darkModeOn = false;

}

function toggleDarkMode() {
  darkModeOn ? applyLightMode() : applyDarkMode();
}

document.addEventListener('DOMContentLoaded', function() {
  // Initialize dark mode state from localStorage
  darkModeOn ? applyDarkMode() : applyLightMode();

  let btnDarkMode = document.querySelector('.btn-dark-mode');
  btnDarkMode.addEventListener('click', toggleDarkMode);
  
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










