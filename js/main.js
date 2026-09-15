const progress = document.querySelector('.progress');

window.addEventListener('scroll', progressBar);

function progressBar() {
    const windowScroll =
        document.body.scrollTop ||
        document.documentElement.scrollTop;

    const windowHeight =
        document.documentElement.scrollHeight -
        document.documentElement.clientHeight;

    if (progress && windowHeight > 0) {
        const per = windowScroll / windowHeight * 100;
        progress.style.width = per + '%';
    }
}


/* =========================================================
   TOOLTIP — Т-ЛИМФОЦИТЫ
   ========================================================= */

document.addEventListener('DOMContentLoaded', function () {

    const tooltips = document.querySelectorAll('.ts-tooltip');

    tooltips.forEach(function (tooltip) {

        const trigger =
            tooltip.querySelector('.ts-tooltip-trigger');

        const closeButton =
            tooltip.querySelector('.ts-tooltip-close');

        const tooltipText =
            tooltip.querySelector('.ts-tooltip-text');

        if (!trigger) {
            return;
        }

        let closeTimer = null;


        /* =================================================
           ОТКРЫТЬ
           ================================================= */

        function openTooltip() {

            clearTimeout(closeTimer);

            tooltip.classList.add('ts-tooltip-open');
            trigger.classList.add('ts-tooltip-active');

            trigger.setAttribute('aria-expanded', 'true');
        }


        /* =================================================
           ЗАКРЫТЬ
           ================================================= */

        function closeTooltip() {

            clearTimeout(closeTimer);

            tooltip.classList.remove('ts-tooltip-open');
            trigger.classList.remove('ts-tooltip-active');

            trigger.setAttribute('aria-expanded', 'false');
        }


        /* =================================================
           НАВЕДЕНИЕ НА ТУЛТИП
           ================================================= */

        tooltip.addEventListener('mouseenter', function () {

            clearTimeout(closeTimer);

            openTooltip();
        });


        /* =================================================
           УХОД С ТУЛТИПА
           ================================================= */

        tooltip.addEventListener('mouseleave', function () {

            closeTimer = setTimeout(function () {
                closeTooltip();
            }, 150);
        });


        /* =================================================
           КЛИК ПО ?
           
           Первый клик  → открыть
           Второй клик → закрыть
           ================================================= */

        trigger.addEventListener('click', function (event) {

            event.preventDefault();
            event.stopPropagation();

            clearTimeout(closeTimer);

            if (tooltip.classList.contains('ts-tooltip-open')) {
                closeTooltip();
            } else {
                openTooltip();
            }
        });


        /* =================================================
           КЛИК ПО КРЕСТИКУ ×
           ================================================= */

        if (closeButton) {

            closeButton.addEventListener('click', function (event) {

                event.preventDefault();
                event.stopPropagation();

                closeTooltip();
            });
        }


        /* =================================================
           КЛИК ВНУТРИ ТЕКСТА ПОДСКАЗКИ
           
           НИКОГДА не закрывает подсказку.
           ================================================= */

        if (tooltipText) {

            tooltipText.addEventListener('click', function (event) {

                event.stopPropagation();
            });
        }


        /* =================================================
           КЛИК ВНУТРИ ВСЕЙ ОБЛАСТИ ТУЛТИПА
           
           НИКОГДА не закрывает подсказку.
           ================================================= */

        tooltip.addEventListener('click', function (event) {

            event.stopPropagation();
        });


        /* =================================================
           КЛИК ВНЕ ТУЛТИПА
           
           Закрывает подсказку.
           ================================================= */

        document.addEventListener('click', function (event) {

            if (!tooltip.contains(event.target)) {
                closeTooltip();
            }
        });

    });

});
