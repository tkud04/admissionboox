const confirmAction = (actionId,callback) => {
  const v = confirm('Are you sure? This action cannot be undone')

  if(v){
    typeof callback === 'function' && callback(actionId)
  }
}

const handleResponseError = (data) => {
  console.log('data in error')
  let errMessage = 'please try again'
  if(data.message === 'validation'){
   errMessage = 'All fields are required'
  }
  else if(data.message === 'invalid-session'){
    errMessage = 'There was an issue while processing your data. Please contact support'
   }
  else if(data.message === 'invalid-user'){
   errMessage = 'User invalid, please contact support'
  }

  alert(errMessage)
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

const addFacility = async (fd,successCallback,errorCallback) => {
  const url = 'api/add-facility'
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

const removeFacility = async (id,successCallback,errorCallback) => {
  const url = `api/remove-facility?xf=${id}`
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

const addClub = async (fd,successCallback,errorCallback) => {
  const url = 'api/add-club'
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

const removeClub = async (id,successCallback,errorCallback) => {
  const url = `api/remove-club?xf=${id}`
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

const updateSchoolInfo = async (fd,successCallback,errorCallback) => {
  const url = 'api/usi'
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