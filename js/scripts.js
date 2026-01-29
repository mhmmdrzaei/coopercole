(function ($) {
  
  // END OF MAP //
  // Check if the screen width is greater than 800px
  if ($(window).width() > 800) {
    // Check if there is more than one exhibit
    if ($(".allexhibtions-home").find(".exhibitionHome").length > 1) {
      $(".exhibitionHome").addClass("slide");

      var $exhibits = $(".slide");
      var totalExhibits = $exhibits.length;
      var currentExhibit = 0;

      // Function to scroll to the next exhibit
      function scrollToNextExhibit() {
        if (currentExhibit < totalExhibits) {
          var targetScroll = currentExhibit * $(window).height();
          $("html, body").animate({ scrollTop: targetScroll }, 1000);

          currentExhibit++;

          if (currentExhibit < totalExhibits) {
            setTimeout(scrollToNextExhibit, 5000); // Scroll every 5 seconds
          } else {
            setTimeout(scrollToTop, 6000); // After the last exhibit, scroll to the top
          }
        }
      }

      function scrollToTop() {
        $("html, body").animate({ scrollTop: 0 }, 1000, function () {
          currentExhibit = 0;
          setTimeout(scrollToNextExhibit, 6000); // Start scrolling again after reaching the top
        });
      }

      // Start the scrolling process
      scrollToNextExhibit();
    }
  }


  $(document).on("click", function (e) {
    if (!$(e.target).closest(".artworkItemEach").length) {
      $(".artworkIteminfo").removeClass("open");
      $("body.bodyOveflowArt").removeClass("bodyOveflowArt");
      $(".artworkItemEach.loadingPrev").removeClass("loadingPrev");
      $(".artworkItemEach.loadingNext").removeClass("loadingNext");
    }
  });
  

  $(".artworkItemEach").click(function () {
    if ($(".artworkIteminfo").hasClass("open")) {
      $(".artworkIteminfo").removeClass("open");
    }
    $(this).find(".artworkIteminfo").addClass("open");
    $("body").addClass("bodyOveflowArt");

    const prev = $(this).prev();
    prev.addClass("loadingPrev");
    const next = $(this).next();
    next.addClass("loadingNext");
  });
 $(".inquiry-toggle").click(function(){
    $(".inquireFormFull").toggle();    
    // swap + / –
    if ( $(".inquireFormFull").is(":visible") ) {
      $(this).text("– Request Pricing Information");
    } else {
      $(this).text("+ Request Pricing Information");
    }
  });

  
  
  $(".previousItem").click(function () {
    if ($(".artworkIteminfo").hasClass("open")) {
      $(".artworkIteminfo").removeClass("open");
    }
    if ($(".artworkItemEach").hasClass("loadingNext")) {
      $(".artworkItemEach").removeClass("loadingNext");
    }

    $(".loadingPrev").find(".artworkIteminfo").addClass("open");
    $(this).parents(":eq(2)").addClass("loadingNext");

    if ($(".artworkItemEach").hasClass("loadingPrev")) {
      $(".artworkItemEach").removeClass("loadingPrev");
    }
    $(this).parents(":eq(2)").prev().prev().addClass("loadingPrev");
    return false;
  });
  $(".nextItem").click(function () {
    if ($(".artworkIteminfo").hasClass("open")) {
      $(".artworkIteminfo").removeClass("open");
    }
    if ($(".artworkItemEach").hasClass("loadingPrev")) {
      $(".artworkItemEach").removeClass("loadingPrev");
    }

    $(".loadingNext").find(".artworkIteminfo").addClass("open");
    $(this).parents(":eq(2)").addClass("loadingPrev");
    if ($(".artworkItemEach").hasClass("loadingNext")) {
      $(".artworkItemEach").removeClass("loadingNext");
    }
    $(this).parents(":eq(2)").next().next().addClass("loadingNext");
    return false;
  });

  $(".closeInfo").click(function () {
    $("body").removeClass("bodyOveflowArt");

    if ($(".artworkIteminfo").hasClass("open")) {
      $(".artworkIteminfo").removeClass("open");
    }
    $(".loadingPrev").removeClass("loadingPrev");
    $(".loadingNext").removeClass("loadingNext");
    return false;
  });

})(jQuery);

function myFunction() {
  document.getElementById("menu-languages-menu").classList.toggle("show");
}

//video Link
$(document).ready(function () {
  $(".featuredVideo").each(function () {
    $(this).click(function () {
      $(this).find("#featuredVideoLink").toggle(1000);
    });
  });

  $(".bioOpen").click(function () {
    $(".artistbioContent").toggle(500);
    $(this).toggleClass("highlight");
     $(".newsOpen").removeClass("highlight");
     $(".exhibitionsOpen").removeClass("highlight");
     $('#newsContentID').hide(200);
     $('.exhibitionInquiry').hide(200);
     $('#exhibitionContentID').hide(200);
  });

  $(".newsOpen").click(function () {
    // Close the other section
    $(".pressRelease").hide(200);
    $(".prToggle").removeClass("prToggleOpen");
     $('.exhibitionInquiry').hide(200);
     $('#exhibitionContentID').hide(200);
     $('.bioOpen').removeClass('highlight');
     $('.artistbioContent').hide(200);
      $(".exhibitionsOpen").removeClass("highlight");

     
    

    // Toggle the current section
    $("#newsContentID").toggle(200);
    $(this).toggleClass("highlight");
    $(".exhibitionInquiry").hide(200);
});

$(".prToggle").click(function () {
    // Close the other section
    $("#newsContentID").hide(200);
    $(".newsOpen").removeClass("highlight");
    $(".exhibitionInquiry").hide(200);

    // Toggle the current section
    $(".pressRelease").toggle(500);
    $(this).toggleClass("prToggleOpen");
});
$(".moreInfo").click(function (){
   $(".exhibitionInquiry").toggle(300);
   $("#newsContentID").hide(200);
   $(".pressRelease").hide(200);
   $(".prToggle").removeClass("prToggleOpen");
   $(".newsOpen").removeClass("highlight");
   $('.bioOpen').removeClass('highlight');
   $('.artistbioContent').hide(200);
    $(".exhibitionsOpen").removeClass("highlight");
   $('#exhibitionContentID').hide(200);

})
$(".closeInquiry").click(function(){
  $(".exhibitionInquiry").toggle(200);
})


  $(".exhibitionsOpen").click(function () {
    $("#exhibitionContentID").toggle(500);
    $(this).toggleClass("highlight");
    $('.artistbioContent').hide(200);
    $('#newsContentID').hide(200);
    $('.exhibitionInquiry').hide(200);
    $('.bioOpen').removeClass('highlight');
     $(".newsOpen").removeClass("highlight");
  });
  $(".mailing-list-open, .mailing-list-img").click(function () {
    // $(".mailing-list").toggle(500);
    $(".mailing-list").toggleClass("highlightML");
  });
  $(".closelistML").click(function () {
    // $(".mailing-list").toggle(500);
    $(".mailing-list").toggleClass("highlightML");
  });
  $(".toggle-mailing-list").click(function () {
    // $(".mailing-list").toggle(500);
    $(".mailing-list").toggleClass("highlightML");
  });

  //no exhibition class
  if ($(".noShowContainerNew")[0]) {
    $("footer").css("position", "fixed");
  }

  $(".artistNameExhibitionHome .mohammadUl, .artistNameExhibitionHome .nonRepArtists").each(function () {
    var $this = $(this);
    var pageWidth = $(window).width();



    // Combine conditions
    if (
      ( pageWidth < 800 && $this.find("li").length > 4) 
    ) {
      $this.addClass("scroll");
      var $ul = $this;
      var $lis = $ul.find("li");
      var baseDuration = 1 * 2000;
      var totalNames = $lis.length;
      var animationDuration = baseDuration * totalNames;

      function scrollNames() {
        var marginLeft = totalContentWidth - pageWidth;
        $ul.css("left", "100%");
        $ul.animate(
          { left: -marginLeft },
          animationDuration,
          "linear",
          function () {
            $ul.css("left", marginLeft);
            scrollNames();
          }
        );
      }

      var totalContentWidth = $ul.width() + 1100;

      $ul.width(totalContentWidth);

      // Start scrolling
      scrollNames();
    }
  });
  
  $('.exhibitionHeader .artists, .exhibitionInfoDetail .artistNameExhibitionHome').each(function() {
    var $this = $(this);
    if($this.find("li").length > 9) {
      $this.addClass("two-column");
    }
  })

  //news items more than 10

  $(".newsContent").each(function () {
    var $this = $(this);
    var x = $(window).width();
    if ($this.find("li").length > 13) {
      //if looking for direct descendants then do .children('div').length
      $this.find("li:nth-child(n+13)").addClass("newsHidden");
      $this.find(".moreNewsOpen").html("<p>+ More News</p>");
    }
    $(".moreNewsOpen").click(function () {
      $(".newsHidden").fadeIn();
      $(this).fadeOut();
    });
  });
  //Artworks
  $(".single").each(function () {
    if ($(".artworksMain").length) {
      $(".outerArtworks").css("display", "block");
    }
    
  });

  // menu

  // Your existing menu toggle function
  $(".menu__icon").click(function (e) {
    e.stopPropagation(); // prevent this click from being propagated to document
    $(".menu__hero").toggleClass("openMenu");
    window.setTimeout(function () {
      $(".language").toggleClass("languageIn");
      $(".searchField").toggleClass("searchIn");
      $(".menu-item-15020 a").toggleClass("mobileSocialVisIG");
      $(".menu-instagram a").toggleClass("mobileSocialVisIG");
      $(".mailing-list-open").toggleClass("mobileSocialVis");
    }, 0);
    if ($(window).width() < 850) {
      $("#gtranslate_selector").css("color", "black");
      $(".menu__hero").toggleClass("menuvisibleMobile");
      $(".exhibitionDetailsHome").hide();
      // $('.artFairHome').css('background', 'black');
    }
    $(".hamburger-menu").toggleClass("animate");
    $("body").toggleClass("bodyOveflow");
  });
  // Hide the menu when clicking outside
  if ($(window).width() > 850) {
    $(document).click(function () {
      if ($(".menu__hero").hasClass("openMenu")) {
        // Reset everything to the initial state
        $(".menu__hero").removeClass("openMenu");
        $(
          ".language, .searchField, .menu-item-15020 a, .menu-instagram a, .mailing-list-open"
        ).removeClass("languageIn searchIn mobileSocialVisIG");
        $(".hamburger-menu").removeClass("animate");
        $("body").removeClass("bodyOveflow");
        if ($(window).width() < 730) {
          $("#gtranslate_selector").css("color", "");
          $(".menu__hero").removeClass("menuvisibleMobile");
          $(".artFairHome").css("background", "");
        }
      }
    });
  }

  // Prevent the click event from being propagated to document from the menu itself
  $(".menu__hero").click(function (e) {
    e.stopPropagation();
  });

  //smooth scroll
  // Add smooth scrolling to all links
  $("a").on("click", function (event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      $("html, body").animate(
        {
          scrollTop: $(hash).offset().top,
        },
        800,
        function () {
          // Add hash (#) to URL when done scrolling (default click behavior)
          window.location.hash = hash;
        }
      );
    } // End if
  });

 function adjustFooter() {
    const bodyH = $('body').prop('scrollHeight'); // total body height
    const winH  = $(window).height();             // viewport height
    const $foot = $('footer');                    // your footer selector

    if (bodyH < winH) {
      $foot.css({
        position: 'fixed',
      });
    } else {
      $foot.css({
        position: '',
        bottom:   '',
        left:     '',
        width:    ''
      });
    }
  }
    adjustFooter();
  // …and every time the window resizes
  $(window).on('resize', adjustFooter);

});


const buttonDown = document.getElementById("downClick");
const buttonUp = document.getElementById("upClick");
var scrolled = 0;
$(buttonDown).click(function () {
  scrolled = scrolled + 22;

  $("#menu-exhibition-years").animate({
    scrollTop: scrolled,
  });
});

$(buttonUp).click(function () {
  scrolled = scrolled - 22;

  $("#menu-exhibition-years").animate({
    scrollTop: scrolled,
  });
});

// When a toggle is clicked (activated) show their content
$(".closeBox").click(function () {
  var el = $(this),
    parent = el.closest(".displayText");

  if (parent.hasClass("on")) {
    // parent.find('.displayText').slideToggle();
    parent.removeClass("on");
    parent.addClass("off");
  } else {
    // parent.find('.displayText').slideToggle();
    parent.addClass("on");
    parent.removeClass("off");
  }
  return false;
});

//  dark mode take 2
document.addEventListener("DOMContentLoaded", function() {
  // 1) Cache your elements once the DOM is loaded
  const btnDarkMode = document.querySelector(".btn-dark-mode");
  const mode        = document.querySelector(".mode");
  const slider      = document.querySelector(".slider");

  // 2) Read the saved state (default to light mode)
  let darkModeOn = localStorage.getItem("darkMode") === "enabled";

  // 3) Define dark-mode styles
  function applyDarkMode() {
    document.body.style.cssText =
      "background-color: #000000; color: #FFFFFF; transition: 1s;";
    btnDarkMode.style.cssText =
      "background-color: #fff; justify-content: flex-end; transition: 1s;";
    slider.style.cssText = "background-color: #000;";
    mode.innerHTML       = "&#9788;"; // ☀︎

    // jQuery tweaks for dark mode
    $("svg path, svg g path").css("fill", "white");
    $(
      ".menu__nav, .artistNameExhibitionHome, .exhibitionDetailsHome, .exhibitionDateLocationHome, .artworkIteminfo, footer, .moreExhibits, .exhibitionHeader .artists, .exhibitionInfo, .imagesMenu, .pressRelease, .exhibitionInquiry, #newsContentID, .exhibitionYearsSide, .artistbioContent, #exhibitionContentID"
    ).css("background", "black");
    $(
      "form.searchForm input, .menu__nav, .artistNameExhibitionHome, .exhibitionDetailsHome, .exhibitionDateLocationHome, footer, .buttonOuter, .toggleText, .artworkIteminfo, video, img, .artFairEach, a:before, .inquireSubmit, .arrow:before, .newsRelatedExhibitions, .tagsInner a, .exhibitionHome, .moreExhibits, .copyrightcontainer, .copyright, .exhibitionHeader .artists, .exhibitionInfo, .imagesMenu, #newsContentID, .pageShop .cartTitle, .pageShop .pageTop, .pageShop .type-product, .related .type-product, .productContainer .woocommerce, .related"
    ).css("border-color", "white");
    $(
      "bdi, .woocommerce-loop-product__title, .exhibitionDateLocationHome, a, .open, .exhibitionsOpen, .newsOpen, .bioOpen, #downClick, #upClick, .btn-info, .location, .date, .menu__nav li a, .artistsNames li a, .cli-plugin-main-butto, .description h2 a, .newsTitle a, .newsReadMore, .nextItem, .previousItem, .featuredVideoTitle, .ab-item, .read-more-btn, .pageNav a, .pageNav span, .artistNameExhibition .nonRepArtists li, .artFairExhibitors .nonRepArtists li, .gt_selector, .prToggle"
    ).css("color", "white");
    $(
      ".price, .infoAnimated, .mailing-list-open, .bookAnAppointment a, .menu-instagram a, .downloadCV, .moreInfo"
    ).css("color", "black");
    $(
      ".infoAnimated, .mailing-list-open, .bookAnAppointment, .menu-instagram a, .downloadCV, .moreInfo"
    ).css("background", "white");

    localStorage.setItem("darkMode", "enabled");
    darkModeOn = true;
  }

  // 4) Define light-mode styles
  function applyLightMode() {
    document.body.style.cssText =
      "background-color: #FFFFFF; color: #000000; transition: 1s;";
    btnDarkMode.style.cssText =
      "background-color: #000; justify-content: flex-start; transition: 1s;";
    slider.style.cssText = "background-color: #FFFFFF;";
    mode.innerHTML       = "&#9790;"; // ☾

    // jQuery tweaks for light mode
    $("svg path, svg g path").css("fill", "black");
    $(
      ".menu__nav, .artistNameExhibitionHome, .exhibitionDetailsHome, .exhibitionDateLocationHome, .artworkIteminfo, footer, .moreExhibits, .downloadCV, .exhibitionHeader .artists, .exhibitionInfo, .imagesMenu, .pressRelease, #newsContentID, .exhibitionYearsSide, .artistbioContent, #exhibitionContentID, .exhibitionInquiry"
    ).css("background", "white");
    $(
      "form.searchForm input, .menu__nav, .artistNameExhibitionHome, .exhibitionDetailsHome, .exhibitionDateLocationHome, footer, .buttonOuter, .toggleText, .artworkIteminfo, video, img, .artFairEach, a:before, .inquireSubmit, .newsRelatedExhibitions, .tagsInner a, .exhibitionHome, .moreExhibits, .copyrightcontainer, .copyright, .exhibitionHeader .artists, .exhibitionInfo, .imagesMenu, .pressRelease, #newsContentID, .type-product, .productContainer .woocommerce, .related,.pageTop"
    ).css("border-color", "black");
    $(".tags a, .tagsInner a").hover(function(e) {
      $(this).css("color", e.type === "mouseenter" ? "white" : "black");
    });
    $(
      "bdi, .woocommerce-loop-product__title, .exhibitionDateLocationHome, a, .open, .exhibitionsOpen, .newsOpen, .bioOpen, #downClick, #upClick, .btn-info, .location, .date, .mobileSocialVisIG, .featuredVideoTitle, .read-more-btn, .artFairArtists .nonRepArtists li, .gt_selector"
    ).css("color", "black");
    $(
      ".infoAnimated, .arrow, .bookAnAppointment a, .mailing-list-open, .wt-cli-accept-btn, .menu__nav li a, .artistsNames li a, .cli-plugin-main-butto, .description h2 a, .newsTitle a, .newsReadMore, .artistNameExhibition .nonRepArtists li, .nextItem, .previousItem, .ab-item, .pageNav a, .pageNav span, .menu-instagram a"
    ).css("color", "white");
    $(
      ".infoAnimated, .mailing-list-open, .bookAnAppointment, .menu-instagram a"
    ).css("background", "black");

    localStorage.setItem("darkMode", "disabled");
    darkModeOn = false;
  }

  // 5) Toggle helper
  function toggleDarkMode() {
    darkModeOn ? applyLightMode() : applyDarkMode();
  }

  // 6) Initialize on page load
  darkModeOn ? applyDarkMode() : applyLightMode();

  // 7) Wire up the button
  btnDarkMode.addEventListener("click", toggleDarkMode);
});

// woocom 
$('.product-type-simple').each(function () {
    if ($(this).find('.related').length === 0) {
      $(this).addClass('flex-product-type');
    }
  });

// sticky menu

$(window).scroll(function () {
  if (!$("body").hasClass("home")) {
    var y = $(this).scrollTop();
    var x = $(window).width();
    if (y > 500 && x > 850) {
      $("#topMenu").addClass("stickyMenu");
      $("#topMenu h3").css("display", "none");
      $(".ccLogo").fadeIn();
    } else if (y < 500 && x > 850) {
      $("#topMenu").removeClass("stickyMenu");
      $(".ccLogo").fadeOut(100);
      $("#topMenu h3").css("display", "block");
    }
  }
});
//swiper js
/**
 * Swiper gallery + fullscreen viewer + hover zoom (desktop)
 * - Supports multiple .galleryContainer instances per page
 * - Hover zoom only works on slides that contain .swiper-zoom-container (images)
 * - Loop-safe (Swiper duplicates slides), uses delegated click for fullscreen
 * - Fullscreen supports prev/next + mobile swipe
 */

let currentIndex = 0;
let currentSlides = [];

// -------- Helpers --------
function isTouchDevice() {
  return window.matchMedia("(pointer: coarse)").matches;
}

function getSlideContent($slide) {
  // Prefer video if present
  const $video = $slide.find("video").first();
  if ($video.length) {
    return $video
      .clone()
      .attr("controls", true)
      .prop("muted", false)
      .prop("autoplay", true);
  }

  // Otherwise image
  const $img = $slide.find("img").first();
  if ($img.length) {
    const $clone = $img.clone();

    // ---- IMPORTANT: remove Swiper zoom state from the clone ----
    $clone.removeClass("swiper-zoom-target"); // Swiper sets this
    $clone.css({
      transform: "none",
      transition: "none",
      width: "",
      height: "",
      maxWidth: "100%",
      maxHeight: "100%",
    });
    $clone.removeAttr("style"); // if you prefer to nuke all inline styles

    return $clone;
  }

  return null;
}


function updateFullscreenContent(index) {
  const $slide = $(currentSlides[index]);
  const $newContent = getSlideContent($slide);

  if ($newContent) {
    $(".fullscreen-container img, .fullscreen-container video").remove();
    $(".fullscreen-container").prepend($newContent);
  }
}

function openFullscreen(index) {
  $(".fullscreen-container").remove(); // Remove existing fullscreen

  const $slide = $(currentSlides[index]);
  const $content = getSlideContent($slide);

  if (!$content) return;

  const $fullscreenContainer = $('<div class="fullscreen-container"></div>');
  const $closeButton = $('<div class="fullscreen-close" role="button" aria-label="Close">&times;</div>');

  $fullscreenContainer.append($content).append($closeButton);

  // Only add prev/next if more than one slide
  if (currentSlides.length > 1) {
    const $prevButton = $('<div class="fullscreen-prev" role="button" aria-label="Previous">&#8592;</div>');
    const $nextButton = $('<div class="fullscreen-next" role="button" aria-label="Next">&#8594;</div>');

    $fullscreenContainer.append($prevButton).append($nextButton);

    $prevButton.on("click", function () {
      currentIndex = (currentIndex - 1 + currentSlides.length) % currentSlides.length;
      updateFullscreenContent(currentIndex);
    });

    $nextButton.on("click", function () {
      currentIndex = (currentIndex + 1) % currentSlides.length;
      updateFullscreenContent(currentIndex);
    });

    // Swipe support for mobile
    let startX = 0;
    let endX = 0;

    $fullscreenContainer.on("touchstart", function (e) {
      startX = e.originalEvent.touches[0].clientX;
      endX = startX;
    });

    $fullscreenContainer.on("touchmove", function (e) {
      endX = e.originalEvent.touches[0].clientX;
    });

    $fullscreenContainer.on("touchend", function () {
      const diff = startX - endX;

      if (Math.abs(diff) > 50) {
        if (diff > 0) {
          // Swipe Left → Next
          currentIndex = (currentIndex + 1) % currentSlides.length;
        } else {
          // Swipe Right → Prev
          currentIndex = (currentIndex - 1 + currentSlides.length) % currentSlides.length;
        }
        updateFullscreenContent(currentIndex);
      }
    });
  }

  $("body").append($fullscreenContainer);

  $closeButton.on("click", function () {
    $fullscreenContainer.remove();
  });

  // ESC to close
  $(document).on("keydown.fullscreen", function (e) {
    if (e.key === "Escape") {
      $(".fullscreen-container").remove();
      $(document).off("keydown.fullscreen");
    }
  });
}

// -------- Swiper init (per gallery) --------
document.querySelectorAll(".galleryContainer .swiper").forEach((swiperEl) => {
  const galleryContainer = swiperEl.closest(".galleryContainer");

  const instance = new Swiper(swiperEl, {
    direction: "horizontal",
    loop: true,

    zoom: {
      maxRatio: 3,
      minRatio: 1,
      toggle: false, // controlled by hover
    },

    pagination: {
      el: swiperEl.querySelector(".swiper-pagination"),
      clickable: true,
    },

    navigation: {
      nextEl: galleryContainer.querySelector(".swiper-button-next"),
      prevEl: galleryContainer.querySelector(".swiper-button-prev"),
    },
  });

  // Hover-to-zoom (desktop only)
if (!isTouchDevice()) {
  document.querySelectorAll(".galleryContainer .swiper-zoom-container").forEach((wrap) => {
    // Set your zoom strength here
    wrap.style.setProperty("--zoom", "2.5");

    wrap.addEventListener("mouseenter", () => {
      wrap.classList.add("is-zooming");
    });

    wrap.addEventListener("mouseleave", () => {
      wrap.classList.remove("is-zooming");
      // Reset origin so next hover starts centered
      const img = wrap.querySelector("img");
      if (img) img.style.transformOrigin = "50% 50%";
    });

    wrap.addEventListener("mousemove", (e) => {
      if (!wrap.classList.contains("is-zooming")) return;

      const rect = wrap.getBoundingClientRect();
      const x = ((e.clientX - rect.left) / rect.width) * 100;
      const y = ((e.clientY - rect.top) / rect.height) * 100;

      const img = wrap.querySelector("img");
      if (!img) return;

      // Clamp to 0–100 so you can hit corners cleanly
      const cx = Math.max(0, Math.min(100, x));
      const cy = Math.max(0, Math.min(100, y));

      img.style.transformOrigin = `${cx}% ${cy}%`;
    });
  });
}
});

// -------- Fullscreen click (delegated; loop-safe) --------
$(document).on("click", ".galleryContainer .swiper-slide", function () {
  const $swiperEl = $(this).closest(".swiper");
  const $wrapper = $swiperEl.find(".swiper-wrapper");

  currentSlides = $wrapper.find(".swiper-slide").toArray();
  currentIndex = currentSlides.indexOf(this);

  openFullscreen(currentIndex);
});


var emailRegex =
  /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

$(".inquireSubmit").click(function (event) {
  event.preventDefault();

  var $this = $(this).parent();
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
  $("em.invalid").remove();
  $("input.invalid").removeClass("invalid");

  //keydowns
  name.keydown(function (event) {
    $(this).removeClass("invalid");
    $(".invalid-name").remove();
  });

  email.keydown(function (event) {
    $(this).removeClass("invalid");
    $(".invalid-phone").remove();
  });

  email.keydown(function (event) {
    $(this).removeClass("invalid");
    $(".invalid-email").remove();
  });

  //check name
  if (name.val() === "") {
    name.addClass("invalid");
    name.after('<em class="invalid invalid-name">please enter your name</em>');
    valid_name = false;
  }

  //check email
  if (!emailRegex.test(email.val())) {
    email.addClass("invalid");
    email.after(
      '<em class="invalid invalid-email">please enter a valid email address</em>'
    );
    valid_email = false;
  }

  //check phone
  if (phone.val() === "") {
    phone.addClass("invalid");
    phone.after(
      '<em class="invalid invalid-phone">please enter your phone number</em>'
    );
    valid_phone = false;
  }

  //return if not valid
  if (!valid_name || !valid_email || !valid_phone) {
    return false;
  }

  //ok good to go
  $.ajax({
    url: AjaxHandler.ajaxurl,
    dataType: "html",
    data: {
      action: "inquire",
      data: data,
    },
  })
    .done(function (response) {
      console.log(response);
      $this.fadeOut(300, function () {
        $this.after('<div class="response">' + response + "</div>");
      });
    })
    .fail(function () {
      console.log("error");
    })
    .always(function () {
      console.log("complete");
    });
});

//artist page
document.addEventListener('DOMContentLoaded', function(){
  const bgEl     = document.querySelector('.artist-bg');
  if (!bgEl) return;

  const defaultBg = bgEl.style.backgroundImage;
  const fadeTime  = 500; // in ms, match your CSS .5s
  let swapTimer;

  document.querySelectorAll('.artist-link[data-bg]').forEach(link => {
    const imgURL = link.dataset.bg;

    link.addEventListener('mouseenter', () => {
      clearTimeout(swapTimer);
      // 1) fade out to .3
      bgEl.classList.remove('show');
      // 2) after fadeTime, swap image & fade in
      swapTimer = setTimeout(() => {
        bgEl.style.backgroundImage = 'url(' + imgURL + ')';
        bgEl.classList.add('show');
      }, fadeTime);
    });

    link.addEventListener('mousemove', e => {
      // only apply dynamic opacity if we're already showing this artist
      if (!bgEl.classList.contains('show') ||
          !bgEl.style.backgroundImage.includes(imgURL)) return;

      const rect    = link.getBoundingClientRect();
      const centerX = rect.left + rect.width / 2;
      const dist    = Math.abs(e.clientX - centerX);
      const ratio   = Math.max(0, 1 - dist / (rect.width / 2));
      const dynamic = 0.3 + 0.7 * ratio;

      // override CSS opacity
      bgEl.style.opacity = dynamic;
    });

    link.addEventListener('mouseleave', () => {
      clearTimeout(swapTimer);
      // fade back to default image
      bgEl.classList.remove('show');
      swapTimer = setTimeout(() => {
        bgEl.style.backgroundImage = defaultBg;
      }, fadeTime);
      // clear any inline opacity so CSS reverts to 0.3
      bgEl.style.opacity = '';
    });
  });
});
