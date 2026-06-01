<!-- Container Utama (Animasi cukup dipasang di sini saja) -->
<div class="animate-fade-in-smooth w-full min-h-screen bg-white py-8 px-4 flex flex-col gap-4">

    <!-- Perbaikan: Mengubah tag 'a' menjadi 'form' agar input email bisa diketik dengan normal -->
    <form action="#" class="bg-[#0D2031] block w-full max-w-6xl mx-auto p-8 md:p-20 rounded-3xl border border-gray-800 shadow-md hover:shadow-xl transition duration-300">

        <h5 class="mb-2 text-3xl font-bold text-white">
            Join The Community
        </h5>

        <!-- Deskripsi -->
        <p class="text-gray-300 mb-6 max-w-2xl">
            Get exclusive discount codes, new arrival updates, and more.
        </p>

        <!-- Input Section -->
        <div class="max-w-md">
            <!-- Perbaikan: Mengubah text-gray-900 menjadi text-gray-200 agar terbaca di background gelap -->
            <label for="email" class="block mb-2 text-sm font-medium text-gray-200">
                Your Email
            </label>
            
            <div class="flex flex-col sm:flex-row gap-3">
                <input type="email" id="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-3" placeholder="email" required>
                
                <!-- Tambahan: Tombol submit agar form berfungsi sempurna -->
                <button type="submit" class="bg-white text-[#0D2031] hover:bg-gray-100 font-semibold text-sm px-6 py-3 rounded-lg transition duration-200 whitespace-nowrap">
                    Subscribe
                </button>
            </div>
        </div>

    </form>
</div>

