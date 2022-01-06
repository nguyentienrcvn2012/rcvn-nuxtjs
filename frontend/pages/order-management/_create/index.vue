<template>
  <div class="container">
    <div class=" mt-5 mb-5" style="padding:20px;">
        <h3 class="display-3">Update </h3>
        <hr>
        <div class="ml-5 content">
            <form @submit.prevent="create">
            <input type="hidden" name="productId" class="form-control" :value="data[0].id">
            <div class="form-group">
                <label>Product Name</label>
               <input v-model="data[0].productName" type="name" class="form-control" readonly  >
            </div>
            <div class="form-group">
                <label>Category</label>
                 <el-select class="select-danger"
                  placeholder="Single Select"
                  v-model="data[0].category"  readonly     >
              <el-option v-for="option in selects.data"
                        class="select-danger"
                        :value="option.value"
                        :label="option.label"
                        :key="option.value">
              </el-option>
            </el-select>
            </div>
            <div class="form-group">
                <label>Quantily</label>
                <input v-model="data[0].quantily"  type="name" class="form-control"  >
            </div>
            <div class="form-group">
                <label>Price</label>
                <input v-model.trim="data[0].price" type="name" class="form-control" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
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
      return {
        data: data,
         selects:{
              simple :'',
              data: selectData.data
            },
      }

    },
  methods: {
    async create() {
      console.log(this.data);
      await this.$axios.$post("/order/create-order", this.data)
      await this.$router.go()
    },
    
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
