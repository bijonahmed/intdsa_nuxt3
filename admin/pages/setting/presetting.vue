<template>
    <title>Pre-Setting</title>
    <div>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <p>Pre-Setting</p>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <LazyNuxtLink to="/admin/dashboard">Dashboard</LazyNuxtLink>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <!-- Start -->
                    <div class="card border-top border-0 border-4 border-info">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <form @submit.prevent="saveData()" id="formrest" class="forms-sample"
                                    enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <label for="inputEnterYourName" class="col-sm-3 col-form-label">Company
                                            name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control name" v-model="insertdata.name"
                                                id="name" placeholder="Company name">
                                            <span class="text-danger" v-if="errors.name">{{ errors.name[0] }}</span>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputEnterYourName" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control email" v-model="insertdata.email"
                                                placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputEnterYourName" class="col-sm-3 col-form-label">Address</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control address" v-model="insertdata.address"
                                                placeholder="Address">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputEnterYourName" class="col-sm-3 col-form-label">WhatsApp</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control whatsApp"
                                                v-model="insertdata.whatsApp" placeholder="WhatsApp">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputEnterYourName" class="col-sm-3 col-form-label">Business
                                            Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control description" v-model="insertdata.description"
                                                placeholder="Business Description"></textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputEnterYourName" class="col-sm-3 col-form-label">Currency</label>
                                        <div class="col-sm-9">

                                            <select class="form-control currency" v-model="insertdata.currency">
                                                <option value="$">US Dollar ($)</option>
                                                <option value="€">Euro (€)</option>
                                                <option value="£">British Pound (£)</option>
                                                <option value="¥">Japanese Yen (¥)</option>
                                                <option value="A$">Australian Dollar (A$)</option>
                                                <option value="C$">Canadian Dollar (C$)</option>
                                                <option value="CHF">Swiss Franc (CHF)</option>
                                                <option value="CN¥">Chinese Yuan (CN¥)</option>
                                                <option value="₽">Russian Ruble (₽)</option>
                                                <option value="₹">Indian Rupee (₹)</option>
                                                <option value="R">South African Rand (R)</option>
                                                <option value="NZ$">New Zealand Dollar (NZ$)</option>
                                                <option value="kr">Swedish Krona (kr)</option>
                                                <option value="₩">South Korean Won (₩)</option>
                                                <option value="₺">Turkish Lira (₺)</option>
                                                <option value="Mex$">Mexican Peso (Mex$)</option>
                                                <option value="R$">Brazilian Real (R$)</option>
                                                <option value="฿">Thai Baht (฿)</option>
                                                <option value="₱">Philippine Peso (₱)</option>
                                                <option value="Rp">Indonesian Rupiah (Rp)</option>
                                                <option value="₪">Israeli New Shekel (₪)</option>
                                                <option value="د.إ">UAE Dirham (د.إ)</option>
                                                <option value="kr">Norwegian Krone (kr)</option>
                                                <option value="HK$">Hong Kong Dollar (HK$)</option>
                                                <option value="kr">Danish Krone (kr)</option>
                                                <option value="S$">Singapore Dollar (S$)</option>
                                                <option value="RM">Malaysian Ringgit (RM)</option>
                                                <option value="kr">Polish Złoty (zł)</option>
                                                <option value="¥">Taiwan New Dollar (NT$)</option>
                                                <option value="₦">Nigerian Naira (₦)</option>
                                                <option value="৳">Bangladeshi Taka (৳)</option>
                                                <option value="₨">Pakistani Rupee (₨)</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputEnterYourName" class="col-sm-3 col-form-label">FB Link</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control fblink" v-model="insertdata.fblink"
                                                placeholder="FBlink">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputEnterYourName" class="col-sm-3 col-form-label">Website</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control website" v-model="insertdata.website"
                                                placeholder="Website">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputEnterYourName" class="col-sm-3 col-form-label">Telegram</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control website"
                                                v-model="insertdata.telegram" placeholder="Telegram">
                                        </div>
                                    </div>

                                    <hr />

                                    <div class="row mb-3">
                                        <label for="inputEnterYourName" class="col-sm-3 col-form-label">Deposit Service
                                            Charge</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control deposit_service_charge"
                                                v-model="insertdata.deposit_service_charge" placeholder="0.00">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputEnterYourName" class="col-sm-3 col-form-label">Withdrawal
                                            Service Charge</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control withdraw_service_charge"
                                                v-model="insertdata.withdraw_service_charge" placeholder="0.00">
                                        </div>
                                    </div>

                                    <hr />

                                    <div class="row mb-3">
                                        <label for="inputEnterYourName" class="col-sm-3 col-form-label">Withdrawal
                                            Minimum Amount</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control nagad_number"
                                                v-model="insertdata.withdraw_minimum_amount" placeholder="0.00">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputEnterYourName" class="col-sm-3 col-form-label">Crypto Wallet
                                            Address</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control crypto_wallet_address"
                                                v-model="insertdata.crypto_wallet_address" placeholder="0.00">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputEnterYourName"
                                            class="col-sm-3 col-form-label">Copyright</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control copyright"
                                                v-model="insertdata.copyright" placeholder="Copyright">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <button type="submit" class="btn btn-success px-5 w-100"><i
                                                    class="bx bx-check-circle mr-1"></i> Submit</button>
                                        </div>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
                <!-- END -->
            </section>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
import swal from 'sweetalert2';
window.Swal = swal;

definePageMeta({
    middleware: 'is-logged-out',
})

const previewUrl = ref(null);
//const files = ref(null);
const file = ref(null);
const insertdata = reactive({
    name: '',
    email: '',
    address: '',
    whatsApp: '',
    telegram: '',
    deposit_service_charge: '',
    withdraw_service_charge: '',
    crypto_wallet_address: '',
    store_policy: '',
    description: '',
    website: '',
    copyright: '',
    currency: '',
    fblink: '',
});

const errors = ref({});
const notifmsg = ref('');
const router = useRouter();

const checkImageDimensionsThunbnail = (file) => {
    const reader = new FileReader();
    reader.onload = (e) => {
        const img = new Image();
        img.src = e.target.result;
        img.onload = () => {
            previewUrl.value = e.target.result;
        };
    };
    reader.readAsDataURL(file);
    //resetInput();
};

const previewImage = (event) => {
    const file = event.target.files[0];
    previewUrl.value = URL.createObjectURL(file);
    checkImageDimensionsThunbnail(file);
};

const onFileSelected = (event) => {
    previewImage(event)
    file.value = event.target.files[0];
};

const saveData = () => {

    const formData = new FormData();
    formData.append('name', insertdata.name);
    formData.append('email', insertdata.email);
    formData.append('address', insertdata.address);
    formData.append('whatsApp', insertdata.whatsApp);
    formData.append('description', insertdata.description);
    formData.append('copyright', insertdata.copyright);
    formData.append('currency', insertdata.currency);
    formData.append('fblink', insertdata.fblink);
    formData.append('telegram', insertdata.telegram);
    formData.append('deposit_service_charge', insertdata.deposit_service_charge);
    formData.append('withdraw_service_charge', insertdata.withdraw_service_charge);
    formData.append('crypto_wallet_address', insertdata.crypto_wallet_address);
    formData.append('store_policy', insertdata.store_policy);
    formData.append('website', insertdata.website);
    const headers = {
        'Content-Type': 'multipart/form-data'
    };
    axios.post('/setting/upateSetting', formData, { headers })
        .then((res) => {

            success_noti();
            router.push('/setting/presetting');
        }).catch(error => {
            if (error.response && error.response.status === 422) {
                errors.value = error.response.data.errors;
            } else {
                // Handle other types of errors here
                console.error('An error occurred:', error);
            }
        });
};

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
        title: "Your data has been successfully update."
    });
};


const loadingRow = () => {
    const id = router.currentRoute.value.query.parameter;
    //console.log("----" + category_id);
    axios.get(`/setting/settingrow`).then(response => {
        //console.log("====" + response.data.data.name);
        //return false; 
        insertdata.name = response.data.data.name;
        insertdata.email = response.data.data.email;
        insertdata.address = response.data.data.address;
        insertdata.whatsApp = response.data.data.whatsApp;
        insertdata.description = response.data.data.description;
        insertdata.copyright = response.data.data.copyright;
        insertdata.currency = response.data.data.currency;
        insertdata.fblink = response.data.data.fblink;
        insertdata.website = response.data.data.website;
        insertdata.telegram = response.data.data.telegram;
        insertdata.deposit_service_charge = response.data.data.deposit_service_charge;
        insertdata.withdraw_service_charge = response.data.data.withdraw_service_charge;
        insertdata.crypto_wallet_address = response.data.data.crypto_wallet_address;
        //insertdata.store_policy = response.data.data.store_policy;
        insertdata.withdraw_minimum_amount = response.data.data.withdraw_minimum_amount;
        //previewUrl.value = response.data.images;

    });
};

// Call the loadeditor function when the component is mounted
onMounted(async () => {
    loadingRow();

});



</script>
