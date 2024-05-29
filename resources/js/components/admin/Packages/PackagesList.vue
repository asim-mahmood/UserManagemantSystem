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
                                    data-target="#packageModal"
                                    @click= "openFormModal('Add', null)">
                                    <i class="fa-solid fa-plus pr-2"></i>
                                    Package
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="shadow-sm ">
                    <div class="bg-gradient-white table-responsive px-2">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr class="py-2">
                                    <!-- <th scope="col" class="py-2 text-center">
                                        <input type="checkbox" class="" id="exampleCheck1">
                                    </th> -->
                                    <th scope="col" class="py-2 text-center">Sr #</th>
                                    <th scope="col" class="py-2">Speed</th>
                                    <th scope="col" class="py-2 col-8">Name</th>
                                    <th scope="col" class="py-2">Price</th>
                                    <th scope="col" class="py-2">Cost</th>
                                    <th scope="col" class="py-2 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                 <tr v-for="(obj, index) in packages" :key="index">
                                    <!-- <td scope="col" class="py-2 align-middle text-center">
                                        <input type="checkbox" class="" id="exampleCheck1">
                                    </td> -->
                                    <td class="py-2 text-nowrap align-middle text-center">{{ index + 1 }}</td>
                                    <td class="py-2 text-nowrap align-middle edit-button cursor-pointer" data-toggle="modal" data-target="#packageModal" @click= "openFormModal('Edit', obj.id)">
                                        {{ obj.speed }}
                                    </td>
                                    <td class="py-2 text-nowrap align-middle ">
                                        <span>{{ obj.name }}</span>
                                    </td>
                                    <td class="py-2 text-nowrap align-middle">
                                        <div>
                                            <p class="mb-0">{{ obj.price }}</p>
                                        </div>
                                    </td>
                                    <td class="py-2 text-nowrap align-middle">
                                        <div>
                                            <p class="mb-0">{{ obj.cost }}</p>
                                        </div>
                                    </td>
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
            </div>
        </section>
        <package-modal
            v-if="is_form_model"
            :modalType="modal_type"
            :objId="obj_id"
            @close-modal="closeModel">
        </package-modal>
    </div>
</template>
<script>
import moment from 'moment';
export default {
    name: "packages-list",
    props: [ 'packageId', 'packageType'],
    data() {
        return {
            packages: '',
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
                url: `/admin/get/packages`,
                method: 'GET',
            })
            .then(response => {
                this.data_loading = false
                this.packages = response.data.data
            })
            .catch(error => {
                this.errorToast(error.response.error)
            })
        },
        changeStatus(id) {
            axios({
                url: `/admin/package/update/is-active/${id}`,
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
    mounted() {
        this.getData();
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
</style>
