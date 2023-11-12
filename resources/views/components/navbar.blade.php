<div x-data="{ open: false }" class="bg-indigo-950">
    <nav class="container mx-auto py-4 px-2">
        <div class="container mx-auto flex items-center justify-between">
            <!-- Logo / Site Name -->
            <a href="{{route('home')}}" class="text-2xl font-semibold text-white">
                {{$settings['site_name'] ?? ''}}
            </a>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex space-x-4">
                @foreach($links as $link)
                    <a href="{{$link['url']}}" class="text-white">
                        {{$link['text']}}
                    </a>
                @endforeach
            </div>

            <!-- Mobile Menu Button (Hamburger Icon) -->
            <button @click="open = !open" class="lg:hidden text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu (conditionally rendered) -->
        <div x-show="open"
             @click.away="open = false"
             class="w-11/12 right-0 absolute top-15 mt-2 bg-white border rounded shadow-2xl lg:hidden"
        >
            <div class="py-2">
                @foreach($links as $link)
                    <a href="{{$link['url']}}" class="block px-4 py-2 text-gray-800">
                        {{$link['text']}}
                    </a>
                @endforeach
            </div>
        </div>
    </nav>


</div>
