<template>
    <div>
        <Head :title="title" />

        <div class="flex h-screen bg-gray-50">
            <!-- Navbar -->
            <div class="flex flex-col flex-1 w-full">
                <header class="z-10 py-4 bg-gray-medium">
                    <div class="container flex items-center justify-between md:justify-between h-full px-6 mx-auto text-gray-400">
                        <!-- APP LOGO -->
                        <div class=" text-gray-500 dark:text-gray-400">
                            <a class="ml-6 flex flex-row text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
                                <span class="mx-2 my-3">{{$page.props.appName}}</span>
                            </a>
                        </div>

                        <!-- Desktop Items -->
                        <div class="hidden md:flex justify-center flex-1 lg:mr-32">
                            <div class="relative w-full max-w-xl mr-6">
                                <div class="absolute inset-y-0 flex items-center pl-2">
                                    <div v-for="navPage in navPages" :key="navPage.title" class="relative px-6 py-3">
                                        <template v-if="navPage.show">
                                            <template v-if="navPage.route == 'dropdown'">
                                                <JetDropdown>
                                                    <template #trigger>
                                                        <div class="flex flex-col justify-center mx-4 items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                                            <span>{{ navPage.title }}</span>
                                                        </div>
                                                    </template>

                                                    <template #content>
                                                        <JetDropdownLink :href="route(item.route)" v-for="item in navPage.items" :key="item.title">
                                                            <span>{{ item.title }}</span>
                                                        </JetDropdownLink>     
                                                    </template>
                                                </JetDropdown>
                                            </template>

                                            <template v-else>
                                                <Link :href="route(navPage.route)" class="text-lg text-gray-200" >
                                                    <span>{{ navPage.title }}</span>
                                                </Link>
                                            </template>
                                        </template>


                                    </div>                                    
                                </div>
                            </div>
                        </div>

                        <ul class="flex text-white items-center flex-shrink-0 space-x-6">
                            <JetDropdown>
                                <template #trigger>
                                    <div class="flex flex-row hover:cursor-pointer">
                                        <div class="flex flex-col my-auto">
                                            <span class="font-bold">{{ $page.props.user.name }}</span>
                                            <span class="font-bold text-green-500">{{ currency($page.props.user.balance) }}</span>
                                        </div>
                                        
                                    </div>
                                </template>

                                <template #content>
                                    <JetDropdownLink :href="route('profile.show')">
                                        Profile
                                    </JetDropdownLink>
                                    
                                    <form @submit.prevent="logout()">
                                        <JetDropdownLink as="button">Logout</JetDropdownLink>                   
                                    </form>      
                                </template>
                            </JetDropdown>

                            <div @click="isNavbarOpen = !isNavbarOpen" class="block md:hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                            </div>
                        </ul>
                    </div>
                </header>

                <Transition  name="slide-fade">
                    <div v-if="isNavbarOpen" class="md:hidden">
                        <Link v-for="navPage in navPages" :key="navPage.title" :href="route(navPage.route)" as="button" class="px-4 py-4 bg-gray-100 border-b border-b-gray-400 w-full text-left">{{navPage.title}}</Link>
                    </div>                    
                </Transition>

                
                <main class="h-full mb-12 sm:mb-0 overflow-y-auto">
                    <div class="py-4 md:py-12">
                        <div class="my-6 pb-4 border-b border-b-gray-300">
                            <div class="max-w-7xl mx-2 lg:mx-auto">
                                <h2 class="text-3xl font-bold text-gray-800">
                                    {{title}}
                                </h2> 
                            </div>
                        </div>

                        <div class="max-w-7xl mx-2 lg:mx-auto">
                            <div class="container">
                                <jet-banner />
                                <slot></slot>
                            </div>
                        </div>
                    </div>                    
                </main>
            </div>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetApplicationMark from '@/Jetstream/ApplicationMark.vue'
    import JetBanner from '@/Jetstream/Banner.vue'
    import JetDropdown from '@/Jetstream/Dropdown.vue'
    import JetDropdownLink from '@/Jetstream/DropdownLink.vue'
    import JetNavLink from '@/Jetstream/NavLink.vue'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        props: {
            title: String
        },

        components: {
            Head,
            JetApplicationMark,
            JetBanner,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
            Link,
        },

        data() {
            const userPages = [
                {
                    title: 'Home',
                    route: 'dashboard',
                    icon: '/img/icons/home.svg',
                    show: true
                },
                {
                    title: 'Deposit',
                    route: 'deposits.index',
                    icon: '/img/icons/chart.svg',
                    show: true
                },
                {
                    title: 'NFTs',
                    route: 'tokens.index',
                    icon: '/img/icons/cube.svg',
                    show: true
                }
            ];

            const adminPages = [
                {
                    title: 'Users',
                    route: 'admin.users.index',
                    icon: '/img/icons/user.svg',
                    show: this.userCan('users')
                },
                {
                    title: 'NFTs',
                    route: 'tokens.index',
                    icon: '/img/icons/cube.svg',
                    show: true
                },                
                {
                    title: 'Settings',
                    route: 'admin.settings.index',
                    icon: '/img/icons/chart.svg',
                    show: this.userCan('settings')
                },                                                
            ];

            return {
                coins: [],
                isNavbarOpen: false,
                navPages: (this.$page.props.user.is_admin) ? adminPages : userPages
            }
        },

        methods: {
            logout() {
                this.$inertia.post(route('logout'));
            },

            userCan(permission) {
                return (typeof this.$page.props.user.permissions == 'object' && this.$page.props.user.permissions !== null) ? this.$page.props.user.permissions.includes(permission) : false;
            }
        },

        computed: {
            profilePicture() {
                return this.$page.props.user.profile_photo_path == null ? '/img/avatar.png' : `/${this.$page.props.user.profile_photo_path}`;
            }
        }
    })
</script>

<style>
.slide-fade-enter-active {
  transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateY(-20px);
  opacity: 0;
}   
</style>