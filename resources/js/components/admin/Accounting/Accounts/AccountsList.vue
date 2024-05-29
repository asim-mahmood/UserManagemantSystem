<template>
    <div>
        <section class="content user-table-data">
            <div class="container-fluid p-2">
                <div class="border-0 rounded p-2 bg-white shadow-sm">
                    <div class="row no-gutters">
                        <div class="col-2 col-md-2 d-flex align-items-center user-table-data ">
                            <div class="pr-2">
                                <button type="button" class="btn btn-outline-info border-0 btn-flat" data-toggle="modal"
                                    data-target="#addAccountModal" @click="openFormModal('Add', null)">
                                    <i class="fa-solid fa-plus pr-2"></i>
                                    Add New Account
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="shadow-sm ">
                    <div class="bg-gradient-white table-responsive px-2">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr class="py-2 text-muted">
                                    <th scope="col" class="py-2 text-center">Sr #</th>
                                    <th scope="col" class="py-2 text-center"><i class="fa-solid fa-qrcode"></i> Title
                                    </th>
                                    <th scope="col" class="py-2 text-center"><i class="fa-solid fa-paragraph"></i> Name
                                    </th>
                                    <th scope="col" class="py-2 text-center"><i class="fa-solid fa-book"></i> Head</th>
                                    <th scope="col" class="py-2 text-center"><i class="fa-solid fa-dollar"></i> Opening
                                        Balance</th>
                                    <th scope="col" class="py-2 text-center"><i class="fa-solid fa-dollar"></i> Amount
                                    </th>
                                    <th scope="col" class="py-2 text-center"><i class="fa-solid fa-dollar"></i> Total
                                    </th>
                                    <th scope="col" class="py-2 text-center"><i class="fa-solid fa-sliders"></i> Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="">
                                <tr v-for="(obj, index) in accounts" :key="index">
                                    <td class="py-2 text-nowrap align-middle text-center">{{ index + 1 }}</td>
                                    <td class="py-2 text-nowrap align-middle edit-button cursor-pointer  text-center"
                                        data-toggle="modal" data-target="#addAccountModal"
                                        @click="openFormModal('Edit', obj.id)">
                                        {{ obj.title }}
                                    </td>
                                    <td class="py-2 text-nowrap align-middle text-center">
                                        {{ obj.name }}
                                    </td>
                                    <td class="py-2 text-nowrap align-middle text-center">
                                        <i v-if="obj.head.name === 'Income'"
                                            class="fa-solid fa-circle-arrow-up text-success"></i>
                                        <i v-else-if="obj.head.name === 'Expense'"
                                            class="fa-solid fa-circle-arrow-down text-danger"></i>
                                        {{ obj.head.name }}
                                    </td>
                                    <td
                                        :class="['py-2 text-nowrap align-middle text-center', { 'text-success': obj.head.name === 'Income' }, { 'text-danger': obj.head.name === 'Expense' }]">
                                        Rs. <span class="font-weight-bold">{{ formatAmount(obj.opening_balance)
                                            }}</span>
                                    </td>
                                    <td
                                        :class="['py-2 text-nowrap align-middle text-center', { 'text-success': obj.head.name === 'Income' }, { 'text-danger': obj.head.name === 'Expense' }]">
                                        Rs. <span class="font-weight-bold">{{ formatAmount(obj.amount) }}</span>
                                    </td>
                                    <td :class="['py-2 text-nowrap align-middle text-center']">
                                        Rs. <span class="font-weight-bold">{{
                                            formatAmount(obj.opening_balance + obj.amount) }}</span>
                                    </td>
                                    <td class="text-nowrap align-middle text-center">
                                        <label class="mb-0">
                                            <input type="checkbox" v-model="obj.is_active" class="toggle-checkbox"
                                                @change="changeStatus(obj.id)">
                                            <div class="toggle-container toggle-shadow">
                                                <div class="toggle-slider"></div>
                                                <div class="toggle-text"></div>
                                            </div>
                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <add-account-modal v-if="is_form_model" :modalType="modal_type" :objId="obj_id" @close-modal="closeModel">
        </add-account-modal>
    </div>
</template>
<script>
import moment from 'moment';
export default {
    name: "accounting-table",
    props: [],
    data() {
        return {
            accounts: '',
            modal_type: '',
            obj_id: '',
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
            console.log('here', modalType, id);
            this.modal_type = modalType
            this.obj_id = id
            this.is_form_model = true
        },
        formatAmount(amount) {
            if (amount === undefined || amount === null) {
                return '0.00';
            }
            // Convert amount to string and format with commas
            return parseFloat(amount).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        },
        getData() {
            this.data_loading = true
            axios({
                url: `/admin/get/accounts`,
                method: 'GET',
            })
                .then(response => {
                    this.data_loading = false
                    this.accounts = response.data.data
                })
                .catch(error => {
                    this.errorToast(error.response.error)
                })
        },
        changeStatus(id) {
            axios({
                url: `/admin/accounts/update/is-active/${id}`,
                method: 'GET',
            })
                .then((response) => {
                    if (response.status === 200) {
                        this.successToast(response.data.message)
                        this.getData()
                    }
                })
                .catch(error => {
                    if (error.response.status === 500) {
                        this.errorToast(error.response.statusText)
                    }
                });
        },
        closeModel() {
            this.is_form_model = false;
            this.getData();
            $(".modal-backdrop").remove();
            $("body").removeClass('modal-open');
        },

    },
    mounted() {
        this.getData();
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
