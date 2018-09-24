$('#modal-lead').on('hidden.bs.modal', function (e) {
    $(e.target).removeData('bs.modal');
    $(this).find('.modal-content').html('');
});

/**
 * Клик по кнопке открытия модалки с формой
 * показываем лоад в кнопке
 */
$(document).on('click', '[data-target="#modal-lead"]', function () {
    const self = $(this);
    if (self.attr('disabled')) {
        return false;
    }
    self.ladda();
    self.ladda('start');
});

/**
 * Когда данные в модалку загрузяться
 * убераем лоадер с кноки
 */
$(document).on('loaded.bs.modal', '#modal-lead', function () {
    const btn = $('[data-target="#modal-lead"][data-loading]');
    btn.ladda('remove');
});

/**
 * Ajax отправка формы
 */
$(document).on('submit', '#modal-lead form', function () {
    const self = $(this);
    const btn = self.find('.ladda-button');
    btn.ladda();
    btn.ladda('start');
    $.post(self.attr('action'), self.serialize()).always(function (result) {
        btn.ladda('remove');
        if (result.status) {
            swal({
                title: result.swal.title,
                html: result.swal.html,
                confirmButtonText: result.swal.btn,
                type: "success"
            });
            $('#modal-lead').modal('hide');
        }
    });
    return false;
});