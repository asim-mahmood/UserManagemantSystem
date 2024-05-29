<template>
    <div>
        <div class="shadow-sm p-2 mt-3">
            <div class="bg-white p-2 align-items-center">
                <div class="pr-2 d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-info border-0 btn-flat"
                        data-toggle="modal"
                        data-target="#employeeModal"
                        @click= "openFormModal('Add', null)">
                        <i class="fa-solid fa-user-tie pr-2"></i>
                        Add New Employee
                    </button>
                </div>
            </div>
            <div class="bg-gradient-white table-responsive px-2">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="py-2">
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted">Sr #</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted">Name</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted">Father Name</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted">CNIC</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted">Email</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted">Mobile</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted">Phone</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted">Position</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted">Salary</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted">Joining</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted">Status</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <tr v-for="(obj, index) in employees" :key="index">
                            <td class="py-2 text-nowrap align-middle">{{ index+1}}</td>
                            <td class="py-2 text-nowrap align-middle cursor-pointer edit-button" 
                                data-toggle="modal"
                                data-target="#employeeModal" 
                                @click= "openFormModal('Edit', obj.id)"
                                :class="{ 'text-danger': !obj.name }"
                                >{{ obj.name || 'No Employee Name' }}
                            </td>
                            <td class="py-2 text-nowrap align-middle desc-limit">{{ obj.father_name}}</td>
                            <td class="py-2 text-nowrap align-middle desc-limit">{{ obj.cnic}}</td>
                            <td class="py-2 text-nowrap align-middle desc-limit">{{ obj.email}}</td>
                            <td class="py-2 text-nowrap align-middle">{{ obj.mobile_number}}</td>
                            <td class="py-2 text-nowrap align-middle desc-limit">{{ obj.mobile_number2}}</td>
                            <td class="py-2 text-nowrap align-middle desc-limit">{{ obj.post}}</td>
                            <td class="py-2 text-nowrap align-middle desc-limit">{{ obj.salary}}</td>
                            <td class="py-2 text-nowrap align-middle desc-limit">{{ obj.joining_date | dateFormat}}</td>
                            <td class="py-2 text-nowrap align-middle text-center cursor-pointer"
                                :class="{ 'text-success': obj.is_active == 1 , 'text-danger': obj.is_active == 0 }"
                                @click="changeStatus(obj.id)"
                            >
                                <i v-if="obj.is_active == 1" class="fa-solid fa-user-check fa-lg"></i>
                                <i v-else class="fa-solid fa-user-xmark fa-lg"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <employees-modal
            v-if="is_form_model"
            :modalType="modal_type"
            :objId="obj_id"
            @close-modal="closeModel">
        </employees-modal>
    </div>
</template>
<script>
import moment from 'moment';
export default {
    name: "employees-list",
    props: [],
    data() {
        return {
            employees: [],
            modal_type: '',
            obj_id: '', 
            crud_loading: false,
            loading: false,
            notes: '',
            date:'',
            is_form_model: false,
            filter_state: false,
        }
    },
    computed:{
        // getEmployee(){
        //     return this.employees
        // },
        shouldShowContent() {
        return this.obj.is_deleted !== 1;
            },
        
    },
    mounted() {
        this.getData();
    },
    methods: {
        openFormModal(modalType, id) {
            // console.log('here', modalType, id);
            this.modal_type = modalType
            this.obj_id = id
            this.is_form_model = true
        },
        getData() {
            this.data_loading = true
            axios({
                url: `/admin/get/employees`,
                method: 'GET',
            })
            .then(response => {
                this.data_loading = false
                this.employees = response.data
            })
            .catch(error => {
                this.errorToast(error.response.error)
            })
        },
        changeStatus(id) {
            axios({
                url: `/admin/employees/update/is-active/${id}`,
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
        closeModel(){
            this.is_form_model=false;
            this.getData();
            $(".modal-backdrop").remove();
            $("body").removeClass('modal-open');
        },
        // closeModel() {
        //     this.is_form_model = false;
        //     this.getData();
        //     $(".modal-backdrop").remove();
        //     $("body").removeClass('modal-open');
        // },
        handleSelectAllChange() {
        // Handle changes in the parent checkbox
        this.filteredData.forEach((obj) => {
            obj.isSelected = this.selectAll;
        });
        },
        handleCheckboxChange(obj) {
            obj.isSelected ? this.selectedInventories.push(obj) : this.selectedInventories.pop(obj);
            // this.selectedCustomers.push(obj);
            const selectedCount = this.filteredData.filter((obj) => obj.isSelected).length;
            this.selectAll = selectedCount === this.filteredData.length;
            this.isIndeterminate = selectedCount > 0 && !this.selectAll;
        },
    },
    
    
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
        color: #007bff;
        text-decoration: none;
        transition: color 0.6s ease-in-out, text-shadow 0.4s ease;
    }
    .edit-button:hover{
        color: #f08c44; /* Change text color on hover */
    }
    th {
      white-space: nowrap;
    }
    .desc-limit {
      white-space: nowrap; /* Prevent text from wrapping */
      overflow: hidden;    /* Hide the overflowing content */
      text-overflow: ellipsis; /* Display an ellipsis (...) to indicate truncated text */
      max-width: 100px;    /* Set a maximum width for the cell */
    }
    .edit-button{
        color: #007bff;
        text-decoration: none;
        transition: color 0.6s ease-in-out, text-shadow 0.4s ease;
    }
    .edit-button:hover{
        color: #f08c44; /* Change text color on hover */
    }

</style>
