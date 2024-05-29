<template>
    <div class="modal fade ft-z-index" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-target=".bd-example-modal-lg" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog mt-0 modal-lg">
            <form @submit.prevent="save">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ modalType }} User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            @click="$emit('close-modal')"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body px-4 py-2">
                        <div class="p-3 mb-4 d-flex align-items-center justify-content-between shadow-sm  form-header">
                            <h6 class="mb-0">Personal Information:</h6>
                            <i class="fa-regular fa-id-card fa-lg"></i>
                        </div>
                        <div class="row no-gutters">
                            <div class="col-4 pr-2">
                                <div class="form-group mb-0">
                                    <label class="mb-0">User Name <sup>*</sup></label>
                                    <input type="text" class="form-control" v-model="data.user_id" placeholder="User ID"
                                        @change="checkUserId(data.user_id)" required>
                                </div>
                                <p class="isInvalid" v-if="is_user_id_taken">User Name is already taken.</p>
                            </div>
                            <div class="col-4 pr-2">
                                <div class="form-group">
                                    <label class="mb-0">Name <sup>*</sup></label>
                                    <input type="text" class="form-control" v-model="data.user_name"
                                        placeholder="User Name" required>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="mb-0">Father Name</label>
                                    <input type="text" class="form-control" v-model="data.father_name"
                                        placeholder="Father Name">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="mb-0">CNIC <sup>*</sup></label>
                                    <input type="text" class="form-control" v-model="data.cnic"
                                        placeholder="3840312345670" required minlength="13" maxlength="13"
                                        @input="checkLength">
                                    <div v-if="!isValidNumber" class="invalid-class">Please enter only numbers</div>
                                    <!-- <div class="invalid-class" v-if="data.cnic.length !== 13 && data.cnic.length !== 0">Please enter 13 digits</div> -->
                                </div>
                            </div>
                            <div class="col-8 pl-2">
                                <div class="form-group">
                                    <label class="mb-0">Mobile Number(s) <sup>*</sup></label>
                                    <div class="input-group input-group-prepend">
                                        <input type="text" class="form-control" v-model="data.mobile_number"
                                            aria-label="" minlength="11" maxlength="11" aria-describedby="basic-addon1"
                                            placeholder="03001234567" @input="checkPhone" required>
                                        <input type="text" class="form-control" v-model="data.mobile_number2"
                                            aria-label="" minlength="11" maxlength="11" aria-describedby="basic-addon1"
                                            placeholder="03001234567" @input="checkPhone2">
                                    </div>
                                    <div v-if="!isValidPhone || !isValidPhone2"
                                        :class="['invalid-class', { 'pl-16': !isValidPhone2 }]">Please enter only
                                        numbers
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="mb-0">Email Address</label>
                                    <input type="email" v-model="data.email" class="form-control"
                                        placeholder="email@domain.com">
                                </div>
                            </div>
                            <div class="col-4 pl-2">
                                <div class="form-group">
                                    <label class="mb-0">Address <sup>*</sup></label>
                                    <input type="text" v-model="data.address" class="form-control"
                                        placeholder="House No 1 Street No 1 Sargodha " required>
                                </div>
                            </div>
                            <div class="col-4 pl-2">
                                <div class="form-group">
                                    <label class="mb-0">Franchise</label>
                                    <div class="w-100">
                                        <select class="form-control" v-model="data.franchise_id">
                                            <option v-for="obj in franchises" :key="obj.id" :value="obj.id">
                                                {{ obj.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 mb-4 d-flex align-items-center justify-content-between shadow-sm form-header">
                            <h6 class="mb-0">Package Information:</h6>
                            <!-- <i class="fa-regular fa-rectangle-list fa-lg"></i> -->
                            <i class="material-symbols-outlined">price_change</i>
                        </div>
                        <div class="row no-gutters">
                            <div class="col-4 pr-2">
                                <div class="form-group">
                                    <label class="mb-0">Package</label>
                                    <select class="form-control" v-model="data.package_type">
                                        <option value="" selected disabled>Select Package Type</option>
                                        <option>Shared</option>
                                        <option>Dedicated</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 pr-2">
                                <div class="form-group">
                                    <label class="mb-0">Speed</label>
                                    <div class="w-100">
                                        <select class="form-control" v-model="data.package_id"
                                            @change="getPrice(data.package_id)">
                                            <option value="" disabled selected>Please Select Package</option>
                                            <option v-for="obj in packages" :key="obj.id" :value="obj.id">
                                                {{ obj.speed }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="mb-0">Package Amount <sup>*</sup></label>
                                    <input type="number" class="form-control" v-model="data.price"
                                        placeholder="00.00 Rs" required>
                                </div>
                            </div>
                            <div class="col-4 pr-2">
                                <div class="form-group">
                                    <label class="mb-0">Installation</label>
                                    <input type="number" class="form-control" v-model="data.installation_charges"
                                        placeholder="00.00 Rs">
                                </div>
                            </div>
                            <div class="col-4 pr-2">
                                <div class="form-group">
                                    <label class="mb-0">Device Charges</label>
                                    <input type="number" v-model="data.device_charges" class="form-control"
                                        placeholder="00.00 Rs">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="mb-0">Security</label>
                                    <input type="number" v-model="data.security" class="form-control"
                                        placeholder="00.00 Rs">
                                </div>
                            </div>
                            <div class="col-4 pr-2">
                                <div class="form-group">
                                    <label class="mb-0">Company</label>
                                    <select class="form-control" v-model="data.company_name">
                                        <option value="" selected disabled>Select Company</option>
                                        <option value="StromFiber">StromFiber</option>
                                        <option value="Connect">Connect</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 pr-2">
                                <div class="form-group">
                                    <label class="mb-0">Payment payment_type</label>
                                    <select class="form-control" v-model="data.payment_type">
                                        <option value='' selected disabled>Select Payment Type</option>
                                        <option value='Cheque'>Cheque</option>
                                        <option value='Cash'>Cash</option>
                                        <option value='Online'>Online</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <label class="mb-0">Billing Date</label>
                                <date-picker v-model="data.billing_date" type="date" value-type="YYYY-MM-DD"
                                    format="DD-MMM-YYYY" placeholder="DD-MM-YYYY"></date-picker>
                            </div>
                        </div>
                        <div class="p-3 mb-4 d-flex align-items-center justify-content-between shadow-sm form-header">
                            <h6 class="mb-0">Device Details:</h6>
                            <i class="material-symbols-outlined">router</i>
                            <!-- <i class="fa-solid fa-hard-drive fa-lg"></i> -->
                        </div>
                        <div class="row no-gutters">
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="mb-0">Device Modal</label>
                                    <input type="text" class="form-control" v-model="data.device_modal"
                                        placeholder="Device Modal and Company">
                                </div>
                            </div>
                            <div class="col-4 px-2">
                                <div class="form-group">
                                    <label class="mb-0">Purchasing</label>
                                    <select class="form-control" v-model="data.purchasing">
                                        <option value="" selected disabled>Select Purchase Type</option>
                                        <option value="Company">Company</option>
                                        <option value="User">User</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="mb-0">Device Property</label>
                                    <select class="form-control" v-model="data.device_property">
                                        <option value="" selected disabled>Select Device Property</option>
                                        <option value="Company">Company</option>
                                        <option value="User">User</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 ">
                                <div class="d-flex justify-content-end border-top py-2 pr-2 align-items-center">
                                    <p class="font-weight-bold mb-0 pr-3">Total Payment: </p>
                                    <h4 class="font-weight-bold mb-0">{{ data.total_bill }} <sub class="text-dark"> Rs
                                        </sub></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right p-2 border-top">
                        <button type="submit" class="btn btn-outline-info mr-3 px-5"
                            :disabled="is_user_id_taken || !isValidNumber || !isValidPhone || !isValidPhone2"
                            data-toggle="modal" data-target="#contactFormPrint" v-if="modalType == 'Add'">
                            <span v-if="!loading">Save</span>
                            <span v-if="loading" class="spinner-border spinner-border-sm"></span>
                        </button>
                        <button type="submit" class="btn btn-outline-info mr-3 px-5"
                            :disabled="is_user_id_taken || !isValidNumber || !isValidPhone || !isValidPhone2"
                            v-if="modalType == 'Edit'"> Update</button>
                        <button type="button" class="btn btn-outline-danger px-5" data-dismiss="modal"
                            @click="$emit('close-modal')"> Close</button>
                    </div>
                </div>
            </form>
        </div>
        <contact-form-print v-if="is_user_form_print" @close-modal="closeModel" :user_data="data">
        </contact-form-print>
    </div>
</template>
<script>
import moment from 'moment';
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
export default {
    name: 'add-user-modal',
    props: ['modalType', 'objId'],
    components: { DatePicker },
    data() {
        return {
            data: {
                user_id: '',
                franchise_id: 1,
                user_name: '',
                father_name: '',
                cnic: '',
                mobile_number: '',
                mobile_number2: '',
                email: '',
                address: '',
                package_type: '',
                price: 0,
                installation_charges: 0,
                device_charges: 0,
                security: 0,
                company_name: '',
                device_modal: '',
                purchasing: '',
                device_property: '',
                package_id: '',
                payment_type: '',
                total_bill: 0,
                billing_date: '',
                today: moment().format('DD-MM-YYYY'),
            },
            isValidNumber: true,
            isValidPhone: true,
            isValidPhone2: true,
            is_user_form_print: false,
            is_user_id_taken: false,
            loading: false,
            packages: null,
            franchises: null,

        }
    },
    methods: {
        save() {
            this.loading = true;
            let url = this.modalType == 'Add' ? '/admin/users' : `/admin/users/${this.objId}`;
            let method = this.modalType == 'Add' ? 'POST' : 'PUT';

            axios({
                url: url,
                method: method,
                data: this.data,
            })
                .then(response => {
                    this.loading = false
                    this.data = response.data.customer
                    this.successToast(response.data.message)
                    if (this.modalType == 'Add') {
                        this.is_user_form_print = true
                        this.$nextTick(() => {
                            $('#contactFormPrint').modal('show')
                        });
                    }
                    else {
                        this.$emit('close-modal');
                    }
                })
                .catch(error => {
                    this.errorToast(error.response.statusText)
                });
        },
        checkLength() {
            if (!/^[0-9]*$/.test(this.data.cnic)) {
                this.isValidNumber = false;
            }
            else {
                this.isValidNumber = true;
                if (this.data.cnic.length > 13) {
                    this.data.cnic = this.data.cnic.slice(0, 13);
                }
            }
        },
        checkPhone() {
            if (!/^[0-9]*$/.test(this.data.mobile_number)) {
                this.isValidPhone = false;
            }
            else {
                this.isValidPhone = true;
                if (this.data.mobile_number.length > 11) {
                    this.data.mobile_number = this.data.mobile_number.slice(0, 11);
                }
            }
        },
        checkPhone2() {
            if (!/^[0-9]*$/.test(this.data.mobile_number2)) {
                this.isValidPhone2 = false;
            }
            else {
                this.isValidPhone2 = true;
                if (this.data.mobile_number2.length > 11) {
                    this.data.mobile_number2 = this.data.mobile_number2.slice(0, 11);
                }
            }
        },
        checkUserId(id) {
            axios({
                url: `/admin/users/chcek/${id}`,
                method: 'GET',
            })
                .then(response => {
                    response.data.isAvailable == 'yes' ? this.is_user_id_taken = false : this.is_user_id_taken = true;
                })
                .catch(error => {
                    this.errorToast(error.response.statusText)
                });
        },
        getPrice(id) {
            const selectedPackage = this.packages.find(obj => obj.id === id);
            if (selectedPackage) {
                this.data.price = selectedPackage.price;
                this.data.package_id = selectedPackage.id;
            }
        },
        getDataForEdit() {
            this.loading = true
            axios({
                url: `/admin/users/${this.objId}/edit`,
                method: 'GET',
            })
                .then(response => {
                    this.loading = false
                    this.data = response.data.data
                })
                .catch(error => {
                    this.errorToast(error.response.error)
                })
        },
        getFormData() {
            this.data_loading = true
            axios({
                url: `/admin/get/form/data`,
                method: 'GET',
            })
                .then(response => {
                    this.data_loading = false
                    this.packages = response.data.data
                    this.franchises = response.data.franchises
                })
                .catch(error => {
                    this.errorToast(error.response.error)
                })
        },
        computeTotalBill() {
            this.data.total_bill =
                parseInt(this.data.security ? this.data.security : 0) +
                parseInt(this.data.device_charges ? this.data.device_charges : 0) +
                parseInt(this.data.installation_charges ? this.data.installation_charges : 0) +
                parseInt(this.data.price ? this.data.price : 0);
        },
        closeModel() {
            this.is_user_form_model = false;
            this.is_update_bill_form_model = false;
            this.is_history_form_model = false;
            this.is_user_form_print = false;
            $(".modal-backdrop").remove();
            $("body").removeClass('modal-open');
            // this.getCustomers();

        },
        handleMobileNumber(newVal, oldVal) {
            const maxLength = 11;
            if (newVal.length > maxLength && this.data.mobile_number) {
                // Assuming this.data is available
                this.data.mobile_number = newVal.slice(0, maxLength);
            }
        }
    },
    watch: {
        'data.security': function () {
            this.computeTotalBill();
        },
        'data.device_charges': function () {
            this.computeTotalBill();
        },
        'data.installation_charges': function () {
            this.computeTotalBill();
        },
        'data.price': function () {
            this.computeTotalBill();
        }
    },
    mounted() {
        this.getFormData();
        if (this.modalType === 'Edit' && this.objId) {
            this.getDataForEdit();
        }
        this.computeTotalBill();
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
    /* Ensures that the element is treated as a block, but lays out as an inline-level element */
    overflow: hidden;
    /* Prevents content from overflowing */
    border-radius: 50%;
    width: 30px;
    height: 30px;
    padding: 4px 7px;
    background-color: #0561851a;
}

.isInvalid {
    position: absolute;
    font-size: 80%;
    width: 100%;
    color: #f94920;
    margin-bottom: 0px;
}
</style>
