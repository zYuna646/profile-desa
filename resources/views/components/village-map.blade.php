@props(['mapUrl' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.56347862248!2d107.57311709235512!3d-6.903444341687889!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a1f93d3e815b2!2sBandung%2C%20Bandung%20City%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1654612465830!5m2!1sen!2sid'])

<div class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-jordy-blue-900 mb-4">Peta Desa</h2>
            <p class="text-jordy-blue-700 max-w-2xl mx-auto">Lokasi strategis desa kami dengan berbagai fasilitas dan akses yang mudah dijangkau.</p>
        </div>
        
        <div class="relative rounded-xl overflow-hidden shadow-lg">
            <!-- Decorative elements -->
            <div class="absolute -top-10 -left-10 w-40 h-40 bg-jordy-blue-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
            <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-jordy-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
            
            <!-- Map container with gradient border -->
            <div class="p-1 bg-gradient-to-r from-jordy-blue-300 to-jordy-blue-500 rounded-xl">
                <div class="relative aspect-video w-full overflow-hidden rounded-lg">
                    <iframe 
                        src="{{ $mapUrl }}" 
                        class="absolute inset-0 w-full h-full border-0" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Peta Desa">
                    </iframe>
                </div>
            </div>
            
            <!-- Map overlay for interaction hints -->
            <div class="absolute inset-0 bg-gradient-to-t from-jordy-blue-900/30 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-8">
                <div class="bg-white/90 px-4 py-2 rounded-full shadow-lg">
                    <p class="text-jordy-blue-800 text-sm">Klik untuk melihat peta interaktif</p>
                </div>
            </div>
        </div>
        
        <div class="mt-8 grid md:grid-cols-3 gap-6 text-center">
            <div class="p-4">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-jordy-blue-100 text-jordy-blue-600 mb-4">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="font-bold text-jordy-blue-900">Lokasi Strategis</h3>
                <p class="text-jordy-blue-700 text-sm">Terletak di pusat aktivitas dengan akses mudah ke berbagai fasilitas.</p>
            </div>
            <div class="p-4">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-jordy-blue-100 text-jordy-blue-600 mb-4">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1v-5h2a1 1 0 00.9-.5l1.5-2A1 1 0 0015 7h-1V6a1 1 0 00-1-1h-2.05a2.5 2.5 0 01-4.9 0H3zM9 6a1 1 0 100 2 1 1 0 000-2z" />
                    </svg>
                </div>
                <h3 class="font-bold text-jordy-blue-900">Transportasi</h3>
                <p class="text-jordy-blue-700 text-sm">Tersedia berbagai moda transportasi untuk memudahkan mobilitas.</p>
            </div>
            <div class="p-4">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-jordy-blue-100 text-jordy-blue-600 mb-4">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4zm3 1h6v4H7V5zm8 8v2h1v1H4v-1h1v-2H4v-1h16v1h-1z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="font-bold text-jordy-blue-900">Fasilitas</h3>
                <p class="text-jordy-blue-700 text-sm">Dilengkapi dengan fasilitas umum untuk mendukung kebutuhan masyarakat.</p>
            </div>
        </div>
    </div>
</div>
