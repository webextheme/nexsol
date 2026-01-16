/*========================================
---------- [JS_INDEXING_START] -----------
==========================================
## [_DynamicCurrentMenuClass]
## [_Main_nav_menu]
## [_Sticky_header]
## [_Mobile_menu_list]
## [_Mobile_nav_toggler]
## [_Search_toggler]
## [_Splitting]
## [_Wow_animation]
## [_Data_attribute]
## [_Language_btn]
## [_Accordion]
## [_js_tilt]
## [_video_popup]
## [_Sticky_Content]
## [_Client_items]
## [_Sticky_header]
## [_Preloader]
==========================================
--------- [JS_INDEXING_END] --------------
==========================================
*/

(function ($) {
  "use strict";

  /*========== [_DynamicCurrentMenuClass] ============*/
  function dynamicCurrentMenuClass(selector) {
    let FileName = window.location.href.split("/").reverse()[0];
    selector.find("li").each(function () {
      let anchor = $(this).find("a");
      if ($(anchor).attr("href") == FileName) {
        $(this).addClass("current");
      }
    });
    selector.children("li").each(function () {
      if ($(this).find(".current").length) {
        $(this).addClass("current");
      }
    });
    if ("" == FileName) {
      selector.find("li").eq(0).addClass("current");
    }
  }

  /*========== [_Main_nav_menu] ============*/
  if ($(".main-nav-menu").length) {
    // dynamic current class
    let mainNavUL = $(".main-nav-menu");
    dynamicCurrentMenuClass(mainNavUL);
  }
  if ($(".main-nav-menu").length && $(".mobile-nav-container").length) {
    $(".main-nav-menu").clone().removeClass("main-nav-menu").addClass("mobile-menu-list").appendTo(".mobile-nav-container");
  }
  /*========== [_Sticky_header] ============*/
  if ($(".sticky-header").length) {
    $(".sticky-header").clone().insertAfter(".sticky-header").addClass("sticky-header--cloned");
  }

  function adjustHeaderForAdminBar() {
    var adminBar = document.getElementById("wpadminbar");
    var header = document.querySelector(".custom_elementor_header");

    if (adminBar && header) {
      header.style.top = adminBar.offsetHeight + "px";
    } else if (header) {
      header.style.top = "";
    }
  }
  // Run on load + resize
  $(window).on("load resize", adjustHeaderForAdminBar);

  var mainHeader = $("#headers");
  var stickyHeader = $(".sticky_header");

  function checkScroll() {
    var headerHeight = mainHeader.outerHeight();
    if ($(window).scrollTop() > headerHeight) {
      stickyHeader.addClass("visible");
    } else {
      stickyHeader.removeClass("visible");
    }
  }

  // Run on scroll
  $(window).on("scroll", checkScroll);

  // Run on page load (in case page loads scrolled down)
  checkScroll();

  /*=============================================*/
  /*----------- [_Side_Panel_Start] -------------*/
  /*=============================================*/
  $(".close-icon,.offcanvas-overlay").on("click", function () {
    $(".side-panel-content").removeClass("side-panel-open");
    $(".offcanvas-overlay").removeClass("overlay-open");
  });
  $(".side-panel-trigger").on("click", function () {
    $(".side-panel-content").addClass("side-panel-open");
    $(".offcanvas-overlay").addClass("overlay-open");
  });

  $(window).scroll(function () {
    if ($("body").scrollTop() > 0 || $("html").scrollTop() > 0) {
      $(".side-panel-content").removeClass("side-panel-open");
      $(".offcanvas-overlay").removeClass("overlay-open");
    }
  });

  /*========== [_Image Hove Animation] ============*/
  if ($(".wx_hover_item").length) {
    let hoverAnimation__do = function (t, n) {
      let a = new hoverEffect({
        parent: t.get(0),
        intensity: t.data("intensity") || void 0,
        speedIn: t.data("speedin") || void 0,
        speedOut: t.data("speedout") || void 0,
        easing: t.data("easing") || void 0,
        image1: n.eq(0).attr("src"),
        image2: n.eq(0).attr("src"),
        displacementImage: t.data("displacement"),
        imagesRatio: n[0].height / n[0].width,
        hover: !1,
      });
      t.closest(".wx_hover_item")
        .on("mouseenter", function () {
          a.next();
        })
        .on("mouseleave", function () {
          a.previous();
        });
    };

    let hoverAnimation = function () {
      $(".tp--hover-img").each(function () {
        let n = $(this);
        let e = n.find("img");
        let i = e.eq(0);

        // ✅ Prevent undefined error
        if (!i.length) return; // Skip if no image found

        if (i[0].complete) {
          hoverAnimation__do(n, e);
        } else {
          i.on("load", function () {
            hoverAnimation__do(n, e);
          });
        }
      });
    };

    hoverAnimation();
  }

  // hover reveal start
  const hoveritem = document.querySelectorAll(".nexsol-hover-reveal-item");
  function moveImage(e, hoveritem, index) {
    const item = hoveritem.getBoundingClientRect();
    const x = e.clientX - item.x;
    const y = e.clientY - item.y;
    if (hoveritem.children[index]) {
      hoveritem.children[index].style.transform = `translate(${x}px, ${y}px)`;
    }
  }
  hoveritem.forEach((item, i) => {
    item.addEventListener("mousemove", (e) => {
      setInterval(moveImage(e, item, 1), 50);
    });
  });
  // hover reveal end

  // hover reveal with right side gap start
  const hoveritems2 = document.querySelectorAll(".nexsol-hover-reveal-item2");
  function moveImage2(e, hoveritems2, index) {
    const item = hoveritems2.getBoundingClientRect();
    let x = e.clientX - item.x;
    let y = e.clientY - item.y;

    // Prevent image from reaching the right edge (100px gap)
    const maxX = item.width - 300;
    if (x > maxX) x = maxX;

    const maxY = item.height - 180;
    if (y > maxY) y = maxY;

    if (hoveritems2.children[index]) {
      hoveritems2.children[index].style.transform = `translate(${x}px, ${y}px)`;
    }
  }
  hoveritems2.forEach((item) => {
    item.addEventListener("mousemove", (e) => {
      requestAnimationFrame(() => moveImage2(e, item, 1));
    });
  });
  // hover reveal end

  /*========== [_Mobile_menu_list] ============*/
  if ($(".mobile-nav-container .mobile-menu-list").length) {
    let dropdownAnchor = $(".mobile-nav-container .mobile-menu-list .menu-item-has-children > a");
    dropdownAnchor.each(function () {
      let self = $(this);
      let toggleBtn = document.createElement("BUTTON");
      toggleBtn.setAttribute("aria-label", "dropdown toggler");
      toggleBtn.innerHTML = "<i class='webexbase-icon-chevron-right'></i>";
      self.append(function () {
        return toggleBtn;
      });
      self.find("button").on("click", function (e) {
        e.preventDefault();
        let self = $(this);
        self.toggleClass("expanded");
        self.parent().toggleClass("expanded");
        self.parent().parent().children("ul").slideToggle();
      });
    });
  }

  /*========== [_Mobile_nav_toggler] ============*/
  if ($(".mobile-nav-toggler, .mobile-nav-toggler-ele").length) {
    $(".mobile-nav-toggler, .mobile-nav-toggler-ele").on("click", function (e) {
      e.preventDefault();
      $(".mobile-nav-wrapper").toggleClass("expanded");
      $("body").toggleClass("locked");
    });
  }

  /*========== [_Search_toggler] ============*/
  if ($(".search-toggler").length) {
    $(".search-toggler").on("click", function (e) {
      e.preventDefault();
      $(".search-popup").toggleClass("active");
      $(".mobile-nav-wrapper").removeClass("expanded");
      $("body").toggleClass("locked");
    });
  }

  function activeclass() {
    jQuery("#project-block-style_2").each(function () {
      if (jQuery(this).find(".project-list:first").length > 0) {
        jQuery(this).find(".project-list:first").addClass("active");
      }
    });

    jQuery(".project-list").hover(function () {
      if (jQuery(this).parents("#project-block-style_2").length > 0) {
        jQuery(this).parents("#project-block-style_2").find(".project-list").removeClass("active");
        jQuery(this).addClass("active");
      }
    });
  }

  // MOUSE HOVER OBJECT PARALLAX
  $(".mouse-hover-parallax").each(function () {
    var s = $(this);

    function i(e) {
      var i = s.offset(),
        a = e.pageX - i.left,
        t = e.pageY - i.top,
        l = (a - s.width() / 2) * 0.2,
        r = (t - s.height() / 2) * 0.2;
      s.css({
        transform: "translate(" + l + "px, " + r + "px)",
        transition: "transform 0.1s ease-out",
      });
    }
    function a() {
      s.css({
        transform: "none",
        transition: "transform 0.3s ease-out",
      });
    }
    if (s.closest(".mouse-hover-parent-parallax").length) {
      var t = s.closest(".mouse-hover-parent-parallax");
      t.mousemove(function (e) {
        i(e);
      }),
        t.mouseleave(a);
    } else s.mousemove(i), s.mouseleave(a);
  });

  /*========== [_Cursor_animation] ============*/
  const cursor = document.querySelector(".cursor");
  const editCursor = (e) => {
    const { clientX: x, clientY: y } = e;
    cursor.style.left = x + "px";
    cursor.style.top = y + "px";
  };

  // Cursor follow
  window.addEventListener("mousemove", editCursor);
  // Hover animation on links and service blocks
  $(document).on("mouseenter.cursorAnim", "a, .services-block-style_2", function () {
    $(".cursor").addClass("cursor-anim");
  });
  $(document).on("mouseleave.cursorAnim", "a, .services-block-style_2", function () {
    $(".cursor").removeClass("cursor-anim");
  });

  // === Pricing Switcher ===
  $(document).on("change", "#checboxv", function () {
    var checkBox = this;
    var monthlyPrice = document.getElementsByClassName("monthlyPrice");
    var yearlyPrice = document.getElementsByClassName("yearlyPrice");

    for (var i = 0; i < monthlyPrice.length; i++) {
      if (checkBox.checked) {
        monthlyPrice[i].style.display = "block";
        yearlyPrice[i].style.display = "none";
      } else {
        monthlyPrice[i].style.display = "none";
        yearlyPrice[i].style.display = "block";
      }
    }
  });

  /*========== [_Wow_animation] ============*/
  if ($(".wow").length) {
    var wow = new WOW({
      boxClass: "wow", // animated element css class (default is wow)
      animateClass: "animated", // animation css class (default is animated)
      mobile: true, // trigger animations on mobile devices (default is true)
      live: true, // act on asynchronously loaded content (default is true)
    });
    wow.init();
  }

  /*========== [_Data_attribute] ============*/
  var sectionBgImg = $(".bg-img, .feature-box-area-style1, .footer, section, div");
  sectionBgImg.each(function (indx) {
    if ($(this).attr("data-background")) {
      $(this).css("background-image", "url(" + $(this).data("background") + ")");
    }
  });

  /*========== [_Language_btn] ============*/
  $(".language-btn").on("click", function (event) {
    event.preventDefault();
    $(this).next(".language-dropdown").toggleClass("open");
  });

  /*========= [_Nice_select] =========*/
  $("select").niceSelect();

  /*========= [_js_tilt] =========*/
  function onHoverthreeDmovement() {
    var tiltBlock = $(".js-tilt");
    if (tiltBlock.length) {
      $(".js-tilt").tilt({
        maxTilt: 15,
        perspective: 1200,
        glare: true,
        maxGlare: 0,
      });
    }
  }
  onHoverthreeDmovement();

  // Fancybox Config
  $('[data-fancybox="gallery"]').fancybox({
    buttons: ["slideShow", "thumbs", "zoom", "fullScreen", "share", "close"],
    loop: false,
    protect: true,
  });

  /*========= [_video_popup] =========*/
  if ($(".video-popup").length) {
    $(".video-popup").magnificPopup({
      type: "iframe",
      mainClass: "mfp-fade",
      removalDelay: 160,
      preloader: false,
      fixedContentPos: false,
    });
  }

  /*========= [_Sticky_Content] =========*/
  var $theiaStickyElements = $(".contents-sticky, .sticky-sidebar");
  if ($theiaStickyElements.length) {
    var additionalMarginTop = 180;
    $theiaStickyElements.theiaStickySidebar({
      additionalMarginTop: additionalMarginTop,
      additionalMarginBottom: 20,
    });
  }

  /*========= [_Sticky_header] =========*/
  $(window).on("scroll", function () {
    if ($(".sticky-header--cloned").length) {
      var headerScrollPos = 130;
      var stricky = $(".sticky-header--cloned");
      if ($(window).scrollTop() > headerScrollPos) {
        stricky.addClass("sticky-fixed");
      } else if ($(this).scrollTop() <= headerScrollPos) {
        stricky.removeClass("sticky-fixed");
      }
    }
    if ($(".scroll-to-top").length) {
      var strickyScrollPos = 100;
      if ($(window).scrollTop() > strickyScrollPos) {
        $(".scroll-to-top").fadeIn(500);
      } else if ($(this).scrollTop() <= strickyScrollPos) {
        $(".scroll-to-top").fadeOut(500);
      }
    }
  });

  jQuery(document).ready(function () {
    activeclass();
  });

  /*========= [_Preloader] =========*/
  $(window).on("load", function () {
    $("#ctn-preloader").addClass("loaded");
    if ($("#ctn-preloader").hasClass("loaded")) {
      // Es para que una vez que se haya ido el preloader se elimine toda la seccion preloader
      $("#ctn-preloader")
        .delay(200)
        .fadeOut(500)
        .queue(function () {
          $(this).remove();
        });
    }

    if ($(".circle_text").length) {
      $(".circle_text").circleType({
        position: "absolute",
        dir: 1,
        radius: 80,
        forceHeight: true,
        forceWidth: true,
      });
    }
  });

  /*========= [_Modal_Image_Gallery_Switch] =========*/
  $(document).on("click", ".product-modal-gallery img", function () {
    const modal = $(this).closest(".modal");
    const mainImg = modal.find(".tp-product-details-nav-main-thumb img");
    mainImg.attr("src", $(this).attr("src"));
  });

  $("body").on("click", ".quantity .plus", function (e) {
    e.preventDefault();
    var $qty = $(this).siblings(".qty");
    var currentVal = parseInt($qty.val(), 10);
    if (isNaN(currentVal)) {
      $qty.val(1);
    } else {
      $qty.val(currentVal + 1);
    }

    $(".shop_table.cart").find('button[name="update_cart"]').removeAttr("disabled");
  });

  $("body").on("click", ".quantity .minus", function (e) {
    e.preventDefault();
    var $qty = $(this).siblings(".qty");
    var currentVal = parseInt($qty.val(), 10);
    if (!isNaN(currentVal) && currentVal > 1) {
      $qty.val(currentVal - 1);
    }

    $(".shop_table.cart").find('button[name="update_cart"]').removeAttr("disabled");
  });

  /*========= [_YITH Wishlist AJAX Update Text] =========*/
  jQuery(document).on("added_to_wishlist", function () {
    const wishlistURL = yith_wcwl_l10n.wishlist_url;
    const $btn = jQuery(".yith-wcwl-add-button a, .yith-wcwl-add-to-wishlist a");

    $btn.each(function () {
      const $this = jQuery(this);
      if (!$this.hasClass("wishlist-updated")) {
        $this.addClass("wishlist-updated");
        $this.html('<i class="fa fa-heart"></i> Browse wishlist');
        $this.attr("href", wishlistURL);
      }
    });
  });
})(jQuery);
