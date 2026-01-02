@extends('admin.layout.master')

@section('content')
    <style>
        #container {
            width: 1000px;
            margin: 20px auto;
        }
        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 600px;
        }
        .ck-content .image {
            /* block images */
            max-width: 80%;
            margin: 20px auto;
        }
    </style>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Chỉnh sửa trang Giới thiệu</h5>
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form method="POST" action="{{route('page.update', $type)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" id="title" value="{{old('title', $page->title)}}" onkeyup="generateSlug(this.value)" required>
                        @error('title')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug (URL)</label>
                        <input type="text" name="slug" class="form-control" id="slug" value="{{old('slug', $page->slug)}}" placeholder="Tự động tạo từ tiêu đề">
                        <small class="form-text text-muted">Để trống sẽ tự động tạo từ tiêu đề</small>
                        @error('slug')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Nội dung <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="content" id="content" rows="10">{{old('content', $page->content)}}</textarea>
                        @error('content')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label me-2">Hình ảnh</label>
                        <input type="file" name="thumbnail" class="form-control" id="product-img" accept="image/*" />
                        @error('thumbnail')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        @if($page->thumbnail)
                            <img id="imagePreview" class="m-3 rounded-1" src="{{asset('storage/' . $page->thumbnail)}}" width="250">
                        @else
                            <img id="imagePreview" class="m-3 rounded-1" style="display:none;" width="250">
                        @endif
                    </div>
                    
                    <hr>
                    <h6 class="fw-semibold mb-3">SEO Settings</h6>
                    
                    <div class="mb-3">
                        <label for="meta_title" class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control" id="meta_title" value="{{old('meta_title', $page->meta_title)}}" maxlength="60">
                        <small class="form-text text-muted">Tối đa 60 ký tự</small>
                        @error('meta_title')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea class="form-control" name="meta_description" id="meta_description" rows="3" maxlength="160">{{old('meta_description', $page->meta_description)}}</textarea>
                        <small class="form-text text-muted">Tối đa 160 ký tự</small>
                        @error('meta_description')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                        <input type="text" name="meta_keywords" class="form-control" id="meta_keywords" value="{{old('meta_keywords', $page->meta_keywords)}}" placeholder="keyword1, keyword2, keyword3">
                        @error('meta_keywords')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/super-build/ckeditor.js"></script>
        
    <script>
        let editorInstance;
        let ckEditorLoaded = false;
        
        // Initialize CKEditor after DOM and script are ready
        document.addEventListener('DOMContentLoaded', function() {
            // Wait a bit for CKEditor script to load
            setTimeout(function() {
                if (typeof CKEDITOR !== 'undefined' && CKEDITOR.ClassicEditor) {
                    const contentElement = document.getElementById("content");
                    if (contentElement) {
                        CKEDITOR.ClassicEditor.create(contentElement, {
            toolbar: {
                items: [
                    'exportPDF','exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            },
            placeholder: '',
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            fontSize: {
                options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                supportAllValues: true
            },
            htmlSupport: {
                allow: [
                    {
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }
                ]
            },
            htmlEmbed: {
                showPreviews: true
            },
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            mention: {
                feeds: [
                    {
                        marker: '@',
                        feed: [
                            '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                            '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                            '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                            '@sugar', '@sweet', '@topping', '@wafer'
                        ],
                        minimumCharacters: 1
                    }
                ]
            },
            removePlugins: [
                'CKBox',
                'CKFinder',
                'EasyImage',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                'MathType',
                'SlashCommand',
                'Template',
                'DocumentOutline',
                'FormatPainter',
                'TableOfContents',
                'PasteFromOfficeEnhanced'
            ]
                        }).then(editor => {
                            editorInstance = editor;
                            ckEditorLoaded = true;
                            console.log('CKEditor initialized successfully');
                            
                            // Remove required attribute from textarea since CKEditor handles it
                            const contentTextarea = document.getElementById('content');
                            if (contentTextarea) {
                                contentTextarea.removeAttribute('required');
                            }
                        }).catch(error => {
                            console.error('Error initializing CKEditor:', error);
                            ckEditorLoaded = false;
                        });
                    } else {
                        console.error('Content textarea not found');
                        ckEditorLoaded = false;
                    }
                } else {
                    console.error('CKEDITOR is not defined. CDN may not have loaded.');
                    ckEditorLoaded = false;
                }
            }, 100);
        });
    </script>
    
    <script>
        function generateSlug(title) {
            if (document.getElementById('slug').value === '{{$page->slug ?? ''}}' || document.getElementById('slug').value === '') {
                const slug = title
                    .toLowerCase()
                    .normalize('NFD')
                    .replace(/[\u0300-\u036f]/g, '')
                    .replace(/đ/g, 'd')
                    .replace(/Đ/g, 'D')
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim();
                document.getElementById('slug').value = slug;
            }
        }
        
        // Preview image
        const productImgInput = document.getElementById('product-img');
        if (productImgInput) {
            productImgInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = document.getElementById('imagePreview');
                        if (preview) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                        }
                    }
                    reader.readAsDataURL(file);
                }
            });
        }
        
        // Update textarea with CKEditor content before form submission
        document.addEventListener('DOMContentLoaded', function() {
            try {
                const form = document.querySelector('form[method="POST"]');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        try {
                            console.log('Form submit triggered');
                            
                            const contentTextarea = document.getElementById('content');
                            const titleInput = document.getElementById('title');
                            
                            // Validate title
                            if (titleInput && !titleInput.value.trim()) {
                                e.preventDefault();
                                alert('Vui lòng nhập tiêu đề!');
                                titleInput.focus();
                                return false;
                            }
                            
                            // Sync CKEditor content to textarea and validate
                            let contentValue = '';
                            if (ckEditorLoaded && editorInstance) {
                                try {
                                    contentValue = editorInstance.getData().trim();
                                    // Update textarea with CKEditor content before submission
                                    if (contentTextarea) {
                                        contentTextarea.value = editorInstance.getData();
                                    }
                                    console.log('CKEditor content synced, length:', contentValue.length);
                                } catch (error) {
                                    console.error('Error getting CKEditor data:', error);
                                    contentValue = contentTextarea ? contentTextarea.value.trim() : '';
                                }
                            } else if (contentTextarea) {
                                contentValue = contentTextarea.value.trim();
                                console.log('Using textarea directly, length:', contentValue.length);
                            }
                            
                            // Validate content
                            if (!contentValue) {
                                e.preventDefault();
                                alert('Vui lòng nhập nội dung!');
                                if (ckEditorLoaded && editorInstance) {
                                    editorInstance.focus();
                                } else if (contentTextarea) {
                                    contentTextarea.focus();
                                }
                                return false;
                            }
                            
                            console.log('Form validation passed, submitting...');
                            // Don't prevent default - allow form to submit normally
                            return true;
                        } catch (error) {
                            console.error('Error in form submit handler:', error);
                            // On error, still try to sync content and submit
                            if (ckEditorLoaded && editorInstance) {
                                try {
                                    const contentTextarea = document.getElementById('content');
                                    if (contentTextarea) {
                                        contentTextarea.value = editorInstance.getData();
                                    }
                                } catch (syncError) {
                                    console.error('Error syncing content:', syncError);
                                }
                            }
                            // Don't prevent default, let form submit anyway
                            return true;
                        }
                    });
                } else {
                    console.error('Form not found');
                }
            } catch (error) {
                console.error('Error setting up form submit handler:', error);
            }
        });
    </script>
@endsection

