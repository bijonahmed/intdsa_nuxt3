<template>
    <title>My Store</title>
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
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><nuxt-link
                                                to="/partner/dashboard">Dashboard</nuxt-link></li>
                                        <li class="breadcrumb-item active" aria-current="page">My Store</li>
                                    </ol>
                                </nav>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">

                        <div class="s_content">
                            <center>
                                <div class="loading-indicator" v-if="loading" style="text-align: center;">
                                    <Loader />
                                </div>
                            </center>
                            <div class="storeList">
                                <div v-for="(store, index) in myStore" :key="index" class="store_">
                                    <center style="text-align: center; color:white">
                                         {{ store.category_name }} 
                                    </center>
                                    <div class="position-relative">
                                        <img :src="store.store_images" class="img-fluid" loading="lazy" alt="">

                                    </div>
                                    <div class="d-flex">
                                        <LazyNuxtLink
                                            :to="{ path: '/partner/globalstores/activeService/', query: { store: store.my_store_id } }"
                                            class="btn btn-primary  w-100 me-2" style="font-size: 12px;">Open store
                                        </LazyNuxtLink>


                                        <nuxt-link :to="{ path: '/partner/globalstores/view-store/', query: { store: store.my_store_id } }" class="btn btn-primary w-100 ms-2"
                                            style="font-size: 12px;">View store </nuxt-link>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
                <!-- main content part end here  -->
            </div>
            <!-- content section end here  -->
            <PartnerFooterLayout />
        </div>
        <MobileFooter />
    </div>
</template>

<script setup>
definePageMeta({
    middleware: 'is-logged-out',
})
import { ref, watch, onMounted } from "vue";
import axios from "axios";
const loading = ref(false);
const myStore = ref([]);

const checkMyStore = async () => {
    try {
        loading.value = true;
        const response = await axios.get('/store/checkMystore');
        console.log("store data: " + response.data);
        myStore.value = response.data;

    } catch (error) {
        console.error('An error occurred:', error);
    } finally {
        loading.value = false;
    }
};

onMounted(async () => {
    checkMyStore()
})

</script>
