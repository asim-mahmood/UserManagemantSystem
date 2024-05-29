<template>
    <div>
        <section class="content user-table-data">
            <div class="container-fluid p-2">
                <div class="border-0 rounded p-2 bg-white shadow-sm">
                    <div class="row no-gutters">
                        <div class="col-2 col-md-2 d-flex align-items-center user-table-data">
                            <div class="pr-2">
                                <button type="button" class="btn btn-outline-info border-0 btn-flat" data-toggle="modal"
                                    data-target="#addUserModal" @click="openUserFormModal('Add', null)">
                                    <i class="fa-solid fa-user-plus pr-2"></i>
                                    Add User
                                </button>
                            </div>
                        </div>
                        <div class="col-3 col-md-3">
                            <div class="mr-3">
                                <div class="input-group">
                                    <input v-model="search_database"
                                        class="form-control rounded-pill border-custom-color"
                                        placeholder="Search User Name" @change="getSearchCustomers" />
                                    <div class="input-group-append"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 col-md-3">
                            <div class="mr-3">
                                <div class="input-group">
                                    <input v-model="search" class="form-control rounded-pill border-custom-color"
                                        placeholder="Search" />
                                    <div class="input-group-append"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 col-md-4">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="dropdown pr-2">
                                    <button class="btn bg-info dropdown-toggle shadow-sm btn-flat" type="button"
                                        id="franchiseDropdownButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fa-solid fa-building pr-2"></i>
                                        {{ franchise_name ? franchise_name : 'Franchise' }}
                                    </button>
                                    <div class="dropdown-menu p-2" aria-labelledby="franchiseDropdownButton">
                                        <template v-for="franchise in franchises">
                                            <a class="dropdown-item border-bottom cursor-pointer"
                                                @click="selectFranchise(franchise.id, franchise.name)">
                                                {{ franchise.name }}
                                            </a>
                                        </template>
                                    </div>
                                </div>
                                <div class="dropdown pr-2">
                                    <button class="btn bg-info dropdown-toggle shadow-sm btn-flat" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fa-solid fa-download pr-2"></i>Download
                                    </button>
                                    <div class="dropdown-menu p-2" aria-labelledby="dropdownMenuButton">
                                        <button type="button" class="btn btn-outline-info border-0 btn-flat"
                                            data-toggle="modal" data-target="#contactFormPrint"
                                            @click="is_user_form_print = true">
                                            <i class="fa-solid fa-user-plus"></i>
                                            Print User Form
                                        </button>
                                        <a class="dropdown-item border-bottom border-top" href="#"><i
                                                class="fa-solid fa-file-csv text-warning pr-2"></i>
                                            CSV</a>
                                        <a class="dropdown-item border-bottom" href="#"><i
                                                class="fa-solid fa-file-pdf text-danger pr-2"></i>
                                            PDF</a>
                                        <a class="dropdown-item" href="#"><i
                                                class="fa-solid fa-file-excel text-success pr-2"></i>
                                            Excel</a>
                                    </div>
                                </div>
                                <div>
                                    <button type="button" class="btn bg-info shadow-sm btn-block btn-flat"
                                        @click="printSelectedBills">
                                        <i class="fa-solid fa-print pr-1"></i>Print
                                    </button>
                                </div>
                                <!-- <div class="pl-2">
                                    <button type="button" class="btn bg-info shadow-sm btn-flat px-4" @click="filter_state =!filter_state">
                                        <i class="fa-solid fa-sliders"></i>
                                    </button>
                                    <a href="#" class="">
                                        <i class="material-symbols-outlined primary-color">tune</i>
                                    </a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="shadow-sm">
                    <div
                        class="d-flex justify-content-between align-items-center p-2 bg-gradient-white mt-4 rounded-top">
                        <div class="">
                            <button class="btn bg-info text-nowrap shadow-sm btn-flat" type="button"
                                @click="generateAllBills()">
                                <span>Generate Bills</span>
                            </button>
                        </div>
                        <div>
                            <pagination-component :page="page" :total_counts="customers_count" :per_page_count="perPage"
                                @get-page-number="getPageNumber" @first_rec="getFirstRecord">
                            </pagination-component>
                        </div>
                    </div>
                    <div class="bg-gradient-white table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr class="py-2">
                                    <th scope="col" class="py-2">
                                        <input type="checkbox" v-model="is_all_select" @change="toggleAllCheckboxes" />
                                    </th>
                                    <th scope="col" class="py-2">Sr #</th>
                                    <th scope="col" class="py-2">User Name</th>
                                    <th scope="col" class="py-2">Name</th>
                                    <th scope="col" class="py-2">Father Name</th>
                                    <th scope="col" class="py-2">Contact</th>
                                    <th scope="col" class="py-2">Company</th>
                                    <th scope="col" class="py-2">Package</th>
                                    <!-- <th scope="col" class="py-2">Device Details</th> -->
                                    <th scope="col" class="py-2">Billing</th>
                                    <th scope="col" class="py-2 cursor-pointer" @click="sortByExpiry">
                                        Expiry
                                    </th>
                                    <th scope="col" class="py-2">Status</th>
                                    <th scope="col" class="py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                <tr v-for="(obj, index) in filteredData" :key="index">
                                    <td scope="col" class="py-2 align-middle">
                                        <input type="checkbox" v-model="obj.isSelected"
                                            @click="handleCheckboxChange(obj)" />
                                    </td>
                                    <td class="py-2 text-nowrap align-middle">
                                        {{ firstRecord + index }}
                                    </td>
                                    <td class="py-2 text-nowrap align-middle d-flex justify-content-between pt-3">
                                        <span class="edit-button cursor-pointer" data-toggle="modal"
                                            data-target="#addUserModal" @click="openUserFormModal('Edit', obj.id)">{{
                                                obj.user_id }}
                                        </span>
                                        <i class="fa fa-print cursor-pointer pt-1 text-info" data-toggle="modal"
                                            data-target="#contactFormPrint" @click="openPrintModal(obj)">
                                        </i>
                                    </td>
                                    <td class="py-2 text-nowrap align-middle">
                                        <div>
                                            <p class="mb-0">
                                                {{ obj.user_name }}
                                            </p>
                                            <p class="mb-0 text-muted">
                                                {{ obj.cnic }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="py-2 text-nowrap align-middle">
                                        {{ obj.father_name }}
                                    </td>
                                    <td class="py-2 text-nowrap align-middle">
                                        <div>
                                            <p class="mb-0">
                                                {{ obj.mobile_number }}
                                            </p>
                                            <p class="mb-0 text-muted">
                                                {{ obj.email }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="py-2 text-nowrap align-middle" :class="{
                                        'text-orange': obj.company_name === 'Connect',
                                        'text-success': obj.company_name === 'StromFiber',
                                    }">
                                        {{ obj.company_name }}
                                    </td>
                                    <td class="py-2 text-nowrap align-middle">
                                        <div>
                                            <p class="mb-0">
                                                {{ obj.package ? obj.package.speed : "" }}
                                                <span class="badge badge-info badge-pill">Rs {{ obj.price }}</span>
                                                <span class="badge badge-secondary badge-pill">{{
                                                    obj.payment_type ?? "NA"
                                                    }}</span>
                                            </p>
                                        </div>
                                    </td>
                                    <td class="py-2 text-nowrap align-middle">
                                        <div class="">
                                            <a data-toggle="modal" type="button" data-target="#billingHistory"
                                                @click="openHistoryFormModal('add', obj)" class="text-info">
                                                <span class="btn btn-outline-danger custom-pill"
                                                    v-if="obj.total_pending && obj.total_pending != 0">Rs {{
                                                        obj.total_pending }}</span>
                                                <span v-else> Billing History</span>
                                            </a>
                                            <span class="btn btn-outline-info custom-pill bg-color"
                                                @click="calculateNextBillingDate(obj.id)">Recharge</span>
                                            <span class="btn btn-outline-warning custom-pill"
                                                @click="payFullBill(obj)">Pay Bill</span>
                                            <span class="btn btn-success custom-pill"
                                                v-if="obj.paid_status === 'Paid'">Paid</span>
                                        </div>
                                    </td>
                                    <td :class="getDateClass(obj.billing_date)">
                                        <p class="mb-0">
                                            {{ obj.billing_date }}
                                        </p>
                                    </td>
                                    <td class="py-2 text-nowrap align-middle text-center cursor-pointer">
                                        <i v-if="obj.paid_status == 'Expired'"
                                            class="fa-solid fa-user-slash fa-lg text-warning"></i>
                                        <i v-else-if="obj.is_active" class="fa-solid fa-user-check fa-lg text-success"
                                            @click="changeStatus(obj.id)"></i>
                                        <i v-else class="fa-solid fa-user-xmark fa-lg text-danger"
                                            @click="changeStatus(obj.id)"></i>
                                    </td>
                                    <td class="text-center text-nowrap align-middle">
                                        <i class="fa-regular fa-trash-can text-danger cursor-pointer"
                                            @click="deleteConfirmationAlert(obj.id)"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div
                            class="d-flex justify-content-end align-items-center p-2 bg-gradient-white border-top rounded-top">
                            <pagination-component :page="page" :total_counts="customers_count" :per_page_count="perPage"
                                @get-page-number="getPageNumber" @first_rec="getFirstRecord">
                            </pagination-component>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <add-users-modal v-if="is_user_form_model" :modalType="modal_type" :objId="obj_id" @close-modal="closeModel">
        </add-users-modal>
        <billing-history-modal v-if="is_history_form_model" :modalType="modal_type" :user="billCustomer"
            @close-modal="closeModel">
        </billing-history-modal>
        <update-bill-modal v-if="is_update_bill_form_model" :modalType="modal_type" :objId="obj_id"
            @close-modal="closeModel">
        </update-bill-modal>
        <contact-form-print v-if="is_user_form_print" :user_data="selected_customer" @close-modal="closeModel">
        </contact-form-print>
        <!-- <pagination-component
            :page="page"
            :total_counts="customers_count"
            :per_page_count="perPage"
            @get-page-number="getPageNumber"
            >
        </pagination-component> -->
    </div>
</template>
<script>
import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
import moment from "moment";
export default {
    name: "users-component",
    props: ["type"],
    data() {
        return {
            customers: "",
            franchise_id: 1,
            franchise_name: '',
            selected_customer: "",
            search_database: "",
            customers_count: "",
            page: 1,
            crud_loading: false,
            loading: false,
            modal_type: "",
            obj_id: "",
            today_date: moment().format("DD-MM-YYYY"),
            is_user_form_model: false,
            is_history_form_model: false,
            is_update_bill_form_model: false,
            filter_state: false,
            is_user_form_print: false,
            perPage: 100,
            search: "",
            is_all_select: false,
            firstRecord: 0,
            lastRecord: 0,
            selectedCustomers: [],
            franchises: [],
            billCustomer: {},
            originalDate: null,
            nextBillingDate: null,
        };
    },
    methods: {
        openUserFormModal(modalType, id) {
            this.modal_type = modalType;
            this.obj_id = id;
            this.is_user_form_model = true;
        },
        openPrintModal(user) {
            this.selected_customer = user;
            this.selected_customer.today = moment().format("DD-MM-YYYY");
            this.is_user_form_print = true;
        },
        generateAllBills() {
            this.$swal
                .fire({
                    title: "Are you sure?",
                    text: "You want to generate all Bills!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Generate it!",
                    customClass: {
                        confirmButton: "swal-button",
                        cancelButton: "swal-button",
                    },
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return axios({
                            url: "/pay_all_bills",
                            method: "GET",
                        }).then((response) => {
                            if (response.status === 200) {
                                return response.data.message;
                            } else {
                                return new Error(response.statusText);
                            }
                        });
                    },
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        this.$swal.fire({
                            icon: "success",
                            title: "Generated !",
                        });
                        // window.location.reload();
                        this.getCustomers();
                    }
                });
        },
        updateExpiry(objId) {
            this.loading = true;

            axios({
                url: `/admin/users/update-expiry/${objId}`,
                method: "GET",
            })
                .then((response) => {
                    this.loading = false;
                    this.successToast(response.data.message);
                    // this.$emit('close-modal');
                    this.getCustomers();
                })
                .catch((error) => {
                    this.errorToast(error.response.statusText);
                });
        },
        calculateNextBillingDate(objId) {
            this.loading = true;

            axios({
                url: `/admin/users/update-expiry-date/${objId}`,
                method: "GET",
            })
                .then((response) => {
                    this.loading = false;
                    this.successToast(response.data.message);
                    // this.$emit('close-modal');
                    this.getCustomers();
                })
                .catch((error) => {
                    this.errorToast(error.response.statusText);
                });
        },
        deleteConfirmationAlert(objId) {
            this.$swal
                .fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                    customClass: {
                        confirmButton: "swal-button",
                        cancelButton: "swal-button",
                    },
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return axios({
                            url: "/admin/real_users/delete/" + objId,
                            method: "GET",
                        }).then((response) => {
                            if (response.status === 200) {
                                return response.data.message;
                            } else {
                                return new Error(response.statusText);
                            }
                        });
                    },
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        this.$swal.fire({
                            icon: "success",
                            title: "Deleted!",
                            text: result.value,
                        });
                        // window.location.reload();
                        this.getCustomers();
                    }
                });
        },
        payFullBill(obj) {
            this.loading = true;

            axios({
                url: "/users/full-bill",
                method: "POST",
                data: obj,
            })
                .then((response) => {
                    this.loading = false;
                    this.successToast(response.data.message);
                    // this.$emit('close-modal');
                    this.getCustomers();
                })
                .catch((error) => {
                    this.errorToast(error.response.statusText);
                });
        },
        selectFranchise(franchise_id, franchise_name) {
            this.franchise_id = franchise_id
            this.franchise_name = franchise_name
            this.getCustomers();
        },
        getSearchCustomers() {
            this.loading = true;
            axios
                .post(`/admin/users/data`, {
                    data: {
                        page: 1,
                        perPage: this.perPage,
                        search: this.search_database,
                        franchise_id: this.franchise_id,
                    },
                })
                .then((response) => {
                    this.loading = false;
                    this.customers = response.data.customers;
                    this.customers_count = response.data.count;
                    this.page = 1;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        getCustomers() {
            this.loading = true;
            axios
                .post(`/admin/users/data`, {
                    data: {
                        page: this.page,
                        perPage: this.perPage,
                        search: this.search_database,
                        type: this.type,
                        franchise_id: this.franchise_id,
                    },
                })
                .then((response) => {
                    this.loading = false;
                    this.customers = response.data.customers.map((customer) => ({
                        ...customer,
                        isSelected: false,
                    }));

                    this.customers_count = response.data.count;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        getFormData() {
            this.data_loading = true
            axios({
                url: `/admin/get/form/data`,
                method: 'GET',
            })
                .then(response => {
                    this.data_loading = false
                    this.franchises = response.data.franchises
                })
                .catch(error => {
                    this.errorToast(error.response.error)
                })
        },
        toggleAllCheckboxes() {
            this.filteredData.forEach((obj) => {
                obj.isSelected = this.is_all_select;
            });
        },
        handleCheckboxChange(obj) {
            obj.isSelected = !obj.isSelected;
        },

        async generatePrintableContent() {
            const currentDate = this.today_date;
            const selectedCustomers = this.filteredData.filter(
                (obj) => obj.isSelected
            );
            const connectLogo = "/images/connect_logo.png";
            const fiberLogo = "/images/fiber_logo-updated.png";

            const loadImage = (src) => {
                return new Promise((resolve, reject) => {
                    const img = new Image();
                    img.onload = () => resolve(img);
                    img.onerror = reject;
                    img.src = src;
                });
            };
            const imagesLoadingPromises = [
                loadImage(connectLogo),
                loadImage(fiberLogo),
            ];
            await Promise.all(imagesLoadingPromises); // Wait for all images to load
            let printableContent = "";
            while (selectedCustomers.length > 0) {
                const currentSelection = selectedCustomers.splice(0, 6);

                const contentForPage = currentSelection
                    .map((customer) => {
                        return `
                    <div style="border: 1px solid black;padding: 20px 10px 0px 10px;margin-bottom: 10px;margin-top: 15px;position: relative;font-family: 'Source Sans Pro',-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';">                                           
                        <div style="padding-bottom: 2px; margin-bottom: 3px;">
                            <div style="display: flex;justify-content: space-between;">
                                <img src="${connectLogo}" alt="Left Logo" style="width: 150px; height: 30px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <img src="${fiberLogo}" alt="Right Logo" style="width: 150px; height: 35px;">
                            </div>
                            <div style="display:flex;  justify-content: space-between; font-size: 0.65rem; position:relative; top: -10px;">
                                <p style="padding-left:0.6rem;">Communication (Pvt Ltd)</p>
                                <p>Internet Service</p>
                            </div>
                            <table style="width: 100%;border-collapse: collapse;border: 1px solid black;margin-top: 5px !important; font-size: 11px;">
                                <tr style="border: 1px solid black;">
                                    <td style="border: 1px solid black;"><b>User ID:</b></td>
                                    <td style="border: 1px solid black; max-width: 200px; word-break: break-all;">&nbsp; ${customer.user_id
                            }</td>
                                </tr>  <tr style="border: 1px solid black;">
                                    <td style="border: 1px solid black;"><b>User Name:</b></td>
                                    <td style="border: 1px solid black; max-width: 200px; word-break: break-all;">&nbsp; ${customer.user_name
                            }</td>
                                </tr>  
                                <tr style="border: 1px solid black;">
                                    <td style="border: 1px solid black;"><b>Father Name:</b></td>
                                    <td style="border: 1px solid black;max-width: 200px; word-break: break-all;">&nbsp; ${customer.father_name
                            }</td>
                                </tr>
                                <tr style="border: 1px solid black;">
                                    <td style="border: 1px solid black;"><b>Address:</b></td>
                                    <td style="border: 1px solid black;max-width: 200px; word-break: break-all;">&nbsp; ${customer.address
                            }</td>
                                </tr>
                                <tr style="border: 1px solid black;">
                                    <td style="border: 1px solid black;"><b>Mobile Number:</b></td>
                                    <td style="border: 1px solid black;">&nbsp; ${customer.mobile_number
                            }</td>
                                </tr>                                                                       
                            </table>
                            <div style="padding-bottom: 2px;margin-bottom: 5px;font-size: 9px;padding-left: 2px;margin-top: 3px;">
                                <span>Pay your internet bill within 3 days otherwise your connection will be terminated.</span> 
                            </div> 
                            <table cellpadding="0" cellspacing="0" style="font-size: 11px;">
                                <tr>
                                    <td>
                                        <b>Recharge Date:</b>
                                        <u>${customer.billing_date}</u>
                                    </td>
                                    <td style="padding-left: 50px;">
                                        <b>Package:</b>
                                        <u>${customer.package.speed}</u>
                                    </td>
                                </tr>
                                <tr style="padding-top: 10px;">
                                    <td>
                                        <b>Pending Dues:</b>
                                        <u>${customer.total_pending !== undefined && customer.total_pending >= customer.package.price ? customer.total_pending - customer.package.price : customer.total_pending}</u>                                       
                                    </td>
                                    <td style="padding-left: 50px;">                                        
                                        <b>Price:</b>
                                        <u>${customer.package.price}</u> (${customer.payment_type ?? "NA"})
                                    </td>                                    
                                </tr>
                            </table>

                            <div style="padding-bottom: 2px;margin-top: 31px;padding-left: 183px;font-size: 9px;">
                                <span>Complain Number <b>03026704447</b></span> 
                            </div>
                            <div style="font-size: 10px;display: flex;align-items: center;padding-left: 10px;">
                                <span> *This is a computer generated reciept. Does not required signature*</span><br><br>
                            </div>
                        </div>
                    </div>     
                `;
                    })
                    .join("");
                printableContent += `
                <div style="page-break-inside: avoid;">
                    <div style="display: flex; flex-wrap: wrap; justify-content: space-between;">${contentForPage}</div>
                </div>`;
            }
            return `<div class="printable-area">${printableContent}</div>`;
        },
        async printSelectedBills() {
            const printableContent = await this.generatePrintableContent();

            // Create a hidden element to hold the printable content
            const printWindow = window.open("", "_blank");
            printWindow.document.open();
            printWindow.document.write(`
            <html>
            <head>
            <title>Selected Bills</title>
            <style>
                /* CSS styles for printing */
                /* Define your print styles here */
                .printable-area {
                /* Define styles for the printable area */
                }
                /* Other styles... */
            </style>
            </head>
            <body>${printableContent}</body>
            </html>
        `);
            printWindow.document.close();

            // Wait for content to be fully loaded before triggering the print action
            printWindow.onload = () => {
                printWindow.print();
            };
        },
        sortByExpiry() {
            // Toggle the sorting order
            this.isAscendingOrder = !this.isAscendingOrder;

            // Sort the data based on billing_date
            this.filteredData.sort((a, b) => {
                const dateA = new Date(a.billing_date);
                const dateB = new Date(b.billing_date);

                return this.isAscendingOrder ? dateA - dateB : dateB - dateA;
            });
        },
        getFirstRecord(record) {
            this.firstRecord = record;
        },
        openBillingFormModal(modalType, id) {
            this.modal_type = modalType;
            this.obj_id = id;
            this.is_update_bill_form_model = true;
        },
        openHistoryFormModal(modalType, obj) {
            this.modal_type = modalType;
            this.billCustomer = obj;
            this.is_history_form_model = true;
        },
        getPageNumber(page) {
            this.page = page;
            this.getCustomers();
        },
        closeModel() {
            this.is_user_form_model = false;
            this.is_update_bill_form_model = false;
            this.is_history_form_model = false;
            this.is_user_form_print = false;
            $(".modal-backdrop").remove();
            $("body").removeClass("modal-open");
            this.getCustomers();
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
            getDateClass;
        },
        leave(el, done) {
            el.style.transition = "opacity 0.8s";
            el.style.opacity = 0;
            done();
        },
        changeStatus(id) {
            axios({
                url: `/admin/users/update/is-active/${id}`,
                method: "GET", // Change the method to POST
            })
                .then((response) => {
                    if (response.status === 200) {
                        this.successToast(response.data.message);
                        this.getCustomers();
                    }
                })
                .catch((error) => {
                    if (error.response.status === 500) {
                        this.errorToast(error.response.statusText);
                    }
                });
        },
        matchesSearch(obj, searchTerm) {
            const searchTerms = searchTerm.split(" ");
            return searchTerms.every((term) => {
                const regex = new RegExp(this.escapeRegExp(term), "i");
                return Object.values(obj).some((value) => {
                    if (value !== null && typeof value !== "undefined") {
                        const strValue = value.toString().toLowerCase();
                        return regex.test(strValue);
                    }
                    return false;
                });
            });
        },
        getDateClass(date) {
            const billingDate = new Date(date);
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);

            if (billingDate.toDateString() === tomorrow.toDateString()) {
                return { "text-info": true };
            } else if (billingDate < tomorrow) {
                return { "text-danger": true };
            } else {
                // Handle other cases if needed
                return {};
            }
        },
        rechargeBill(date) {
            const billingDate = new Date(date);
            billingDate.setMonth(billingDate.getMonth() + 1);

            return { originalDate: new Date(date), billingDate };
        },
        printBills() {
            // Perform print functionality here, you can use window.print() or other libraries
            window.print();
        },
        escapeRegExp(string) {
            return string.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
        },
    },
    filters: {
        timeFormat(time) {
            if (time !== "") {
                return moment(time, "h:mm A").format("h:mm A");
            } else {
                return "";
            }
        },
        dateFormat(date) {
            if (date !== "") {
                return moment(date).format("DD-MM-YYYY");
            } else {
                return "";
            }
        },
    },
    computed: {
        filteredData() {
            if (this.search !== "") {
                const searchTerm = this.search.toLowerCase();
                return this.customers.filter((obj) => {
                    return this.matchesSearch(obj, searchTerm);
                });
            } else {
                return this.customers;
            }
        },
        printableBills() {
            // Get data for the selected customers to display in bills
            return this.selectedCustomers.slice(0, 6); // Limit to 6 customers for a single page
        },
    },
    mounted() {
        this.getCustomers();
        this.getFormData();
    },
};
</script>
<style scoped>
.user-table-data,
.table thead td {
    padding: 0px;
}

.primary-color {
    color: #007bff;
    justify-content: space-between;
}

.edit-button {
    color: #007bff;
    /* Default text color */
    text-decoration: none;
    /* Remove underline by default */
    transition: color 0.6s ease-in-out, text-shadow 0.4s ease;
}

.custom-pill {
    border-radius: 1rem !important;
    font-size: .675rem !important;
    padding: .20rem .5rem !important;
    line-height: 1 !important;
    font-weight: 700 !important;
}

.bg-color:hover {
    background-color: #0a4658 !important;
    border: none !important;
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

.cursor-pointer {
    cursor: pointer;
}

.badge {
    box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.356);
}

.border-custom-color:focus {
    border-color: #17a2b8;
}

.text-orange {
    color: #f08c44 !important;
}
</style>
