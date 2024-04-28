<template>
    <title>Details</title>
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
                                        <li class="breadcrumb-item active" aria-current="page">Details</li>
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
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="s_content">
                                            <div class="mb-2">
                                                <nuxt-link href="orderList" class="btn btn-primary"><i
                                                        class="fa-solid fa-arrow-left me-1"></i></nuxt-link>
                                            </div>
                                            <!-- truck order section start here  -->
                                            <div class="orderTruck">
                                                <div class="step active">
                                                    <i class="fa-solid fa-bag-shopping"></i>
                                                    <h6>Place Order</h6>
                                                    <p>2024-02-06</p>
                                                </div>
                                                <div class="step ">
                                                    <i class="fa-solid fa-wallet"></i>
                                                    <h6>Payment</h6>
                                                    <span></span>
                                                </div>
                                                <div class="step">
                                                    <i class="fa-solid fa-plane"></i>
                                                    <h6>Consignment</h6>
                                                    <span></span>
                                                </div>
                                                <div class="step">
                                                    <i class="fa-solid fa-circle-check"></i>
                                                    <h6>Confirm receipt</h6>
                                                    <span></span>
                                                </div>
                                            </div>
                                            <!-- truck order section end here  -->

                                            <!-- table part start here  -->
                                            <div class="dtble" style="width: 100%; overflow: auto;">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Products</th>
                                                            <th>Price</th>
                                                            <th>Number</th>
                                                            <th>Ammount of money</th>
                                                            <th>Operation</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div class="t_product">
                                                                    <img src="/assets/images/product/product(1).jpg"
                                                                        class="img-fluid" loading="lazy" alt="">
                                                                    <div>
                                                                        <h6>iPhone 15 pro max 256GB space gray</h6>
                                                                        <p><del>$300</del></p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <p><del>$140.10</del><span
                                                                        class="text-dark">$134.10</span></p>
                                                            </td>
                                                            <td>x1</td>
                                                            <td>
                                                                <h6>$134.10</h6>
                                                            </td>
                                                            <td class="">
                                                                <div class="btn-group">
                                                                    <a @click="suc_mdal()" class="btn btn-primary payment_ w-100 d-flex align-items-center "
                                                                        style="font-size: 12px;"><i
                                                                            class="fa-brands fa-paypal me-1"></i>Payment</a>
                                                                    <nuxt-link to="transfer"
                                                                        class="btn btn-secondary w-100 d-flex align-items-center"
                                                                        style="font-size: 12px;"><i
                                                                            class="fa-solid fa-arrow-turn-down"></i>Transfer</nuxt-link>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="order_details_">
                                                <h6>Order Details</h6>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="d-flex justify-content-between align-items-end">
                                                            <p>Order Mone</p>
                                                            <span class="fw-bold">CASH ON DELIVERY(COD)</span>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-end">
                                                            <p>Order Number</p>
                                                            <span class="fw-bold">165461561561654</span>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-end">
                                                            <p>Order status </p>
                                                            <span class="fw-bold">To be paid</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="d-flex justify-content-between align-items-end">
                                                            <p>Payment status</p>
                                                            <span class="fw-bold">To be paid</span>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-end">
                                                            <p>Selling price</p>
                                                            <span class="fw-bold">$154.21</span>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-end">
                                                            <p>purches quantity</p>
                                                            <span class="fw-bold">1</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="d-flex justify-content-between align-items-end">
                                                            <p>Payment time</p>
                                                            <span class="fw-bold"></span>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-end">
                                                            <p>Creation time</p>
                                                            <span class="fw-bold">24-02-06 12:00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="s_content">
                                            <h6>Order summary</h6>
                                            <hr>
                                            <div class="d-flex justify-content-between align-items-end">
                                                <p>Selling price:</p>
                                                <span class="fw-bold">$1,200.21</span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-end">
                                                <p>Total price:</p>
                                                <span class="fw-bold">$1,200.21</span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-end">
                                                <p>Payment ammount:</p>
                                                <span class="fw-bold">$00.00</span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-end">
                                                <p>Profit:</p>
                                                <span class="fw-bold text-danger">$20.00</span>
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
        </div>
        <MobileFooter />

        <!-- payment modal  -->
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
                        <p class="text-black text-center">The goods will be paid as operating system, Are you sure
                            you want to
                            continue?</p>
                        <button type="button" class="btn btn-primary bt_lose w-100 mt-3 bt_s">Continue</button>
                    </div>
                </div>
            </div>
        </div>
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

