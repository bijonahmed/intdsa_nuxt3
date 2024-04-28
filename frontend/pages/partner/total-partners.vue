<template>
    <title>Transfer</title>
    <div>
        <MobileHeader />
        <div class="wrapper">
            <!-- Navbar -->
            <PartnerNavbarLayout />
            <!-- navbar -->
            <!-- Main Sidebar Container -->
            <PartnerSidebarLayout />
            <!-- Content section start here  -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><nuxt-link to="/partner/dashboard">Dashboard</nuxt-link>
                                </li>
                                <li class="breadcrumb-item"><nuxt-link to="/partner/partners">Partner</nuxt-link></li>
                                <li class="breadcrumb-item active" aria-current="page">My Partners</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">
                                <!-- content part start here  -->
                                <div class="s_content">

                                    <div class="row align-items-center btns_">
                                        <div class="col-xl-12 ms-auto mb-2">
                                            <form action="">
                                                <div class="d-flex align-items-center justify-content-end">
                                                    <button type="button" style="min-width: 85px;"
                                                        @click="getMyPartners" class="btn mx-1 btn-primary "><i
                                                            class="fa-solid fa-magnifying-glass me-2"></i>Filter</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- <button type="button" @click="getMyPartners">Process</button> -->
                                    <center>
                                        <div class="loading-indicator" v-if="loading" style="text-align: center;">
                                            <Loader />
                                        </div>
                                    </center>
                                    <!-- order table part start here -->
                                    <center>Total Number of  Users: {{ totalUserCount }}</center>
                                    <div class="dtble" style="width: 100%; overflow: auto;">

                                        <div v-if="levels && levels.length > 0">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Level</th>
                                                        <th>User Details</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Loop through each level -->
                                                    <tr v-for="(level, index) in levels" :key="index">
                                                        <td>Level-{{ index + 1 }}</td>
                                                        <!-- Check if there are users in this level -->
                                                        <td>
                                                            <!-- Table for user details within each level -->
                                                            <table class="table table-sm table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-left col-3">Name</th>
                                                                        <th class="text-left col-6">Email</th>
                                                                        <!-- <th class="text-left">Store Name</th> -->
                                                                        <th class="text-left col-3">Register</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <!-- Check if the level.users array has any users -->
                                                                    <tr v-if="level.users.length === 0">
                                                                        <td colspan="3">No users available</td>
                                                                    </tr>
                                                                    <!-- Loop through users in the current level if available -->
                                                                    <tr v-for="user in level.users" :key="user.id"
                                                                        class="user-info text-left">
                                                                        <td class="text-left col-3"
                                                                            style="font-size: 12px;">{{ user.name }}
                                                                        </td>
                                                                        <td class="text-left col-6"
                                                                            style="font-size: 12px;">{{ user.email }}
                                                                        </td>
                                                                        <!-- <td class="text-left" style="font-size: 12px;">{{ user.storeName }}</td> -->
                                                                        <td class="text-left col-3"
                                                                            style="font-size: 12px;">{{ user.created_at
                                                                            }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div v-else>
                                            Loading...
                                        </div>



                                    </div>

                                    <!-- order table part end here  -->
                                </div>
                                <!-- content part end here  -->
                            </div>
                        </div>
                    </div>
                </section>
                <!-- main content part end here  -->
            </div>
            <!-- content section end here  -->
            <PartnerFooterLayout />

            <!-- modal  -->
            <div class="confirm_mdal modal_">
                <div class="mdal_content">
                    <div class="m_head">
                        <div class="w-50"></div>
                        <button class="bt_close" @click="cls_modal">
                            <i class="fa-solid fa-x"></i>
                        </button>
                    </div>
                    <div class="_body">
                        <div class="form_group">
                            <p class="text-black text-center">Are you sure
                                you want to
                                continue?</p>
                            <button type="button" class="btn btn-primary bt_lose w-100 mt-3 bt_s">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <MobileFooter />
    </div>
</template>

<script setup>
import { ref, watch, onMounted } from "vue";
import axios from "axios";
import Swal from 'sweetalert2'

definePageMeta({
    middleware: 'is-logged-out',
})
const suc_mdal = () => {
    $(".confirm_mdal").fadeIn();
}
const cls_modal = () => {
    $(".modal_").fadeOut();
}

const loading = ref(false);
const levels = ref([]);

const getMyPartners = async () => {
    try {
        loading.value = true;
        const response = await axios.get('/store/getMyPartners');
        //console.log("store data: " + response.data);
        levels.value = response.data;

    } catch (error) {
        console.error('An error occurred:', error);
    } finally {
        loading.value = false;
    }
};
// Computed property to calculate the total user count
const totalUserCount = computed(() => {
    let totalCount = 0;
    // Sum the total number of users across all levels
    levels.value.forEach((level) => {
        totalCount += level.users.length;
    });
    return totalCount;
});
onMounted(async () => {
    getMyPartners()
})


</script>
