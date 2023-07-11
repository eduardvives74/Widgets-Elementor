jQuery(function ($) {

  function esVisible(elem) {
    /* Ventana de Visualización*/
    var posTopView = $(window).scrollTop();
    var posButView = posTopView + $(window).height();
    /* Elemento a validar*/
    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).outerHeight();
    /* Comparamos los dos valores tanto del elemento como de la ventana*/
    return (
      (elemBottom < posButView && elemBottom > posTopView) ||
      (posButView > elemTop && posButView < elemBottom) ||
      (elemTop > posTopView && elemTop < posButView)
    );
  }

  $(window).scroll(function () {
    if ($(".ev-timeline").length > 0) {
      let ele = $(".ev-timeline");
      if (esVisible(ele)) {
        let h = $(window).scrollTop() - $(ele).offset().top + 300;
        $(".ev-timeline .pointer").each(function () {
          if ($(this).offset().top <= $(window).scrollTop() + 310) {
            $(this).addClass("active");
          } else {
            $(this).removeClass("active");
          }
        });
        $(".line-time-scroll").height(h);
      }
    }
  });
}); // jQuery End
