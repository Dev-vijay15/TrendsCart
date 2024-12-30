@extends('backend.layouts.app')
@section('content')
<style>
    /* Preview image styles */
#imgpreview {
    margin-top: 20px;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
}

#imgpreview img {
    max-width: 100%;
    height: auto;
    border-radius: 5px;
    margin-bottom: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Delete button styles */
#deleteImage {
    background-color: #dc3545;
    color: #fff;
    border: none;
    padding: 8px 16px;
    font-size: 14px;
    cursor: pointer;
    border-radius: 4px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

#deleteImage:hover {
    background-color: #c82333;
}

#deleteImage:focus {
    outline: none;
}
background-color{
    darkred;
} 


</style>
    <!-- main-content-wrap -->
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Brand infomation</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="#">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="#">
                            <div class="text-tiny">Brands</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">New Brand</div>
                    </li>
                </ul>
            </div>
            <!-- new-category -->
            <div class="wg-box">
                <form class="form-new-brand form-style-1" action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="name">
                        <div class="body-title">Brand Name <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Brand Name" name="name" tabindex="0"
                            value="" aria-required="true" required="">
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title">Brand Slug <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Brand Slug" name="slug" tabindex="0"
                            value="" aria-required="true" required="">
                    </fieldset>
                    <fieldset>
                        <div class="body-title">Upload images <span class="tf-color-1">*</span></div>
                        <div class="upload-image flex-grow">
                            <!-- Image preview container -->
                            <div class="item" id="imgpreview" style="display:none; text-align: center;">
                                <img src="" class="effect8" alt="Preview Image" style="max-width: 100%; height: auto; border-radius: 5px;">
                                <!-- Delete button positioned below the image -->
                                <button type="button" id="deleteImage" class="delete-btn">
                                    Delete
                                </button>
                            </div>
                            <!-- Upload file input -->
                            <div id="upload-file" class="item up-load">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">Drop your images here or select <span class="tf-color">click to browse</span></span>
                                    <input type="file" id="myFile" name="image" accept="image/*">
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    
                    
                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /main-content-wrap -->
@endsection

@push('scripts')

@endpush
