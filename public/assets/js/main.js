document.addEventListener('DOMContentLoaded', function () {
    var navbar = document.querySelector('.site-navbar');

    if (navbar && !navbar.classList.contains('navbar-solid')) {
        var toggleScrolled = function () {
            if (window.scrollY > 40) {
                navbar.classList.add('is-scrolled');
            } else {
                navbar.classList.remove('is-scrolled');
            }
        };

        toggleScrolled();
        window.addEventListener('scroll', toggleScrolled);
    }

    var navCollapse = document.getElementById('mainNav');
    if (navCollapse) {
        navCollapse.querySelectorAll('.nav-link').forEach(function (link) {
            link.addEventListener('click', function () {
                if (navCollapse.classList.contains('show') && window.bootstrap) {
                    window.bootstrap.Collapse.getOrCreateInstance(navCollapse).hide();
                }
            });
        });
    }

    initCatalogFilters();
    initBookingForm();
});

function initBookingForm() {
    var sessionSelect = document.getElementById('sessionType');
    var packageSelect = document.getElementById('packageSelect');
    var packageFeatures = document.getElementById('packageFeatures');
    var themeChoices = document.getElementById('themeChoices');
    var themeGroup = document.getElementById('themeGroup');
    var themeHint = document.getElementById('themeHint');
    var dateInput = document.getElementById('date');
    var timeSelect = document.getElementById('time');
    var fieldGroups = document.querySelectorAll('.booking-fields');

    if (!sessionSelect || !packageSelect) {
        return;
    }

    var currentPackages = [];

    function renderFeatures(packageId) {
        if (!packageFeatures) {
            return;
        }

        var pkg = currentPackages.find(function (p) { return String(p.id) === String(packageId); });
        packageFeatures.innerHTML = '';

        if (!pkg || !pkg.features || !pkg.features.length) {
            return;
        }

        var list = document.createElement('ul');
        list.className = 'small text-muted mb-0 ps-3';
        pkg.features.forEach(function (feature) {
            var item = document.createElement('li');
            item.textContent = feature;
            list.appendChild(item);
        });
        packageFeatures.appendChild(list);
    }

    function currentThemeLimit() {
        var pkg = currentPackages.find(function (p) { return String(p.id) === String(packageSelect.value); });
        return pkg ? (parseInt(pkg.theme_limit, 10) || 0) : 0;
    }

    // Show the theme picker only when the chosen package includes theme choice,
    // and stop the customer selecting more than that package's limit.
    function applyThemeLimit() {
        if (!themeChoices || !themeGroup) {
            return;
        }

        var boxes = Array.prototype.slice.call(themeChoices.querySelectorAll('input[type="checkbox"]'));
        var limit = currentThemeLimit();

        if (!boxes.length || limit < 1) {
            themeGroup.hidden = true;
            boxes.forEach(function (box) {
                box.checked = false;
                box.disabled = false;
                box.closest('.theme-choice-item').classList.remove('is-disabled');
            });
            return;
        }

        themeGroup.hidden = false;

        var checkedCount = boxes.filter(function (box) { return box.checked; }).length;

        boxes.forEach(function (box) {
            box.disabled = !box.checked && checkedCount >= limit;
            box.closest('.theme-choice-item').classList.toggle('is-disabled', box.disabled);
        });

        if (themeHint) {
            themeHint.textContent = limit === 1
                ? (themeHint.dataset.limitOne || 'You can choose 1 theme.')
                : (themeHint.dataset.limitMany || 'You can choose up to :count themes.').replace(':count', limit);
        }
    }

    function refreshAvailability() {
        if (!timeSelect || !dateInput || !dateInput.value || !packageSelect.value) {
            return;
        }

        var previousValue = timeSelect.value;
        var placeholderText = timeSelect.dataset.placeholder || 'Select a time';

        fetch('/availability?package_id=' + encodeURIComponent(packageSelect.value) + '&date=' + encodeURIComponent(dateInput.value))
            .then(function (res) { return res.json(); })
            .then(function (slots) {
                timeSelect.innerHTML = '';

                var placeholder = document.createElement('option');
                placeholder.value = '';
                placeholder.disabled = true;
                placeholder.selected = true;
                placeholder.textContent = placeholderText;
                timeSelect.appendChild(placeholder);

                slots.forEach(function (slot) {
                    var opt = document.createElement('option');
                    opt.value = slot.time;
                    opt.textContent = slot.available ? slot.time : slot.time + ' — booked';
                    opt.disabled = !slot.available;
                    if (slot.available && slot.time === previousValue) {
                        opt.selected = true;
                        placeholder.selected = false;
                    }
                    timeSelect.appendChild(opt);
                });
            })
            .catch(function () {});
    }

    if (timeSelect) {
        timeSelect.dataset.placeholder = timeSelect.dataset.placeholder
            || (timeSelect.querySelector('option[value=""]') ? timeSelect.querySelector('option[value=""]').textContent : 'Select a time');
    }

    sessionSelect.addEventListener('change', function () {
        var option = sessionSelect.options[sessionSelect.selectedIndex];
        var template = option.dataset.template || 'generic';

        fieldGroups.forEach(function (group) {
            group.hidden = group.dataset.template !== template;
        });

        var themes = [];

        try {
            currentPackages = JSON.parse(option.dataset.packages || '[]');
        } catch (e) {
            currentPackages = [];
        }

        try {
            themes = JSON.parse(option.dataset.themes || '[]');
        } catch (e) {}

        packageSelect.innerHTML = '';
        if (packageFeatures) {
            packageFeatures.innerHTML = '';
        }

        if (!currentPackages.length) {
            var emptyOpt = document.createElement('option');
            emptyOpt.value = '';
            emptyOpt.textContent = 'No packages available for this session yet';
            emptyOpt.disabled = true;
            emptyOpt.selected = true;
            packageSelect.appendChild(emptyOpt);
        } else {
            var placeholder = document.createElement('option');
            placeholder.value = '';
            placeholder.disabled = true;
            placeholder.selected = true;
            placeholder.textContent = packageSelect.dataset.placeholder || 'Select a package';
            packageSelect.appendChild(placeholder);

            currentPackages.forEach(function (pkg) {
                var opt = document.createElement('option');
                opt.value = pkg.id;
                opt.textContent = pkg.name + ' — ' + pkg.price + ' (' + pkg.duration + ')';
                packageSelect.appendChild(opt);
            });
        }

        if (themeChoices && themeGroup) {
            themeChoices.innerHTML = '';

            themes.forEach(function (theme) {
                var label = document.createElement('label');
                label.className = 'theme-choice-item';
                label.innerHTML =
                    '<input type="checkbox" name="themes[]" value="' + theme.id + '" class="d-none">' +
                    '<span class="theme-choice-card">' +
                        '<img src="' + theme.image + '" alt="' + theme.name + '" loading="lazy">' +
                        '<span>' + theme.name + '</span>' +
                    '</span>' +
                    '<span class="theme-choice-check"><i class="bi bi-check-lg"></i></span>';
                themeChoices.appendChild(label);
            });

            applyThemeLimit();
        }

        refreshAvailability();
    });

    packageSelect.addEventListener('change', function () {
        renderFeatures(packageSelect.value);
        applyThemeLimit();
        refreshAvailability();
    });

    if (themeChoices) {
        themeChoices.addEventListener('change', function (event) {
            if (event.target && event.target.matches('input[type="checkbox"]')) {
                applyThemeLimit();
            }
        });
    }

    if (dateInput) {
        dateInput.addEventListener('change', refreshAvailability);
    }
}

function initCatalogFilters() {
    var filterPills = document.querySelectorAll('.filter-pill');
    var categories = document.querySelectorAll('.catalog-category');
    var searchInput = document.getElementById('catalogSearch');
    var noResults = document.getElementById('catalogNoResults');

    if (!filterPills.length || !categories.length) {
        return;
    }

    var activeFilter = 'all';

    function applyFilters() {
        var query = searchInput ? searchInput.value.trim().toLowerCase() : '';
        var anyVisible = false;

        categories.forEach(function (category) {
            var matchesFilter = activeFilter === 'all' || category.dataset.category === activeFilter;
            var items = category.querySelectorAll('.catalog-package-item');
            var categoryHasMatch = false;

            items.forEach(function (item) {
                var matchesSearch = !query || item.dataset.search.indexOf(query) !== -1;
                item.classList.toggle('d-none', !matchesSearch);
                if (matchesSearch) {
                    categoryHasMatch = true;
                }
            });

            var show = matchesFilter && categoryHasMatch;
            category.classList.toggle('d-none', !show);
            if (show) {
                anyVisible = true;
            }
        });

        if (noResults) {
            noResults.classList.toggle('d-none', anyVisible);
        }
    }

    filterPills.forEach(function (pill) {
        pill.addEventListener('click', function () {
            activeFilter = pill.dataset.filter;
            filterPills.forEach(function (p) { p.classList.remove('active'); });
            pill.classList.add('active');
            applyFilters();
        });
    });

    if (searchInput) {
        searchInput.addEventListener('input', applyFilters);
    }
}
