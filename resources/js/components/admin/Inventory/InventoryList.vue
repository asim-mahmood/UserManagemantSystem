<template>
    <div>
        <div class="shadow-sm p-2 mt-3">
            <div class="bg-white p-2 align-items-center">
                <div class="pr-2 d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-info border-0 btn-flat"
                        data-toggle="modal"
                        data-target="#inventoryModal"
                        @click= "openFormModal('Add', null)">
                        <i class="fa-solid fa-layer-group pr-2"></i>
                        Add Inventory
                    </button>
                    <div class="d-flex">
                        <date-picker
                            v-model="startDate"
                            type="date"
                            value-type="YYYY-MM-DD"
                            format="DD-MMM-YYYY"
                            placeholder="Start Date"
                            class="pr-3"
                            ></date-picker>
                            <date-picker
                            v-model="endDate"
                            type="date"
                            value-type="YYYY-MM-DD"
                            format="DD-MMM-YYYY"
                            placeholder="End Date"
                            :min-date="minEndDate"
                            ></date-picker>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-white table-responsive px-2">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="py-2">
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted">Sr #</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted"><i class="fa-solid fa-tag"></i> Product</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted"><i class="fa-regular fa-calendar-days text-muted"></i> Date</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted"><i class="fa-regular fa-building"></i> Company</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted"><i class="fa-solid fa-calculator"></i> Price/Unit</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted"><i class="fa-solid fa-hourglass-half"></i> Quantity</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted"><i class="fa-solid fa-dollar-sign"></i> Price</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted"><i class="fa-solid fa-sliders"></i> Status</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted"><i class="fa-regular fa-clipboard"></i> Description</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted">Action</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <tr v-for="(obj, index) in filteredData" :key="index">
                            <td class="py-2 text-nowrap align-middle">{{ getSequentialNumber(index) }}</td>
                            <td class="py-2 text-nowrap align-middle cursor-pointer edit-button" 
                                data-toggle="modal"
                                data-target="#inventoryModal" 
                                @click= "openFormModal('Edit', obj.id)"
                                :class="{ 'text-danger': !obj.product }"
                                >{{ obj.product || 'No Product Name' }}
                            </td>
                            <td class="py-2 text-nowrap align-middle">{{ obj.date|dateFormat }}</td>
                            <td class="py-2 text-nowrap align-middle">{{ obj.company }}</td>
                            <td class="py-2 text-nowrap align-middle text-right">{{ obj.unit_price }}</td>
                            <td class="py-2 text-nowrap align-middle">{{ obj.quantity }}</td>
                            <td class="py-2 text-nowrap align-middle text-right">{{ obj.total_price }}</td>
                            <td class="py-2 text-nowrap align-middle"><span class="badge badge-pill" :class="{
                                'badge-danger': obj.status === 'Low',
                                'badge-warning': obj.status === 'Medium',
                                'badge-success': obj.status === 'High',
                            }">{{ obj.status }}</span></td>
                           <td class="py-2 align-middle desc-limit">{{ obj.description }}</td>
                           <td class="py-2 text-nowrap align-middle text-center">
                               <span class="text-danger cursor-pointer text-center" @click="deleteInventory(obj.id)"><i class="fa-regular fa-trash-can"></i></span>
                           </td>
                        </tr>                         
                    </tbody>
                </table>
            </div>
        </div>
        <inventory-modal
            v-if="is_form_model"
            :modalType="modal_type"
            :objId="obj_id"
            @close-modal="closeModel">
        </inventory-modal>
    </div>
</template>
<script>
import moment from 'moment';
export default {
    name: "inventory-list",
    props: [],
    data() {
        return {
            // inventories: '',
            inventories: [],
            modal_type: '',
            obj_id: '', 
            crud_loading: false,
            loading: false,
            notes: '',
            date:'',
            is_form_model: false,
            filter_state: false,
            selectAll: false,
            isIndeterminate: false,
            selectedInventories: [],
            startDate: moment().startOf('month').format('YYYY-MM-DD'), 
            endDate: moment().format('YYYY-MM-DD'),
            minEndDate: moment().format('YYYY-MM-DD')   
        }
    },
    computed:{
        // filteredData(){
        //     return this.inventories
        // },
        filteredData() {
        const startDate = moment(this.startDate);
        const endDate = moment(this.endDate);

        return this.inventories.filter(item => {
            console.log(item);
            const itemDate = moment(item.date);
            return itemDate.isBetween(startDate, endDate, null, '[]'); 
        });
    },
        shouldShowContent() {
            return this.obj.is_deleted !== 1;
        },
    },
    mounted() {
        this.getData();
    },
    methods: {
        openFormModal(modalType, id) {
            console.log('here', modalType, id);
            this.modal_type = modalType
            this.obj_id = id
            this.is_form_model = true
        },
    
        getData() {
            this.data_loading = true
            axios({
                url: `/admin/get/inventories`,
                method: 'GET',
            })
            .then(response => {
                this.data_loading = false
                this.inventories = response.data
            })
            .catch(error => {
                this.errorToast(error.response.error)
            })
        },
    // getData(startDate, endDate, minEndDate) {
    //     this.data_loading = true;
    //     axios({
    //         url: `/admin/get/inventories`,
    //         method: 'POST',
    //         params: {
    //             startDate: startDate,
    //             endDate: endDate,
    //             minEndDate: minEndDate
    //         }
    //     })
    //     .then(response => {
    //         this.data_loading = false;
    //         this.inventories = response.data;
    //     })
    //     .catch(error => {
    //         this.errorToast(error.response.error);
    //     });
    // },
        changeStatus(id) {
            axios({
                url: `/admin/inventories/update/is-active/${id}`,
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
        deleteInventory(objId) {
            axios.delete(`/admin/inventories/${objId}`)
                .then(response => {
                    this.successToast(response.data.message);
                    this.getData();
                })
                .catch(error => {
                    console.error('Error deleting inventory', error);
                    this.errorToast('Error deleting inventory');
                });
        },
        getSequentialNumber(index) {
            // Count only non-deleted items
            let count = 0;
            for (let i = 0; i <= index; i++) {
                if (!this.filteredData[i] || !this.filteredData[i].is_deleted) {
                count++;
            }
            }
            return count;
        }, 
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
                return '-';
            }
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
</style>
