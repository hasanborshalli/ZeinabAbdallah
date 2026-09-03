function initRepeatableRows(config) {
    var addBtn = document.getElementById(config.addBtnId);
    var list = document.getElementById(config.listId);
    var template = document.getElementById(config.templateId);

    if (!addBtn || !list || !template) {
        return;
    }

    var nextIndex = parseInt(addBtn.getAttribute('data-next-index'), 10) || 0;

    addBtn.addEventListener('click', function () {
        var html = template.innerHTML.split('__INDEX__').join(nextIndex);
        var wrapper = document.createElement('div');
        wrapper.innerHTML = html.trim();
        list.appendChild(wrapper.firstElementChild);
        nextIndex++;
    });

    list.addEventListener('click', function (e) {
        var removeBtn = e.target.closest('.' + config.removeClass);

        if (!removeBtn) {
            return;
        }

        var row = removeBtn.closest('.' + config.rowClass);
        var rows = list.querySelectorAll('.' + config.rowClass);

        if (rows.length > 1) {
            row.remove();
        } else {
            row.querySelectorAll('input').forEach(function (input) {
                input.value = '';
            });
        }
    });
}

function initDeleteModal(config) {
    var modal = document.getElementById(config.modalId);

    if (!modal) {
        return;
    }

    var form = document.getElementById(config.formId);
    var nameEl = config.nameId ? document.getElementById(config.nameId) : null;

    modal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;

        if (!button) {
            return;
        }

        form.action = button.getAttribute('data-delete-url');

        if (nameEl) {
            nameEl.textContent = button.getAttribute(config.nameAttr || 'data-name');
        }
    });
}

function initRescheduleModal() {
    var modal = document.getElementById('rescheduleModal');

    if (!modal) {
        return;
    }

    var form = document.getElementById('rescheduleForm');
    var nameEl = document.getElementById('rescheduleBookingName');
    var dateInput = document.getElementById('rescheduleDate');
    var timeInput = document.getElementById('rescheduleTime');

    modal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;

        if (!button) {
            return;
        }

        form.action = button.getAttribute('data-reschedule-url');
        nameEl.textContent = button.getAttribute('data-customer-name') || '';
        dateInput.value = button.getAttribute('data-current-date') || '';
        timeInput.value = button.getAttribute('data-current-time') || '';
    });
}

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-icon-picker]').forEach(function (select) {
        var previewId = select.getAttribute('data-icon-picker');
        var preview = document.getElementById(previewId);

        if (!preview) {
            return;
        }

        var updatePreview = function () {
            preview.className = 'bi ' + select.value;
        };

        select.addEventListener('change', updatePreview);
        updatePreview();
    });

    initRepeatableRows({
        addBtnId: 'addNoteRow',
        listId: 'notesList',
        templateId: 'noteRowTemplate',
        rowClass: 'notes-row',
        removeClass: 'remove-note-row',
    });

    initRepeatableRows({
        addBtnId: 'addFeatureRow',
        listId: 'featuresList',
        templateId: 'featureRowTemplate',
        rowClass: 'feature-row',
        removeClass: 'remove-feature-row',
    });

    initDeleteModal({
        modalId: 'deleteCategoryModal',
        formId: 'deleteCategoryForm',
        nameId: 'deleteCategoryName',
        nameAttr: 'data-category-name',
    });

    initDeleteModal({
        modalId: 'deletePackageModal',
        formId: 'deletePackageForm',
        nameId: 'deletePackageName',
        nameAttr: 'data-package-name',
    });

    initDeleteModal({
        modalId: 'deleteImageModal',
        formId: 'deleteImageForm',
        nameId: 'deleteImageName',
        nameAttr: 'data-photo-label',
    });

    initDeleteModal({
        modalId: 'deleteThemeModal',
        formId: 'deleteThemeForm',
        nameId: 'deleteThemeName',
        nameAttr: 'data-theme-name',
    });

    initDeleteModal({
        modalId: 'deleteQuestionModal',
        formId: 'deleteQuestionForm',
        nameId: 'deleteQuestionName',
        nameAttr: 'data-question-name',
    });

    initRescheduleModal();
});
