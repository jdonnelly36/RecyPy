$(document).ready(function() {
    $('.ui.modal').modal()
    $('.red.button.cancel').on('click', function (e) {
        e.preventDefault()
        $('.ui.modal').modal('hide')
    })

    $('.ui.dropdown').dropdown()

    console.log('js includes loaded')
})
