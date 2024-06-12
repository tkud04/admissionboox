const confirmAction = (actionId,callback) => {
  const v = confirm('Are you sure? This action cannot be undone')

  if(v){
    typeof callback === 'function' && callback(actionId)
  }
}


const login = async (fd,successCallback,errorCallback) => {
    const url = 'api/signin'
    const response =  await fetch(url, {
        method: "POST",
        body: fd
      })
    if(response.status === 200){
      const responseJSON = await response.json()
       successCallback(responseJSON)
    }
    else{
     const ret = {status: 'error', message: `Request failed with status code: ${response.status}`}
     errorCallback(ret)
    }
   
}

const signup = async (fd,successCallback,errorCallback) => {
  const url = 'api/signup'
  const response =  await fetch(url, {
      method: "POST",
      body: fd
    })
  if(response.status === 200){
    const responseJSON = await response.json()
     successCallback(responseJSON)
  }
  else{
   const ret = {status: 'error', message: `Request failed with status code: ${response.status}`}
   errorCallback(ret)
  }
 
}

const schoolSignup = async (fd,successCallback,errorCallback) => {
  const url = 'api/school-signup'
  const response =  await fetch(url, {
      method: "POST",
      body: fd
    })
  if(response.status === 200){
    const responseJSON = await response.json()
     successCallback(responseJSON)
  }
  else{
   const ret = {status: 'error', message: `Request failed with status code: ${response.status}`}
   errorCallback(ret)
  }
 
}

const completeSchoolSignup = async (fd,successCallback,errorCallback) => {
  const url = 'api/set-password'
  const response =  await fetch(url, {
      method: "POST",
      body: fd
    })
  if(response.status === 200){
    const responseJSON = await response.json()
     successCallback(responseJSON)
  }
  else{
   const ret = {status: 'error', message: `Request failed with status code: ${response.status}`}
   errorCallback(ret)
  }
 
}

const changePassword = async (fd,successCallback,errorCallback) => {
  const url = 'api/change-password'
  const response =  await fetch(url, {
      method: "POST",
      body: fd
    })
  if(response.status === 200){
    const responseJSON = await response.json()
     successCallback(responseJSON)
  }
  else{
   const ret = {status: 'error', message: `Request failed with status code: ${response.status}`}
   errorCallback(ret)
  }
 
}

const rn = async (fd,successCallback,errorCallback) => {
  const url = 'api/read-notification'
  const response =  await fetch(url, {
      method: "POST",
      body: fd
    })
  if(response.status === 200){
    const responseJSON = await response.json()
     successCallback(responseJSON)
  }
  else{
   const ret = {status: 'error', message: `Request failed with status code: ${response.status}`}
   errorCallback(ret)
  }
 
}

const addPlugin = async (fd,successCallback,errorCallback) => {
  const url = 'api/add-plugin'
  const response = await fetch(url, {
      method: "POST",
      body: fd
    })
  if(response.status === 200){
    const responseJSON = await response.json()
     successCallback(responseJSON)
  }
  else{
   const ret = {status: 'error', message: `Request failed with status code: ${response.status}`}
   errorCallback(ret)
  }
 
}

const removePlugin = async (id,successCallback,errorCallback) => {
  const url = `api/remove-plugin?xf=${id}`
  const response = await fetch(url, {
      method: "GET",
    })
  if(response.status === 200){
    const responseJSON = await response.json()
     successCallback(responseJSON)
  }
  else{
   const ret = {status: 'error', message: `Request failed with status code: ${response.status}`}
   errorCallback(ret)
  }
 
}