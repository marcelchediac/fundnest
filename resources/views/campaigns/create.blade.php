
<x-layout>
   @if(session('success'))
<div id="successToast"  class="alert-success-box">
    <i class="bi bi-check-circle-fill me-2"></i>
    {{ session('success') }}
</div>
@endif

 <main class="d-flex w-100 align-items-center justify-content-center"
        style="min-height:100vh;
        background:linear-gradient(rgba(18, 18, 221, 0.78),rgba(71, 18, 123, 0.16)),
        url('{{asset('images/charity day.jpg')}}') center/cover no-repeat;">

    <form class ="form-card" action="{{ route('campaign.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <h2 class="text-center mb-4 text-primary" style="font-weight: 700;">Create a Campaign</h2>
    <h5 class="text-center mb-4">Help raise funds for meaningful causes</h5>

    <div class="mb-2">
     <label class="form-label fw-semibold">Campaign Title</label>
    <input type="text" name="title"  value="{{ old('title') }}"class="form-control @error('title') is-invalid @enderror" placeholder="Enter campaign title" required>
    @error('title')<small class="text-danger">{{ $message }}</small>@enderror
</div>

            <div class="mb-2">
            <label class="form-label fw-semibold">Description</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Describe your campaign" required>{{ old('description') }}</textarea>
            @error('description')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-2"> 
            <label class="form-label fw-semibold">Goal Amount ($)</label>
             <input type="number" name="goal_amount" value="{{ old('goal_amount') }}" class="form-control @error('goal_amount') is-invalid @enderror"
              placeholder="Minimum 500$" required>
               @error('goal_amount')<small class="text-danger">{{ $message }}</small>@enderror </div>

        <div class="mb-2">
           <label for="category">Category</label>
          <select name="category_id" id="category" class="form-control">
    <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Select a category</option>
    @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
    @endforeach
    <option value="other" {{ old('category_id') == 'other' ? 'selected' : '' }}>Other</option>
</select>
<input type="text" name="new_category" id="new_category" 
       placeholder="Enter your category" 
       style="margin-top:10px; display:{{ old('category_id') == 'other' ? 'block' : 'none' }};"
       value="{{ old('new_category') }}">
        </div>


<form method="POST" enctype="multipart/form-data">
    <div class="form-group">
    <label>Upload Supporting Document</label>
    <input type="file" name="documents[]" class="form-control" multiple>
    <small class="input-note"> Accepted formats: JPG, PNG, JPEG, PDF</small>
</div>

<div class="mb-3">
            <label class="form-label fw-semibold">Campaign Image</label>
        <input type="file" name="image" accept="/image*" class="form-control @error('image') is-invalid @enderror" onchange="previewImage(event)">
        <small class="input-note">
            Maximum image size: 2 MB
</small>
@if(old('image_path'))
    <img id="imagePreview" src="{{ asset('storage/' . old('image_path')) }}" 
         alt="Image Preview" style="display:block; margin-top:10px; max-height:150px; border-radius:10px;">
@else
    <img id="imagePreview" src="#" alt="Image Preview" style="display:none; margin-top:10px; max-height:150px; border-radius:10px;">
@endif
@error('image')<small class="text-danger">{{ $message }}</small>@enderror



        <div class="form-group">
    <label>Video</label>
   <input type="url" name="video_url" id="videoInput" class="form-control" placeholder="https://youtube.com/..." value="{{ old('video_url') }}">
    <small class="input-note"> Maximum video size: 150MB </small>

<div id="videoPreview" style="display:{{ old('video_url') ? 'block' : 'none' }}; margin-top:15px;">
    <iframe id="videoFrame"
            width="100%"
            height="250"
            style="border-radius:10px;"
            frameborder="0"
            allowfullscreen
            src="{{ old('video_url') ? str_replace('watch?v=', 'embed/', old('video_url')) : '' }}">
    </iframe>
</div>
</div>

         <button type="submit" class="btn btn-primary w-100 py-2" style="font-weight:600; transition: 0.3s;">Submit Campaign</button>
        </div>
</form>
</main>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');
        if(input.files && input.files[0]) {
            preview.src = URL.createObjectURL(input.files[0]);
            preview.style.display = 'block';
        }
    }

    const categorySelect = document.getElementById('category');
    const newCategoryInput = document.getElementById('new_category');

    categorySelect.addEventListener('change', function() {
        if (this.value === 'other') {
            newCategoryInput.style.display = 'block';
        } else {
            newCategoryInput.style.display = 'none';
        }
    });

const videoInput = document.getElementById('videoInput');
const videoPreview = document.getElementById('videoPreview');
const videoFrame = document.getElementById('videoFrame');

videoInput.addEventListener('input', function () {

    let url = this.value;

    if (url.includes("watch?v=")) {
        let embedUrl = url.replace("watch?v=", "embed/");
        videoFrame.src = embedUrl;
        videoPreview.style.display = "block";
    } else {
        videoPreview.style.display = "none";
        videoFrame.src = "";
    }
   });

    @if(session('success'))
    setTimeout(() => {
        window.location.href = "{{ route('home') }}";
    }, 2500);
    @endif

const category = document.getElementById("category");
const newCategory = document.getElementById("new_category");

category.addEventListener("change", function(){

if(this.value === "other"){
newCategory.style.display = "block";
}else{
newCategory.style.display = "none";
}
});

newCategory.addEventListener("input", function(){

this.value = this.value
.toLowerCase()
.replace(/\b\w/g, function(letter){
return letter.toUpperCase();
});
   });
</script>

<style>
    .alert-success-box {
    display: flex;
    align-items: center;
    background: linear-gradient(90deg, #7238ef, #11998e);
    color: #fff;
    padding:  0.75rem 1.25rem ;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.25);
    font-weight: 500;
    animation: slideFade 0.6s ease;
}

.alert-success-box i {
    font-size: 1.2rem;
}

.input-note{
    display:block;
    margin-top:5px;
    margin-bottom: 5px;
    font-size: 13px;
    color: #dbeafe;
}

@keyframes slideFade {
    0% { opacity: 0; transform: translateY(-10px); }
    100% { opacity: 1; transform: translateY(0); }
}

.form-card {
    background-color: rgba(18, 18, 221, 0.78);
    padding: 30px;
    border-radius: 10px;
    max-width: 400px;
    width: 100%;
    color: rgba(226, 226, 232, 0.83);
    box-shadow: 0 6px 20px rgba(11, 1, 1, 0.5);
}
.form-card input::placeholder {
    color: rgba(75, 72, 72, 0.9);
}
#videoPreview iframe {
    box-shadow: 0 6px 20px rgba(0,0,0,0.3);
}

</x-layout>
