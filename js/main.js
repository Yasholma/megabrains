    $(function() {
        $('.chart').easyPieChart({
            size: 180,
            barColor: '#BCA858',
            scaleColor: false,
            lineWidth: 15,
            trackColor: '#222222',
            lineCap: 'circle',
            animate: 5000
        });
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(window).on('scroll', () => {
       if ($(window).scrollTop() > 0)  {
           $('.top-header-area').slideUp();
       } else {
           $('.top-header-area').slideDown();
       }
    });

