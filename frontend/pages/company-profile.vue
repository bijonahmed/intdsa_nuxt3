<template>
    <div>
        <title>Company Profile</title>
        <Navbar />
        <!-- <center><button type="button" @click="categoryList">test</button></center> -->
        <div class="loading-indicator" v-if="loading" style="text-align: center;">
            <Loader />
        </div>
        <div class="store_sec">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 py-5">
                        <h3 class="text-center mb-2">Company profile</h3>
                        <p>
                            DS International Agency recently start work in, and headquartered in Singapore,
                            Drop shipper network In Europe and now globally. Clement Lee and Olive Tai trying to start
                            an
                            online Agency store for Drop Shipper with commercial E-Commerce sites in Singapore include
                            Amazon, Lazada, Qoo10, Carousell, Shopee, E-bay, EZ buy, Zalora, Taobao, TikTok Shop and
                            Zaful. 
                            DS Agency Supports the Drop shippers by offering an online Agency program to create their
                            own
                            business. expanded into Europe with Spain as our first market. </p>

                        <p>DS manages over 100K e-stores in the region, for 30 brand partners, including Nike, MAC ,
                            Zippo
                            ,Beats, Dyson, Poedagar , Lego , Casio and Logitech etc.</p>



                        <p>DS International will try the best</p>
                        <p>E-Commerce Fulfilment and Customer Service in Marketing Interactive’s global ECommerce
                            Sector.</p>

                        <p>DS international Agency platform & tech solutions are ISO/IEC 27001:2024 certified for
                            information security and safety.</p>

                        <p>DS Agency is also the first and currently only enabler championing environmental
                            sustainability.
                            DS Agency is certified carbon neutral (TUV 2023-CNT-P002) and offers eco-friendly packaging
                            and
                            fulfillment options to their brand partners across the region. In 2025, DS Agency will
                            launch
                            Greenify!, a propriety Green Tech Solution, first in SEA, to allow partners and shoppers to
                            carbon neutralize their shopping.</p>

                        <p>DS International Agency commits to maintaining a gender balanced, diverse workforce, everyone
                            can join and start work in DS just need operate store.</p>

                        <p>DS international will establish training class and promote continuous digital commerce
                            learning
                            and up-skilling for DS team members as well as the public.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <Footer />
        <MobileFooter />
    </div>
</template>

<script setup>

const router = useRouter()
import axios from "axios";
import Swal from 'sweetalert2'
const loading = ref(false);
const categories = ref([]);

const categoryList = async () => {
    try {
        loading.value = true; // Set loading to true before making the request
        let response;
        response = await axios.get("/unauthenticate/getCategory");
        console.log("cat array " + response.data);
        categories.value = response.data;

    } catch (error) {
        console.error("Error fetching deposit list:", error);
    } finally {
        loading.value = false; // Set loading to false after the request completes (whether success or failure)
    }
};

onMounted(() => {
    categoryList();

    if (process.client) {
        $(document).ready(function () {
            $(".sliderPart").owlCarousel({
                items: 1,
                loop: true,
                margin: 5,
                nav: false,
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true
            });
        });
    }

});

</script>
