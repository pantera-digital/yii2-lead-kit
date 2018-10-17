(function($){
    $('.lead-modal').on('hidden.bs.modal', function (e) {
        const self = $(this);
        if (self.hasClass('lead-modal--ajax')) {
            $(e.target).removeData('bs.modal');
            $(this).find('.modal-content').html('');
        }
    });

    /**
     * Клик по кнопке открытия модалки с формой
     * показываем лоад в кнопке
     */
    $(document).on('click', 'a.open-lead-modal', function () {
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
    $(document).on('loaded.bs.modal', '.lead-modal', function () {
        const btn = $('.open-lead-modal[data-loading]');
        btn.ladda('remove');
    });

    /**
     * Ajax отправка формы
     */
    $(document).on('submit', '.lead-form', function () {
        const self = $(this);
        const btn = self.find('.ladda-button');
        const modal = self.parents('.lead-modal');
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
                if (modal === undefined || modal.hasClass('lead-modal--ajax') === false) {
                    self.get(0).reset();
                }
                if (modal) {
                    modal.modal('hide');
                }
            }
        });
        return false;
    });
}(jQuery));