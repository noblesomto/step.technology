/**
 * CUSTOM TRIX EDITOR FUNCTIONALITY
 * Reusable JavaScript for Trix Editor
 *
 * Dependencies: Trix Editor (https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js)
 *
 * Usage:
 * 1. Include this file after Trix JS
 * 2. Call TrixCustom.init() when DOM is ready
 * 3. Optionally set upload URL: TrixCustom.setUploadUrl('/your-upload-route')
 */

const TrixCustom = (function() {
    let trixEditor = null;
    let uploadUrl = '/trix-upload';
    let csrfToken = null;

    /**
     * Initialize Trix Custom functionality
     */
    function init(options = {}) {
        if (options.uploadUrl) uploadUrl = options.uploadUrl;
        if (options.csrfToken) csrfToken = options.csrfToken;

        // Auto-detect CSRF token if not provided
        if (!csrfToken) {
            const metaTag = document.querySelector('meta[name="csrf-token"]');
            if (metaTag) csrfToken = metaTag.getAttribute('content');
        }

        setupEditor();
        setupToolbarButtons();
        setupFontSize();
        setupImageUpload();
    }

    /**
     * Setup editor reference
     */
    function setupEditor() {
        document.addEventListener('trix-initialize', function(event) {
            trixEditor = event.target;
        });
    }

    /**
     * Setup toolbar button functionality
     */
    function setupToolbarButtons() {
        // Attribute buttons (bold, italic, etc.)
        document.querySelectorAll('.toolbar-btn[data-trix-attribute]').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const attribute = this.dataset.trixAttribute;
                if (trixEditor) {
                    const isActive = trixEditor.editor.attributeIsActive(attribute);
                    if (isActive) {
                        trixEditor.editor.deactivateAttribute(attribute);
                    } else {
                        trixEditor.editor.activateAttribute(attribute);
                    }
                }
            });
        });

        // Action buttons (undo, redo, link)
        document.querySelectorAll('.toolbar-btn[data-trix-action]').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const action = this.dataset.trixAction;

                if (trixEditor) {
                    if (action === 'link') {
                        handleLinkInsertion();
                    } else if (typeof trixEditor.editor[action] === 'function') {
                        trixEditor.editor[action]();
                    }
                }
            });
        });

        // Update button states based on selection
        document.addEventListener('trix-selection-change', updateToolbarStates);
    }

    /**
     * Handle link insertion
     */
    function handleLinkInsertion() {
        const href = prompt('Enter link URL:');
        if (href && trixEditor) {
            trixEditor.editor.activateAttribute('href', href);
        }
    }

    /**
     * Update toolbar button states
     */
    function updateToolbarStates() {
        document.querySelectorAll('.toolbar-btn[data-trix-attribute]').forEach(button => {
            const attribute = button.dataset.trixAttribute;
            if (trixEditor && trixEditor.editor.attributeIsActive(attribute)) {
                button.classList.add('active');
            } else {
                button.classList.remove('active');
            }
        });
    }

    /**
     * Setup font size functionality
     */
    function setupFontSize() {
        const fontSizeSelect = document.getElementById('fontSizeSelect');
        if (!fontSizeSelect) return;

        fontSizeSelect.addEventListener('change', function(e) {
            if (e.target.value && trixEditor) {
                const selection = trixEditor.editor.getSelectedRange();

                // Only apply if text is selected
                if (selection[0] !== selection[1]) {
                    // Remove all font size classes first
                    const fontSizeClasses = ['font-small', 'font-normal', 'font-large', 'font-xlarge', 'font-xxlarge'];
                    fontSizeClasses.forEach(cls => {
                        trixEditor.editor.deactivateAttribute(cls);
                    });

                    // Add new font size
                    trixEditor.editor.activateAttribute(e.target.value);
                }

                // Reset select
                e.target.value = '';
            }
        });
    }

    /**
     * Text alignment functions
     */
    function alignText(alignClass) {
        if (trixEditor) {
            const alignClasses = ['text-left', 'text-center', 'text-right', 'text-justify'];

            // Remove all alignment classes
            alignClasses.forEach(cls => {
                trixEditor.editor.deactivateAttribute(cls);
            });

            // Add new alignment
            trixEditor.editor.activateAttribute(alignClass);
        }
    }

    /**
     * Setup image upload functionality
     */
    function setupImageUpload() {
        document.addEventListener('trix-attachment-add', function(event) {
            if (event.attachment.file) {
                uploadImage(event.attachment);
            }
        });
    }

    /**
     * Upload image to server
     */
    function uploadImage(attachment) {
        const formData = new FormData();
        formData.append('file', attachment.file);

        // Set progress
        attachment.setUploadProgress(0);

        fetch(uploadUrl, {
            method: 'POST',
            body: formData,
            headers: csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {}
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Upload failed');
            }
            return response.json();
        })
        .then(data => {
            attachment.setAttributes({
                url: data.url,
                href: data.url
            });
        })
        .catch(error => {
            console.error('Upload error:', error);
            alert('Failed to upload image. Please try again.');
            attachment.remove();
        });
    }

    /**
     * Insert image from URL
     */
    function insertImageFromUrl() {
        const url = prompt('Enter image URL:');
        if (url && trixEditor) {
            const attachment = new Trix.Attachment({ url: url, contentType: "image" });
            trixEditor.editor.insertAttachment(attachment);
        }
    }

    /**
     * Insert file attachment button click
     */
    function triggerFileUpload() {
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/*';
        input.onchange = function(e) {
            const file = e.target.files[0];
            if (file && trixEditor) {
                const attachment = new Trix.Attachment({ file: file });
                trixEditor.editor.insertAttachment(attachment);
            }
        };
        input.click();
    }

    /**
     * Get editor content
     */
    function getContent() {
        return trixEditor ? trixEditor.value : '';
    }

    /**
     * Set editor content
     */
    function setContent(html) {
        if (trixEditor) {
            trixEditor.value = html;
        }
    }

    /**
     * Clear editor content
     */
    function clearContent() {
        if (trixEditor) {
            trixEditor.value = '';
        }
    }

    /**
     * Set upload URL
     */
    function setUploadUrl(url) {
        uploadUrl = url;
    }

    /**
     * Set CSRF token
     */
    function setCsrfToken(token) {
        csrfToken = token;
    }

    // Public API
    return {
        init,
        alignText,
        insertImageFromUrl,
        triggerFileUpload,
        getContent,
        setContent,
        clearContent,
        setUploadUrl,
        setCsrfToken
    };
})();

// Auto-initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function() {
        TrixCustom.init();
    });
} else {
    TrixCustom.init();
}

// Make alignment function globally accessible for inline onclick handlers
window.alignText = TrixCustom.alignText;
