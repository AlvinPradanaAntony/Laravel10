<template>
    <!-- Navbar -->
    <nav class="fixed top-0 z-50 w-screen flex justify-between items-center bg-[--primary-c] px-8 md:px-16 py-4">
        <div class="font-semibold text-white text-lg">Fahrizal</div>
        <div class="hidden sm:flex gap-x-4 md:gap-x-8">
            <a href="" class="text-white/80">Home</a>
            <a href="" class="text-white/80">About</a>
            <a href="" class="text-white/80">Contact</a>
        </div>

        <input type="checkbox" class="hidden peer" id="nav-hamb"/>
        <label class="block md:hidden" for="nav-hamb">
            <div class="w-6 h-[3px] mb-1 rounded-sm bg-white/50"> </div>
            <div class="w-6 h-[3px] mb-1 rounded-sm bg-white/50"> </div>
            <div class="w-6 h-[3px] mb-1 rounded-sm bg-white/50"> </div>
        </label>
        <div class="absolute -right-32 peer-checked:right-0 px-8 p-2 text-right hidden peer-checked:flex flex-col -bottom-16 z-50 bg-[--primary-c]">
            <a href="" class="text-white/80">Home</a>
            <a href="" class="text-white/80">About</a>
            <a href="" class="text-white/80">Contact</a>
        </div>
    </nav>
    <!-- End Navbar -->
    
    <!-- Hero -->
    <div class="relative bg-[--primary-c] w-screen px-8">
        <div class="flex flex-col-reverse flex-wrap md:flex-row pt-16 sm:pt-32">
            <div class="w-full sm:w-1/2 min-w-[240px]">
                <div class="px-8 mt-12 sm:mt-0 relative transform">
                    <img src="/Images/temp.png" alt="" class="w-64 m-auto sm:w-52 md:w-80 transform scale-x-[-1] sm:scale-x-[1]">
                    <!-- <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="absolute w-80 z-10 top-0">
                        <path fill="#3a3c43" d="M48.6,-28.8C59.2,-9.7,61.3,13.5,51.8,34.6C42.3,55.8,21.2,75,3.2,73.2C-14.8,71.3,-29.5,48.4,-41.1,26.1C-52.6,3.7,-60.9,-18.1,-53.6,-35.4C-46.2,-52.6,-23.1,-65.1,-2,-64C19,-62.8,38,-47.9,48.6,-28.8Z" transform="translate(100 100)" />
                    </svg> -->
        
                    <a href="#" class="absolute left-8 sm:left-0 md:left-32 md:text-base -bottom-4 bg-[--second-ac] shadow-[0_0_25px_2px_rgba(0,0,0,0.1)] w-44 py-2 rounded-lg text-center text-sm text-[--ac] hover:bg-[--ac] hover:text-white">
                        Hire me
                    </a>
                </div>
            </div>
            <div class="w-full sm:w-1/2">
                <div class="m-auto mt-4 w-fit p-4 rounded-xl">
                    <h5 class="text-white/50 text-2xl md:text-4xl font-thin">I'm</h5>
                    <h1 class="font-bold text-3xl md:text-6xl text-white">Muhammad Fahrizal</h1>
                    <p class="text-sm md:text-lg text-white/70 pt-2">UI/UX Designer, Wordpess Developer and Full-stack Web Developer</p>

                    <div class="flex gap-x-2 md:gap-x-3 mt-14">
                        <a href="#" class="bg-[--second-ac] p-2 rounded-lg">
                            <svg role="icon" class="w-3 md:w-5" fill="#ffb012" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Instagram</title><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                        </a>
                        <a href="#" class="bg-[--second-ac] p-2 rounded-lg">
                            <svg role="icon" class="w-3 md:w-5" fill="#ffb012" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>LinkedIn</title><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        <a href="#" class="bg-[--second-ac] p-2 rounded-lg">
                            <svg role="icon" class="w-3 md:w-5" fill="#ffb012" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Gmail</title><path d="M24 5.457v13.909c0 .904-.732 1.636-1.636 1.636h-3.819V11.73L12 16.64l-6.545-4.91v9.273H1.636A1.636 1.636 0 0 1 0 19.366V5.457c0-2.023 2.309-3.178 3.927-1.964L5.455 4.64 12 9.548l6.545-4.91 1.528-1.145C21.69 2.28 24 3.434 24 5.457z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero -->

    <!-- Services -->
    <div class="bg-[--accent-c] w-screen px-8 pt-8 pb-12 md:px-16">
        <div class="flex flex-col md:justify-between md:flex-row pt-16 py-8">
            <div class="w-full md:w-1/3 m-auto mb-12 md:mb-0">
                <p class="text-white/50 text-sm text-center sm:text-left">Personal Project</p>
                <h1 class="font-bold text-2xl text-white text-center sm:text-left">Usaha Sendiri</h1>
                <div class="w-20 mx-auto sm:mx-0 m-4 mt-8">
                    <svg role="img" viewBox="0 0 24 24" fill="#ffffff" xmlns="http://www.w3.org/2000/svg"><title>Printables</title><path d="M3.678 4.8 12 9.6v9.6l8.322-4.8V4.8L12 0ZM12 19.2l-8.322-4.8V24Z"/></svg>
                </div>
                <p class="text-white/60 text-sm sm:pr-8 text-center sm:text-left">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tempore repellat odit maxime voluptates ea delectus.</p>
                <div class="mt-2 mx-auto sm:mx-0 w-fit">
                    <a href="#" class="text-[--ac] text-sm">visit site..</a>
                </div>
            </div>
            <div class="w-full md:w-1/3 m-auto sm:pl-14">
                <p class="text-white/50 text-sm text-center sm:text-left">You can</p>
                <h1 class="font-bold text-2xl text-white text-center sm:text-left">Hire me</h1>
                <div class="mt-6">
                    <a href="#" class="block bg-[--second-ac] px-4 py-2 mb-2 rounded-md text-[--ac] hover:bg-[--ac] hover:text-white">
                        UI/UX Design</a>
                    <a href="#" class="block bg-[--second-ac] px-4 py-2 mb-2 rounded-md text-[--ac] hover:bg-[--ac] hover:text-white">
                        Wordpress Website</a>
                    <a href="#" class="block bg-[--second-ac] px-4 py-2 mb-2 rounded-md text-[--ac] hover:bg-[--ac] hover:text-white">
                        Full-stack Web Develop</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Services -->
</template>
<style>
    :root {
        --primary-c: #4b4d57;
        --accent-c: #3a3c43;
        --second-ac: #565965;
        --white-c: #d2d2d2;
        --ac: #ffb012;
    }
</style>