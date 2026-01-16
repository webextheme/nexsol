(function ($) {
  "use strict";
  // Word Animation
  document.addEventListener("DOMContentLoaded", function () {
    setTimeout(() => {
      TitleAnimationActive();
      gsap.delayedCall(0.5, () => ScrollTrigger.refresh());
    }, 300);
  });

  function TitleAnimationActive() {
    let animationItems = document.querySelectorAll(".section_title_anim");

    animationItems.forEach((item) => {

      // Reset if needed
      if (item.animation) {
        item.animation.progress(1).kill();
        if (item.split) {
          item.split.revert();
        }
      }

      let onScroll = item.getAttribute("data-on-scroll") || 1;

      item.split = new SplitText(item, {
        type: "lines,words,chars",
        linesClass: "split-line"
      });

      gsap.set(item, { perspective: 400 });

      /* =========================
        STYLE HANDLING BY CLASS
      ========================== */

      // STYLE 1 (default + explicit class)
      if (item.classList.contains("animation-style1")) {
        gsap.set(item.split.chars, {
          opacity: 0,
          x: 50
        });
      }

      // STYLE 2 (PBMIT Y + rotateX)
      if (item.classList.contains("animation-style2")) {
        gsap.set(item.split.chars, {
          opacity: 0,
          y: "90%",
          rotateX: "-40deg"
        });
      }

      // STYLE 3 (PBMIT opacity only)
      if (item.classList.contains("animation-style3")) {
        gsap.set(item.split.chars, {
          opacity: 0
        });
      }

      let animationProps = {
        x: 0,
        y: 0,
        rotateX: 0,
        opacity: 1,
        duration: 1,
        ease: Back.easeOut,
        stagger: 0.02
      };

      if (onScroll == 1) {
        animationProps.scrollTrigger = {
          trigger: item,
          start: "top 90%",
          once: true,
          invalidateOnRefresh: true
        };
      }

      item.animation = gsap.to(item.split.chars, animationProps);
    });
  }

  // Mouse Hover Parallax
  function mouseHoverParallax() {
    $(".mouse-hover-parallax").each(function () {
      var s = $(this);

      function move(e) {
        var i = s.offset(),
          a = e.pageX - i.left,
          t = e.pageY - i.top,
          l = (a - s.width() / 2) * .2,
          r = (t - s.height() / 2) * .2;

        s.css({
          transform: "translate(" + l + "px, " + r + "px)",
          transition: "transform 0.1s ease-out"
        });
      }

      function reset() {
        s.css({
          transform: "none",
          transition: "transform 0.3s ease-out"
        });
      }

      if (s.closest(".mouse-hover-parent-parallax").length) {
        var t = s.closest(".mouse-hover-parent-parallax");
        t.mousemove(move).mouseleave(reset);
      } else {
        s.mousemove(move).mouseleave(reset);
      }
    });
  }


  // SINGLE DOCUMENT READY
  // -----------------------------------------
  $(document).ready(function () {
    mouseHoverParallax();
  });

})(jQuery);
