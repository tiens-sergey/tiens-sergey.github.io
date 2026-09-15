const progress = document.querySelector('.progress');
window.addEventListener('scroll', progressBar);

function progressBar(e) {
	let windowScroll = document.body.scrollTop || document.documentElement.scrollTop;
	let windowHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
	let per = windowScroll / windowHeight * 100;

	progress.style.width = per + '%';
}

/* =========================================================
   TOOLTIP — Т-ЛИМФОЦИТЫ
   ========================================================= */

document.addEventListener('DOMContentLoaded', function () {

	const tooltips = document.querySelectorAll('.ts-tooltip');

	tooltips.forEach(function (tooltip) {

		const trigger = tooltip.querySelector('.ts-tooltip-trigger');
		const closeButton = tooltip.querySelector('.ts-tooltip-close');

		let closeTimer = null;


		/* =====================================================
		   ОТКРЫТЬ
		   ===================================================== */

		function openTooltip() {

			clearTimeout(closeTimer);

			trigger.setAttribute('aria-expanded', 'true');
		}


		/* =====================================================
		   ЗАКРЫТЬ
		   ===================================================== */

		function closeTooltip() {

			clearTimeout(closeTimer);

			tooltip.classList.remove('ts-tooltip-open');

			trigger.setAttribute('aria-expanded', 'false');
		}


		/* =====================================================
		   НАВЕДЕНИЕ НА ВСЮ ОБЛАСТЬ ТУЛТИПА
		   
		   Это главное изменение.
		   Пока курсор находится либо на ?,
		   либо на окне — тултип остаётся открытым.
		   ===================================================== */

		tooltip.addEventListener('mouseenter', function () {

			openTooltip();

		});


		/* =====================================================
		   КУРСОР УШЁЛ ИЗ ВСЕЙ ОБЛАСТИ ТУЛТИПА
		   ===================================================== */

		tooltip.addEventListener('mouseleave', function () {

			closeTimer = setTimeout(function () {

				closeTooltip();

			}, 100);

		});


		/* =====================================================
		   КЛИК ПО ?
		   ===================================================== */

		trigger.addEventListener('click', function (event) {

			event.preventDefault();
			event.stopPropagation();
			
			trigger.addEventListener('click', function (e) {
    e.stopPropagation();

    const isOpen = tooltip.classList.contains('ts-tooltip-open');

    // Переключаем состояние
    if (isOpen) {
        tooltip.classList.remove('ts-tooltip-open');
        trigger.setAttribute('aria-expanded', 'false');
    } else {
        tooltip.classList.add('ts-tooltip-open');
        trigger.setAttribute('aria-expanded', 'true');
    }
});


		/* =====================================================
		   КЛИК ПО КРЕСТИКУ
		   ===================================================== */

		closeButton.addEventListener('click', function (event) {

			event.preventDefault();
			event.stopPropagation();

			closeTooltip();

		});


		/* =====================================================
		   КЛИК ВНЕ ТУЛТИПА
		   ===================================================== */

		document.addEventListener('click', function (event) {

			if (!tooltip.contains(event.target)) {

				closeTooltip();

			}

		});

	});

});
