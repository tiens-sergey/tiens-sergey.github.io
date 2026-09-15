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

        if (!trigger) {
            return;
        }


        /* =================================================
           ОТКРЫТЬ
           ================================================= */

        function openTooltip() {

            tooltip.classList.add('ts-tooltip-open');

            trigger.classList.add('ts-tooltip-active');

            trigger.setAttribute('aria-expanded', 'true');
        }


        /* =================================================
           ЗАКРЫТЬ
           ================================================= */

        function closeTooltip() {

            tooltip.classList.remove('ts-tooltip-open');

            trigger.classList.remove('ts-tooltip-active');

            trigger.setAttribute('aria-expanded', 'false');
        }


        /* =================================================
           КЛИК ПО ?
           
           Первый клик  → открыть
           Второй клик → закрыть
           ================================================= */

        trigger.addEventListener('click', function (event) {

            event.preventDefault();
            event.stopPropagation();

            if (tooltip.classList.contains('ts-tooltip-open')) {

                closeTooltip();

            } else {

                openTooltip();

            }
        });


        /* =================================================
           КЛИК ПО ×
           ================================================= */

        if (closeButton) {

            closeButton.addEventListener('click', function (event) {

                event.preventDefault();
                event.stopPropagation();

                closeTooltip();
            });
        }


        /* =================================================
           КЛИК ВНУТРИ ТУЛТИПА
           
           Ничего не закрывает.
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
