<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white min-h-screen p-8">

<div class="max-w-3xl mx-auto">

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="bg-green-600 p-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    {{-- ERROR MESSAGE --}}
    @if($errors->any())
        <div class="bg-red-600 p-3 rounded mb-6">
            <ul class="text-sm">
                @foreach($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-zinc-900 p-8 rounded-2xl shadow-xl space-y-6">

        <h1 class="text-2xl font-bold text-center">Edit Profile</h1>

        <form action="{{ route('akun.update') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-6">
            @csrf

            {{-- FOTO PROFILE --}}
            <div class="text-center">
                <div id="drop-area"
                     class="w-40 h-40 mx-auto rounded-full border-2 border-dashed border-gray-600 flex items-center justify-center cursor-pointer hover:border-white transition overflow-hidden">

                    <input type="file" name="avatar" id="fileInput" hidden>

                    @php
                        $avatar = $profile->avatar ?? null;
                    @endphp

                    @if($avatar)
                        <img id="preview"
                             src="{{ asset('profile/'.$avatar) }}"
                             class="w-full h-full object-cover">
                    @else
                        <span id="placeholder" class="text-gray-400 text-sm">
                            Upload Photo
                        </span>
                        <img id="preview"
                             class="hidden w-full h-full object-cover">
                    @endif

                </div>

                <p class="text-xs text-gray-500 mt-2">
                    JPG, PNG max 2MB
                </p>
            </div>

            {{-- NAME --}}
            <div>
                <label class="text-sm text-gray-400">Name</label>
                <input type="text"
                       name="name"
                       value="{{ old('name', $user->name) }}"
                       class="w-full bg-zinc-800 p-3 rounded text-white mt-1"
                       required>
            </div>

            {{-- STATUS / BIO --}}
            <div>
                <label class="text-sm text-gray-400">Status / Bio</label>
                <textarea name="status"
                          rows="3"
                          class="w-full bg-zinc-800 p-3 rounded text-white mt-1"
                          placeholder="Tell something about you...">{{ old('status', $profile->status ?? '') }}</textarea>
            </div>

            {{-- PRIVATE ACCOUNT --}}
            <div class="flex items-center justify-between bg-zinc-800 p-3 rounded">
                <span>Private Account</span>

                <input type="hidden" name="is_private" value="0">

                <input type="checkbox"
                       name="is_private"
                       value="1"
                       class="w-5 h-5"
                       {{ old('is_private', $user->is_private) ? 'checked' : '' }}>
            </div>

            {{-- BUTTON --}}
            <button type="submit"
                    class="w-full bg-white text-black font-bold py-3 rounded hover:bg-gray-300 transition">
                Update Profile
            </button>

        </form>
    </div>
</div>

<script>
const dropArea = document.getElementById("drop-area");
const fileInput = document.getElementById("fileInput");
const preview = document.getElementById("preview");
const placeholder = document.getElementById("placeholder");

dropArea.addEventListener("click", () => fileInput.click());

fileInput.addEventListener("change", function() {
    showPreview(this.files[0]);
});

function showPreview(file) {
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
        preview.src = e.target.result;
        preview.classList.remove("hidden");
        if (placeholder) placeholder.style.display = "none";
    }
    reader.readAsDataURL(file);
}
</script>
</body>
</html>