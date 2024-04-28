<template>
  <title>Shop</title>
  <div>
    <Navbar />

    <section class="main_section py-3">
      <div class="container">
        <!-- product section start here  -->
        <div class="row">
          <div class="col-md-12">

            <center>
              <div class="loading-indicator" v-if="loading" style="text-align: center;">
                <Loader />
              </div>
            </center>
            <h5>Filter By Shop</h5>
            <div class="filterButtons">
              <button class="filterBtn active" v-for="(category, index) in allCategory" :key="index"
                @click="showSubcategories(category)">{{ category.name }}</button>
            </div>
            <h5>Filter By Brands</h5>
            <!-- <div class="filterButtons sub_cat"> -->
            <div class="filterButtons sub_cat">
              <button class="filterBtn" v-for="(item, index) in subCategory" :key="index" @click="filterByBrand(item)">
                <img :src="item.thumnail" class="img-fluid" alt="">
              </button>
              <!-- <img src="/assets/images/brand(1).jpg" class="img-fluid" alt="">   -->

              <!-- [{{ item.id }}]{{ item.name }} -->
            </div>
            <div class="pro_container">
              <div v-for="(pro, index) in brands" :key="index" class="pro_item">
                <LazyNuxtLink :to="{ path: '/shop-details/', query: { details: pro.slug } }">
                  <img :src="pro.thumnail" class="img-fluid" loading="lazy" alt="">
                  <h1>{{ pro.name }}</h1>
                  <p>${{ pro.selling_price }} <del>${{ pro.buying_price }}</del></p>
                  <!-- <span>Sales Volume: {{ pro.selling_price }}+</span> -->
                </LazyNuxtLink>
                <LazyNuxtLink :to="{ path: '/shop-details/', query: { details: pro.slug } }" class="view_btn">View
                </LazyNuxtLink>
              </div>


            </div>
          </div>
        </div>
        <!-- product section end here  -->
      </div>
    </section>
    <Footer />
    <MobileFooter />
  </div>
</template>



<script setup>
import axios from "axios";
const brands = ref([]);
const allCategory = ref([]);
const subCategory = ref([]);
const storeShop = ref('');
const mianCategoryId = ref('');
const loading = ref(false);

let queryParams = {};
if (process.client) {
  queryParams = new URLSearchParams(window.location.search);
}

const defaultshowingBrandData = async () => {
  let mainCategoryId = queryParams.get('category');
  let subcategoryId = queryParams.get('subcategory');

  
  console.log("main categoyrID: " + mainCategoryId);
  console.log("subcategoryId: " + subcategoryId);
  mianCategoryId.value = mainCategoryId;
  try {
    loading.value = true; // Set loading to true before making the request
    // return false; 
    let response = await axios.get("/unauthenticate/productWiseBrand", {
      params: {
        mainCategoryId: mainCategoryId,
        subcategoryId: subcategoryId
      }
    });
    brands.value = response.data.result;
    subCategory.value = response.data.subCategory;
  } catch (error) {
    console.error("Error fetching brands:", error);
  } finally {
    loading.value = false; // Set loading to false after the request completes (whether success or failure)
  }

}
//const queryParams = new URLSearchParams(window.location.search);
const showSubcategories = async (category) => {
  try {
    loading.value = true; // Set loading to true before making the request
    //console.log("category: " + category.slug);
    let categoryid = category.id;
    storeShop.value = categoryid;
    mianCategoryId.value = categoryid;
    let response = await axios.get("/unauthenticate/productWiseSubcategory", {
      params: {
        categoryid: categoryid,
      }
    });
    // Assuming brands is a reactive object
    subCategory.value = response.data;

  } catch (error) {
    console.error("Error fetching brands:", error);
  } finally {
    loading.value = false; // Set loading to false after the request completes (whether success or failure)
  }
}


const allCategorys = async (category) => {

  try {
    loading.value = true; // Set loading to true before making the request
    let response = await axios.get("/unauthenticate/getCategoryList");
    console.log("response" + response.data);
    //return false; 
    allCategory.value = response.data;
  } catch (error) {
    console.error("Error fetching brands:", error);
  } finally {
    loading.value = false; // Set loading to false after the request completes (whether success or failure)
  }

}

const filterByBrand = async (category) => {

  try {
    loading.value = true; // Set loading to true before making the request
    console.log("main category: " + mianCategoryId.value);
    console.log("sub category: " + category.id);
    // return false; 
    let response = await axios.get("/unauthenticate/productWiseBrand", {
      params: {
        mainCategoryId: mianCategoryId.value,
        subcategoryId: category.id
      }
    });
    brands.value = response.data.result;
  } catch (error) {
    console.error("Error fetching brands:", error);
  } finally {
    loading.value = false; // Set loading to false after the request completes (whether success or failure)
  }

}



onMounted(() => {
  // Check if code is running in a browser environment
  if (typeof window !== 'undefined') {
    allCategorys();
    defaultshowingBrandData();
  }
});
</script>
<style>
.pro_item a h1 {
  margin: 0;
  color: #000;
  font-size: 16px;
  font-weight: 700;
  color: var(--primaryColor);
  overflow: hidden;
  display: -webkit-box;
  -webkit-line-clamp: 1;
  line-clamp: 1;
  -webkit-box-orient: vertical;
}
</style>