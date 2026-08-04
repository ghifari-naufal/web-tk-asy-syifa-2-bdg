<footer id="kontak" class="relative text-gray-50 overflow-hidden">
        <div class="absolute inset-0 opacity-100">
            <img src="{{ asset('assets/bgfooter.jpeg') }}" alt="Latar Belakang Footer" class="w-full h-full object-cover">
        </div>

        <div class="absolute inset-0 bg-lime-600 opacity-80"></div>

        <div class="relative z-10 py-12 lg:py-16">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                        <div>
                            <h3 class="text-xl font-bold mb-6">Informasi</h3>
                            <ul class="space-y-3">
                                <li><a href="{{ route('informasi.kalender') }}" class="hover:text-gray-800 font-medium transition-colors duration-200">Kalender Kegiatan</a></li>
                                <li><a href="{{ route('informasi.kegiatan') }}" class="hover:text-gray-800 font-medium transition-colors duration-200">Kegiatan</a></li>
                            </ul>
                        </div>

                        <div>
                            <h3 class="text-xl font-bold mb-6">Tentang</h3>
                            <ul class="space-y-3">
                                <li><a href="{{ route('tentang.sejarah') }}" class="hover:text-gray-800 font-medium transition-colors duration-200">Sejarah</a></li>
                                <li><a href="{{ route('tentang.visimisi') }}" class="hover:text-gray-800 font-medium transition-colors duration-200">Visi dan Misi</a></li>
                            </ul>
                        </div>

                        <div>
                            <h3 class="text-xl font-bold mb-6">Kontak Kami</h3>
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <i class="fas fa-map-marker-alt mt-1 text-lime-300"></i>
                                    <span class="text-sm font-medium">
                                        Jl. Babakan Sari No.126,<br>
                                        Babakan Sari, Kec. Kiaracondong,<br>
                                        Kota Bandung, Jawa Barat 40283
                                    </span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-phone text-lime-300"></i>
                                    <span class="text-sm font-medium">(022) 7102018</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-mobile-alt text-lime-300"></i>
                                    <span class="text-sm font-medium">+62 858-606-222</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-envelope text-lime-300"></i>
                                    <a href="mailto:tkasysyifa2bdg@gmail.com"
                                        class="text-sm font-medium hover:text-gray-800 transition-colors duration-200">
                                        tkasysyifa2bdg@gmail.com
                                    </a>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <i class="fas fa-clock mt-1 text-lime-300"></i>
                                    <div class="text-sm font-medium space-y-1">
                                        <p>Senin: 09.00 – 14.00</p>
                                        <p>Selasa – Jumat: 08.00 – 14.00</p>
                                        <p>Sabtu – Minggu: Tutup</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-xl font-bold mb-6">Maps</h3>
                            <div class="bg-white rounded-md overflow-hidden w-full h-[200px] shadow-lg mb-3">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.671373512211!2d107.65342837497184!3d-6.931109967848618!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e7e24c122d73%3A0xc708058011285444!2sTK%20Asy%20Syifa%202!5e0!3m2!1sid!2sid!4v1717471201917!5m2!1sid!2sid"
                                    class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                            <div>
                                <a href="https://www.google.com/maps/dir/?api=1&destination=TK+Asy+Syifa+2"
                                    class="inline-flex items-center text-sm text-gray-50 font-semibold hover:text-gray-800 transition-colors duration-200">
                                    <i class="fas fa-directions mr-2"></i>
                                    Dapatkan Petunjuk Arah
                                </a>
                            </div>
                        </div>

                    </div>
                    <div
                        class="mt-12 pt-8 border-t border-white flex flex-col md:flex-row justify-between items-center text-center md:text-left">
                        <p class="text-sm text-gray-50 mb-4 md:mb-0">
                            © 2025 TK ASY-SYIFA 2. Semua hak dilindungi.
                        </p>
                        <div class="flex space-x-4">
                            <a href="https://www.facebook.com/people/TK-Asy-Syifa-2-Bandung/100063806730438/"
                                rel="noopener noreferrer" aria-label="Facebook"
                                class="w-10 h-10 rounded-full border border-white flex items-center justify-center text-gray-50 hover:text-gray-50 hover:bg-blue-800 transition-colors duration-300">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://www.instagram.com/tkasysyifa2" rel="noopener noreferrer" aria-label="Instagram"
                                class="w-10 h-10 rounded-full border border-white flex items-center justify-center text-gray-50 hover:text-gray-50 hover:bg-orange-700 transition-colors duration-300">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" aria-label="YouTube"
                                class="w-10 h-10 rounded-full border border-white flex items-center justify-center text-gray-50 hover:text-gray-50 hover:bg-red-600 transition-colors duration-300">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="#" aria-label="TikTok"
                                class="w-10 h-10 rounded-full border border-white flex items-center justify-center text-gray-50 hover:text-gray-50 hover:bg-black transition-colors duration-300">
                                <i class="fab fa-tiktok"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <button class="scroll-to-top" aria-label="Kembali ke atas">
        <i class="fas fa-arrow-up"></i>
    </button>
</body>
</html>

<script>
document.addEventListener('DOMContentLoaded', function() {

// --- Fungsi Waktu ---
function updateWaktu() {
    const now = new Date();
    const optionsDate = {
        timeZone: 'Asia/Jakarta',
        weekday: 'long',
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    };
    const optionsTime = {
        timeZone: 'Asia/Jakarta',
        hour: '2-digit',
        minute: '2-digit',
        hour12: false
    };

    const formattedDate = now.toLocaleDateString('id-ID', optionsDate);
    const formattedTime = now.toLocaleTimeString('id-ID', optionsTime).replace('.', ':');
    const waktuElement = document.getElementById('waktuWIB');

    if (waktuElement) {
        waktuElement.textContent = `${formattedDate} | ${formattedTime} WIB`;
    }
}
updateWaktu();
setInterval(updateWaktu, 60000);

const navbar = document.getElementById('navbar');
if (navbar) {
    window.addEventListener('scroll', function() {
        if (window.scrollY > 0) {
            navbar.classList.add('shadow-md');
        } else {
            navbar.classList.remove('shadow-md');
        }
    });
}

function closeMobileMenu() {
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const menuIcon = mobileMenuBtn ? mobileMenuBtn.querySelector('i') : null;

    if (mobileMenu && mobileMenu.classList.contains('active')) {
        mobileMenu.classList.remove('active');
        if (menuIcon) {
            menuIcon.classList.remove('fa-times');
            menuIcon.classList.add('fa-bars');
        }

        const activeMobileDropdowns = mobileMenu.querySelectorAll('.mobile-dropdown-content.active');
        activeMobileDropdowns.forEach(content => {
            content.classList.remove('active');
            const btn = content.previousElementSibling;
            const icon = btn ? btn.querySelector('i') : null;
            if (icon) {
                icon.style.transform = 'rotate(0deg)';
            }
        });
    }
}

window.scrollToSection = function(event, sectionId) {
    event.preventDefault();
    const section = document.getElementById(sectionId);

    if (section) {
        section.scrollIntoView({
            behavior: 'smooth'
        });
    }
    closeMobileMenu();
};

const scrollBtn = document.querySelector('.scroll-to-top');
if (scrollBtn) {
    window.addEventListener('scroll', () => {
        
        if (window.scrollY > 300 || document.documentElement.scrollTop > 300) {
            scrollBtn.classList.add('active');
        } else {
            scrollBtn.classList.remove('active');
        }
    });

    scrollBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

const mobileMenuBtn = document.getElementById('mobileMenuBtn');
const mobileMenu = document.getElementById('mobileMenu');

if (mobileMenuBtn && mobileMenu) {
    const menuIcon = mobileMenuBtn.querySelector('i');

    mobileMenuBtn.addEventListener('click', function() {
        mobileMenu.classList.toggle('active');

        if (menuIcon) {
            if (mobileMenu.classList.contains('active')) {
                menuIcon.classList.remove('fa-bars');
                menuIcon.classList.add('fa-times');
            } else {
                menuIcon.classList.remove('fa-times');
                menuIcon.classList.add('fa-bars');
            }
        }
    });

    document.addEventListener('click', function(e) {
        if (mobileMenu && mobileMenuBtn && !mobileMenu.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
            closeMobileMenu();
        }
    });
}

const mobileDropdownBtns = document.querySelectorAll('.mobile-dropdown-btn');
mobileDropdownBtns.forEach(btn => {
    btn.addEventListener('click', function() {
        const content = btn.nextElementSibling;
        const icon = btn.querySelector('i');
        const parentDropdownContent = btn.closest('.mobile-dropdown-content') || mobileMenu.querySelector('.py-2');
        const siblingDropdowns = parentDropdownContent.querySelectorAll(':scope > .mobile-dropdown');

        siblingDropdowns.forEach(siblingDropdown => {
            const siblingBtn = siblingDropdown.querySelector('.mobile-dropdown-btn');
            const siblingContent = siblingBtn.nextElementSibling;
            const siblingIcon = siblingBtn.querySelector('i');

            if (siblingBtn !== btn && siblingContent.classList.contains('active')) {
                siblingContent.classList.remove('active');
                if (siblingIcon) {
                    siblingIcon.style.transform = 'rotate(0deg)';
                }
            }
        });

        content.classList.toggle('active');
        if (icon) {
            if (content.classList.contains('active')) {
                icon.style.transform = 'rotate(180deg)';
            } else {
                icon.style.transform = 'rotate(0deg)';
            }
        }
    });
});

const desktopDropdowns = document.querySelectorAll('.dropdown');
desktopDropdowns.forEach(dropdown => {
    const button = dropdown.querySelector('button');
    const menu = dropdown.querySelector('.dropdown-menu');
    
    if (button && menu) {

        button.addEventListener('click', function(e) {
            e.preventDefault();
            if (!window.matchMedia('(hover: hover) and (pointer: fine)').matches) {
                menu.classList.toggle('hidden');
            }
        });
    }
});

// Tutup dropdown desktop saat klik di luar
document.addEventListener('click', function(e) {
    desktopDropdowns.forEach(dropdown => { // Menggunakan variabel yang diperbarui
        const menu = dropdown.querySelector('.dropdown-menu');
        const button = dropdown.querySelector('button');
        // Pastikan menu ada, tidak diklik di dalam dropdown itu sendiri, dan bukan nested-dropdown
        if (menu && !dropdown.contains(e.target) && !e.target.closest('.nested-dropdown-menu')) {
            // Sembunyikan menu hanya jika sedang terlihat
            if (!menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
            }
        }
    });
});

const mobileMenuLinks = document.querySelectorAll('#mobileMenu a');
mobileMenuLinks.forEach(link => {
    link.addEventListener('click', function() {
        closeMobileMenu();
    });
});

});
</script>