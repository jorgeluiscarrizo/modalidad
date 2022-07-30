
$(document).ready(function () {

    slideShop();

    galleryProduct();
});


function slideShop() {
    $('#slideShop').lightSlider({
        auto: true,
        autoWidth: true,
        loop: true,
        onSliderLoad: function () {
            //$('#slideShop').removeClass('cS-hidden');
        }
    })
}

function galleryProduct() {
    $('#imageGalleryProduct').lightSlider({
        //autoWidth: true,
        //adaptiveWidth: true,
        //adaptiveHeight: true,

        gallery: true,
        item: 1,
        auto: true,
        loop: true,
        thumbItem: 5,
        slideMargin: 0,
        addClass: 'object-cover',
        //controls: false,


        enableDrag: true,
        currentPagerPosition: 'middle',


        onSliderLoad: function (el) {
            el.lightGallery({
                selector: '#imageGalleryProduct .lslide',
                zoom: true,
                auto: true,
                controls: true,
                share: false,
            });
        }
    });
}


//function que se llamada desde controllador shop
window.addEventListener('update-slider', event => {

    //console.log(sliderShop);
    if (event.detail.flag) {

        //console.log(event.detail)

        $('#contentSlider').html('');

        var code = '<ul id="slideShop" class="w-full">';
        code += '<li class="item-a">';
        code += '<img class=" w-screen h-72 object-cover" src="https://cdn.pixabay.com/photo/2016/05/27/08/51/mobile-phone-1419275_960_720.jpg" alt="">';
        code += '</li>';
        code += '<li class="item-b">';
        code += '<img class=" w-screen h-72 object-cover" src="https://cdn.pixabay.com/photo/2016/05/27/08/51/mobile-phone-1419275_960_720.jpg" alt="">';
        code += '</li>';
        code += '<li class="item-c">';
        code += '<img class=" w-screen h-72 object-cover" src="https://cdn.pixabay.com/photo/2017/04/11/15/55/animals-2222007_960_720.jpg" alt="">';
        code += '</li>';
        code += '<li class="item-d">';
        code += '<img class=" w-screen h-72 object-cover" src="https://cdn.pixabay.com/photo/2016/09/22/10/44/banner-1686943_960_720.jpg" alt="">';
        code += '</li>';
        code += '<li class="item-e"> <img class=" w-screen h-72 object-cover" src="https://cdn.pixabay.com/photo/2016/08/03/09/03/universe-1566159_960_720.jpg" alt="">';
        code += '</li>';
        code += '</ul>';
        $('#contentSlider').html(code);

        slideShop();
    }
})
//end function que se llamada desde controllador shop

//function que se llamada desde controllador product detail
window.addEventListener('update-gallery', event => {

    //console.log(sliderShop);
    if (event.detail.flag) {

        console.log(event.detail)

        $('#contentGallery').html('');
        var code = '<ul id="imageGalleryProduct">';
        code += '<li data-thumb="../../' + event.detail.product.photo_1 + '" data-src="../../' + event.detail.product.photo_1 + '">';
        code += '<img src="../../' + event.detail.product.photo_1 + '" class="w-full object-cover" />';
        code += '</li>';
        code += '<li data-thumb="../../' + event.detail.product.photo_2 + '" data-src="../../' + event.detail.product.photo_2 + '">';
        code += '<img src="../../' + event.detail.product.photo_2 + '" class="w-full object-cover" />';
        code += '</li>';
        code += '<li data-thumb="../../' + event.detail.product.photo_3 + '" data-src="../../' + event.detail.product.photo_3 + '">';
        code += '<img src="../../' + event.detail.product.photo_3 + '" class="w-full object-cover" />';
        code += '</li>';
        code += '<li data-thumb="../../' + event.detail.product.photo_4 + '" data-src="../../' + event.detail.product.photo_4 + '">';
        code += '<img src="../../' + event.detail.product.photo_4 + '" class="w-full object-cover" />';
        code += '</li>';
        code += '<li data-thumb="../../' + event.detail.product.photo_5 + '" data-src="../../' + event.detail.product.photo_5 + '">';
        code += '<img src="../../' + event.detail.product.photo_5 + '" class="w-full object-cover" />';
        code += '</li>';
        code += '</ul>';
        $('#contentGallery').html(code);

        galleryProduct();

    }
})
//end function que se llamada desde controllador product detail




