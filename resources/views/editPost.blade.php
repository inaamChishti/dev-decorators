@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>


        .custom_container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }


        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: #4469d3b5;
            color: #fff;
            border-bottom: none;
            padding: 15px 20px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            font-size: 20px;
            font-weight: bold;
        }

        .card-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        textarea {
            width: 100%;
            min-height: 120px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            font-size: 16px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        textarea:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .btncustom {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btncustom:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .post {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
            background-color: #fff;
        }

        .post:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .post-header {
            margin-bottom: 10px;
        }

        .post-header h5 {
            margin: 0;
            font-size: 20px;
            color: #333;
        }

        .post-time {
            font-size: 14px;
            color: #999;
        }

        .post-content {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .post-options {
            margin-top: 10px;
        }

        .post-options .btn {
            margin-right: 10px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .post-options .btn:hover {
            transform: translateY(-2px);
        }

        .fa-upload-icon {
            cursor: pointer;
            animation: bounce 1s infinite alternate;
        }

        @keyframes bounce {
            from {
                transform: translateY(-10px);
            }

            to {
                transform: translateY(0px);
            }
        }

        .image-preview-container {
            position: relative;
            margin-top: 20px;
        }

        .image-preview {
            width: 300px;
            height: 400px;
            border: 2px solid #ddd;
            border-radius: 10px;
            object-fit: cover;
            /* display: none; */
        }

        .postBtn {
            padding: 5px 20px;
        }

        .image-preview-container .cancel-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 576px) {
            .card {
                margin: 10px;
            }
        }


    </style>
 <div class="container custom_container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Edit Post
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('update-post/'.$post->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <textarea name="content" placeholder="Edit your post">{{ $post->content }}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="photo" name="photo" accept="image/*" onchange="previewImage(event)">
                                    <label class="custom-file-label" for="photo">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="image-preview-container">
                            {{-- <input type="hidden" name="old_image_path" id="{{$post->photo}}"> --}}
                            @if ($post->photo)
                                <img id="imagePreview" class="image-preview offset-md-4" src="{{ asset($post->photo) }}" alt="Image Preview">
                            @else
                                <img id="imagePreview" class="image-preview offset-md-4" src="#" alt="Image Preview" style="display: none;">
                            @endif
                            <button type="button" class="cancel-btn" style="display: none;" id="cancelImage">&times;</button>
                        </div>
                        <button type="submit" class="btn btncustom postBtn">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var imgElement = document.getElementById('imagePreview');
            imgElement.src = reader.result;
            imgElement.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection
