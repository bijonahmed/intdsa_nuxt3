<template>
    <title>Order Management List</title>
    <div>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <p>Order Management</p>
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
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="page_top  my-2">
                        <div class="row justify-content-between align-items-center my-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="basic_data_container">
                                        <div class="data_box">
                                            <h6>User(active store): 11011</h6>
                                            <h6 class="text-danger">Non active: 500</h6>
                                        </div>
                                        <div class="data_box">
                                            <h6>Total balance: 987234239847897</h6>
                                        </div>
                                        <div class="data_box">
                                            <h6>To be paid order qty: 435345</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <form action="">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th class="border-0  p-0 " style="padding-right: 5px !important;">
                                                    <input type="text" class="form-control"
                                                        placeholder="Search by user ">
                                                </th>
                                                <th class="border-0  p-0 " style="padding-right: 5px !important;">
                                                    <input type="text" class="form-control"
                                                        placeholder="Search by order id">
                                                </th>
                                                <th class="border-0 p-0 mr-1" style="padding-right: 5px !important;">
                                                    <input type="text" placeholder="Start date" name=""
                                                        onfocus="(this.type='date')" id="" class="form-control">
                                                </th>
                                                <th class="border-0 p-0 mr-1" style="padding-right: 5px !important;">
                                                    <input type="text" placeholder="End date" name=""
                                                        onfocus="(this.type='date')" id="" class="form-control">
                                                </th>
                                                <th class="border-0 p-0 mr-1" style="padding-right: 5px !important;">
                                                    <select name="" id="" class="form-control">
                                                        <option value="">To be paid</option>
                                                        <option value="">To be confiremed</option>
                                                        <option value="">Goods To be receive</option>
                                                        <option value="">Platform procced</option>
                                                        <option value="">To be shipped</option>
                                                        <option value="">Complete</option>
                                                        <option value="">Canceled</option>
                                                        <option value="">Returning</option>
                                                        <option value="">Return complete</option>
                                                        <option value="">Abnormal order</option>
                                                    </select>
                                                </th>
                                                <th class="border-0 p-0 mr-1" style="padding-right: 5px !important;">
                                                    <select name="" id="" class="form-control">
                                                        <option value="" selected disabled>Status
                                                        </option>
                                                        <option value="">Active</option>
                                                        <option value="">Inactive</option>
                                                    </select>
                                                </th>
                                                <th class="border-0  p-0 h-100">
                                                    <button type="button" style="min-width: 90px;"
                                                        class="btn btn-primary btn-fla"><i
                                                            class="fas fa-search"></i>Search</button>
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </form>
                            </div>
                            <div class="col-md-3 ">
                                <div class="buttonList">
                                    <a href="#" type="button" class="btn btn-primary btn-flat ">
                                        <i class="fas fa-plus"></i>Create Auto order for all users
                                    </a>
                                    <a data-toggle="modal" data-target="#addorder" type="button mx-2"
                                        class="btn btn-warning btn-flat ">
                                        <i class="fas fa-plus"></i>Create individual order
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- table section start here  -->
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <div class="filter_options">

                            </div>
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="checkAll"></th>
                                        <th>Basic information</th>
                                        <th class="text-left">User Info</th>
                                        <th>Order Status</th>
                                        <th>Costing price($)</th>
                                        <th>Profit($)</th>

                                        <th>creation time</th>
                                        <th>Update time </th>
                                        <td>Action </td>
                                    </tr>

                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="checkBox">
                                        </td>
                                        <td>
                                            <h3>Order id: 98769234792342</h3>
                                            <div class="d-flex">
                                                <img src="/images/product(1).jpg" class="img-fluid" alt="">
                                                <div>
                                                    <h3>iPhone 15 pro </h3>
                                                    <p>price: $120</p>

                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-left">
                                            <p>Name: test305</p>
                                            <p>Cell phone: None</p>
                                            <p>Email: None</p>
                                            <p class="text-danger">Type: Vertual user</p>
                                        </td>
                                        <td>To be paid</td>
                                        <td> 0.00</td>
                                        <td> 2.06</td>

                                        <td>2024-04-14 01:21:38</td>
                                        <td>2024-04-14 01:21:38</td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-default btn-sm btn-flat" data-toggle="modal"
                                                    data-target="#details"> Details</button>

                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- table section end here  -->
                </div>
            </section>
            <!-- /.content -->
            <!-- /.content -->
        </div>

        <!-- Start  Modal  -->
        <!-- add manual order modal  -->
        <div class="modal fade" id="addorder" tabindex="-1" role="dialog" aria-labelledby="detailsTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header py-1">
                        <h5 class="modal-title" id="detailsTitle">Create individual User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 m-auto">
                            <form action="">
                                <div class="form-group">
                                    <label for="">Users</label>
                                    <select class="selectpicker form-control" aria-label="Default select example"
                                        data-live-search="true">
                                        <option value="1">User 1</option>
                                        <option value="2">User 2</option>
                                        <option value="3">User 3</option>
                                        <option value="4">User 4</option>
                                    </select>

                                </div>
                                <div class="d-flex justify-content-between align-items-start">
                                    <h6>Balance: $23423.00</h6>
                                    <ul style="list-style:  none; "
                                        class="d-flex justify-content-between align-items-center">
                                        <h6>Active: New agency store, Basic agency store, Mega agency store </h6>
                                    </ul>
                                </div>
                                <div class="form-group mb-2">
                                    <select name="" id="" class="form-control">
                                        <option value="">New agency store</option>
                                        <option value="">General Agency Store</option>
                                        <option value="">Basic agency store</option>
                                        <option value="">Super Agency Store</option>
                                        <option value="">Mega agency store</option>
                                    </select>
                                </div>
                                <h6>Sum of select product: <strong>$258.00</strong></h6>
                                <div class="proListh">
                                    <table class="table">
                                        <tr>
                                            <td><input checked type="checkbox"></td>
                                            <td>Product name ...</td>
                                            <td><strong>$129.00</strong></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td>Product name ...</td>
                                            <td><strong>$129.00</strong></td>
                                        </tr>
                                        <tr>
                                            <td><input checked type="checkbox"></td>
                                            <td>Product name ...</td>
                                            <td><strong>$129.00</strong></td>
                                        </tr>
                                    </table>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- details modal  -->
        <div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="detailsTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header py-1">
                        <h5 class="modal-title" id="detailsTitle">Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 m-auto">
                            <table class="table">
                                <tr>
                                    <td class="text-left">Basic information</td>
                                    <td>
                                        <h3>Order id: 98769234792342</h3>
                                        <div class="d-flex">
                                            <img src="/images/product(1).jpg" class="img-fluid" alt="">
                                            <div>
                                                <h3>iPhone 15 pro </h3>
                                                <p>price: $120</p>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">User info </td>

                                    <td class="text-left">
                                        <p>Name: test305</p>
                                        <p>Cell phone: None</p>
                                        <p>Email: None</p>
                                        <p class="text-danger">Type: Vertual user</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Order Status</td>
                                    <td class="text-left"><span class="text-danger">To be Paid </span></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Costing price($)</td>
                                    <td class="text-left"><span class="text-success">$00.00</span></td>
                                </tr>
                                <tr>
                                    <td class="text-left">Profit($)</td>
                                    <td class="text-left">$00.00</td>
                                </tr>
                                <tr>
                                    <td class="text-left">creation time</td>
                                    <td class="text-left">2024-04-19 09:00:04</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Update time</td>
                                    <td class="text-left">2024-04-19 09:00:04</td>
                                </tr>
                            </table>
                            <form action="" class="form-group">
                                <div class="form-group">
                                    <label for="">Order Status</label>
                                    <select name="" id="" class="form-control">
                                        <option value="">To be paid</option>
                                        <option value="">To be confiremed</option>
                                        <option value="">Goods To be receive</option>
                                        <option value="">Platform procced</option>
                                        <option value="">To be shipped</option>
                                        <option value="">Complete</option>
                                        <option value="">Canceled</option>
                                        <option value="">Returning</option>
                                        <option value="">Return complete</option>
                                        <option value="">Abnormal order</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="" id="" class="form-control">
                                        <option value="">Active</option>
                                        <option value="">Inactive</option>
                                    </select>
                                </div>
                                <button class="btn btn-primary w-100" type="submit">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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


const getDtails = () => {
    $('#details').modal('show');
}
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

.proListh {
    height: 180px;
    overflow: auto;
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
