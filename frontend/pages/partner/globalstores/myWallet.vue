<template>
    <title>My wallet</title>
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
                                        <li class="breadcrumb-item active" aria-current="page">My wallet</li>
                                    </ol>
                                </nav>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- content-header -->

                <!-- Main content -->
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- content part start here  -->
                                <div class="s_content">



                                    <center>
                                        <div class="loading-indicator" v-if="loading" style="text-align: center;">
                                            <Loader />
                                        </div>
                                    </center>

                                    <div class="countDash wallet_countDash">
                                        <div class="dash_box">
                                            <div class="dash_C">
                                                <h1>${{ current_balance }}</h1>
                                                <h3>Available ammount <button type="button" class="btn_i"><i
                                                            class="fa-solid fa-circle-info"></i>
                                                        <p>Available ammount for operating transaction</p>
                                                    </button></h3>

                                            </div>
                                        </div>
                                        <div class="dash_box">
                                            <div class="dash_C">
                                                <h1>$0</h1>
                                                <h3>In transaction<button type="button" class="btn_i"><i
                                                            class="fa-solid fa-circle-info"></i>
                                                        <p class="text-center">Generally in pre transaction, Withdrawal,
                                                            Freeze
                                                            the corresponding amount when the transaction is not
                                                            completed</p>
                                                    </button></h3>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- list part start here  -->
                                    <div class="wallet_buttons_">
                                        <div class="tab_btns">
                                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="pills-tab_one-tab"
                                                        data-bs-toggle="pill" data-bs-target="#pills-tab_one"
                                                        type="button" role="tab" aria-controls="pills-tab_one"
                                                        aria-selected="true">Account
                                                        Details</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="pills-tab_two-tab"
                                                        data-bs-toggle="pill" data-bs-target="#pills-tab_two"
                                                        type="button" role="tab" aria-controls="pills-tab_two"
                                                        aria-selected="false">Deposit
                                                        records</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="pills-tab_two-tab"
                                                        data-bs-toggle="pill" data-bs-target="#pills-tab_three"
                                                        type="button" role="tab" aria-controls="pills-tab_three"
                                                        aria-selected="false">Withdrawal
                                                        records</button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="btn-group">
                                            <button class="btn btn-outline-primary bt_depo"
                                                @click="depositModal">Deposit</button>
                                            <nuxt-link to="/partner/globalstores/withdraw"
                                                class="btn btn-primary">Withdraw</nuxt-link>
                                        </div>
                                    </div>
                                    <!-- tabs part start here  -->
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-tab_one" role="tabpanel"
                                            aria-labelledby="pills-tab_one-tab">
                                            <!-- first tab  -->

                                            <div class="table_section" style="width: 100%; max-height: 70vh;">
                                                <table class="table ac_details">
                                                    <thead>
                                                        <tr>
                                                            <th>Operation Type</th>
                                                            <th>Operation Amount</th>
                                                            <th>Description</th>
                                                            <th>Operation time</th>
                                                            <!-- <th>More</th> -->
                                                        </tr>
                                                    </thead>
                                                    <!-- {{ acc_data }} -->
                                                    <tbody>
                                                        <tr v-for="(item, index) in acc_data" :key="index">
                                                            <td>{{ item.operation_type }}</td>
                                                            <td class="text-danger d-sm-justify-content-between">
                                                                <span class="mb_show">Operation Amount:</span>
                                                                <span>{{ item.operation_amount }}</span>
                                                            </td>
                                                            <!-- <td class="d-sm-justify-content-between">
                                                                <span class="mb_show">Original Amount</span>
                                                                <span>{{ item.operation_amount }}</span>
                                                            </td> -->
                                                            <!-- <td>{{ item.total_amount }}</td> -->
                                                            <td>{{ item.charge_description }}</td>
                                                            <td>{{ item.operation_date }}</td>
                                                            <!-- <td>
                                                                <a type="button" class="btn_more"
                                                                    @click="acc_mdal(item)">See more</a>
                                                            </td> -->
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-tab_two" role="tabpanel"
                                            aria-labelledby="pills-tab_two-tab">
                                            <!-- second tab  -->
                                            <div class="st_filter">
                                                <form action="">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <input type="text" class="form-control"
                                                                placeholder="Recharge order id"
                                                                v-model="searchDOrderId">
                                                            <button type="button" class="btn mx-1 btn-primary"
                                                                @click="depositList">Search</button>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>
                                            <div class="table_section w_info">
                                                <div class="loading-indicator" v-if="loading"
                                                    style="text-align: center;">
                                                    <Loader />
                                                </div>
                                                <table class="table" style="font-size: 12px;">
                                                    <thead>
                                                        <tr>

                                                            <th>Recharge Order Number </th>
                                                            <th>Deposit amount($)</th>
                                                            <th>Payment amount($)</th>
                                                            <th>Status</th>
                                                            <th>Payment method</th>
                                                            <th>Payment time</th>
                                                            <th>Creation time</th>
                                                            <!-- <th>More </th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="item in depositArr" :key="item.id">
                                                            <td>{{ item.depositID }}</td>
                                                            <td><span class="mb_show">Deposit amount($): </span>{{
                                                                item.deposit_amount }}</td>
                                                            <td>{{ item.receivable_amount }}</td>
                                                            <td>{{ getStatus(item.status) }}</td>

                                                            <td>{{ item.payment_method }}</td>
                                                            <td>{{ formatDate(item.created_at) }}</td>
                                                            <td>{{ formatDate(item.created_at) }}</td>
                                                            <!-- <td><a type="button" class="depo_record"
                                                                    @click="depo_mdal()">See more</a></td> -->
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-tab_three" role="tabpanel"
                                            aria-labelledby="pills-tab_three-tab">
                                            <!-- third tab  -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="st_filter">
                                                        <form action="">
                                                            <div
                                                                class="d-flex align-items-center justify-content-between ">
                                                                <div class="d-flex align-items-center mb-2">
                                                                    <input type="text" class="form-control w-10 me-1"
                                                                        placeholder="Withdraw Order Id ">
                                                                    <select name="" id="" class="form-control w-10">
                                                                        <option value="">Unpaid Payment</option>
                                                                        <option value="">Unpaid Payment</option>
                                                                    </select>
                                                                    <button type="button"
                                                                        class="btn mx-1 btn-primary ">Search</button>
                                                                </div>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table_section ">
                                                <!-- desktop section start here  -->
                                                <!-- {{ withdrawArr }} -->
                                                <table class="table ">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-start">Withdrawal information </th>
                                                            <th class="text-start">Collection information</th>
                                                            <th class="text-start">Payment information</th>
                                                            <th>remarks</th>
                                                            <th>Application time </th>
                                                            <th>More</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="item in withdrawArr" :key="item.id">
                                                            <td>
                                                                <!-- <p class="text-start">Order Number: </p>
                                                                <p class="text-start">8763423468623428</p> -->
                                                                <p class="text-start">Withdrawal amount: <strong
                                                                        style="color: gold;">${{
                                                                            item.withdraw_amount.toFixed(2) }}</strong>
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p class="text-start">Currency Type:
                                                                    {{ item.currency_type_name }} </p>
                                                                <p class="text-start text-gray">Receiving address:</p>
                                                                <p class="text-start">{{ item.wallet_address }}</p>
                                                                <!-- <p class="text-start">Conin network: TRC20</p> -->
                                                            </td>
                                                            <td>
                                                                <p class="text-start">Payment failed</p>
                                                                <p class="text-start">Withdrawal amount: <strong
                                                                        class="text-danger">${{
                                                                            item.withdraw_amount.toFixed(2) }}</strong>
                                                                </p>
                                                                <p class="text-start">Handaling fee: <strong
                                                                        class="textdanger">${{
                                                                            calculateHandlingFee(item.withdraw_amount,
                                                                                item.payable_amount) }}</strong>
                                                                </p>
                                                                <p class="text-start">Payable amount: <strong
                                                                        class="text-danger">${{
                                                                            item.payable_amount.toFixed(2) }}</strong>
                                                                </p>
                                                                <p class="text-start">Time:
                                                                    {{ formatTime(item.created_at) }}</p>
                                                            </td>
                                                            <td>
                                                                <p>payment failed</p>
                                                            </td>
                                                            <td>{{ formatTime(item.created_at) }}</td>
                                                            <td><a type="button" class="btn_more"
                                                                    @click="withdrawMdal(item)">See
                                                                    more</a></td>
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
        </div>
        <MobileFooter />
        <!-- Start Modal  -->
        <!-- withdrawal records modal start here  -->
        <!-- Modal -->
        <div v-if="modalData" class="wd_record_mdal modal_">
            <div class="mdal_content">
                <div class="m_head">
                    <div class="w-10"></div>
                    <h6>Details</h6>
                    <button class="bt_close" @click="closeModal()">
                        <i class="fa-solid fa-x"></i>
                    </button>
                </div>
                <div class="_body">
                    <div class="personal_data mdal_info">
                        <div class="data_">
                            <h6>Withdrawal Information</h6>
                            <div>
                                <p class="text-start">Order number: {{ modalData.order_number }}</p>
                                <p class="text-start">Withdrawal amount: ${{ modalData.withdraw_amount.toFixed(2) }}</p>
                            </div>
                        </div>
                        <div class="data_">
                            <h6>Collection information</h6>
                            <div>
                                <p class="text-start">Currency Type: {{ modalData.currency_type_name }}</p>
                                <p class="text-start">Receiving address: {{ modalData.wallet_address }}</p>
                            </div>
                        </div>
                        <div class="data_">
                            <h6>Payment information</h6>
                            <div>
                                <p class="text-start">Payment failed</p>
                                <p class="text-start">Withdrawal amount: <strong class="text-danger">${{
                                    modalData.withdraw_amount.toFixed(2) }}</strong></p>
                                <p class="text-start">Handling fee: <strong class="textdanger">${{
                                    calculateHandlingFee(modalData.withdraw_amount, modalData.payable_amount)
                                        }}</strong></p>
                                <p class="text-start">Payable amount: <strong class="text-danger">${{
                                    modalData.payable_amount.toFixed(2) }}</strong></p>
                                <p class="text-start">Time: {{ formatTime(modalData.created_at) }}</p>
                            </div>
                        </div>
                        <div class="data_">
                            <h6>Remarks</h6>
                            <p>Payment failed</p>
                        </div>
                        <div class="data_">
                            <h6>Application time</h6>
                            <p>{{ formatTime(modalData.created_at) }}</p>
                        </div>
                        <div class="data_">
                            <h6>Update time</h6>
                            <p>{{ formatTime(modalData.updated_at) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- withdraw records modal end here  -->


        <!-- modal  -->
        <div class="depo_modal modal_">
            <div class="mdal_content">
                <div class="m_head">
                    <h6>Deposit </h6>
                    <button class="bt_close" @click="depositModalCls">
                        <i class="fa-solid fa-x"></i>
                    </button>
                </div>
                <div class="_body">
                    <div class="form_group">
                        <input type="text" class="form-control rounded-0" placeholder="Deposit amount"
                            v-model="walletData.depsoitAmount" @keyup="validateInput">
                        <button class="btn btn-primary w-100 mt-2 bt_s" type="button"
                            @click="submitDepositAmount">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <!--payment modal  -->
        <div class="payment_ modal_">
            <div class="mdal_content">
                <div class="m_head">
                    <h6>Payment Verification</h6>
                    <button class="bt_close" @click="paymentclose">
                        <i class="fa-solid fa-x"></i>
                    </button>
                </div>
                <div class="_body ">

                    <form @submit.prevent="saveData()">
                        <div class="form_group">
                            <!-- <h6 class="fw-bold m-0">Recharge Order Id: 978347234723</h6> -->
                            <p class="fw-bold mb-2">Recharge Amount: ${{ walletData.depsoitAmount }}</p>

                            <!-- tabs buttons  -->
                            <div class="tab_btns justify-content-center">
                                <ul class="nav nav-pills mb-3 w-100" id="pills-tab" role="tablist">
                                    <li class="nav-item w-50" role="presentation">
                                        <button class="nav-link active w-100" id="pills-one-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-one" type="button" role="tab"
                                            aria-controls="pills-one" aria-selected="true">Online Deposit</button>
                                    </li>
                                    <li class="nav-item w-50" role="presentation">
                                        <button class="nav-link w-100" id="pills-two-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-two" type="button" role="tab"
                                            aria-controls="pills-two" aria-selected="false">Offline Deposit</button>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-one" role="tabpanel"
                                    aria-labelledby="pills-one-tab">
                                    <h6 class="mb-0">Payment Option</h6>
                                    <!-- <input type="hidden" class="form-control rounded-0" placeholder="Deposite amount"
                                        v-model="walletData.depsoitAmount" @keyup="validateInput">
                                    <p>{{ walletData.payment_method }}</p>
                                    <img src="/assets/images/780x432.png" class="img-fluid" loading="lazy" alt=""> -->
                                    <div class="methodBox">
                                        <div class="form_group">
                                            <input type="radio" id="method4" name="method" hidden>
                                            <label for="method4">
                                                <img src="/assets/images/usdt.png" class="img-fluid" loading="lazy"
                                                    alt="">
                                            </label>
                                        </div>

                                    </div>
                                    <button @click="depoAddress()" class="btn btn-primary w-100 mt-2"
                                        type="submit">Confirm</button>
                                </div>
                                <div class="tab-pane fade show" id="pills-two" role="tabpanel"
                                    aria-labelledby="pills-two-tab">
                                    <!-- no data  -->
                                    <div class="no_data">
                                        <i class="fa-solid fa-triangle-exclamation"></i>
                                        <p>Offline Deposit not supported</p>
                                    </div>
                                    <!-- <button class="btn btn-primary w-100 mt-2" type="submit">Confirm</button> -->
                                </div>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
        <!-- END Modal -->

        <!--Deposit modal -->
        <div class="modal_ address_mdal">
            <div class="mdal_content  w-100" style="height: 80vh;">
                <div class="m_head">
                    <h6>Pay Confirm</h6>
                    <button class="bt_close" @click="closeMdal">
                        <i class="fa-solid fa-x"></i>
                    </button>
                </div>
                <div class="_body  h-100">
                    <div class="col-md-12 m-auto">
                        <div class="deposite_form h-100" style="min-height: 600px;">

                            <div class="loading-indicator" v-if="loading" style="text-align: center;">
                                        <Loader />
                                    </div>


                            <iframe :src="payurl" style="height: 600px;"  width="100%" title="Iframe Example"></iframe>
                            <!-- <iframe src="demo_iframe.htm"></iframe> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Modal -->
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
const depositArr = ref([]);
const acc_data = ref([]);
const withdrawArr = ref([]);
const searchDOrderId = ref('');
const searchWOrderId = ref('');
const current_balance = ref('');

//Payment getway
const payurl = ref('');

const walletData = ref({
    depsoitAmount: '',
    payment_method: 'USDT',
})

const acc_mdal = () => {
    $(".btn_more_mdal").fadeIn();
}
const depo_mdal = () => {
    $(".depo_record_mdal").fadeIn();
}
const closeMdal = () => {
    $(".address_mdal").fadeOut();
}

const modalData = ref(null);

const withdrawMdal = (item) => {
    $('.wd_record_mdal').fadeIn();
    modalData.value = item;
};
const closeModal = () => {
    modalData.value = null;
    $('.modal_').fadeOut();
};

const cls_modal = () => {
    $(".modal_").fadeOut();
}
const depoAddress = () => {
    $(".address_mdal").fadeIn();
}
const copynetwork = () => {
    const walletAddress = document.getElementById('network');
    const range = document.createRange();
    range.selectNode(walletAddress);
    window.getSelection().removeAllRanges();
    window.getSelection().addRange(range);
    document.execCommand('copy');
    window.getSelection().removeAllRanges();
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
        icon: "Success",
        title: "Successfully copied Network"
    });
}
const copyText = () => {
    const walletAddress = document.getElementById('walletAddress');
    const range = document.createRange();
    range.selectNode(walletAddress);
    window.getSelection().removeAllRanges();
    window.getSelection().addRange(range);
    document.execCommand('copy');
    window.getSelection().removeAllRanges();
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
        icon: "Success",
        title: "Successfully copied wallet"
    });
    // $(".address_mdal").fadeOut();
}
const getStatus = (status) => {
    let result = '';
    if (status === 0) {
        result = 'Under review';
    } else if (status === 1) {
        result = 'Has been approved';
    } else if (status === 2) {
        result = 'Has been rejected';
    }
    return result;
}
const calculateHandlingFee = (withdrawAmount, payableAmount) => {
    const handlingFee = withdrawAmount - payableAmount;
    return handlingFee.toFixed(2);
}
const formatTime = (createdAt) => {
    const date = new Date(createdAt);

    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    let hours = date.getHours();
    const minutes = String(date.getMinutes()).padStart(2, '0');
    const ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; // Handle midnight (0 hours)

    return `${year}-${month}-${day} ${hours}:${minutes} ${ampm}`;
}

const formatDate = (dateTimeString) => {
    const date = new Date(dateTimeString);
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();
    const hours = date.getHours();
    const minutes = date.getMinutes();
    const seconds = date.getSeconds();

    const formattedDay = day < 10 ? '0' + day : day;
    const formattedMonth = month < 10 ? '0' + month : month;
    const formattedHours = hours < 10 ? '0' + hours : hours;
    const formattedMinutes = minutes < 10 ? '0' + minutes : minutes;
    const formattedSeconds = seconds < 10 ? '0' + seconds : seconds;

    return `${formattedDay}-${formattedMonth}-${year} ${formattedHours}:${formattedMinutes}:${formattedSeconds}`;
};


const validateInput = (event) => {
    if (/\D/g.test(event.target.value)) {
        event.target.value = event.target.value.replace(/\D/g, '');
    }
}

const depositModal = () => {
    $(".depo_modal").fadeIn();
}

const depositModalCls = () => {
    $(".depo_modal").fadeOut();
}

const submitDepositAmount = () => {
    $(".depo_modal").fadeOut();

    const depositAmount = walletData?.value?.depsoitAmount;
    // Regular expression to match only numeric values
    const numericRegex = /^[0-9]+$/;
    if (!depositAmount || !numericRegex.test(depositAmount)) {

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
            icon: "error",
            title: "Please input a valid  amount"
        });
        return false;
    }

    $(".payment_").fadeIn();
}

const paymentclose = () => {
    $(".payment_").fadeOut();
}

const saveData = async () => {
    const formData = new FormData();
    formData.append('depsoitAmount', walletData.value.depsoitAmount);
    formData.append('payment_method', walletData.value.payment_method);
    const headers = {
        'Content-Type': 'multipart/form-data'
    };
    try {
        const loading = ref(true);
        const res = await axios.post('/dropUser/depositRequest', formData, { headers });
        payurl.value = res.data.payurl;
        console.log(res.data.payurl);

        walletData.value.depsoitAmount = '';
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
            title: "Successfully send your request"
        });
        depositList();
        paymentclose();
        //res.redirect_url
        // window.open(res.data.redirect_url, '_blank');
        router.push('/partner/globalstores/myWallet')

    } catch (error) {
        if (error.response && error.response.status === 422) {
            errors.value = error.response.data.errors;
        } else {
            console.error("An error occurred:", error);
        }
    } finally {
        const loading = ref(false);

    }
}

const accountDetails = async () => {
    try {
        loading.value = true; // Set loading to true before making the request
        let response;

        if (searchDOrderId.value) {
            response = await axios.get(`/dropUser/accountDetailsList?orderId=${searchDOrderId.value}`);
        } else {
            response = await axios.get("/dropUser/accountDetailsList");
        }

        acc_data.value = response.data.data;
    } catch (error) {
        console.error("Error fetching deposit list:", error);
    } finally {
        loading.value = false; // Set loading to false after the request completes (whether success or failure)
    }

};


const getCurrentBalance = async () => {
    try {
        let response;
        response = await axios.get("/dropUser/getCurrentBalance");
        current_balance.value = response.data.current_balance;
    } catch (error) {
        console.error("Error fetching deposit list:", error);
    }

};


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


const timer = () => {
    console.log("timer start...");
}

onMounted(() => {
    depositList();
    withdrawalList();
    accountDetails();
    getCurrentBalance();

});

</script>

<style scoped>
.s_content {
    padding: 10px;
    /* background: #fff; */
    border-radius: 15px;
    box-shadow: 0 0 37px #0815420d;
}

.content-header {
    padding: 5px .5rem;
}

.dash_box {
    display: flex;
    justify-content: space-between;
    /* background: #fff; */
    padding: 5px;
    border-radius: 15px;
    box-shadow: 0 0 37px #0815420d;
}

.pagination {
    display: flex;
}

.pagination span {
    color: #000;
}
</style>