(function () {
  var isLocking = false;
  var lastX = 0;
  var lastY = 0;

  var origScrollTo = window.scrollTo;

  window.scrollTo = function (x, y) {
    if (isLocking) {
      // FAQ click ke dauran ScrollTrigger ka scroll ignore karo
      return;
    }
    return origScrollTo.call(window, x, y);
  };

  document.addEventListener(
    'click',
    function (e) {
      var btn = e.target.closest('.accordion-button, .ti-acc-header');
      if (!btn) return;

      isLocking = true;
      lastX = window.scrollX || window.pageXOffset;
      lastY = window.scrollY || window.pageYOffset;

      setTimeout(function () {
        isLocking = false;
        origScrollTo.call(window, lastX, lastY);
      }, 100); // ScrollTrigger ka refresh complete hone ka short wait
    },
    true
  );
})();
