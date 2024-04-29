<template>
    <title>Order List</title>
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
                                        <li class="breadcrumb-item active" aria-current="page">Order List</li>
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
                                <div class="alert-danger w-100" role="alert" style="width: 100%;">
                                    {{ error }}
                                </div>
                                <!-- content part start here  -->
                                <div class="s_content">
                                    <div class="dash_C mb-3">
                                        <h3>Available amount: ${{ currentBalance }}</h3>
                                        <h3>Estimate profit: $0</h3>
                                        <h3>Pending orders: ${{ pendingOrders }}</h3>
                                    </div>
                                    <div class="row align-items-center btns_">
                                        <div class="col-xl-8 mb-2">
                                            <form action="">
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <!-- <p>Essential information</p> -->
                                                        <input type="text" class="form-control"
                                                            placeholder="Search by order id" v-model="searchByOrderId">
                                                    </div>
                                                    <div class="mx-2">
                                                        <!-- <p>Month</p> -->
                                                        <select name="" class="form-control" id="">
                                                            <option value="">This Month</option>
                                                            <option value="">Last Month</option>
                                                            <option value="">Whole</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <!-- <p>Order status</p> -->
                                                        <select class="form-control" v-model="order_status">
                                                            <option v-for="status in orderStatus" :key="status.id"
                                                                :value="status.id">
                                                                {{ status.name }}
                                                            </option>
                                                        </select>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-xl-4 mb-2">
                                            <form action="">
                                                <div class="d-flex align-items-center justify-content-md-end">

                                                    <button type="button" class="btn mx-1 btn-success "
                                                        @click="orderList"><i
                                                            class="fa-solid fa-magnifying-glass me-2"></i>Search</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- <button type="button" @click="orderList">order</button> -->
                                    <!-- order table part start here -->
                                    <div class="loading-indicator" v-if="loading" style="text-align: center;">
                                        <Loader />
                                    </div>

                                    <div class="dtble" style="width: 100%; overflow: auto;">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Essential Information</th>
                                                    <th>Date</th>
                                                    <th>Order Status</th>
                                                    <th>Cost Price($)</th>
                                                    <th>Profit($)</th>
                                                    <th>Qty.</th>
                                                    <th>Operation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="pro in productArray" :key="pro.id">
                                                    <td>
                                                        <h6 class="d-flex align-items-center"><small>Order ID: {{
                                                            pro.orderId }}</small></h6>
                                                        <div class="t_product">
                                                            <img :src="pro.thumnail_img" class="img-fluid"
                                                                loading="lazy" alt="">
                                                            <div>
                                                                <h6>{{ pro.product_name }}</h6>
                                                                <p class="text-white text-start"><del>{{ pro.old_price
                                                                        }}</del></p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ pro.order_date }}</td>
                                                    <td>{{ pro.status_name }}</td>
                                                    <td>${{ pro.selling_price }}</td>
                                                    <td>{{ pro.profit.toFixed(2) }}</td>
                                                    <td>{{ pro.product_qty }}</td>
                                                    <td class="">
                                                        <div class="btn-group">
                                                            <nuxt-link :to="'details/' + pro.id"
                                                                class="btn btn-secondary w-100 d-flex align-items-center"
                                                                style="font-size: 12px;"><i
                                                                    class="fa-regular fa-eye me-1"
                                                                    style="font-size: 12px;"></i>Details</nuxt-link>
                                                            <a @click="suc_mdal(pro)"
                                                                class="btn payment_ btn-primary w-100 d-flex align-items-center text-dark"
                                                                style="font-size: 12px; color:black"><i
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
            <!-- payment modal  -->
            <div class="confirm_mdal modal_">
                <div class="mdal_content">
                    <div class="m_head">
                        <div class="w-50" v-if="storeOrderId">Order ID:{{ storeOrderId }}</div>
                        <button class="bt_close" @click="cls_modal">
                            <i class="fa-solid fa-x"></i>
                        </button>
                    </div>
                    <div class="_body">
                        <div class="form_group">
                            <p class="text-black text-center">The goods will be paid as operating system, Are you sure
                                you want to
                                continue?</p>
                            <button type="button" class="btn btn-primary bt_lose w-100 mt-3 bt_s"
                                @click="orderrConfirm">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <MobileFooter />
    </div>
</template>

<script setup>
const router = useRouter()
import axios from "axios";
import Swal from 'sweetalert2'

definePageMeta({
    middleware: 'is-logged-out',
})

const storeOrderId = ref();

const loading = ref(false);
const productArray = ref([]);
const orderStatus = ref([]);
const orderBatch = ref([]);

const currentBalance = ref(0);
const pendingOrders = ref(0);

const order_status = ref(1);
const searchByOrderId = ref();
const error = ref();
const suc_mdal = (pro) => {

    console.log("records set: " + pro);
    orderBatch.value = pro;
    storeOrderId.value = pro.orderId;
    $(".confirm_mdal").fadeIn();

}

const cls_modal = () => {
    $(".modal_").fadeOut();
}

const orderrConfirm = async () => {

    try {
        loading.value = true; // Set loading to true before making the request
        const res = await axios.get("/order/sendConfirmOrders", {
            params: {
                orderId: storeOrderId.value, // Include the search parameter
            },
        });


        currentBalance.value = res.data.currentBalance;
        pendingOrders.value = res.data.pendingOrders;

        //console.log("pendingOrders" + res.data.pendingOrders);
        //console.log("currentBalance" + res.data.currentBalance);
        //console.log("error" + res.data.error);
        if (res.data.error_status == 1) {
            error.value = res.data.error;
        } else {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "Successfully order send."
            });
            error.value = res.data.error;
        }



        cls_modal();
        orderList();


        return false;

        //productArray.value = response.data.products;
    } catch (error) {
        console.error("Error fetching product list:", error);
    } finally {
        loading.value = false; // Set loading to false after the request completes (whether success or failure)
    }

}

const orderList = async () => {
    try {
        loading.value = true; // Set loading to true before making the request

        const res = await axios.get("/order/orderlist", {
            params: {
                searchByOrderId: searchByOrderId.value, // Include the search parameter
                order_status: order_status.value,
            },
        });
        productArray.value = res.data.products;
        currentBalance.value = res.data.currentBalance;
        orderStatus.value = res.data.orderStatus;
        pendingOrders.value = res.data.chkPendingOrder;
        //productArray.value = response.data.products;
    } catch (error) {
        console.error("Error fetching product list:", error);
    } finally {
        loading.value = false; // Set loading to false after the request completes (whether success or failure)
    }
};

onMounted(() => {
    orderList();

});

</script>
