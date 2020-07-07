import AppStroage from './AppStroage'
import Token from "./Token";

class User {
    ResponseTokenLogin(res){
        const access_token = res.data.access_token
        const username = res.data.name
        const email = res.data.email
        if(Token.isValid(access_token)){
            AppStroage.store(access_token,username,email)
        }
    }
    hasToken(){
        const storeToken = localStorage.getItem('token')
        if(storeToken){
            return Token.isValid(storeToken)? true : false
        }

        false
    }
    loggedIn(){
        return this.hasToken()
    }
    logout(){
        AppStroage.clear()
    }
    name(){
        if (this.loggedIn){
            return localStorage.getItem('user')
        }
    }
}

export default User = new User()
