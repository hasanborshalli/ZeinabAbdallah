document.addEventListener('DOMContentLoaded', function () {
    initSiteNav();
    initSimpleBookingForm();
    initSessionInfoForm();
    initLightbox();
    initFeedbacksSlider();
});

// The per-session "tell us more" form sent via a private link once a booking
// is confirmed over WhatsApp (/sessions/{category}/form). Every field that
// should be included carries a data-label; this walks them in DOM order,
// skips anything left empty, and opens WhatsApp with the rest — no fields
// are hardcoded here, so a future session's field set just works.
function initSessionInfoForm() {
    var form = document.getElementById('sessionInfoForm');
    if (!form) {
        return;
    }

    var whatsappUrl = form.dataset.whatsappUrl;
    var messageIntro = form.dataset.messageIntro || '';
    var status = form.querySelector('[data-booking-status]');

    var resetStatus = function () {
        if (status) {
            status.textContent = status.dataset.defaultText;
        }
    };

    form.querySelectorAll('input, textarea').forEach(function (field) {
        field.addEventListener('input', resetStatus);
    });

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        var lines = messageIntro ? [messageIntro, ''] : [];

        form.querySelectorAll('[data-label]').forEach(function (field) {
            var label = field.dataset.label;
            var value = '';

            if (field.type === 'radio' || field.type === 'checkbox') {
                if (!field.checked) {
                    return;
                }
                value = field.dataset.valueLabel || field.value;
            } else {
                value = field.value.trim();
            }

            if (value) {
                lines.push(label + ': ' + value);
            }
        });

        var message = lines.join('\n');
        var url = whatsappUrl + '?text=' + encodeURIComponent(message);

        window.open(url, '_blank', 'noreferrer');

        if (status) {
            status.textContent = status.dataset.sentText;
        }
    });
}

// Any <img data-lightbox> on the page opens full-size in the shared overlay
// from layout.blade.php — used by the photo grids (home gallery, session
// photography teaser, full session gallery).
function initLightbox() {
    var lightbox = document.getElementById('lightbox');
    var triggers = document.querySelectorAll('[data-lightbox]');

    if (!lightbox || !triggers.length) {
        return;
    }

    var lightboxImg = lightbox.querySelector('.lightbox-img');
    var closeBtn = lightbox.querySelector('[data-lightbox-close]');
    var lastFocused = null;

    var close = function () {
        lightbox.hidden = true;
        lightboxImg.src = '';
        document.body.classList.remove('lightbox-open');
        if (lastFocused) {
            lastFocused.focus();
        }
    };

    var open = function (trigger) {
        lastFocused = trigger;
        lightboxImg.src = trigger.currentSrc || trigger.src;
        lightboxImg.alt = trigger.alt || '';
        lightbox.hidden = false;
        document.body.classList.add('lightbox-open');
        closeBtn.focus();
    };

    triggers.forEach(function (trigger) {
        trigger.style.cursor = 'zoom-in';
        trigger.addEventListener('click', function () {
            open(trigger);
        });
    });

    closeBtn.addEventListener('click', close);

    lightbox.addEventListener('click', function (event) {
        if (event.target === lightbox) {
            close();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && !lightbox.hidden) {
            close();
        }
    });
}

// The simple name+phone booking form (/booking) — builds a WhatsApp message
// client-side and opens it, with no server-side persistence.
function initSimpleBookingForm() {
    var form = document.getElementById('bookingForm');
    if (!form) {
        return;
    }

    var nameInput = form.querySelector('#booking-name');
    var phoneInput = form.querySelector('#booking-phone');
    var status = form.querySelector('[data-booking-status]');
    var whatsappUrl = form.dataset.whatsappUrl;
    var template = form.dataset.messageTemplate || '';

    var resetStatus = function () {
        if (status) {
            status.textContent = status.dataset.defaultText;
        }
    };

    [nameInput, phoneInput].forEach(function (input) {
        if (input) {
            input.addEventListener('input', resetStatus);
        }
    });

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        var name = nameInput ? nameInput.value.trim() : '';
        var phone = phoneInput ? phoneInput.value.trim() : '';

        var message = template.replace(':name', name).replace(':phone', phone);
        var url = whatsappUrl + '?text=' + encodeURIComponent(message);

        window.open(url, '_blank', 'noreferrer');

        if (status) {
            status.textContent = status.dataset.sentText;
        }
    });
}

// Horizontal, swipeable feedbacks carousel on the home page. The track
// scrolls natively (touch drag, trackpad, scrollbar); the arrow buttons just
// nudge it by one card width and disable themselves at the ends. Direction
// is scroll-left-sign-aware so it also works under dir="rtl".
function initFeedbacksSlider() {
    var track = document.querySelector('[data-feedbacks-track]');
    var prevBtn = document.querySelector('[data-feedbacks-prev]');
    var nextBtn = document.querySelector('[data-feedbacks-next]');

    if (!track || !prevBtn || !nextBtn) {
        return;
    }

    var isRtl = document.documentElement.dir === 'rtl';

    var getStep = function () {
        var slide = track.querySelector('.feedbacks-slide');
        if (!slide) {
            return track.clientWidth;
        }
        var gap = parseFloat(window.getComputedStyle(track).columnGap) || 0;
        return slide.getBoundingClientRect().width + gap;
    };

    var updateButtons = function () {
        var maxScroll = track.scrollWidth - track.clientWidth;

        if (maxScroll <= 1) {
            prevBtn.disabled = true;
            nextBtn.disabled = true;
            return;
        }

        if (isRtl) {
            prevBtn.disabled = track.scrollLeft >= -1;
            nextBtn.disabled = track.scrollLeft <= -maxScroll + 1;
        } else {
            prevBtn.disabled = track.scrollLeft <= 1;
            nextBtn.disabled = track.scrollLeft >= maxScroll - 1;
        }
    };

    var scrollByStep = function (readingDirection) {
        var amount = getStep() * readingDirection * (isRtl ? -1 : 1);
        track.scrollBy({ left: amount, behavior: 'smooth' });
    };

    nextBtn.addEventListener('click', function () {
        scrollByStep(1);
    });

    prevBtn.addEventListener('click', function () {
        scrollByStep(-1);
    });

    track.addEventListener('scroll', updateButtons);
    window.addEventListener('resize', updateButtons);

    updateButtons();
}

function initSiteNav() {
    var toggle = document.querySelector('[data-nav-toggle]');
    var mobileNav = document.getElementById('mobileNav');

    if (!toggle || !mobileNav) {
        return;
    }

    var iconOpen = toggle.querySelector('[data-nav-icon-open]');
    var iconClose = toggle.querySelector('[data-nav-icon-close]');

    var setOpen = function (open) {
        mobileNav.hidden = !open;
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        toggle.setAttribute('aria-label', open ? toggle.dataset.labelClose : toggle.dataset.labelOpen);

        if (iconOpen) {
            iconOpen.hidden = open;
        }
        if (iconClose) {
            iconClose.hidden = !open;
        }
    };

    toggle.addEventListener('click', function () {
        setOpen(mobileNav.hidden);
    });

    mobileNav.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
            setOpen(false);
        });
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && !mobileNav.hidden) {
            setOpen(false);
        }
    });
}

