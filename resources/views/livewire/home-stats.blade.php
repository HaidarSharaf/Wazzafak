<div class="w-full">
    <section class="p-10">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                @guest
                    <h2 class="sm:text-4xl text-3xl font-bold mb-4">Join Thousands of Success Stories!</h2>
                @endguest
                <p class="sm:text-3xl text-2xl font-semibold text-white/80">Real-time Platform Statistics</p>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="text-center md:p-8 p-6 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 hover:bg-white/20 transition-all duration-300"
                     x-data="{ count: 0, target: {{ $devs_count }} }"
                     x-init="
            let duration = 2000;
            let increment = target / (duration / 16);
            let animate = () => {
                if (count < target) {
                    count = Math.min(count + increment, target);
                    requestAnimationFrame(animate);
                } else {
                    count = target;
                }
            };
            let observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    animate();
                    observer.disconnect();
                }
            }, { threshold: 0.5 });
            observer.observe($el);
         ">
                    <div class="sm:text-4xl text-2xl font-bold text-lime-300 mb-2" x-text="Math.floor(count).toLocaleString()"></div>
                    <div class="md:text-3xl sm:text-xl text-sm text-white/80 font-medium">Active Developers</div>
                </div>

                <div class="text-center md:p-8 p-6 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 hover:bg-white/20 transition-all duration-300"
                     x-data="{ count: 0, target: {{ $recruiters_count }} }"
                     x-init="
            let duration = 2000;
            let increment = target / (duration / 16);
            let animate = () => {
                if (count < target) {
                    count = Math.min(count + increment, target);
                    requestAnimationFrame(animate);
                } else {
                    count = target;
                }
            };
            let observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    animate();
                    observer.disconnect();
                }
            }, { threshold: 0.5 });
            observer.observe($el);
         ">
                    <div class="sm:text-4xl text-2xl font-bold text-lime-300 mb-2" x-text="Math.floor(count).toLocaleString()"></div>
                    <div class="md:text-3xl sm:text-xl text-sm text-white/80 font-medium">Recruiters</div>
                </div>

                <div class="text-center md:p-8 p-6 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 hover:bg-white/20 transition-all duration-300"
                     x-data="{ count: 0, target: {{ $jobs_count }} }"
                     x-init="
            let duration = 2000;
            let increment = target / (duration / 16);
            let animate = () => {
                if (count < target) {
                    count = Math.min(count + increment, target);
                    requestAnimationFrame(animate);
                } else {
                    count = target;
                }
            };
            let observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    animate();
                    observer.disconnect();
                }
            }, { threshold: 0.5 });
            observer.observe($el);
         ">
                    <div class="sm:text-4xl text-2xl font-bold text-lime-300 mb-2" x-text="Math.floor(count).toLocaleString()"></div>
                    <div class="md:text-3xl sm:text-xl text-sm text-white/80 font-medium">Open Positions</div>
                </div>

                <div class="text-center md:p-8 p-6 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20 hover:bg-white/20 transition-all duration-300"
                     x-data="{ count: 0, target: {{ $accepted_apps_count }} }"
                     x-init="
            let duration = 2000;
            let increment = target / (duration / 16);
            let animate = () => {
                if (count < target) {
                    count = Math.min(count + increment, target);
                    requestAnimationFrame(animate);
                } else {
                    count = target;
                }
            };
            let observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    animate();
                    observer.disconnect();
                }
            }, { threshold: 0.5 });
            observer.observe($el);
         ">
                    <div class="sm:text-4xl text-2xl font-bold text-lime-300 mb-2" x-text="Math.floor(count).toLocaleString()"></div>
                    <div class="md:text-3xl sm:text-xl text-sm text-white/80 font-medium">Successful Matches</div>
                </div>
            </div>
        </div>
    </section>
</div>
