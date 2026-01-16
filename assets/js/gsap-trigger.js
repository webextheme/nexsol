(function ($) {
  "use strict";
  // Get Device width
  let device_width = window.innerWidth;

  /*-------------------------------------
    Split Text Reveal Animation
  -------------------------------------*/
  if ($(".webex_text_reveal").length) {
    gsap.registerPlugin(SplitText, ScrollTrigger);

    var reveal_1 = new SplitText(".webex_text_reveal", { type: "lines" });
    reveal_1.lines.forEach(function (target) {
      gsap.to(target, {
        backgroundPositionX: 0,
        ease: "none",
        scrollTrigger: {
          trigger: target,
          scrub: 1,
          start: "top 85%",
          end: "bottom center",
        },
      });
    });
  }

  /*-------------------------------------
    Text Effect Animation
  -------------------------------------*/
  if ($(".text-effect").length) {
    gsap.registerPlugin(SplitText, ScrollTrigger);

    $(".text-effect").each(function (index, el) {
      var splitText = new SplitText(el, {
        type: "lines,words,chars",
        linesClass: "split-line",
      });

      gsap.set(splitText.chars, {
        opacity: 0.3,
        x: -7,
      });

      gsap.to(splitText.chars, {
        x: 0,
        y: 0,
        opacity: 1,
        duration: 0.7,
        stagger: 0.2,
        scrollTrigger: {
          trigger: el,
          start: "top 92%",
          end: "top 60%",
          scrub: 1,
          markers: false,
        },
      });
    });
  }

  /*-------------------------------------
  Pricing Style 02 - Pinned Cards (Home 02)
	-------------------------------------*/
  let project_sticky_cards_01 = document.querySelector(".project_sticky_cards_01");

  if (project_sticky_cards_01) {
    ScrollTrigger.matchMedia({
      "(min-width: 768px)": function () {
        let cards = gsap.utils.toArray(".project_sticky_cards_01 .pinned_item");
        let stickDistance = 0;

        let firstCardST = ScrollTrigger.create({
          trigger: cards[0],
          start: "top center-=230",
        });

        let lastCardST = ScrollTrigger.create({
          trigger: cards[cards.length - 1],
          start: "top center-=230",
        });

        cards.forEach((card, index) => {
          // Optional: adjust 0.05 for stagger scaling effect

          let scaleDown = gsap.to(card, {
            transformOrigin: "50% center",
            ease: "none",
          });

          ScrollTrigger.create({
            trigger: card,
            start: "top center-=230",
            end: () => lastCardST.start + stickDistance,
            pin: true,
            pinSpacing: false,
            animation: scaleDown,
            toggleActions: "restart none none reverse",
            id: "pricing-card-" + index, // assign ID to control only these triggers
          });
        });
      },

      "(max-width:767px)": function () {
        // Kill only pricing card triggers, not all
        ScrollTrigger.getAll()
          .filter((st) => st.vars.id && st.vars.id.startsWith("pricing-card-"))
          .forEach((st) => st.kill(true));
      },
    });
  }

  /*-------------------------------------
  Pricing Style 02 - Pinned Cards (Home 02)
	-------------------------------------*/
  let itemMoveTop = document.querySelector(".pin_style_01_cards");

  if (itemMoveTop) {
    ScrollTrigger.matchMedia({
      "(min-width: 768px)": function () {
        let cards = gsap.utils.toArray(".pin_style_01_cards .pinned_item");
        let stickDistance = 0;

        let firstCardST = ScrollTrigger.create({
          trigger: cards[0],
          start: "top center-=230",
        });

        let lastCardST = ScrollTrigger.create({
          trigger: cards[cards.length - 1],
          start: "top center-=230",
        });

        cards.forEach((card, index) => {
          // Optional: adjust 0.05 for stagger scaling effect

          let scaleDown = gsap.to(card, {
            transformOrigin: "50% center",
            ease: "none",
          });

          ScrollTrigger.create({
            trigger: card,
            start: "top center-=230",
            end: () => lastCardST.start + stickDistance,
            pin: true,
            pinSpacing: false,
            animation: scaleDown,
            toggleActions: "restart none none reverse",
            id: "pricing-card-" + index, // assign ID to control only these triggers
          });
        });
      },

      "(max-width:767px)": function () {
        // Kill only pricing card triggers, not all
        ScrollTrigger.getAll()
          .filter((st) => st.vars.id && st.vars.id.startsWith("pricing-card-"))
          .forEach((st) => st.kill(true));
      },
    });
  }

  // Circle button hover animation
  var hoverBtns = gsap.utils.toArray(".nexsol_circle_btn_block");
  const hoverBtnItem = gsap.utils.toArray(".circle_btn_item");
  hoverBtns.forEach((btn, i) => {
    $(btn).mousemove(function (e) {
      callParallax(e);
    });

    function callParallax(e) {
      parallaxIt(e, hoverBtnItem[i], 80);
    }

    function parallaxIt(e, target, movement) {
      var $this = $(btn);
      var relX = e.pageX - $this.offset().left;
      var relY = e.pageY - $this.offset().top;

      gsap.to(target, 0.5, {
        x: ((relX - $this.width() / 2) / $this.width()) * movement,
        y: ((relY - $this.height() / 2) / $this.height()) * movement,
        ease: Power2.easeOut,
      });
    }
    $(btn).mouseleave(function (e) {
      gsap.to(hoverBtnItem[i], 0.5, {
        x: 0,
        y: 0,
        ease: Power2.easeOut,
      });
    });
  });

  // button hover animation
  $(".circle_hover_btn").on("mouseenter", function (e) {
    var x = e.pageX - $(this).offset().left;
    var y = e.pageY - $(this).offset().top;
    $(this).find(".circle_btn_dot").css({
      top: y,
      left: x,
    });
  });

  $(".circle_hover_btn").on("mouseout", function (e) {
    var x = e.pageX - $(this).offset().left;
    var y = e.pageY - $(this).offset().top;

    $(this).find(".circle_btn_dot").css({
      top: y,
      left: x,
    });
  });

  //Image Scalling Effect
  if ($(".scale-img").length > 0) {
    var scale = document.querySelectorAll(".scale-img");
    var image = document.querySelectorAll(".scale-img img");
    scale.forEach((item) => {
      gsap.to(item, {
        scale: 1,
        duration: 1,
        ease: "power1.out",
        scrollTrigger: {
          trigger: item,
          start: "top bottom",
          end: "bottom top",
          toggleActions: "play reverse play reverse",
        },
      });
    });
    image.forEach((image) => {
      gsap.set(image, {
        scale: 1.5,
      });
      gsap.to(image, {
        scale: 1,
        duration: 1,
        scrollTrigger: {
          trigger: image,
          start: "top bottom",
          end: "bottom top",
          toggleActions: "play reverse play reverse",
        },
      });
    });
  }

  //Bounce Animation Effect
  const wt_bounce_anim = gsap.utils.toArray(".bounce_anim_wrap .bounce_anim_item");
  if (wt_bounce_anim.length > 0) {
    // Initial state
    gsap.set(wt_bounce_anim, { y: -100, opacity: 0 });

    if (device_width < 1023) {
      // Mobile / Tablet
      wt_bounce_anim.forEach((item) => {
        let counterTl = gsap.timeline({
          scrollTrigger: {
            trigger: item,
            start: "top center+=200",
          },
        });

        counterTl.to(item, {
          y: 0,
          opacity: 1,
          ease: "bounce",
          duration: 1.2,
        });
      });
    } else {
      // Desktop
      gsap.to(wt_bounce_anim, {
        scrollTrigger: {
          trigger: ".bounce_anim_wrap",
          start: "top center+=300",
        },
        y: 0,
        opacity: 1,
        ease: "bounce",
        duration: 1.2,
        stagger: {
          each: 0.4,
        },
      });
    }
  }

  //Award rubber Animation Effect
  const aw = gsap.matchMedia();
  aw.add("(min-width: 991px)", () => {
    const awardItems = document.querySelectorAll(".modern-award-block-style1");
    awardItems.forEach(function (div) {
      div.addEventListener("mouseenter", function () {
        gsap.to(div, {
          width: "100%",
          duration: 2,
          ease: "expo.out",
        });
      });
      div.addEventListener("mouseleave", function () {
        gsap.to(div, {
          width: "85%",
          duration: 2,
          ease: "expo.out",
        });
      });
    });
  });

  gsap.registerPlugin(ScrollTrigger);

  jQuery(function ($) {
    // Every step block animation
    $(".working-steps-block.gsap-line-anim").each(function (index, block) {
      let vline = $(block).find(".v-line")[0];

      gsap.fromTo(
        vline,
        { height: "0%" },
        {
          height: "100%",
          ease: "none",
          scrollTrigger: {
            trigger: block,
            start: "top 50%",
            end: "bottom 50%",
            scrub: 1,
          },
        }
      );
    });
  });
})(jQuery);
