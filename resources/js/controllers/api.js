
const API_URL = "http://127.0.0.1:8000/api"

export default{
    fetcUsers:()=>{
        return fetch(API_URL + "/users/all")
        .then(res=> res.json())
        .then(data=>{
            if (data.success) {
                console.log(data.response.users);
                return data.response.users
            }else{
                throw data.response.error
            }
        }).catch((err)=>alert(err))
    },
    createUser:(name, email , password)=>{
        if (name === ""|| email===""||password==="") {
            return false;
        }
        return fetch(API_URL+"/users/create",{
            method: "POST",
            headers:{
                "Content-Type":"application/json",
            },
            body:JSON.stringify({name,email,password})
        }).then( res => res.json()).then(data =>{
            if (data.success) {
                return data.response.user
            }else{
                throw data.response.error
            }
        }).catch((err)=> alert(err) )
    },
    async getUser(id){
        if (id) {
            return fetch(API_URL+"/users/"+id).then(res=>res.json()).then(data=>{
                if (data.success) {
                    // console.log(data.response.user);
                    return data.response.user;
                }else{
                    throw data.response.error
                }
            }).catch(err=> alert(err))
        }
    },
    updateUser(name , email , id){
        if (name === ""|| email===""||id==="") {
            return false;
        }
        return fetch(API_URL+"/users/"+id+ "/update",{
            method: "PUT",
            headers:{
                "Content-Type":"application/json",
            },
            body:JSON.stringify({name,email})
        }).then( res => res.json()).then(data =>{
            if (data.success) {
                return data.response.user
            }else{
                throw data.response.error
            }
        }).catch((err)=> alert(err) )
    },
    deleteUser(id){
        if (id) {
            return fetch(API_URL + "/users/"+id+ "/delete" ,{
                method:"DELETE"
            }).then( res => res.json()).then(data =>{
                if (data.success) {
                    console.log(data.response);
                    alert("user deleted successfully")
                    return true
                }else{
                    throw data.response.error
                }
            }).catch((err)=> alert(err) )
        }
    }
}