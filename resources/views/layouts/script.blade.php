{{-- ======================================== Spinner or loading page =========================================== --}}
<script>
  (function($) {
    "use strict";
    // Spinner
    var spinner = function() {
      setTimeout(function() {
        if ($('#spinner').length > 0) {
          $('#spinner').removeClass('show');
        }
      }, 1);
    };
    spinner();
    // Initiate the wowjs
    new WOW().init();
    // Fixed Navbar
    $(window).scroll(function() {
      if ($(window).width() < 992) {
        if ($(this).scrollTop() > 45) {
          $('.fixed-top').addClass('bg-dark shadow');
        } else {
          $('.fixed-top').removeClass('bg-dark shadow');
        }
      } else {
        if ($(this).scrollTop() > 45) {
          $('.fixed-top').addClass('bg-dark shadow').css('top', -45);
        } else {
          $('.fixed-top').removeClass('bg-dark shadow').css('top', 0);
        }
      }
    });
    // Back to top button
    $(window).scroll(function() {
      if ($(this).scrollTop() > 300) {
        $('.back-to-top').fadeIn('slow');
      } else {
        $('.back-to-top').fadeOut('slow');
      }
    });
    $('.back-to-top').click(function() {
      $('html, body').animate({
        scrollTop: 0
      }, 1500, 'easeInOutExpo');
      return false;
    });
    // Causes progress
    $('.causes-progress').waypoint(function() {
      $('.progress .progress-bar').each(function() {
        $(this).css("width", $(this).attr("aria-valuenow") + '%');
      });
    }, {
      offset: '80%'
    });
    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
      autoplay: false,
      smartSpeed: 1000,
      center: true,
      dots: false,
      loop: true,
      nav: true,
      navText: [
        '<i class="bi bi-arrow-left"></i>',
        '<i class="bi bi-arrow-right"></i>'
      ],
      responsive: {
        0: {
          items: 1
        },
        768: {
          items: 2
        }
      }
    });
  })(jQuery);
</script>
{{-- =============================================== alert message ==================================================== --}}
<script>
  window.livewire.on('alert', param => {
    toastr[param['type']](param['message'], param['type']);
  });
</script>

{{-- =================================== Dark mode & Light mode ======================================= --}}
<script>
  (function() {
    let lightSwitch = document.getElementById('lightSwitch');
    if (!lightSwitch) {
      return;
    }

    /**
     * @function darkmode
     * @summary: changes the theme to 'dark mode' and save settings to local stroage.
     * Basically, replaces/toggles every CSS class that has '-light' class with '-dark'
     */
    function darkMode() {
      document.querySelectorAll('.light-mode').forEach((element) => {
        element.className = element.className.replace(/-light/g, '-dark');
      });

      document.body.classList.add('dark-mode');

      if (document.body.classList.contains('dark-mode')) {
        document.body.classList.replace('dark-mode', 'light-mode');
      } else {
        document.body.classList.add('light-mode');
      }
      // set light switch input to true
      if (!lightSwitch.checked) {
        lightSwitch.checked = true;
      }
      localStorage.setItem('lightSwitch', 'dark');
    }

    /**
     * @function lightmode
     * @summary: changes the theme to 'light mode' and save settings to local stroage.
     */
    function lightMode() {
      document.querySelectorAll('.dark-mode').forEach((element) => {
        element.className = element.className.replace(/-dark/g, '-light');
      });

      document.body.classList.add('light-mode');

      if (document.body.classList.contains('light-mode')) {
        document.body.classList.replace('light-mode', 'dark-mode');
      } else {
        document.body.classList.add('dark-mode');
      }


      if (lightSwitch.checked) {
        lightSwitch.checked = false;
      }
      localStorage.setItem('lightSwitch', 'light');
    }

    /**
     * @function onToggleMode
     * @summary: the event handler attached to the switch. calling @darkMode or @lightMode depending on the checked state.
     */
    function onToggleMode() {
      if (lightSwitch.checked) {
        darkMode();
      } else {
        lightMode();
      }
    }

    /**
     * @function getSystemDefaultTheme
     * @summary: get system default theme by media query
     */
    function getSystemDefaultTheme() {
      const darkThemeMq = window.matchMedia('(prefers-color-scheme: dark)');
      if (darkThemeMq.matches) {
        return 'dark';
      }
      return 'light';
    }
    function setup() {
      var settings = localStorage.getItem('lightSwitch');
      if (settings == null) {
        settings = getSystemDefaultTheme();
      }

      if (settings == 'dark') {
        lightSwitch.checked = true;
      }

      lightSwitch.addEventListener('change', onToggleMode);
      onToggleMode();
    }

    setup();
  })();
</script>
{{-- =================================== toast alert ======================================= --}}
<script>
  @if(Session::has('success'))
  toastr.options.positionClass = 'toast-top-right';
  toastr.success("{{Session::get('success') }}")
  @elseif(Session::has('warning'))
  toastr.options.positionClass = 'toast-top-right';
  toastr.warning("{{Session::get('warning')}}")
  @elseif(Session::has('error'))
  toastr.options.positionClass = 'toast-top-right';
  toastr.error("{{Session::get('error')}}")
  @elseif(Session::has('info'))
  toastr.options.positionClass = 'toast-top-right';
  toastr.info("{{Session::get('info')}}")
  @endif
</script>
{{-- =================================== data table ======================================= --}}
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "searching": false,
      "paging": true,
      "ordering": true,
      "info": true,
      "buttons": ["excel", "pdf"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
{{-- =================================== sweet alert ======================================= --}}
<script>
  document.addEventListener('insert', function(e) {
    Swal.fire({
      title: "ລຶບຂໍ້ມູນສຳເລັດເເລ້ວ",
      icon: "success",
      iconColor: e.detail.iconColor,
      timer: 3000,
      toast: true,
      position: 'top-right',
      showConfirmButton: false,
    });
  });
</script>


<script>
  window.addEventListener('swal:confirm', event => {
    swal({
      title: event.detail.message,
      text: event.detail.text,
      icon: event.detail.type,
      timer: 3000,
      buttons: false,
      showConfirmButton: false,
      dangerMode: true,
    })
  });
</script>
{{-- ===================== register ========================= --}}
<script>
  window.addEventListener('swal:register', event => {
    swal({
      title: event.detail.message,
      text: event.detail.text,
      icon: event.detail.type,
      timer: 3000,
      buttons: false,
      showConfirmButton: false,
      dangerMode: true,
    })
  });
</script>
{{-- ===================== login ========================= --}}
<script>
  window.addEventListener('swal:login', event => {
    swal({
      title: event.detail.message,
      text: event.detail.text,
      icon: event.detail.type,
      timer: 3000,
      buttons: false,
      showConfirmButton: false,
      dangerMode: true,
    })
  });
</script>