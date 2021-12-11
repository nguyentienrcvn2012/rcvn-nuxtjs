import Vuex from 'vuex'
const createStore =() => {
    return new Vuex.Store({
        state:{
            customers: []
        },
        mutations:{
            setCustomers(state, customers){
                state.customers = customers
            }
        },
        actions:{
            setCustomers(vuexContext, customers){
                vuexContext.commit('setCustomers',customers)
            }
        },
        getters:{
            customers(state){
                return state.customers
            }
        }
    })
}
export default createStore