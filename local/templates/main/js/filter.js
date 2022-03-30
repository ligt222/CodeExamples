//test
function setActiveFilterBox(name) {
    console.log('name - ' + name);
    $('h4:contains("' + name + '")').closest('.b-filter__box').show();
}
function setActiveFilter(id, section) {
    console.log('id - ' + id);
    $('#'+id).closest('.b-checkbox').show();
}
function getTemplate(name, image, link) {
    return '<div class="b-door-card">'+
        '<a class="b-door-card__link" href="' + link + '" title="' + name + '">'+
            '<span class="b-images b-images--door-card js-image-wrapper">'+
                '<img class="b-images__image b-images__image--door-card js-image-wrapper"'+
                     'src="' + image + '" loading="lazy" alt=""'+
                     'role="presentation"/>'+
            '</span>'+
            '<div class="b-door-card__info-wrap">'+
                '<h3 class="b-door-card__title">'+
                    name +
                '</h3>'+
            '</div>'+
            '<span class="b-door-card__watter-mark">'+
                <!-- Generator: Adobe Illustrator 24.3.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                '<svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg"'+
                     'xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"'+
                     'y="0px"'+
                    ' width="56.4px" height="500px" viewBox="0 0 56.4 500" enable-background="new 0 0 56.4 500"'+
                     'xml:space="preserve">'+
                    '<path fill="#F4F4F4" d="M56.4,127.5v6.5h-7.9v40.3h7.9v6.8H42.6v-3.7c-3.7-1.1-7.5-1.9-11.4-2.3c-3.8-0.5-7.7-0.8-11.5-0.9H5.4'+
                    'v-43.6h37.3v-3L56.4,127.5z M42.6,137.1H11.2v30.7h8.5c7.7-0.1,15.4,0.9,22.9,2.7V137.1z M13.1,68.8c9.2-1.3,18.5-1.3,27.6,0'+
                    'c4,1.2,6.6,4.9,7.7,11.1c0.6,4.9,0.8,9.8,0.7,14.7c0.1,5-0.1,9.9-0.7,14.8c-1.1,6.2-3.7,10-7.7,11.1c-4.5,0.8-9.2,1.2-13.8,1'+
                    'c-4.6,0.2-9.3-0.1-13.8-1c-4.1-1.2-6.6-4.9-7.7-11.1c-0.6-4.9-0.8-9.9-0.7-14.8C4.6,89.7,4.8,84.8,5.4,80C6.5,73.8,9.1,70,13.1,68.8'+
                    'z M27,74.3c-8,0-12.6,0.9-14,2.6c-1.6,1.9-2.4,7.8-2.4,17.8c-0.1,4.3,0,8.6,0.4,12.9c0.1,1.3,0.5,2.5,1.2,3.5c0.7,1,1.6,1.9,2.8,2.5'+
                    'c3.9,1.2,8,1.7,12.1,1.4c4,0.3,8.1-0.2,11.9-1.5c1.1-0.6,2.1-1.4,2.7-2.5c0.7-1.1,1.1-2.3,1.2-3.5c0.4-4.2,0.5-8.5,0.4-12.8'+
                    'c0-7.1,0-11.4-0.3-12.8c-0.1-1.3-0.5-2.5-1.2-3.5c-0.7-1.1-1.6-1.9-2.8-2.5C35.1,74.6,31.1,74.1,27,74.3z M5.3,25.3'+
                    'C5.3,17.1,9.9,13,19.2,13c3.5-0.2,7.1,0.9,9.9,3c1.3,1.2,2.3,2.7,2.9,4.4c0.6,1.7,0.9,3.4,0.8,5.2v28.7h15.8v6.5H5.3L5.3,25.3z'+
                    'M26.9,25.6c0-4.1-2.6-6.1-7.8-6.1c-5.2,0-7.9,2-7.9,6.2v28.7h15.7V25.6z M33.5-42.7c4.1-0.4,8.2,0.7,11.6,3.1'+
                    'c2.3,2.3,3.6,5.3,3.7,8.6C49-29.5,49-25.3,49-18.3c0.2,5.1-0.2,10.2-1.2,15.3c-0.4,1.6-1.1,3.2-2.2,4.4c-1.1,1.3-2.4,2.3-3.9,3'+
                    'C37,6,32,6.6,27,6.4C21.9,6.6,16.8,6,12,4.4c-1.5-0.7-2.9-1.7-3.9-3C7.1,0.1,6.3-1.4,5.9-3.1c-1-5-1.4-10.1-1.2-15.3'+
                    'c0-7,0-11.1,0.3-12.7c0.1-3.2,1.4-6.3,3.7-8.6c3.4-2.3,7.5-3.4,11.6-3.1v6.3c-4.7,0-7.6,1-8.5,3c-1.2,4.9-1.6,9.9-1.3,14.8'+
                    'c-0.1,4,0.1,8,0.6,12c0.2,1.2,0.7,2.2,1.4,3.1c0.7,0.9,1.7,1.6,2.8,2c3.8,0.9,7.7,1.2,11.6,1c3.8,0.2,7.7-0.2,11.4-1.1'+
                    'c1.1-0.4,2.1-1.1,2.8-2c0.7-0.9,1.2-2,1.4-3.2c0.5-3.9,0.7-7.9,0.6-11.8c0.3-5-0.1-10-1.2-14.8c-1-2-3.9-3-8.6-3L33.5-42.7z"/>'+
                    '<path fill="#F4F4F4" d="M49.6,389.4v67.8H6.4v-6.3h37.3v-24.1H6.4v-6.5h37.3v-24.1H6.4v-6.5L49.6,389.4z M49.6,339.9v41.6H6.4v-41.6'+
                    'h5.9V375h12.5v-33.9h5.9V375h13.1v-35.1H49.6z M49.6,279v6.5H12.1l37.6,36.9v9.8H6.4v-6.5h37.8L6.4,288.5V279H49.6z M5.9,296.3v19.5'+
                    'H0.1v-19.5H5.9z M49.6,219.4v6.5H12.4v31.4h8.1c19.5,0,29.2,2.5,29.2,7.6v6.3h-5.9v-2.6c0-3.3-6.3-4.9-19-4.9H6.4v-44.5L49.6,219.4z'+
                    '"/>'+
                '</svg>'+
            '</span>'+
        '</a>'+
    '</div>';
}

$(document).ready(function () {

    var $form = $('.b-filter__form');
    var url = location.href;
    var method = $form.attr('method');
    var clearButton = $('.b-filter__form .b-button');

    $(document).on('change','.b-checkbox__input', function (){
        ajaxSend();
    });

    $('.b-filter__form .b-button').on('click', function () {
        $form[0].reset();
        ajaxSend();
    });

    function ajaxSend() {
        var formData = $(".b-filter__form :input")
            .filter(function(index, element) {
                return $(element).val() != '';
            })
            .serialize();

        $.ajax({
            url: url,
            method: method,
            processData: false,
            contentType: false,
            data: formData,
            // dataType: 'json',
            success: function (data){
                if (data['result']) {
                    $('section.b-doors').html('');
                    $.each(data['result'], function (index, section) {
                        $('section.b-doors').append(getTemplate(section.name, section.image, section.link));
                    });
                }
                var $filterBox = $('.b-filter__form .b-filter__box');
                var $filterCheckbox = $('.b-filter__form .b-checkbox');
                $filterBox.hide();
                $filterCheckbox.hide();
                if (data['filter']) {
                    $.each(data['filter'], function (index, section) {
                        console.log('index - ' + index);
                        setActiveFilterBox(section.NAME);
                        console.log(section.NAME);
                        if (section.ITEMS) {
                            $.each(section.ITEMS, function (key, item) {
                                console.log(key + ' - ' + item.id + ' - ' + item.value);
                                setActiveFilter(item.id, section.NAME);
                            });
                        }

                    });
                }
                if (data['filter'] == null ) {
                    $filterBox.show();
                    $filterCheckbox.show();
                }
            },
            error: function () {
            }
        });
    }
    $('.js-current-el').on('click', function (){
        var formDaData = ('ajax_sku=Y');
        $.ajax({
            url: document.location.href,
            method: 'get',
            processData: false,
            contentType: false,
            data: formDaData,
            success: function (data){
                console.log(data);
            }
        })
    })
    $('.js-door-btn').on('click', function (){
        var formData = ("ajax=Y&id="+$(this).attr('data-id'))
        console.log(formData);
        $.ajax({
            url: document.location.href,
            method: 'get',
            processData: false,
            contentType: false,
            data: formData,
            success: function (data){
                console.log(data);
            }
        })
    });
    $('.b-card__delete').on('click', function (){
        var formData = ("ajax=Y&del-id="+$(this).attr('data-delet-id'))
        console.log(formData);
        $.ajax({
            url: document.location.href,
            method: 'get',
            processData: false,
            contentType: false,
            data: formData,
            success: function (data){
                console.log(data);
            }
        })
    });
    $('.js-edit').on('click', function (){
        var formData = ("change-load=Y&sku-id="+$(this).attr('data-sku-id'))
        console.log(formData);
        $.ajax({
            url: document.location.href,
            method: 'get',
            processData: false,
            contentType: false,
            data: formData,
            success: function (data){
                console.log(data);
            }
        })
    });
});
