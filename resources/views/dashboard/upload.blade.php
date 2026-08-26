<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gallery Upload</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white min-h-screen p-8">

<div class="max-w-4xl mx-auto">

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="bg-green-600 p-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORM UPLOAD --}}
    <form action="{{ route('gallery.store') }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="bg-zinc-900 p-6 rounded-xl shadow-xl space-y-4">
        @csrf

        {{-- DRAG & DROP AREA --}}
        <div id="drop-area" 
             class="border-2 border-dashed border-gray-600 rounded-lg p-10 text-center cursor-pointer hover:border-white transition">
            <p class="text-gray-400">Choose a file or drag and drop it here</p>
            <p class="text-xs text-gray-500">JPG, PNG max 20MB</p>

            <input type="file" name="image" id="fileInput" hidden required>

            <img id="preview" 
                 class="mx-auto mt-4 hidden max-h-60 rounded-lg"/>
        </div>

        {{-- TITLE --}}
        <input type="text" 
               name="title" 
               placeholder="Add a title"
               class="w-full bg-zinc-800 p-3 rounded text-white"
               required>

        {{-- DESCRIPTION --}}
        <textarea name="description"
                  placeholder="Description"
                  class="w-full bg-zinc-800 p-3 rounded text-white"></textarea>

        {{-- TAGS --}}
        <input type="text"
               name="tags"
               placeholder="Tags (pisahkan dengan koma)"
               class="w-full bg-zinc-800 p-3 rounded text-white">

        {{-- CATEGORY --}}
        <input type="text"
               name="category"
               placeholder="Category"
               class="w-full bg-zinc-800 p-3 rounded text-white">

        {{-- TOGGLES --}}
        <div class="flex items-center justify-between bg-zinc-800 p-3 rounded">
            <span>Keep this Pin private</span>
            <input type="checkbox" name="is_private" value="1" class="w-5 h-5">
        </div>

        <div class="flex items-center justify-between bg-zinc-800 p-3 rounded">
            <span>Allow downloads</span>
            <input type="checkbox" name="allow_download" value="1" class="w-5 h-5">
        </div>

        {{-- SUBMIT --}}
        <button type="submit"
                class="w-full bg-white text-black font-bold py-3 rounded hover:bg-gray-300 transition">
            Publish
        </button>
    </form>

    {{-- GALERI --}}
    @if(!empty($images))
    <div class="mt-12 grid grid-cols-2 md:grid-cols-3 gap-6">
        @foreach($images as $img)

            @php
                $isPrivate = $img['is_private'] ?? false;
                $allowDownload = $img['allow_download'] ?? false;
                $imagePath = $img['url'] ?? null;
            @endphp

            @if(!$isPrivate && $imagePath)
                <div class="bg-zinc-900 p-3 rounded-lg shadow hover:scale-105 transition">

                    {{-- IMAGE --}}
                    <img src="{{ asset($imagePath) }}" 
                         class="rounded-lg mb-2 w-full object-cover">

                    {{-- TITLE --}}
                    <h3 class="font-bold">
                        {{ $img['title'] ?? 'No Title' }}
                    </h3>

                    {{-- DESCRIPTION --}}
                    @if(!empty($img['description']))
                        <p class="text-sm text-gray-400">
                            {{ $img['description'] }}
                        </p>
                    @endif

                    {{-- DOWNLOAD --}}
                    @if($allowDownload)
                        <a href="{{ asset($imagePath) }}" 
                           download
                           class="text-xs text-blue-400 hover:underline">
                           Download
                        </a>
                    @endif

                </div>
            @endif

        @endforeach
    </div>
    @endif

</div>

{{-- SCRIPT DRAG & DROP --}}
<script>
const dropArea = document.getElementById("drop-area");
const fileInput = document.getElementById("fileInput");
const preview = document.getElementById("preview");

dropArea.addEventListener("click", () => fileInput.click());

dropArea.addEventListener("dragover", e => {
    e.preventDefault();
    dropArea.classList.add("border-white");
});

dropArea.addEventListener("dragleave", () => {
    dropArea.classList.remove("border-white");
});

dropArea.addEventListener("drop", e => {
    e.preventDefault();
    dropArea.classList.remove("border-white");

    const files = e.dataTransfer.files;
    fileInput.files = files;
    showPreview(files[0]);
});

fileInput.addEventListener("change", function() {
    showPreview(this.files[0]);
});

function showPreview(file) {
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
        preview.src = e.target.result;
        preview.classList.remove("hidden");
    }
    reader.readAsDataURL(file);
}
</script>

</body>
</html>