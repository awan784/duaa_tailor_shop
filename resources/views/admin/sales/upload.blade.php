@extends('admin.layout.interface')

@section('content')
<div class="main_content_iner">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="dashboard_header mb_50">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="dashboard_header_title">
                                <h3>Upload Images for Sale #{{ $sale->id }}</h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="dashboard_breadcam text-end">
                                <p>
                                    <a href="{{ url('dashboard') }}">Dashboard</a>
                                    <i class="fas fa-caret-right"></i> Upload Images
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Upload Form --}}
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_body">
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <form action="{{ route('sales.storeUploadedImages') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="sale_id" value="{{ $sale->id }}">

                                <div class="mb-3">
                                    <label for="images" class="form-label">Select Images</label>
                                    <input type="file" name="images[]" id="images" class="form-control" multiple required>
                                    <div id="imagesPreview" class="image-preview"></div>
                                </div>

                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>

                            {{-- Existing Images --}}
                        @if($sale->images)
    <hr>
    <h5 class="mt-3">Existing Images</h5>
    <div class="d-flex flex-wrap mt-2">
        @foreach(json_decode($sale->images, true) as $img)
            <a href="{{ asset($img) }}" target="_blank">
                <img src="{{ asset($img) }}" width="100" height="100" class="m-2 border rounded" alt="Image">
            </a>
        @endforeach
    </div>
@endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
.image-preview {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 10px;
}
.image-preview img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border: 1px solid #ddd;
    border-radius: 5px;
}
</style>

@endsection

@section('js')
<script>
document.getElementById('images').addEventListener('change', function() {
    const preview = document.getElementById('imagesPreview');
    preview.innerHTML = '';
    Array.from(this.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.createElement('img');
            img.src = e.target.result;
            preview.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
});
</script>
@endsection
