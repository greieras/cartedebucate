<template>
    <div class="container">
        <form @submit.prevent="saveCategories">
        <h2>Category manager</h2>
        <a @click="addCategory()" class="btn btn-primary">+ Add Category</a>
        <div v-if="categories.length>0">
            <div v-for="(category, index) in categories" :key="category.id" class="card" style="width:500px">
                <h3>{{category.name}}</h3>
                <img class="card-img-top" v-if="category.image" :src="`${category.image}`" width="100" height="200">
                <label v-else>Image</label>
                <input type="text" :value="category.image" @change="update($event, 'image', index)">
                <div class="card-body">
                    <h4 class="card-title">
                        <label>Order</label>
                        <input type="number" :value="`${category.display_order}`" @input="update($event, 'display_order', index)" :ref="category.display_order">
                    </h4>
                    <input type="text" :value="category.name" @input="update($event, 'name', index)" :ref="category.name">
                    <a @click="removeCategory(index)" class="btn btn-danger btn-xs">remove {{category.id}} </a>
                </div>
            </div>
        </div>
        <div v-else>
            <p class="text-danger">no categories to show</p>
        </div>
            <h3>{{feedback}}</h3>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</template>

<script>
export default {
    name: "CategoryManager",
    computed: {
        categories() {
            return this.$store.state.categories;
        },
        feedback() {
            return this.$store.state.feedback;
        }
    },
    methods: {
        removeCategory(index) {
            if (confirm('Are you sure?')) {
                this.$store.dispatch('removeCategory', index);
            }
        },
        addCategory(){
            this.$store.commit('ADD_CATEGORY', {
                id: 0,
                name: '',
                image: '',
                display_order: this.categories.length + 1
            });
            this.$nextTick(() => {
               window.scrollTo(0, document.body.scrollHeight);
               this.$refs[''][0].focus();
            });
        },
        saveCategories(){
            this.$store.dispatch('saveCategories');
        },
        update($event, property, index){
            this.$store.commit('UPDATE_CATEGORY',{
                index,
                property,
                value: $event.target.value
            })
        }
    }
}
</script>

<style scoped>

</style>
