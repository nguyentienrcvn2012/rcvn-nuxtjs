<template>
  <div class="container">
    <div class=" mt-5 mb-5" style="padding:20px;">
        <hr>
        <div class="ml-5 content">
            <form @submit.prevent="update">
            <div class="form-group">
                <label>Product Name</label>
                <input v-model="data[0].productName" type="name" class="form-control" autofocus  >
            </div>
            <div class="form-group">
                <label>Category</label>
                 <el-select class="select-danger"
                  placeholder="Single Select"
                  v-model="data[0].category"      >
              <el-option v-for="option in selects.data"
                        class="select-danger"
                        :value="option.value"
                        :label="option.label"
                        :key="option.value">
              </el-option>
            </el-select>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input v-model.trim="data[0].price" type="name" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label>description</label>
                 <textarea class="form-control" id="exampleFormControlTextarea1" type="name" rows="3" placeholder="Write a large text here ..." v-model.trim="data[0].description"></textarea>
            </div>
            <div class="form-group">
                <label>Inventory</label>
                <input v-model.trim="data[0].inventory" type="name" class="form-control" autofocus>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

  </div>
</template>
<script>
import { BasePagination } from "@/components/argon-core";
import {
  Table,
  TableColumn,
  DropdownMenu,
  DropdownItem,
  Dropdown,
  Tooltip,
  Select,
  Option,
  Button,
} from "element-ui";
export default {
    layout: "DashboardLayout",

    components: {
      BasePagination,
      [Tooltip.name]: Tooltip,
      [Table.name]: Table,
      [TableColumn.name]: TableColumn,
      [Dropdown.name]: Dropdown,
      [DropdownItem.name]: DropdownItem,
      [DropdownMenu.name]: DropdownMenu,
      [Select.name]: Select,
      [Option.name]: Option,
      [Button.name]: Button,
    },
    data() {
        return {
            data: [
            ],
            selects:{
              simple :'',
              data: [] 
            },
      }
    },
    async asyncData({ $axios, params }) {
      const { data } = await $axios.$post(`/product/${params.id}`, {id:params.id})
     const  selectData  = await $axios.$get(`/product/category`)
     console.log(data);
     console.log(selectData);
      return {
        data: data,
         selects:{
              simple :'',
              data: selectData.data
            },
      }

    },
  methods: {
    // async create() {
    //   await this.$axios.$post(`/topics/${this.$route.params.id}/posts`, {body: this.body})
    //   this.$router.push('/topics')
    // },
    
        async update() {
            await this.$axios.$post(`/product/edit/${this.$route.params.id}`, {
                id: this.$route.params.id,
                productName: this.data[0].productName,
                categoryId: this.data[0].categoryId,
                price: this.data[0].price,
                description: this.data[0].description,
                inventory: this.data[0].inventory,
            })
            // redirect
            this.$router.push('/product')
        }
  }
}

</script>

<style scoped>
  .content {
    border-left: 10px solid white;
    padding: 0 10px 0 10px;
  }
  .btn-outline-success, .btn-outline-danger {
    border: none;
  }
</style>
