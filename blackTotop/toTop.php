

<div class='back-to-top' id='back-to-top' title='Back to top'><i class='fa fa-chevron-up'></i></div>

<style>
    /* Back to top */

.back-to-top {
  visibility: hidden;
  background-color: #2c3e50;
  color: #fff;
  width: 42px;
  height: 42px;
  text-align: center;
  line-height: 38px;
  position: fixed;
  bottom: 120px;
  right: 20px;
  z-index: 90;
  cursor: pointer;
  opacity: 0;
  border-radius: 3px;
  -webkit-transform: translateZ(0);
  transition: all .4s
}

.back-to-top .fa {
  font-size: 22px;
  vertical-align: middle
}

.back-to-top:hover {
  background-color: #FD0002;
  color: #fff;
  opacity: 1;
}

.back-to-top.show {
  visibility: visible;
  opacity: 1;
}
</style>

<script>
    
    $(function() {
  if ($('#sidecontent3').length) {
    var el = $('#sidecontent3');
    var stickyTop = $('#sidecontent3').offset().top;
    var stickyHeight = $('#sidecontent3').height();
    $(window).scroll(function() {
      var limit = $('#footer-wrapper').offset().top - stickyHeight - 20;
      var windowTop = $(window).scrollTop();
      if (stickyTop < windowTop) {
        el.css({
          position: 'fixed',
          top: 20
        });
      } else {
        el.css('position', 'static');
      }
      if (limit < windowTop) {
        var diff = limit - windowTop;
        el.css({
          top: diff
        });
      }
    });
  }
});

// Back to top button
(function() {
  $(document).ready(function() {
    return $(window).scroll(function() {
      return $(window).scrollTop() > 600 ? $("#back-to-top").addClass("show") : $("#back-to-top").removeClass("show")
    }), $("#back-to-top").click(function() {
      return $("html,body").animate({
        scrollTop: "0"
      })
    })
  })
}).call(this);

</script>