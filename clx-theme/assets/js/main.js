(function() {
'use strict';

var STORAGE_KEY = 'clxTheme';
var DEFAULT_THEME = 'dark';
var docElement = document.documentElement;

function readStoredTheme() {
    try {
        var stored = window.localStorage.getItem(STORAGE_KEY);
        if (stored === 'light' || stored === 'dark') {
            return stored;
        }
    } catch (error) {
        return '';
    }
    return '';
}

function storeTheme(theme) {
    try {
        window.localStorage.setItem(STORAGE_KEY, theme);
    } catch (error) {
        // Ignore storage failures (private mode, etc.).
    }
}

function applyTheme(theme, toggle) {
    var targetTheme = theme === 'light' ? 'light' : 'dark';

    docElement.setAttribute('data-theme', targetTheme);

    if (toggle) {
        var isDark = targetTheme === 'dark';
        toggle.setAttribute('aria-pressed', isDark ? 'true' : 'false');
        if (isDark) {
            toggle.classList.add('is-on');
        } else {
            toggle.classList.remove('is-on');
        }
    }

    storeTheme(targetTheme);
}

function initThemeToggle() {
    var toggle = document.getElementById('recToggle');
    var stored = readStoredTheme();
    var initialTheme = stored || DEFAULT_THEME;

    applyTheme(initialTheme, toggle);

    if (!toggle) {
        return;
    }

    toggle.addEventListener('click', function() {
        var current = docElement.getAttribute('data-theme') === 'light' ? 'light' : 'dark';
        var next = current === 'dark' ? 'light' : 'dark';
        applyTheme(next, toggle);
    });
}

function setCardState(card, classes) {
    card.classList.remove('is-left', 'is-center', 'is-right', 'is-far');
    for (var i = 0; i < classes.length; i++) {
        card.classList.add(classes[i]);
    }
}

function initPricingSlider() {
    var track = document.getElementById('clx-pricing-track');
    if (!track) {
        return;
    }

    var cards = track.querySelectorAll('.pricing-card');
    if (!cards.length) {
        return;
    }

    var prev = document.querySelector('.pricing-prev');
    var next = document.querySelector('.pricing-next');
    var currentIndex = 1;

    function getRelativeIndex(index) {
        var length = cards.length;
        var diff = index - currentIndex;
        if (diff > length / 2) {
            diff -= length;
        } else if (diff < -length / 2) {
            diff += length;
        }
        return diff;
    }

    function applyPositions() {
        for (var i = 0; i < cards.length; i++) {
            var card = cards[i];
            var rel = getRelativeIndex(i);
            card.setAttribute('aria-selected', 'false');
            card.setAttribute('tabindex', '-1');
            if (rel === 0) {
                setCardState(card, ['is-center']);
                card.setAttribute('aria-selected', 'true');
                card.setAttribute('tabindex', '0');
            } else if (rel === -1 || rel === cards.length - 1) {
                setCardState(card, ['is-left']);
            } else if (rel === 1 || rel === -(cards.length - 1)) {
                setCardState(card, ['is-right']);
            } else {
                setCardState(card, ['is-far']);
            }
        }
    }

    function move(delta) {
        currentIndex = (currentIndex + delta + cards.length) % cards.length;
        applyPositions();
        for (var i = 0; i < cards.length; i++) {
            if (cards[i].getAttribute('aria-selected') === 'true') {
                cards[i].focus();
                break;
            }
        }
    }

    applyPositions();

    if (prev) {
        prev.addEventListener('click', function() {
            move(-1);
        });
        prev.addEventListener('keydown', function(event) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                move(-1);
            }
        });
    }

    if (next) {
        next.addEventListener('click', function() {
            move(1);
        });
        next.addEventListener('keydown', function(event) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                move(1);
            }
        });
    }

    track.addEventListener('keydown', function(event) {
        if (event.key === 'ArrowRight') {
            event.preventDefault();
            move(1);
        }
        if (event.key === 'ArrowLeft') {
            event.preventDefault();
            move(-1);
        }
    });
}

function initTeamCarousel() {
    var carousel = document.querySelector('.team-carousel');
    if (!carousel) {
        return;
    }

    var cards = carousel.querySelectorAll('.team-card');
    carousel.setAttribute('tabindex', '0');

    var handleHover = function(event) {
        var target = event.currentTarget;
        var hoverSrc = target.getAttribute('data-hover-src');
        var hoverAlt = target.getAttribute('data-hover-alt');
        if (!hoverSrc) {
            return;
        }

        var originalSrc = target.getAttribute('data-original-src');
        if (!originalSrc) {
            target.setAttribute('data-original-src', target.getAttribute('src'));
            target.setAttribute('data-original-alt', target.getAttribute('alt'));
        }

        target.setAttribute('src', hoverSrc);
        if (hoverAlt) {
            target.setAttribute('alt', hoverAlt);
        }
    };

    var handleLeave = function(event) {
        var target = event.currentTarget;
        var originalSrc = target.getAttribute('data-original-src');
        if (!originalSrc) {
            return;
        }

        target.setAttribute('src', originalSrc);
        var originalAlt = target.getAttribute('data-original-alt');
        if (originalAlt) {
            target.setAttribute('alt', originalAlt);
        }
    };

    for (var i = 0; i < cards.length; i++) {
        var img = cards[i].querySelector('.team-photo');
        if (!img) {
            continue;
        }

        img.addEventListener('mouseenter', handleHover);
        img.addEventListener('focus', handleHover);
        img.addEventListener('mouseleave', handleLeave);
        img.addEventListener('blur', handleLeave);
    }

    carousel.addEventListener('keydown', function(event) {
        if (event.key === 'ArrowRight') {
            event.preventDefault();
            carousel.scrollBy({ left: carousel.clientWidth * 0.7, behavior: 'smooth' });
        }
        if (event.key === 'ArrowLeft') {
            event.preventDefault();
            carousel.scrollBy({ left: carousel.clientWidth * -0.7, behavior: 'smooth' });
        }
    });
}

function initReducedMotion() {
    if (!window.matchMedia) {
        return;
    }

    var reduced = window.matchMedia('(prefers-reduced-motion: reduce)');
    if (reduced.matches) {
        docElement.classList.add('clx-reduced-motion');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    initThemeToggle();
    initPricingSlider();
    initTeamCarousel();
    initReducedMotion();
});

})();
