import Policy from './policy'

export default {
    install (Vue, options){
        Vue.prototype.authorization = (policy, model) => {
            if( !window.Auth.signIn)
                return false;
            if( typeof policy === 'string' && typeof model === 'object'){
                const user = window.Auth.user;
                return Policy[policy](user, model)
            }
        }
        Vue.prototype.signIn = window.Auth.signIn;
    }
}
