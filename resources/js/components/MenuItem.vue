<template>
    <div class="container custom">
    <form @submit.prevent="save">
        <div class="form-group">
            <label>Item</label>
            <input type="text" class="form-control" v-model="item.name">
        </div>
        <div class="form-group">
            <label>Price</label>
            $<input type="text" class="form-control"  v-model="item.price">
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" v-model="item.description"></textarea>
        </div>
        <div class="form-group">
            <label>Category</label>
            <select v-model="item.category_id" class="form-control">
                <option value="">-Select a category-</option>
                <option v-for="cat in categories" :value="cat.id" :key="cat.id">{{cat.name}}</option>
            </select>
        </div>
        <img v-if="id && item.image" :src="`${item.image}`">
        <div v-else>
            <drop-zone :options="dropzoneOptions" id="dz" ref="dropzone"></drop-zone>
            <button type="submit" class="btn btn-primary">Submit</button>
            <ul>
                <li v-for="(error, index) in errors" :key="index">{{error}}</li>
            </ul>
        </div>
    </form>
    </div>
</template>

<script>
import vue2Dropzone from 'vue2-dropzone';
import 'vue2-dropzone/dist/vue2Dropzone.min.css';
import {mapState} from 'vuex';

export default {
    name: "MenuItem",
    props: ['initialCategories', 'id'],
    data() {
        return {
            dropzoneOptions: {
                url: '/api/add-image',
                thumbnailWidth: 200,
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                }, success(file, res) {
                    file.filename = res;
                }
            },
            item :{
                name: '',
                price: 0.00,
                image: '',
                category_id: '',
                description: ''
            },
            errors: []
        }
    },
    created() {
        if (this.id) {
            axios.get('/api/menu-item/' + this.id)
                .then(res => this.item = res.data);
        }
		this.fetchItems();
    },
    computed: mapState({
        categories: 'categories'
    }),
    beforeRouteLeave(to, from, next) {
        this.item = {
            name: '',
            price: 0.00,
            image: '',
            category_id: '',
            description: ''
        };
        next();
    },
    methods: {
        save() {
            let files = this.$refs.dropzone.getAcceptedFiles();
            if(files.length && files[0].filename) {
                this.item.image = files[0].filename;
            }
            axios.post('/api/menu-items/add', this.item)
                .then((res) => console.log(res))
                .catch(error => {
                    let messages = Object.values(error.response.data.errors);
                    this.errors = [].concat().apply([], messages);
                });
        },
		 fetchItems() {
            axios.get(`/api/categories`)
                .then(res => this.categories = res.data.categories);
        },
    },
    components: {
        dropZone: vue2Dropzone
    },
}
</script>

<style scoped>
    .custom {
        margin-top: 20px;
    }
</style>
