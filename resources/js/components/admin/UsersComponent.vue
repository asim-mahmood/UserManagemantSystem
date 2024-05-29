<template>
    <div>
        <section class="content user-table-data">
            <div class="container-fluid p-2">
                <div class="border-0 rounded p-2 bg-white shadow-sm">
                    <div class="row no-gutters">
                        <div class="col-2 col-md-2 d-flex align-items-center user-table-data ">
                            <div class="pr-2">
                                <button type="button" class="btn bg-info shadow-sm btn-flat" data-toggle="modal"
                                    href="#addUserModal" @click="openFormModal">
                                    <i class="fa-solid fa-user-plus pr-2"></i>Add User
                                </button>
                            </div>
                        </div>
                        <div class="col-7 col-md-5 d-flex align-items-center justify-content-center">
                            <div class="border rounded-pill py-2 px-4 mr-2 border-primary">
                                <label class="mb-0">Search</label>
                            </div>
                            <div class="input-group">
                                <input type="search" class="form-control rounded-pill">
                                <div class="input-group-append">
                                </div>
                            </div>
                        </div>
                        <div class="col-3 col-md-5">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="dropdown pr-2 ">
                                    <button class="btn bg-info dropdown-toggle shadow-sm btn-flat" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fa-solid fa-download pr-2"></i>Download
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item border-bottom" href="#"><i
                                                class="fa-solid fa-file-csv text-warning pr-2"></i> CSV</a>
                                        <a class="dropdown-item border-bottom" href="#"><i
                                                class="fa-solid fa-file-pdf text-danger pr-2"></i> PDF</a>
                                        <a class="dropdown-item" href="#"><i
                                                class="fa-solid fa-file-excel text-success pr-2"></i> Excel</a>
                                    </div>
                                </div>
                                <div>
                                    <button type="button" class="btn bg-info shadow-sm btn-block btn-flat">
                                        <i class="fa-solid fa-print pr-1"></i>Print
                                    </button>
                                </div>
                                <div class="pl-2">
                                    <button type="button" class="btn bg-info shadow-sm btn-flat px-4"
                                        @click="filter_state = !filter_state">
                                        <i class="fa-solid fa-sliders"></i>
                                    </button>
                                    <!-- <a href="#" class="">
                                        <i class="material-symbols-outlined primary-color">tune</i>
                                    </a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <transition name="fade" mode="out-in" @before-enter="beforeEnter" @enter="enter" @leave="leave">
                    <div class="border-0 rounded p-2 bg-white shadow-sm mt-2" v-if="filter_state">
                        <div class="row no-gutters">
                            <div class="col-2 px-2">
                                <div class="form-group">
                                    <label class="mb-0">User Name</label>
                                    <input type="text" class="form-control" placeholder="D-12-85845">
                                </div>
                            </div>
                            <div class="col-2 px-2">
                                <div class="form-group">
                                    <label class="mb-0">CNIC</label>
                                    <input type="text" class="form-control" placeholder="12345-1234567-0">
                                </div>
                            </div>
                            <div class="col-2 px-2">
                                <div class="form-group">
                                    <label class="mb-0">Mobile</label>
                                    <input type="text" class="form-control" placeholder="0321-1234567">
                                </div>
                            </div>
                            <div class="col-2 px-2">
                                <div class="form-group">
                                    <label class="mb-0">Package</label>
                                    <select class="form-control">
                                        <option>2 Mbps</option>
                                        <option>3 Mbps</option>
                                        <option>6 Mbps</option>
                                        <option>10 Mbps</option>
                                        <option>12 Mbps</option>
                                        <option>16 Mbps</option>
                                        <option>20 Mbps</option>
                                        <option>30 Mbps</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2 px-2">
                                <div class="form-group">
                                    <label class="mb-0">Bill</label>
                                    <select class="form-control">
                                        <option>Pending</option>
                                        <option>Paid</option>
                                        <option>Expired</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2 px-2">
                                <div class="form-group">
                                    <label class="mb-0">Company</label>
                                    <select class="form-control">
                                        <option>StromFiber</option>
                                        <option>Connect</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </transition>
                <div class="shadow-sm">
                    <div class="d-flex justify-content-end align-items-center p-2 bg-gradient-white mt-4 rounded-top">
                        <div class="">
                            <p class=" mb-0 pr-2">Showing 1-100 of 500 Customers</p>
                        </div>
                        <div class="">
                            <div class="form-group mb-0">
                                <select class="form-control">
                                    <option>Page 1</option>
                                    <option>Page 2</option>
                                    <option>Page 3</option>
                                    <option>Page 4</option>
                                    <option>Page 5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gradient-white table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr class="py-2">
                                    <th scope="col" class="py-2">
                                        <input type="checkbox" class="" id="exampleCheck1">
                                    </th>
                                    <th scope="col" class="py-2">Sr #</th>
                                    <th scope="col" class="py-2">User Name</th>
                                    <th scope="col" class="py-2">Name</th>
                                    <th scope="col" class="py-2">Father Name</th>
                                    <th scope="col" class="py-2">Contact</th>
                                    <th scope="col" class="py-2">Company</th>
                                    <th scope="col" class="py-2">Package</th>
                                    <th scope="col" class="py-2">Device Details</th>
                                    <th scope="col" class="py-2">Billing</th>
                                    <th scope="col" class="py-2">Status</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                <tr class="py-2">
                                    <td scope="col" class="py-2 align-middle">
                                        <input type="checkbox" class="" id="exampleCheck1">
                                    </td>
                                    <td class="py-2 text-nowrap align-middle">01</td>
                                    <td class="py-2 text-nowrap align-middle ">
                                        <a href="#" class="edit-button">40NB-457</a>
                                    </td>
                                    <td class="py-2 text-nowrap align-middle">
                                        <div>
                                            <p class="mb-0">M Bashir</p>
                                            <p class="mb-0 text-muted">4px8401-0123465-1</p>
                                        </div>
                                    </td>
                                    <td class="py-2 text-nowrap align-middle">Allah Dita</td>
                                    <td class="py-2 text-nowrap align-middle">
                                        <div>
                                            <p class="mb-0">0300-1234567</p>
                                            <p class="mb-0 text-muted">text2@gmail.com</p>
                                        </div>
                                    </td>
                                    <td class="py-2 text-nowrap align-middle">Connect</td>
                                    <td class="py-2 text-nowrap align-middle">
                                        <div>
                                            <p class="mb-0">
                                                15 Mbps
                                                <span class="badge badge-info badge-pill">Rs 2500</span>
                                                <span class="badge badge-success badge-pill">Shared</span>
                                            </p>
                                            <p class="mb-0">
                                                <strong>Activation:</strong>
                                                <span class="text-muted"> 014-Dec-2023</span>
                                            </p>
                                        </div>
                                    </td>
                                    <td class="py-2 text-nowrap align-middle">
                                        <div>
                                            <p class="mb-0">
                                                <strong>Device:</strong> <span class="text-Danger">UnPaid</span>
                                                <span class="badge badge-primary badge-pill">Huawei 8154C</span>
                                            </p>
                                            <p class="mb-0">
                                                <strong>Security:</strong> <span
                                                    class="badge badge-secondary badge-pill">Nill</span>
                                                <strong>Owner:</strong><span class="text-warning"> Company</span>
                                            </p>
                                        </div>
                                    </td>
                                    <td class="py-2 text-nowrap align-middle">
                                        <div>
                                            <p class="mb-0">05-Nov <span
                                                    class="badge badge-success badge-pill">Paid</span></p>
                                            <a href="#" class="text-info"><i class="fa-solid fa-share fa-xs"></i>
                                                Previous Bill</a>

                                        </div>
                                    </td>
                                    <td class="py-2 text-nowrap align-middle text-success text-center"><i
                                            class="fa-solid fa-user-check fa-lg"></i></td>
                                </tr>
                                <tr class="py-2">
                                    <td scope="col" class="py-2 align-middle">
                                        <input type="checkbox" class="" id="exampleCheck1">
                                    </td>
                                    <td class="py-2 text-nowrap align-middle">02</td>
                                    <td class="py-2 text-nowrap align-middle ">
                                        <a href="#" class="edit-button">40NB-456</a>
                                    </td>
                                    <td class="py-2 text-nowrap align-middle">
                                        <div>
                                            <p class="mb-0">M Azhar</p>
                                            <p class="mb-0 text-muted">38401-0123465-7</p>
                                        </div>
                                    </td>
                                    <td class="py-2 text-nowrap align-middle">Asghar Ali</td>
                                    <td class="py-2 text-nowrap align-middle">
                                        <div>
                                            <p class="mb-0">0322-1234567</p>
                                            <p class="mb-0 text-muted">text@gmail.com</p>
                                        </div>
                                    </td>
                                    <td class="py-2 text-nowrap align-middle ">StormFiber</td>
                                    <td class="py-2 text-nowrap align-middle">
                                        <div>
                                            <p class="mb-0">
                                                15 Mbps
                                                <span class="badge badge-info badge-pill">Rs 2000</span>
                                                <span class="badge badge-success badge-pill">Shared</span>
                                            </p>
                                            <p class="mb-0">
                                                <strong>Activation:</strong>
                                                <span class="text-muted"> 04-Dec-2020</span>
                                            </p>
                                        </div>
                                    </td>
                                    <td class="py-2 text-nowrap align-middle">
                                        <div>
                                            <p class="mb-0">
                                                <strong>Device:</strong> <span class="text-success">Paid</span>
                                                <span class="badge badge-primary badge-pill">Huawei 8154C</span>
                                            </p>
                                            <p class="mb-0">
                                                <strong>Security:</strong> <span
                                                    class="badge badge-secondary badge-pill">Nill</span>
                                                <strong>Owner:</strong><span class="text-muted"> Customer</span>
                                            </p>
                                        </div>
                                    </td>
                                    <td class="py-2 text-nowrap align-middle">
                                        <div>
                                            <p class="mb-0">05-Nov <span
                                                    class="badge badge-danger badge-pill">Unpaid</span></p>
                                            <a href="#" class="text-info"><i class="fa-solid fa-share fa-xs"></i>
                                                Previous Bill</a>

                                        </div>
                                    </td>
                                    <td class="py-2 text-nowrap align-middle text-danger text-center">
                                        <i class="fa-solid fa-user-xmark fa-lg"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <add-users-modal v-if="is_form_model" :modal_type="modalType" @close-modal="closeModel">
        </add-users-modal>
    </div>
</template>
<script>
import moment from 'moment';
export default {
    name: "users-component",
    props: ['customerId', 'customerType'],
    data() {
        return {
            crud_loading: false,
            loading: false,
            notes: '',
            date: '',
            is_form_model: false,
            filter_state: false,
        }
    },
    methods: {
        openFormModal(modalType, id) {
            this.modalType = modalType
            this.objId = id
            this.is_form_model = true
        },
        closeModel() {
            this.is_form_model = false;
        },
        beforeEnter(el) {
            el.style.opacity = 0;
        },
        enter(el, done) {
            // This is where you can apply your transition styles
            el.offsetHeight; // Trigger reflow
            el.style.transition = "opacity 0.8s";
            el.style.opacity = 1;
            done();
        },
        leave(el, done) {
            el.style.transition = "opacity 0.8s";
            el.style.opacity = 0;
            done();
        },
    },
    mounted() {
    }
}
</script>
<style scoped>
.user-table-data,
.table thead td {
    padding: 0px;
}

.primary-color {
    color: #007bff;
}

.edit-button {
    color: #007bff;
    /* Default text color */
    text-decoration: none;
    /* Remove underline by default */
    transition: color 0.6s ease-in-out, text-shadow 0.4s ease;
}

.edit-button:hover {
    color: #f08c44;
    /* Change text color on hover */
}

.fade-example-enter-active,
.fade-example-leave-active {
    transition: opacity 0.8s;
}

.fade-example-enter,
.fade-example-leave-to {
    opacity: 0;
}

th {
    white-space: nowrap;
}
</style>
