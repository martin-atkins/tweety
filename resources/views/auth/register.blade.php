<x-master>
    <div class="container mx-auto flex justify-center">
        <div class="py-8 px-8 bg-gray-200 border border-gray-400 rounded-lg">
            <div class="col-md-8">
                <div class="font-bold text-lg mb-4">{{ __('Register') }}</div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                               for="username"
                        >
                            Username
                        </label>
                        <input class="border border-gray-400 p-2 w-full"
                               type="text"
                               name="username"
                               id="username"
                               required
                        >

                        @error('username')
                            <p class="test-red-500 text-ms mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                               for="name"
                        >
                            Name
                        </label>
                        <input class="border border-gray-400 p-2 w-full"
                               type="text"
                               name="name"
                               id="name"
                               required
                        >

                        @error('name')
                            <p class="test-red-500 text-ms mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                               for="email"
                        >
                            E-mail Address
                        </label>
                        <input class="border border-gray-400 p-2 w-full"
                               type="text"
                               name="email"
                               id="email"
                               required
                        >

                        @error('email')
                            <p class="test-red-500 text-ms mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                               for="password">
                            Password
                        </label>
                        <input class="border border-gray-400 p-2 w-full"
                               type="password"
                               name="password"
                               id="password"
                               required
                        >

                        @error('password')
                            <p class="test-red-500 text-ms mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                               for="password-confirm">
                            Confirm Password
                        </label>
                        <input class="border border-gray-400 p-2 w-full"
                               type="password-confirm"
                               name="password-confirm"
                               id="password-confirm"
                               required
                        >

                        @error('password-confirm')
                            <p class="test-red-500 text-ms mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="px-6 py-3 rounded text-sm uppercase text-white bg-blue-600">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-master>
