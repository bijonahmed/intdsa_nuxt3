<template>
    <title>Partners</title>
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
                                        <li class="breadcrumb-item active" aria-current="page">Partners</li>
                                    </ol>
                                </nav>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- content-header -->
                <!-- <h1><button type="button" @click="levelFourNumOfStoreCount">Process</button></h1> -->
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <center>
                            <div class="loading-indicator" v-if="loading" style="text-align: center;">
                                <Loader />
                            </div>
                        </center>
                        <div class="row">
                            <div class="col-md-12 px-0 mx-0">
                                <!-- content part start here  -->
                                <div class="s_content">
                                    <div class="comission_container">

                                        <div class="dash_box">
                                            <i class="fa-solid fa-tag"></i>
                                            <div class="dash_C">
                                                <h3>Total commission income</h3>
                                                <h1>$0</h1>
                                                <span>Commission income for the day: $0</span>
                                                <span>Commission income for the Week: $0</span>
                                                <span>Commission income for the month: $0</span>
                                            </div>
                                        </div>
                                        <div class="dash_box">
                                            <i class="fa-solid fa-users"></i>
                                            <div class="dash_C">
                                                <h3 class="d-flex justify-content-between w-100">My
                                                    Partners <nuxt-link to="total-partners"><i
                                                            class="fa-solid fa-arrow-right"></i></nuxt-link></h3>
                                                <h1>{{ totalUserCount }}</h1>
                                                <span>Number of store: {{ my_partners_num_of_store }}</span>
                                                <span>Close operations/ Number of non operation: {{
                                                    my_partners_num_of_close_store }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="store_container_partners">

                                        <div class="dash_box">
                                            <i class="fa-solid fa-store"></i>
                                            <div class="dash_C">
                                                <!-- <h3>Store</h3> -->
                                                <h1>Level(1)</h1>
                                                <span>Number of store: {{ level_one_num_of_store }}</span>
                                                <span>Close operations/ Number of non operation: {{
                                                    level_one_num_of_close_store }}</span>
                                            </div>
                                        </div>
                                        <div class="dash_box">
                                            <i class="fa-solid fa-store"></i>
                                            <div class="dash_C">
                                                <!-- <h3>Store</h3> -->
                                                <h1>Level(2)</h1>
                                                <span>Number of store: {{ level_two_num_of_store }}</span>
                                                <span>Close operations/ Number of non operation: {{
                                                    level_two_num_of_close_store }}</span>
                                            </div>
                                        </div>
                                        <div class="dash_box">
                                            <i class="fa-solid fa-store"></i>
                                            <div class="dash_C">
                                                <!-- <h3>Store</h3> -->
                                                <h1>Level(3)</h1>
                                                <span>Number of store: {{ level_three_num_of_store }}</span>
                                                <span>Close operations/ Number of non operation: {{
                                                    level_three_num_of_close_store }}</span>
                                            </div>
                                        </div>
                                        <div class="dash_box">
                                            <i class="fa-solid fa-store"></i>
                                            <div class="dash_C">
                                                <!-- <h3>Store</h3> -->
                                                <h1>Level(4)</h1>
                                                <span>Number of store: {{ level_four_num_of_store }}</span>
                                                <span>Close operations/ Number of non operation: {{
                                                    level_four_num_of_close_store }}</span>
                                            </div>
                                        </div>
                                        <div class="dash_box">
                                            <i class="fa-solid fa-store"></i>
                                            <div class="dash_C">
                                                <!-- <h3>Store</h3> -->
                                                <h1>Level(5)</h1>
                                                <span>Number of store: {{ level_five_num_of_store }}</span>
                                                <span>Close operations/ Number of non operation: {{
                                                    level_five_num_of_store }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="store_container_partners">
                                        <div class="store_box">
                                            <h5>Invite</h5>
                                            <ul>
                                                <li>
                                                    <div>
                                                        <p>Invitation link</p>
                                                        <strong id="invite_link" class="textToCopy">
                                                            {{ intielink }}
                                                        </strong>

                                                    </div>
                                                    <button type="button" @click="copyAddressToClipboard()"
                                                        class="btn_copy copyButton"><i
                                                            class="fa-solid fa-copy"></i></button>
                                                </li>
                                                <li>
                                                    <div>
                                                        <p>Invitation code </p>
                                                        <strong id="invite_code" class="textToCopy">{{ inviteCode
                                                            }}</strong>
                                                    </div>
                                                    <button type="button" @click="copycode()"
                                                        class="btn_copy copyButton"><i
                                                            class="fa-solid fa-copy"></i></button>
                                                </li>
                                                <!-- <li>
                                                    <div>
                                                        <p>Invitation QR code </p>
                                                    </div>
                                                    <img src="/assets/images/qrcode.jpg" alt="" class="img-fluid">
                                                </li> -->
                                            </ul>

                                        </div>

                                        <div class="store_box">
                                            <h5>Distribution Agreement:</h5>
                                            <p>If the order is transferred to a partner, you will receive 10% of the
                                                profit from
                                                the completed order, and the partner will receive 90% of the profit.</p>
                                        </div>
                                        <div class="store_box">
                                            <h5>Income distribution of partners’ shares:</h5>
                                            <p>Level 1 profit 5%</p>
                                            <p>Level 2 profit 4%</p>
                                            <p>Level 3 profit 3%</p>
                                            <p>Level 4 profit 2%</p>
                                            <p>Level 5 profit 1%</p>
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
import { ref, reactive, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
const router = useRouter();
const loading = ref(false);
definePageMeta({
    middleware: 'is-logged-out',
})
// import { defineComponent } from '@vue/composition-api'
const copycode = () => {
    // Get the text to copy
    const walletAddress = document.getElementById('invite_code').innerText;
    // Create a textarea element to temporarily hold the text
    const textarea = document.createElement('textarea');
    textarea.value = walletAddress;
    textarea.setAttribute('readonly', '');
    textarea.style.position = 'absolute';
    textarea.style.left = '-9999px'; // Move the textarea off-screen
    document.body.appendChild(textarea);
    textarea.select();
    document.execCommand('copy');
    document.body.removeChild(textarea);
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
        title: "Successfully copy"
    });
}
const copyAddressToClipboard = () => {
    // Get the text to copy
    const walletAddress = document.getElementById('invite_link').innerText;
    const textarea = document.createElement('textarea');
    textarea.value = walletAddress;
    textarea.setAttribute('readonly', '');
    textarea.style.position = 'absolute';
    textarea.style.left = '-9999px'; // Move the textarea off-screen
    document.body.appendChild(textarea);
    textarea.select();
    document.execCommand('copy');
    document.body.removeChild(textarea);
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
        title: "Successfully copy"
    });
}

const inviteCode = ref('');
const intielink = ref('');
const getInviteCode = async () => {
    try {
        const response = await axios.get(`/user/getInviteCode`);
        const setIntielink = window.location.origin + '/invite-code/?code=' + response.data.inviteCode;
        console.log("link : " + setIntielink);
        console.log("code : " + response.data.inviteCode);
        inviteCode.value = response.data.inviteCode;
        intielink.value = setIntielink;

    } catch (error) {
        console.error(error);
    }
};

//Count Partners
const levels = ref([]);
const totalUserCount = ref(0);
const my_partners_num_of_store = ref(0);
const my_partners_num_of_close_store = ref(0);

const level_one_num_of_store = ref(0);
const level_one_num_of_close_store = ref(0);

const level_two_num_of_store = ref(0);
const level_two_num_of_close_store = ref(0);

const level_three_num_of_store = ref(0);
const level_three_num_of_close_store = ref(0);

const level_four_num_of_store = ref(0);
const level_four_num_of_close_store = ref(0);

const level_five_num_of_store = ref(0);
const level_five_num_of_close_store = ref(0);

const levelFiveNumOfStoreCount = async () => {
    try {
        const response = await axios.get('/store/activeInactiveStoreLevelFive');
        //console.log("res:"  + response.data.active_shop_count);
        level_five_num_of_store.value = response.data.active_shop_count;
        level_five_num_of_close_store.value = response.data.inactive_shop_count;

    } catch (error) {
        console.error('An error occurred while fetching partners:', error);
    }
};


const levelFourNumOfStoreCount = async () => {
    try {
        const response = await axios.get('/store/activeInactiveStoreLevelFour');
        //console.log("res:"  + response.data.active_shop_count);

        level_four_num_of_store.value = response.data.active_shop_count;
        level_four_num_of_close_store.value = response.data.inactive_shop_count;

    } catch (error) {
        console.error('An error occurred while fetching partners:', error);
    }
};

const levelThreeNumOfStoreCount = async () => {
    try {
        const response = await axios.get('/store/activeInactiveStoreLevelThree');
        //console.log("res:"  + response.data.active_shop_count);

        level_three_num_of_store.value = response.data.active_shop_count;
        level_three_num_of_close_store.value = response.data.inactive_shop_count;

    } catch (error) {
        console.error('An error occurred while fetching partners:', error);
    }
};




const levelTwoNumOfStoreCount = async () => {
    try {
        const response = await axios.get('/store/activeInactiveStoreLevelTwo');
        //console.log("res:"  + response.data.active_shop_count);
        level_two_num_of_store.value = response.data.active_shop_count;
        level_two_num_of_close_store.value = response.data.inactive_shop_count;

    } catch (error) {
        console.error('An error occurred while fetching partners:', error);
    }
};



const levelOneNumOfStoreCount = async () => {
    try {
        const response = await axios.get('/store/activeInactiveStoreLevelOne');
        //console.log("res:"  + response.data.active_shop_count);
        level_one_num_of_store.value = response.data.active_shop_count;
        level_one_num_of_close_store.value = response.data.inactive_shop_count;

    } catch (error) {
        console.error('An error occurred while fetching partners:', error);
    }
};


const numberOfStoreCal = async () => {
    try {
        const response = await axios.get('/store/activeInactiveStore');
        //console.log("res:"  + response.data.active_shop_count);
        my_partners_num_of_store.value = response.data.active_shop_count;
        my_partners_num_of_close_store.value = response.data.inactive_shop_count;

    } catch (error) {
        console.error('An error occurred while fetching partners:', error);
    }
};
// Computed property to calculate the total user count
const numberOfPartner = async () => {
    try {
        loading.value = true;
        const response = await axios.get('/store/getMyPartners');
        levels.value = response.data;
        // After fetching the levels, calculate the total user count
        let count = 0;
        for (const level of levels.value) {
            count += level.users.length; // Add the number of users in each level to the count
        }
        totalUserCount.value = count; // Set the calculated total count
    } catch (error) {
        console.error('An error occurred while fetching partners:', error);
    } finally {
        loading.value = false;
    }
};
onMounted(async () => {
    getInviteCode();
    numberOfPartner()
    numberOfStoreCal();
    levelOneNumOfStoreCount();
    levelTwoNumOfStoreCount();
    levelThreeNumOfStoreCount();
    levelFourNumOfStoreCount();
    levelFiveNumOfStoreCount();

});

</script>
