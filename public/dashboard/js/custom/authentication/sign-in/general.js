"use strict";

// Class definition
var KTSigninGeneral = function () {
    // Elements
    var form;
    var submitButton;
    var validator;

    // Handle form
    var handleForm = function (e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'email': {
                        validators: {
                            regexp: {
                                regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                                message: trans('The value is not a valid email address'),
                            },
                            notEmpty: {
                                message: trans('Email address is required')
                            }
                        }
                    },
                    'password': {
                        validators: {
                            notEmpty: {
                                message: trans('The password is required')
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',  // comment to enable invalid state icons
                        eleValidClass: '' // comment to enable valid state icons
                    })
                }
            }
        );

        // Handle form submit
        submitButton.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();

            // Validate form
            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');

                    // Disable button to avoid multiple click
                    submitButton.disabled = true;

                    $.post(form.getAttribute('data-kt-action'),
                        $('#kt_sign_in_form').serialize(), // serializes the form's elements.
                    ).done(function (response) {
                        // Hide loading indication
                        submitButton.removeAttribute('data-kt-indicator');

                        // Enable button
                        submitButton.disabled = false;

                        // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        Swal.fire({
                            text: trans("You have successfully logged in!"),
                            icon: "success",
                            buttonsStyling: false,
                            timer: 1000,
                            confirmButtonText: trans("Ok, got it!"),
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function (result) {

                            form.querySelector('[name="email"]').value = "";
                            form.querySelector('[name="password"]').value = "";

                            //form.submit(); // submit form
                            var redirectUrl = form.getAttribute('data-kt-redirect-url');
                            if (redirectUrl) {
                                location.href = redirectUrl;
                            }

                        });

                    }).fail(function (response) {

                        swal.fire({
                            text: response?.responseJSON?.message ?? trans("failed!"),
                            icon: "error",
                            color: "#716add",
                            buttonsStyling: false,
                            confirmButtonText: trans("Ok, got it!"),
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function (result) {

                            form.querySelector('[name="email"]').value = "";
                            form.querySelector('[name="password"]').value = "";

                            //form.submit(); // submit form
                            var redirectUrl = form.getAttribute('data-kt-redirect-url');
                            if (redirectUrl) {
                                location.href = redirectUrl;
                            }

                        });

                        // swal.fire(trans("Failed to delete"), response.responseJSON.message, "error").then(function (result) {

                        //         form.querySelector('[name="email"]').value = "";
                        //         form.querySelector('[name="password"]').value = "";

                        //         //form.submit(); // submit form
                        //         var redirectUrl = form.getAttribute('data-kt-redirect-url');
                        //         if (redirectUrl) {
                        //             location.href = redirectUrl;
                        //         }

                        // });;

                    })

                } else {

                    // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                    Swal.fire({
                        text: trans("Sorry, looks like there are some errors detected, please try again."),
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: trans("Ok, got it!"),
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });

                }


            });
        });
    }

    // Public functions
    return {
        // Initialization
        init: function () {
            form = document.querySelector('#kt_sign_in_form');
            submitButton = document.querySelector('#kt_sign_in_submit');

            handleForm();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTSigninGeneral.init();
});
