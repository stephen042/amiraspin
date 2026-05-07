<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ env('APP_NAME') }} | Unleash the Win</title>

        <link rel="icon" type="image/png" href="{{ asset('assets/images/beastimages/spin.jpg') }}">
        <link rel="apple-touch-icon" href="{{ asset('assets/images/beastimages/spin.jpg') }}">

        <meta name="title" content="{{ env('APP_NAME') }} | Unleash the Win">
        <meta name="description"
            content="Spin the wheel and unleash massive rewards. Join the most exciting prize arena with {{ env('APP_NAME') }}.">

        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ env('APP_URL') }}">
        <meta property="og:title" content="{{ env('APP_NAME') }} | Unleash the Win">
        <meta property="og:description" content="Spin the wheel and win up to $100,000. Fast payouts and fair odds.">
        <meta property="og:image" content="{{ asset('assets/images/beastimages/spin.jpg') }}">

        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ env('APP_URL') }}">
        <meta property="twitter:title" content="{{ env('APP_NAME') }} | Unleash the Win">
        <meta property="twitter:description"
            content="Spin the wheel and win up to $100,000. Fast payouts and fair odds.">
        <meta property="twitter:image" content="{{ asset('assets/images/beastimages/spin.jpg') }}">

        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

        <!-- Smartsupp Live Chat script -->
        <script type="text/javascript">
        var _smartsupp = _smartsupp || {};
        _smartsupp.key = 'e8dcbb44f73adea20556932f2fab8997cbf3e865';
        window.smartsupp||(function(d) {
        var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
        s=d.getElementsByTagName('script')[0];c=d.createElement('script');
        c.type='text/javascript';c.charset='utf-8';c.async=true;
        c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
        })(document);
        </script>
        <noscript>Powered by <a href="https://www.smartsupp.com" target="_blank">Smartsupp</a></noscript>

    </head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            /* Light Slate */
            color: #1e293b;
            /* Dark Slate for text */
        }

        .gradient-text {
            background: linear-gradient(90deg, #f59e0b, #ef4444);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03);
        }

        .spin-anim {
            animation: spin 20s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .animate-marquee {
            display: flex;
            width: max-content;
            animation: marquee 30s linear infinite;
        }

        .hover\:pause:hover {
            animation-play-state: paused;
        }

        /* Video container aspect ratio */
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            /* 16:9 */
            height: 0;
            overflow: hidden;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 1.5rem;
        }

        /* Prevent layout shift when Alpine loads */
        [x-cloak] {
            display: none !important;
        }

        /* Smooth glass transition */
        .glass {
            transition: background 0.3s ease, backdrop-filter 0.3s ease;
        }
    </style>
</head>

<body class="overflow-x-hidden">

    <nav class="fixed top-0 left-0 w-full z-[60] glass py-4" x-data="{ mobileMenuOpen: false }">
        <div class="container mx-auto px-6 flex justify-between items-center relative z-10">
            <div class="flex items-center space-x-2">
                <i class="fas fa-bolt text-orange-500 text-2xl"></i>
                <span class="text-2xl font-black tracking-tighter uppercase text-slate-900">
                    {{ env('APP_NAME') }}
                </span>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="/" class="font-medium hover:text-orange-500 transition text-slate-600">Home</a>
                <a href="#about" class="font-medium hover:text-orange-500 transition text-slate-600">About</a>
                <a href="/login"
                    class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-full font-bold transition transform hover:scale-105 shadow-lg shadow-orange-200">Spin
                    Now</a>
                <a href="/register"
                    class="border-2 border-slate-200 text-slate-700 px-6 py-2 rounded-full font-bold hover:bg-slate-100 transition">Register</a>
            </div>

            <div class="md:hidden flex items-center">
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="text-slate-900 focus:outline-none relative w-10 h-10 z-[70]">
                    <div class="relative w-full h-full flex items-center justify-center">
                        <i class="fas fa-bars text-2xl transition-all duration-300 absolute"
                            :class="mobileMenuOpen ? 'opacity-0 scale-50 rotate-90' : 'opacity-100 scale-100 rotate-0'">
                        </i>
                        <i class="fas fa-times text-2xl transition-all duration-300 absolute" x-cloak
                            :class="mobileMenuOpen ? 'opacity-100 scale-100 rotate-0' : 'opacity-0 scale-50 -rotate-90'">
                        </i>
                    </div>
                </button>
            </div>
        </div>

        <div x-show="mobileMenuOpen" x-cloak @click.away="mobileMenuOpen = false"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-full"
            x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-full"
            class="md:hidden bg-white border-t border-slate-100 shadow-2xl absolute top-full left-0 w-full px-6 py-8 space-y-6 z-[50]">

            <div class="flex flex-col space-y-4">
                <a @click="mobileMenuOpen = false" href="#hero"
                    class="block text-xl font-bold text-slate-800 hover:text-orange-500">Home</a>
                <a @click="mobileMenuOpen = false" href="#about"
                    class="block text-xl font-bold text-slate-800 hover:text-orange-500">About</a>
            </div>

            <hr class="border-slate-100">

            <div class="flex flex-col space-y-4">
                <a href="/login"
                    class="bg-orange-500 text-white text-center px-6 py-4 rounded-2xl font-bold shadow-lg shadow-orange-100">Spin
                    Now</a>
                <a href="/register"
                    class="border-2 border-slate-200 text-slate-700 px-6 py-4 rounded-2xl font-bold">Register</a>
            </div>
        </div>
    </nav>

    <section id="hero" class="relative pt-32 pb-20 lg:pt-48 bg-white" x-data="{ activeSlide: 1, slides: [1, 2, 3] }">
        <div class="container mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1">
                <div
                    class="inline-block px-4 py-1 rounded-full bg-orange-100 text-orange-600 font-bold text-sm mb-4 uppercase tracking-widest">
                    🔥 New Jackpot Live
                </div>
                <h1 class="text-5xl lg:text-7xl font-extrabold leading-tight mb-6 text-slate-900">
                    Fortune Favors the <span class="gradient-text">Boldest.</span>
                </h1>
                <p class="text-slate-500 text-lg mb-8 max-w-lg">
                    Join over 2 million global players in the world's most vibrant rewards ecosystem. High stakes,
                    higher rewards, and instant payouts.
                </p>
                <div class="flex space-x-4">
                    <a href="/login"
                        class="bg-slate-900 text-white px-8 py-4 rounded-xl font-bold flex items-center space-x-2 hover:bg-slate-800 transition shadow-xl shadow-slate-200">
                        <span>Start Spinning</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div
                class="order-1 lg:order-2 relative h-[300px] md:h-[450px] overflow-hidden rounded-3xl shadow-2xl border-4 border-white shadow-slate-200">
                <div class="absolute inset-0 transition-transform duration-700 ease-in-out flex"
                    :style="'transform: translateX(-' + (activeSlide - 1) * 100 + '%)'">

                    <div class="min-w-full relative">
                        <img src="{{ asset('assets/images/beastimages/pic1.jpeg') }}"
                            class="w-full h-full object-cover" alt="Gaming">
                        <div class="absolute bottom-0 p-8 bg-gradient-to-t from-black/80 to-transparent w-full">
                            <h3 class="text-2xl font-bold text-white uppercase italic tracking-tighter">Mega Jackpots
                                Daily</h3>
                        </div>
                    </div>
                    <div class="min-w-full relative">
                        <img src="{{ asset('assets/images/beastimages/pic2.jpeg') }}" class="w-full  object-cover"
                            alt="Casino">
                        <div class="absolute bottom-0 p-8 bg-gradient-to-t from-black/80 to-transparent w-full">
                            <h3 class="text-2xl font-bold text-white uppercase italic tracking-tighter">Secure Payouts
                            </h3>
                        </div>
                    </div>
                    <div class="min-w-full relative">
                        <img src="{{ asset('assets/images/beastimages/pic4.jpeg') }}" class="w-full object-cover"
                            alt="Winner">
                        <div class="absolute bottom-0 p-8 bg-gradient-to-t from-black/80 to-transparent w-full">
                            <h3 class="text-2xl font-bold text-white uppercase italic tracking-tighter">24/7 Live
                                Support</h3>
                        </div>
                    </div>
                </div>

                <div class="absolute bottom-4 right-4 flex space-x-2">
                    <template x-for="slide in slides" :key="slide">
                        <button @click="activeSlide = slide"
                            :class="activeSlide === slide ? 'bg-orange-500 w-8' : 'bg-white/50 w-3'"
                            class="h-3 rounded-full transition-all duration-300"></button>
                    </template>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="py-24 bg-slate-50">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="lg:w-1/2 relative flex justify-center">
                    <div class="absolute -inset-4 bg-orange-500/10 rounded-full blur-3xl"></div>

                    <div
                        class="relative z-10 w-full max-w-md aspect-square bg-white rounded-full border-8 border-slate-100 shadow-xl spin-anim overflow-hidden">

                        <img src="{{ asset('assets/images/beastimages/spin.jpg') }}" alt="Spin Board"
                            class="w-full h-full object-cover">

                    </div>
                </div>
                <div class="lg:w-1/2">
                    <h2 class="text-4xl font-extrabold mb-6 text-slate-900">About the <span
                            class="text-orange-500 uppercase">{{ env('APP_NAME') }}</span></h2>
                    <p class="text-slate-600 mb-6 leading-relaxed">
                        {{ env('APP_NAME') }} is more than just a game; it's a global rewards platform. We combine
                        transparency with high-end tech to ensure your experience is safe, fair, and incredibly
                        exciting.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-center space-x-3 font-semibold text-slate-700">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span>Lightning-Fast Global Withdrawals</span>
                        </li>
                        <li class="flex items-center space-x-3 font-semibold text-slate-700">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span>Independently Certified RNG Systems</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="container mx-auto px-6 text-center">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-4xl font-extrabold mb-4 text-slate-900">See It In <span
                        class="text-orange-500">Action</span></h2>
                <p class="text-slate-500 mb-10">Watch how Easy it is to start winning on BeastSpin.</p>

                <div class="video-container shadow-2xl shadow-slate-300">
                    <iframe src="{{ asset('assets/videos/video.mp4') }}" title="BeastSpin Tutorial" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-slate-900 text-white">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-8 text-center">
                <div>
                    <h4 class="text-5xl font-black text-orange-500">53+</h4>
                    <p class="font-bold uppercase tracking-widest text-slate-400">Countries Available</p>
                </div>
                <div>
                    <h4 class="text-5xl font-black text-orange-500">$2.4M+</h4>
                    <p class="font-bold uppercase tracking-widest text-slate-400">Total Paid Out</p>
                </div>
                <div>
                    <h4 class="text-5xl font-black text-orange-500">1.2M</h4>
                    <p class="font-bold uppercase tracking-widest text-slate-400">Active Spinners</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 overflow-hidden bg-slate-50">
        <div class="container mx-auto px-6 mb-12">
            <h2 class="text-4xl font-extrabold text-center text-slate-900">Winner <span
                    class="text-orange-500 italic">Circle</span></h2>
            <p class="text-center text-slate-500 mt-2">Real-time payouts from our global community</p>
        </div>

        <div class="relative flex overflow-x-hidden" x-data="{
            winners: [{
                    name: 'Alex K.',
                    win: '$10,000',
                    time: '1m ago',
                    text: 'I didn\'t believe it until the funds hit my wallet. This $10k win is absolutely life-changing!',
                    img: 'https://i.pravatar.cc/150?u=11'
                },
                {
                    name: 'Sarah J.',
                    win: '$100,000',
                    time: '5m ago',
                    text: 'STILL SHAKING! Just hit the $100k Grand Prize. {{ env('APP_NAME') }} is the real deal, guys!',
                    img: 'https://i.pravatar.cc/150?u=12'
                },
                {
                    name: 'Mike Ross',
                    win: '$60,000',
                    time: '12m ago',
                    text: 'Sixty thousand dollars on a single spin! The mechanics here are legendary.',
                    img: 'https://i.pravatar.cc/150?u=13'
                },
                {
                    name: 'Elena V.',
                    win: '$10,000',
                    time: '18m ago',
                    text: 'Second time hitting the $10k mark this month. Best interface and fairest odds out there.',
                    img: 'https://i.pravatar.cc/150?u=14'
                },
                {
                    name: 'David O.',
                    win: '$60,000',
                    time: '24m ago',
                    text: 'Fast, fun, and reliable. Withdrawing my $60k was smooth as silk. Can\'t wait for more!',
                    img: 'https://i.pravatar.cc/150?u=15'
                }
            ]
        }">
            <div class="flex animate-marquee whitespace-nowrap space-x-6 hover:pause">
                <template x-for="i in [1, 2]"> <template x-for="winner in winners">
                        <div
                            class="bg-white inline-block w-80 p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl transition-all shrink-0">
                            <div class="flex items-center space-x-4 mb-4">
                                <div
                                    class="relative w-14 h-14 rounded-full border-2 border-orange-500 p-0.5 overflow-hidden">
                                    <img :src="winner.img" alt="Winner"
                                        class="w-full h-full object-cover rounded-full">
                                </div>
                                <div>
                                    <h5 class="font-bold text-slate-900" x-text="winner.name"></h5>
                                    <div class="flex text-orange-400 text-[10px]">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                            class="fas fa-star"></i><i class="fas fa-star"></i><i
                                            class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="text-slate-500 text-sm whitespace-normal leading-relaxed italic"
                                x-text="`&quot;${winner.text}&quot;`"></p>
                            <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between">
                                <span class="text-sm font-bold text-green-600" x-text="`+${winner.win}`"></span>
                                <span class="text-[10px] text-slate-400 uppercase tracking-tighter"
                                    x-text="winner.time"></span>
                            </div>
                        </div>
                    </template>
                </template>
            </div>
        </div>
    </section>

    <section id="contact" class="py-20 bg-white">
        <div class="container mx-auto px-6 max-w-4xl">
            <div class="bg-slate-50 p-8 md:p-12 rounded-3xl border border-slate-100 shadow-inner">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-extrabold mb-2 text-slate-900">Get In Touch</h2>
                    <p class="text-slate-500">Need help? We're available 24/7.</p>
                </div>
                <form class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <input type="text" placeholder="Full Name"
                            class="w-full bg-white border border-slate-200 rounded-xl px-4 py-4 focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition">
                        <input type="email" placeholder="Email Address"
                            class="w-full bg-white border border-slate-200 rounded-xl px-4 py-4 focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition">
                    </div>
                    <textarea rows="4" placeholder="Your Message"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-4 focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition"></textarea>
                    <button
                        class="w-full bg-orange-500 text-white font-bold py-4 rounded-xl hover:bg-orange-600 transition shadow-lg shadow-orange-200 uppercase tracking-widest">Send
                        Message</button>
                </form>
            </div>
        </div>
    </section>

    <footer class="py-12 bg-slate-50 border-t border-slate-200">
        <div
            class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center space-y-8 md:space-y-0 text-center md:text-left">
            <div>
                <div class="flex items-center space-x-2 justify-center md:justify-start">
                    <i class="fas fa-bolt text-orange-500"></i>
                    <span class="text-xl font-black uppercase text-slate-900">
                        {{ env('APP_NAME') }}
                    </span>
                </div>
                <p class="text-slate-400 text-sm mt-2">&copy; 2026 {{ env('APP_NAME') }}. Responsible gaming for all.
                </p>
            </div>
            <div class="flex space-x-6 text-2xl">
                <a href="#" class="text-slate-400 hover:text-orange-500 transition"><i
                        class="fab fa-twitter"></i></a>
                <a href="#" class="text-slate-400 hover:text-orange-500 transition"><i
                        class="fab fa-discord"></i></a>
                <a href="#" class="text-slate-400 hover:text-orange-500 transition"><i
                        class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('alpine:init', () => {
            setInterval(() => {
                const el = document.querySelector('[x-data]');
                if (el && el.__x && el.__x.$data) {
                    if (el.__x.$data.activeSlide < 3) {
                        el.__x.$data.activeSlide++;
                    } else {
                        el.__x.$data.activeSlide = 1;
                    }
                }
            }, 5000);
        });
    </script>
</body>

</html>
