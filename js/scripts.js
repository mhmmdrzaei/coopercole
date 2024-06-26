
(function($) {


  

  // END OF MAP //
// Check if the screen width is greater than 800px
if ($(window).width() > 800) {
  // Check if there is more than one exhibit
  if ($('.allexhibtions-home').find('.exhibitionHome').length > 1) {
    $('.exhibitionHome').addClass('slide');

    var $exhibits = $('.slide');
    var totalExhibits = $exhibits.length;
    var currentExhibit = 0;

    // Function to scroll to the next exhibit
    function scrollToNextExhibit() {
      if (currentExhibit < totalExhibits) {
        var targetScroll = currentExhibit * $(window).height();
        $('html, body').animate({ scrollTop: targetScroll }, 1000);

        currentExhibit++;

        if (currentExhibit < totalExhibits) {
          setTimeout(scrollToNextExhibit, 5000); // Scroll every 5 seconds
        } else {
          setTimeout(scrollToTop, 6000); // After the last exhibit, scroll to the top
        }
      }
    }

    function scrollToTop() {
      $('html, body').animate({ scrollTop: 0 }, 1000, function () {
        currentExhibit = 0;
        setTimeout(scrollToNextExhibit, 6000); // Start scrolling again after reaching the top
      });
    }

    // Start the scrolling process
    scrollToNextExhibit();
  }
}
  


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
    if (!$(e.target).closest('.artworkItemEach').length) {
      $('.artworkIteminfo').removeClass('open');
      $('body.bodyOveflowArt').removeClass('bodyOveflowArt');
      $('.artworkItemEach.loadingPrev').removeClass('loadingPrev');
      $('.artworkItemEach.loadingNext').removeClass('loadingNext');
    }
  });



$(".artworkItemEach").click(function() {

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

$('.previousItem').click(function(){

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
$('.nextItem').click(function(){

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

  var sectionText = $('.text-area');
  var readMoreBtn = $('.read-more-btn');
  var maxHeight = 320; // Adjust this value based on your design


   // Check if the height of the text exceeds the threshold
   if (sectionText.height() > maxHeight) {
    sectionText.css('max-height', maxHeight);
    readMoreBtn.show();
  } else {
    readMoreBtn.hide();
  }

  // Handle click event on Read More button
  readMoreBtn.on('click', function () {
    if (sectionText.css('max-height') === 'none' || sectionText.css('max-height') === '0px') {
      sectionText.css('max-height', maxHeight);
      readMoreBtn.text('+ Read More');
    } else {
      sectionText.css('max-height', '');
      readMoreBtn.text('- Read Less');
    }
  });



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

  $(".bioOpen").click(function(){
    $(".artistbioContent").toggle(500);
    $( this ).toggleClass( "highlight" );
    
  });

  $(".newsOpen").click(function(){
    $("#newsContentID").toggle(500);
    $( this ).toggleClass( "highlight" );
    
  });
    $(".exhibitionsOpen").click(function(){
    $("#exhibitionContentID").toggle(500);
    $( this ).toggleClass( "highlight" );
    
  });
      $(".mailing-list-open, .mailing-list-img").click(function(){
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

        $('footer').css('position','fixed');


    }

   
  

  
 




    $('.mohammadUl, .nonRepArtists').each(function() {
      var $this = $(this);
      var pageWidth = $(window).width();
      
      // Check if it's the home page or not
      var isHomePage = $('body.home').length > 0;
    
      // Combine conditions
      if (((isHomePage && pageWidth < 800)&& $this.find('li').length > 4 ) || (!isHomePage && $this.find('li').length > 4)) { 
        $this.addClass('scroll');
        var $ul = $this;
        var $lis = $ul.find('li');
        var baseDuration = 1 * 2000; 
        var totalNames = $lis.length;
        var animationDuration = baseDuration * totalNames;
        
        function scrollNames() {
          var marginLeft = (totalContentWidth) - pageWidth;
          $ul.css('left', '100%');
          $ul.animate({ 'left': -marginLeft }, animationDuration, 'linear', function () {
            $ul.css('left', marginLeft);
            scrollNames();
          });
        }
    
        var totalContentWidth = $ul.width() + 1100;
          
        $ul.width(totalContentWidth);
        
        // Start scrolling
        scrollNames();
      }
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
      if ($(window).width() < 850) {
          $('#gtranslate_selector').css('color', 'black');
          $('.menu__hero').toggleClass('menuvisibleMobile');
          // $('.artFairHome').css('background', 'black');
      }
      $('.hamburger-menu').toggleClass('animate');
      $('body').toggleClass('bodyOveflow');
  });
    // Hide the menu when clicking outside
    if ($(window).width() > 850) {
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
}

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
  $('.menu__nav, .artistNameExhibitionHome, .exhibitionDetailsHome,.exhibitionDateLocationHome, .artworkIteminfo, .home footer,.moreExhibits').css('background', 'black');
  $('form.searchForm input, .menu__nav, .artistNameExhibitionHome, .exhibitionDetailsHome,.exhibitionDateLocationHome, footer, .buttonOuter,.toggleText,.artworkIteminfo, video, img,.artFairEach, a:before,.inquireSubmit,.arrow:before,.newsRelatedExhibitions,.tagsInner a,.exhibitionHome,.moreExhibits,.copyrightcontainer,.copyright').css('border-color','white');

  $('.exhibitionDateLocationHome, a, .open,.exhibitionsOpen,.newsOpen,.bioOpen,#downClick, #upClick,.btn-info,.location,.date,.menu__nav li a,.artistsNames li a,.cli-plugin-main-butto,.description h2 a,.newsTitle a,.newsReadMore,.nextItem,.previousItem,.featuredVideoTitle,.ab-item,.read-more-btn,.pageNav a, .pageNav span,.artistNameExhibition .nonRepArtists li,.artFairExhibitors .nonRepArtists li,.gt_selector ').css('color','white');
  $('.infoAnimated,.mailing-list-open,.bookAnAppointment a,.menu-instagram a,.downloadCV').css('color','black');
  $('.infoAnimated,.mailing-list-open,.bookAnAppointment, .menu-instagram a,.downloadCV').css('background','white');
  localStorage.setItem('darkMode', 'enabled');
  darkModeOn = true;
}

function applyLightMode() {
  document.body.style.cssText = "background-color:#FFFFFF; color: #000000;  transition: 1s;";
  btnDarkMode.style.cssText = "background-color: #000; justify-content: flex-start; transition: 1s;";
  slider.style.cssText ="background-color: #FFFFFF;"
 mode.innerHTML = "&#9790;"
 $('svg path, svg g path').css ('fill', 'black');
 $('.menu__nav, .artistNameExhibitionHome, .exhibitionDetailsHome,.exhibitionDateLocationHome, .artworkIteminfo, .home footer,.moreExhibits,.downloadCV').css('background', 'white');
 $('form.searchForm input, .menu__nav, .artistNameExhibitionHome, .exhibitionDetailsHome,.exhibitionDateLocationHome, footer, .buttonOuter,.toggleText,.artworkIteminfo, video, img,.artFairEach, a:before,.inquireSubmit,.newsRelatedExhibitions,.tagsInner a,.exhibitionHome,.moreExhibits, .copyrightcontainer,.copyright').css('border-color','black');
$(".tags a,.tagsInner a").hover(function(e) { 
  $(this).css("color",e.type === "mouseenter"?"white":"black") 
});

 $('.exhibitionDateLocationHome, a, .open,.exhibitionsOpen,.newsOpen,.bioOpen,#downClick, #upClick,.btn-info,.location,.date, .mobileSocialVisIG,.featuredVideoTitle,.read-more-btn,.artFairArtists .nonRepArtists li, .gt_selector').css('color','black');
 $('.infoAnimated,.arrow,.bookAnAppointment a,.mailing-list-open,.wt-cli-accept-btn,.menu__nav li a,.artistsNames li a,.cli-plugin-main-butto,.description h2 a,.newsTitle a,.newsReadMore,.artistNameExhibition .nonRepArtists li,.nextItem,.previousItem,.ab-item,.pageNav a, .pageNav span,.menu-instagram a').css('color','white');
 $('.infoAnimated,.mailing-list-open, .bookAnAppointment, .menu-instagram a').css('background','black');
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
  if (!$('body').hasClass('home')) {
    var y = $(this).scrollTop();
    var x = $(window).width();
    if ((y > 500) && (x > 850)) {
      $("#topMenu").addClass('stickyMenu');
      $('#topMenu h3').css('display','none');
      $('.ccLogo').fadeIn();
    } else if ((y < 500) && (x > 850)) {
      $("#topMenu").removeClass('stickyMenu');
      $('.ccLogo').fadeOut(100);
      $('#topMenu h3').css('display','block');
    }
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

    






