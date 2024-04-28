<template>
    <title>Manual Adjustment</title>
    <div>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <p>Manual Adjustment</p>
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
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            <form action="">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-2">
                                            <label for="">User  </label>
                                            <input type="text" required v-model="user_id" placeholder="user" class="form-control">
                                        </div>                     
                                        <div class="form-group mb-2">
                                            <label for="status">Adjustment type <span class="text-danger" style="font-size: 12px;">(Required)</span></label>
                                            <select name="" v-model="type" id="" class="form-control">
                                                <option value="1">The effective amount is manually increased</option>
                                                <option value="2">The effective amount is manually reduced</option>
                                                <!-- <option value="3">The frozen amount is manually increased</option>
                                                <option value="4">The frozen amount is manually reduced</option> -->
                                            </select>
                                        </div>  
                                        <div class="form-group mb-2">
                                            <label for="">Adjustment amount<span class="text-danger" style="font-size: 12px;">(Required)</span> </label>
                                            <input type="text" v-model="amount" required placeholder="Please enter the adjustment amount" class="form-control">
                                        </div>                     
                                        <div class="form-group mb-2">
                                            <label for="status">Detailed remarks <span class="text-danger" style="font-size: 12px;">(Required)</span></label>
                                            <select name="" v-model="remark" id="" class="form-control">
                                                <option value="">Please select the note type</option>
                                                <option value="">Store opening subsidy</option>
                                                <option value="">Agency monthly salary</option>
                                                <option value="">Promotional package discount</option>
                                                <option value="">financial distribution</option>
                                                <option value="">System adjustment</option>
                                                <option value="">Agency weekly salary</option>
                                            </select>
                                        </div>                  
                                        <button type="submit" class="btn-primary w-100">Save</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    </div>
</template>
<script setup>
import { ref, watch, onMounted } from "vue";
import axios from "axios";

definePageMeta({
    middleware: 'is-logged-out',
})

const router = useRouter();
const loading = ref(false);
const currentPage = ref(1);
const pageSize = 10;
const totalRecords = ref(0);
const totalPages = ref(0);
const productdata = ref([]);
const searchQuery = ref(""); // Add a ref for the search query
const selectedFilter = ref(1); // Add a ref for the search query

const adjustmentData = ref([
    'user_id',
    'type',
    'amount',
    'remark'
]);

const fetchData = async (page) => {
    try {
        loading.value = true;
        const response = await axios.get(`/product/getProductList`, {
            params: {
                page: page,
                pageSize: pageSize,
                searchQuery: searchQuery.value, // Pass the search query parameter
                selectedFilter: selectedFilter.value, // Pass the search query parameter
            },
        });
        productdata.value = response.data.data;
        totalRecords.value = response.data.total_records;
        totalPages.value = response.data.total_pages;
        currentPage.value = response.data.current_page;
    } catch (error) {
        // Handle error
    } finally {
        loading.value = false;
    }
};

onMounted(() => {
    fetchData(currentPage.value);
});

// Watch for changes in current page and fetch data accordingly
watch(currentPage, (newPage) => {
    fetchData(newPage);
});

// Define a method to handle editing
const edit = (id) => {

    router.push({
        path: '/products/edit',
        query: {
            parameter: id
        }
    });

    // Your logic for editing goes here
    console.log('Editing item with id:', id);
};

// Define a method to handle deleting
const deleteProduct = (id) => {
    // Your logic for deleting goes here
    console.log('Deleting item with id:', id);
};

// Define a method to handle previewing
const preview = (id) => {
    router.push({
        path: '/products/preview',
        query: {
            parameter: id
        }
    });
    console.log('Previewing item with id:', id);
};

// Compute the range of displayed pages
const displayedPages = computed(() => {
    const maxDisplayedPages = 10; // Maximum number of displayed pages
    const startPage = Math.max(
        1,
        currentPage.value - Math.floor(maxDisplayedPages / 2)
    );
    const endPage = Math.min(
        totalPages.value,
        startPage + maxDisplayedPages - 1
    );
    return Array.from(
        { length: endPage - startPage + 1 },
        (_, i) => startPage + i
    );
});


const filterData = () => {
    fetchData(1); // Reset to first page when search query changes
};
</script>


<style>
.pagination {
    display: inline-block;
    text-align: center;
}

.pagination button {
    margin: 0 5px;
    padding: 5px 10px;
    background-color: #2f2f2f;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.pagination button:hover {
    background-color: #0056b3;
}

.pagination button[disabled] {
    background-color: #6c757d;
    cursor: not-allowed;
}

.card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    min-height: 1px;
    padding: 0.5rem;
}

.btnSize {
    font-size: 12px;
    padding: 3px;
}

/* Table */
.table-wrapper {
    width: 100%;
    /* max-width: 500px; */
    overflow-x: auto;
}

.table td,
.table th {
    padding: .2rem;
    vertical-align: top;
    border-top: 1px solid #dae2ea;
}

table {
    border-collapse: collapse;
    width: 100%;
}

th,
td {
    padding: 1px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

tr:hover {
    background-color: rgb(221, 221, 221);
}
</style>
