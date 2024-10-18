const Modal = (() => {
    let thisModal;

    const closeModal = (thisModal, $html) => {
        const _reset = () => {
            thisModal.removeClass('_open');
            $html.removeClass('_open-modal');
            stopVideo();
            thisModal.closest('.home-section-data').css('z-index', '1');
            thisModal.find('.modal-default__video._img').css('display', 'none');
            thisModal.find('.modal-default__video._src').css('display', 'none').find('iframe').removeAttr('src');
            thisModal.find('.modal-default__video._yt').css('display', 'block');
        }
        
        if(device.android()) {
            const top = +sessionStorage.getItem('scrollTop') || 0;
            $html.addClass('_scroll-unset'); 
            setTimeout(function() {
                $('html, body').scrollTop(top);
                _reset();
                $html.removeClass('_scroll-unset'); 
                sessionStorage.removeItem('scrollTop');
            }, 100);
        }
        _reset();
    };

    function init($document, $html) {
        $document
            .on('click.openModal', '[data-open-modal]', function(e) {
                e.preventDefault();
                e.stopPropagation();
                const $that = $(this);
                const $attrSrc = $that.attr('data-src');
                const $attrImgSrc = $that.attr('data-img-src');
                thisModal = $document.find('.'+$that.attr('data-open-modal'));
                if($attrSrc) {
                    thisModal.find('.modal-default__video').css('display', 'none');
                    thisModal.find('.modal-default__video._src').css('display', 'block').find('iframe').attr('src', $attrSrc);
                }
                if($attrImgSrc) {
                    thisModal.find('.modal-default__video').css('display', 'none');
                    thisModal.find('.modal-default__video._img').css('display', 'block').find('img').attr('src', $attrImgSrc);
                }
                
                $that.closest('.home-section-data').css('z-index', '10');
                thisModal.addClass('_open');
                $html.addClass('_open-modal');

                if(device.android()) {
                    sessionStorage.setItem('scrollTop', $('html, body').scrollTop());
                }
            })
            .on('click.closeModal', '.js-close-modal', function() {
                closeModal(thisModal, $html);
            })
            .on('click', '.modal-default__inner', function(e) {
                e.stopPropagation();
            })
            .on('keyup.closeModalByEscape', function (e) {
                if (e.keyCode === 27) {
                    closeModal(thisModal, $html);
                }
            });
    }

    return {
        init: function ($document, $html) {
            console.log('Modal.init');
            init($document, $html);
        }
    };

})();

export {Modal}

