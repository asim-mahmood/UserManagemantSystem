<template>
    <div>
        <div class="shadow-sm p-2 mt-3">
            <div class="bg-white p-2 align-items-center">
                <div class="pr-2 d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-info border-0 btn-flat" data-toggle="modal" data-target="#franchiseModal"
                        @click= "openFormModal('Add', null)">
                        <i class="fa-solid fa-store pr-2"></i>
                        Add New Franchise
                    </button>
                </div>
            </div>
            <div class="bg-gradient-white table-responsive px-2">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="py-2">
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted text-center">Sr #</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted"><i class="fa-solid fa-quote-left"></i> Name</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted"><i class="fa-solid fa-user-tie"></i> Owner Name</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted"><i class="fa-solid fa-location-dot"></i> Location</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted"><i class="fa-solid fa-circle-info"></i> Detail</th>
                            <th scope="col" class="py-2 text-nowrap align-middle text-muted text-center"><i class="fa-solid fa-sliders"></i> Status</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <tr v-for="(obj, index) in franchises.data" :key="index">
                            <td class="py-2 text-nowrap align-middle text-center">{{ index + 1 }}</td>
                            <td class="py-2 text-nowrap align-middle cursor-pointer edit-button" data-toggle="modal"
                                data-target="#franchiseModal" @click="openFormModal('Edit', obj.id)"
                                :class="{ 'text-danger': !obj.name }">
                                {{ obj.name || 'No franchise Name' }}
                            </td>
                            <td class="py-2 text-nowrap align-middle desc-limit">{{ obj.owner_name }}</td>
                            <td class="py-2 text-nowrap align-middle desc-limit">{{ obj.location }}</td>
                            <td class="py-2 text-nowrap align-middle desc-limit">{{ obj.details || 'No details'}}</td>
                            <td class="text-nowrap align-middle text-center">
                                <label class="mb-0">
                                    <input type="checkbox" v-model="obj.is_active" class="toggle-checkbox" @change="changeStatus(obj.id)">
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
        <franchise-modal v-if="is_form_model" :modalType="modal_type" :objId="obj_id" @close-modal="closeModel">
        </franchise-modal>
    </div>
</template>
<script>
import moment from 'moment';
export default {
    name: "franchise-list",
    props: [],
    data() {
        return {
            franchises: [],
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
            // console.log('here', modalType, id);
            this.modal_type = modalType
            this.obj_id = id
            this.is_form_model = true
        },
        getData() {
            this.data_loading = true
            axios({
                url: `/admin/get/franchises`,
                method: 'GET',
            })
                .then(response => {
                    this.data_loading = false
                    this.franchises = response.data
                })
                .catch(error => {
                    this.errorToast(error.response.error)
                })
        },
        changeStatus(id) {
            axios({
                url: `/admin/franchises/update/is-active/${id}`,
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
    /* Prevent text from wrapping */
    overflow: hidden;
    /* Hide the overflowing content */
    text-overflow: ellipsis;
    /* Display an ellipsis (...) to indicate truncated text */
    max-width: 100px;
    /* Set a maximum width for the cell */
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
</style>
