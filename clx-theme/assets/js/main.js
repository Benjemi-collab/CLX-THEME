(function () {
    'use strict';

    var docEl = document.documentElement;
    if (docEl.classList.contains('no-js')) {
        docEl.classList.remove('no-js');
    }

    var storageKey = 'clxTheme';
    var defaultTheme = 'dark';
    var toggle = document.getElementById('recToggle');

    function readStoredTheme() {
        try {
            var stored = window.localStorage.getItem(storageKey);
            if ('light' === stored || 'dark' === stored) {
                return stored;
            }
        } catch (error) {
            return null;
        }
        return null;
    }

    function applyTheme(theme, persist) {
        var nextTheme = 'dark';
        if ('light' === theme) {
            nextTheme = 'light';
        }

        docEl.setAttribute('data-theme', nextTheme);

        if (toggle) {
            if ('light' === nextTheme) {
                toggle.classList.remove('is-on');
                toggle.setAttribute('aria-pressed', 'false');
                var lightLabel = toggle.querySelector('.rec-switch-label');
                if (lightLabel) {
                    lightLabel.textContent = 'Mode clair';
                }
            } else {
                toggle.classList.add('is-on');
                toggle.setAttribute('aria-pressed', 'true');
                var darkLabel = toggle.querySelector('.rec-switch-label');
                if (darkLabel) {
                    darkLabel.textContent = 'Mode ciné';
                }
            }
        }

        if (persist) {
            try {
                window.localStorage.setItem(storageKey, nextTheme);
            } catch (error) {
                // Ignore persistence errors (private mode, etc.).
            }
        }
    }

    var initialTheme = readStoredTheme();
    if (!initialTheme) {
        initialTheme = defaultTheme;
    }
    applyTheme(initialTheme, false);

    if (toggle) {
        toggle.addEventListener('click', function () {
            var currentTheme = docEl.getAttribute('data-theme');
            if ('light' === currentTheme) {
                applyTheme('dark', true);
            } else {
                applyTheme('light', true);
            }
        });
    }

    var burger = document.getElementById('clx-burger');
    var drawer = document.getElementById('clx-drawer');
    var burgerLabel = null;
    if (burger) {
        burgerLabel = burger.querySelector('.clx-burger-label');
    }

    function setDrawerState(open) {
        if (!burger || !drawer) {
            return;
        }

        if (open) {
            drawer.classList.add('is-open');
            drawer.removeAttribute('hidden');
            burger.setAttribute('aria-expanded', 'true');
            if (burgerLabel) {
                burgerLabel.textContent = 'Fermer le menu';
            }
        } else {
            drawer.classList.remove('is-open');
            drawer.setAttribute('hidden', 'hidden');
            burger.setAttribute('aria-expanded', 'false');
            if (burgerLabel) {
                burgerLabel.textContent = 'Ouvrir le menu';
            }
        }
    }

    if (burger && drawer) {
        burger.addEventListener('click', function () {
            var isOpen = drawer.classList.contains('is-open');
            setDrawerState(!isOpen);
        });

        document.addEventListener('keydown', function (event) {
            if ('Escape' === event.key || 'Esc' === event.key) {
                setDrawerState(false);
            }
        });

        var links = drawer.querySelectorAll('a');
        for (var i = 0; i < links.length; i += 1) {
            links[i].addEventListener('click', function () {
                setDrawerState(false);
            });
        }
    }
}
    function initPricingSlider() {
        var slider = document.querySelector('[data-slider="pricing"]');
        if (!slider) {
            return;
        }

        var track = slider.querySelector('.clx-3d-track');
        if (!track) {
            return;
        }

        var slides = track.querySelectorAll('.clx-3d-slide');
        if (!slides.length) {
            return;
        }

        var activeIndex = 1;
        if (slides.length === 1) {
            activeIndex = 0;
        }

        slider.setAttribute('aria-roledescription', 'carousel');

        function updateClasses() {
            var total = slides.length;
            var index;
            for (index = 0; index < total; index += 1) {
                slides[index].classList.remove('is-center', 'is-left', 'is-right', 'is-far');
            }

            if (total === 1) {
                slides[0].classList.add('is-center');
                track.setAttribute('data-active-index', '0');
                return;
            }

            var current = activeIndex;
            var previous = (current - 1 + total) % total;
            var next = (current + 1) % total;

            slides[current].classList.add('is-center');
            slides[previous].classList.add('is-left');
            slides[next].classList.add('is-right');

            for (index = 0; index < total; index += 1) {
                if (index !== current && index !== previous && index !== next) {
                    slides[index].classList.add('is-far');
                }
            }

            track.setAttribute('data-active-index', String(current));
        }

        function goTo(newIndex) {
            var total = slides.length;
            if (!total) {
                return;
            }

            activeIndex = (newIndex + total) % total;
            updateClasses();
        }

        updateClasses();

        var prevButton = slider.querySelector('[data-slider-prev="pricing"]');
        var nextButton = slider.querySelector('[data-slider-next="pricing"]');

        if (prevButton) {
            prevButton.addEventListener('click', function (event) {
                event.preventDefault();
                goTo(activeIndex - 1);
            });
        }

        if (nextButton) {
            nextButton.addEventListener('click', function (event) {
                event.preventDefault();
                goTo(activeIndex + 1);
            });
        }

        slider.addEventListener('keydown', function (event) {
            if ('ArrowLeft' === event.key) {
                event.preventDefault();
                goTo(activeIndex - 1);
            } else if ('ArrowRight' === event.key) {
                event.preventDefault();
                goTo(activeIndex + 1);
            }
        });

        var pointerId = null;
        var startX = 0;
        var dragging = false;

        function handlePointerMove(event) {
            if (!dragging || event.pointerId !== pointerId) {
                return;
            }

            var delta = event.clientX - startX;
            if (Math.abs(delta) > 60) {
                if (delta > 0) {
                    goTo(activeIndex - 1);
                } else {
                    goTo(activeIndex + 1);
                }
                handlePointerEnd(event);
            }
        }

        function handlePointerEnd(event) {
            if (event.pointerId !== pointerId) {
                return;
            }

            dragging = false;
            pointerId = null;
            slider.classList.remove('is-dragging');
            slider.removeEventListener('pointermove', handlePointerMove);
            slider.removeEventListener('pointerup', handlePointerEnd);
            slider.removeEventListener('pointercancel', handlePointerEnd);
        }

        slider.addEventListener('pointerdown', function (event) {
            if ('mouse' === event.pointerType && event.button !== 0) {
                return;
            }

            pointerId = event.pointerId;
            startX = event.clientX;
            dragging = true;
            slider.classList.add('is-dragging');
            slider.addEventListener('pointermove', handlePointerMove);
            slider.addEventListener('pointerup', handlePointerEnd);
            slider.addEventListener('pointercancel', handlePointerEnd);
        });
    }

    function initTeamSlider() {
        var slider = document.querySelector('[data-slider="team"]');
        if (!slider) {
            return;
        }

        var track = slider.querySelector('.team-track');
        if (!track) {
            return;
        }

        var cards = track.querySelectorAll('.team-card');
        var prevButton = slider.querySelector('[data-slider-prev="team"]');
        var nextButton = slider.querySelector('[data-slider-next="team"]');

        function scrollByAmount(direction) {
            var distance = slider.clientWidth;
            if (cards.length) {
                var rect = cards[0].getBoundingClientRect();
                distance = rect.width + 24;
            }

            if ('previous' === direction) {
                track.scrollBy({ left: -distance, behavior: 'smooth' });
            } else {
                track.scrollBy({ left: distance, behavior: 'smooth' });
            }
        }

        if (prevButton) {
            prevButton.addEventListener('click', function (event) {
                event.preventDefault();
                scrollByAmount('previous');
            });
        }

        if (nextButton) {
            nextButton.addEventListener('click', function (event) {
                event.preventDefault();
                scrollByAmount('next');
            });
        }

        slider.addEventListener('keydown', function (event) {
            if ('ArrowLeft' === event.key) {
                event.preventDefault();
                scrollByAmount('previous');
            } else if ('ArrowRight' === event.key) {
                event.preventDefault();
                scrollByAmount('next');
            }
        });

        function setupHover(card) {
            var image = card.querySelector('.team-photo');
            if (!image) {
                return;
            }

            var baseSrc = image.getAttribute('data-base-src') || image.getAttribute('src');
            var hoverSrc = image.getAttribute('data-hover-src');

            if (!hoverSrc) {
                return;
            }

            function swapTo(src) {
                if (!src) {
                    return;
                }

                if (image.getAttribute('src') !== src) {
                    image.setAttribute('src', src);
                }
            }

            card.addEventListener('mouseenter', function () {
                swapTo(hoverSrc);
            });

            card.addEventListener('mouseleave', function () {
                swapTo(baseSrc);
            });

            card.addEventListener('focusin', function () {
                swapTo(hoverSrc);
            });

            card.addEventListener('focusout', function () {
                swapTo(baseSrc);
            });
        }

        for (var index = 0; index < cards.length; index += 1) {
            setupHover(cards[index]);
        }
    }

    initPricingSlider();
    initTeamSlider();

})();
