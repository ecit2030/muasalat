$(document).ready(function () {

    //Active Class
    $(".app-sidebar-wrapper a").each(function () {
        var pageUrl = window.location.href.split(/[?#]/)[0];
        if (this.href == pageUrl) {
            $(this).addClass("active");// add active to the current link
            // $(this).parent().addClass("active"); // add active to li of the current link
            // $(this).parent().addClass("resp-tab-content-active"); // add active to li of the current link
            $(this).parent().parent().prev().click(); // click the item to make it drop
        }
    });


    if ($(".tinymce textarea").length > 0) {
        var options = {
            selector: ".tinymce textarea",
            height: 500,
            skin: 'hussein',
            content_style:
                `body { font-size: 14pt; font-family: Arial; direction:${$(this).attr('dir')}; }`,
            plugins: [
                "emoticons template paste textcolor advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality "
            ],
            toolbar: "ltr rtl insertfile undo redo | fontsizeselect | styleselect | bold italic | forecolor backcolor emoticons | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage ",
            style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Span', inline: 'span', classes: 'example1'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
            ]

        };

        if (KTThemeMode.getMode() === "dark") {
            options["skin"] = "oxide-dark";
            options["content_css"] = "dark";
        }

        tinymce.init(options);
    }

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toastr-bottom-left",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };


});

//toastr success message
function toastr_success(message) {
    toastr.success(message, trans('success'));
}

function toastr_info(message) {
    toastr.info(message, trans('info'));
}

//toastr error message
function toastr_error(message) {
    toastr.error(message, trans('error'));
}
