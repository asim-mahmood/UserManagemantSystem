<template>
    <div>
        <div class="shadow-sm p-2 mt-3">
            <div class="bg-white p-2 align-items-center">
                <div class="pr-2 d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-info border-0 btn-flat" data-toggle="modal"
                        data-target="#complaintsModal" @click="openFormModal('Add', null)">
                        <i class="fa-solid fa-clipboard-list pr-2"></i>
                        Register New Complaint
                    </button>
                    <button @click="sendWhatsApp">Send WhatsApp</button>
                    <a :href="whatsappLink" target="_blank">
                        <i class="fa fa-whatsapp"></i> Send WhatsApp Message
                    </a>
                </div>
            </div>
            <div class="bg-gradient-white table-responsive px-2">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="py-2">
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted">Sr #</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted"><i
                                    class="fa-solid fa-calendar-days pr-2"></i>Date</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted"><i
                                    class="fa-solid fa-child pr-2"></i>User Id</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted"><i
                                    class="fa-solid fa-child pr-2"></i>Complaint By</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted"><i
                                    class="fa-solid fa-clipboard-list pr-2"></i>Complaint</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted"><i
                                    class="fa-solid fa-mobile-retro pr-2"></i>Mobile</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted"><i
                                    class="fa-solid fa-user-tie pr-2"></i>Employee</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted"><i
                                    class="fa-solid fa-message pr-2"></i>Feedback</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted"><i
                                    class="fa-solid fa-sliders pr-2"></i>Status</th>
                            <!-- <th scope="col" class="py-2 text-nowrap align-middle text-muted"><i class="fa-regular fa-trash-can pr-2"></i>Delete</th> -->
                        </tr>
                    </thead>
                    <tbody class="">
                        <tr v-for="(obj, index) in complaints" :key="index">
                            <td class="py-2 text-nowrap align-middle">{{ index + 1 }}</td>
                            <td class="py-2 text-nowrap align-middle desc-limit">{{ obj.date | dateFormat }}</td>
                            <td class="py-2 text-nowrap align-middle cursor-pointer edit-button desc-limit"
                                v-if="obj.customer" data-toggle="modal" data-target="#complaintsModal"
                                @click="openFormModal('Edit', obj.id)">{{ obj.customer.user_id }}
                            </td>
                            <td class="py-2 text-nowrap align-middle desc-limit">{{ obj.complaint_by ? obj.complaint_by
                                : obj.customer.user_name }}</td>
                            <td class="py-2 text-nowrap align-middle desc-limit">{{ obj.problem }}</td>
                            <td class="py-2 text-nowrap align-middle desc-limit">{{ obj.mobile ? obj.mobile :
                                obj.customer.mobile_number }}</td>
                            <td class="py-2 text-nowrap align-middle desc-limit">
                                <select class="form-control form-control-sm" v-model="obj.employee_id"
                                    @change="assignEmployee(obj.id, obj.employee_id)">
                                    <option value="" selected disabled>Select Technician</option>
                                    <option v-for="employee in employees" :key="employee.id" :value="employee.id">{{
                                        employee.name }}</option>
                                </select>
                            </td>
                            <td class="py-2 text-nowrap align-middle desc-limit" ata-toggle="tooltip"
                                data-placement="top" :title="obj.feedback">{{ obj.feedback }}</td>
                            <td class="py-2 text-nowrap align-middle desc-limit ">
                                <span class="badge badge-pill"
                                    :class="{ 'badge-success': obj.is_active == 1, 'badge-danger': obj.is_active == 0 }">
                                    {{ obj.is_active == 0 ? 'Pending' : 'Resolved' }}
                                </span>
                            </td>
                            <!-- <td class="py-2 text-nowrap align-middle text-center cursor-pointer"
                                :class="{ 'text-success': obj.is_active == 1 , 'text-danger': obj.is_active == 0 }"

                            >
                                <i v-if="obj.is_active == 1" class="fa-solid fa-user-check fa-lg"></i>
                                <i v-else class="fa-solid fa-user-xmark fa-lg"></i>
                            </td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <complaints-modal v-if="is_form_model" :modalType="modal_type" :objId="obj_id" @close-modal="closeModel">
        </complaints-modal>
    </div>
</template>
<script>
import moment from 'moment';
export default {
    name: "complaints-list",
    props: [],
    data() {
        return {
            complaints: [],
            modal_type: '',
            obj_id: '',
            loading: false,
            is_form_model: false,
            defaultEmployeeId: 'defaultEmployeeId', // Set default employee id here
            defaultEmployeeName: 'Default Employee',
            recipientNumber: '+923226886566',
            message: 'Test Message'

        }
    },
    computed: {
        whatsappLink() {
            // Generate WhatsApp URL with recipient number and message
            console.log('here it is');
            return `https://wa.me/${this.recipientNumber}?text=${encodeURIComponent(this.message)}`;

        }
    },
    mounted() {
        this.getData();
    },
    methods: {
        openFormModal(modalType, id) {
            this.modal_type = modalType
            this.obj_id = id
            this.is_form_model = true
        },
        sendWhatsApp() {
            // axios({
            //     url: `/admin/send/whatsapp`,
            //     method: 'GET',
            // })
            console.log('WhatsApp link clicked');
        },
        getData() {
            this.data_loading = true
            axios({
                url: `/admin/get/complaints`,
                method: 'GET',
            })
                .then(response => {
                    this.data_loading = false
                    this.complaints = response.data.complaint
                    this.employees = response.data.employees
                })
                .catch(error => {
                    this.errorToast(error.response.error)
                })
        },
        assignEmployee(id, employeeID) {
            axios({
                url: `/admin/complaints/assign/employee/${id}/${employeeID}`,
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
        deleteInventory(objId) {
            axios.delete(`/admin/employees/${objId}`)
                .then(response => {
                    this.successToast(response.data.message);
                    this.getData();
                })
                .catch(error => {
                    console.error('Error deleting employee', error);
                    this.errorToast('Error deleting employees');
                });
        },
    },


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
    text-decoration: none;
    transition: color 0.6s ease-in-out, text-shadow 0.4s ease;
}

.edit-button:hover {
    color: #f08c44;
    /* Change text color on hover */
}

th {
    white-space: nowrap;
}

.desc-limit {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 150px;
}

.edit-button {
    color: #007bff;
    text-decoration: none;
    transition: color 0.6s ease-in-out, text-shadow 0.4s ease;
}

.edit-button:hover {
    color: #f08c44;
}

.complaints-card-body {
    padding: 1rem;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px;
    background-color: white;

}

.tex-size {
    font-size: 0.8rem;
}

.custom-badge {
    display: inline-block;
    width: 28px;
    /* Adjust size as needed */
    height: 28px;
    /* Adjust size as needed */
    border-radius: 50%;
    background-color: #ffc273;
    border: 1px solid #ffa327;
    text-align: center;
    align-items: center;
    display: flex;
    justify-content: center;
    line-height: 50px;
}

.custom-badge i {
    color: white;
}

.badge-shadow {
    box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
}

fieldset {
    border: 1px solid #9c9c9c !important;
    padding: 0 0.5em 0em 0.5em !important;
    margin: 0 !important;
    border-radius: 0.4rem;
    box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
}

legend {
    width: inherit;
    padding: 0 0.4rem;
    border-bottom: none;
    font-size: 0.8rem;
    font-weight: bold;
}

.complaint-dashboard-icon {
    font-size: 3rem;
    color: #fec67d;
    margin-bottom: 0.4rem;

}
</style>
