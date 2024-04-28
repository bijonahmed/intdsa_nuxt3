<template>
    <div>
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item">
                    <LazyNuxtLink class="nav-link" data-widget="navbar-search" to="/" role="button">
                        <i class='fas fa-home'></i>
                    </LazyNuxtLink>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- <li>
                    <a href="#">
                        <img src="/assets/images/apps(1).png" width="120" alt="" class="img-fluid px-2 mx-auto">
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img src="/assets/images/apps(2).png" width="120" alt="" class="img-fluid px-2 mx-auto">
                    </a>
                </li>
                <li>
                    <a class="nav-link active me-2" aria-current="page" href="#online_service">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                            <path
                                d="M480-100.782q-22.087 0-37.544-15.456-15.457-15.457-15.457-37.544 0-22.088 15.457-37.544 15.457-15.457 37.544-15.457l276.043.565v-285.13q0-111.913-81.217-188.043-81.217-76.13-194.826-76.13t-194.826 76.13q-81.217 76.13-81.217 188.043l2.826 210.218q.565 22.087-15.174 37.826-15.739 15.739-37.827 15.739h-2.826q-37.522 0-63.848-26.043-26.326-26.044-26.326-63.566v-89.609q0-21.565 9.934-40.348 9.935-18.782 27.805-31.478l.739-28.129q3.478-74.783 35.26-139.001 31.783-64.218 83.24-111.74 51.456-47.522 119.174-74.63Q404.652-859.218 480-859.218t142.849 27.109q67.5 27.108 119.174 74.413 51.674 47.305 83.239 111.805 31.566 64.5 35.478 139.283l.739 27.129q18.435 11.261 28.087 30.392 9.652 19.13 9.652 40.261v93.696q0 23.391-8.804 45.065t-28.935 33.5v30.347q0 43.74-30.848 74.588-30.848 30.848-74.588 30.848H480ZM366.783-385.304q-18.131 0-30.478-12.347-12.348-12.348-12.348-29.914 0-17.565 12.348-29.913 12.347-12.348 30.478-12.348 18.13 0 30.478 12.348 12.348 12.348 12.348 29.913 0 17.566-12.348 29.914-12.348 12.347-30.478 12.347Zm226.434 0q-18.13 0-30.478-12.347-12.348-12.348-12.348-29.914 0-17.565 12.348-29.913 12.348-12.348 30.478-12.348 18.131 0 30.478 12.348 12.348 12.348 12.348 29.913 0 17.566-12.348 29.914-12.347 12.347-30.478 12.347ZM239.87-477.262Q234-578.174 306.413-647.674q72.413-69.5 175.587-69.5 90.13 0 158.761 54.239 68.63 54.239 77.543 141.109-85.913-1-161.282-40.804-75.37-39.804-117.5-114.456-18.826 73.782-72.87 126.108-54.043 52.326-126.782 73.716Z" />
                        </svg>
                    </a>
                </li>
                <li class="nav-item">
                    <div class="d-flex align-items-center">
                        <ul class="lang" style="list-style: none;padding: 3px 5px;; margin: 0; margin-right: 5px;">
                            <li style="min-width: 68px;">
                                <a class="nav-link active" style="display: flex;">
                                    <img style="width: 22px;height: 22px;" src="/assets/images/lang_en.png">
                                    US <span class="am-icon-caret-down"></span>
                                </a>
                                <ul class="pull_down">
                                    <li>
                                        <nuxt-link to="/">
                                            <div style="display: flex;" bis_skin_checked="1">
                                                <img style="margin-right: 10px;width: 22px;height: 22px;"
                                                    src="/assets/images/lang_en.png">
                                                US
                                            </div>
                                        </nuxt-link>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button" @click="logoutModal">
                        <i class='fas fa-sign-out-alt' style='font-size:20px;color:red'></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- navbar -->

        <!-- =======================================  -->
        <!-- <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

            </ul>

            
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <LazyNuxtLink class="nav-link" data-widget="navbar-search" to="/" role="button">
                        <i class='fas fa-home'></i>
                    </LazyNuxtLink>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button" @click="logoutModal">
                        <i class='fas fa-sign-out-alt' style='font-size:20px;color:red'></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav> -->
    </div>


    <!-- logout modal  -->
    <div class="logout modal_">
        <div class="mdal_content">
            <div class="m_head">
                <h6>Logout</h6>
                <div class="w-50"></div>
                <button class="bt_close" @click="logoutModalClose">
                    <i class="fa-solid fa-x"></i>
                </button>
            </div>
            <div class="_body">
                <div class="form_group">

                    <button class="btn btn-primary mr-2 btn-block" @click="logout">Yes</button>
                    <button class="btn btn-secondary btn-block" @click="logoutModalClose">No</button>

                </div>
            </div>
        </div>
    </div>



</template>

<script setup>
import { ref } from 'vue';
import { useUserStore } from '~~/stores/user'
import { storeToRefs } from 'pinia';
import { useCartStore } from '~~/stores/cart';
const userStore = useUserStore();
const {
    isLoggedIn
} = storeToRefs(userStore)
const cartStore = useCartStore()
computed(async () => {
    try {
        await userStore.getUser()
    } catch (error) { }
})

// Method to close sidebar
const logoutModal = () => {
    $(".logout").fadeIn();
};
const logoutModalClose = () => {
    $(".logout").fadeOut();
};


const logout = async () => {
    const router = useRouter(); // Get the router object
    try {

        await userStore.logout();
        localStorage.removeItem('token');
        router.push('/'); // Redirect to the root route
        return;

    } catch (error) {
        console.error(error);
    }

};
</script>