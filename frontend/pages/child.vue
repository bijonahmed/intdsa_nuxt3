<template>
  <div>
    <title>Store</title>
   
    <section class="storeSlider">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="owl-carousel sliderPart">
              <div class="slide_img">
                <a href="#">
                  <img src="/assets/images/slide.png" class="img-fluid" alt="">
                </a>
              </div>
              <div class="slide_img">
                <a href="#">
                  <img src="/assets/images/slide(2).png" class="img-fluid" alt="">
                </a>
              </div>
              <div class="slide_img">
                <a href="#">
                  <img src="/assets/images/slide(3).png" class="img-fluid" alt="">
                </a>
              </div>
              <div class="slide_img">
                <a href="#">
                  <img src="/assets/images/slide(4).png" class="img-fluid" alt="">
                </a>
              </div>
              <div class="slide_img">
                <a href="#">
                  <img src="/assets/images/slide(5).png" class="img-fluid" alt="">
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="store_sec">
      <div class="container">
        <div class="row">
          
          <div class="col-md-12" v-for="(category, index) in categories" :key="'category-' + index">
 
            <div class="row mt-4">
            <div class="col-md-12">
              <div class="d-flex align-items-center justify-content-between">
                <h4 class="fw-bold">{{ category.name }}</h4>
                <!-- <nuxt-link to="/shop">View All <i class="fa-solid fa-arrow-right"></i></nuxt-link> -->
              </div>
            </div>
          </div>
            <div class="store_container">
              
              <div class="stContainer_box" v-for="(subcategory, subIndex) in category.subcategories" :key="'subcategory-' + subIndex">
                <!-- <img src="/assets/images/contnet1.jpg" alt="" class="img-fluid img_banner"> -->
                <img :src="subcategory.bg_images" class="img-fluid img_banner" alt="{{ subcategory.name }}">
                <div class="btn_box">
                  <nuxt-link :to="{ path: '/shop/', query: { category: category.slug, subcategory: subcategory.slug } }"  class="btn vAll">View all </nuxt-link>
                  
                </div>
                <div class="logo_box">
                  <!-- <img src="/assets/images/brand(1).jpg" alt="" class="img-fluid img_logo"> -->
                          <img :src="subcategory.logo" class="img-fluid img_logo" :alt="subcategory.name">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- <center><button type="button" @click="categoryList">test</button></center> -->
    <div class="loading-indicator" v-if="loading" style="text-align: center;">
      <Loader />
    </div>
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
<!-- 
<script setup>
import Navbar from '~~/components/Navbar.vue';

if (process.client) {
$(document).ready(function () {
    $(".sliderPart").owlCarousel({
        items: 5,
        loop: true,
        margin: 5,
        // dots:false,
        nav: false,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true
    });
});
}

</script> -->