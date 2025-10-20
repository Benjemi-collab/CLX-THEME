(function () {
    'use strict';

    function ready(fn) {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', fn);
        } else {
            fn();
        }
    }

    function closestCard(element) {
        var node = element;
        while (node && node !== document.body) {
            if (node.classList && node.classList.contains('team-card')) {
                return node;
            }
            node = node.parentElement;
        }
        return null;
    }

    ready(function () {
        var root = document.documentElement;
        var storageKey = 'clx-theme-mode';
        var toggles = [
            document.getElementById('themeToggle'),
            document.getElementById('themeToggleM')
        ];
        var burger = document.getElementById('clx-burger');
        var drawer = document.getElementById('clx-drawer');
        var focusableSelectors = 'a[href], button:not([disabled])';
        var lastFocusedTrigger = null;
        var currentMode = 'light';

        try {
            var stored = window.localStorage.getItem(storageKey);
            if (stored === 'cine' || stored === 'light') {
                currentMode = stored;
            }
        } catch (error) {
            currentMode = 'light';
        }

        function updateButton(button, mode) {
            if (!button) {
                return;
            }

            var label = button.querySelector('.pill-switch-label');
            if (mode === 'cine') {
                button.setAttribute('aria-pressed', 'true');
                if (label) {
                    label.textContent = 'Mode clair';
                }
            } else {
                button.setAttribute('aria-pressed', 'false');
                if (label) {
                    label.textContent = 'Mode ciné';
                }
            }
        }

        function applyMode(mode) {
            var targetMode = mode === 'cine' ? 'cine' : 'light';
            root.setAttribute('data-theme', targetMode);
            var index;
            for (index = 0; index < toggles.length; index += 1) {
                updateButton(toggles[index], targetMode);
            }

            try {
                window.localStorage.setItem(storageKey, targetMode);
            } catch (error) {
                // Storage may be unavailable; fail silently.
            }
        }

        function toggleMode() {
            var nextMode = 'cine';
            if (root.getAttribute('data-theme') === 'cine') {
                nextMode = 'light';
            }

            applyMode(nextMode);
        }

        applyMode(currentMode);

        var i;
        for (i = 0; i < toggles.length; i += 1) {
            var button = toggles[i];
            if (button) {
                button.addEventListener('click', toggleMode);
            }
        }

        function closeDrawer() {
            if (!drawer || !burger) {
                return;
            }

            drawer.classList.remove('is-open');
            drawer.setAttribute('aria-hidden', 'true');
            burger.setAttribute('aria-expanded', 'false');

            if (lastFocusedTrigger) {
                lastFocusedTrigger.focus();
            }
        }

        function openDrawer() {
            if (!drawer || !burger) {
                return;
            }

            lastFocusedTrigger = document.activeElement;
            drawer.classList.add('is-open');
            drawer.setAttribute('aria-hidden', 'false');
            burger.setAttribute('aria-expanded', 'true');

            var focusable = drawer.querySelectorAll(focusableSelectors);
            if (focusable.length > 0) {
                focusable[0].focus();
            }
        }

        if (burger && drawer) {
            burger.addEventListener('click', function () {
                if (drawer.classList.contains('is-open')) {
                    closeDrawer();
                } else {
                    openDrawer();
                }
            });
        }

        if (drawer) {
            drawer.addEventListener('click', function (event) {
                if (event.target.classList.contains('clx-drawer-link')) {
                    closeDrawer();
                }
            });

            drawer.addEventListener('keydown', function (event) {
                if (event.key === 'Escape' || event.key === 'Esc') {
                    closeDrawer();
                }
            });
        }

        document.addEventListener('keydown', function (event) {
            if ((event.key === 'Escape' || event.key === 'Esc') && drawer && drawer.classList.contains('is-open')) {
                closeDrawer();
            }
        });

        function initPricingSlider() {
            var slider = document.querySelector('.clx-3d-slider');
            if (!slider) {
                return;
            }

            var track = slider.querySelector('.clx-3d-track');
            if (!track) {
                return;
            }

            var slides = track.querySelectorAll('.clx-3d-slide');
            if (slides.length === 0) {
                return;
            }

            var prevButton = slider.querySelector('.slider-nav-prev');
            var nextButton = slider.querySelector('.slider-nav-next');
            var currentIndex = 0;
            var total = slides.length;
            var pointerActive = false;
            var pointerStartX = 0;
            var pointerId = null;

            for (i = 0; i < slides.length; i += 1) {
                slides[i].setAttribute('data-index', String(i));
                if (slides[i].classList.contains('is-center')) {
                    currentIndex = i;
                }
            }

            function normalize(index) {
                var result = index % total;
                if (result < 0) {
                    result += total;
                }
                return result;
            }

            function applyState() {
                var idx;
                for (idx = 0; idx < total; idx += 1) {
                    var slide = slides[idx];
                    slide.classList.remove('is-left', 'is-center', 'is-right', 'is-far');
                    var offset = idx - currentIndex;
                    if (offset > total / 2) {
                        offset -= total;
                    } else if (offset < -total / 2) {
                        offset += total;
                    }

                    slide.setAttribute('aria-hidden', 'true');
                    slide.removeAttribute('aria-current');

                    if (offset === 0) {
                        slide.classList.add('is-center');
                        slide.setAttribute('aria-hidden', 'false');
                        slide.setAttribute('aria-current', 'true');
                    } else if (offset === -1) {
                        slide.classList.add('is-left');
                    } else if (offset === 1) {
                        slide.classList.add('is-right');
                    } else {
                        slide.classList.add('is-far');
                    }
                }
            }

            function goTo(index) {
                currentIndex = normalize(index);
                applyState();
            }

            function goNext() {
                goTo(currentIndex + 1);
            }

            function goPrev() {
                goTo(currentIndex - 1);
            }

            applyState();
            track.setAttribute('tabindex', '0');

            if (prevButton) {
                prevButton.addEventListener('click', function (event) {
                    event.preventDefault();
                    goPrev();
                });
            }

            if (nextButton) {
                nextButton.addEventListener('click', function (event) {
                    event.preventDefault();
                    goNext();
                });
            }

            track.addEventListener('keydown', function (event) {
                if (event.key === 'ArrowRight') {
                    event.preventDefault();
                    goNext();
                } else if (event.key === 'ArrowLeft') {
                    event.preventDefault();
                    goPrev();
                }
            });

            track.addEventListener('pointerdown', function (event) {
                pointerActive = true;
                pointerStartX = event.clientX;
                pointerId = event.pointerId;
                track.setPointerCapture(pointerId);
            });

            track.addEventListener('pointerup', function (event) {
                if (!pointerActive) {
                    return;
                }

                var deltaX = event.clientX - pointerStartX;
                if (Math.abs(deltaX) > 40) {
                    if (deltaX < 0) {
                        goNext();
                    } else {
                        goPrev();
                    }
                }

                pointerActive = false;
                if (pointerId !== null) {
                    track.releasePointerCapture(pointerId);
                    pointerId = null;
                }
            });

            track.addEventListener('pointercancel', function () {
                pointerActive = false;
                if (pointerId !== null) {
                    track.releasePointerCapture(pointerId);
                    pointerId = null;
                }
            });
        }

        function initTeamSlider() {
            var slider = document.querySelector('.team-slider');
            if (!slider) {
                return;
            }

            var track = slider.querySelector('.team-track');
            if (!track) {
                return;
            }

            var cards = track.querySelectorAll('.team-card');
            if (cards.length === 0) {
                return;
            }

            var prevButton = slider.querySelector('.team-nav-prev');
            var nextButton = slider.querySelector('.team-nav-next');

            function getGap() {
                var styles = window.getComputedStyle(track);
                var gapValue = styles.getPropertyValue('column-gap') || styles.getPropertyValue('gap');
                var parsed = parseFloat(gapValue);
                if (isNaN(parsed)) {
                    return 0;
                }
                return parsed;
            }

            function getScrollAmount() {
                var width = cards[0].offsetWidth;
                return width + getGap();
            }

            function updateNav() {
                if (!prevButton || !nextButton) {
                    return;
                }

                var maxScroll = track.scrollWidth - track.clientWidth - 1;
                var atStart = track.scrollLeft <= 1;
                var atEnd = track.scrollLeft >= maxScroll;

                prevButton.disabled = atStart;
                nextButton.disabled = atEnd;
                prevButton.setAttribute('aria-disabled', atStart ? 'true' : 'false');
                nextButton.setAttribute('aria-disabled', atEnd ? 'true' : 'false');
            }

            function scrollByAmount(direction) {
                var amount = getScrollAmount() * direction;
                track.scrollBy({ left: amount, behavior: 'smooth' });
            }

            if (prevButton) {
                prevButton.addEventListener('click', function (event) {
                    event.preventDefault();
                    scrollByAmount(-1);
                });
            }

            if (nextButton) {
                nextButton.addEventListener('click', function (event) {
                    event.preventDefault();
                    scrollByAmount(1);
                });
            }

            track.addEventListener('scroll', function () {
                window.requestAnimationFrame(updateNav);
            });

            track.setAttribute('tabindex', '0');
            track.addEventListener('keydown', function (event) {
                if (event.key === 'ArrowRight') {
                    event.preventDefault();
                    scrollByAmount(1);
                } else if (event.key === 'ArrowLeft') {
                    event.preventDefault();
                    scrollByAmount(-1);
                }
            });

            window.addEventListener('resize', function () {
                window.requestAnimationFrame(updateNav);
            });

            window.requestAnimationFrame(updateNav);
        }

        function initTeamHover() {
            var images = document.querySelectorAll('.team-image');
            for (var idx = 0; idx < images.length; idx += 1) {
                var img = images[idx];
                var hoverSrc = img.getAttribute('data-hover-src');
                if (!hoverSrc) {
                    continue;
                }

                var baseSrc = img.getAttribute('src');
                var baseAlt = img.getAttribute('data-base-alt') || img.getAttribute('alt') || '';
                var hoverAlt = img.getAttribute('data-hover-alt') || baseAlt;
                img.dataset.baseSrc = baseSrc;
                img.dataset.baseAlt = baseAlt;

                var card = img.closest ? img.closest('.team-card') : closestCard(img);
                if (!card) {
                    continue;
                }

                (function (imageElement, hoverImage, baseImageSrc, baseImageAlt, hoverImageAlt) {
                    function activateHover() {
                        imageElement.setAttribute('src', hoverImage);
                        imageElement.setAttribute('alt', hoverImageAlt || baseImageAlt);
                    }

                    function resetHover() {
                        var originalSrc = imageElement.dataset.baseSrc || baseImageSrc;
                        var originalAlt = imageElement.dataset.baseAlt || baseImageAlt;
                        imageElement.setAttribute('src', originalSrc);
                        imageElement.setAttribute('alt', originalAlt);
                    }

                    card.addEventListener('mouseenter', activateHover);
                    card.addEventListener('mouseleave', resetHover);
                    card.addEventListener('focusin', activateHover);
                    card.addEventListener('focusout', resetHover);
                })(img, hoverSrc, baseSrc, baseAlt, hoverAlt);
            }
        }

        initPricingSlider();
        initTeamSlider();
        initTeamHover();
    });
})();
