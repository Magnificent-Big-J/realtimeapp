import Token from './Token'
import  AppStorage from './AppStorage'
class User{
    login(data){
        axios.post('/api/auth/login',data)
            .then(response=>this.responseAfterLogin(response))
            .catch((error)=>{
                console.log(error)
            })
    }
    responseAfterLogin(response){
        const access_token = response.data.access_token
        const user = response.data.user
        if(Token.isValid(access_token)){
            AppStorage.store(access_token,user)
            window.location = "/forum"
        }

    }
    hasToken(){
        const storedToken = AppStorage.getToken()

        if(storedToken){
            return Token.isValid(storedToken) ? true: false
        }

        return false
    }
    loggedIn(){
        return this.hasToken()
    }
    logout(){
        AppStorage.clear()
        window.location = "/forum"
    }
    name(){
        if(this.loggedIn()){
            return AppStorage.getUser()
        }
    }
    id(){
         const payload = Token.payload(AppStorage.getToken())
         return payload.sub
    }
    own(id){

        return this.id() == id

    }
    admin(){
        return this.id() == 11
    }

}
export  default User = new User();