$(document).ready(function() {
    // initiate ajax
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    // set up modals and cancel buttons (based on css classes)
    $('.ui.modal').modal()
    $('.red.button.cancel').on('click', function (e) {
        e.preventDefault()
        $('.ui.modal').modal('hide')
    })

    // set up dropdowns
    $('.ui.dropdown').dropdown()

    // pretty sure you can figure this one out
    console.log('js includes loaded')
})
