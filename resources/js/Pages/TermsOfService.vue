<template>
    <Head title="Welcome" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- animate css -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- jquery-ui.min css -->
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <!-- meanmenu css -->
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <!-- owl.carousel css -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- bxslider css -->
    <!--flaticon css -->
    <link rel="stylesheet" href="css/flaticon.css">
    <!-- font-awesome css -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link href="css/video-js.css" rel="stylesheet">
    <!-- style css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- responsive css -->
    <link rel="stylesheet" href="css/responsive.css">

    <div>
    <a href="javascript:" id="return-to-top"><i class="fa fa-angle-up"></i></a>
    <!-- preloader Start -->
    <!-- <div id="preloader">
        <div id="status"><img src="images/banner/loader.gif" id="preloader_image" alt="loader">
        </div>
    </div> -->
    <!--Header area start here-->
    <div section-scroll='0' class="wd_scroll_wrap">
        <header class="gc_main_menu_wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-6">
                        <div class="logo-area">
                            <a href="#"><img src="/img/logo-bit.png" width="125" alt="logo" /></a>
                        </div>
                    </div>
                    <!-- Mobile Menu  Start -->
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-6">
                        <div class="menu-area  hidden-xs">
                            <nav class="wd_single_index_menu btc_main_menu">
                               
                            </nav>
                            <div class="login-btn">
                                <Link :href="route('register')" class="btn1"><i class="fa fa-user"></i><span>Sign up</span></Link>
                            </div>
                            <div class="login-btn">
                                <Link :href="route('login')" class="btn1"><i class="fa fa-user"></i><span>Login</span></Link>
                            </div>
                        </div>
                        <!-- mobile menu area start -->
                        <div hidden class="rp_mobail_menu_main_wrapper visible-xs ">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div id="toggle">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 31.177 31.177" style="enable-background:new 0 0 31.177 31.177;" xml:space="preserve" width="25px" height="25px">
                                            <g>
                                                <g>
                                                    <path hidden class="menubar" d="M30.23,1.775H0.946c-0.489,0-0.887-0.398-0.887-0.888S0.457,0,0.946,0H30.23    c0.49,0,0.888,0.398,0.888,0.888S30.72,1.775,30.23,1.775z" fill="#fff" />
                                                </g>
                                                <g>
                                                    <path class="menubar" d="M30.23,9.126H12.069c-0.49,0-0.888-0.398-0.888-0.888c0-0.49,0.398-0.888,0.888-0.888H30.23    c0.49,0,0.888,0.397,0.888,0.888C31.118,8.729,30.72,9.126,30.23,9.126z" fill="#fff" />
                                                </g>
                                                <g>
                                                    <path class="menubar" d="M30.23,16.477H0.946c-0.489,0-0.887-0.398-0.887-0.888c0-0.49,0.398-0.888,0.887-0.888H30.23    c0.49,0,0.888,0.397,0.888,0.888C31.118,16.079,30.72,16.477,30.23,16.477z" fill="#fff" />
                                                </g>
                                                <g>
                                                    <path class="menubar" d="M30.23,23.826H12.069c-0.49,0-0.888-0.396-0.888-0.887c0-0.49,0.398-0.888,0.888-0.888H30.23    c0.49,0,0.888,0.397,0.888,0.888C31.118,23.43,30.72,23.826,30.23,23.826z" fill="#fff" />
                                                </g>
                                                <g>
                                                    <path class="menubar" d="M30.23,31.177H0.946c-0.489,0-0.887-0.396-0.887-0.887c0-0.49,0.398-0.888,0.887-0.888H30.23    c0.49,0,0.888,0.398,0.888,0.888C31.118,30.78,30.72,31.177,30.23,31.177z" fill="#fff" />
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Mobile Menu  End -->
                    </div>
                </div>
            </div>
        </header>
        <!--Header area end here-->
        <!--Slider area start here-->
        <section class="slider-area">
            <div id="particles-js">
                <div id="carousel-example-generic" class="carousel" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <div class="carousel-captions caption-1">
                                <div class="container">
                                    <div v-html="terms" class="w-full sm:max-w-2xl mt-6 py-2 px-12 overflow-hidden sm:rounded-lg prose text-white">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>




    </div>
    <div section-scroll='6' class="wd_scroll_wrap">





    <div section-scroll='7' class="wd_scroll_wrap">


        <!--Footer area start here-->
        <footer class="top-foo">
            <div id="footer-js">
                <div class="footer-top section">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <footer class="foo-bot">
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="copyright wow  fadeInUp animated" data-wow-duration="1.9s" style="visibility: visible; animation-duration: 1.0s; animation-name: fadeInUp;">
                                © 2021-2022 <a href="#"><span>Money Mine Tree </span></a>
                                
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="foo-link wow  fadeInUp animated" data-wow-duration="1.0s" style="visibility: visible; animation-duration: 1.0s; animation-name: fadeInUp;">
                                <Link :href="route('terms.show')">Terms and Conditions for Money Mine Tree</Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>        
    </div>

</template>
<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Head,
            Link,
        },

        props: ['terms']
    })
</script>


<style type="text/css">
    .st0 {
        fill-rule: evenodd;
        clip-rule: evenodd;
        fill: #10122d;
    }
</style>