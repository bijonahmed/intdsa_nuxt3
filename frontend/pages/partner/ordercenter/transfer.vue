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
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Transfer</h1>
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="s_content">
                                            <div class="mb-2">
                                                <nuxt-link to="orderList" class="btn btn-primary"><i
                                                        class="fa-solid fa-arrow-left me-1"></i></nuxt-link>
                                            </div>

                                            <!-- table part start here  -->
                                            <div class="dtble">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Partner name </th>
                                                            <th>Registration Time</th>
                                                            <th>Operation</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>687643</td>
                                                            <td>partner name</td>
                                                            <td>2024-02-06 12:00</td>
                                                            <td><a class="py-1 px-3 btn-secondary" @click="suc_mdal()">Transfer</a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
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
</script>
