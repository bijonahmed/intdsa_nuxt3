<template>
    <title>Event</title>
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
                                        <li class="breadcrumb-item active" aria-current="page">Event</li>
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
                        <div class="row">
                            <div class="col-md-12">
                                <!-- content part start here  -->
                                <div class="s_content events_section">

                                    <div class="storeList ">
                                        <div class="store_" v-for="(post, index) in postdata" :key="index">
                                            <!-- <h5>{{ post.name }}</h5> -->
                                            <div class="position-relative">
                                                <img :src="post.images" class="img-fluid" loading="lazy" alt="">
                                            </div>
                                            <div class="d-flex">
                                                <a type="button" @click="apply()"
                                                    class="btn btn-primary btn_success w-100 "
                                                    style="font-size: 12px;">Apply </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- content part end here  -->
                                <!-- content part start here  -->
                                <!-- <div class="s_content">
                                    <div v-for="(post, index) in postdata" :key="index">
                                        <img :src="post.images" class="img-fluid" loading="lazy" alt="">
                                        <h6>{{ post.name }}:</h6>
                                        <p>{{ post.description_full }}</p>
                                    </div>

                                </div> -->
                                <!-- content part end here  -->
                            </div>
                        </div>
                    </div>
                </section>
                <!-- main content part end here  -->
            </div>

            <!-- event modal part start start here  -->
            <div class="apply_mdal modal_">
                <div class="mdal_content">
                    <div class="m_head py-1">
                        <div class="w-50"></div>
                        <button class="bt_close" @click="closeCard">
                            <i class="fa-solid fa-x"></i>
                        </button>
                    </div>
                    <div class="_body">
                        <p class="text-center">To apply for this event, please contact your mentor or DSA
                            Customer Service.</p>
                    </div>
                </div>
            </div>

            <!-- content section end here  -->
            <PartnerFooterLayout />
        </div>
        <MobileFooter />
    </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue';
import axios from 'axios';
import swal from 'sweetalert2';
import { useRouter } from 'vue-router';
const router = useRouter();
definePageMeta({
    middleware: 'is-logged-out',
})

const apply = () => {
    $('.apply_mdal').fadeIn();
}
const closeCard = () => {
    $('.apply_mdal').fadeOut();
}

const postdata = ref([]);
const allPostCategory = async (postcatid) => {
    try {
        const response = await axios.get(`/post/postCategoryData`, {
            params: {
                id: postcatid // Assuming 'searchParam' is the parameter you want to send
            }
        });
        // console.log(response.data);
        postdata.value = response.data.data;

    } catch (error) {
        console.error(error);
    }
};


onMounted(async () => {
    allPostCategory(2);

});
</script>
