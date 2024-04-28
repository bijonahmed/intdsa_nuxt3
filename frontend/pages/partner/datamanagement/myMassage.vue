<template>
    <title>Messages</title>
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
                                        <li class="breadcrumb-item active" aria-current="page">My Messages</li>
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
                                    <div class="row align-items-center btns_">
                                        <div class="col-xl-8 mb-2">
                                            <form action="">
                                                <div class="d-flex align-items-center">
                                                    <div class="mx-2">
                                                        <p>Month</p>
                                                        <select name="" class="form-control" id="">
                                                            <option value="">All</option>
                                                            <option value="">This Month</option>
                                                            <option value="">Last Month</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <p>Business Type</p>
                                                        <select name="" class="form-control" id="">
                                                            <option value="">Select One </option>
                                                            <option value="">Shop</option>
                                                            <option value="">System</option>
                                                        </select>
                                                    </div>
                                                    <div class="ms-2">
                                                        <p style="opacity: 0;">hidden</p>
                                                        <button type="button" class="btn btn-outline-secondary "
                                                            style="font-size: 10px;"><i
                                                                class="fa-solid me-2 fa-rotate-right"></i>Reset</button>
                                                    </div>
                                                    <div>
                                                        <p style="opacity: 0;">hidden</p>
                                                        <button type="button" class="btn mx-1 btn-primary "
                                                            style="font-size: 10px;"><i
                                                                class="fa-solid fa-magnifying-glass me-2"></i>Search</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!--  table part start here -->
                                    <div class="dtble" style="width: 100%; overflow: auto;">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Month</th>
                                                    <th>Business Type</th>
                                                    <th>Title</th>
                                                    <th>Details</th>
                                                    <th>Status </th>
                                                    <th>Time</th>
                                                    <th>Operation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>202402</td>
                                                    <td>Shop</td>
                                                    <td>Shop</td>
                                                    <td>You have subscribe to renew this service </td>
                                                    <td>Unread</td>
                                                    <td>2024-02-07 12:00:00</td>
                                                    <td class="">
                                                        <div class="btn-group">
                                                            <a class="btn btn-secondary bt_details  w-100 d-flex align-items-center"
                                                                style="font-size: 12px;" @click="d_modal()"><i
                                                                    class="fa-regular fa-eye me-1"
                                                                    style="font-size: 12px;"></i>Details</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>202402</td>
                                                    <td>Shop</td>
                                                    <td>Shop</td>
                                                    <td>You have subscribe to renew this service </td>
                                                    <td>Unread</td>
                                                    <td>2024-02-07 12:00:00</td>
                                                    <td class="">
                                                        <div class="btn-group">
                                                            <a class="btn btn-secondary bt_details  w-100 d-flex align-items-center"
                                                                style="font-size: 12px;" @click="d_modal()"><i
                                                                    class="fa-regular fa-eye me-1"
                                                                    style="font-size: 12px;"></i>Details</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>202402</td>
                                                    <td>Order</td>
                                                    <td>Shop</td>
                                                    <td>You have subscribe to renew this service </td>
                                                    <td>Unread</td>
                                                    <td>2024-02-07 12:00:00</td>
                                                    <td class="">
                                                        <div class="btn-group">
                                                            <a class="btn btn-secondary bt_details  w-100 d-flex align-items-center"
                                                                style="font-size: 12px;" @click="d_modal()"><i
                                                                    class="fa-regular fa-eye me-1"
                                                                    style="font-size: 12px;"></i>Details</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>202402</td>
                                                    <td>Order</td>
                                                    <td>Shop</td>
                                                    <td>You have subscribe to renew this service </td>
                                                    <td>Unread</td>
                                                    <td>2024-02-07 12:00:00</td>
                                                    <td class="">
                                                        <div class="btn-group">
                                                            <a class="btn btn-secondary bt_details  w-100 d-flex align-items-center"
                                                                style="font-size: 12px;" @click="d_modal()"><i
                                                                    class="fa-regular fa-eye me-1"
                                                                    style="font-size: 12px;"></i>Details</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--  table part end here  -->
                                    <div class="pagination_ justify-content-md-between justify-content-center">
                                        <div class="btn-group align-items-center d-md-block d-none">
                                            <p>Showing 1 to 10 of 30 (5 Pages)</p>

                                        </div>
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination d-flex">
                                                <li class="page-item">
                                                    <a class="page-link" href="#" aria-label="Previous">
                                                        <span aria-hidden="true">&laquo;</span>
                                                    </a>
                                                </li>
                                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                <li class="page-item">
                                                    <a class="page-link" href="#" aria-label="Next">
                                                        <span aria-hidden="true">&raquo;</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                <!-- content part end here  -->
                            </div>
                        </div>
                    </div>
                </section>
                <!-- content section end here  -->
            </div>
        </div>
        <PartnerFooterLayout />
        <!-- modal  -->
        <div class="message_details modal_">
            <div class="mdal_content">
                <div class="m_head">
                    <!-- <h6>Deposite Modal</h6> -->
                    <div class="w-50"></div>
                    <button class="bt_close" @click="cancelationModalclose()">
                        <i class="fa-solid fa-x"></i>
                    </button>
                </div>
                <div class="_body">
                    <div class="form_group">
                        <div class="data_">
                            <h6>Month:</h6>
                            <p>202602</p>
                        </div>
                        <div class="data_">
                            <h6>Business type:</h6>
                            <p>Order</p>
                        </div>
                        <div class="data_">
                            <h6>Title:</h6>
                            <p>Order</p>
                        </div>
                        <div class="data_">
                            <h6>Details:</h6>
                            <p>You have subscribe to renew this service</p>
                        </div>
                        <div class="data_">
                            <h6>State:</h6>
                            <p>read</p>
                        </div>
                        <div class="data_">
                            <h6>Time:</h6>
                            <p>2024-02-07 12:00:00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <MobileFooter />
    </div>
</template>

<script setup>
definePageMeta({
    middleware: 'is-logged-out',
})
const d_modal = () => {
    $(".message_details").fadeIn();
};
const cancelationModalclose = () => {
    $(".message_details").fadeOut();
};
</script>
