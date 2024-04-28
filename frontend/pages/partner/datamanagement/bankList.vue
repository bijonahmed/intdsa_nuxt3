<template>
    <title>Bank List</title>
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

                <nav aria-label="breadcrumb d-flex justify-content-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><nuxt-link to="/partner/dashboard">Dashboard</nuxt-link></li>
                        <li class="breadcrumb-item"><a href="#">Withdrawal Method</a></li>
                    </ol>
                </nav>

                <div class="loading-indicator" v-if="loading" style="text-align: center;">
                    <Loader />
                </div>
                <!-- content part start here  -->
                <div class="s_content">

                    <ul class="card_list">
                        <li  v-for="(data, index) in datas" :key="index">
                            <div class="carde">
                                <div class="card-inner">
                                    <div class="front">
                                        <img src="/assets/images/Card.png" class="map-img">
                                        <div class="rows card-no">
                                            <p class="d-flex align-items-center">
                                                <!-- Initially show obscured wallet address -->
                                                {{ isAddressVisible(index) ? data.wallet_address :
                                                    obscuredWalletAddress(data.wallet_address) }}
                                                <!-- Button to toggle visibility and icon -->
                                                <button class="btn_edit" @click="toggleAddressVisibility(index)">
                                                    <i
                                                        :class="isAddressVisible(index) ? 'fa-solid fa-eye' : 'fa-solid fa-eye-slash'"></i>
                                                </button>
                                            </p>
                                        </div>
                                        <div class="rows name">
                                            <p>{{ data.name }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- <a class="position-absolute top-0 end-0 mr-2 mt-2" @click="update(data)"> <i
                                        class="fas fa-edit"></i></a> -->
                            </div>
                        </li>
                        
                    </ul>
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="m-0"></h6>
                        <!-- <button class="btn-primary bank_paymentMethod_open d-none p-2" @click="editCard">
                            <i class="fa-solid fa-edit"></i> Update address
                        </button> -->
                        <!-- If ID does not exist, show Add button -->
                        <button v-if="isEmpty(datas)" class="btn-primary bank_paymentMethod_open p-2" @click="addCard">
                            <i class="fa-solid fa-plus"></i> Add address
                        </button>
                    </div>


                </div>
                <!-- content part end here  -->
                
                <!-- main content part end here  -->
            </div>
        </div>
        <MobileFooter />


        <!-- add bank card part start start here  -->
        <div class="bank_paymentMethod modal_">
            <div class="mdal_content">
                <div class="m_head py-1">
                    <!-- <h6>Deposite Modal</h6> -->
                    <div class="w-50"></div>
                    <button class="bt_close" @click="closeCard">
                        <i class="fa-solid fa-x"></i>
                    </button>
                </div>
                <div class="_body">
                    <div class="form_group">



                        <div class="st_filter">
                            <form @submit.prevent="saveData()">

                                <div class="input_group">
                                    <p>Currency type<span class="text-danger">*</span></p>
                                    <select name="" id="mySelect2" class="form-control"
                                        v-model="insertData.currency_type_id">
                                        <option value="" disabled selected>Select one </option>
                                        <option v-for="type in typeArr" :key="type.id" :value="type.id">
                                            {{ type.name }}</option>
                                    </select>
                                    <span class="text-danger" v-if="errors.currency_type_id">{{
                                        errors.currency_type_id[0] }}</span>

                                </div>
                                <div id="additionalFields2">
                                    <div class="input_group">
                                        <p>Address<span class="text-danger">*</span> </p>
                                        <input type="text" placeholder="Address" class="form-control"
                                            v-model="insertData.wallet_address">
                                        <span class="text-danger" v-if="errors.wallet_address">{{
                                            errors.wallet_address[0] }}</span>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 mt-2">Save</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- add bank part end here  -->

        <!-- For edit mode -->

        <div class="bank_paymentMethod_edit modal_">
            <div class="mdal_content">
                <div class="m_head py-1">
                    <h6>Update</h6>
                    <div class="w-50"></div>
                    <button class="bt_close" @click="editCardCls">
                        <i class="fa-solid fa-x"></i>
                    </button>
                </div>
                <div class="_body">
                    <div class="form_group">
                        <div class="st_filter">
                            <form @submit.prevent="updateData()">
                                <input type="hidden" v-model="editinsertData.id" />
                                <div class="input_group">
                                    <p>Currency type<span class="text-danger">*</span></p>
                                    <select name="" id="mySelect2" class="form-control"
                                        v-model="editinsertData.currency_type_id">
                                        <option value="" disabled selected>Select one </option>
                                        <option v-for="type in typeArr" :key="type.id" :value="type.id">
                                            {{ type.name }}</option>
                                    </select>
                                    <span class="text-danger" v-if="errors.currency_type_id">{{
                                        errors.currency_type_id[0] }}</span>

                                </div>
                                <div id="additionalFields2">
                                    <div class="input_group">
                                        <p>Address<span class="text-danger">*</span> </p>
                                        <input type="text" placeholder="Address" class="form-control"
                                            v-model="editinsertData.wallet_address">
                                        <span class="text-danger" v-if="errors.wallet_address">{{
                                            errors.wallet_address[0] }}</span>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 mt-2">Save</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>




        <!-- END edit mode -->
    </div>
</template>

<script setup>

definePageMeta({
    middleware: 'is-logged-out',
})
const router = useRouter()
import axios from "axios";
import Swal from 'sweetalert2'
const loading = ref(false);
const typeArr = ref([]);
const errors = ref({})
const idExists = ref();

const addressVisibility = ref([]);

// Method to obscure the wallet address
const obscuredWalletAddress = (walletAddress) => {
    return '************' + walletAddress.slice(-2);
};

// Method to toggle address visibility
const toggleAddressVisibility = (index) => {
    addressVisibility.value[index] = !addressVisibility.value[index]; // Toggle visibility state
};

// Method to check if address is visible
const isAddressVisible = (index) => {
    return addressVisibility.value[index];
};
const editCard = () => {
    $(".bank_paymentMethod_edit").fadeIn();
}

const editCardCls = () => {
    $(".bank_paymentMethod_edit").fadeOut();
}

const addCard = () => {
    $(".bank_paymentMethod").fadeIn();
}

const closeCard = () => {
    $(".bank_paymentMethod").fadeOut();
}


const currencyType = async () => {
    try {
        loading.value = true; // Set loading to true before making the request
        let response;
        response = await axios.get("/dropUser/getCurrencyType");
        //console.log("wallet: " + response.data.chkWallet);
        // idExists.value = response.data.chkWallet;
        typeArr.value = response.data.data;
    } catch (error) {
        console.error("Error fetching deposit list:", error);
    } finally {
        loading.value = false; // Set loading to false after the request completes (whether success or failure)
    }

}



const copyAddressToClipboard = () => {
    // Get the text to copy
    const walletAddress = document.getElementById('walletAddress').innerText;

    // Create a textarea element to temporarily hold the text
    const textarea = document.createElement('textarea');
    textarea.value = walletAddress;
    textarea.setAttribute('readonly', '');
    textarea.style.position = 'absolute';
    textarea.style.left = '-9999px'; // Move the textarea off-screen

    // Add the textarea to the document
    document.body.appendChild(textarea);

    // Select the text in the textarea
    textarea.select();

    // Copy the selected text to the clipboard
    document.execCommand('copy');

    // Remove the textarea from the document
    document.body.removeChild(textarea);

    // Show a notification or perform any other action
    //alert('Address copied to clipboard');
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


const editinsertData = ref({
    id: '',
    currency_type_id: '',
    wallet_address: '',
})


const formatedAddress = (wallet_address) => {

    console.log("wallet_address: " + wallet_address);
    const firstThreeDigits = wallet_address.substring(0, 3);
    const lastThreeDigits = wallet_address.substring(wallet_address.length - 3);
    return `${firstThreeDigits}******${lastThreeDigits}`;

}
const datas = ref([]);
const checkWithdrawlMethodList2 = async () => {
    try {
        loading.value = true; // Set loading to true before making the request
        let response;
        response = await axios.get("/dropUser/checkWithdrawalMethod");
        console.log("wallet: " + response.data.data.wallet_address);
        datas.value = response.data.data;
        idExists.value = response.data.data.id;
        editinsertData.value.id = response.data.data.id;
        editinsertData.value.wallet_address = response.data.data.wallet_address;
        editinsertData.value.currency_type_id = response.data.data.currency_type_id;
    } catch (error) {
        console.error("Error fetching deposit list:", error);
    } finally {
        loading.value = false; // Set loading to false after the request completes (whether success or failure)
    }

}


const insertData = ref({
    currency_type_id: '',
    wallet_address: '',
})
const update = (data) => {
    $(".bank_paymentMethod_edit").fadeIn();
    editinsertData.value.id = data.id;
    editinsertData.value.currency_type_id = data.currency_type_id;
    editinsertData.value.wallet_address = data.wallet_address;
    editModalVisible.value = true;
}

const updateData = async () => {
    const formData = new FormData();
    formData.append('id', editinsertData.value.id);
    formData.append('currency_type_id', editinsertData.value.currency_type_id);
    formData.append('wallet_address', editinsertData.value.wallet_address);
    const headers = {
        'Content-Type': 'multipart/form-data'
    };
    try {
        const res = await axios.post('/dropUser/updateMakeBank', formData, { headers });
        idExists.value = res.data;
        //console.log("resposen: " + res.data);
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
            title: "Successfully Update"
        });
        editCardCls();
        checkWithdrawlMethodList2()
        router.push('/partner/datamanagement/bankList')

    } catch (error) {
        if (error.response && error.response.status === 422) {
            errors.value = error.response.data.errors;
        } else {
            //console.error("An error occurred:", error);
        }
    }
}


const saveData = async () => {
    const formData = new FormData();
    formData.append('id', editinsertData.value.id);
    formData.append('currency_type_id', insertData.value.currency_type_id);
    formData.append('wallet_address', insertData.value.wallet_address);
    const headers = {
        'Content-Type': 'multipart/form-data'
    };
    try {
        const res = await axios.post('/dropUser/makeBank', formData, { headers });
        idExists.value = res.data;
        //console.log("resposen: " + res.data);
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
            title: "Successfully"
        });
        closeCard();
        checkWithdrawlMethodList2();
        router.push('/partner/datamanagement/bankList')

    } catch (error) {
        if (error.response && error.response.status === 422) {
            errors.value = error.response.data.errors;
        } else {
            //console.error("An error occurred:", error);
        }
    }
}

onMounted(() => {
    currencyType();
    checkWithdrawlMethodList2()
});
</script>

<style scoped>
.s_content {
    padding: 5px;
    /* background: #fff; */
    border-radius: 15px;
    box-shadow: 0 0 37px #0815420d;
}
</style>
