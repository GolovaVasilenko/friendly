$(document).ready(function() {

    $("#lightgallery").lightGallery({
        thumbnail: false,
        download: false
    });

    $('.mediaGallery').lightGallery({
        thumbnail: false,
        download: false
    });

    $('.videoPlayer').lightGallery({
        loadYoutubeThumbnail: true,
        youtubeThumbSize: 'default'
    });

    $('#youtubePlayer').lightGallery({
        loadYoutubeThumbnail: true,
        youtubeThumbSize: 'default'
    });


    $('#lightgallery .image-box').hover(
        function() {
            $(this).find('.img-info').addClass('active');
        },
        function() {
            $(this).find('.img-info').removeClass('active');
        }
    );

    $(document).mouseup(function (e) {
        let element = $('li.parent');
        if (!element.is(e.target) && element.has(e.target).length === 0) {
            element.find('ul').removeClass('active');
        }
    });

    $('li.parent').hover(
        function(e) {
            $(this).find('ul').addClass('active');
        },
        function(e) {
            //$(this).find('ul').removeClass('active');
        }
    );

    $('#form-filter').on('submit', function(e) {
        e.preventDefault();
        let locale = window.locale === 'ge' ? '' : '/' + window.locale;
        let protocol = window.location.protocol + '//';
        let host = window.location.host + locale + '/gallery';
        let params = '';
        let cat = $(this).find('select[name=cat]').val();
        let subcat = $(this).find('select[name=subcat]').val();
        let attr = $(this).find('select[name=attr]').val();
        let value = $(this).find('select[name=value]').val();
        if(cat !== '0') {
            params += '/' + cat;
        }
        if(subcat !== '0') {
            cat = subcat;
            params = '/' + cat;
        }
        if(attr !== '0' && value !== '0') {
            params += '/' + attr;
            params += '/' + value;
        }
        window.location.href = protocol + host + params;
    });

    $('.mobile-menu-trigger').on('click', function() {
        $('.close-mobile-menu').show();
        $('.top-header .main-nav-block > ul:nth-of-type(2)').fadeIn('slow');
    });
    $('.close-mobile-menu').on('click', function() {
        $('.top-header .main-nav-block > ul:nth-of-type(2)').fadeOut('slow');
        $('.close-mobile-menu').hide();
    });

    $.each($('img.display-title'), function(i, v) {
        let titleImage = $(v).attr('title');
        $(v).wrap('<picture class="img-tmp-wrapp"></picture>');
        $(v).closest('.img-tmp-wrapp').append('<span>' + titleImage + '</span>');
        $(v).closest('.img-tmp-wrapp').find('span').css({width: $(v).width()});
    });
});

mybutton = document.getElementById("toTopBtn");
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
    if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
}

