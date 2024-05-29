<template>
    <div class="modal fade mt-2" id="employeeModal" tabindex="-1" aria-hidden="true" data-target=".bd-example-modal-lg"
        data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <form @submit.prevent="save">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ modalType }} Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            @click="$emit('close-modal')"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-3">
                        <div class="circle-container">
                            <div class="circle">
                                <i class="fa-solid fa-user-tie icon"></i>
                            </div>
                        </div>
                        <div class="mt-5 package-container px-3 pb-2 pt-5">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="mb-0">Name <sup>*</sup></label>
                                        <input type="text" class="form-control" v-model="data.name" placeholder="Name"
                                            required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="mb-0">Father Name <sup>*</sup></label>
                                        <input type="text" class="form-control" v-model="data.father_name"
                                            placeholder="Father Name" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="mb-0">CNIC <sup>*</sup></label>
                                        <input type="text" class="form-control" v-model="data.cnic" placeholder="CNIC"
                                            required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="mb-0">Email <sup>*</sup></label>
                                        <input type="email" class="form-control" v-model="data.email"
                                            placeholder="Email" required>
                                    </div>
                                </div>
                                <div class="col-4" v-if="modalType == 'Add'">
                                    <div class="form-group">
                                        <label class="mb-0">Password <sup>*</sup></label>
                                        <input type="password" class="form-control" v-model="data.password"
                                            placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="mb-0">Mobile Number <sup>*</sup></label>
                                        <input type="number" class="form-control" v-model="data.mobile_number"
                                            placeholder="Mobile Number" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="mb-0">Phone Number</label>
                                        <input type="number" class="form-control" v-model="data.mobile_number2"
                                            placeholder="Phone Number">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="mb-0">Address</label>
                                        <input type="text" class="form-control" v-model="data.address"
                                            placeholder="Address">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="mb-0">Reference</label>
                                        <input type="text" class="form-control" v-model="data.reference"
                                            placeholder="Reference">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="mb-0">Position <sup>*</sup></label>
                                        <input type="text" class="form-control" v-model="data.post"
                                            placeholder="Position">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label class="mb-0">Salary</label>
                                        <input type="number" class="form-control" v-model="data.salary"
                                            placeholder="Salary">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="mb-0">Joining Date</label>
                                            <date-picker v-model="data.joining_date" type="date" value-type="YYYY-MM-DD"
                                                format="DD-MMM-YYYY" placeholder="DD-MM-YYYY"></date-picker>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right p-2 border-top">
                        <button type="submit" class="btn btn-outline-info mr-2 px-5" :disabled="is_employee_id_taken"
                            data-toggle="modal" data-target="#employeePrintFormModal" v-if="modalType == 'Add'">
                            <span v-if="!loading">Save</span>
                            <span v-if="loading" class="spinner-border spinner-border-sm"></span>
                        </button>
                        <button type="submit" class="btn btn-outline-info mr-2 px-5" v-if="modalType == 'Edit'">
                            Update</button>
                        <button type="button" class="btn btn-outline-danger px-5" @click="$emit('close-modal')">
                            Close</button>
                    </div>
                </div>
            </form>
        </div>
        <employees-print-form-modal v-if="is_employee_form_print" @close-modal="closeModel" :employee_data="data">
        </employees-print-form-modal>
    </div>
</template>
<script>
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import moment from 'moment';
export default {
    name: 'employees-modal',
    props: ['modalType', 'objId'],
    components: { DatePicker },
    data() {
        return {
            data: {
                name: '',
                father_name: '',
                cnic: '',
                email: '',
                password: '',
                mobile_number: '',
                mobile_number2: '',
                address: '',
                reference: '',
                post: '',
                salary: '',
                joining_date: moment().format('YYYY-MM-DD'),
                status: '',
            },
            loading: false,
            is_employee_form_print: false,
            is_employee_id_taken: false,
        }
    },
    watch: {
        'data.cnic': {
            handler(newValue, oldValue) {
                // Remove non-numeric characters from input
                let numericCnic = newValue.replace(/[^\d]/g, '');

                // Ensure input length does not exceed 13 characters
                numericCnic = numericCnic.slice(0, 13);

                // Format CNIC with dashes in 5-7-1 format
                let formattedCnic = '';
                for (let i = 0; i < numericCnic.length; i++) {
                    if ((i === 5 || i === 12) && formattedCnic.charAt(formattedCnic.length - 1) !== '-') {
                        formattedCnic += '-';
                    }
                    formattedCnic += numericCnic[i];
                }

                // Update data.cnic with the formatted value
                this.data.cnic = formattedCnic;
            },
            immediate: true
        },
        'data.mobile_number'(newVal, oldVal) {
            const maxLength = 11;
            if (newVal.length > maxLength) {
                this.data.mobile_number = newVal.slice(0, maxLength);
            }
        }
    },
    methods: {
        save() {
            this.loading = true;
            let url = this.modalType == 'Add' ? '/admin/employees' : `/admin/employees/${this.objId}`;
            let method = this.modalType == 'Add' ? 'POST' : 'PUT';

            axios({
                url: url,
                method: method,
                data: this.data,
            })
                .then(response => {
                    this.loading = false
                    if (this.modalType == 'Add') {
                        this.is_employee_form_print = true
                        this.$nextTick(() => {
                            $('#employeePrintFormModal').modal('show')
                        });

                    }
                    this.successToast(response.data.message)
                    if (this.modalType == 'Edit') {
                        this.$emit('close-modal');
                    }
                })
                .catch(error => {
                    this.errorToast(error.response.statusText)
                });
        },
        checkUserId(id) {
            axios({
                url: `/admin/employees/check/{id}/${id}`,
                method: 'GET',
            })
                .then(response => {
                    response.data.isAvailable == 'yes' ? this.is_employee_id_taken = false : this.is_employee_id_taken = true;
                })
                .catch(error => {
                    this.errorToast(error.response.statusText)
                });
        },
        getDataForEdit() {
            // console.log('here');
            this.loading = true
            axios({
                url: `/admin/employees/${this.objId}/edit`,
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
        closeModel() {
            this.is_employee_form_print = false;
            $(".modal-backdrop").remove();
            $("body").removeClass('modal-open');
            this.$emit('close-modal')
        },
    },
    mounted() {
        if (this.modalType === 'Edit' && this.objId) {
            this.getDataForEdit();
        }
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

/**Circle Css  */
.circle-container {
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    top: 20px;
    left: 362px;

}

.circle {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 80px;
    /* Adjust the width as needed */
    height: 80px;
    /* Adjust the height as needed */
    background-color: orange;
    border: 8px solid rgb(255, 255, 255);
    border-radius: 50%;
    box-shadow: 1px 4px 8px rgba(0, 0, 0, 0.377);
    /* Adjust the shadow as needed */
}

.icon {
    font-size: 2rem;
    /* Adjust the font size as needed */
    color: white;
    text-shadow: 1px 4px 4px rgba(0, 0, 0, 0.267);
    font-size: 2.5rem;
}

.package-container {
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.377);
}
</style>
