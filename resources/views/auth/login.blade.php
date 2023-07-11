<x-guest-layout>
    <div class="bg-white py-6 sm:py-8 lg:py-12 mt-12">
        <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
            <h2 class="mb-4 text-center text-2xl font-bold text-gray-800 md:mb-8 lg:text-3xl">Masuk</h2>

            <form method="POST" action="{{ route('login') }}" class="mx-auto max-w-lg rounded-lg border">
                @csrf
                <div class="flex flex-col gap-4 p-4 md:p-8 shadow-sm shadow-slate-600 rounded-lg">
                    <div>
                        <x-input-label for="email" :value="__('Surel (Email)')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                                      required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                                      autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                        </label>
                    </div>

                    <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg shadow-sm shadow-blue-300 hover:bg-blue-800">Masuk</button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
