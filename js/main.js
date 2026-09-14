const progress = document.querySelector('.progress');
window.addEventListener('scroll', progressBar);

function progressBar(e) {
	let windowScroll = document.body.scrollTop || document.documentElement.scrollTop;
	let windowHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
	let per = windowScroll / windowHeight * 100;

	progress.style.width = per + '%';
}
```javascript
/* =========================================================
   TOOLTIP — Т-ЛИМФОЦИТЫ
   ========================================================= */

document.addEventListener('DOMContentLoaded', function () {

	const tooltips = document.querySelectorAll('.ts-tooltip');

	tooltips.forEach(function (tooltip) {

		const trigger = tooltip.querySelector('.ts-tooltip-trigger');
		const tooltipText = tooltip.querySelector('.ts-tooltip-text');
		const closeButton = tooltip.querySelector('.ts-tooltip-close');

		let closeTimer = null;


		/* Открытие подсказки */
		function openTooltip() {

			clearTimeout(closeTimer);

			tooltip.classList.add('ts-tooltip-open');

			trigger.setAttribute('aria-expanded', 'true');
		}


		/* Закрытие подсказки */
		function closeTooltip() {

			clearTimeout(closeTimer);

			tooltip.classList.remove('ts-tooltip-open');

			trigger.setAttribute('aria-expanded', 'false');
		}


		/* =========================================
		   НАВЕДЕНИЕ НА ?
		   ========================================= */

		trigger.addEventListener('mouseenter', function () {

			openTooltip();

		});


		/* =========================================
		   КУРСОР УШЁЛ С ?
		   ========================================= */

		trigger.addEventListener('mouseleave', function () {

			closeTimer = setTimeout(function () {

				if (!tooltip.matches(':hover')) {
					closeTooltip();
				}

			}, 150);

		});


		/* =========================================
		   КЛИК ПО ?
		   ========================================= */

		trigger.addEventListener('click', function (event) {

			event.stopPropagation();

			openTooltip();

		});


		/* =========================================
		   КУРСОР ВОШЁЛ В ПОДСКАЗКУ
		   ========================================= */

		tooltipText.addEventListener('mouseenter', function () {

			clearTimeout(closeTimer);

			openTooltip();

		});


		/* =========================================
		   КУРСОР УШЁЛ ИЗ ПОДСКАЗКИ
		   ========================================= */

		tooltipText.addEventListener('mouseleave', function () {

			closeTimer = setTimeout(function () {

				if (!tooltip.matches(':hover')) {
					closeTooltip();
				}

			}, 150);

		});


		/* =========================================
		   КЛИК ПО КРЕСТИКУ
		   ========================================= */

		closeButton.addEventListener('click', function (event) {

			event.stopPropagation();

			closeTooltip();

		});


		/* =========================================
		   КЛИК ВНЕ ТУЛТИПА
		   ========================================= */

		document.addEventListener('click', function (event) {

			if (!tooltip.contains(event.target)) {

				closeTooltip();

			}

		});

	});

});
```
