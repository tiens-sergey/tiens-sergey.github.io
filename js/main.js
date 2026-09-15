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

    progress.style.width = per + '%';
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


        /* НАВЕДЕНИЕ НА ? */

        trigger.addEventListener('mouseenter', function () {

            openTooltip();

        });


        /* УХОД С ? */

        trigger.addEventListener('mouseleave', function () {

            closeTimer = setTimeout(function () {

                closeTooltip();

            }, 150);

        });


        /* КЛИК ПО ? */

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


        /* НАВЕДЕНИЕ НА ОКНО */

        tooltip.addEventListener('mouseenter', function () {

            clearTimeout(closeTimer);

        });


        /* УХОД С ОКНА */

        tooltip.addEventListener('mouseleave', function () {

            closeTimer = setTimeout(function () {

                closeTooltip();

            }, 150);

        });


        /* КНОПКА × */

        closeButton.addEventListener('click', function (event) {

            event.preventDefault();
            event.stopPropagation();

            closeTooltip();

        });


        /* КЛИК ВНЕ ТУЛТИПА */

        document.addEventListener('click', function (event) {

            if (!tooltip.contains(event.target)) {

                closeTooltip();

            }

        });

    });

});
