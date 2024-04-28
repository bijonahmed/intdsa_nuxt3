<template>
    <title>Order Management List</title>
    <div>
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Incentive activities</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Incentive activities</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="page_top  my-2">
                        <div class="row justify-content-between align-items-center my-2">
                            <div class="col-md-6">
                                <form action="">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th class="border-0  p-0 " style="padding-right: 5px !important;">
                                                    <input type="text" class="form-control" placeholder="search ">
                                                </th>
                                                <th class="border-0 p-0 me-1" style="padding-right: 5px !important;">
                                                    <select name="" id="" class="form-control">
                                                        <option value="" selected disabled>Select status</option>
                                                        <option value="">Active</option>
                                                        <option value="">Inactive</option>
                                                        <option value="">Draft</option>
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
                            <div class="col-md-6 ">
                                <div class="buttonList">
                                    <div class="btn-group">
                                        <a href="add_incentive.html" type="button" class="btn btn-primary btn-flat ">
                                            <i class="fas fa-plus"></i>Add
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Separated link</a>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-danger btn-flat btn-sm"><i
                                            class="fas fa-trash-alt"></i>Delete</button>
                                    <button type="button" class="btn btn-warning btn-flat btn-sm"><i
                                            class="fas fa-trash-alt"></i>Reset</button>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- table section start here  -->
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <div class="filter_options">

                            </div>
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="checkAll"></th>
                                        <th>type of activity</th>
                                        <th>activity level</th>
                                        <th>Statistics Time </th>
                                        <th>statistical period </th>
                                        <th>Statistical level </th>
                                        <th>First level number of people </th>
                                        <th> Minimum total number of people</th>
                                        <th> Maximum total number of people</th>
                                        <th> Minimum recharge amount</th>
                                        <th> Maximum recharge amount</th>
                                        <th>Account Balance</th>
                                        <th>award</th>
                                        <th>Generation date</th>
                                        <th>Operator</th>
                                        <th>creation time</th>
                                        <th>Update time</th>
                                        <th>Action</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="checkBox">
                                        </td>
                                        <td>Team rewards</td>
                                        <td>Invite 30 new members to open a store and get 100</td>
                                        <td>per month</td>
                                        <td> full time</td>
                                        <td>1,2,3</td>
                                        <td>30</td>
                                        <td>30</td>
                                        <td> 99999</td>
                                        <td>100.00</td>
                                        <td>50000.00</td>
                                        <td>0.00</td>
                                        <td>100.00</td>
                                        <td></td>
                                        <td>admin</td>
                                        <td>2024-04-11 04:37:58</td>
                                        <td>2024-04-11 04:37:58</td>
                                        <td>
                                            <div class="">
                                                <div class="d-flex">
                                                    <button class="btn w-100 btn-default btn-sm btn-flat"
                                                        data-toggle="modal" data-target="#details"><i
                                                            class="far fa-eye"></i>details</button>

                                                </div>
                                                <div class="d-flex"><button
                                                        class="btn w-50 btn-warning btn-sm btn-flat"><i
                                                            class="fas fa-pen"></i>Edit</button>
                                                    <button class="btn  w-50  btn-danger btn-sm btn-flat"
                                                        data-toggle="modal" data-target="#delete"><i
                                                            class="fas fa-trash-alt"></i>Delete</button>
                                                </div>
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

        </div>

        <!-- Start  Modal  -->
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
                        <table class="table">
                            <tr>
                                <td class="text-left">type of activity</td>
                                <td class="text-left">Team rewards</td>
                            </tr>
                            <tr>
                                <td class="text-left">activity level</td>
                                <td class="text-left">Invite 30 new members to open a store and get 100</td>
                            </tr>
                            <tr>
                                <td class="text-left">Statistics Time </td>
                                <td class="text-left">per month</td>
                            </tr>
                            <tr>
                                <td class="text-left">statistical period </td>
                                <td class="text-left">full time</td>
                            </tr>
                            <tr>
                                <td class="text-left">Statistical level </td>
                                <td class="text-left">1,2,3</td>
                            </tr>
                            <tr>
                                <td class="text-left">First level number of people </td>
                                <td class="text-left">30</td>
                            </tr>
                            <tr>
                                <td class="text-left">Minimum total number of people</td>
                                <td class="text-left">30</td>
                            </tr>
                            <tr>
                                <td class="text-left">Maximum total number of people</td>
                                <td class="text-left">99999 </td>
                            </tr>
                            <tr>
                                <td class="text-left">Minimum recharge amount</td>
                                <td class="text-left">100.00 </td>
                            </tr>
                            <tr>
                                <td class="text-left">Maximum recharge amount </td>
                                <td class="text-left">50000.00 </td>
                            </tr>
                            <tr>
                                <td class="text-left">Account Balance</td>
                                <td class="text-left">0.00 </td>
                            </tr>
                            <tr>
                                <td class="text-left">award</td>
                                <td class="text-left">100.00 </td>
                            </tr>
                            <tr>
                                <td class="text-left">Generation date</td>
                                <td class="text-left"> </td>
                            </tr>
                            <tr>
                                <td class="text-left">Operator</td>
                                <td class="text-left">Admin </td>
                            </tr>
                            <tr>
                                <td class="text-left">creation time </td>
                                <td class="text-left">2024-04-11 04:37:58</td>
                            </tr>
                            <tr>
                                <td class="text-left">Update time </td>
                                <td class="text-left">2024-04-11 04:37:58</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- team show modal  -->
        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header justify-content-center py-1">
                        <h5 class="modal-title text-danger text-center" id="exampleModalCenterTitle">Confirmation</h5>
                    </div>
                    <div class="modal-body text-center">
                        Are you sure want to delete?
                    </div>
                    <div class="d-flex align-items-center p-1">
                        <button type="button" class="btn btn-default btn-flat w-50" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger btn-flat w-50">Confirm</button>
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
