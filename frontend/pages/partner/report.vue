<template>
    <title>Report</title>
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
                                        <li class="breadcrumb-item active" aria-current="page">Report</li>
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
                            <div class="loading-indicator" v-if="loading" style="text-align: center;">
                                <Loader />
                            </div>
                        </center>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- content part start here  -->
                                <div class="s_content">
                                    <div class="countDash">
                                        <div class="dash_box">
                                            <!-- <i class="far fa-user"></i> -->
                                            <i class="fa-solid fa-tag"></i>
                                            <div class="dash_C">
                                                <h3>Total Sale</h3>
                                                <h1>${{ totalSale }}</h1>
                                                <span>Current month sale: ${{ toalSalescurrentMonth }}</span>
                                                <span>Last month sale: ${{ toalSaleslastMonth }}</span>
                                            </div>

                       
                                        </div>
                                        <div class="dash_box">
                                            <!-- <i class="far fa-user"></i> -->
                                            <i class="fa-solid fa-wallet"></i>
                                            <div class="dash_C">
                                                <h3>Available balance</h3>
                                                <h1>${{ current_balance }}</h1>
                                                <span>In transection: ${{ availableBalatransection }}</span>
                                                <!-- <span>Number of Complete: {{ numberOfComplatation }}</span> -->
                                            </div>
                                        </div>
                                        <div class="dash_box">
                                            <!-- <i class="far fa-user"></i> -->
                                            <i class="fa-solid fa-chart-line"></i>
                                            <div class="dash_C">
                                                <h3>Total Profit </h3>
                                                <h1>$0</h1>
                                                <span>Profit for this month: $00.00</span>
                                                <span>Last month's profit: $00.00</span>
                                            </div>
                                        </div>
                                        <div class="dash_box">
                                            <!-- <i class="far fa-user"></i> -->
                                            <i class="fa-solid fa-boxes-stacked"></i>
                                            <div class="dash_C">
                                                <h3>Total Order</h3>
                                                <h1>{{ pendingOrders }}</h1>
                                                <span>Order's for current month: {{ currentMonth }}</span>
                                                <span>Order's of last month: {{ lastMonthOrders }}</span>
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
    </div>
</template>

<script setup>
const router = useRouter()
import axios from "axios";
import Swal from 'sweetalert2'
definePageMeta({
    middleware: 'is-logged-out',
})
const loading = ref(false);
const current_balance = ref(0);
const pendingOrders = ref(0);
const currentMonth = ref(0);
const lastMonthOrders = ref(0);
const totalSale = ref(0);
const toalSalescurrentMonth = ref(0);
const toalSaleslastMonth = ref(0);
const availableBalatransection = ref(0);
const numberOfComplatation = ref(0);

//Payment getway


const getCurrentBalance = async () => {
    try {
        loading.value = true;
        let response;
        response = await axios.get("/dropUser/getCurrentBalance");
        current_balance.value = response.data.current_balance;
    } catch (error) {
        console.error("Error fetching deposit list:", error);
    } finally {
        loading.value = false;
    }

};



const report = async () => {
    try {
        loading.value = true;
        let response;
        response = await axios.get("/dropUser/report");
        pendingOrders.value = response.data.pendingOrders;
        currentMonth.value = response.data.currentMonth;
        lastMonthOrders.value = response.data.lastMonthOrders;
        totalSale.value = response.data.totalSale;
        toalSalescurrentMonth.value = response.data.toalSalescurrentMonth;
        toalSaleslastMonth.value = response.data.toalSaleslastMonth;
        availableBalatransection.value = response.data.availableBalatransection;
        numberOfComplatation.value = response.data.numberOfComplatation;



        
    } catch (error) {
        console.error("Error fetching deposit list:", error);
    } finally {
        loading.value = false;
    }

};
/*
const depositList = async () => {
    const depositId = searchDOrderId.value;
    // console.log("=======" + depositId);
    //return false; 
    try {
        loading.value = true; // Set loading to true before making the request
        let response;
        if (depositId) {
            response = await axios.get(`/dropUser/depositRequestList?orderId=${depositId}`);
        } else {
            response = await axios.get("/dropUser/depositRequestList");
        }

        depositArr.value = response.data.data;
    } catch (error) {
        console.error("Error fetching deposit list:", error);
    } finally {
        loading.value = false; // Set loading to false after the request completes (whether success or failure)
    }
};


const withdrawalList = async () => {
    try {
        loading.value = true; // Set loading to true before making the request

        let response;
        if (searchWOrderId.value) {
            response = await axios.get(`/dropUser/withDrawalRequestList?orderId=${searchWOrderId.value}`);
        } else {
            response = await axios.get("/dropUser/withDrawalRequestList");
        }
        withdrawArr.value = response.data.data;
        console.log('sdfssdfsd' + response.data.data);
    } catch (error) {
        console.error("Error fetching withdrawal list:", error);
    } finally {
        loading.value = false; // Set loading to false after the request completes (whether success or failure)
    }
};

*/

onMounted(() => {
    getCurrentBalance();
    report();


});

</script>
