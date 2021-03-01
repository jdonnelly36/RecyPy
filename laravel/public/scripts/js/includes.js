$(document).ready(function() {
    $('.ui.modal').modal()
    $('.red.button.cancel').on('click', function (e) {
        e.preventDefault()
        $('.ui.modal').modal('hide')
    })

    console.log('js includes loaded')
})
