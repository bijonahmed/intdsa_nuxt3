<template>
    <title>Active Service</title>
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
                                        <li class="breadcrumb-item active" aria-current="page">Active Store</li>
                                    </ol>
                                </nav>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- content-header -->
                <center>
                    <div class="loading-indicator" v-if="loading" style="text-align: center;">
                        <Loader />
                    </div>
                </center>
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <!-- {{ storeData }} -->
                        <!-- <center v-if="category_name">
                            <p>Store Name : {{ category_name }}</p>
                        </center> -->

                        <div v-if="errors">
                            <div class="alert-danger w-100">
                                <ul>
                                    <li v-for="(error, key) in errors" :key="key">{{ error[0] }}</li>

                                </ul>
                            </div>

                        </div>

                        <div v-if="messages.length > 0" class="alert-danger w-100">
                            {{ messages[0] }} <!-- Display the first message -->
                        </div>
                        <!-- <p>Comma-separated IDs: {{ commaSeparatedIds }}</p> -->
                        <!-- <p v-if="totalStorePrice && duration" class="alert-primary w-100">
                            Shop Price : ${{ totalStorePrice }}
                        </p> -->

                        <div class="services_">
                            <form @submit.prevent="submitForm">
                                <div class="store_container">
                                    <input type="hidden" v-model="commaSeparatedIds" readonly>
                                    <div v-for="(store, index) in storeData" :key="index" class="str_ ser_vice">
                                        <input type="checkbox" v-model="checkedstores" :value="store.id"
                                            :checked="isChecked(store.id)"
                                            @change="toggleStoreSelection(store.id, store.status)" :id="'store' + index"
                                            style="display: none;">
                                        <label class="" :for="'store' + index"
                                            @click.prevent="toggleStoreSelection(store.id, store.status)">
                                            <!-- {{ store.name }} -->
                                            <a type="button">
                                                <img src="/assets/images/storeService.png" alt="" class="img-fluid">
                                                <div class="check">
                                                    <i class="fa-solid fa-check"></i>
                                                </div>
                                            </a>
                                            <div class="priceDetails">
                                                <div class="pLeft">
                                                    <h1>{{ store.name }}</h1>
                                                    <p>Price:<strong> ${{ store.store_price }}</strong></p>
                                                    <span>30 Days </span>
                                                    <p>Store agency store</p>
                                                </div>
                                                <div class="pRht">
                                                    <button class="dMdal_open" @click="setDetails(store.id)"
                                                        type="button">Details
                                                        <i class="fa-solid fa-arrow-right"></i></button>
                                                    <strong>
                                                        {{ store.end_date }}
                                                        <div
                                                            :class="{ 'active': store.status === 'Active', 'inactive': store.status === 'Inactive' }">
                                                            {{ store.status }}
                                                        </div>
                                                    </strong>
                                                </div>
                                            </div>
                                        </label>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-between align-items-center my-2">
                                    <div class="d-flex justify-content-between align-items-center duration_">
                                        <p>Duration</p>
                                        <select name="" id="" class="form-control ms-2" v-model="duration">
                                            <option value="1">1 month</option>
                                            <option value="2">2 month</option>
                                            <option value="3">3 month</option>
                                            <option value="4">4 month</option>
                                            <option value="5">5 month</option>
                                            <option value="6">6 month</option>
                                            <option value="7">7 month</option>
                                            <option value="8">8 month</option>
                                            <option value="9">9 month</option>
                                            <option value="10">10 month</option>
                                            <option value="11">11 month</option>
                                            <option value="">12 month</option>
                                        </select>
                                    </div>
                                    <!-- <button type="submit" class="btn btn-primary confirm_ btn_success"
                                        style="color:black">Pay Now</button> -->
                                    <div class="">
                                        <strong class="me-2" v-if="totalStorePrice && duration"
                                            style="color: #f2c624;">Amount: ${{ totalStorePrice }}</strong>
                                        <button type="button" class="btn btn-primary confirm_ btn_success"
                                            @click="confirmCalculation" style="color:black">Pay Now</button>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">

                                    </div>
                                </div>

                                <!-- Confirm Modal -->
                                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="text-center" style="color: black; font-size: 15px;">
                                                    You calculated Price is : ${{ calculatedPrice }}<br>
                                                    Duration : {{ duration }} Months.
                                                </p>
                                            </div>
                                            <div class="modal-footer bg-dark">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Confirm Payment</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </section>
                <!-- main content part end here  -->
            </div>
            <!-- content section end here  -->
            <PartnerFooterLayout />

            <!-- details modal  -->
            <div class="dMdal_ modal_">
                <div class="mdal_content" style="max-width: 300px;">
                    <div class="m_head p-0 px-2">
                        <!-- <h6>Deposit Modal</h6> -->
                        <div class="w-50"></div>
                        <button class="bt_close" @click="closeModal()">
                            <i class="fa-solid fa-x"></i>
                        </button>
                    </div>
                    <div class="_body">
                        <div class="form_group">
                            <span v-if="storeId == 1">
                                <img src="/assets/images/service1.jpg" style=" width: 100%;" alt="" class="img-fluid">
                            </span>

                            <span v-if="storeId == 2">
                                <img src="/assets/images/service2.jpg" style=" width: 100%;" alt="" class="img-fluid">
                            </span>

                            <span v-if="storeId == 3">
                                <img src="/assets/images/service3.jpg" style=" width: 100%;" alt="" class="img-fluid">
                            </span>

                            <span v-if="storeId == 4">
                                <img src="/assets/images/service4.jpg" style=" width: 100%;" alt="" class="img-fluid">
                            </span>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <MobileFooter />
    </div>
</template>

<script setup>

import swal from 'sweetalert2';
import { ref, watch, onMounted } from "vue";
import axios from "axios";
const router = useRouter()
const loading = ref(true);
const store = ref('');
const category_name = ref('');
const calculatedPrice = ref('');
const storeData = ref([]);
const messages = ref([]);
const storeId = ref('');

const errors = ref([]);

const deposit_amount = ref('');
const duration = ref(1);

definePageMeta({
    middleware: 'is-logged-out',
})

let queryParams = {};
if (process.client) {
    queryParams = new URLSearchParams(window.location.search);
    const storeValue = queryParams.toString().split('=')[1];
    try {
        loading.value = true;
        const response = await axios.post('/store/checkMystoreData', {
            my_store_id: storeValue // Send the email value in the request body
        });
        console.log("Store ID: " + storeValue);
        console.log("Category Name: " + response.data.category_name);
        category_name.value = response.data.category_name;
        deposit_amount.value = response.data.deposit_amount;
        store.value = storeValue;

    } catch (error) {
        console.error('An error occurred:', error);
    } finally {
        loading.value = false;
    }
}

const confirmCalculation = async () => {
    const shop_price = totalStorePrice.value;
    const dura = duration.value;
    const result = shop_price * dura;
    //console.log("commaSeparatedIds: " + commaSeparatedIds.value);
    //totalStorePrice.value = shop_price;
    //console.log("Total Store Price : " + shop_price);
    //console.log("changes duration" + dura);
    //console.log("result " + result);
    calculatedPrice.value = result;

    $('#myModal').modal('show');

}
const submitForm = async () => {
    $('#myModal').modal('hide');
    //calculation: 
    const shop_price = totalStorePrice.value;
    const dura = duration.value;
    const result = shop_price * dura;
    //console.log("commaSeparatedIds: " + commaSeparatedIds.value);
    //totalStorePrice.value = shop_price;
    //console.log("Total Store Price : " + shop_price);
    //console.log("changes duration" + dura);
    //console.log("result " + result);
    calculatedPrice.value = result;
    //return false;
    const formData = new FormData();
    //formData.append('mystore_id', store.value);
    formData.append('mystore_id', commaSeparatedIds.value);
    formData.append('store_price', result);
    //formData.append('checkedServices', checkedServices.value);
    formData.append('duration', duration.value);
    const headers = {
        'Content-Type': 'multipart/form-data'
    };
    try {
        loading.value = true;
        const res = await axios.post('/store/insertService', formData, { headers });
        // console.log("Success : " + res.data.message);
        router.push('/partner/globalstores/activeServiceMessages')
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        Toast.fire({
            icon: "success",
            title: "Has been successfully added"
        });

    } catch (error) {
        if (error.response && error.response.status === 422) {
            errors.value = error.response.data.errors;
            // messages.value = error.response.data.messages;
            messages.value = error.response.data.errors;
            //errors.value = error.response.data.messages;
            // console.log("++:" + error.response.data.messages);

        } else {
            console.error("An error occurred:", error);
        }
    } finally {
        loading.value = false;
    }
}

const getActiveService = async () => {
    try {
        loading.value = true;
        const response = await axios.get('/store/getAllServices');
        storeData.value = response.data.storeData;

    } catch (error) {
        console.error('An error occurred:', error);
    } finally {
        loading.value = false;
    }
};

const checkedServices = ref([])
const selectedIds = ref('')

// Function to check if a store is selected
const isChecked = (storeId) => {
    return checkedServices.value.includes(storeId); // Returns true or false
};

// Function to toggle store selection
// const toggleStoreSelection = (storeId,status) => {
//     const index = checkedServices.value.indexOf(storeId);
//     if (index === -1) {
//         console.log("status: " + status);
//         checkedServices.value.push(storeId); // Add if not in the list
//     } else {
//         console.log("status: " + status);
//         checkedServices.value.splice(index, 1); // Remove if already in the list
//     }
// };

const toggleStoreSelection = (storeId, status) => {
    const index = checkedServices.value.indexOf(storeId);
    // If the store is Active, prevent adding to checkedServices and uncheck if already checked
    if (status === 'Active') {
        console.log(`Store with ID ${storeId} is active. Cannot be selected.`);
        if (index !== -1) {
            // If it's in the list, remove it to uncheck
            checkedServices.value.splice(index, 1);
        }
    } else {
        if (index === -1) {
            console.log(`Store with ID ${storeId} added to selection.`);
            checkedServices.value.push(storeId); // Add if not in the list
        } else {
            console.log(`Store with ID ${storeId} removed from selection.`);
            checkedServices.value.splice(index, 1); // Remove if already in the list
        }
    }
};

// Computed property to get the comma-separated list of selected IDs
const commaSeparatedIds = computed(() => {
    const selectedIdsArray = checkedServices.value.map((id) => id.toString());
    return selectedIdsArray.join(',');
});

// Computed property to calculate the total store_price for selected stores
const totalStorePrice = computed(() => {
    return storeData.value
        .filter((store) => checkedServices.value.includes(store.id)) // Select only the stores that are checked
        .reduce((total, store) => total + store.store_price, 0); // Sum their store_prices

});

onMounted(async () => {
    getActiveService()
})
const setDetails = (id) => {
    storeId.value = id;
    $(".dMdal_").fadeIn();
}
const closeModal = () => {
    $(".dMdal_").fadeOut();
}
const success_noti = () => {
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
        title: "Successfully Applied!"
    });
}
</script>

<style>
.content-header {
    padding: 5px .1rem;
}

.active {
    color: green;
    /* Green color for active status */
}

.inactive {
    color: red;
    /* Red color for inactive status */
}
</style>
