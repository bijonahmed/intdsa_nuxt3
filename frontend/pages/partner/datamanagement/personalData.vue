<template>
    <title>Personal Data</title>
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
                                        <li class="breadcrumb-item active" aria-current="page">Personal Data</li>
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
                                <div class="s_content">
                                    <div class="row">
                                        <div class="col-md-6 m-auto">
                                            <div class="personal_data">
                                                <!-- <form @submit.prevent="saveData()" id="userSubmitFrm"
                                                    class="form-horizontal" enctype="multipart/form-data"> -->

                                                <div class="data_">
                                                    <h6>User Name: </h6>
                                                    <p>admin</p>
                                                </div>
                                                <form action="" @submit.prevent="saveRealname()" id="userSubmitFrm">
                                                    <div class="data_" v-if="r_name">
                                                        <h6>Real name: </h6>
                                                        <p>{{ r_name }}</p>
                                                    </div>
                                                    <div class="data_" v-else>
                                                        <h6>Real name: </h6>
                                                        <input type="text" v-model="proData.real_name" class="px-1"
                                                            placeholder="Enter your real name">
                                                        <button type="submit" class="btn-outline-primary btn py-0 px-1"
                                                            style="font-size: 12px;">Update</button>
                                                    </div>
                                                </form>

                                                <div class="data_">
                                                    <h6>Email: </h6>
                                                    <!-- <p>us***@***.com</p> -->
                                                    <p>{{ email }}</p>
                                                    <nuxt-link to="/partner/datamanagement/accountSecurity"
                                                        class="btn_close">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </nuxt-link>
                                                </div>
                                                <div class="data_">
                                                    <h6>Phone: </h6>
                                                    <!-- <p>+12******10</p> -->
                                                    <p>{{ phone }}</p>
                                                    <nuxt-link to="/partner/datamanagement/accountSecurity"
                                                        class="btn_close">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </nuxt-link>
                                                </div>
                                                <form @submit.prevent="updateSocial()" enctype="multipart/form-data">
                                                    <div class="data_">
                                                        <h6>Telegrame:</h6>
                                                        <input type="text" class="" placeholder="Not filled"
                                                            v-model="telegram">
                                                        <button type="submit" class="btn-outline-primary btn py-0 px-1"
                                                            style="font-size: 12px;">Update</button>

                                                    </div>
                                                </form>
                                                <form @submit.prevent="updateSocial()" enctype="multipart/form-data">
                                                    <div class="data_">
                                                        <h6>WhatsApp: </h6>
                                                        <input type="text" class="" placeholder="Not filled"
                                                            v-model="whtsapp">
                                                        <button type="submit" class="btn-outline-primary btn py-0 px-1"
                                                            style="font-size: 12px;">Update</button>
                                                    </div>
                                                </form>
                                                <div class="data_">
                                                    <h6>Registration Date/Time: </h6>
                                                    <!-- <p>2024-02-07</p> -->
                                                    <p>{{ created_at }}</p>
                                                </div>
                                                <hr>
                                                <div class="data_">
                                                    <h6>Email</h6>
                                                    <p v-if="email"><img src="/assets/images/verified-50.png"
                                                            height="30px" alt="" class="img-fluid"></p>
                                                    <nuxt-link v-else to="/partner/datamanagement/accountSecurity">
                                                        <img src="/assets/images/verified-50(1).png" alt=""
                                                            class="img-fluid">
                                                    </nuxt-link>
                                                </div>
                                                <div class="data_">
                                                    <h6>Phone</h6>
                                                    <p v-if="phone"><img src="/assets/images/verified-50.png"
                                                            height="30px" alt="" class="img-fluid"></p>
                                                    <nuxt-link v-else to="/partner/datamanagement/accountSecurity">
                                                        <img src="/assets/images/verified-50(1).png" alt=""
                                                            class="img-fluid">
                                                    </nuxt-link>
                                                </div>

                                                <div class="data_">
                                                    <h6>KYC Varification</h6>
                                                    <p v-if="doc_file"><img src="/assets/images/verified-50.png"
                                                            height="30px" alt="" class="img-fluid"></p>
                                                    <nuxt-link v-else to="/partner/datamanagement/accountSecurity">
                                                        <img src="/assets/images/verified-50(1).png" alt=""
                                                            class="img-fluid"></nuxt-link>
                                                </div>
                                                <div class="data_">
                                                    <h6>Withdrawal Pasword</h6>
                                                    <p v-if="with_password"><img src="/assets/images/verified-50.png"
                                                            height="30px" alt="" class="img-fluid"></p>
                                                    <nuxt-link v-else to="/partner/datamanagement/accountSecurity">
                                                        <img src="/assets/images/verified-50(1).png" alt=""
                                                            class="img-fluid">
                                                    </nuxt-link>
                                                </div>
                                                <!-- </form> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
                <!-- content section end here  -->
            </div>
        </div>
        <PartnerFooterLayout />
        <MobileFooter />
    </div>
</template>

<script setup>
definePageMeta({
    middleware: 'is-logged-out',
})
import { ref, reactive, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';
import swal from 'sweetalert2';
const router = useRouter();
if (process.client) {
    window.Swal = swal;

}
const previewUrl = ref(null);
const files = ref(null);
const file = ref(null);
const errors = ref({});
const name = ref('');
const email = ref('');
const phone = ref('');
const doc_file = ref('');
const with_password = ref('');
const othersway_connect = ref('');

const created_at = ref('');
const updated_at = ref('');


const telegram = ref('');
const whtsapp = ref('');



// const profileData = ref('');
const r_name = ref('');
const proData = reactive({
    real_name: '',
});
const saveRealname = () => {
    const formData = new FormData();
    formData.append('real_name', proData.real_name);
    // console.log(formData);
    const headers = {
        'Content-Type': 'multipart/form-data'
    };
    axios.post('/user/addrealname', formData, { headers })
        .then((res) => {
            // file.value = res.data.dataImg;
            document.getElementById('userSubmitFrm').reset();
            success_noti();
            // console.log(res.data);
            router.push('/partner/datamanagement/personalData');
        }).catch(error => {
            if (error.response && error.response.status === 422) {
                errors.value = error.response.data.errors;
            }
        });
}


const previewImage = (event) => {
    const file = event.target.files[0];
    previewUrl.value = URL.createObjectURL(file);
    checkImageDimensionsThunbnail(file);
};

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

const onFileSelected = (event) => {
    previewImage(event)
    file.value = event.target.files[0];
};



const saveData = () => {
    const formData = new FormData();
    formData.append('file', file.value);
    const headers = {
        'Content-Type': 'multipart/form-data'
    };
    axios.post('/user/updateUserProfileImg', formData, { headers })
        .then((res) => {
            file.value = res.data.dataImg;
            document.getElementById('userSubmitFrm').reset();
            success_noti();
            router.push('/partner/datamanagement/personalData');
        }).catch(error => {
            if (error.response && error.response.status === 422) {
                errors.value = error.response.data.errors;
            }
        });
};

const updateSocial = () => {

    const formData = new FormData();
    formData.append('telegram', telegram.value);
    formData.append('whtsapp', whtsapp.value);
    formData.append('othersway_connect', othersway_connect.value);

    const headers = {
        'Content-Type': 'multipart/form-data'
    };
    axios.post('/auth/updateUserProfileSocial', formData, { headers })
        .then((res) => {
            telegram.value = res.data.telegram;
            whtsapp.value = res.data.whtsapp;
            whtsapp.othersway_connect = res.data.othersway_connect;
            success_noti();
            router.push('/partner/datamanagement/personalData');
        }).catch(error => {
            if (error.response && error.response.status === 422) {
                errors.value = error.response.data.errors;
            }
        });

}


//Find Product Row
const checkRow = () => {
    axios.get(`/auth/showProfileData`).then(response => {
        //console.log("========" + response.data.data.name);
        // profileData.value =  response.data.data;
        name.value = response.data.data.name;
        email.value = response.data.data.email;
        phone.value = response.data.data.phone_number;
        telegram.value = response.data.data.telegram;
        whtsapp.value = response.data.data.whtsapp;
        othersway_connect.value = response.data.othersway_connect;
        previewUrl.value = response.data.dataImg;
        doc_file.value = response.data.doc_file;
        with_password.value = response.data.data.with_password;
        r_name.value = response.data.data.real_name;

        created_at.value = response.data.created_at;
        updated_at.value = response.data.updated_at;
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
        title: "Successfully update."
    });
}


// Call the loadeditor function when the component is mounted
onMounted(async () => {
    checkRow();

});

</script>

<style scoped>
input[type=text] {
    border: 2px solid red;
    border-radius: 1px;
    background-color: #c8cac8;
}
</style>