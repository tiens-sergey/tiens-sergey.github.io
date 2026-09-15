const progress = document.querySelector('.progress');

window.addEventListener('scroll', progressBar);

function progressBar() {
    let windowScroll =
        document.body.scrollTop ||
        document.documentElement.scrollTop;

    let windowHeight =
        document.documentElement.scrollHeight -
        document.documentElement.clientHeight;

    let per = windowScroll / windowHeight * 100;

    if (progress) {
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

        let closeTimer = null;


        /* ОТКРЫТЬ */

        function openTooltip() {

            clearTimeout(closeTimer);

            tooltip.classList.add('ts-tooltip-open');

            trigger.setAttribute('aria-expanded', 'true');
        }


        /* ЗАКРЫТЬ */

        function closeTooltip() {

            clearTimeout(closeTimer);

            tooltip.classList.remove('ts-tooltip-open');

            trigger.setAttribute('aria-expanded', 'false');
        }


        /* НАВЕДЕНИЕ */

        tooltip.addEventListener('mouseenter', function () {

            openTooltip();

        });


        /* УХОД МЫШИ */

        tooltip.addEventListener('mouseleave', function () {

            closeTimer = setTimeout(function () {

                closeTooltip();

            }, 150);

        });


        /* =================================================
           КЛИК ПО ?
           Первый клик  → ОТКРЫТЬ
           Второй клик → ЗАКРЫТЬ
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


        /* КЛИК ПО КРЕСТИКУ */

        if (closeButton) {

            closeButton.addEventListener('click', function (event) {

                event.preventDefault();
                event.stopPropagation();

                closeTooltip();

            });

        }


        /* КЛИК ВНЕ ТУЛТИПА */

        document.addEventListener('click', function (event) {

            if (!tooltip.contains(event.target)) {

                closeTooltip();

            }

        });

    });

});
