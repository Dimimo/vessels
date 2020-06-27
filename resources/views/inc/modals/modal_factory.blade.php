<!-- Modal -->
<div class="modal fade modal-template">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="false">×</button>
            </div>
            <div class="modal-body">
                <span class="fas fa-sync fa-spin fa-2x fa-fw"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    (function ($) {
        $.fn.modalFactory = function () {
            'use strict';

            let modalTemplate = this;

            function cloneModal() {
                return modalTemplate.clone().removeClass('modal-template');
            }

            function addCloseEventHandler(modal) {
                modal.on('hidden.bs.modal', function () {
                    $(this).remove();
                });
            }

            function setModalPadding(modal, paddingRight) {
                modal.on('shown.bs.modal', function () {
                    $(this).css('padding-right', paddingRight);
                });
            }

            function getModal(options) {
                let modal = cloneModal();
                let paddingRight = $('body').css('padding-right');

                if (options.modalSize) {
                    modal.find('.modal-dialog').addClass(options.modalSize);
                }
                if (options.modalClass) {
                    modal.find('.modal-dialog').addClass(options.modalClass);
                }
                if (options.modalId) {
                    modal.find('.modal-content').attr('id', options.modalId);
                }
                if (options.modalTitle) {
                    modal.find('.modal-title').text(options.modalTitle);
                }
                if (options.modalUrl) {
                    modal.find('.modal-content').load(options.modalUrl);
                }
                if (options.modalBody) {
                    modal.find('.modal-body').html(options.modalBody);
                }
                if (options.modalFooter) {
                    modal.find('.modal-footer').html(options.modalFooter);
                }
                if (parseInt(paddingRight)) {
                    setModalPadding(modal, paddingRight);
                }

                addCloseEventHandler(modal);
                modal.modal('show');
                return modal;
            }

            (function initModalFactory() {
                $('body').on('click', '.call-modal', function (event) {
                    event.preventDefault();
                    let btn = $(this);

                    let mSize = btn.data('modal-size'),
                        mUrl = btn.data('modal-url'),
                        mClass = btn.data('modal-class'),
                        mId = btn.data('modal-id'),
                        mTitle = btn.data('modal-title'),
                        mBody = btn.data('modal-body'),
                        mFooter = btn.data('modal-footer');

                    getModal({
                        modalSize: mSize,
                        modalUrl: mUrl,
                        modalClass: mClass,
                        modalId: mId,
                        modalTitle: mTitle,
                        modalBody: mBody,
                        modalFooter: mFooter
                    });
                });
            })();

            (function fixModalScrolling() {
                $('body').on('hidden.bs.modal', function () {
                    if ($('.modal.in').length > 0) {
                        $('body').addClass('modal-open');
                    }
                });
            })();

            return this;
        };
    })(jQuery);

    $('.modal-template').modalFactory();
</script>
