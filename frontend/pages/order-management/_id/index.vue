<template>
  <div class="container">
    <div class=" mt-5 mb-5" style="padding:20px;">
        <h3 class="display-3">Update  {{data[0].productId}}</h3>
        <hr>
        <div class="ml-5 content">
            <form @submit.prevent="update">
            <div class="form-group">
                <label>Product Name</label>
               <input v-model="data[0].productId" type="name" class="form-control" readonly  >
            </div>
            <div class="form-group">
                <label>Custome Name</label>
                   <input v-model="data[0].customerId" type="name" class="form-control" readonly  >
            </div>
            <div class="form-group">
                <label>Quantily</label>
                <input v-model.trim="data[0].quantily" type="name" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input v-model.trim="data[0].totalPrice" type="name" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label>Status</label>
                <input v-model.trim="data[0].status" type="name" class="form-control" readonly>
            </div>
            <button v-if="data[0].status ==='proccessing'" type="submit" class="btn btn-primary">Update</button>
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
            switches: {
             off: false,
             on: true
          },
      }
    },
    async asyncData({ $axios, params }) {
      const { data } = await $axios.$post(`/order/${params.id}`, {id:params.id})
      return {
        data: data,
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
