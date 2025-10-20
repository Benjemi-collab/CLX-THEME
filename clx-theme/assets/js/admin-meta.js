(function () {
    'use strict';

    function initMediaControls() {
        if (!window.wp || !window.wp.media) {
            return;
        }

        var selectButtons = document.querySelectorAll('.clx-media-select');
        var clearButtons = document.querySelectorAll('.clx-media-clear');
        var frame = null;
        var currentTarget = '';
        var currentPreview = '';

        function renderEmpty(preview) {
            if (!preview) {
                return;
            }

            var emptyText = preview.getAttribute('data-empty-text') || '';
            preview.innerHTML = '';

            if (emptyText) {
                var paragraph = document.createElement('p');
                paragraph.className = 'description';
                paragraph.textContent = emptyText;
                preview.appendChild(paragraph);
            }
        }

        function openFrame(event) {
            event.preventDefault();
            var button = event.currentTarget;
            currentTarget = button.getAttribute('data-target') || '';
            currentPreview = button.getAttribute('data-preview') || '';
            var frameTitle = button.getAttribute('data-frame-title') || button.textContent;
            var buttonText = button.getAttribute('data-button-text') || button.textContent;

            if (frame) {
                frame.off('select');
            }

            frame = window.wp.media({
                title: frameTitle,
                library: { type: 'image' },
                button: { text: buttonText },
                multiple: false
            });

            frame.on('select', function () {
                var selection = frame.state().get('selection');
                if (!selection) {
                    return;
                }

                var media = selection.first();
                if (!media) {
                    return;
                }

                var data = media.toJSON();
                var input = document.getElementById(currentTarget);
                if (input) {
                    input.value = data.id || '';
                }

                var preview = document.getElementById(currentPreview);
                if (preview) {
                    preview.innerHTML = '';
                    var url = '';
                    if (data.sizes && data.sizes.thumbnail && data.sizes.thumbnail.url) {
                        url = data.sizes.thumbnail.url;
                    } else if (data.url) {
                        url = data.url;
                    }

                    if (url) {
                        var img = document.createElement('img');
                        img.src = url;
                        img.alt = data.alt || data.title || '';
                        preview.appendChild(img);
                    } else {
                        renderEmpty(preview);
                    }
                }
            });

            frame.open();
        }

        function clearMedia(event) {
            event.preventDefault();
            var button = event.currentTarget;
            var target = button.getAttribute('data-target') || '';
            var previewId = button.getAttribute('data-preview') || '';
            var input = document.getElementById(target);

            if (input) {
                input.value = '';
            }

            var preview = document.getElementById(previewId);
            renderEmpty(preview);
        }

        var index;
        for (index = 0; index < selectButtons.length; index += 1) {
            selectButtons[index].addEventListener('click', openFrame);
        }
        for (index = 0; index < clearButtons.length; index += 1) {
            clearButtons[index].addEventListener('click', clearMedia);
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMediaControls);
    } else {
        initMediaControls();
    }
})();
