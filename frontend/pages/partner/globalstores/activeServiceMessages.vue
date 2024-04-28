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
                                        <li class="breadcrumb-item active"><nuxt-link
                                                to="/partner/globalstores/activeService">Active Store</nuxt-link></li>
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

                        <center>
                            <h4>The store has been purchased successfully</h4>
                        </center>
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

</script>
