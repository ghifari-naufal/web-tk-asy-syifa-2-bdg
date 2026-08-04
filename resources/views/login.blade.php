@include('layout-lp.head')

<!-- Tombol Back -->
<a href="{{ route('landingpage') }}"
    class="absolute top-6 left-6 inline-flex items-center gap-2 px-4 py-2 rounded-full bg-gray-200 hover:bg-gray-300 transition shadow-sm">
    <i class="fas fa-arrow-left text-gray-700"></i>
    {{-- <span class="text-gray-700 text-sm font-medium"></span> --}}
</a>

<!-- Form Login -->
<div class="min-h-screen flex items-center justify-center">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm bg-gray-50 p-6 rounded-[5px] shadow-md">
        <a href="{{ route('landingpage') }}">
            <img class="mx-auto h-20 w-auto" src="{{ asset('assets/logo.png') }}" alt="Logo">
        </a>
        <h2 class="mt-2 text-center text-2xl font-bold tracking-tight text-gray-900">
            Form Login
        </h2>
        <form class="space-y-6" action="{{ route('login.post') }}" method="POST">
            @csrf

            @session('error')
                <div class="alert alert-danger" role="alert">
                    {{ $value }}
                </div>
            @endsession

            <div>
                <label for="email" class="block text-sm font-medium text-gray-900">{{ __('Username') }}</label>
                <div class="mt-2">
                    <input type="text" name="email" id="email" required
                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 
                        outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 
                        focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm">
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-900">{{ __('Password') }}</label>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="mt-2 relative">
                    <input type="password" name="password" id="password" autocomplete="current-password" required
                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 
                        outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 
                        focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm pr-10">
                    <button type="button" id="togglePassword" tabindex="-1"
                        class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 focus:outline-none"
                        onclick="togglePasswordVisibility()">
                        <i id="eyeIcon" class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:underline">Lupa Password?</a>
            <div class="mt-0">
                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-lime-500 px-3 py-1.5 text-sm font-semibold 
                    text-black shadow-sm hover:bg-lime-600 focus-visible:outline-2 
                    focus-visible:outline-offset-2 focus-visible:outline-green-400">
                    {{ __('Login') }}
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    }
</script>
