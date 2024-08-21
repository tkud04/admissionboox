let emailIndex = 0

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
  else if(data.message === 'own'){
    errMessage = 'You cannot carry out this action'
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

const addSchoolClass = async (fd,successCallback,errorCallback) => {
  const url = 'api/add-school-class'
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

const removeSchoolClass = async (id,successCallback,errorCallback) => {
   const url = `api/remove-school-class?xf=${id}`
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

const addAdmissionSession = async (fd,successCallback,errorCallback) => {
  const url = 'api/add-school-admission'
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

const updateAdmissionSession = async (fd,successCallback,errorCallback) => {
  const url = 'api/update-school-admission'
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

const removeAdmissionSession = async (id,successCallback,errorCallback) => {
  const url = `api/remove-school-admission?xf=${id}`
  const response = await fetch(url, {
      method: "GET"
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

const addAdmissionForm = async (fd,successCallback,errorCallback) => {
  const url = 'api/add-admission-form'
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

const removeAdmissionForm = async (id,successCallback,errorCallback) => {
  const url = `api/remove-admission-form?xf=${id}`
  const response = await fetch(url, {
      method: "GET"
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

const addFormSection = async (fd,successCallback,errorCallback) => {
  const url = 'api/add-form-section'
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

const removeFormSection = async (id,successCallback,errorCallback) => {
  const url = 'api/remove-form-section'
  const fd = new FormData()
  fd.append('xf',id)
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

const addFormField = async (fd,successCallback,errorCallback) => {
  const url = 'api/add-form-field'
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

const removeFormField = async (id,successCallback,errorCallback) => {
  const url = 'api/remove-form-field'
  const fd = new FormData()
  fd.append('xf',id)
  
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

const updateAdmissionForm = async ({id='',status='pending'},successCallback,errorCallback) => {
  const url = 'api/uaf'
  const fd = new FormData()
  fd.append('xf',id)
  fd.append('status',status)
  
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

const addSchoolFaq = async (fd,successCallback,errorCallback) => {
  const url = 'api/add-school-faq'
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

const updateSchoolFaq = async ({id='',question='',answer=''},successCallback,errorCallback) => {
  const url = 'api/school-faq'
  const fd = new FormData()
  fd.append('xf',id)
  fd.append('question',question)
  fd.append('answer',answer)
  
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

const removeFaq = async (id='',successCallback,errorCallback) => {
  const url = 'api/remove-school-faq'
  const fd = new FormData()
  fd.append('xf',id)
  
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

const bomb = (
  {
    ll=[],
    subject='',
    msg='',
  },
successCallback,
errorCallback
) => {
  let url = `api/send-email`

const to = ll[emailIndex],dt = new FormData()
dt.append('msg',msg)
dt.append('subject',subject)
dt.append('to',to)

$('#logs-loading').fadeIn()
$('#mailer-results').fadeIn()


$.ajax({ 
 type : 'POST',
 url  : url,
 data : dt,
 processData: false,
 contentType: false,
 beforeSend: () => {
  $("#logs-loading").html('<div class="alert alert-info" role="alert" style=" text-align: center;"><strong class="block" style="font-weight: bold;">  Processing <img src="images/loading.gif" class="img img-esponsive" style="width: 20px; height: 20px;"></strong></div>');

 },
 success : (response) => {
   $('#logs-loading').hide()
    let ret = JSON.parse(response)
   console.log({response})
    
   if(ret['status'] == "ok" || ret['status'] == "sent"){
     $('#mailer-results').append("<p class='text-success'>Email sent to " + to + "</p>")   
   }
   else{
     $('#mailer-results').append("<p class='text-danger'>An error occured sending to " + to + "</p>")
   }
   
   
   setTimeout(function(){
     //console.log("data sent: " + dt);
     ++emailIndex; 
      if(emailIndex < ll.length){
        bomb({ll,subject,msg})
      } 
      else{
        typeof successCallback === 'function' && successCallback()
      }
     },5000)
   
   },
   error: (err) => {
    typeof errorCallback === 'function' && errorCallback(err)
   }
 })
}

const updateApplication = async (xf,status='',successCallback,errorCallback) => {
  const url = 'api/school-application'
  const fd = new FormData()
  fd.append('xf',xf)
  fd.append('status',status)
  
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

const updateSchoolProfile = async (fd,successCallback,errorCallback) => {
  const url = 'api/usp'
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

const updateSchoolReview = async (xf,status='',successCallback,errorCallback) => {
  const url = `api/update-school-review`
  const fd = new FormData()
  fd.append('xf',xf)
  fd.append('status',status)

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

const removeSchoolReview = async (id='',successCallback,errorCallback) => {
  const url = 'api/remove-school-review'
  const fd = new FormData()
  fd.append('xf',id)
  
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

const addSchoolReview = async (payload={xf:'',environment:'',service:'',price:'',comment:''},successCallback,errorCallback) => {
  const url = 'api/add-school-review'
  const fd = new FormData()
  fd.append('xf',payload.xf)
  fd.append('environment',payload.environment)
  fd.append('service',payload.service)
  fd.append('price',payload.price)
  fd.append('comment',payload.comment)
  
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