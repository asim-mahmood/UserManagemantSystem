<template>
    <div class="modal fade mt-5" id="payBillModal" tabindex="-1" aria-hidden="true" data-target=".bd-example-modal-lg"
        data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog mt-0 modal-xl">
            <form @submit.prevent="save">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pay User Bill</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            @click="$emit('close-modal')"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-3 modal-padding">
                        <div class="circle-container">
                            <div class="circle">
                                <i class="icon fa-solid fa-file-circle-plus"></i>
                            </div>
                        </div>
                        <div class="package-container px-3 pb-3 pt-4">
                            <div class="">
                                <label class="mb-0">User ID <sup>*</sup></label>
                                <treeselect v-model="data.user_id" :options="customers" :normalizer="normalizer"
                                    :searchable="true" :clearable="true" :required="true" placeholder="Select User"
                                    @input="getUserBill">
                                </treeselect>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-convert">
                                    <thead>
                                        <tr class="py-2">
                                            <th scope="col" class="py-2">Name</th>
                                            <th scope="col" class="py-2">Father Name</th>
                                            <th scope="col" class="py-2">Package</th>
                                            <th scope="col" class="py-2">Bill</th>
                                            <th scope="col" class="py-2 text-center">Pay Bill</th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        <tr v-if="customer_bill">
                                            <td class="py-2 text-nowrap align-middle" data-label="Name">
                                                {{ customer_bill.user_name }}
                                            </td>
                                            <td class="py-2 text-nowrap align-middle" data-label="Father Name">
                                                {{ customer_bill.father_name || 'Not Found' }}
                                            </td>
                                            <td class="py-2 text-nowrap align-middle" data-label="Package">
                                                {{ customer_bill.package.speed || 'Not Found' }}
                                            </td>
                                            <td class="py-2 text-nowrap align-middle" data-label="Bill">
                                                <sub>Rs.</sub> {{ customer_bill.package.price || 'Not Found' }}
                                            </td>
                                            <td class="text-nowrap align-middle text-center pay-bill-btn"
                                                data-label="Pay Bill">
                                                <button type="button"
                                                    class="btn btn-outline-warning cursor-pointer custom-pill"
                                                    @click="payUserBill">
                                                    Pay Bill
                                                </button>
                                            </td>
                                        </tr>
                                        <tr v-else>
                                            <td colspan="5" class="text-center no-user-selected">No User Selected</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="text-right p-2 border-top">
                        <button type="submit" class="btn btn-outline-success mr-2 px-5" v-if="modalType == 'Add'">
                            <span v-if="!loading">Save</span>
                            <span v-if="loading" class="spinner-border spinner-sm"></span>
                        </button>
                        <button type="submit" class="btn btn-outline-success mr-2 px-5" :disabled="is_user_id_taken"
                            v-if="modalType == 'Edit'"> Update</button>
                        <button type="button" class="btn btn-outline-danger px-5" @click="$emit('close-modal')">
                            Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import Treeselect from '@riophae/vue-treeselect'
import '@riophae/vue-treeselect/dist/vue-treeselect.css'
export default {
    name: 'pay-user-bill',
    props: ['modalType', 'objId'],
    components: { DatePicker, Treeselect },
    data() {
        return {
            data: {
                'name': '',
                'speed': '',
                'price': '',
                'cost': '',
                'user_id': null
            },
            customers: [],
            customer_bill: '',
            loading: false,
        }
    },
    methods: {
        save() {
            this.loading = true;
            let url = this.modalType == 'Add' ? '/admin/packages' : `/admin/packages/${this.objId}`;
            let method = this.modalType == 'Add' ? 'POST' : 'PUT';

            axios({
                url: url,
                method: method,
                data: this.data,
            })
                .then(response => {
                    this.loading = false
                    this.successToast(response.data.message)
                    this.$emit('close-modal');
                })
                .catch(error => {
                    this.errorToast(error.response.statusText)
                });
        },
        payUserBill() {
            this.loading = true;

            axios({
                url: '/users/full-bill',
                method: 'POST',
                data: this.customer_bill,
            })
                .then(response => {
                    this.loading = false
                    this.successToast(response.data.message)
                })
                .catch(error => {
                    this.errorToast(error.response.statusText)
                });
        },
        normalizer(node) {
            return {
                id: node.id,
                label: node.user_id,
            };
        },
        getFormData() {
            console.log('here');
            this.loading = true
            axios({
                url: `/get/customers`,
                method: 'GET',
            })
                .then(response => {
                    this.loading = false
                    this.customers = response.data
                })
                .catch(error => {
                    this.errorToast(error.response.error)
                })
        },
        getUserBill() {
            console.log(this.data.user_id, 'here it is');
            this.loading = true
            axios({
                url: `/get/customer/bill/${this.data.user_id}`,
                method: 'GET',
            })
                .then(response => {
                    this.loading = false
                    this.customer_bill = response.data
                })
                .catch(error => {
                    this.errorToast(error.response.error)
                })
        },
        closeTab(tabId) {
            this.items = this.items.filter(item => item.id !== tabId)
            if (this.items.length === 0) {
                this.$emit('close-modal')
            }
        }
    },
    mounted() {
        this.getFormData();
    },
}
</script>
<style scoped>
.form-header {
    background-color: #eaf5ff;
}

.form-header,
h6,
i {
    color: #51aafc;
}

.user {
    display: inline-block;
    overflow: hidden;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    padding: 4px 7px;
    background-color: #0561851a;
}

.circle-container {
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1;
    position: relative;

}

.circle {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 80px;
    height: 80px;
    background-color: orange;
    border: 8px solid rgb(255, 255, 255);
    border-radius: 50%;
    box-shadow: 1px 4px 8px rgba(0, 0, 0, 0.377);
}

.icon {
    font-size: 2rem;
    color: white;
    text-shadow: 1px 4px 4px rgba(0, 0, 0, 0.267);
    font-size: 2.5rem;
}

.package-container {
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.377);
    top: -33px;
    position: relative;
    background: white;
}

.custom-pill {
    border-radius: 1rem !important;
    font-size: .675rem !important;
    padding: .20rem .5rem !important;
    line-height: 1 !important;
    font-weight: 700 !important;
}

@media screen and (max-width: 530px) {
    .package-container {
        padding: 1rem 0.5rem 0.5rem 0.5rem !important;
    }

    th {
        font-size: 0.7rem !important;
    }

    .modal-padding {
        padding: .5rem !important;
    }

    .table thead {
        display: none;
    }

    .table,
    .table tbody,
    table tr,
    table td {
        display: block;
        width: 100%;
    }

    .table tr {
        margin-bottom: 15px;
    }

    .table td {
        text-align: right;
        padding-left: 40%;
        position: relative;
    }

    .table td::before {
        content: attr(data-label);
        position: absolute;
        left: 0;
        width: 50%;
        padding-left: 10px;
        font-size: 15px;
        font-weight: bold;
        text-align: left
    }

    .circle {
        width: 60px;
        height: 60px;
        border: 8px solid rgb(255, 255, 255);
        border-radius: 50%;
        box-shadow: 1px 4px 8px rgba(0, 0, 0, 0.377);
    }

    .no-user-selected {
        padding-left: 0 !important;
    }

    .icon {
        font-size: 1.5rem;
    }

    .package-container {
        top: -23px;
    }

    .pay-bill-btn {
        text-align: end !important;
    }
}
</style>
