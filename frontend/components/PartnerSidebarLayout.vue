<template>
    <div>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <!-- Brand Logo -->
            <LazyNuxtLink to="/partner/dashboard" class="brand-link">
                <img src="/assets/images/LOGO_1.png" alt="AdminLTE Logo"
                    class="brand-image bg-white img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">{{ userStore.email }}</span>

            </LazyNuxtLink>

            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">

                    <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">
                            <LazyNuxtLink to="/partner/dashboard" class="nav-link" @click="toggleSidebar">
                                <i class="fa-solid fa-gauge"></i> &nbsp;
                                <p>Dashboard</p>
                            </LazyNuxtLink>
                        </li>

                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">

                                <i class="fas fa-border-all"></i>
                                <p>
                                    Store management
                                    <i class="right fa-solid fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <LazyNuxtLink to="/partner/globalstores/myStore" class="nav-link "
                                        @click="toggleSidebar">
                                        <!-- <i class="nav-icon fa-solid fa-store"></i> -->
                                        <p>My store</p>
                                    </LazyNuxtLink>
                                </li>
                                <li class="nav-item">
                                    <LazyNuxtLink to="/partner/globalstores/activeService" class="nav-link "
                                        @click="toggleSidebar">
                                        <!-- <i class="nav-icon fa-solid fa-users-gear"></i> -->
                                        <p>Active Service</p>
                                    </LazyNuxtLink>
                                </li>
                                <li class="nav-item">
                                    <LazyNuxtLink to="/" class="nav-link" @click="toggleSidebar">
                                        <!-- <i class="nav-icon fa-solid fa-boxes-stacked"></i> -->
                                        <p>Product Center</p>
                                    </LazyNuxtLink>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="fas fa-border-all"></i>
                                <p>Account Management
                                    <i class="right fa-solid fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <LazyNuxtLink to="/partner/datamanagement/personalData" class="nav-link "
                                        @click="toggleSidebar">
                                        <!-- <i class="nav-icon fa-regular fa-id-card"></i> -->
                                        <p>Personal Data </p>
                                    </LazyNuxtLink>
                                </li>
                                <li class="nav-item">
                                    <LazyNuxtLink to="/partner/datamanagement/bankList" class="nav-link "
                                        @click="toggleSidebar">
                                        <!-- <i class="nav-icon fa-solid fa-building-columns"></i> -->
                                        <p>Withdrawal Method</p>
                                    </LazyNuxtLink>
                                </li>
                                <li class="nav-item">
                                    <LazyNuxtLink to="/partner/globalstores/myWallet" class="nav-link "
                                        @click="toggleSidebar">
                                        <!-- <i class="nav-icon fa-solid fa-wallet"></i> -->
                                        <p>My Wallet</p>
                                    </LazyNuxtLink>
                                </li>
                                <li class="nav-item">
                                    <LazyNuxtLink to="/partner/datamanagement/accountSecurity" class="nav-link "
                                        @click="toggleSidebar">
                                        <!-- <i class="nav-icon fa-solid fa-shield-halved"></i> -->
                                        <p>Account Security</p>
                                    </LazyNuxtLink>
                                </li>
                                <li class="nav-item">
                                    <LazyNuxtLink to="/partner/datamanagement/myMassage" class="nav-link "
                                        @click="toggleSidebar">
                                        <!-- <i class="nav-icon fa-regular fa-message"></i> -->
                                        <p>Message</p>
                                    </LazyNuxtLink>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="fas fa-border-all"></i>
                                <p>
                                    Operation Center
                                    <i class="right fa-solid fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <LazyNuxtLink to="/partner/ordercenter/orderList" class="nav-link "
                                        @click="toggleSidebar">
                                        <!-- <i class="nav-icon fa-regular fa-file-lines"></i> -->
                                        <p>Order List</p>
                                    </LazyNuxtLink>
                                </li>
                                <li class="nav-item">
                                    <LazyNuxtLink to="/partner/report" class="nav-link" @click="toggleSidebar">
                                        <!-- <i class=" nav-icon fa-solid fa-chart-column"></i> -->
                                        <p>Report</p>
                                    </LazyNuxtLink>
                                </li>
                                <!-- <li class="nav-item ">
                                <a href="fund.html" class="nav-link ">
                                    <i class="nav-icon fa-solid fa-filter-circle-dollar"></i>
                                    <p>Operating Fund</p>
                                </a>
                            </li> -->
                                <li class="nav-item ">
                                    <LazyNuxtLink to="/partner/partners" class="nav-link" @click="toggleSidebar">
                                        <!-- <i class="nav-icon fa-solid fa-handshake-angle"></i> -->
                                        <p>Partners</p>
                                    </LazyNuxtLink>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="fas fa-border-all"></i>
                                <p>
                                    Community
                                    <i class="right fa-solid fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview menu-open">
                                <li class="nav-item">
                                    <LazyNuxtLink to="/partner/community/event" class="nav-link" @click="toggleSidebar">
                                        <!-- <i class="nav-icon fa-solid fa-calendar-days "></i> -->
                                        <p>Event</p>
                                    </LazyNuxtLink>
                                </li>
                                <li class="nav-item">
                                    <LazyNuxtLink to="/partner/community/faq" class="nav-link" @click="toggleSidebar">
                                        <!-- <i class="nav-icon fa-solid fa-person-circle-question"></i> -->
                                        <p>FAQ</p>
                                    </LazyNuxtLink>
                                </li>
                                <li class="nav-item d-none">
                                    <LazyNuxtLink to="/terms-and-conditions" class="nav-link">
                                        <!-- <i class=" nav-icon fa-solid fa-file-contract"></i> -->
                                        <p>Service Agreement</p>
                                    </LazyNuxtLink>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" @click="logoutModal">
                                <i class=" nav-icon fa-solid fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

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






    </div>
</template>

<script setup>
// Import ref and define reactive variable for sidebar state
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
const isSidebarOpen = ref(false);

// Method to close sidebar
const logoutModal = () => {
    $(".logout").fadeIn();
};
const logoutModalClose = () => {
    $(".logout").fadeOut();
};


// Method to toggle sidebar state
const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;

    // Trigger the click event of the nav-link with the data-widget attribute set to pushmenu
    if (window.innerWidth < 768) {
        const sidebarToggle = document.querySelector('.nav-link[data-widget="pushmenu"]');
        if (sidebarToggle) {
            sidebarToggle.click();
        }
    }

};
// Method to close sidebar
const closeSidebar = () => {
    isSidebarOpen.value = false;
};
const logout = async () => {
    const router = useRouter(); // Get the router object
    //let res = confirm('Are you sure you want to sign out?');
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

<style scoped>
.sidebar {
    /* width: 270px; */
    /* background: var(--primaryColor); */
    /* padding: 20px; */
    height: 85vh;
    overflow: auto;
    /* position: fixed; */
    /* left: 0; */
    /* top: 0; */
    scrollbar-width: 0;
    /* transition: .4s all ease-in-out; */
    /* z-index: 99999; */
}
</style>