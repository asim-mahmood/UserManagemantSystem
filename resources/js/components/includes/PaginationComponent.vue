<template>
    <div class="">
        <div class="pl-2 pr-2 d-flex justify-content-end">
            <div class="pr-4">
                <p class="pb-0 pt-2">Showing {{ firstRecord }}-{{ lastRecord }} out of {{ total_counts }}</p>
            </div>            
            <div class="pb-0 d-flex justify-content-between mr-3">
                <div class="">
                    <p class="pr-2 pt-2">Page No:</p>
                </div>
                <div class="dropdown pt-1">
                    <button class="btn btn-info dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-expanded="false" style="border-radius: 0px;">
                        {{ page }}
                    </button>
                    <div class="dropdown-menu dropdown-modify" style="max-height: 200px; overflow-y: auto;">
                        <a class="dropdown-item custom-hover"  v-for="count in counter" :key="count" @click="getPageData(count)" href="#">{{ count }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "pagination-component",
    props: ['page', 'total_counts', 'per_page_count' ],
    data(){
        return {
            counter: '',
            page_number: this.page,
            first_record: 0,
            last_record: 0,
        }
    },
    methods: {
        loadPrevious() {
            this.page_number--;
            this.$emit('get-page-number', this.page_number)
        },
        loadStart() {
            this.page_number = 1;
            this.$emit('get-page-number', this.page_number)
        },
        getPageData(count) {
            this.page_number = count;
            this.$emit('get-page-number', this.page_number)
        },
        loadNext() {
            this.page_number++;
            console.log(this.page_number)
            this.$emit('get-page-number', this.page_number)
        },
        loadEnd() {
            this.page_number = this.counter;
            this.$emit('get-page-number', this.page_number)
        },
        updateCounter() {

            this.page_number = this.page
            setTimeout(() => {
                this.counter = this.total_counts / this.per_page_count;
                this.counter = Math.ceil(this.counter);
            }, 700);
        }
    },
    watch: {
        total_counts: 'updateCounter',
        per_page_count: 'updateCounter',
        page(newPage) {
            this.page_number = newPage;
        },
    },
    computed: {
        firstRecord() {
            this.first_record = (this.page_number - 1) * this.per_page_count + 1;
            this.$emit('first_rec', this.first_record)
            return this.first_record
        },
        lastRecord() {
            this.last_record = Math.min(this.page_number * this.per_page_count, this.total_counts);           
            return this.last_record;
        },
    },
    mounted() {
        this.updateCounter();
    }
}
</script>

<style scoped>
tr:hover {
    color: #212529;
    background-color: rgba(0, 0, 0, 0.075);
}
.custom-hover {
    transition: background-color 0.5s ease-in-out;
}

.custom-hover:hover {
    background-color: #7ab5f558;
    font-weight: 500;
}
.dropdown-modify {
    overflow: hidden;
    min-width: 1rem;
}
</style>
