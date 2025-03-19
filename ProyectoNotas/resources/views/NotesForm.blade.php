<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note Registration</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-semibold mb-4">Register a New Notes</h2>
        <form>
           
            <div class="">
                <div class="mb-4">
                    <label class="block text-gray-700">Title</label>
                    <input type="text" class="w-full p-2 border rounded-lg" placeholder="Enter title" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Date</label>
                    <input type="date" class="w-full p-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Content</label>
                    <textarea class="w-full p-2 border rounded-lg" rows="4" placeholder="Enter note content" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Tags</label>
                    <input type="text" class="w-full p-2 border rounded-lg" placeholder="#tag1 #tag2">
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg mb-5">Registrar Nota</button>                
            </div>
        </form>
        <a href="{{route('notes.index')}}"><button type="submit" class="w-[50%] bg-red-500 hover:bg-red-800 text-white p-2 rounded-lg mb-5">Regresar</button></a>

    </div>
</body>
</html>
