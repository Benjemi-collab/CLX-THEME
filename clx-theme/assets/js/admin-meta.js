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

        function openFrame(event) {
            event.preventDefault();
            var button = event.currentTarget;
            currentTarget = button.getAttribute('data-target');
            currentPreview = button.getAttribute('data-preview');
            var frameTitle = button.getAttribute('data-frame-title') || '';
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
                    if (data.url) {
                        var img = document.createElement('img');
                        img.src = data.url;
                        img.alt = '';
                        preview.appendChild(img);
                    }
                }
            });

            frame.open();
        }

        function clearMedia(event) {
            event.preventDefault();
            var button = event.currentTarget;
            var target = button.getAttribute('data-target');
            var previewId = button.getAttribute('data-preview');
            var input = document.getElementById(target);
            if (input) {
                input.value = '';
            }
            var preview = document.getElementById(previewId);
            if (preview) {
                preview.innerHTML = '';
            }
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
