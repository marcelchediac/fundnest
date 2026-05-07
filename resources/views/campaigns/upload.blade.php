<x-layout>
      <div class="upload-page">
        <div class="upload-card">
            <div class="upload-icon">📄</div>

            <h2>Upload Supporting Documents</h2>
            <p class="campaign-name">{{ $campaign->title }}</p>

            <p class="upload-note">
                Please upload clear documents that support your campaign request.
            </p>

            <form method="POST" action="{{ route('campaign.documents.store', $campaign) }}" enctype="multipart/form-data">
                @csrf

                <label class="file-box" id="fileBox">
                    <input type="file" name="documents[]" id="fileInput" multiple required>
                    <span id="fileText">Choose documents</span>
                    <small>PDF, JPG, PNG, Webp accepted</small>
                    <ul id="fileList"></ul>
                </label>

                <button type="submit" class="upload-submit">
                    Upload Documents
                </button>
            </form>
        </div>
    </div>

    <script>
const input = document.getElementById('fileInput');
const list = document.getElementById('fileList');
const text = document.getElementById('fileText');

input.addEventListener('change', function () {
    list.innerHTML = '';

    if (this.files.length > 0) {
    text.innerText = "Selected files:";

        Array.from(this.files).forEach(file => {
        const li = document.createElement('li');
        li.textContent = file.name;
        list.appendChild(li);
        });
    }
});
        </script>

    <style>
        .upload-page {
    min-height: calc(100vh - 70px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    background: linear-gradient(135deg, #0f2f73, #168bd3);
}

.upload-card {
    width: 100%;
    max-width: 520px;
    background: rgba(255, 255, 255, 0.95);
    padding: 40px;
    border-radius: 24px;
    text-align: center;
    box-shadow: 0 18px 45px rgba(0, 0, 0, 0.25);
}
upload-icon {
    font-size: 42px;
    margin-bottom: 10px;
}

.upload-card h2 {
    margin-bottom: 8px;
    color: #0f2f73;
}

.campaign-name {
    font-size:20px;
    font-weight: 800;
    color: #168bd3;
    margin-bottom: 12px;
}
.upload-note {
    color: #555;
    margin-bottom: 25px;
}

.file-box {
    display: block;
    padding: 28px;
    border: 2px dashed #168bd3;
    border-radius: 18px;
    cursor: pointer;
    margin-bottom: 22px;
    background: #f4fbff;
}

.file-box input {
    display: none;
}

.file-box span {
    display: block;
    font-weight: 700;
    color: #0f2f73;
    margin-bottom: 6px;
}

.file-box small {
    color: #777;
}

.upload-submit {
    width: 100%;
    border: none;
    padding: 14px;
    border-radius: 14px;
    background: linear-gradient(135deg, #38bdf8, #2563eb);
    color: white;
    font-weight: 700;
    cursor: pointer;
}

.upload-submit:hover {
    transform: translateY(-2px);
    opacity: 0.95;
}

#fileList{
    margin-top:10px;
    padding: 0;
    list-style: none;
    text-align: left;
}

#fileList li{
    font-size: 14px;
    color: #333;
    margin-bottom: 4px;
}
</style>
</x-layout>

