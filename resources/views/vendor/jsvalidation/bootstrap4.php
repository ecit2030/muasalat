<script>
    jQuery(document).ready(function () {

        $("<?= $validator['selector']; ?>").each(function () {
            $(this).validate({
                errorElement: 'span',
                errorClass: 'invalid-feedback',

                errorPlacement: function (error, element) {
                    if (element.parent('.input-group').length ||
                            element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                        error.insertAfter(element.parent());
                        // else just place the validation message immediately after the input
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function (element) {
                    const lang = $(element).attr('lang');
                    languageTap(lang, 'addClass', 'border-error is-invalid');
                    $(element).closest('.form-control').removeClass('is-valid').addClass('is-invalid'); // add the Bootstrap error class to the control group
                },
                <?php if (isset($validator['ignore']) && is_string($validator['ignore'])): ?>

                ignore: "<?= $validator['ignore']; ?>",
                <?php endif; ?>

                unhighlight: function (element) {

                    const lang = $(element).attr('lang');
                    languageTap(lang, 'removeClass', 'border-error is-invalid');
                    $(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid');
                },



                success: function (element) {
                    $(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid'); // remove the Boostrap error class from the control group
                },

                focusInvalid: true,
                <?php if (Config::get('jsvalidation.focus_on_error')): ?>
                invalidHandler: function (form, validator) {

                    if (!validator.numberOfInvalids())
                        return;

                    $('html, body').animate({
                        scrollTop: $(validator.errorList[0].element).offset().top
                    }, <?= Config::get('jsvalidation.duration_animate') ?>);

                },
                <?php endif; ?>

                rules: <?= json_encode($validator['rules']); ?>
            });
        });
    });


    function languageTap(lang, type, className = '') {
        if (lang) {

            const tabElement = $(`#tap_link_${lang}`);
            if (type === 'addClass') {
                const tabLink = tabElement.find(`.link_${lang}`);
                tabLink.each(function (index) {
                    console.log(index + ": " + $(this));
                    if (index === 0) {
                        $(this).click()
                    }

                })
                tabElement.addClass('border-error');
            }
            if (type === 'removeClass') {

                tabElement.removeClass('border-error');
            }
        }
    }
</script>
