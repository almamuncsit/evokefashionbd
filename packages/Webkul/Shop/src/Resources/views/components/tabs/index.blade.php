@props(['position' => 'left'])

<v-tabs
    position="{{ $position }}"
    {{ $attributes }}
>
    <x-shop::shimmer.tabs />
</v-tabs>

@pushOnce('scripts')
    <script
        type="text/x-template"
        id="v-tabs-template"
    >
        <div>
            <div
                class="flex flex-row justify-center gap-10 border-b border-zinc-200 max-sm:gap-1.5"
                :style="positionStyles"
            >
                <div
                    role="button"
                    tabindex="0"
                    v-for="tab in tabs"
                    class="-mb-px cursor-pointer border-b-2 border-transparent px-2 py-5 text-sm font-medium uppercase tracking-[0.14em] text-zinc-500 hover:text-navyBlue max-md:py-3 max-sm:px-2.5 max-sm:py-2.5 max-sm:text-xs"
                    :class="{'!border-navyBlue !text-navyBlue transition': tab.isActive }"
                    :id="tab.$attrs.id + '-button'"
                    @click="change(tab)"
                >
                    @{{ tab.title }}
                </div>
            </div>

            <div>
                {{ $slot }}
            </div>
        </div>
    </script>

    <script type="module">
        app.component('v-tabs', {
            template: '#v-tabs-template',

            props: ['position'],

            data() {
                return {
                    tabs: []
                }
            },

            computed: {
                positionStyles() {
                    return [
                        `justify-content: ${this.position}`
                    ];
                },
            },

            methods: {
                change(selectedTab) {
                    this.tabs.forEach(tab => {
                        tab.isActive = (tab.title == selectedTab.title);
                    });
                },
            },
        });
    </script>
@endPushOnce
