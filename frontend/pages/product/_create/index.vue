<template>
  <div class="container">
    <div class=" mt-5 mb-5" style="padding:20px;">
        <h3 class="display-3">Create customer</h3>
        <hr>
        <div class="ml-5 content">
            <form v-on:submit.prevent="create">
            <div class="form-group">
                <label>Product Name</label>
                <input v-model="data.productName" name="productName" type="name" class="form-control" autofocus  >
            </div>
            <div class="form-group">
                <label>categoryId</label>
                <!-- <input v-model.trim="data.categoryId" name="categoryId" type="name" class="form-control" autofocus> -->
                <el-select class="select-danger"
                  placeholder="Single Select"
                          v-model="selects.simple">
              <el-option v-for="option in selects.languages"
                        class="select-danger"
                        :value="option.value"
                        :label="option.label"
                        :key="option.label">
              </el-option>
            </el-select>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input v-model.trim="data.price" name="price" type="number" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label>Description </label>
                <input v-model.trim="data.description" name="description" type="text" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label>Inventory </label>
                <input v-model.trim="data.inventory" name="inventory" type="number" class="form-control" autofocus>
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
            data: 
              {
                productName : '',
                categoryId  : '',
                price  : '',
                description : '',
                inventory : ''
              }
            }
    },
  methods: {
    async create() {
      await this.$axios.$post("/product/create", this.data)
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
