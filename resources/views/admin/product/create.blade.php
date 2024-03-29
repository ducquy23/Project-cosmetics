@extends('admin.layout.master')

@section('content')
    <style>
    #container {
        width: 1000px;
        margin: 20px auto;
    }
    .ck-editor__editable[role="textbox"] {
        /* editing area */
        min-height: 400px;
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
                <h5 class="card-title fw-semibold mb-4">Sản phẩm</h5>
                <form method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên sản phẩm 
                            <span class="text-danger">*</span> 
                        </label>
                        <input type="text" class="form-control" name="name" id="name">
                        @error('name')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="product_code" class="form-label">Mã sản phẩm
                            <span class="text-danger">*</span> 
                        </label>
                        <input type="text" class="form-control" name="product_code" id="product_code">
                        @error('product_code')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Danh mục
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-select" name="category_id" id="category">
                            <option value="" disabled selected>--- Chọn danh mục ---</option>
                            @foreach ($categories as $category)
                                <option style="font-weight: 600; color: #000;" disabled>{{$category->name}}</option>
                                @if ($category->children)
                                    @foreach ($category->children as $child_cate)
                                        <option value="{{$child_cate->id}}">{{$child_cate->name}}</option>
                                    @endforeach
                                @endif
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="origin" class="form-label">Nơi sản xuất
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-select" name="origin_id" id="origin">
                            <option value="" disabled selected>--- Chọn nơi sản xuất ---</option>
                            @foreach ($origins as $origin)
                                <option value="{{$origin->id}}">{{$origin->name}}</option>
                            @endforeach
                        </select>
                        @error('origin_id')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="brand" class="form-label">Thương hiệu
                            <span class="text-danger">*</span>
                        </label>
                        <select class="form-select" name="brand_id" id="brand">
                            <option value="" disabled selected>--- Chọn thương hiệu ---</option>
                            @foreach ($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="initial_price" class="form-label">Giá gốc
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="initial_price" id="initial_price">
                        @error('initial_price')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="discount" class="form-label">Chiết khấu (%)</label>
                        <input type="text" value="0" class="form-control" name="discount" id="discount">
                        @error('discount')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Giá bán <small>(sau chiết khấu)</small>
                            <span class="text-danger">*</span>
                        </label>
                        <input type="number" class="form-control" name="price" id="price" disabled readonly>
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Số lượng
                            <span class="text-danger">*</span>
                        </label>
                        <input type="number" class="form-control" name="quantity" id="quantity">
                        @error('quantity')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="skin_type" class="form-label">Loại da</label>
                        <select class="form-select" name="skin_type" id="skin_type">
                            <option value="">--- Chọn loại da ---</option>
                            <option value="mọi loại da">Mọi loại da</option>
                            <option value="da thường">Da thường</option>
                            <option value="da khô">Da khô</option>
                            <option value="da dầu">Da dầu</option>
                            <option value="da hỗn hợp">Da hỗn hợp</option>
                            <option value="da nhạy cảm">Da nhạy cảm</option>
                        </select>
                        @error('skin_type')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="texture" class="form-label">Kết cấu</label>
                        <select class="form-select" name="texture" id="texture">
                            <option value="">--- Chọn kết cấu ---</option>
                            <option value="dạng kem">Dạng kem</option>
                            <option value="dạng gel">Dạng gel</option>
                            <option value="dạng dầu">Dạng dầu</option>
                            <option value="dạng sữa">Dạng sữa</option>
                            <option value="dạng hạt">Dạng hạt</option>
                            <option value="dạng bọt">Dạng bọt</option>
                        </select>
                        @error('texture')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả
                            <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" name="description" id="editor"></textarea>
                        @error('description')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label me-2">Hình ảnh
                            <span class="text-danger">*</span>
                            <small class="text-warning ps-2 ">(Sử dụng Ctrl để thêm nhiều ảnh)</small>
                        </label>
                        <input type="file" name="images[]" class="form-control" id="imageInput" accept="image/jpg, image/jpeg, image/png, image/webp" multiple />
                        @error('images')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        <div id="imagePreview"></div>
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/super-build/ckeditor.js"></script>
        
    <script>
        CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
            
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
        });
    </script>

@endsection