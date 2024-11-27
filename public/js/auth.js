document.addEventListener('DOMContentLoaded', function () {
    if (window.sessionSuccess) {
        toastr.success(window.sessionSuccess);
    }

    if (window.sessionError) {
        toastr.error(window.sessionError);
    }

    if (window.validationErrors && window.validationErrors.length) {
        window.validationErrors.forEach(function (error) {
            toastr.error(error);
        });
    }
});
