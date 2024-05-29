<template>
    <div>
        <section class="content user-table-data">
            <div class="container-fluid p-2">
                <div class="border-0 rounded p-2 bg-white shadow-sm">
                    <div class="row no-gutters">
                        <div class="col-2 col-md-2 d-flex align-items-center user-table-data ">
                            <div class="pr-2">
                                <button type="button" class="btn btn-outline-info border-0 btn-flat"
                                    data-toggle="modal"
                                    data-target="#addUserModal"
                                    @click= "openUserFormModal('add', null)">
                                    <i class="fa-solid fa-user-plus pr-2" ></i>
                                    Add User
                                </button>
                            </div>
                        </div>
                        <div class="col-6 col-md-5 ">
                             <div class="input-group">
                                <input v-model="search" class="form-control rounded-pill" placeholder="Search">
                                    <div class="input-group-append">
                                </div>
                            </div>
                        </div>
                        <div class="col-4 col-md-5">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="dropdown pr-2 ">
                                    <button class="btn bg-info dropdown-toggle shadow-sm btn-flat" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa-solid fa-download pr-2"></i>Download
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item border-bottom" href="#"><i class="fa-solid fa-file-csv text-warning pr-2"></i> CSV</a>
                                        <a class="dropdown-item border-bottom" href="#"><i class="fa-solid fa-file-pdf text-danger pr-2"></i> PDF</a>
                                        <a class="dropdown-item" href="#"><i class="fa-solid fa-file-excel text-success pr-2"></i> Excel</a>
                                    </div>
                                </div>
                                <div>
                                    <button type="button" class="btn bg-info shadow-sm btn-block btn-flat">
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
                                        <option>StormFiber</option>
                                        <option>Connect</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </transition>
                <div class="shadow-sm">
                    <div class="d-flex justify-content-end align-items-center p-2 bg-gradient-white mt-4 rounded-top">
                        <pagination-component
                            :page="page"
                            :total_counts="customers_count"
                            :per_page_count="perPage"
                            @get-page-number="getPageNumber"
                            >
                        </pagination-component>
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
                                 <tr v-for="(obj, index) in filteredData" :key="index">
                                    <td scope="col" class="py-2 align-middle">
                                        <input type="checkbox" class="" id="exampleCheck1">
                                    </td>
                                    <td class="py-2 text-nowrap align-middle">{{ index + 1 }}</td>
                                    <td class="py-2 text-nowrap align-middle ">
                                        <span class="edit-button cursor-pointer" data-toggle="modal" data-target="#addUserModal" @click= "openUserFormModal('edit', obj.id)">{{ obj.user_id }}</span>
                                    </td>
                                    <td class="py-2 text-nowrap align-middle">
                                        <div>
                                            <p class="mb-0">{{ obj.user_name }}</p>
                                            <p class="mb-0 text-muted">{{ obj.cnic }}</p>
                                        </div>
                                    </td>
                                    <td class="py-2 text-nowrap align-middle">{{ obj.father_name }}</td>
                                    <td class="py-2 text-nowrap align-middle">
                                        <div>
                                            <p class="mb-0">{{ obj.mobile_number }}</p>
                                            <p class="mb-0 text-muted">{{ obj.email }} </p>
                                        </div>
                                    </td>
                                    <td class="py-2 text-nowrap align-middle">{{ obj.company_name }}</td>
                                    <td class="py-2 text-nowrap align-middle">
                                        <div>
                                            <p class="mb-0">
                                                {{ obj.package.speed }}
                                                <span class="badge badge-info badge-pill">Rs {{ obj.price }}</span>
                                                <span class="badge badge-success badge-pill">{{ obj.package_type }}</span>
                                            </p>
                                            <p class="mb-0">
                                                <strong>Activation:</strong>
                                                <span class="text-muted"> {{ obj.created_at | dateFormat }}</span>
                                            </p>
                                        </div>
                                    </td>
                                    <td class="py-2 text-nowrap align-middle">
                                        <div>
                                            <p class="mb-0">
                                                <strong>Device:</strong> <span class="text-danger">{{ obj.device_charges }}</span>
                                                <span class="badge badge-primary badge-pill">{{ obj.device_modal }}</span>
                                            </p>
                                            <p class="mb-0">
                                                <strong>Security:</strong> <span class="badge badge-secondary badge-pill">{{ obj.security }}</span>
                                                <!-- <strong>Owner:</strong><span class="text-primary"> {{ obj.purchasing }}</span> -->
                                                <span :class="{ 'text-success': obj.purchasing === 'User', 'text-primary': obj.purchasing === 'Company' }">{{ obj.purchasing }}</span>
                                            </p>
                                        </div>
                                    </td>
                                    <td class="py-2 text-nowrap align-middle">
                                        <div>
                                            <p class="mb-0">{{ obj.billing_date }} 
                                                <span class="badge  badge-pill " :class="{'badge-success': obj.status === 'Paid' ,'badge-warning': obj.status === 'Pending' }"
                                                    data-toggle="modal"
                                                    type="button"
                                                    data-target="#updateBilling"
                                                    @click= "openBillingFormModal('edit', obj.id)"
                                                >{{ obj.status }}
                                                </span>
                                            </p>
                                            <a data-toggle="modal"
                                                type="button"
                                                data-target="#billingHistory"
                                                @click= "openHistoryFormModal('add', null)" 
                                                class="text-info"
                                            ><i class="fa-solid fa-share fa-xs"></i> 
                                                Billing History
                                            </a>
                                        </div>
                                    </td>
                                    <!-- <td class="py-2 text-nowrap align-middle text-success text-center cursor-pointer" v-if="obj.is_active" @change="changeStatus(obj.id)"><i class="fa-solid fa-user-check fa-lg"></i></td>
                                    <td class="py-2 text-nowrap align-middle text-danger text-center cursor-pointer" v-else @change="changeStatus(obj.id)"><i class="fa-solid fa-user-xmark fa-lg"></i></td> -->
                                    <td class="py-2 text-nowrap align-middle text-center cursor-pointer"
                                        :class="{ 'text-success': obj.is_active, 'text-danger': !obj.is_active }"
                                        @click="changeStatus(obj.id)"
                                    >
                                        <i v-if="obj.is_active" class="fa-solid fa-user-check fa-lg"></i>
                                        <i v-else class="fa-solid fa-user-xmark fa-lg"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>                       
                    </div>
                </div>
            </div>
        </section>
        <add-users-modal
            v-if="is_user_form_model"
            :modalType="modal_type"
            :objId="obj_id"
            @close-modal="closeModel">
        </add-users-modal>
        <billing-history-modal
            v-if="is_history_form_model"
            :modalType="modal_type"
            :objId="obj_id"
            @close-modal="closeModel">
        </billing-history-modal>
        <update-bill-modal
            v-if="is_update_bill_form_model"
            :modalType="modal_type"
            :objId="obj_id"
            @close-modal="closeModel">
        </update-bill-modal>
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
import moment from 'moment';
export default {
    name: "users-component",
    props: [ 'customerId', 'customerType'],
    data() {
        return {
            customers: '',
            customers_count: '',
            page: 1,
            crud_loading: false,
            loading: false,
            modal_type: '',
            obj_id: '',
            is_user_form_model: false,
            is_history_form_model: false,
            is_update_bill_form_model: false,
            filter_state: false,
            perPage: 100,
            search: ''
        }
    },
    methods: {
        openUserFormModal(modalType, id) {
            this.modal_type = modalType
            this.obj_id = id
            this.is_user_form_model = true
        },
        getCustomers() {
            this.loading = true;
            axios
                .get(`/admin/users/data/${this.page}/${this.perPage}`)
                .then(response => {
                    this.loading = false;
                    this.customers = response.data.data
                    this.customers_count = response.data.count                   
                })
                .catch(error => {
                    this.errorToast(error.response.error);
                }
                );
        },
        openBillingFormModal(modalType, id) {
            this.modal_type = modalType
            this.obj_id = id
            this.is_update_bill_form_model = true
        },
        openHistoryFormModal(modalType, id) {
            this.modal_type = modalType
            this.obj_id = id
            this.is_history_form_model = true
        },
        getPageNumber(page) {
            this.page = page
            this.getCustomers()
        },        
        closeModel(){
            this.is_user_form_model=false;
            this.is_update_bill_form_model=false;
            this.is_history_form_model=false;
            $(".modal-backdrop").remove();
            $("body").removeClass('modal-open');
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
        },
        leave(el, done) {
            el.style.transition = "opacity 0.8s";
            el.style.opacity = 0;
            done();
        },
        changeStatus(id) {
            axios({
                url: `/admin/users/update/is-active/${id}`,
                method: 'GET', // Change the method to POST
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
            const searchTerms = searchTerm.split(' ');
            return searchTerms.every(term => {
                const regex = new RegExp(this.escapeRegExp(term), 'i');
                return Object.values(obj).some(value => {
                    if (value !== null && typeof value !== 'undefined') {
                        const strValue = value.toString().toLowerCase();
                        return regex.test(strValue);
                    }
                    return false;
                });
            });
        },
        escapeRegExp(string) {
            return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        }
    },
    filters: {
        timeFormat(time) {
            if (time !== '') {
                return moment(time, 'h:mm A').format("h:mm A");
            }
            else {
                return '';
            }
        },
        dateFormat(date) {
            if (date !== '') {
                return moment(date).format("DD-MM-YYYY");
            }
            else {
                return '';
            }
        },
    },
    computed: {
        filteredData() {
            if (this.search !== '') {
                const searchTerm = this.search.toLowerCase();
                return this.customers.filter(obj => {
                    return this.matchesSearch(obj, searchTerm);
                });
            } else {
                return this.customers;
            }
        }
    },
    mounted() {
        this.getCustomers();
        
    }
}
</script>
<style scoped>
    .user-table-data, .table thead td{
        padding: 0px;
    }
    .primary-color{
        color: #007bff;
    }
    .edit-button{
        color: #007bff; /* Default text color */
        text-decoration: none; /* Remove underline by default */
        transition: color 0.6s ease-in-out, text-shadow 0.4s ease;
    }
    .edit-button:hover{
        color: #f08c44; /* Change text color on hover */
    }
    .fade-example-enter-active, .fade-example-leave-active {
        transition: opacity 0.8s;
    }
    .fade-example-enter, .fade-example-leave-to {
     opacity: 0;
    }
    th {
      white-space: nowrap;
    }
    .cursor-pointer {
      cursor: pointer;
    }
</style>
